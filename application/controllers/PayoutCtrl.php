<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class PayoutCtrl extends CI_Controller {
    public $pm;
    public $mm;
    public $cm;
    public $lm;
    public $rolepermissionModel;
    public $audit_model ;
    public $auth;
    public $cookie;
    public $audit;
    public $url;
    public $db;
    public $database;
    public $session;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('PayoutMod','pm');
		$this->load->model('Configmod','cm');
		$this->load->model('MasterMod','mm');
		$this->load->model('LeadMod','lm');
		$this->load->library('session');
		$this->load->library('audit');
		$this->load->helper('url');
		$this->load->helper('cookie');
	}

        public function payout_entry()
        {
            if($this->session->has_userdata('logged_in')) 
            {
                if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
                {    		
                    $pro_data["project_info"] = $this->mm->fetch_project_info();
                    $data["insurer_company"] = $this->cm->get_insurer_company();
                    $data["type"] = $this->cm->get_policy_premium_type();
                    $data["category"] = $this->cm->get_motor_category();
                    $data["state"] = $this->cm->get_commission_state();
                    $data["rto"] = $this->cm->get_rto_list();
                    $data["class"] = $this->cm->get_insurer_class();
                    $data["business_type"] = $this->cm->get_business_type();
                    $data["commission_type"] = $this->cm->get_commission_type();
                    $data["policy_type"] = $this->pm->fetch_policy_type();
                    $data["health_policy_type"] = $this->pm->fetch_health_policy_type();
                    $data["fuel_type"] = $this->pm->get_fuel_type();
                    $data["cover"] = $this->pm->get_policy_cover_type();
                    $data["agents_pos"] = $this->pm->list_of_pos_and_agents();
                    $this->load->view('header',$pro_data);
                    $this->load->view('payout_entry_test',$data);
                    $this->load->view('footer',$pro_data);
                }
                else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user")
                {
                        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
                        if($check_user_i->masters_view == "1")
                        {
                        $pro_data["project_info"] = $this->mm->fetch_project_info();
                        $data["insurer_company"] = $this->cm->get_insurer_company();
                        $data["type"] = $this->cm->get_policy_premium_type();
                        $data["category"] = $this->cm->get_motor_category();
                        $data["state"] = $this->cm->get_commission_state();
                        $data["rto"] = $this->cm->get_rto_list();
                        $data["class"] = $this->cm->get_insurer_class();
                        $data["business_type"] = $this->cm->get_business_type();
                        $data["commission_type"] = $this->cm->get_commission_type();
                        $data["fuel_type"] = $this->pm->get_fuel_type();
                        $data["cover"] = $this->pm->get_policy_cover_type();
                        $this->load->view('header',$pro_data);
                        $this->load->view('payout_entry_test',$data);
                        $this->load->view('footer',$pro_data);
                }
                else
                {
                    echo "<script>alert('Permission Denied');window.location.href='home';</script>";
                }
             }
            }
        }
        
        
         public function fetch_make_arr()
        {
            if($this->session->has_userdata('logged_in'))
            {
                $vechile_type = $this->input->post("vechile_type");
                    
                $res=array();
                
                if($vechile_type == "1" || $vechile_type == "3" || $vechile_type == "68")
                {
                        $res = $this->pm->fetch_make_car();
                }
                else if($vechile_type == "2")
                {
                        $res = $this->pm->fetch_make_bike();
                }
                else if($vechile_type == "4")
                {
                    $res = $this->pm->fetch_make_e_two_wheeler();
                }
                else if($vechile_type == "7" || $vechile_type == "12" || $vechile_type == "13" || $vechile_type == "14" || $vechile_type == "59" || $vechile_type == "60" || $vechile_type == "65" || $vechile_type == "66" || $vechile_type == "69")
                {
                        $res = $this->pm->fetch_make_pc($vechile_type);
                }
                else if($vechile_type == "8" || $vechile_type == "9" || $vechile_type == "10" || $vechile_type == "15" || $vechile_type == "16" || $vechile_type == "61")
                {
                        $res = $this->pm->fetch_make_gc($vechile_type);
                }
                else if($vechile_type == "20")
                {
                        $res = $this->pm->fetch_make_misc();
                }
                else if($vechile_type == "55")
                {
                    $res = $this->pm->fetch_make_scooter();
                }
                else if($vechile_type == "18")
                {
                    $res = $this->pm->fetch_make_ambulance();
                }
                echo json_encode($res);
        }
    }
        
        public function fetch_model_arr()
        {
            if($this->session->has_userdata('logged_in'))
            {
                $vechile_type = $this->input->post("vechile_type");
                $vechi_make = $this->input->post("vechi_make");
                
                $res = array();
                
                if($vechile_type == "1" || $vechile_type == "3" || $vechile_type == "68")
                {
                     $res = $this->pm->fetch_car_model($vechi_make);
                }
                else if($vechile_type == "2")
                {
                        $res = $this->pm->fetch_bike_model($vechi_make);
                }
                else if($vechile_type == "4")
                {
                    $res = $this->pm->fetch_e_two_wheeler_model($vechi_make);
                }
                else if($vechile_type == "7" || $vechile_type == "12" || $vechile_type == "13" || $vechile_type == "14" || $vechile_type == "59" || $vechile_type == "60" || $vechile_type == "65" || $vechile_type == "66" || $vechile_type == "69")
                {
                        $res = $this->pm->fetch_pc_model($vechile_type,$vechi_make);
                }
                else if($vechile_type == "8" || $vechile_type == "9" || $vechile_type == "10" || $vechile_type == "15" || $vechile_type == "16" || $vechile_type == "61")
                {
                        $res = $this->pm->fetch_gc_model($vechile_type,$vechi_make);
                }
                else if($vechile_type == "20")
                {
                        $res = $this->pm->fetch_misc_model($vechi_make);
                }
                else if($vechile_type == "55")
                {
                    $res = $this->pm->fetch_scooter_model($vechi_make);
                }
                else if($vechile_type == "18")
                {
                    $res = $this->pm->fetch_ambulance_model($vechi_make);
                }
                echo json_encode($res);
            }
        }
        
        public function fetch_vechile_varient_arr()
        {
            if($this->session->has_userdata('logged_in'))
            {
                $vechile_type = $this->input->post("vechile_type");
                $vechi_make = $this->input->post("vechi_make");
                $vechi_model = $this->input->post("vechi_model");
                $res = array();
                if($vechile_type == "1" || $vechile_type == "3" || $vechile_type == "68")
                {
                    $res = $this->pm->fetch_car_varient($vechi_make,$vechi_model);
                }
                else if($vechile_type == "2")
                {
                    $res = $this->pm->fetch_bike_varient($vechi_make,$vechi_model);
                }
                else if($vechile_type == "4")
                {
                    $res = $this->pm->fetch_e_two_wheeler_varient($vechi_make,$vechi_model);
                }
                if($vechile_type == "7" || $vechile_type == "12" || $vechile_type == "13" || $vechile_type == "14" || $vechile_type == "59" || $vechile_type == "60" || $vechile_type == "65" || $vechile_type == "66" || $vechile_type == "69")
                {
                    $res = $this->pm->fetch_pc_varient($vechile_type,$vechi_make,$vechi_model);
                }
                else if($vechile_type == "8" || $vechile_type == "9" || $vechile_type == "10" || $vechile_type == "15" || $vechile_type == "16" || $vechile_type == "61")
                {
                    $res = $this->pm->fetch_gc_varient($vechile_type,$vechi_make,$vechi_model);
                }
                else if($vechile_type == "20")
                {
                    $res = $this->pm->fetch_misc_varient($vechi_make,$vechi_model);
                }
                else if($vechile_type == "55")
                {
                    $res = $this->pm->fetch_scooter_varient($vechi_make,$vechi_model);
                }
                else if($vechile_type == "18")
                {
                    $res = $this->pm->fetch_ambulance_varient($vechi_make,$vechi_model);
                }
                echo json_encode($res);
            }
        }
    
    
	    public function add_payout_entry()
	    {
	        if($this->session->has_userdata('logged_in'))
    	    {
        	     $insurer_company = $this->input->post("insurer_company");
                 $insurer_class = $this->input->post("insurer_class");
                 $business_type = $this->input->post("business_type");
                 $ird_od_commission = $this->input->post("ird_od_commission");
                 $ird_tp_commission = $this->input->post("ird_tp_commission");
                 $premium_c_type = $this->input->post("premium_c_type");
                 $policy_type = $this->input->post("policy_type");
                 $commission_type = $this->input->post("commission_type");
                 $add_type = $this->input->post("add_type");
                 $v_type = "";
                 
                 $make = explode(",",$this->input->post("make"));
                 $model = explode(",",$this->input->post("model"));
                 $varient = explode(",",$this->input->post("varient"));
                 
                 $fuel_type = $this->input->post("fuel_type");
                 $ins_classification = $this->input->post("ins_classification");
                 $ins_state = $this->input->post("ins_state");
                 $special_com = $this->input->post("special_com");
                 $add_agency = explode(",",$this->input->post("add_agency"));
                 
                 $ins_rto = explode(",",$this->input->post("ins_rto"));
                 $rto_category = $this->input->post("rto_category");
                 $vehicle_age_min = $this->input->post("vehicle_age_min");
                 $vehicle_age_max = $this->input->post("vehicle_age_max");
                 
                 // nop
                $no_policy_min = $this->input->post("no_policy_min");
                $no_policy_max = $this->input->post("no_policy_max");
                
                // min 
                
                $min_amount = $this->input->post("min_amount");
                $max_amount = $this->input->post("max_amount");
                

                if($no_policy_min == "undefined")
                {
                    $no_policy_min = "";
                }
                
                if($no_policy_max == "undefined")
                {
                    $no_policy_max = "";
                }
                
                if($min_amount == "undefined")
                {
                    $min_amount = "";
                }
                
                if($max_amount == "undefined")
                {
                    $max_amount = "";
                }
                
                if($ins_classification == "undefined")
                {
                    $ins_classification = "";
                }
                
                if($ins_classification == "null")
                {
                    $ins_classification = "";
                }
                
                $net_id = $this->input->post("net_id");
                
             
                 $agn_com_non_ncb = $this->input->post("agn_com_non_ncb");
                 $is_com_ncb= $this->input->post("is_com_ncb");
                
               // including
                $own_od= $this->input->post('own_od');
                $own_tp= $this->input->post('own_tp');
                $on_net= $this->input->post('on_net');
                 
                // Excluding
                $ncb_percentage= $this->input->post('ncb_percentage');
                $ird_com_od= $this->input->post('ird_com_od');
                $ird_com_tp= $this->input->post('ird_com_tp');
                 
                // 2023-07-20 start
                $is_com_cpa= $this->input->post("is_com_cpa");
                $cpa_percentage= $this->input->post('cpa_percentage');
                 
                 // OD Agent Commission
                 $a_od= $this->input->post('a_od');
                 $b_od= $this->input->post('b_od');
                 $c_od= $this->input->post('c_od');
                 $d_od= $this->input->post('d_od');
                 // Tp Agent Commission
                 
                 $a_tp= $this->input->post('a_tp');
                 $b_tp= $this->input->post('b_tp');
                 $c_tp= $this->input->post('c_tp');
                 $d_tp= $this->input->post('d_tp');
                 
                 // NET Agent Commission
                 $a_net= $this->input->post('a_net');
                 $b_net= $this->input->post('b_net');
                 $c_net= $this->input->post('c_net');
                 $d_net= $this->input->post('d_net');
                 
                 // NCB
                 $a_ncb= $this->input->post('a_ncb');
                 $b_ncb= $this->input->post('b_ncb');
                 $c_ncb= $this->input->post('c_ncb');
                 $d_ncb= $this->input->post('d_ncb');
                 
                 
                  $is_com_cpa= $this->input->post("is_com_cpa");
                  $cpa_percentage= $this->input->post('cpa_percentage');
                  
                 $a_cpa= $this->input->post('a_cpa');
                 $b_cpa= $this->input->post('b_cpa');
                 $c_cpa= $this->input->post('c_cpa');
                 $d_cpa= $this->input->post('d_cpa');
                  
                  
                 // no policy id
                 $v_make = "";
                 $v_model = "";
                 $v_varient = "";
                 
                 if(in_array("all",$make))
                 {
                     $v_make = "all";
                 }
                 if(in_array("all",$model))
                 {
                     $v_model = "all";
                 }
                 if(in_array("all",$varient))
                 {
                     $v_varient = "all";
                 }
                 
                    $no_policy_id = $this->input->post("no_policy_id");
                 
                     if($no_policy_id == "" || $no_policy_id == "undefined")
        	         {
        	             $no_policy_id = "";
        	         }
                     
                     if($net_id == "" || $net_id == "undefined")
                     {
                         $net_id = "";
                     }
                    
                   $f_date = $this->input->post("f_date");
                   $to_date = $this->input->post("to_date");
                   
                   // start 2023-08-17
                   $payout_type = $this->input->post("payout_type");
                   $payout_type = (empty($payout_type)) ? "Fresh" : $payout_type;
                   
                   
                   if($insurer_class == "1")
                   {
                       // 2023-07-18 start
                        $ird_commission = $this->input->post("ird_commission");
                        
                       $data = array(
                                 "insurer_company" =>$insurer_company,
                                 "policy_premium_type" =>$premium_c_type,
                                 "class" =>$insurer_class,
                                 "business_type" =>$business_type,
                                 "ird_od_commission" =>$ird_od_commission,
                                 "ird_tp_commission"=>$ird_tp_commission,
                                 "commission_type" =>$commission_type,
                                 "policy_type" =>$policy_type,
                                 "state"=>$ins_state,
                                 "fuel_type" =>$fuel_type,
                                 "rto_type" =>$rto_category,
                                 "classification" =>$ins_classification,
                                 "vehicle_age_min"=>$vehicle_age_min,
                                 "vehicle_age_max"=>$vehicle_age_max,
                                 "v_make" =>$v_make,
                                 "v_model" =>$v_model,
                                 "v_varient" =>$v_varient,
                                 "no_policy_min" =>$no_policy_min,
                                 "no_policy_max" =>$no_policy_max,
                                 "min_val" =>$min_amount,
                                 "max_val" =>$max_amount,
                                 "from_date" =>$f_date,
                                 "to_date"=>$to_date,
                                 "type" =>$add_type,
                                "own_od"=>$own_od,
                                "own_tp"=>$own_tp,
                                "on_net"=>$on_net,
                                "is_ncb"=>$is_com_ncb,
                                "agn_com_type"=>$agn_com_non_ncb,
                                "ncb_percentage"=>$ncb_percentage,
                                "is_cpa"=>$is_com_cpa,
                                "cpa_percentage"=>$cpa_percentage,
                                "irda_od"=>$ird_com_od,
                                "irda_tp"=>$ird_com_tp,
                                "a_od"=>$a_od,
                                "b_od"=>$b_od,
                                "c_od"=>$c_od,
                                "d_od"=>$d_od,
                                "a_tp"=>$a_tp,
                                "b_tp"=>$b_tp,
                                "c_tp"=>$c_tp,
                                "d_tp"=>$d_tp,
                                "a_net"=>$a_net,
                                "b_net"=>$b_net,
                                "c_net"=>$c_net,
                                "d_net"=>$d_net,
                                "a_ncb"=>$a_ncb,
                                "b_ncb"=>$b_ncb,
                                "c_ncb"=>$c_ncb,
                                "d_ncb"=>$d_ncb,
                                "a_cpa"=>$a_cpa,
                                "b_cpa"=>$b_cpa,
                                "c_cpa"=>$c_cpa,
                                "d_cpa"=>$d_cpa,
                                "no_of_policy_id" =>$no_policy_id,
                                "net_premium_id" =>$net_id,
                                "created_time" =>date("Y-m-d H:i:s"),
                                "created_by"=>$this->session->userdata('session_id'),
                                "ird_commission_percentage" => $ird_commission,
                                "payout_type" => $payout_type // start 2023-08-17
                              );
                   }
                   else
                   {
                        // 2023-05-25 start
                        $ird_commission = $this->input->post("ird_commission");
                        
                       $data = array(
                                 "insurer_company" =>$insurer_company,
                                 "class" =>$insurer_class,
                                 "business_type" =>$business_type,
                                 "commission_type" =>$commission_type,
                                 "policy_type" =>$policy_type,
                                 "state"=>$ins_state,
                                 "no_policy_min" =>$no_policy_min,
                                 "no_policy_max" =>$no_policy_max,
                                 "min_val" =>$min_amount,
                                 "max_val" =>$max_amount,
                                 "from_date" =>$f_date,
                                 "to_date"=>$to_date,
                                "on_net"=>$on_net,
                                "is_ncb"=>$is_com_ncb,
                                "ncb_percentage"=>$ncb_percentage,
                                "a_net"=>$a_net,
                                "b_net"=>$b_net,
                                "c_net"=>$c_net,
                                "d_net"=>$d_net,
                                "a_ncb"=>$a_ncb,
                                "b_ncb"=>$b_ncb,
                                "c_ncb"=>$c_ncb,
                                "d_ncb"=>$d_ncb,
                                "no_of_policy_id" =>$no_policy_id,
                                "net_premium_id" =>$net_id,
                                "created_time" =>date("Y-m-d H:i:s"),
                                "created_by"=>$this->session->userdata('session_id'),
                                "ird_commission_percentage" => $ird_commission,
                                "payout_type" => $payout_type // start 2023-08-17
                              );
                   }

                      $res = $this->pm->add_payout_commission($data);

                      if ($res) {
                            $this->audit->log('company_payout_commission', 'INSERT', null, null, $data);

                             // ✅ Auto apply payout to matching policies
                            $commission_data = array_merge($data, [
                                'id' => $res,
                                'company' => $data['insurer_company'] ?? 0 // Ensure 'company' exists
                            ]);

                            $applied = $this->pm->apply_new_commission_to_pending_policies($commission_data);
                            log_message('info', "✅ Auto-applied new payout (ID: $res) to $applied existing policies");
                        }


                      $date = date("Y-m-d H:i:s");
                      
                      
                 for($i=0;$i<count($add_agency);$i++)
                                  {      
                      $data_agency = array(
                                    "commission_id" =>$res,
                                    "special_com" =>$special_com,
                                 "agent_id" =>$add_agency[$i],
                                  "from_date" =>$f_date,
                                 "to_date"=>$to_date,
                                 "created_time" =>date("Y-m-d H:i:s"),
                                "created_by"=>$this->session->userdata('session_id'),
                              );
                              
                      $res_agency = $this->pm->add_agents_special_com($data_agency);
                      if($res_agency){
                              $this->audit->log('agent_special_com', 'INSERT', null, null, $data_agency);
                          }
                     }
                                         
                
                    if($insurer_class == "1")
                    {
                           if(!in_array("all",$make))
                           {
                                  for($i=0;$i<count($make);$i++)
                                  {
                                        $make_arr = array(
                                                        "commission_id" =>$res,
                                                        "policy_type" =>$policy_type,
                                                        "make" =>$make[$i],
                                                        "created_by" =>$this->session->userdata("session_id"),
                                                        "created_date" =>date("Y-m-d H:i:s"),
                                                    );
                                        $add_make = $this->pm->add_make_list($make_arr);
                                        if($add_make){
                                            $this->audit->log('com_make_log', 'INSERT', null, null, $make_arr);
                                        }
                                  }
                           }
                             
                           if(!in_array("all",$model))
                           {
                             for($i=0;$i<count($model);$i++)
                             {
                                    if($policy_type == "1" || $policy_type == "3")
                                    {
                                        $get_make_id =$this->pm->get_car_make_id($model[$i]);
                                        
                                        $model_arr = array(
                                                        "commission_id" =>$res,
                                                        "policy_type" =>$policy_type,
                                                        "make_id" =>$get_make_id,
                                                         "model_id" =>$model[$i],
                                                        "created_by" =>$this->session->userdata("session_id"),
                                                        "created_date" =>date("Y-m-d H:i:s"),
                                                    );
                                        $model_add = $this->pm->add_model_list($model_arr);
                                        if($model_add){
                                            $this->audit->log('com_model_log', 'INSERT', null, null, $model_arr);
                                        }
                                    }
                                    else if($policy_type == "2")
                                    {
                                        $get_make_id =$this->pm->get_bike_make_id($model[$i]);
                                        
                                        $model_arr = array(
                                                        "commission_id" =>$res,
                                                        "policy_type" =>$policy_type,
                                                        "make_id" =>$get_make_id,
                                                         "model_id" =>$model[$i],
                                                        "created_by" =>$this->session->userdata("session_id"),
                                                        "created_date" =>date("Y-m-d H:i:s"),
                                                    );
                                        $model_add = $this->pm->add_model_list($model_arr);
                                        if($model_add){
                                            $this->audit->log('com_model_log', 'INSERT', null, null, $model_arr);
                                        }
                                    }
                                    else if($policy_type == "4")
                                    {
                                        $get_make_id =$this->pm->get_e_two_wheeler_make_id($model[$i]);
                                        
                                        $model_arr = array(
                                                        "commission_id" =>$res,
                                                        "policy_type" =>$policy_type,
                                                        "make_id" =>$get_make_id,
                                                         "model_id" =>$model[$i],
                                                        "created_by" =>$this->session->userdata("session_id"),
                                                        "created_date" =>date("Y-m-d H:i:s"),
                                                    );
                                        $model_add = $this->pm->add_model_list($model_arr);
                                        if($model_add){
                                            $this->audit->log('com_model_log', 'INSERT', null, null, $model_arr);
                                        }
                                    }
                                   
                                    else if($policy_type == "7")
                                    {
                                        $get_make_id =$this->pm->get_pc_make_id($model[$i]);
                                        
                                        $model_arr = array(
                                                        "commission_id" =>$res,
                                                        "policy_type" =>$policy_type,
                                                        "make_id" =>$get_make_id,
                                                         "model_id" =>$model[$i],
                                                        "created_by" =>$this->session->userdata("session_id"),
                                                        "created_date" =>date("Y-m-d H:i:s"),
                                                    );
                                        $model_add = $this->pm->add_model_list($model_arr);
                                        if($model_add){
                                            $this->audit->log('com_model_log', 'INSERT', null, null, $model_arr);
                                        }
                                    }
                                    
                                    else if($policy_type == "8" || $policy_type == "9" || $policy_type == "10" || $policy_type == "15" || $policy_type == "16" || $policy_type == "61")
                                    {
                                        $get_make_id =$this->pm->get_gc_make_id($model[$i],$policy_type);
                                        
                                        $model_arr = array(
                                                        "commission_id" =>$res,
                                                        "policy_type" =>$policy_type,
                                                        "make_id" =>$get_make_id,
                                                         "model_id" =>$model[$i],
                                                        "created_by" =>$this->session->userdata("session_id"),
                                                        "created_date" =>date("Y-m-d H:i:s"),
                                                    );
                                        $model_add = $this->pm->add_model_list($model_arr);
                                        if($model_add){
                                            $this->audit->log('com_model_log', 'INSERT', null, null, $model_arr);
                                        }
                                    }
                                    
                                    else if($policy_type == "20")
                                    {
                                        $get_make_id =$this->pm->get_misc_make_id($model[$i]);
                                        
                                        $model_arr = array(
                                                        "commission_id" =>$res,
                                                        "policy_type" =>$policy_type,
                                                        "make_id" =>$get_make_id,
                                                         "model_id" =>$model[$i],
                                                        "created_by" =>$this->session->userdata("session_id"),
                                                        "created_date" =>date("Y-m-d H:i:s"),
                                                    );
                                        $model_add = $this->pm->add_model_list($model_arr);
                                        if($model_add){
                                            $this->audit->log('com_model_log', 'INSERT', null, null, $model_arr);
                                        }
                                    }
                                    
                                    else if($policy_type == "55")
                                    {
                                        $get_make_id =$this->pm->get_scooter_make_id($model[$i]);
                                        
                                        $model_arr = array(
                                                        "commission_id" =>$res,
                                                        "policy_type" =>$policy_type,
                                                        "make_id" =>$get_make_id,
                                                         "model_id" =>$model[$i],
                                                        "created_by" =>$this->session->userdata("session_id"),
                                                        "created_date" =>date("Y-m-d H:i:s"),
                                                    );
                                        $model_add = $this->pm->add_model_list($model_arr);
                                        if($model_add){
                                            $this->audit->log('com_model_log', 'INSERT', null, null, $model_arr);
                                        }
                                    }
                              }
                            }
        
                          if(!in_array("all",$varient))
                          {
                                  for($i=0;$i<count($varient);$i++)
                                  {
                                        if($policy_type == "1" || $policy_type == "3")
                                        {
                                            $get_id =$this->pm->get_car_model_varient_id($varient[$i]);
                                            
                                            $varient_arr = array(
                                                                 "commission_id" =>$res,
                                                                 "policy_type" =>$policy_type,
                                                                 "make_id" =>$get_id->brand_id,
                                                                 "model_id" =>$get_id->model_id,
                                                                 "varient_id" =>$varient[$i],
                                                                 "created_by" =>$this->session->userdata("session_id"),
                                                                 "created_date" =>date("Y-m-d H:i:s"),
                                                        );
                                            $add_varient = $this->pm->add_varient_list($varient_arr);
                                            if($add_varient){
                                                $this->audit->log('com_varient_log', 'INSERT', null, null, $varient_arr);
                                            }
                                        }
                                        else if($policy_type == "2" || $policy_type == "4")
                                        {
                                            $get_id =$this->pm->get_bike_model_varient_id($varient[$i]);
                                            
                                            $varient_arr = array(
                                                            "commission_id" =>$res,
                                                            "policy_type" =>$policy_type,
                                                            "make_id" =>$get_id->brand_id,
                                                            "model_id" =>$get_id->model_id,
                                                            "varient_id" =>$varient[$i],
                                                            "created_by" =>$this->session->userdata("session_id"),
                                                            "created_date" =>date("Y-m-d H:i:s"),
                                                        );
                                            $add_varient = $this->pm->add_varient_list($varient_arr);
                                            if($add_varient){
                                                $this->audit->log('com_varient_log', 'INSERT', null, null, $varient_arr);
                                            }
                                        }
                                        else if($policy_type == "4")
                                        {
                                            $get_id =$this->pm->get_e_two_wheeler_model_varient_id($varient[$i]);
                                            
                                            $varient_arr = array(
                                                            "commission_id" =>$res,
                                                            "policy_type" =>$policy_type,
                                                            "make_id" =>$get_id->brand_id,
                                                            "model_id" =>$get_id->model_id,
                                                            "varient_id" =>$varient[$i],
                                                            "created_by" =>$this->session->userdata("session_id"),
                                                            "created_date" =>date("Y-m-d H:i:s"),
                                                        );
                                            $add_varient = $this->pm->add_varient_list($varient_arr);
                                            if($add_varient){
                                                $this->audit->log('com_varient_log', 'INSERT', null, null, $varient_arr);
                                            }
                                        }
                                        else if($policy_type == "7")
                                        {
                                            $get_id =$this->pm->get_pc_model_varient_id($varient[$i]);
                                            
                                            $varient_arr = array(
                                                            "commission_id" =>$res,
                                                            "policy_type" =>$policy_type,
                                                            "make_id" =>$get_id->brand_id,
                                                            "model_id" =>$get_id->model_id,
                                                             "varient_id" =>$varient[$i],
                                                            "created_by" =>$this->session->userdata("session_id"),
                                                            "created_date" =>date("Y-m-d H:i:s"),
                                                        );
                                            $add_varient = $this->pm->add_varient_list($varient_arr);
                                            if($add_varient){
                                                $this->audit->log('com_varient_log', 'INSERT', null, null, $varient_arr);
                                            }
                                        }
                                        
                                        else if($policy_type == "8" || $policy_type == "9" || $policy_type == "10" || $policy_type == "15" || $policy_type == "16" || $policy_type == "61")
                                        {
                                            $get_id =$this->pm->get_gc_model_varient_id($varient[$i]);
                                            
                                            $varient_arr = array(
                                                            "commission_id" =>$res,
                                                            "policy_type" =>$policy_type,
                                                            "make_id" =>$get_id->brand_id,
                                                            "model_id" =>$get_id->model_id,
                                                             "varient_id" =>$varient[$i],
                                                            "created_by" =>$this->session->userdata("session_id"),
                                                            "created_date" =>date("Y-m-d H:i:s"),
                                                        );
                                            $add_varient = $this->pm->add_varient_list($varient_arr);
                                            if($add_varient){
                                                $this->audit->log('com_varient_log', 'INSERT', null, null, $varient_arr);
                                            }
                                        }
                                        
                                        else if($policy_type == "20")
                                        {
                                            $get_id =$this->pm->get_misc_model_varient_id($varient[$i]);
                                            
                                            $varient_arr = array(
                                                            "commission_id" =>$res,
                                                            "policy_type" =>$policy_type,
                                                            "make_id" =>$get_id->brand_id,
                                                            "model_id" =>$get_id->model_id,
                                                             "varient_id" =>$varient[$i],
                                                            "created_by" =>$this->session->userdata("session_id"),
                                                            "created_date" =>date("Y-m-d H:i:s"),
                                                        );
                                            $add_varient = $this->pm->add_varient_list($varient_arr);
                                            if($add_varient){
                                                $this->audit->log('com_varient_log', 'INSERT', null, null, $varient_arr);
                                            }
                                        }
                                        else if($policy_type == "55")
                                        {
                                            $get_id =$this->pm->get_scooter_model_varient_id($varient[$i]);
                                            
                                            $varient_arr = array(
                                                            "commission_id" =>$res,
                                                            "policy_type" =>$policy_type,
                                                            "make_id" =>$get_id->brand_id,
                                                            "model_id" =>$get_id->model_id,
                                                             "varient_id" =>$varient[$i],
                                                            "created_by" =>$this->session->userdata("session_id"),
                                                            "created_date" =>date("Y-m-d H:i:s"),
                                                        );
                                            $add_varient = $this->pm->add_varient_list($varient_arr);
                                            if($add_varient){
                                                $this->audit->log('com_varient_log', 'INSERT', null, null, $varient_arr);
                                            }
                                        }
                                    }
                                }
                        
                          if($rto_category == "ROTN_Exclude")
                          {
                              $get_rto = $this->pm->get_rto($ins_rto);
                              
                              foreach($get_rto as $da)
                              {
                                    $rto_arr = array(
                                            "commission_id" =>$res,
                                            "rto" =>$da->rto_no,
                                            "created_time" =>date("Y-m-d H:i:s"),
                                            );
                                            
                                    $add_rto = $this->pm->add_rto_log($rto_arr);
                                    if($add_rto){
                                        $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                    }
                              }
                          }
                          else if($rto_category == "KA_Exclude")
                          {
                              $get_rto = $this->pm->get_rto_ka($ins_rto);
                              
                              foreach($get_rto as $da)
                              {
                                    $rto_arr = array(
                                            "commission_id" =>$res,
                                            "rto" =>$da->rto_no,
                                            "created_time" =>date("Y-m-d H:i:s"),
                                            );
                                            
                                    $add_rto = $this->pm->add_rto_log($rto_arr);
                                    if($add_rto){
                                        $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                    }
                              }
                          }
                          else
                          {
                              if(in_array('chennai',$ins_rto) || in_array('Coimbatore',$ins_rto) || in_array('Madurai',$ins_rto))
                              {
                                              $city_rto = $this->pm->get_city_rto($ins_rto);
                                               
                                              for($i=0;$i<=count($ins_rto);$i++)
                                          	  {
                                          	            if(in_array("chennai",$ins_rto))
                                          	            {
                                          	                  unset($ins_rto[$i]);
                                          	            }
                                          	            else if(in_array("Coimbatore",$ins_rto))
                                          	            {
                                          	                unset($ins_rto[$i]);
                                          	            }
                                          	            else if(in_array("Madurai",$ins_rto))
                                          	            {
                                          	                unset($ins_rto[$i]);
                                          	            }
                                          	     }
                                          	     
                                          	   $get_rto = $this->pm->get_rto_no($ins_rto);
                                            
                                               foreach($city_rto as $da)
                                               {
                                                      $rto_arr = array(
                                                            "commission_id" =>$res,
                                                            "rto" =>$da->rto_no,
                                                            "created_time" =>date("Y-m-d H:i:s"),
                                                            );
                                                            
                                                        $add_rto = $this->pm->add_rto_log($rto_arr);
                                                        if($add_rto){
                                                            $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                                        }
                                               }
                                           
                                               if($get_rto != null)
                                               {
                                                   foreach($get_rto as $da)
                                                   {
                                                        $rto_arr = array(
                                                                "commission_id" =>$res,
                                                                "rto" =>$da->rto_no,
                                                                "created_time" =>date("Y-m-d H:i:s"),
                                                                );
                                                                
                                                            $add_rto = $this->pm->add_rto_log($rto_arr);
                                                            if($add_rto){
                                                                $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                                            }
                                                   }
                                               }
                                }
                               else if(in_array("ROTN",$ins_rto))
                               {
                                   $get_rotn_rto = $this->pm->get_rotn_rto();
                                   
                                   foreach($get_rotn_rto as $da)
                                   {
                                        $rto_arr = array(
                                            "commission_id" =>$res,
                                            "rto" =>$da->rto_no,
                                            "created_time" =>date("Y-m-d H:i:s"),
                                            );
                                            
                                        $add_rto = $this->pm->add_rto_log($rto_arr);
                                        if($add_rto){
                                            $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                        }
                                   }
                               }
                               else if(in_array("All TN",$ins_rto))
                               {
                                   $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                                   
                                   foreach($get_all_tn_rto as $da)
                                   {
                                       $rto_arr = array(
                                                "commission_id" =>$res,
                                                "rto" =>$da->rto_no,
                                                "created_time" =>date("Y-m-d H:i:s"),
                                                );
                                      $add_rto = $this->pm->add_rto_log($rto_arr);      
                                      if($add_rto){
                                            $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                        }
                                   }
                               }
                               else if(in_array("All KA",$ins_rto))
                               {
                                   $get_all_ka_rto = $this->pm->get_all_ka_rto_list();
                                   
                                   foreach($get_all_ka_rto as $da)
                                   {
                                       $rto_arr = array(
                                                "commission_id" =>$res,
                                                "rto" =>$da->rto_no,
                                                "created_time" =>date("Y-m-d H:i:s"),
                                                );
                                      $add_rto = $this->pm->add_rto_log($rto_arr);      
                                      if($add_rto){
                                            $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                        }
                                   }
                               }
                               else if(in_array("All RTO",$ins_rto))
                               {
                                   $get_all_rto = $this->pm->get_all_rto_list();
                                   
                                   foreach($get_all_rto as $da)
                                   {
                                   $rto_arr = array(
                                            "commission_id" =>$res,
                                            "rto" =>$da->rto_no,
                                            "created_time" =>date("Y-m-d H:i:s"),
                                            );
                                      $add_rto = $this->pm->add_rto_log($rto_arr);
                                      if($add_rto){
                                            $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                        }
                                   }
                               }
                               else if(in_array('Bangalore',$ins_rto))
                               {
                                    $city_rto = $this->pm->get_ka_city_rto($ins_rto);
                                    
                                    for($i=0;$i<=count($ins_rto);$i++)
                                    {
                                      if(in_array("Bangalore",$ins_rto))
                                      {
                                            unset($ins_rto[$i]);
                                      }
                                    }
                                          	     
                                    $get_rto = $this->pm->get_rto_no($ins_rto);
                                    
                                    foreach($city_rto as $da)
                                    {
                                        $rto_arr = array(
                                            "commission_id" =>$res,
                                            "rto" =>$da->rto_no,
                                            "created_time" =>date("Y-m-d H:i:s"),
                                            );
                                            
                                        $add_rto = $this->pm->add_rto_log($rto_arr);
                                        if($add_rto){
                                            $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                        }
                                    }
                                    
                                    if($get_rto != null)
                                    {
                                        foreach($get_rto as $da)
                                        {
                                            $rto_arr = array(
                                                    "commission_id" =>$res,
                                                    "rto" =>$da->rto_no,
                                                    "created_time" =>date("Y-m-d H:i:s"),
                                                    );
                                                    
                                                $add_rto = $this->pm->add_rto_log($rto_arr);
                                                if($add_rto){
                                                    $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                                }
                                        }
                                    }
                                }
                               else
                               {
                                    for($i=0;$i<count($ins_rto);$i++)
                                    {
                                        $rto_arr = array(
                                        "commission_id" =>$res,
                                        "rto" =>$ins_rto[$i],
                                        "created_time" =>date("Y-m-d H:i:s"),
                                        );
                                        $add_rto = $this->pm->add_rto_log($rto_arr);
                                        if($add_rto){
                                            $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                        }
                                    }
                               }
                          }
                    }
                  
                  echo json_encode(array("status"=>"success","last_id" =>$res));
    	    }
	    }
	    
	    public function check_payout_entry_already_exits()
	    {
	        if($this->session->has_userdata('logged_in'))
    	    {
    	         $insurer_company = $this->input->post("insurer_company");
                 $insurer_class = $this->input->post("insurer_class");
                 $business_type = $this->input->post("business_type");
                 $premium_c_type = $this->input->post("premium_c_type");
                 $policy_type = $this->input->post("policy_type");
                 $commission_type = $this->input->post("commission_type");
                 $add_type = $this->input->post("add_type");
                 $v_type = "";
                 
                 $make = explode(",",$this->input->post("make"));
                 $model = explode(",",$this->input->post("model"));
                 $varient = explode(",",$this->input->post("varient"));
                 
                 $fuel_type = $this->input->post("fuel_type");
                 $ins_classification = $this->input->post("ins_classification");
                 $ins_state = $this->input->post("ins_state");
                 $ins_rto = explode(",",$this->input->post("ins_rto"));
                 $rto_category = $this->input->post("rto_category");
                 $vehicle_age_min = $this->input->post("vehicle_age_min");
                 $vehicle_age_max = $this->input->post("vehicle_age_max");

                // nop
                $no_policy_min = $this->input->post("no_policy_min");
                $no_policy_max = $this->input->post("no_policy_max");
                
                // target amount
                $min_amount = $this->input->post("min_amount");
                $max_amount = $this->input->post("max_amount");
                
                $f_date = $this->input->post("f_date");
                $to_date = $this->input->post("to_date");
                
                // start 2023-08-17
                $payout_type = $this->input->post("payout_type");
               
                 $commission_id = [];
                 
                 $g_status = "0";
                 
                 $status = "0";
                 $make_status = "0";
                 $model_status = "0";
                 $varient_status = "0";
                 $rto_status = "0";
                 $fuel_status = "0";
                 $gvw_status = "0";
                 
                 $fuel_type_status = "0";
                 
                 $com_policy_id = "";
               
               if($insurer_class == "1")  
               {
                 if($commission_type == "2")
                 {
                    $check = $this->pm->check_vechi_age_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type, $payout_type);
    	            
                	    foreach($check as $da)
                		{
                    		    $temp_min = $da->vehicle_age_min;
                    		    $temp_max = $da->vehicle_age_max;
                    		    
                    		    $g_status = "0";
                    		    
                		        $fuel_status = "0";
                    		    
                    		    if($temp_min <= $vehicle_age_min && $temp_max >= $vehicle_age_min)
                				{
                					$g_status = "1";
                				}
                				if($temp_min <= $vehicle_age_max && $temp_max >= $vehicle_age_max)
                				{
                					$g_status = "1";
                				}
                				if($temp_min > $vehicle_age_min && $temp_max < $vehicle_age_max)
                				{
                					$g_status = "1";
                				}
                				
                				
                        		    if($fuel_type == "1")
                        		    {
                        				if($da->fuel_type == "4" || $da->fuel_type == "1")
                        				{
                        				    $fuel_status = "1";
                        				}
                        			}
                        			if($fuel_type == "2")
                        			{
                        			    if($da->fuel_type == "5" || $da->fuel_type == "2")
                        				{
                        				    $fuel_status = "1";
                        				}
                        			}
                        			if($fuel_type == "5")
                        			{
                        			    if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2")
                        				{
                        				    $fuel_status = "1";
                        				}
                        			}
                        			if($fuel_type == "6")
                        			{
                        			    if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                        				{
                        				    $fuel_status = "1";
                        				}
                        			}
                        			if($fuel_type == "7")
                        			{
                        			    if($da->fuel_type == "7")
                        				{
                        				    $fuel_status = "1";
                        				}
                        			}
                        		
                        			if($g_status == "1" && $fuel_status == "1")
                        			{
                        			    $commission_id[] = $da->id;
                        			    $status = "1";
                	                    $fuel_type_status = "1";
                        			}
                		      }
                		      
                        if($status == "1")
                        {
                            if($ins_classification != "")
                            {
                               $classification = $this->pm->get_classification($commission_id,$ins_classification,$policy_type);
                            
                                if(count($classification > 0))
                                {
                                   $commission_id = [];
                                   
                                   foreach($classification as $da)
                                   {
                                       $commission_id[] = $da->id;
                                   }
                                   
                                   $gvw_status = "1";
                                }
                            }
                            else
                            {
                               $commission_id = [];
                               $gvw_status = "1";
                            }
                            
                            $check_make = $this->pm->check_make_all_already_exits($commission_id,$policy_type);
                            
                            if(count($check_make) > 0)
                            {
                                $commission_id = [];
                                
                                foreach($check_make as $da)
                                {
                                     $commission_id[] = $da->id;
                                }
                                
                                $status = "1";
                                $make_status = "1";
                            }
                            else
                            {
                                 $check_make_1 = $this->pm->check_make_already_exits($commission_id,$policy_type,$make);
                                    
                                    if(count($check_make_1) > 0)
                                    {
                                        $commission_id = [];
                                        
                                        foreach($check_make as $da)
                                        {
                                             $commission_id[] = $da->commission_id;
                                        }
                                
                                        $status = "1";
                                        $make_status = "1";
                                    }
                                    else
                                    {
                                        $make_status = "0";
                                    }
                            }
                                
                            if($make_status == "1")
                            {
                                $check_model = $this->pm->check_model_all_already_exits($commission_id,$policy_type);
                                
                                if(count($check_model) > 0)
                                {
                                        $commission_id = [];
                                        foreach($check_make as $da)
                                        {
                                             $commission_id[] = $da->id;
                                        }
                                     $status = "1";
                                     $model_status = "1";
                                }
                                else
                                {
                                    $check_model_1 = $this->pm->check_model_already_exits($commission_id,$policy_type,$make,$model);
                                    
                                    if(count($check_model_1) > 0)
                                    {
                                            $commission_id = [];
                                            foreach($check_make as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                                         $status = "1";
                                         $model_status = "1";
                                    }
                                    else
                                    {
                                        $model_status = "0";
                                    }
                                }
                            }
                            
                            if($make_status == "1" && $model_status == "1")
                            {
                                $check_varient = $this->pm->check_varient_all_already_exits($commission_id,$policy_type);
                              
                                if(count($check_varient) > 0)
                                {
                                    $commission_id = [];
                                    foreach($check_make as $da)
                                    {
                                         $commission_id[] = $da->id;
                                    }
                                     $status = "1";
                        	         $varient_status = "1";
                                }
                                else 
                                {
                                  $check_varient_1 = $this->pm->check_varient_already_exits($commission_id,$policy_type,$make,$model,$varient);
                    	           
                    	            if(count($check_varient_1) > 0)
                    	            {
                        	            $commission_id = [];
                                        foreach($check_make as $da)
                                        {
                                             $commission_id[] = $da->commission_id;
                                        }
                    	                 $status = "1";
                    	                 $varient_status = "1";
                    	            }
                    	            else
                    	            {
                    	                 $varient_status = "0";
                    	            }
                                }
                            }
                            
                           $ins_rto_1 = []; 
                            
                            if($status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                            {
                                  if($rto_category == "ROTN_Exclude")
                                  {
                                      $get_rto = $this->pm->get_rto($ins_rto);
                                      
                                      foreach($get_rto as $da)
                                      {
                                           $ins_rto_1[] = $da->rto_no;
                                      }
                                      
                                       $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                      
                                        if(count($check_rto) > 0)
                                        {
                                            $rto_status = "1";
                                            echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                        }
                                        else
                                        {
                                            echo json_encode(array("status"=>"success"));
                                        }
                                  }
                                  else
                                  {
                                       if(in_array('chennai',$ins_rto) || in_array('Coimbatore',$ins_rto) || in_array('Madurai',$ins_rto))
                                       {
                                           $city_rto = $this->pm->get_city_rto($ins_rto);
                                           
                                          for($i=0;$i<=count($ins_rto);$i++)
                                      	  {
                                      	            if(in_array("chennai",$ins_rto))
                                      	            {
                                      	                  unset($ins_rto[$i]);
                                      	            }
                                      	            else if(in_array("Coimbatore",$ins_rto))
                                      	            {
                                      	                unset($ins_rto[$i]);
                                      	            }
                                      	            else if(in_array("Madurai",$ins_rto))
                                      	            {
                                      	                unset($ins_rto[$i]);
                                      	            }
                                      	     }
                                      	     
                                      	   $get_rto = $this->pm->get_rto_no($ins_rto);
                                        
                                           foreach($city_rto as $da)
                                           {
                                               $ins_rto_1[] = $da->rto_no;
                                           }
                                         
                                          if($get_rto != null)
                                          {
                                               foreach($get_rto as $da)
                                               {
                                                    $ins_rto_1[] = $da->rto_no;
                                               }
                                          }
                                          
                                           $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                          
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                                echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                            }
                                            else
                                            {
                                                echo json_encode(array("status"=>"success"));
                                            }
                                       }
                                       else if(in_array("ROTN",$ins_rto))
                                       {
                                           $get_rotn_rto = $this->pm->get_rotn_rto();
                                           
                                           foreach($get_rotn_rto as $da)
                                           {
                                                $ins_rto_1[] = $da->rto_no;
                                           }
                                           
                                           $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                           
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                                echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                            }
                                            else
                                            {
                                                echo json_encode(array("status"=>"success"));
                                            }
                                       }
                                       else if(in_array("All TN",$ins_rto))
                                       {
                                            $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                                            
                                               foreach($get_all_tn_rto as $da)
                                               {
                                                    $ins_rto_1[] = $da->rto_no;
                                               }
                                            $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                            
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                                echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                            }
                                            else
                                            {
                                                echo json_encode(array("status"=>"success"));
                                            }
                                       }
                                       else if(in_array("All RTO",$ins_rto))
                                       {
                                           $get_all_rto = $this->pm->get_all_rto_list();
                                           
                                           foreach($get_all_rto as $da)
                                           {
                                                  $ins_rto_1[] = $da->rto_no;
                                           }
                                           
                                            $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                            
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                                echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                            }
                                            else
                                            {
                                                echo json_encode(array("status"=>"success"));
                                            }
                                       }
                                       else
                                       {
                                            $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto);
                                            
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                                echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                            }
                                            else
                                            {
                                               echo json_encode(array("status"=>"success"));
                                            }
                                        }
                                  }
                            }
                            else
                            {
                                echo json_encode(array("status"=>"success"));
                            }
                        }
                        else
                        {
                           echo json_encode(array("status"=>"success"));
                        }
                  }
                 else if($commission_type == "1")
                 {
                     $check =$this->pm->check_this_com_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type);
                      
                       foreach($check as $da)
                	   {
                	            $g_status = "0";
                	            $fuel_status = "0";
                	            
                                $temp_min = $da->no_policy_min;
                				$temp_max = $da->no_policy_max;
                				
                				if($temp_min <= $no_policy_min && $temp_max >= $no_policy_min)
                				{
                					$g_status = "1";
                				}
                				if($temp_min <= $no_policy_max && $temp_max >= $no_policy_max)
                				{
                					$g_status = "1";
                				}
                				if($temp_min > $no_policy_min && $temp_max < $no_policy_max)
                				{
                					$g_status = "1";
                				}
    
                                if($fuel_type == "1")
                                {
                                	if($da->fuel_type == "4" || $da->fuel_type == "1")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                                if($fuel_type == "2")
                                {
                                    if($da->fuel_type == "5" || $da->fuel_type == "2")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                                if($fuel_type == "5")
                                {
                                    if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                                if($fuel_type == "6")
                                {
                                    if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                                if($fuel_type == "7")
                                {
                                    if($da->fuel_type == "7")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                    			
                    			if($g_status == "1" && $fuel_status == "1")
                        	    {
                        			    $commission_id[] = $da->id;
                        			    $status = "1";
                	                    $fuel_type_status = "1";
                        		}
                            }
                       
                        if($status == "1")
                        {
                            if($ins_classification != "")
                            {
                               $classification = $this->pm->get_classification($commission_id,$ins_classification,$policy_type);
                            
                                if(count($classification > 0))
                                {
                                   $commission_id = [];
                                   
                                   foreach($classification as $da)
                                   {
                                       $commission_id[] = $da->id;
                                   }
                                   
                                   $gvw_status = "1";
                                }
                            }
                            else
                            {
                               $commission_id = [];
                               $gvw_status = "1";
                            }
                                    
                            $check_make = $this->pm->check_make_all_already_exits($commission_id,$policy_type);
                            
                            if(count($check_make) > 0)
                            {
                                $commission_id = [];
                                
                                foreach($check_make as $da)
                                {
                                     $commission_id[] = $da->id;
                                }
                                $make_status = "1";
                            }
                            else
                            {
                                 $check_make_1 = $this->pm->check_make_already_exits($commission_id,$policy_type,$make);
                                    
                                    if(count($check_make_1) > 0)
                                    {
                                        $commission_id = [];
                                        
                                        foreach($check_make as $da)
                                        {
                                             $commission_id[] = $da->commission_id;
                                        }
                                
                                        $make_status = "1";
                                    }
                                    else
                                    {
                                        $make_status = "0";
                                    }
                            }
                                
                            if($make_status == "1")
                            {
                                $check_model = $this->pm->check_model_all_already_exits($commission_id,$policy_type);
                                
                                if(count($check_model) > 0)
                                {
                                        $commission_id = [];
                                        
                                        foreach($check_make as $da)
                                        {
                                             $commission_id[] = $da->id;
                                        }
                                        
                                     $model_status = "1";
                                }
                                else
                                {
                                    $check_model_1 = $this->pm->check_model_already_exits($commission_id,$policy_type,$make,$model);
                                    
                                    if(count($check_model_1) > 0)
                                    {
                                            $commission_id = [];
                                            
                                            foreach($check_make as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                                            
                                         $model_status = "1";
                                    }
                                    else
                                    {
                                        $model_status = "0";
                                    }
                                }
                            }
                            
                            if($make_status == "1" && $model_status == "1")
                            {
                                $check_varient = $this->pm->check_varient_all_already_exits($commission_id,$policy_type);
                              
                                if(count($check_varient) > 0)
                                {
                                    $commission_id = [];
                                    foreach($check_make as $da)
                                    {
                                         $commission_id[] = $da->id;
                                    }
                        	         $varient_status = "1";
                                }
                                else 
                                {
                                  $check_varient_1 = $this->pm->check_varient_already_exits($commission_id,$policy_type,$make,$model,$varient);
                    	           
                    	            if(count($check_varient_1) > 0)
                    	            {
                        	            $commission_id = [];
                        	            
                                        foreach($check_make as $da)
                                        {
                                             $commission_id[] = $da->commission_id;
                                        }
                                        
                    	                 $status = "1";
                    	                 
                    	                 $varient_status = "1";
                    	                 
                    	            }
                    	            else
                    	            {
                    	                 $varient_status = "0";
                    	            }
                                }
                            }
                        
                            $ins_rto_1 = []; 
                        
                            if($status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                            {
                                $rto_status = '0';
                             
                                 if($rto_category == "ROTN_Exclude")
                                  {
                                      $get_rto = $this->pm->get_rto($ins_rto);
                                      
                                      foreach($get_rto as $da)
                                      {
                                           $ins_rto_1[] = $da->rto_no;
                                      }
                                      
                                       $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                      
                                        if(count($check_rto) > 0)
                                        {
                                            $rto_status = "1";
                                        }
                                  }
                                  else
                                  {
                                      if(in_array('chennai',$ins_rto) || in_array('Coimbatore',$ins_rto) || in_array('Madurai',$ins_rto))
                                       {
                                           $city_rto = $this->pm->get_city_rto($ins_rto);
                                           
                                          for($i=0;$i<=count($ins_rto);$i++)
                                      	  {
                                      	            if(in_array("chennai",$ins_rto))
                                      	            {
                                      	                  unset($ins_rto[$i]);
                                      	            }
                                      	            else if(in_array("Coimbatore",$ins_rto))
                                      	            {
                                      	                unset($ins_rto[$i]);
                                      	            }
                                      	            else if(in_array("Madurai",$ins_rto))
                                      	            {
                                      	                unset($ins_rto[$i]);
                                      	            }
                                      	     }
                                      	     
                                      	   $get_rto = $this->pm->get_rto_no($ins_rto);
                                        
                                           foreach($city_rto as $da)
                                           {
                                               $ins_rto_1[] = $da->rto_no;
                                           }
                                           
                                           foreach($get_rto as $da)
                                           {
                                                $ins_rto_1[] = $da->rto_no;
                                           }
                                           
                                           $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                          
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                                echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                            }
                                            else
                                            {
                                                echo json_encode(array("status"=>"success"));
                                            }
                                       }
                                       else if(in_array("ROTN",$ins_rto))
                                       {
                                           $get_rotn_rto = $this->pm->get_rotn_rto();
                                           
                                           foreach($get_rotn_rto as $da)
                                           {
                                                $ins_rto_1[] = $da->rto_no;
                                           }
                                           $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                           
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                            }
                                       }
                                       else if(in_array("All TN",$ins_rto))
                                       {
                                            $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                                            
                                               foreach($get_all_tn_rto as $da)
                                               {
                                                    $ins_rto_1[] = $da->rto_no;
                                               }
                                            $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                            
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                            }
                                       }
                                       else if(in_array("All RTO",$ins_rto))
                                       {
                                           $get_all_rto = $this->pm->get_all_rto_list();
                                           
                                           foreach($get_all_rto as $da)
                                           {
                                                  $ins_rto_1[] = $da->rto_no;
                                           }
                                           
                                            $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                            
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                            }
                                       }
                                       else
                                       {
                                            $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto);
                                            
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                            }
                                        }
                                  }
                                    
                                    if($rto_status == "0")
                                    {
                                           $last_policy_id = $this->pm->get_last_policy_id();
                                           
                                            if($last_policy_id == "")
                                            {
                                                    $com_policy_id = "1";
                                                    $arr = array("policy_id" => $com_policy_id);
                                                    $insert = $this->pm->add_policy_id($arr);
                                                    if( $insert ) {
                                    		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                    		        }
                                            }
                                            else
                                            {
                                                $max_policy_id = $last_policy_id->policy_id;
                                                $com_policy_id = $max_policy_id+1;
                                                $arr = array("policy_id" => $com_policy_id);
                                                $insert = $this->pm->add_policy_id($arr);
                                                if( $insert ) {
                                		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                		        }
                                            }
                                            echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                                    }
                                    else if($rto_status = "1")
                                    {
                                         echo json_encode(array("status"=>"This commission Slab Already Exits"));
                                    }
                                }
                            else
                            {
                                 $last_policy_id = $this->pm->get_last_policy_id();
                                           
                                if($last_policy_id == "")
                                {
                                        $com_policy_id = "1";
                                        $arr = array("policy_id" => $com_policy_id);
                                        $insert = $this->pm->add_policy_id($arr);
                                        if( $insert ) {
                        		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                        		        }
                                }
                                else
                                {
                                    $max_policy_id = $last_policy_id->policy_id;
                                    $com_policy_id = $max_policy_id+1;
                                    $arr = array("policy_id" => $com_policy_id);
                                    $insert = $this->pm->add_policy_id($arr);
                                    if( $insert ) {
                    		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                    		        }
                                }
                                echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                            }
                        }
                        else
                        {
                            if(count($check > 0) && $status == "0")
                            {
                                    if($ins_classification != "")
                                    {
                                       $classification = $this->pm->get_classification($commission_id,$ins_classification,$policy_type);
                                    
                                        if(count($classification > 0))
                                        {
                                           $commission_id = [];
                                           
                                           foreach($classification as $da)
                                           {
                                               $commission_id[] = $da->id;
                                           }
                                           
                                           $gvw_status = "1";
                                        }
                                    }
                                    else
                                    {
                                       $commission_id = [];
                                       $gvw_status = "1";
                                    }
                                  
                                   $check_make = $this->pm->check_make_all_already_exits($commission_id,$policy_type);
                                   
                                    if(count($check_make) > 0)
                                    {
                                        $commission_id = [];
                                        
                                        foreach($check_make as $da)
                                        {
                                             $commission_id[] = $da->id;
                                        }
                                        $make_status = "1";
                                    }
                                    else
                                    {
                                         $check_make_1 = $this->pm->check_make_already_exits($commission_id,$policy_type,$make);
                                            
                                            if(count($check_make_1) > 0)
                                            {
                                                $commission_id = [];
                                                
                                                foreach($check_make as $da)
                                                {
                                                     $commission_id[] = $da->commission_id;
                                                }
                                        
                                                $make_status = "1";
                                            }
                                            else
                                            {
                                                $make_status = "0";
                                            }
                                    }
                                        
                                    if($make_status == "1")
                                    {
                                        $check_model = $this->pm->check_model_all_already_exits($commission_id,$policy_type);
                                        
                                        if(count($check_model) > 0)
                                        {
                                                $commission_id = [];
                                                foreach($check_make as $da)
                                                {
                                                     $commission_id[] = $da->id;
                                                }
                                             $model_status = "1";
                                        }
                                        else
                                        {
                                            $check_model_1 = $this->pm->check_model_already_exits($commission_id,$policy_type,$make,$model);
                                            
                                            if(count($check_model_1) > 0)
                                            {
                                                    $commission_id = [];
                                                    foreach($check_make as $da)
                                                    {
                                                         $commission_id[] = $da->commission_id;
                                                    }
                                                 $model_status = "1";
                                            }
                                            else
                                            {
                                                $model_status = "0";
                                            }
                                        }
                                    }
                                  
                                    if($make_status == "1" && $model_status == "1")
                                    {
                                        $check_varient = $this->pm->check_varient_all_already_exits($commission_id,$policy_type);
                                      
                                        if(count($check_varient) > 0)
                                        {
                                            $commission_id = [];
                                            foreach($check_make as $da)
                                            {
                                                 $commission_id[] = $da->id;
                                            }
                                	         $varient_status = "1";
                                        }
                                        else 
                                        {
                                          $check_varient_1 = $this->pm->check_varient_already_exits($commission_id,$policy_type,$make,$model,$varient);
                            	           
                            	            if(count($check_varient_1) > 0)
                            	            {
                                	            $commission_id = [];
                                                foreach($check_make as $da)
                                                {
                                                     $commission_id[] = $da->commission_id;
                                                }
                            	                 $varient_status = "1";
                            	            }
                            	            else
                            	            {
                            	                 $varient_status = "0";
                            	            }
                                        }
                                    }
                                    
                                    $ins_rto_1 = []; 
                                   
                                    if($status == "0" && $fuel_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                    {
                                         if($rto_category == "ROTN_Exclude")
                                          {
                                              $get_rto = $this->pm->get_rto($ins_rto);
                                              
                                              foreach($get_rto as $da)
                                              {
                                                   $ins_rto_1[] = $da->rto_no;
                                              }
                                              
                                               $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                              
                                               if(count($check_rto) > 0)
                                                {
                                                        $rto_status = "1";
                                                        $check_rto_1 = $this->pm->check_rto_already_exits_1($commission_id,$ins_rto_1);
                                                        
                                                        foreach($check_rto_1 as $da)
                                                        {
                                                            $commission_id[] = $da->commission_id;
                                                        }
                                                        
                                                        $get_nop_id = $this->pm->get_no_of_policy_id(array_unique($commission_id));
                                                        
                                                        if($get_nop_id != "")
                                                        {
                                                            echo json_encode(array("status"=>"success","no_of_policy_id"=>$get_nop_id->no_of_policy_id));
                                                        }
                                                }
                                          }
                                          else
                                          {
                                              if(in_array('chennai',$ins_rto) || in_array('Coimbatore',$ins_rto) || in_array('Madurai',$ins_rto))
                                               {
                                                  $city_rto = $this->pm->get_city_rto($ins_rto);
                                                  
                                                  for($i=0;$i<=count($ins_rto);$i++)
                                              	  {
                                              	            if(in_array("chennai",$ins_rto))
                                              	            {
                                              	                  unset($ins_rto[$i]);
                                              	            }
                                              	            else if(in_array("Coimbatore",$ins_rto))
                                              	            {
                                              	                unset($ins_rto[$i]);
                                              	            }
                                              	            else if(in_array("Madurai",$ins_rto))
                                              	            {
                                              	                unset($ins_rto[$i]);
                                              	            }
                                              	     }
                                              	     
                                              	   $get_rto = $this->pm->get_rto_no($ins_rto);
                                                
                                                   foreach($city_rto as $da)
                                                   {
                                                       $ins_rto_1[] = $da->rto_no;
                                                   }
                                                 
                                                     if($get_rto != null)
                                                     {
                                                       foreach($get_rto as $da)
                                                       {
                                                            $ins_rto_1[] = $da->rto_no;
                                                       }
                                                     }
                                                   
                                                   $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                                  
                                                       if(count($check_rto) > 0)
                                                        {
                                                            $rto_status = "1";
                                                            
                                                            $check_rto_1 = $this->pm->check_rto_already_exits_1($commission_id,$ins_rto_1);
                                                            
                                                            foreach($check_rto_1 as $da)
                                                            {
                                                                $commission_id[] = $da->commission_id;
                                                            }
                                                            
                                                            $get_nop_id = $this->pm->get_no_of_policy_id(array_unique($commission_id));
                                                        
                                                            if($get_nop_id != "")
                                                            {
                                                                echo json_encode(array("status"=>"success","no_of_policy_id"=>$get_nop_id->no_of_policy_id));
                                                            }
                                                        }
                                                        else
                                                        {
                                                                $last_policy_id = $this->pm->get_last_policy_id();
                                                               
                                                                if($last_policy_id == "")
                                                                {
                                                                    $com_policy_id = "1";
                                                                    $arr = array("policy_id" => $com_policy_id);
                                                                    $insert = $this->pm->add_policy_id($arr);
                                                                    if( $insert ) {
                                                    		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                                    		        }
                                                                }
                                                                else
                                                                {
                                                                    $max_policy_id = $last_policy_id->policy_id;
                                                                    $com_policy_id = $max_policy_id+1;
                                                                    $arr = array("policy_id" => $com_policy_id);
                                                                    $insert = $this->pm->add_policy_id($arr);
                                                                    if( $insert ) {
                                                    		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                                    		        }
                                                                }
                                                                
                                                           echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                                                        }
                                               }
                                               else if(in_array("ROTN",$ins_rto))
                                               {
                                                   $get_rotn_rto = $this->pm->get_rotn_rto();
                                                   
                                                   foreach($get_rotn_rto as $da)
                                                   {
                                                        $ins_rto_1[] = $da->rto_no;
                                                   }
                                                   $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                                   
                                                        if(count($check_rto) > 0)
                                                        {
                                                            $rto_status = "1";
                                                            
                                                            $check_rto_1 = $this->pm->check_rto_already_exits_1($commission_id,$ins_rto_1);
                                                            
                                                            foreach($check_rto_1 as $da)
                                                            {
                                                                $commission_id[] = $da->commission_id;
                                                            }
                                                            
                                                            $get_nop_id = $this->pm->get_no_of_policy_id(array_unique($commission_id));
                                                        
                                                            if($get_nop_id != "")
                                                            {
                                                                echo json_encode(array("status"=>"success","no_of_policy_id"=>$get_nop_id->no_of_policy_id));
                                                            }
                                                        }
                                                        else
                                                        {
                                                                $last_policy_id = $this->pm->get_last_policy_id();
                                                               
                                                                if($last_policy_id == "")
                                                                {
                                                                    $com_policy_id = "1";
                                                                    $arr = array("policy_id" => $com_policy_id);
                                                                    $insert = $this->pm->add_policy_id($arr);
                                                                    if( $insert ) {
                                                    		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                                    		        }
                                                                }
                                                                else
                                                                {
                                                                    $max_policy_id = $last_policy_id->policy_id;
                                                                    $com_policy_id = $max_policy_id+1;
                                                                    $arr = array("policy_id" => $com_policy_id);
                                                                    $insert = $this->pm->add_policy_id($arr);
                                                                    if( $insert ) {
                                                    		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                                    		        }
                                                                }
                                                                
                                                           echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                                                        }
                                               }
                                                   else if(in_array("All TN",$ins_rto))
                                                   {
                                                        $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                                                        
                                                           foreach($get_all_tn_rto as $da)
                                                           {
                                                                $ins_rto_1[] = $da->rto_no;
                                                           }
                                                        $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                                        
                                                        if(count($check_rto) > 0)
                                                        {
                                                            $rto_status = "1";
                                                            
                                                            $check_rto_1 = $this->pm->check_rto_already_exits_1($commission_id,$ins_rto_1);
                                                            
                                                            foreach($check_rto_1 as $da)
                                                            {
                                                                $commission_id[] = $da->commission_id;
                                                            }
                                                            
                                                            $get_nop_id = $this->pm->get_no_of_policy_id(array_unique($commission_id));
                                                        
                                                            if($get_nop_id != "")
                                                            {
                                                                echo json_encode(array("status"=>"success","no_of_policy_id"=>$get_nop_id->no_of_policy_id));
                                                            }
                                                        }
                                                        else
                                                        {
                                                                $last_policy_id = $this->pm->get_last_policy_id();
                                                               
                                                                if($last_policy_id == "")
                                                                {
                                                                    $com_policy_id = "1";
                                                                    $arr = array("policy_id" => $com_policy_id);
                                                                    $insert = $this->pm->add_policy_id($arr);
                                                                    if( $insert ) {
                                                    		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                                    		        }
                                                                }
                                                                else
                                                                {
                                                                    $max_policy_id = $last_policy_id->policy_id;
                                                                    $com_policy_id = $max_policy_id+1;
                                                                    $arr = array("policy_id" => $com_policy_id);
                                                                    $insert = $this->pm->add_policy_id($arr);
                                                                    if( $insert ) {
                                                    		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                                    		        }
                                                                }
                                                                
                                                           echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                                                        }
                                                   }
                                                   else if(in_array("All RTO",$ins_rto))
                                                   {
                                                       $get_all_rto = $this->pm->get_all_rto_list();
                                                       
                                                       foreach($get_all_rto as $da)
                                                       {
                                                              $ins_rto_1[] = $da->rto_no;
                                                       }
                                                       
                                                        $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                                        
                                                        if(count($check_rto) > 0)
                                                        {
                                                            $rto_status = "1";
                                                           
                                                           $check_rto_1 = $this->pm->check_rto_already_exits_1($commission_id,$ins_rto_1);
                                                            
                                                            foreach($check_rto_1 as $da)
                                                            {
                                                                $commission_id[] = $da->commission_id;
                                                            }
                                                            
                                                            $get_nop_id = $this->pm->get_no_of_policy_id(array_unique($commission_id));
                                                        
                                                            if($get_nop_id != "")
                                                            {
                                                                echo json_encode(array("status"=>"success","no_of_policy_id"=>$get_nop_id->no_of_policy_id));
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $last_policy_id = $this->pm->get_last_policy_id();
                                                               
                                                                if($last_policy_id == "")
                                                                {
                                                                    $com_policy_id = "1";
                                                                    $arr = array("policy_id" => $com_policy_id);
                                                                    $insert = $this->pm->add_policy_id($arr);
                                                                    if( $insert ) {
                                                    		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                                    		        }
                                                                }
                                                                else
                                                                {
                                                                    $max_policy_id = $last_policy_id->policy_id;
                                                                    $com_policy_id = $max_policy_id+1;
                                                                    $arr = array("policy_id" => $com_policy_id);
                                                                    $insert = $this->pm->add_policy_id($arr);
                                                                    if( $insert ) {
                                                    		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                                    		        }
                                                                }
                                                                
                                                            echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                                                        }
                                                   }
                                                   else
                                                   {
                                                        $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto);
                                                        
                                                        if(count($check_rto) > 0)
                                                        {
                                                            $rto_status = "1";
                                                        
                                                           $check_rto_1 = $this->pm->check_rto_already_exits_1($commission_id,$ins_rto_1);
                                                         
                                                            foreach($check_rto_1 as $da)
                                                            {
                                                                $commission_id[] = $da->commission_id;
                                                            }
                                                            
                                                            $get_nop_id = $this->pm->get_no_of_policy_id(array_unique($commission_id));
                                                        
                                                            if($get_nop_id != "")
                                                            {
                                                                echo json_encode(array("status"=>"success","no_of_policy_id"=>$get_nop_id->no_of_policy_id));
                                                            }
                                                        }
                                                        else
                                                        {
                                                           $last_policy_id = $this->pm->get_last_policy_id();
                                                            if($last_policy_id == "")
                                                            {
                                                                $com_policy_id = "1";
                                                                $arr = array("policy_id" => $com_policy_id);
                                                                $insert = $this->pm->add_policy_id($arr);
                                                                if( $insert ) {
                                                		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                                		        }
                                                            }
                                                            else
                                                            {
                                                                $max_policy_id = $last_policy_id->policy_id;
                                                                $com_policy_id = $max_policy_id+1;
                                                                $arr = array("policy_id" => $com_policy_id);
                                                                $insert = $this->pm->add_policy_id($arr);
                                                                if( $insert ) {
                                                		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                                		        }
                                                            }
                                                                    
                                                               echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                                                        }
                                                    }
                                           }
                                    }
                                    else
                                    {
                                      $last_policy_id = $this->pm->get_last_policy_id();
                                      
                                        if($last_policy_id == "")
                                        {
                                                $com_policy_id = "1";
                                                $arr = array("policy_id" => $com_policy_id);
                                                $insert = $this->pm->add_policy_id($arr);
                                                if( $insert ) {
                                		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                		        }
                                        }
                                        else
                                        {
                                            $max_policy_id = $last_policy_id->policy_id;
                                            $com_policy_id = $max_policy_id+1;
                                            $arr = array("policy_id" => $com_policy_id);
                                            $insert = $this->pm->add_policy_id($arr);
                                            if( $insert ) {
                            		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                            		        }
                                        }
                                    echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                                   }
                                }
                            else
                            {
                                    $last_policy_id = $this->pm->get_last_policy_id();
                                    if($last_policy_id == "")
                                    {
                                            $com_policy_id = "1";
                                            $arr = array("policy_id" => $com_policy_id);
                                            $insert = $this->pm->add_policy_id($arr);
                                            if( $insert ) {
                            		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                            		        }
                                    }
                                    else
                                    {
                                        $max_policy_id = $last_policy_id->policy_id;
                                        $com_policy_id = $max_policy_id+1;
                                        $arr = array("policy_id" => $com_policy_id);
                                        $insert = $this->pm->add_policy_id($arr);
                                        if( $insert ) {
                        		            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                        		        }
                                    }
                            echo json_encode(array("status"=>"success","net_id"=>$com_policy_id));
                        }
                    }
                }
                 else if($commission_type == "3")
                 {
                         $g_status = 0;
                         
                         $fuel_status = 0;
                         
                         $commission_id =[]; 
                         
                         $check = $this->pm->check_target_amount_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type);
    	                 
    	                
                	    foreach($check as $da)
                		{
                                $temp_min = $da->min_val;
                				$temp_max = $da->max_val;
                				
                				if($temp_min <= $min_amount && $temp_max >= $min_amount)
                				{
                					$g_status = "1";
                				}
                				if($temp_min <= $max_amount && $temp_max >= $max_amount)
                				{
                					$g_status = "1";
                				}
                				if($temp_min > $min_amount && $temp_max < $max_amount)
                				{
                					$g_status = "1";
                				}
                    		  
                    		    $commission_id[] = $da->id;
                    		    
            					 if($fuel_type == "1")
                        		    {
                        				if($da->fuel_type == "4" || $da->fuel_type == "1")
                        				{
                        				    $fuel_status = "1";
                        				}
                        			}
                        			if($fuel_type == "2")
                        			{
                        			    if($da->fuel_type == "5" || $da->fuel_type == "2")
                        				{
                        				    $fuel_status = "1";
                        				}
                        			}
                        			if($fuel_type == "5")
                        			{
                        			    if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2")
                        				{
                        				    $fuel_status = "1";
                        				}
                        			}
                        			if($fuel_type == "6")
                        			{
                        			    if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                        				{
                        				    $fuel_status = "1";
                        				}
                        			}
                        			if($fuel_type == "7")
                        			{
                        			    if($da->fuel_type == "7")
                        				{
                        				    $fuel_status = "1";
                        				}
                        			}
                    			
                    			
                    			if($g_status == "1" && $fuel_status == "1")
                        	    {
                        			    $commission_id[] = $da->id;
                        			    $status = "1";
                	                    $fuel_type_status = "1";
                        		}
                            }
                      
                        if($status == "1" && $commission_id != null)
                        {
                            if($ins_classification != "")
                            {
                               $classification = $this->pm->get_classification($commission_id,$ins_classification,$policy_type);
                            
                                if(count($classification > 0))
                                {
                                   $commission_id = [];
                                   
                                   foreach($classification as $da)
                                   {
                                       $commission_id[] = $da->id;
                                   }
                                   
                                   $gvw_status = "1";
                                }
                            }
                            else
                            {
                               $commission_id = [];
                               $gvw_status = "1";
                            }
                                    
                            $check_make = $this->pm->check_make_all_already_exits($commission_id,$policy_type);
                            
                            
                            if(count($check_make) > 0)
                            {
                                $commission_id = [];
                                
                                foreach($check_make as $da)
                                {
                                     $commission_id[] = $da->id;
                                }
                                
                                $status = "1";
                                $make_status = "1";
                            }
                            else
                            {
                                 $check_make_1 = $this->pm->check_make_already_exits($commission_id,$policy_type,$make);
                                    
                                    if(count($check_make_1) > 0)
                                    {
                                        $commission_id = [];
                                        
                                        foreach($check_make as $da)
                                        {
                                             $commission_id[] = $da->commission_id;
                                        }
                                
                                        $status = "1";
                                        $make_status = "1";
                                    }
                                    else
                                    {
                                        $make_status = "0";
                                    }
                            }
                                
                            if($make_status == "1")
                            {
                                $check_model = $this->pm->check_model_all_already_exits($commission_id,$policy_type);
                                
                                if(count($check_model) > 0)
                                {
                                        $commission_id = [];
                                        foreach($check_make as $da)
                                        {
                                             $commission_id[] = $da->id;
                                        }
                                     $status = "1";
                                     $model_status = "1";
                                }
                                else
                                {
                                    $check_model_1 = $this->pm->check_model_already_exits($commission_id,$policy_type,$make,$model);
                                    
                                    if(count($check_model_1) > 0)
                                    {
                                            $commission_id = [];
                                            foreach($check_make as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                                         $status = "1";
                                         $model_status = "1";
                                    }
                                    else
                                    {
                                        $model_status = "0";
                                    }
                                }
                            }
                            
                            if($make_status == "1" && $model_status == "1")
                            {
                                $check_varient = $this->pm->check_varient_all_already_exits($commission_id,$policy_type);
                              
                                if(count($check_varient) > 0)
                                {
                                    $commission_id = [];
                                    foreach($check_make as $da)
                                    {
                                         $commission_id[] = $da->id;
                                    }
                                     $status = "1";
                        	         $varient_status = "1";
                                }
                                else 
                                {
                                  $check_varient_1 = $this->pm->check_varient_already_exits($commission_id,$policy_type,$make,$model,$varient);
                    	           
                    	            if(count($check_varient_1) > 0)
                    	            {
                        	            $commission_id = [];
                                        foreach($check_make as $da)
                                        {
                                             $commission_id[] = $da->commission_id;
                                        }
                    	                 $status = "1";
                    	                 $varient_status = "1";
                    	            }
                    	            else
                    	            {
                    	                 $varient_status = "0";
                    	            }
                                }
                            }
                        
                            $ins_rto_1 = []; 
                        
      
                            if($status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                            {
                                $rto_status = '0';
                             
                                 if($rto_category == "ROTN_Exclude")
                                  {
                                      $get_rto = $this->pm->get_rto($ins_rto);
                                      
                                      foreach($get_rto as $da)
                                      {
                                           $ins_rto_1[] = $da->rto_no;
                                      }
                                      
                                       $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                      
                                        if(count($check_rto) > 0)
                                        {
                                            $rto_status = "1";
                                          
                                        }
                                  }
                                  else
                                  {
                                      if(in_array('chennai',$ins_rto) || in_array('Coimbatore',$ins_rto) || in_array('Madurai',$ins_rto))
                                       {
                                           $city_rto = $this->pm->get_city_rto($ins_rto);
                                           
                                          for($i=0;$i<=count($ins_rto);$i++)
                                      	  {
                                      	            if(in_array("chennai",$ins_rto))
                                      	            {
                                      	                  unset($ins_rto[$i]);
                                      	            }
                                      	            else if(in_array("Coimbatore",$ins_rto))
                                      	            {
                                      	                unset($ins_rto[$i]);
                                      	            }
                                      	            else if(in_array("Madurai",$ins_rto))
                                      	            {
                                      	                unset($ins_rto[$i]);
                                      	            }
                                      	     }
                                      	     
                                      	   $get_rto = $this->pm->get_rto_no($ins_rto);
                                        
                                           foreach($city_rto as $da)
                                           {
                                               $ins_rto_1[] = $da->rto_no;
                                           }
                                        
                                        if($get_rto != null)
                                        {
                                           foreach($get_rto as $da)
                                           {
                                                $ins_rto_1[] = $da->rto_no;
                                           }
                                        }
                                           
                                           $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                          
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                                echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                            }
                                            else
                                            {
                                                echo json_encode(array("status"=>"success"));
                                            }
                                       }
                                       else if(in_array("ROTN",$ins_rto))
                                       {
                                           $get_rotn_rto = $this->pm->get_rotn_rto();
                                           
                                           foreach($get_rotn_rto as $da)
                                           {
                                                $ins_rto_1[] = $da->rto_no;
                                           }
                                           $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                           
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                            }
                                       }
                                       else if(in_array("All TN",$ins_rto))
                                       {
                                            $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                                            
                                               foreach($get_all_tn_rto as $da)
                                               {
                                                    $ins_rto_1[] = $da->rto_no;
                                               }
                                            $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                            
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                            }
                                       }
                                       else if(in_array("All RTO",$ins_rto))
                                       {
                                           $get_all_rto = $this->pm->get_all_rto_list();
                                           
                                           foreach($get_all_rto as $da)
                                           {
                                                  $ins_rto_1[] = $da->rto_no;
                                           }
                                           
                                            $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                            
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                            }
                                       }
                                       else
                                       {
                                            $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto);
                                            
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                            }
                                        }
                                  }
                                    
                                    if($rto_status == "0")
                                    {
                                         $last_net_id = $this->cm->get_last_net_premium_id();
                                            
                                            if($last_net_id->net_premium_id == "")
                                            {
                                                $com_net_premium_id = "1";
                                                $arr = array("net_premium_id" => $com_net_premium_id);
                                                $insert = $this->pm->add_net_premium_id($arr);
                                                if( $insert ) {
                                                    $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                                }
                                                echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                            }
                                            else
                                            {
                                                $max_net_premium_id = $last_net_id->net_premium_id;
                                                $com_net_premium_id = $max_net_premium_id+1;
                                                $arr = array("net_premium_id" => $com_net_premium_id);
                                                $insert = $this->pm->add_net_premium_id($arr);
                                                if( $insert ) {
                                                    $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                                }
                                                echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                            }
                                    }
                                    else if($rto_status = "1")
                                    {
                                         echo json_encode(array("status"=>"This commission Slab Already Exits"));
                                    }
                                }
                            else
                            {
                                $last_net_id = $this->cm->get_last_net_premium_id();
                                
                                if($last_net_id->net_premium_id == "")
                                {
                                    $com_net_premium_id = "1";
                                    $arr = array("net_premium_id" => $com_net_premium_id);
                                    $insert = $this->pm->add_net_premium_id($arr);
                                    if( $insert ) {
                                        $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                    }
                                    echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                }
                                else
                                {
                                    $max_net_premium_id = $last_net_id->net_premium_id;
                                    $com_net_premium_id = $max_net_premium_id+1;
                                    $arr = array("net_premium_id" => $com_net_premium_id);
                                    $insert = $this->pm->add_net_premium_id($arr);
                                    if( $insert ) {
                                        $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                    }
                                    echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                }
                            }
                        }
                        else
                        {
                            if(count($check > 0) && $status == "0")
                            {
                                if($ins_classification != "")
                                {
                                   $classification = $this->pm->get_classification($commission_id,$ins_classification,$policy_type);
                                
                                    if(count($classification > 0))
                                    {
                                       $commission_id = [];
                                       
                                       foreach($classification as $da)
                                       {
                                           $commission_id[] = $da->id;
                                       }
                                       
                                       $gvw_status = "1";
                                    }
                                }
                                else
                                {
                                   $commission_id = [];
                                   $gvw_status = "1";
                                }
                                  
                                   $check_make = $this->pm->check_make_all_already_exits($commission_id,$policy_type);
                                   
                                    if(count($check_make) > 0)
                                    {
                                        $commission_id = [];
                                        
                                        foreach($check_make as $da)
                                        {
                                             $commission_id[] = $da->id;
                                        }
                                        $make_status = "1";
                                    }
                                    else
                                    {
                                         $check_make_1 = $this->pm->check_make_already_exits($commission_id,$policy_type,$make);
                                            
                                            if(count($check_make_1) > 0)
                                            {
                                                $commission_id = [];
                                                
                                                foreach($check_make as $da)
                                                {
                                                     $commission_id[] = $da->commission_id;
                                                }
                                        
                                                $make_status = "1";
                                            }
                                            else
                                            {
                                                $make_status = "0";
                                            }
                                    }
                                        
                                    if($make_status == "1")
                                    {
                                        $check_model = $this->pm->check_model_all_already_exits($commission_id,$policy_type);
                                        
                                        if(count($check_model) > 0)
                                        {
                                                $commission_id = [];
                                                foreach($check_make as $da)
                                                {
                                                     $commission_id[] = $da->id;
                                                }
                                             $model_status = "1";
                                        }
                                        else
                                        {
                                            $check_model_1 = $this->pm->check_model_already_exits($commission_id,$policy_type,$make,$model);
                                            
                                            if(count($check_model_1) > 0)
                                            {
                                                    $commission_id = [];
                                                    foreach($check_make as $da)
                                                    {
                                                         $commission_id[] = $da->commission_id;
                                                    }
                                                 $model_status = "1";
                                            }
                                            else
                                            {
                                                $model_status = "0";
                                            }
                                        }
                                    }
                                    
                                    
                                    
                                    if($make_status == "1" && $model_status == "1")
                                    {
                                        $check_varient = $this->pm->check_varient_all_already_exits($commission_id,$policy_type);
                                      
                                        if(count($check_varient) > 0)
                                        {
                                            $commission_id = [];
                                            foreach($check_make as $da)
                                            {
                                                 $commission_id[] = $da->id;
                                            }
                                	         $varient_status = "1";
                                        }
                                        else 
                                        {
                                          $check_varient_1 = $this->pm->check_varient_already_exits($commission_id,$policy_type,$make,$model,$varient);
                            	           
                            	            if(count($check_varient_1) > 0)
                            	            {
                                	            $commission_id = [];
                                                foreach($check_make as $da)
                                                {
                                                     $commission_id[] = $da->commission_id;
                                                }
                            	                 $varient_status = "1";
                            	            }
                            	            else
                            	            {
                            	                 $varient_status = "0";
                            	            }
                                        }
                                    }
                                    
                                    $ins_rto_1 = []; 
                                 
                                    if($status == "0" && $fuel_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                    {
                                         if($rto_category == "ROTN_Exclude")
                                          {
                                              $get_rto = $this->pm->get_rto($ins_rto);
                                              
                                              foreach($get_rto as $da)
                                              {
                                                   $ins_rto_1[] = $da->rto_no;
                                              }
                                              
                                               $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                              
                                               if(count($check_rto) > 0)
                                                {
                                                        $rto_status = "1";
                                                        $check_rto_1 = $this->pm->check_rto_already_exits_1($commission_id,$ins_rto_1);
                                                      
                                                        foreach($check_rto_1 as $da)
                                                        {
                                                            $commission_id[] = $da->commission_id;
                                                        }
                                                        
                                                        $get_net_id = $this->pm->get_net_id(array_unique($commission_id));
                                                        
                                                        if($get_net_id != "")
                                                        {
                                                            echo json_encode(array("status"=>"success","net_id"=>$get_net_id->net_premium_id));
                                                        }
                                                }
                                          }
                                          else
                                          {
                                                if(in_array('chennai',$ins_rto) || in_array('Coimbatore',$ins_rto) || in_array('Madurai',$ins_rto))
                                               {
                                                  $city_rto = $this->pm->get_city_rto($ins_rto);
                                                  
                                                  for($i=0;$i<=count($ins_rto);$i++)
                                              	  {
                                              	            if(in_array("chennai",$ins_rto))
                                              	            {
                                              	                  unset($ins_rto[$i]);
                                              	            }
                                              	            else if(in_array("Coimbatore",$ins_rto))
                                              	            {
                                              	                unset($ins_rto[$i]);
                                              	            }
                                              	            else if(in_array("Madurai",$ins_rto))
                                              	            {
                                              	                unset($ins_rto[$i]);
                                              	            }
                                              	     }
                                              	     
                                              	   $get_rto = $this->pm->get_rto_no($ins_rto);
                                                
                                                   foreach($city_rto as $da)
                                                   {
                                                       $ins_rto_1[] = $da->rto_no;
                                                   }
                                                 
                                                     if($get_rto != null)
                                                     {
                                                       foreach($get_rto as $da)
                                                       {
                                                            $ins_rto_1[] = $da->rto_no;
                                                       }
                                                     }
                                                   
                                                     $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                                  
                                                       if(count($check_rto) > 0)
                                                        {
                                                            $rto_status = "1";
                                                            
                                                            $check_rto_1 = $this->pm->check_rto_already_exits_1($commission_id,$ins_rto_1);
                                                            
                                                            foreach($check_rto_1 as $da)
                                                            {
                                                                $commission_id[] = $da->commission_id;
                                                            }
                                                            
                                                            $get_net_id = $this->pm->get_net_id(array_unique($commission_id));
                                                            
                                                            if($get_net_id != "")
                                                            {
                                                                echo json_encode(array("status"=>"success","net_id"=>$get_net_id->net_premium_id));
                                                            }
                                                        }
                                                        else
                                                        {
                                                                $last_net_id = $this->cm->get_last_net_premium_id();
                                    
                                                            if($last_net_id->net_premium_id == "")
                                                            {
                                                                $com_net_premium_id = "1";
                                                                $arr = array("net_premium_id" => $com_net_premium_id);
                                                                $insert = $this->pm->add_net_premium_id($arr);
                                                                if( $insert ) {
                                                                    $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                                                }
                                                                echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                                            }
                                                            else
                                                            {
                                                                $max_net_premium_id = $last_net_id->net_premium_id;
                                                                $com_net_premium_id = $max_net_premium_id+1;
                                                                $arr = array("net_premium_id" => $com_net_premium_id);
                                                                $insert = $this->pm->add_net_premium_id($arr);
                                                                if( $insert ) {
                                                                    $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                                                }
                                                                echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                                            }
                                                        }
                                               }  
                                                   
                                                   else if(in_array("ROTN",$ins_rto))
                                                   {
                                                       $get_rotn_rto = $this->pm->get_rotn_rto();
                                                       
                                                       foreach($get_rotn_rto as $da)
                                                       {
                                                            $ins_rto_1[] = $da->rto_no;
                                                       }
                                                       
                                                       $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                                       
                                                        if(count($check_rto) > 0)
                                                        {
                                                            $rto_status = "1";
                                                            
                                                            $check_rto_1 = $this->pm->check_rto_already_exits_1($commission_id,$ins_rto_1);
                                                            
                                                            foreach($check_rto_1 as $da)
                                                            {
                                                                $commission_id[] = $da->commission_id;
                                                            }
                                                            
                                                            $get_net_id = $this->pm->get_net_id(array_unique($commission_id));
                                                            
                                                            if($get_net_id != "")
                                                            {
                                                                echo json_encode(array("status"=>"success","net_id"=>$get_net_id->net_premium_id));
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $last_net_id = $this->cm->get_last_net_premium_id();
                                    
                                                            if($last_net_id->net_premium_id == "")
                                                            {
                                                                $com_net_premium_id = "1";
                                                                $arr = array("net_premium_id" => $com_net_premium_id);
                                                                $insert = $this->pm->add_net_premium_id($arr);
                                                                if( $insert ) {
                                                                    $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                                                }
                                                                echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                                            }
                                                            else
                                                            {
                                                                $max_net_premium_id = $last_net_id->net_premium_id;
                                                                $com_net_premium_id = $max_net_premium_id+1;
                                                                $arr = array("net_premium_id" => $com_net_premium_id);
                                                                $insert = $this->pm->add_net_premium_id($arr);
                                                                if( $insert ) {
                                                                    $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                                                }
                                                                echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                                            }
                                                        }
                                                   }
                                                   else if(in_array("All TN",$ins_rto))
                                                   {
                                                        $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                                                        
                                                           foreach($get_all_tn_rto as $da)
                                                           {
                                                                $ins_rto_1[] = $da->rto_no;
                                                           }
                                                        $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                                        
                                                        if(count($check_rto) > 0)
                                                        {
                                                            $rto_status = "1";
                                                            
                                                            $check_rto_1 = $this->pm->check_rto_already_exits_1($commission_id,$ins_rto_1);
                                                            
                                                            foreach($check_rto_1 as $da)
                                                            {
                                                                $commission_id[] = $da->commission_id;
                                                            }
                                                            
                                                            $get_net_id = $this->pm->get_net_id(array_unique($commission_id));
                                                            
                                                            if($get_net_id != "")
                                                            {
                                                                echo json_encode(array("status"=>"success","net_id"=>$get_net_id->net_premium_id));
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $last_net_id = $this->cm->get_last_net_premium_id();
                                    
                                                            if($last_net_id->net_premium_id == "")
                                                            {
                                                                $com_net_premium_id = "1";
                                                                $arr = array("net_premium_id" => $com_net_premium_id);
                                                                $insert = $this->pm->add_net_premium_id($arr);
                                                                if( $insert ) {
                                                                    $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                                                }
                                                                echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                                            }
                                                            else
                                                            {
                                                                $max_net_premium_id = $last_net_id->net_premium_id;
                                                                $com_net_premium_id = $max_net_premium_id+1;
                                                                $arr = array("net_premium_id" => $com_net_premium_id);
                                                                $insert = $this->pm->add_net_premium_id($arr);
                                                                if( $insert ) {
                                                                    $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                                                }
                                                                echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                                            }
                                                        }
                                                   }
                                                   else if(in_array("All RTO",$ins_rto))
                                                   {
                                                       $get_all_rto = $this->pm->get_all_rto_list();
                                                       
                                                       foreach($get_all_rto as $da)
                                                       {
                                                              $ins_rto_1[] = $da->rto_no;
                                                       }
                                                       
                                                        $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                                        
                                                        if(count($check_rto) > 0)
                                                        {
                                                            $rto_status = "1";
                                                           
                                                           $check_rto_1 = $this->pm->check_rto_already_exits_1($commission_id,$ins_rto_1);
                                                            
                                                            foreach($check_rto_1 as $da)
                                                            {
                                                                $commission_id[] = $da->commission_id;
                                                            }
                                                            
                                                            $get_net_id = $this->pm->get_net_id(array_unique($commission_id));
                                                            
                                                            if($get_net_id != "")
                                                            {
                                                                echo json_encode(array("status"=>"success","net_id"=>$get_net_id->net_premium_id));
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $last_net_id = $this->cm->get_last_net_premium_id();
                                    
                                                            if($last_net_id->net_premium_id == "")
                                                            {
                                                                $com_net_premium_id = "1";
                                                                $arr = array("net_premium_id" => $com_net_premium_id);
                                                                $insert = $this->pm->add_net_premium_id($arr);
                                                                if( $insert ) {
                                                                    $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                                                }
                                                                echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                                            }
                                                            else
                                                            {
                                                                $max_net_premium_id = $last_net_id->net_premium_id;
                                                                $com_net_premium_id = $max_net_premium_id+1;
                                                                $arr = array("net_premium_id" => $com_net_premium_id);
                                                                $insert = $this->pm->add_net_premium_id($arr);
                                                                if( $insert ) {
                                                                    $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                                                }
                                                                echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                                            }
                                                        }
                                                   }
                                                   else
                                                   {
                                                        $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto);
                                                        
                                                        if(count($check_rto) > 0)
                                                        {
                                                            $rto_status = "1";
                                                        
                                                         $check_rto_1 = $this->pm->check_rto_already_exits_1($commission_id,$ins_rto_1);
                                                         
                                                            foreach($check_rto_1 as $da)
                                                            {
                                                                $commission_id[] = $da->commission_id;
                                                            }
                                                            
                                                            $get_net_id = $this->pm->get_net_id(array_unique($commission_id));
                                                            
                                                            if($get_net_id != "")
                                                            {
                                                                echo json_encode(array("status"=>"success","net_id"=>$get_net_id->net_premium_id));
                                                            }
                                                        }
                                                        else
                                                        {
                                                            $last_net_id = $this->cm->get_last_net_premium_id();
                                    
                                                            if($last_net_id->net_premium_id == "")
                                                            {
                                                                $com_net_premium_id = "1";
                                                                $arr = array("net_premium_id" => $com_net_premium_id);
                                                                $insert = $this->pm->add_net_premium_id($arr);
                                                                if( $insert ) {
                                                                    $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                                                }
                                                                echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                                            }
                                                            else
                                                            {
                                                                $max_net_premium_id = $last_net_id->net_premium_id;
                                                                $com_net_premium_id = $max_net_premium_id+1;
                                                                $arr = array("net_premium_id" => $com_net_premium_id);
                                                                $insert = $this->pm->add_net_premium_id($arr);
                                                                if( $insert ) {
                                                                    $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                                                }
                                                                echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                                            }
                                                        }
                                                    }
                                                }
                                    }
                                    else
                                    {
                                        $last_net_id = $this->cm->get_last_net_premium_id();
                                        
                                        if($last_net_id->net_premium_id == "")
                                        {
                                            $com_net_premium_id = "1";
                                            $arr = array("net_premium_id" => $com_net_premium_id);
                                            $insert = $this->pm->add_net_premium_id($arr);
                                            if( $insert ) {
                                                $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                            }
                                            echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                        }
                                        else
                                        {
                                            $max_net_premium_id = $last_net_id->net_premium_id;
                                            $com_net_premium_id = $max_net_premium_id+1;
                                            $arr = array("net_premium_id" => $com_net_premium_id);
                                            $insert = $this->pm->add_net_premium_id($arr);
                                            if( $insert ) {
                                                $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                            }
                                            echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                        }
                                }
                                }
                            else
                            {
                                 $last_net_id = $this->cm->get_last_net_premium_id();
                              
                                   if($last_net_id->net_premium_id == "")
                                    {
                                        $com_net_premium_id = "1";
                                        $arr = array("net_premium_id" => $com_net_premium_id);
                                        $insert = $this->pm->add_net_premium_id($arr);
                                        if( $insert ) {
                                            $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                        }
                                        echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                    }
                                    else
                                    {
                                        $max_net_premium_id = $last_net_id->net_premium_id;
                                        $com_net_premium_id = $max_net_premium_id+1;
                                        $arr = array("net_premium_id" => $com_net_premium_id);
                                        $insert = $this->pm->add_net_premium_id($arr);
                                        if( $insert ) {
                                            $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                        }
                                        echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                    }
                        }
                        }
    	          }
    	       }
    	       else
    	       {
        	     if($commission_type == "1")
                 {
                         $check = $this->pm->check_health_this_com_already_exits($insurer_company,$insurer_class,$business_type,$policy_type,$f_date,$to_date);
                         
                           foreach($check as $da)
                    	   {
                                    $temp_min = $da->no_policy_min;
                    				$temp_max = $da->no_policy_max;
                    				
                    				$commission_id[] = $da->id;
                    				
                    				if($temp_min <= $no_policy_min && $temp_max >= $no_policy_min)
                    				{
                    				    $commission_id =[];
                    				    $commission_id[] = $da->id;
                    					$status = "1";
                    				}
                    				if($temp_min <= $no_policy_max && $temp_max >= $no_policy_max)
                    				{
                    				    $commission_id =[];
                    				    $commission_id[] = $da->id;
                    					$status = "1";
                    				}
                    				if($temp_min > $no_policy_min && $temp_max < $no_policy_max)
                    				{
                    				    $commission_id =[];
                    				    $commission_id[] = $da->id;
                    					$status = "1";
                    				}
                                }
                           
                            if($status == "1")
                            {
                                echo json_encode(array("status"=>"This commission Slab Already Exits"));
                            }
                            else
                            {
                                if(count($check) > 0)
                                {
                                     $no_policy_id = $this->pm->get_no_of_policy_id($commission_id);
                                     
                                     if($no_policy_id != null)
                                     {
                                         $com_policy_id = $no_policy_id->no_of_policy_id;
                                     }
                                }
                                else
                                {
                                    $last_policy_id = $this->pm->get_last_policy_id();
                                    if($last_policy_id == "")
                                    {
                                            $com_policy_id = "1";
                                            $arr = array("policy_id" => $com_policy_id);
                                            $insert = $this->pm->add_policy_id($arr);
                                            if( $insert ) {
                                                $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                            }
                                    }
                                    else
                                    {
                                        $max_policy_id = $last_policy_id->policy_id;
                                        $com_policy_id = $max_policy_id+1;
                                        $arr = array("policy_id" => $com_policy_id);
                                        $insert = $this->pm->add_policy_id($arr);
                                        if( $insert ) {
                                            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                        }
                                    }
                                }
                                echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                            }
                         
                     }
                 else if($commission_type == "3")
                 {
                         $status = 0;
                         $commission_id =[]; 
                         $check = $this->pm->check_health_target_amount_already_exits($insurer_company,$insurer_class,$business_type,$policy_type,$f_date,$to_date);
                	    foreach($check as $da)
                		{
                                $temp_min = $da->min_val;
                				$temp_max = $da->max_val;
                				
                			   $commission_id[] = $da->id;
                			   
                				if($temp_min <= $min_amount && $temp_max >= $min_amount)
                				{
                				     $commission_id =[]; 
                				     $commission_id[] = $da->id;
                					 $status = "1";
                				}
                				if($temp_min <= $max_amount && $temp_max >= $max_amount)
                				{
                				     $commission_id =[]; 
                				    $commission_id[] = $da->id;
                					$status = "1";
                				}
                				if($temp_min > $min_amount && $temp_max < $max_amount)
                				{
                				    $commission_id =[]; 
                				    $commission_id[] = $da->id;
                					$status = "1";
                				}
                		}
                		
                		 if($status == "1")
                         {
                             echo json_encode(array("status"=>"This commission Slab Already Exits"));
                         }
                         else
                         {
                             if(count($check) > 0)
                             {
                                    $get_net_id = $this->pm->get_net_id($commission_id);
                                    
                                    if($get_net_id != "")
                                    {
                                       $com_net_premium_id = $get_net_id->net_premium_id;
                                    }
                             }
                             else
                             {
                                 $last_net_id = $this->pm->get_last_net_premium_id();
                                
                                if($last_net_id->net_premium_id == "")
                                {
                                    $com_net_premium_id = "1";
                                    $arr = array("net_premium_id" => $com_net_premium_id);
                                    $insert = $this->pm->add_net_premium_id($arr);
                                    if( $insert ) {
                                        $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                    }
                                    echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                }
                                else
                                {
                                    $max_net_premium_id = $last_net_id->net_premium_id;
                                    $com_net_premium_id = $max_net_premium_id+1;
                                    $arr = array("net_premium_id" => $com_net_premium_id);
                                    $insert = $this->pm->add_net_premium_id($arr);
                                    if( $insert ) {
                                        $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                    }
                                }
                             }
                           echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));  
                        }
    	          }
    	       }
    	   }
	 }
	    
	    public function fetch_classification()
	    {
	        if($this->session->has_userdata('logged_in'))
    	    {
    	        $policy_type = $this->input->post("policy_type");
    	        
    	           $content = "<option value=''>--select--</option>";
    	        
    	        if($policy_type == "7" || $policy_type == "12" ||$policy_type == "13" ||$policy_type == "14" ||$policy_type == "59" ||$policy_type == "60")
    	        {
    	            $res = $this->pm->fetch_seating_classification($policy_type);
    	            
            	       foreach($res as $da)
            	        {
            	            $content .="<option value='".$da->id."'>".$da->seating_capacity."</option>";
            	        }
    	        }
    	        else
    	        {
    	            $res = $this->pm->fetch_classification($policy_type);
    	            
        	       foreach($res as $da)
        	        {
        	            $content .="<option value='".$da->id."'>".$da->from_gvw_cc.$da->classification." - ".$da->to_gvw_cc.$da->classification."</option>";
        	        }
    	        }
    	        echo $content;
    	    }
	    }
	    
	    public function fetch_payout_entry()
	    {
	        if($this->session->has_userdata('logged_in'))
    	    {
                $draw = intval($this->input->post("draw"));
                
                $class = $this->input->post("ins_class");
                
                $res = $this->pm->fetch_payout_commission_health($class);
                
               
        		$arr = [];
                $a = 0 ;
                
                foreach($res as $da)
                {
                   $a++;
                	
                   $action = "";
        
                   $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
                   
        	        if($check_user_i->masters_edit == "1")
        	        {
        	          $action .= "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> </button>";  
        	        }
        	        if($check_user_i->masters_delete == "1")
        	        {
        	           $action .= " <button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> </button>";
        	        }
        
                     $view = "<a href='#' onclick='view_data(".$da->id.")'> ".$da->company_name."</a>";
                    
                      if($class == "1")  
                      {
                           $classifiaction = "";
                        
                            if($da->policy_type == "12" || $da->policy_type == "13" || $da->policy_type == "14" || $da->policy_type == "59" || $da->policy_type == "60" || $da->policy_type == "65" || $da->policy_type == "66")
                            {
                               
                               $classifiaction = $da->seating_capacity. "Seater";
                            }
                            else
                            {
                                $classifiaction = $da->from_gvw_cc.$da->classi."-".$da->to_gvw_cc.$da->classi;
                            }
                        
                        
                        $arr[] = array(
                            $a,
                            $view,
                            $da->premium_name,
                            $da->p_type,
                            $classifiaction,
                            $da->commission_state,
                            $da->type,
                            $da->own_od,
                            $da->own_tp,
                            $da->on_net,
                            $da->irda_od,
                            $da->irda_tp,
                            $da->ncb_percentage,
                            $action,
                        );
                      }
                      else
                      {
                              $arr[] = array(
                                $a,
                                $view,
                                $da->bussiness_type,
                                $da->p_type,
                                $da->on_net,
                                $da->ncb_percentage,
                                $action,
                            );
                      }
              }
                $result = array(
                			"draw"=> $draw,
        				    "recordsTotal"=>count($res),
        				    "recordsFiltered"=> count($res),
        				    "data"=>$arr,
        				);
                     echo json_encode($result);
    	    }
	    }
	    
       public function view_payout_commission_details()
       {
           if($this->session->has_userdata('logged_in')) 
        	{
        	    $id = $this->input->post("id");
        	    
        	    $info = $this->pm->get_policy_class($id);
        	    
                if($info->class == "1")
                {
            	        $res = $this->pm->fetch_commission_details_motor($id);
            	  
                        if($info->policy_type == "1" || $info->policy_type == "3")
                        {
                            $make = $this->pm->fetch_make_car_brand($id,$info->policy_type);
                            $model = $this->pm->fetch_car_model_name($id,$info->policy_type);
                            $varient = $this->pm->fetch_car_varient_name($id,$info->policy_type);
                        }
                        else if($info->policy_type == "2")
                        {
                            $make = $this->pm->fetch_make_bike_brand($id,$info->policy_type);
                            $model = $this->pm->fetch_bike_model_name($id,$info->policy_type);
                            $varient = $this->pm->fetch_bike_varient_name($id,$info->policy_type);
                        }
                        else if($info->policy_type == "4")
                        {
                            $make = $this->pm->fetch_make_e_two_wheeler_brand($id,$info->policy_type);
                            $model = $this->pm->fetch_e_two_wheeler_model_name($id,$info->policy_type);
                            $varient = $this->pm->fetch_e_two_wheeler_varient_name($id,$info->policy_type);
                        }
                        else if($info->policy_type == "7" || $info->policy_type == "12" || $info->policy_type == "13" || $info->policy_type == "14" || $info->policy_type == "59" || $info->policy_type == "60" || $info->policy_type == "65" || $info->policy_type == "66" || $info->policy_type == "69" )
                        {
                            $make = $this->pm->fetch_make_pc_brand($id,$info->policy_type);
                            $model = $this->pm->fetch_pc_model_name($id,$info->policy_type);
                            $varient = $this->pm->fetch_pc_varient_name($id,$info->policy_type);
                        }
                        else if($info->policy_type == "8" || $info->policy_type == "9" || $info->policy_type == "10" || $info->policy_type == "15" || $info->policy_type == "16" || $info->policy_type == "61")
                        {
                            $make = $this->pm->fetch_make_gc_brand($id,$info->policy_type);
                            $model = $this->pm->fetch_gc_model_name($id,$info->policy_type);
                            $varient = $this->pm->fetch_gc_varient_name($id,$info->policy_type);
                        }
                        else if($info->policy_type == "20")
                        {
                             $make = $this->pm->fetch_make_misc_brand($id,$info->policy_type);
                            $model = $this->pm->fetch_misc_model_name($id,$info->policy_type);
                            $varient = $this->pm->fetch_misc_varient_name($id,$info->policy_type);
                        }
                        else if($info->policy_type == "55")
                        {
                             $make = $this->pm->fetch_make_scooter_brand($id,$info->policy_type);
                             $model = $this->pm->fetch_scooter_model_name($id,$info->policy_type);
                             $varient = $this->pm->fetch_scooter_varient_name($id,$info->policy_type);
                        }
                        
                    $rto_details = $this->pm->fech_rto_details($id);
                    
                }
                else if($info->class == "2")
                {
                    $res = $this->pm->fetch_payout_commission_health_by_id($id);
                }
        	    
        	    $content = "<style> .wrap-it{
                                            word-wrap: break-word;
                                            }
                                            *{
                                                font-weight:unset !important;
                                            }
                                            th {
                                                text-align: left;
                                                background-color: #66b2d3;
                                                color: #fff;
                                            }
                                            table{
                                                width:100% !important;
                                            }
                                            td{
                                                word-wrap: break-word !important;
                                            }
                                    </style>";

        	       $content .="<table class='table table-bordered' style='width:100%'>
        	                       
        	                       <tr>
        	                            <th style='width:33%;word-break:break-word;'>Insurer</th>
        	                            <th style='width:33%;word-break:break-word;'>Premium Cover Type</th>
        	                            <th style='width:33%;word-break:break-word;'>Business Type</th>
        	                       </tr>
        	                       
        	                       <tr>
        	                             <td style='width:33%;word-break:break-word;'>".$res->company_name."</td>";
        	                             
        	                             if($res->class == "1")
        	                             {
        	                                $content .="<td style='width:33%;word-break:break-word;'>".$res->premium_name."</td>";
        	                             }
        	                             else
        	                             {
        	                                $content .=" <td style='width:33%;word-break:break-word;'>Health</td>";
        	                             }
        	                             $content .=" <td style='width:33%;word-break:break-word;'>".$res->b_type."</td>
        	                       </tr>";
        	                    
	                      
        	              
        	                       
        	             if($res->class == "1")
                          {
                              
                               $content .=" <tr style='width:33%;word-break:break-word;'>
        	                            <th style='width:33%;word-break:break-word;'>Class</th>
        	                            <th style='width:33%;word-break:break-word;'>Policy Type</th>
        	                            <th style='width:33%;word-break:break-word;'>Classification cc/gvw</th>
        	                       </tr>";
        	                       
        	                       $content .="<tr style='width:33%;word-break:break-word;'>
        	                            <td style='width:33%;word-break:break-word;'>Motor</td>
        	                            <td style='width:33%;word-break:break-word;'>".$res->p_type."</td>
        	                            <td style='width:33%;word-break:break-word;'>".$res->from_gvw_cc."".$res->classification." - ".$res->to_gvw_cc."".$res->classification."</td>
        	                       </tr>";
        	                       
        	                       
        	                       $content .="<tr style='width:33%;word-break:break-word;'>
        	                            <th style='width:33%;word-break:break-word;'>Make</th>
        	                            <th style='width:33%;word-break:break-word;'>Model</th>
        	                            <th style='width:33%;word-break:break-word;'>Varient</th>
        	                      </tr>
        	                      
        	                      <tr>
        	                      <td style='width:33%;word-break:break-word;' class='word-wrap'>";
        	                    
        	                    if($make != null)
        	                    {
        	                       foreach($make as $da)
    	                           {
    	                               $content .=$da->brand_name.",";
    	                           }
        	                    }
        	                    else
        	                    {
        	                         $content .="ALL";
        	                    }
    	                           
        	                     $content .="</td>
        	                                 <td style='width:33%;word-break:break-word;' class='word-wrap'>";
        	                     if($model != null)
        	                     {
        	                       foreach($model as $da)
    	                           {
    	                               $content .=$da->model_name.",";
    	                           }
        	                     }
        	                     else
        	                     {
        	                          $content .="ALL";
        	                     }
        	                     
        	                     $content .="</td>
        	                     <td style='width:33%;word-break:break-word;' class='word-wrap'>";
        	                    
        	                    if($varient != null)
        	                    {
        	                      foreach($varient as $da)
    	                           {
    	                               $content .=$da->varient_name.",";
    	                           }
        	                    }
        	                    else 
        	                    {
        	                         $content .="ALL";
        	                    }
        	                      $content .="</td>
        	                      </tr>
        	                      
        	                     <tr style='width:33%;word-break:break-word;'>
        	                            <th style='width:33%;word-break:break-word;'>Fuel type</th>
        	                            <th style='width:33%;word-break:break-word;'>Commission Type</th>
        	                            ";
        	                            
        	                            if($res->commission_type == "1")
        	                              {
        	                                  $content .= "<th style='width:33%;word-break:break-word;'>No Policy</th>";
        	                              }
        	                              else if($res->commission_type == "2")
        	                              {
        	                                  $content .= "<th style='width:33%;word-break:break-word;'>Vechicle Age</th>";
        	                              }
        	                              else if($res->commission_type == "3")
        	                              {
        	                                  $content .= "<th style='width:33%;word-break:break-word;'>Min Amount - Max Amount</th>";
        	                              }
        	                      $content .= "</tr>
        	                      
        	                      
        	                       <tr style='width:33%;word-break:break-word;'>
        	                          
        	                            <td style='width:33%;word-break:break-word;'>".$res->fuel_type."</td>
        	                            <td style='width:33%;word-break:break-word;'>".$res->c_type."</td>";
        	                           
        	                              if($res->commission_type == "1")
        	                              {
        	                                   $content .= "<td style='width:33%;word-break:break-word;'>".$res->no_policy_min."-".$res->no_policy_max."</td>";
        	                              }
        	                              else if($res->commission_type == "2")
        	                              {
        	                                   $content .= "<td style='width:33%;word-break:break-word;'>".$res->vehicle_age_min." - ".$res->vehicle_age_max."</td>";
        	                              }
        	                              else if($res->commission_type == "3")
        	                              {
        	                                   $content .= "<td style='width:33%;word-break:break-word;'>".$res->min_val." - ".$res->max_val."</td>";
        	                              }
        	                      $content .= "</tr>
        	                      
        	                      <tr style='width:33%;word-break:break-word;'>
        	                            <th style='width:33%;word-break:break-word;'>Vechicle Type(New/old)</th>
        	                            <th style='width:33%;word-break:break-word;'>State</th>
        	                            <th style='width:33%;word-break:break-word;'>RTO</th>
        	                      </tr>
        	                      
        	                       <tr style='width:33%;word-break:break-word;'>
        	                            <td style='width:33%;word-break:break-word;'>".$res->vehicle_type."</td>
        	                            <td style='width:33%;word-break:break-word;'>".$res->commission_state."</td>
        	                            <td style='width:33%;word-break:break-word;'>";
        	                             foreach($rto_details as $da)
                    	                   {
                            	                  
                            	               $content .= $da->rto.",";           
                    	                   }
        	                            
        	                            $content .= "</td>
        	                      </tr>
        	                      </table>";
        	                      
        	                      
        	                      $content .="<table class='table table-bordered'>
        	                                    
        	                                    <tr>
        	                                         <th>Commissions</th>
        	                                         <th>IDRA</th>
        	                                         <th>JAYANTHA Comm.</th>
        	                                         <th>A</th>
        	                                         <th>B</th>
        	                                         <th>C</th>
        	                                         <th>D</th>
        	                                    <tr>
        	                                    
        	                                    <tr>
        	                                         <th>OD</th>
        	                                         <td>".$res->irda_od."&nbsp;%</td>
        	                                         <td>".$res->own_od."&nbsp;%</td>
        	                                         <td>".$res->a_od."&nbsp;%</td>
        	                                         <td>".$res->b_od."&nbsp;%</td>
        	                                         <td>".$res->c_od."&nbsp;%</td>
        	                                         <td>".$res->d_od."&nbsp;%</td>
        	                                    <tr>
        	                                    
        	                                    <tr>
        	                                         <th>TP</th>
        	                                         <td>".$res->irda_tp."&nbsp;%</td>
        	                                         <td>".$res->own_tp."&nbsp;%</td>
        	                                         <td>".$res->a_tp."&nbsp;%</td>
        	                                         <td>".$res->b_tp."&nbsp;%</td>
        	                                         <td>".$res->c_tp."&nbsp;%</td>
        	                                         <td>".$res->d_tp."&nbsp;%</td>
        	                                    <tr>
        	                                    
        	                                     <tr>
        	                                         <th>ON NET</th>
        	                                         <td>0.00&nbsp;%</td>
        	                                         <td>".$res->on_net."&nbsp;%</td>
        	                                         <td>".$res->a_net."&nbsp;%</td>
        	                                         <td>".$res->b_net."&nbsp;%</td>
        	                                         <td>".$res->c_net."&nbsp;%</td>
        	                                         <td>".$res->d_net."&nbsp;%</td>
        	                                    <tr>
        	                                    
        	                                    <tr>
        	                                         <th>NCB</th>
        	                                         <td>0.00&nbsp;%</td>
        	                                         <td>".$res->ncb_percentage."&nbsp;%</td>
        	                                         <td>".$res->a_ncb."&nbsp;%</td>
        	                                         <td>".$res->b_ncb."&nbsp;%</td>
        	                                         <td>".$res->c_ncb."&nbsp;%</td>
        	                                         <td>".$res->d_ncb."&nbsp;%</td>
        	                                    <tr>

        	                             </table>";   
                          }
                          else
                          {
                               $content .=" <tr style='width:33%;word-break:break-word;'>
        	                            <th style='width:33%;word-break:break-word;'>Class</th>
        	                            <th style='width:33%;word-break:break-word;'>Policy Type</th>";
        	                    if($res->commission_type == "1")
        	                              {
        	                                 $content .="<th style='width:33%;word-break:break-word;'>No of Policy Min- Max</th>";
        	                              }
        	                               else if($res->commission_type == "3")
        	                              {
        	                                $content .="<th style='width:33%;word-break:break-word;'>Target Amount Min- Max</th>";
        	                              }
        	                              
        	                       $content .="</tr>";
        	                       
                              $content .="<tr style='width:33%;word-break:break-word;'>
        	                            <td style='width:33%;word-break:break-word;'>Health</td>
        	                            <td style='width:33%;word-break:break-word;'>".$res->p_type."</td>";
        	                            
        	                            if($res->commission_type == "1")
        	                              {
        	                                   $content .= "<td style='width:33%;word-break:break-word;'>".$res->no_policy_min."-".$res->no_policy_max."</td>";
        	                              }
        	                              else if($res->commission_type == "3")
        	                              {
        	                                   $content .= "<td style='width:33%;word-break:break-word;'>".$res->min_val." - ".$res->max_val."</td>";
        	                              }
        	                       $content .= "</tr>";

        	                       $content .="<table class='table table-bordered'>
        	                                    
        	                                    <tr>
        	                                         <th>Commissions</th>
        	                                         <th>JAYANTHA Comm.</th>
        	                                         <th>A</th>
        	                                         <th>B</th>
        	                                         <th>C</th>
        	                                         <th>D</th>
        	                                    <tr>
        	                                  
        	                                     <tr>
        	                                         <th>ON NET</th>
        	                                         <td>".$res->on_net."&nbsp;%</td>
        	                                         <td>".$res->a_net."&nbsp;%</td>
        	                                         <td>".$res->b_net."&nbsp;%</td>
        	                                         <td>".$res->c_net."&nbsp;%</td>
        	                                         <td>".$res->d_net."&nbsp;%</td>
        	                                    <tr>
        	                                    
        	                                    <tr>
        	                                         <th>NCB</th>
        	                                         <td>".$res->ncb_percentage."&nbsp;%</td>
        	                                         <td>".$res->a_ncb."&nbsp;%</td>
        	                                         <td>".$res->b_ncb."&nbsp;%</td>
        	                                         <td>".$res->c_ncb."&nbsp;%</td>
        	                                         <td>".$res->d_ncb."&nbsp;%</td>
        	                                    <tr>

        	                             </table>";   
                          }
        	                       
        	        
        	                 
        	                              echo $content;
        	              }
       }

       public function delete_commission_entry()
       {
           if($this->session->has_userdata('logged_in'))
    	    {
    	        $id = $this->input->post("id");
    	        $old_data = $this->pm->edit_commission_entry($id);
    	        $res = $this->pm->delete_payout_commission_entry($id);
    	        if( $res ) {
                    $this->audit->log('company_payout_commission', 'DELETE', null, $old_data, null);
    	        }
    	        
    	        $old_mldata = $this->pm->get_make($id);
                $make_log = $this->pm->delete_make_log($id);
                if( $make_log ) {
                    $this->audit->log('com_make_log', 'DELETE', null, $old_mldata, null);
    	        }
    	        
    	        $old_mdldata = $this->pm->get_model1($id);
                $model_log = $this->pm->delete_model_log($id);
                if( $model_log ) {
                    $this->audit->log('com_model_log', 'DELETE', null, $old_mdldata, null);
    	        }
    	        
    	        $old_vldata = $this->pm->get_varient($id);
                $varient_log = $this->pm->delete_varient_log($id);
                if( $varient_log ) {
                    $this->audit->log('com_varient_log', 'DELETE', null, $old_vldata, null);
    	        }
    	        
    	        $old_rldata = $this->pm->get_rto1($id);
                $rto_log = $this->pm->delete_rto_log($id);
                if( $rto_log ) {
                    $this->audit->log('commission_rto_log', 'DELETE', null, $old_rldata, null);
    	        }
                echo "success";
     	    }
       }
       
       public function payout_commission_excel()
       {
           if($this->session->has_userdata('logged_in')) 
        	{
                $this->load->library('Excel');
                $objPHPExcel = new PHPExcel();
                $objPHPExcel->setActiveSheetIndex(0);
                
            	$objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(35);
                $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
                $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
                $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
                $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(15);
                
                $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15);
                $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(15);
                
                
                $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
                $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'JAYANTHA INSURANCE');
                
                $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Payout Commission Report');
                
                $objPHPExcel->getActiveSheet()->getStyle('D3')->applyFromArray(
                		array(
                			'font'  => array(
                				'bold'  => true,
                				'color' => array('rgb' => 'e6e600'),
                				'size'  => 18,
                			),
                		)
                	);
                	$objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray(
                		array(
                			'font'  => array(
                				'bold'  => true,
                				'color' => array('rgb' => '00cc66'),
                				'size'  => 14,
                			),
                		)
                	);
           
            
            $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Excel Date : ');
            $objPHPExcel->getActiveSheet()->SetCellValue('G3', date("d-m-Y"));
    
            $objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->getStyle('4')->applyFromArray(
            array(
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => '31406b')
            ),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
            'font'  => array(
                'bold'  => true,
                'color' => array('rgb' => 'FFFFFF'),
                'size'  => 13,
            ),
            )
        );
        
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'S.No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Insurer');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Premium Cover Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Business Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Class');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Policy Type	');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Classification cc/gvw');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Make');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Model');
        $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Varient');
        $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'Commission Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('L4', 'Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('M4', 'Vechicle Age');
        $objPHPExcel->getActiveSheet()->SetCellValue('N4', 'Vechicle Type(New/old)');
        $objPHPExcel->getActiveSheet()->SetCellValue('O4', 'State');
        $objPHPExcel->getActiveSheet()->SetCellValue('P4', 'RTO');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q4', 'IRDA OD');
        $objPHPExcel->getActiveSheet()->SetCellValue('R4', 'IRDA TP');
        $objPHPExcel->getActiveSheet()->SetCellValue('S4', 'IRDA NET');
        $objPHPExcel->getActiveSheet()->SetCellValue('T4', 'NCB');
        $objPHPExcel->getActiveSheet()->SetCellValue('U4', 'NCB OD');
        $objPHPExcel->getActiveSheet()->SetCellValue('V4', 'NCB TP');
        $objPHPExcel->getActiveSheet()->SetCellValue('W4', 'NCB NET');
        $objPHPExcel->getActiveSheet()->SetCellValue('X4', 'Own Commission');
         $objPHPExcel->getActiveSheet()->SetCellValue('Y4', 'Own OD');
        $objPHPExcel->getActiveSheet()->SetCellValue('Z4', 'Own TP');
        $objPHPExcel->getActiveSheet()->SetCellValue('AA4', 'Own NET');
        $objPHPExcel->getActiveSheet()->SetCellValue('AB4', 'A OD');
        $objPHPExcel->getActiveSheet()->SetCellValue('AC4', 'A TP');
        $objPHPExcel->getActiveSheet()->SetCellValue('AD4', 'A NET');
        $objPHPExcel->getActiveSheet()->SetCellValue('AE4', 'B OD');
        $objPHPExcel->getActiveSheet()->SetCellValue('AF4', 'B TP');
        $objPHPExcel->getActiveSheet()->SetCellValue('AG4', 'B NET');
        $objPHPExcel->getActiveSheet()->SetCellValue('AH4', 'C OD');
        $objPHPExcel->getActiveSheet()->SetCellValue('AI4', 'C TP');
        $objPHPExcel->getActiveSheet()->SetCellValue('AJ4', 'C NET');
        $objPHPExcel->getActiveSheet()->SetCellValue('AK4', 'D OD');
        $objPHPExcel->getActiveSheet()->SetCellValue('AL4', 'D TP');
        $objPHPExcel->getActiveSheet()->SetCellValue('AM4', 'D NET');
        
        
        $row_count = 5;
        $a = 0;
         
        	  $info = $this->pm->payout_commission_excel();
        	 
        foreach($info as $res)
        {
            $a++;
              if($res->class == "1")
               {
                        if($res->policy_type == "1" || $res->policy_type == "3")
                        {
                            $make = $this->pm->fetch_make_car_brand($res->id,$res->policy_type);
                            $model = $this->pm->fetch_car_model_name($res->id,$res->policy_type);
                            $varient = $this->pm->fetch_car_varient_name($res->id,$res->policy_type);
                        }
                        else if($res->policy_type == "2")
                        {
                            $make = $this->pm->fetch_make_bike_brand($res->id,$res->policy_type);
                            $model = $this->pm->fetch_bike_model_name($res->id,$res->policy_type);
                            $varient = $this->pm->fetch_bike_varient_name($res->id,$res->policy_type);
                        }
                        else if($res->policy_type == "4")
                        {
                            $make = $this->pm->fetch_make_e_two_wheeler_brand($res->id,$res->policy_type);
                            $model = $this->pm->fetch_e_two_wheeler_model_name($res->id,$res->policy_type);
                            $varient = $this->pm->fetch_e_two_wheeler_varient_name($res->id,$res->policy_type);
                        }
                        else if($res->policy_type == "7")
                        {
                            $make = $this->pm->fetch_make_pc_brand($res->id,$res->policy_type);
                            $model = $this->pm->fetch_pc_model_name($res->id,$res->policy_type);
                            $varient = $this->pm->fetch_pc_varient_name($res->id,$res->policy_type);
                        }
                        else if($res->policy_type == "8" || $res->policy_type == "9" || $res->policy_type == "10" || $res->policy_type == "15" || $res->policy_type == "16" || $res->policy_type == "61")
                        {
                            $make = $this->pm->fetch_make_gc_brand($res->id,$res->policy_type);
                            $model = $this->pm->fetch_gc_model_name($res->id,$res->policy_type);
                            $varient = $this->pm->fetch_gc_varient_name($res->id,$res->policy_type);
                        }
                        else if($res->policy_type == "20")
                        {
                             $make = $this->pm->fetch_make_misc_brand($res->id,$res->policy_type);
                            $model = $this->pm->fetch_misc_model_name($res->id,$res->policy_type);
                            $varient = $this->pm->fetch_misc_varient_name($res->id,$res->policy_type);
                        }
                        else if($res->policy_type == "55")
                        {
                             $make = $this->pm->fetch_make_scooter_brand($res->id,$res->policy_type);
                            $model = $this->pm->fetch_scooter_model_name($res->id,$res->policy_type);
                            $varient = $this->pm->fetch_scooter_varient_name($res->id,$res->policy_type);
                        }
                        
                    $rto_details = $this->pm->fech_rto_details($res->id);
                    
                }
            	if($res->class == "1")
                {     
            	    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                    $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $res->company_name);
                    $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $res->premium_name);
                    $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $res->b_type);
                    $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , "Motor");
                    $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $res->p_type);
                    $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $res->from_gvw_cc."".$res->classification." - ".$res->to_gvw_cc."".$res->classification);
                 
                   foreach($make as $da)
                   {
                       $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $da->brand_name.",");
                       
                   }
                   foreach($model as $da)
                   {
                        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count ,$da->model_name.",");
                   }
                   foreach($varient as $da)
                   {
                        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row_count , $da->varient_name.",");
                   }
                  
                   
                    $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row_count , $res->c_type);
                    $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row_count , $res->type);
                    
                    if($res->commission_type == "1")
                    {
                        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row_count , $res->no_policy_min." - ".$res->no_policy_max);
                    }
                    else if($res->commission_type == "2")
                    {
                        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row_count , $res->vehicle_age_min." - ".$res->vehicle_age_max);
                    }
                    else if($res->commission_type == "3")
                    {
                        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row_count , $res->min_val." - ".$res->max_val);
                    }
                    
                    
                    $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row_count , $res->vehicle_type);
                    $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row_count , $res->commission_state);
                    
                   foreach($rto_details as $da)
                   {
                      $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row_count , $da->rto);    
                   }
                    $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row_count , $res->irda_od);
                    $objPHPExcel->getActiveSheet()->SetCellValue('R'.$row_count , $res->irda_tp);
                    $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row_count , "");
                    $objPHPExcel->getActiveSheet()->SetCellValue('T'.$row_count , $res->ncb_percentage);
                    $objPHPExcel->getActiveSheet()->SetCellValue('U'.$row_count , $res->a_ncb);
                    $objPHPExcel->getActiveSheet()->SetCellValue('U'.$row_count , $res->b_ncb);
                    $objPHPExcel->getActiveSheet()->SetCellValue('V'.$row_count , $res->c_ncb);
                    $objPHPExcel->getActiveSheet()->SetCellValue('W'.$row_count , $res->d_ncb);
                    $objPHPExcel->getActiveSheet()->SetCellValue('X'.$row_count , $res->own_od);
                    $objPHPExcel->getActiveSheet()->SetCellValue('Y'.$row_count , $res->own_tp);
                    $objPHPExcel->getActiveSheet()->SetCellValue('Z'.$row_count , $res->on_net);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AA'.$row_count , $res->a_od);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AB'.$row_count , $res->a_od);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AC'.$row_count , $res->a_tp);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AD'.$row_count , $res->a_net);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AE'.$row_count , $res->b_od);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AF'.$row_count , $res->b_tp);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AG'.$row_count , $res->b_net);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AH'.$row_count , $res->c_od);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AI'.$row_count , $res->c_tp);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AJ'.$row_count , $res->c_net);
                    $objPHPExcel->getActiveSheet()->SetCellValue('AK'.$row_count , $res->d_od);
            	    $objPHPExcel->getActiveSheet()->SetCellValue('AL'.$row_count , $res->d_tp);     
            	    $objPHPExcel->getActiveSheet()->SetCellValue('AM'.$row_count , $res->d_net);
            	    
            	    
            	    $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                    $row_count++;
                }
                    $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                    $row_count++;
        }
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                $objWriter->save('./datas/reports/payout_commission_report.xlsx');
                echo base_url()."/datas/reports/payout_commission_report.xlsx";
        	}
       }
       
       public function edit_commission_entry()
       {
            if($this->session->has_userdata('logged_in')) 
            { 
                $id = $this->input->post("id");
                $res = $this->pm->edit_commission_entry($id);
                
                if($res -> class == 1)
                {
                        $select_make_arr = $this->pm->fetch_commission_make_log($res->id,$res->policy_type);
                        $select_make = array();
                        
                        foreach($select_make_arr as $sma)
                        {
                        $select_make[] = $sma->make;
                        }
                        
                        $select_model_arr = $this->pm->fetch_commission_model_log($res->id,$res->policy_type);
                        $select_model = array();
                        
                        foreach($select_model_arr as $sma)
                        {
                        $select_model[] = $sma->model_id;
                        }
                        
                        $select_varient_arr = $this->pm->fetch_commission_varient_log($res->id,$res->policy_type);
                        $select_varient = array();
                        
                        foreach($select_varient_arr as $sma)
                        {
                        $select_varient[] = $sma->varient_id;
                        }
                        
                        $vechile_type = $res->policy_type;
                        $make_list = array();
                        if($vechile_type == "1" || $vechile_type == "3")
                        {
                        $make_list = $this->pm->fetch_make_car();
                        }
                        else if($vechile_type == "2")
                        {
                        $make_list = $this->pm->fetch_make_bike();
                        }
                        else if($vechile_type == "4")
                        {
                        $make_list = $this->pm->fetch_make_e_two_wheeler();
                        }
                        else if($vechile_type == "7" || $vechile_type == "12" || $vechile_type == "13" || $vechile_type == "14" || $vechile_type == "59" || $vechile_type == "60" || $vechile_type == "65" || $vechile_type == "66")
                        {
                        $make_list = $this->pm->fetch_make_pc($vechile_type);
                        }
                        else if($vechile_type == "8" || $vechile_type == "9" || $vechile_type == "10" || $vechile_type == "15" || $vechile_type == "16" || $vechile_type == "61")
                        {
                        $make_list = $this->pm->fetch_make_gc($vechile_type);
                        }
                        else if($vechile_type == "20")
                        {
                        $make_list = $this->pm->fetch_make_misc();
                        }
                        else if($vechile_type == "55")
                        {
                        $make_list = $this->pm->fetch_make_scooter();
                        }
                        
                        
                        
                        if($select_make != null)
                        {
                        $vechi_make = $select_make;
                        }
                        else
                        {
                        $vechi_make = array("all");
                        }
                        
                        $model_list = array();
                        
                        if($vechile_type == "1" || $vechile_type == "3")
                        {
                        $model_list = $this->pm->fetch_car_model($vechi_make);
                        }
                        else if($vechile_type == "2")
                        {
                        $model_list = $this->pm->fetch_bike_model($vechi_make);
                        }
                        else if($vechile_type == "4")
                        {
                        $model_list = $this->pm->fetch_e_two_wheeler_model($vechi_make);
                        }
                        else if($vechile_type == "7" || $vechile_type == "12" || $vechile_type == "13" || $vechile_type == "14" || $vechile_type == "59" || $vechile_type == "60" || $vechile_type == "65" || $vechile_type == "66")
                        {
                        $model_list = $this->pm->fetch_pc_model($vechile_type,$vechi_make);
                        }
                        else if($vechile_type == "8" || $vechile_type == "9" || $vechile_type == "10" || $vechile_type == "15" || $vechile_type == "16" || $vechile_type == "61")
                        {
                        $model_list = $this->pm->fetch_gc_model($vechile_type,$vechi_make);
                        }
                        else if($vechile_type == "20")
                        {
                        $model_list = $this->pm->fetch_misc_model($vechi_make);
                        }
                        else if($vechile_type == "55")
                        {
                        $model_list = $this->pm->fetch_scooter_model($vechi_make);
                        }
                        
                        $varient_list = array();
                        if($select_model != null)
                        {
                        $vechi_model = $select_model;
                        }
                        else
                        {
                        $vechi_model = array("all");
                        }
                        if($vechile_type == "1" || $vechile_type == "3")
                        {
                        $varient_list = $this->pm->fetch_car_varient($vechi_make,$vechi_model);
                        }
                        else if($vechile_type == "2")
                        {
                        $varient_list = $this->pm->fetch_bike_varient($vechi_make,$vechi_model);
                        }
                        
                        else if($vechile_type == "4")
                        {
                        $varient_list = $this->pm->fetch_e_two_wheeler_varient($vechi_make,$vechi_model);
                        }
                        
                        if($vechile_type == "7" || $vechile_type == "12" || $vechile_type == "13" || $vechile_type == "14" || $vechile_type == "59" || $vechile_type == "60" || $vechile_type == "65" || $vechile_type == "66")
                        {
                        $varient_list = $this->pm->fetch_pc_varient($vechile_type,$vechi_make,$vechi_model);
                        }
                        else if($vechile_type == "8" || $vechile_type == "9" || $vechile_type == "10" || $vechile_type == "15" || $vechile_type == "16" || $vechile_type == "61")
                        {
                        $varient_list = $this->pm->fetch_gc_varient($vechile_type,$vechi_make,$vechi_model);
                        }
                        
                        else if($vechile_type == "20")
                        {
                        $varient_list = $this->pm->fetch_misc_varient($vechi_make,$vechi_model);
                        }
                        
                        else if($vechile_type == "55")
                        {
                        $varient_list = $this->pm->fetch_scooter_varient($vechi_make,$vechi_model);
                        }
                        
                        $classification_arr = $this->pm->fetch_classification($res->policy_type);
                        
                        $classification_content = "<option value=''>--select--</option>";
                        
                        foreach($classification_arr as $da)
                        {
                        $classification_content .="<option value='".$da->id."'>".$da->from_gvw_cc.$da->classification." - ".$da->to_gvw_cc.$da->classification."</option>";
                        }
                        
                        $select_rto_arr = $this->pm->fetch_select_rto_using_commission_id($res->id);
                        
                        $select_rto = array();
                        
                        foreach($select_rto_arr as $sra)
                        {
                        $select_rto[] = $sra->rto;
                        }
                        
                        $data = array("res" => $res,"class"=>$res->class, "make_list" => $make_list, "model_list" => $model_list, "varient_list" => $varient_list, "select_make" => $select_make, "select_model" => $select_model, "select_varient" => $select_varient, "classification_content" => $classification_content, "select_rto" => $select_rto);
                        
                        echo json_encode($data);
                
                }
                else if($res -> class == 2)
                {
                      echo json_encode(array("class" =>$res->class,"data"=>$res));
                }
            }
        }
      
        public function edit_check_payout_entry() 
	    {
	        if($this->session->has_userdata('logged_in'))
    	    {
    	         $insurer_company = $this->input->post("insurer_company");
                 $insurer_class = $this->input->post("insurer_class");
                 $business_type = $this->input->post("business_type");
                 $premium_c_type = $this->input->post("premium_c_type");
                 $policy_type = $this->input->post("policy_type");
                 $commission_type = $this->input->post("commission_type");
                 $add_type = $this->input->post("add_type");
                 $v_type = "";
                 $id = $this->input->post("id");
                 $make = explode(",",$this->input->post("make"));
                 $model = explode(",",$this->input->post("model"));
                 $varient = explode(",",$this->input->post("varient"));
                 $fuel_type = $this->input->post("fuel_type");
                 $ins_classification = $this->input->post("ins_classification");
                 $ins_state = $this->input->post("ins_state");
                 $ins_rto = explode(",",$this->input->post("ins_rto"));
                 $vehicle_age_min = $this->input->post("vehicle_age_min");
                 $vehicle_age_max = $this->input->post("vehicle_age_max");

                // nop
                $no_policy_min = $this->input->post("no_policy_min");
                $no_policy_max = $this->input->post("no_policy_max");
                
                // target amount
                $min_amount = $this->input->post("min_amount");
                $max_amount = $this->input->post("max_amount");
                
                $f_date = $this->input->post("f_date");
                $to_date = $this->input->post("to_date");
                
                $rto_category = $this->input->post("rto_category");
                
                // start 2023-08-17
                $payout_type = $this->input->post("payout_type");
                
                 $commission_id = [];
                 
                 $status = "0";
                 $make_status = "0";
                 $model_status = "0";
                 $varient_status = "0";
                 $rto_status = "0";
                 $fuel_status = "0";
                 $gvw_status = "0";
                 
                 $g_status = "0";
                 $fuel_type_status = "0";
                 
                 $com_policy_id = "";
               
                   if($insurer_class == "1")
                   {
                     if($commission_type == "2")
                     {
                        $check = $this->pm->edit_check_vechi_age_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$id,$add_type, $payout_type);
        	            
        	                foreach($check as $da)
                    		{
                        		    $temp_min = $da->vehicle_age_min;
                        		    $temp_max = $da->vehicle_age_max;
                        		    
                        		    $g_status = "0";
                    		        $fuel_status = "0";
                        		    
                        		    if($temp_min <= $vehicle_age_min && $temp_max >= $vehicle_age_min)
                    				{
                    					$g_status = "1";
                    				}
                    				if($temp_min <= $vehicle_age_max && $temp_max >= $vehicle_age_max)
                    				{
                    					$g_status = "1";
                    				}
                    				if($temp_min > $vehicle_age_min && $temp_max < $vehicle_age_max)
                    				{
                    					$g_status = "1";
                    				}
                    				
                    				
                            		    if($fuel_type == "1")
                            		    {
                            				if($da->fuel_type == "4" || $da->fuel_type == "1" )
                            				{
                            				    $fuel_status = "1";
                            				}
                            			}
                            			if($fuel_type == "2")
                            			{
                            			    if($da->fuel_type == "5" || $da->fuel_type == "2")
                            				{
                            				    $fuel_status = "1";
                            				}
                            			}
                            			if($fuel_type == "5")
                            			{
                            			    if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2")
                            				{
                            				    $fuel_status = "1";
                            				}
                            			}
                            			if($fuel_type == "6")
                            			{
                            			    if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                            				{
                            				    $fuel_status = "1";
                            				}
                            			}
                            			if($fuel_type == "7")
                            			{
                            			    if($da->fuel_type == "7")
                            				{
                            				    $fuel_status = "1";
                            				}
                            			}
                            		
                            			if($g_status == "1" && $fuel_status == "1")
                            			{
                            			    $commission_id[] = $da->id;
                            			    $status = "1";
                    	                    $fuel_type_status = "1";
                            			}
                    		      }
                    		      
                            if($status == "1")
                            {
                                if($ins_classification != "")
                                {
                                   $classification = $this->pm->get_classification($commission_id,$ins_classification,$policy_type);
                                
                                    if(count($classification > 0))
                                    {
                                       $commission_id = [];
                                       
                                       foreach($classification as $da)
                                       {
                                           $commission_id[] = $da->id;
                                       }
                                       
                                       $gvw_status = "1";
                                    }
                                }
                                else
                                {
                                   $commission_id = [];
                                   $gvw_status = "1";
                                }
                                
                                $check_make = $this->pm->check_make_all_already_exits($commission_id,$policy_type);
                                
                                if(count($check_make) > 0)
                                {
                                    $commission_id = [];
                                    
                                    foreach($check_make as $da)
                                    {
                                         $commission_id[] = $da->id;
                                    }
                                    
                                    $status = "1";
                                    $make_status = "1";
                                }
                                else
                                {
                                     $check_make_1 = $this->pm->check_make_already_exits($commission_id,$policy_type,$make);
                                        
                                        if(count($check_make_1) > 0)
                                        {
                                            $commission_id = [];
                                            
                                            foreach($check_make as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                                    
                                            $status = "1";
                                            $make_status = "1";
                                        }
                                        else
                                        {
                                            $make_status = "0";
                                        }
                                }
                                    
                                if($make_status == "1")
                                {
                                    $check_model = $this->pm->check_model_all_already_exits($commission_id,$policy_type);
                                    
                                    if(count($check_model) > 0)
                                    {
                                            $commission_id = [];
                                            foreach($check_make as $da)
                                            {
                                                 $commission_id[] = $da->id;
                                            }
                                         $status = "1";
                                         $model_status = "1";
                                    }
                                    else
                                    {
                                        $check_model_1 = $this->pm->check_model_already_exits($commission_id,$policy_type,$make,$model);
                                        
                                        if(count($check_model_1) > 0)
                                        {
                                                $commission_id = [];
                                                foreach($check_make as $da)
                                                {
                                                     $commission_id[] = $da->commission_id;
                                                }
                                             $status = "1";
                                             $model_status = "1";
                                        }
                                        else
                                        {
                                            $model_status = "0";
                                        }
                                    }
                                }
                                
                                if($make_status == "1" && $model_status == "1")
                                {
                                    $check_varient = $this->pm->check_varient_all_already_exits($commission_id,$policy_type);
                                  
                                    if(count($check_varient) > 0)
                                    {
                                        $commission_id = [];
                                        foreach($check_make as $da)
                                        {
                                             $commission_id[] = $da->id;
                                        }
                                         $status = "1";
                            	         $varient_status = "1";
                                    }
                                    else 
                                    {
                                      $check_varient_1 = $this->pm->check_varient_already_exits($commission_id,$policy_type,$make,$model,$varient);
                        	           
                        	            if(count($check_varient_1) > 0)
                        	            {
                            	            $commission_id = [];
                                            foreach($check_make as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                        	                 $status = "1";
                        	                 $varient_status = "1";
                        	            }
                        	            else
                        	            {
                        	                 $varient_status = "0";
                        	            }
                                    }
                                }
                                
                               $ins_rto_1 = []; 
                                
                                if($status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                {
                                      if($rto_category == "ROTN_Exclude")
                                      {
                                          $get_rto = $this->pm->get_rto($ins_rto);
                                          
                                          foreach($get_rto as $da)
                                          {
                                               $ins_rto_1[] = $da->rto_no;
                                          }
                                          
                                           $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                          
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                                echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                            }
                                            else
                                            {
                                                echo json_encode(array("status"=>"success"));
                                            }
                                      }
                                      else if($rto_category == "KA_Exclude")
                                      {
                                              $get_rto = $this->pm->get_rto_ka($ins_rto);
                                              
                                              foreach($get_rto as $da)
                                              {
                                                   $ins_rto_1[] = $da->rto_no;
                                              }
                                              
                                               $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                              
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status = "1";
                                                    echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                }
                                                else
                                                {
                                                    echo json_encode(array("status"=>"success"));
                                                }
                                          }
                                      else
                                      {
                                           if(in_array('chennai',$ins_rto) || in_array('Coimbatore',$ins_rto) || in_array('Madurai',$ins_rto))
                                           {
                                               $city_rto = $this->pm->get_city_rto($ins_rto);
                                               
                                              for($i=0;$i<=count($ins_rto);$i++)
                                          	  {
                                          	            if(in_array("chennai",$ins_rto))
                                          	            {
                                          	                  unset($ins_rto[$i]);
                                          	            }
                                          	            else if(in_array("Coimbatore",$ins_rto))
                                          	            {
                                          	                unset($ins_rto[$i]);
                                          	            }
                                          	            else if(in_array("Madurai",$ins_rto))
                                          	            {
                                          	                unset($ins_rto[$i]);
                                          	            }
                                          	     }
                                          	     
                                          	   $get_rto = $this->pm->get_rto_no($ins_rto);
                                            
                                               foreach($city_rto as $da)
                                               {
                                                   $ins_rto_1[] = $da->rto_no;
                                               }
                                             
                                              if($get_rto != null)
                                              {
                                                   foreach($get_rto as $da)
                                                   {
                                                        $ins_rto_1[] = $da->rto_no;
                                                   }
                                              }
                                              
                                               $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                              
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status = "1";
                                                    echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                }
                                                else
                                                {
                                                    echo json_encode(array("status"=>"success"));
                                                }
                                           }
                                           else if(in_array("ROTN",$ins_rto))
                                           {
                                               $get_rotn_rto = $this->pm->get_rotn_rto();
                                               
                                               foreach($get_rotn_rto as $da)
                                               {
                                                    $ins_rto_1[] = $da->rto_no;
                                               }
                                               
                                               $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                               
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status = "1";
                                                    echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                }
                                                else
                                                {
                                                    echo json_encode(array("status"=>"success"));
                                                }
                                           }
                                           else if(in_array("All TN",$ins_rto))
                                           {
                                                $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                                                
                                                   foreach($get_all_tn_rto as $da)
                                                   {
                                                        $ins_rto_1[] = $da->rto_no;
                                                   }
                                                $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                                
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status = "1";
                                                    echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                }
                                                else
                                                {
                                                    echo json_encode(array("status"=>"success"));
                                                }
                                           }
                                           else if(in_array("All RTO",$ins_rto))
                                           {
                                               $get_all_rto = $this->pm->get_all_rto_list();
                                               
                                               foreach($get_all_rto as $da)
                                               {
                                                      $ins_rto_1[] = $da->rto_no;
                                               }
                                               
                                                $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                                
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status = "1";
                                                    echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                }
                                                else
                                                {
                                                    echo json_encode(array("status"=>"success"));
                                                }
                                           }
                                           else if(in_array('Bangalore',$ins_rto))
                                           {
                                              $city_rto = $this->pm->get_ka_city_rto($ins_rto);
                                              
                                              for($i=0;$i<=count($ins_rto);$i++)
                                              {
                                      	            if(in_array("Bangalore",$ins_rto))
                                      	            {
                                      	                  unset($ins_rto[$i]);
                                      	            }
                                              	}
                                              	     
                                                $get_rto = $this->pm->get_rto_no($ins_rto);
                                                
                                                foreach($city_rto as $da)
                                                {
                                                    $ins_rto_1[] = $da->rto_no;
                                                }
                                                
                                                if($get_rto != null)
                                                {
                                                    foreach($get_rto as $da)
                                                    {
                                                        $ins_rto_1[] = $da->rto_no;
                                                    }
                                                }
                                                  
                                                   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                                  
                                                    if(count($check_rto) > 0)
                                                    {
                                                        $rto_status = "1";
                                                        echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                    }
                                                    else
                                                    {
                                                        echo json_encode(array("status"=>"success"));
                                                    }
                                          }
                                           else
                                           {
                                                $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto);
                                                
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status = "1";
                                                    echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                }
                                                else
                                                {
                                                   echo json_encode(array("status"=>"success"));
                                                }
                                            }
                                      }
                                }
                                else
                                {
                                    echo json_encode(array("status"=>"success"));
                                }
                            }
                            else
                            {
                               echo json_encode(array("status"=>"success"));
                            }
        	             
        	            
                    
                      }
                     else if($commission_type == "1")
                     {
                         $check = $this->pm->edit_check_this_com_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$id,$add_type);
                         
                            $ins_rto_1 = []; 
                            
                            $commission_id = [];
                            
                            foreach($check as $da)
                            {
                                $commission_id[] = $da->id;
                            }

                            if($rto_category == "ROTN_Exclude")
                            {
                               $get_rto = $this->pm->get_rto($ins_rto);
                               
                                foreach($get_rto as $da)
                                {
                                   $ins_rto_1[] = $da->rto_no;
                                }
                            
                               $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                            
                                if(count($check_rto) > 0)
                                {
                                    $rto_status = "1";
                                    
                                    $commission_id = [];
                                    
                                      foreach($check_rto as $da)
                                      {
                                          $commission_id[] = $da->commission_id;
                                      }    
                                   
                                }
                            }
                            else if($rto_category == "KA_Exclude")
                            {
                                    $get_rto = $this->pm->get_rto_ka($ins_rto);
                                    
                                    foreach($get_rto as $da)
                                    {
                                    $ins_rto_1[] = $da->rto_no;
                                    }
                                    
                                    $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                    
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                    }
                                    else
                                    {
                                        echo json_encode(array("status"=>"success"));
                                    }
                            }
                            else
                            {
                                if(in_array('chennai',$ins_rto) || in_array('Coimbatore',$ins_rto) || in_array('Madurai',$ins_rto))
                                {
                                   $city_rto = $this->pm->get_city_rto($ins_rto);
                                   
                                  for($i=0;$i<=count($ins_rto);$i++)
                                  {
                                              if(in_array("chennai",$ins_rto))
                                              {
                                                    unset($ins_rto[$i]);
                                              }
                                              else if(in_array("Coimbatore",$ins_rto))
                                              {
                                                  unset($ins_rto[$i]);
                                              }
                                              else if(in_array("Madurai",$ins_rto))
                                              {
                                                  unset($ins_rto[$i]);
                                              }
                                       }
                                       
                                  $get_rto = $this->pm->get_rto_no($ins_rto);
                                
                                   foreach($city_rto as $da)
                                   {
                                       $ins_rto_1[] = $da->rto_no;
                                   }
                                
                                  if($get_rto != null || $get_rto != "")
                                  {
                                       foreach($get_rto as $da)
                                       {
                                            $ins_rto_1[] = $da->rto_no;
                                       }
                                    }
                                   
                                   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                  
                                    if(count($check_rto) > 0)
                                    {
                                         $rto_status = "1";
                                         
                                         $commission_id = [];
                                        
                                          foreach($check_rto as $da)
                                          {
                                             $commission_id[] = $da->commission_id;
                                          }
                                    }
                                }
                                else if(in_array("ROTN",$ins_rto))
                                {
                                   $get_rotn_rto = $this->pm->get_rotn_rto();
                                   
                                   foreach($get_rotn_rto as $da)
                                   {
                                        $ins_rto_1[] = $da->rto_no;
                                   }
                                   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                   
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        
                                          $commission_id = [];
                                        
                                          foreach($check_rto as $da)
                                          {
                                            $commission_id[] = $da->commission_id;
                                          }
                                    }
                                }
                                else if(in_array("All TN",$ins_rto))
                                {
                                    $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                                    
                                       foreach($get_all_tn_rto as $da)
                                       {
                                            $ins_rto_1[] = $da->rto_no;
                                       }
                                    $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                    
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        
                                        $commission_id = [];
                                        
                                        foreach($check_rto as $da)
                                        {
                                            $commission_id[] = $da->commission_id;
                                        }
                                    }
                                }
                                else if(in_array("All RTO",$ins_rto))
                                {
                                   $get_all_rto = $this->pm->get_all_rto_list();
                                   
                                   foreach($get_all_rto as $da)
                                   {
                                          $ins_rto_1[] = $da->rto_no;
                                   }
                                   
                                    $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                    
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        
                                        $commission_id = [];
                                        
                                        foreach($check_rto as $da)
                                        {
                                            $commission_id[] = $da->commission_id;
                                        }
                                    }
                                }
                                else if(in_array('Bangalore',$ins_rto))
                                {
                                  $city_rto = $this->pm->get_ka_city_rto($ins_rto);
                                
                                for($i=0;$i<=count($ins_rto);$i++)
                                {
                                      if(in_array("Bangalore",$ins_rto))
                                      {
                                            unset($ins_rto[$i]);
                                      }
                                  }
                                       
                                $get_rto = $this->pm->get_rto_no($ins_rto);
                                
                                foreach($city_rto as $da)
                                {
                                    $ins_rto_1[] = $da->rto_no;
                                }
                                
                                if($get_rto != null)
                                {
                                    foreach($get_rto as $da)
                                    {
                                        $ins_rto_1[] = $da->rto_no;
                                    }
                                }
                                  
                                   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                  
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                    }
                                    else
                                    {
                                        echo json_encode(array("status"=>"success"));
                                    }
                                }
                                else
                                {
                                    $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto);
                                    
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                         
                                         $commission_id = [];
                                         
                                        foreach($check_rto as $da)
                                        {
                                            $commission_id[] = $da->commission_id;
                                        }
                                    }
                                }
                            }

                            if($rto_status == "0" || $commission_id == "")
                            {
                                $last_policy_id = $this->pm->get_last_policy_id();
                                
                                if($last_policy_id == "")
                                {
                                        $com_policy_id = "1";
                                        $arr = array("policy_id" => $com_policy_id);
                                        $insert = $this->pm->add_policy_id($arr);
                                        if( $insert ) {
                                            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                        }
                                }
                                else
                                {
                                    $max_policy_id = $last_policy_id->policy_id;
                                    $com_policy_id = $max_policy_id+1;
                                    $arr = array("policy_id" => $com_policy_id);
                                    $insert = $this->pm->add_policy_id($arr);
                                    if( $insert ) {
                                        $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                    }
                                }
                                echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                            }
                            else if($rto_status == "1")
                            {
                                $check_make = $this->pm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                if(count($check_make) > 0)
                                {
                                    $commission_id = [];
                                    
                                    foreach($check_make as $da)
                                    {
                                         $commission_id[] = $da->id;
                                    }
                                    
                                    $make_status = "1";
                                }
                                else
                                {
                                     $check_make_1 = $this->pm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                        
                                        if(count($check_make_1) > 0)
                                        {
                                            $commission_id = [];
                                            
                                            foreach($check_make_1 as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                                    
                                            $make_status = "1";
                                        }
                                        else
                                        {
                                            $make_status = "0";
                                        }
                                }
                                    
                                if($make_status == "1")
                                {
                                    $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                                    
                                    if(count($check_model) > 0)
                                    {
                                            $commission_id = [];
                                            foreach($check_model as $da)
                                            {
                                                 $commission_id[] = $da->id;
                                            }
                                         $model_status = "1";
                                    }
                                    else
                                    {
                                        $check_model_1 = $this->pm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                        
                                        if(count($check_model_1) > 0)
                                        {
                                                $commission_id = [];
                                                
                                                foreach($check_model_1 as $da)
                                                {
                                                     $commission_id[] = $da->commission_id;
                                                }
                                             $model_status = "1";
                                        }
                                        else
                                        {
                                            $model_status = "0";
                                        }
                                    }
                                }
                                
                                if($make_status == "1" && $model_status == "1")
                                {
                                    $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                                  
                                    if(count($check_varient) > 0)
                                    {
                                        $commission_id = [];
                                        
                                        foreach($check_varient as $da)
                                        {
                                             $commission_id[] = $da->id;
                                        }
                            	         $varient_status = "1";
                                    }
                                    else 
                                    {
                                      $check_varient_1 = $this->pm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$varient);
                        	           
                        	            if(count($check_varient_1) > 0)
                        	            {
                            	            $commission_id = [];
                                            foreach($check_varient_1 as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                        	                 $varient_status = "1";
                        	            }
                        	            else
                        	            {
                        	                 $varient_status = "0";
                        	            }
                                    }
                                }
                                
                                if($ins_classification != "")
                                {
                                   $classification = $this->pm->get_classification(array_unique($commission_id),$ins_classification,$policy_type);
                                
                                    if(count($classification > 0))
                                    {
                                       $commission_id = [];
                                       
                                       foreach($classification as $da)
                                       {
                                           $commission_id[] = $da->id;
                                       }
                                       
                                       $gvw_status = "1";
                                    }
                                }
                                else
                                {
                                   $gvw_status = "1";
                                }
                                

                               $check =$this->pm->check_this_com_already_exits_by_commission_id($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type,array_unique($commission_id));
                         
                                 if(count($check) > 0)
                                 {
                                       foreach($check as $da)
                                	   {
                                	            $g_status = "0";
                                	            $fuel_status = "0";
                                	            
                                                $temp_min = $da->no_policy_min;
                                				$temp_max = $da->no_policy_max;
                                				
                                				if($temp_min <= $no_policy_min && $temp_max >= $no_policy_min)
                                				{
                                					$g_status = "1";
                                				}
                                				if($temp_min <= $no_policy_max && $temp_max >= $no_policy_max)
                                				{
                                					$g_status = "1";
                                				}
                                				if($temp_min > $no_policy_min && $temp_max < $no_policy_max)
                                				{
                                					$g_status = "1";
                                				}
                                
                                                if($fuel_type == "1")
                                                {
                                                	if($da->fuel_type == "4" || $da->fuel_type == "1" )
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "2")
                                                {
                                                    if($da->fuel_type == "5" || $da->fuel_type == "2")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "5")
                                                {
                                                    if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "6")
                                                {
                                                    if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "7")
                                                {
                                                    if($da->fuel_type == "7")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($g_status == "1" && $fuel_status == "1")
                                    			{
                                    			    $status = "1";
                            	                    $fuel_type_status = "1";
                            	                    break;
                                    			}
                                    			else if($g_status == "0" && $fuel_status == "1")
                                    			{
                                    			    $nop_status = "1";
                                    			    $commission_id = [];
                                    			    $commission_id[] = $da->id;
                                    			}
                                        }
                                        
                                        if($rto_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1" && $gvw_status == "1" && $status == "1")
                                        {
                                        	 echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                        }
                                        else if($nop_status == "1")
                                        {
                                            $get_nop_id = $this->pm->get_no_of_policy_id($commission_id);
                                            
                                            if($get_nop_id != "")
                                            {
                                                echo json_encode(array("status"=>"success","no_of_policy_id"=>$get_nop_id->no_of_policy_id));
                                            }
                                        }
                                 }
                                 else
                                 {
                                    $last_policy_id = $this->pm->get_last_policy_id();
                                    
                                    if($last_policy_id == "")
                                    {
                                            $com_policy_id = "1";
                                            $arr = array("policy_id" => $com_policy_id);
                                            $insert = $this->pm->add_policy_id($arr);
                                            if( $insert ) {
                                                $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                            }
                                    }
                                    else
                                    {
                                        $max_policy_id = $last_policy_id->policy_id;
                                        $com_policy_id = $max_policy_id+1;
                                        $arr = array("policy_id" => $com_policy_id);
                                        $insert = $this->pm->add_policy_id($arr);
                                        if( $insert ) {
                                            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                        }
                                    }
                                    echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                                 }
                            }
                    }
                     else if($commission_type == "3")
                     {
                        $check = $this->pm->edit_check_target_amount_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$id,$add_type);
                        
                        $ins_rto_1 = []; 
                        $commission_id = [];
                        
                        foreach($check as $da)
                        {
                           $commission_id[] = $da->id;
                        }
                        
                        if($rto_category == "ROTN_Exclude")
                        {
                           $get_rto = $this->pm->get_rto($ins_rto);
                        
                            foreach($get_rto as $da)
                            {
                               $ins_rto_1[] = $da->rto_no;
                            }
                        
                            $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                        
                            if(count($check_rto) > 0)
                            {
                                $rto_status = "1";
                                
                                $commission_id = [];
                                
                                  foreach($check_rto as $da)
                                  {
                                      $commission_id[] = $da->commission_id;
                                  }    
                               
                            }
                        }
                        else if($rto_category == "KA_Exclude")
                        {
                            $get_rto = $this->pm->get_rto_ka($ins_rto);
                            
                            foreach($get_rto as $da)
                            {
                               $ins_rto_1[] = $da->rto_no;
                            }
                            
                            $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                            
                            if(count($check_rto) > 0)
                            {
                                $rto_status = "1";
                                echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                            }
                            else
                            {
                                echo json_encode(array("status"=>"success"));
                            }
                        }
                        else
                        {
                            if(in_array('chennai',$ins_rto) || in_array('Coimbatore',$ins_rto) || in_array('Madurai',$ins_rto))
                            {
                               $city_rto = $this->pm->get_city_rto($ins_rto);
                               
                              for($i=0;$i<=count($ins_rto);$i++)
                              {
                                          if(in_array("chennai",$ins_rto))
                                          {
                                                unset($ins_rto[$i]);
                                          }
                                          else if(in_array("Coimbatore",$ins_rto))
                                          {
                                              unset($ins_rto[$i]);
                                          }
                                          else if(in_array("Madurai",$ins_rto))
                                          {
                                              unset($ins_rto[$i]);
                                          }
                                   }
                                   
                              $get_rto = $this->pm->get_rto_no($ins_rto);
                            
                               foreach($city_rto as $da)
                               {
                                   $ins_rto_1[] = $da->rto_no;
                               }
                            
                              if($get_rto != null || $get_rto != "")
                              {
                                   foreach($get_rto as $da)
                                   {
                                        $ins_rto_1[] = $da->rto_no;
                                   }
                                }
                               
                               $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                              
                                if(count($check_rto) > 0)
                                {
                                     $rto_status = "1";
                                     
                                     $commission_id = [];
                                    
                                      foreach($check_rto as $da)
                                      {
                                         $commission_id[] = $da->commission_id;
                                      }
                                }
                            }
                            else if(in_array("ROTN",$ins_rto))
                            {
                               $get_rotn_rto = $this->pm->get_rotn_rto();
                               
                               foreach($get_rotn_rto as $da)
                               {
                                    $ins_rto_1[] = $da->rto_no;
                               }
                               $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                               
                                if(count($check_rto) > 0)
                                {
                                    $rto_status = "1";
                                    
                                      $commission_id = [];
                                    
                                      foreach($check_rto as $da)
                                      {
                                        $commission_id[] = $da->commission_id;
                                      }
                                }
                            }
                            else if(in_array("All TN",$ins_rto))
                            {
                                $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                                
                                   foreach($get_all_tn_rto as $da)
                                   {
                                        $ins_rto_1[] = $da->rto_no;
                                   }
                                $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                
                                if(count($check_rto) > 0)
                                {
                                    $rto_status = "1";
                                    
                                    $commission_id = [];
                                    
                                    foreach($check_rto as $da)
                                    {
                                        $commission_id[] = $da->commission_id;
                                    }
                                }
                            }
                            else if(in_array("All RTO",$ins_rto))
                            {
                               $get_all_rto = $this->pm->get_all_rto_list();
                               
                               foreach($get_all_rto as $da)
                               {
                                      $ins_rto_1[] = $da->rto_no;
                               }
                               
                                $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                
                                if(count($check_rto) > 0)
                                {
                                    $rto_status = "1";
                                    
                                    $commission_id = [];
                                    
                                    foreach($check_rto as $da)
                                    {
                                        $commission_id[] = $da->commission_id;
                                    }
                                }
                            }
                            else if(in_array('Bangalore',$ins_rto))
                            {
                              $city_rto = $this->pm->get_ka_city_rto($ins_rto);
                              
                              for($i=0;$i<=count($ins_rto);$i++)
                              {
                            		if(in_array("Bangalore",$ins_rto))
                            		{
                            			  unset($ins_rto[$i]);
                            		}
                            	}
                            		 
                            	$get_rto = $this->pm->get_rto_no($ins_rto);
                            	
                            	foreach($city_rto as $da)
                            	{
                            		$ins_rto_1[] = $da->rto_no;
                            	}
                            	
                            	if($get_rto != null)
                            	{
                            		foreach($get_rto as $da)
                            		{
                            			$ins_rto_1[] = $da->rto_no;
                            		}
                            	}
                            	  
                            	   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                            	  
                            		if(count($check_rto) > 0)
                            		{
                            			$rto_status = "1";
                            			echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                            		}
                            		else
                            		{
                            			echo json_encode(array("status"=>"success"));
                            		}
                            }
                            else
                            {
                                $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto);
                                
                                if(count($check_rto) > 0)
                                {
                                    $rto_status = "1";
                                     
                                     $commission_id = [];
                                     
                                    foreach($check_rto as $da)
                                    {
                                        $commission_id[] = $da->commission_id;
                                    }
                                }
                            }
                        }
                        
                        if($rto_status == "0" || $commission_id == "")
                        {
                           $last_net_id = $this->cm->get_last_net_premium_id();
                        
                            if($last_net_id->net_premium_id == "")
                            {
                            	$com_net_premium_id = "1";
                            	$arr = array("net_premium_id" => $com_net_premium_id);
                            	$insert = $this->pm->add_net_premium_id($arr);
                            	if( $insert ) {
                                    $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                }
                            	echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                            }
                            else
                            {
                            	$max_net_premium_id = $last_net_id->net_premium_id;
                            	$com_net_premium_id = $max_net_premium_id+1;
                            	$arr = array("net_premium_id" => $com_net_premium_id);
                            	$insert = $this->pm->add_net_premium_id($arr);
                            	if( $insert ) {
                                    $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                }
                            	echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                            }
                        }
                        else if($rto_status == "1")
                        {
                            $check_make = $this->pm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                            
                            if(count($check_make) > 0)
                            {
                                $commission_id = [];
                                
                                foreach($check_make as $da)
                                {
                                     $commission_id[] = $da->id;
                                }
                                
                                $make_status = "1";
                        }
                        else
                        {
                             $check_make_1 = $this->pm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                
                                if(count($check_make_1) > 0)
                                {
                                    $commission_id = [];
                                    
                                    foreach($check_make_1 as $da)
                                    {
                                         $commission_id[] = $da->commission_id;
                                    }
                            
                                    $make_status = "1";
                                }
                                else
                                {
                                    $make_status = "0";
                                }
                        }
                        if($make_status == "1")
                        {
                            $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                            
                            if(count($check_model) > 0)
                            {
                                    $commission_id = [];
                        			
                                    foreach($check_model as $da)
                                    {
                                         $commission_id[] = $da->id;
                                    }
                                 $model_status = "1";
                            }
                            else
                            {
                                $check_model_1 = $this->pm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                
                                if(count($check_model_1) > 0)
                                {
                                        $commission_id = [];
                                        
                                        foreach($check_model_1 as $da)
                                        {
                                             $commission_id[] = $da->commission_id;
                                        }
                                     $model_status = "1";
                                }
                                else
                                {
                                    $model_status = "0";
                                }
                            }
                        }
                        
                        if($make_status == "1" && $model_status == "1")
                        {
                            $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                          
                            if(count($check_varient) > 0)
                            {
                                $commission_id = [];
                                
                                foreach($check_varient as $da)
                                {
                                     $commission_id[] = $da->id;
                                }
                                 $varient_status = "1";
                            }
                            else 
                            {
                              $check_varient_1 = $this->pm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$varient);
                               
                                if(count($check_varient_1) > 0)
                                {
                                    $commission_id = [];
                                    foreach($check_varient_1 as $da)
                                    {
                                         $commission_id[] = $da->commission_id;
                                    }
                                     $varient_status = "1";
                                }
                                else
                                {
                                     $varient_status = "0";
                                }
                            }
                        }
                        
                        if($ins_classification != "")
                        {
                           $classification = $this->pm->get_classification(array_unique($commission_id),$ins_classification,$policy_type);
                        
                            if(count($classification > 0))
                            {
                               $commission_id = [];
                               
                               foreach($classification as $da)
                               {
                                   $commission_id[] = $da->id;
                               }
                               
                               $gvw_status = "1";
                            }
                        }
                        else
                        {
                           $gvw_status = "1";
                        }
                        
                        $check =$this->pm->check_target_amount_already_exits_by_commission_id($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type,array_unique($commission_id));
                        
                         if(count($check) > 0)
                         {
                               foreach($check as $da)
                        	   {
                        	            $g_status = "0";
                        	            $fuel_status = "0";
                        	            
                                        $temp_min = $da->min_val;
                        				$temp_max = $da->max_val;
                        				
                        				if($temp_min <= $min_amount && $temp_max >= $min_amount)
                        				{
                        					$g_status = "1";
                        				}
                        				if($temp_min <= $max_amount && $temp_max >= $max_amount)
                        				{
                        					$g_status = "1";
                        				}
                        				if($temp_min > $min_amount && $temp_max < $max_amount)
                        				{
                        					$g_status = "1";
                        				}
                        
                                        if($fuel_type == "1")
                                        {
                                        	if($da->fuel_type == "4" || $da->fuel_type == "1")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                                        if($fuel_type == "2")
                                        {
                                            if($da->fuel_type == "5" || $da->fuel_type == "2")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                                        if($fuel_type == "5")
                                        {
                                            if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                                        if($fuel_type == "6")
                                        {
                                            if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                                        if($fuel_type == "7")
                                        {
                                            if($da->fuel_type == "7")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                                        if($g_status == "1" && $fuel_status == "1")
                            			{
                            			    $status = "1";
                                            $fuel_type_status = "1";
                                            break;
                            			}
                            			else if($g_status == "0" && $fuel_status == "1")
                            			{
                            			    $net_status = "1";
                            			    $commission_id = [];
                            			    $commission_id[] = $da->id;
                            			}
                                }
                        
                                if($rto_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1" && $gvw_status == "1" && $status == "1")
                                {
                                	 echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                }
                                else if($net_status == "1")
                                {
                        			$get_net_id = $this->pm->get_net_id(array_unique($commission_id));
                        
                        			if($get_net_id != "")
                        			{
                        				echo json_encode(array("status"=>"success","net_id"=>$get_net_id->net_premium_id));
                        			}
                                }
                         }
                         else
                         {
                        		$last_net_id = $this->cm->get_last_net_premium_id();
                        		
                        		if($last_net_id->net_premium_id == "")
                        		{
                        			$com_net_premium_id = "1";
                        			$arr = array("net_premium_id" => $com_net_premium_id);
                        			$insert = $this->pm->add_net_premium_id($arr);
                        			if( $insert ) {
                                        $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                    }
                        			echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                        		}
                        		else
                        		{
                        			$max_net_premium_id = $last_net_id->net_premium_id;
                        			$com_net_premium_id = $max_net_premium_id+1;
                        			$arr = array("net_premium_id" => $com_net_premium_id);
                        			$insert = $this->pm->add_net_premium_id($arr);
                        			if( $insert ) {
                                        $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                    }
                        			echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                        		}
                         }
                        }
                      }
                   }
                   else
        	       {
        	             if($commission_type == "1")
                         {
                                $check =$this->pm->edit_check_health_this_com_already_exits($insurer_company,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$id);
                                
                                foreach($check as $da)
                        		{
                            		    $temp_min = $da->no_policy_min;
                            		    $temp_max = $da->no_policy_max;
                            		    
                            		    $g_status = "0";
    
                            		    if($temp_min <= $no_policy_min && $temp_max >= $no_policy_min)
                        				{
                        					$g_status = "1";
                        				}
                        				if($temp_min <= $no_policy_max && $temp_max >= $no_policy_max)
                        				{
                        					$g_status = "1";
                        				}
                        				if($temp_min > $no_policy_min && $temp_max < $no_policy_max)
                        				{
                        					$g_status = "1";
                        				}
                        				
                            			if($g_status == "1")
                            			{
                            			    $status = "1";
                            			}
                            			else
                            			{
                            			     $commission_id[] = $da->id;
                            			}
                        		  }
                        		  
                        		  if(count($check) > 0)
                        		  {
                            		  if($status == "1")
                            		  {
                            		      echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                            		  }
                            		  else
                            		  {
                            		       $get_nop_id = $this->pm->get_no_of_policy_id($commission_id);
                                            
                                            if($get_nop_id != "")
                                            {
                                               echo json_encode(array("status"=>"success","no_of_policy_id"=>$get_nop_id->no_of_policy_id));
                                            }
                            		  }
                        		  }
                        		  else
                        		  {
                            		    $last_policy_id = $this->pm->get_last_policy_id();
                                        
                                        if($last_policy_id == "")
                                        {
                                                $com_policy_id = "1";
                                                $arr = array("policy_id" => $com_policy_id);
                                                $insert = $this->pm->add_policy_id($arr);
                                                if( $insert ) {
                                                    $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                                }
                                        }
                                        else
                                        {
                                            $max_policy_id = $last_policy_id->policy_id;
                                            $com_policy_id = $max_policy_id+1;
                                            $arr = array("policy_id" => $com_policy_id);
                                            $insert = $this->pm->add_policy_id($arr);
                                            if( $insert ) {
                                                $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                            }
                                        }
                                        echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                        		  }
                          }
                         else if($commission_type == "3")
                         {
                                $check =$this->pm->edit_check_health_this_com_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type,$id);
                                
                                foreach($check as $da)
                                {
                                    $temp_min = $da->min_val;
                                    $temp_max = $da->max_val;
                                    
                                    $g_status = "0";
                                
                                    if($temp_min <= $min_amount && $temp_max >= $min_amount)
                                	{
                                		$g_status = "1";
                                	}
                                	if($temp_min <= $max_amount && $temp_max >= $max_amount)
                                	{
                                		$g_status = "1";
                                	}
                                	if($temp_min > $min_amount && $temp_max < $max_amount)
                                	{
                                		$g_status = "1";
                                	}
                                	
                                	if($g_status == "1")
                                	{
                                	    $status = "1";
                                	}
                                	else
                                	{
                                	     $commission_id[] = $da->id;
                                	}
                                }
                                
                                if(count($check) > 0)
                                {
                                    if($status == "1")
                                    {
                                      echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                    }
                                    else
                                    {
                                        $get_net_id = $this->pm->get_net_id(array_unique($commission_id));
                                        
                                        if($get_net_id != "")
                                        {
                                        	echo json_encode(array("status"=>"success","net_id"=>$get_net_id->net_premium_id));
                                        }
                                    }
                                }
                                else
                                {
                                    $last_net_id = $this->cm->get_last_net_premium_id();
                                
                                    if($last_net_id->net_premium_id == "")
                                    {
                                    	$com_net_premium_id = "1";
                                    	$arr = array("net_premium_id" => $com_net_premium_id);
                                    	$insert = $this->pm->add_net_premium_id($arr);
                                    	if( $insert ) {
                                            $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                        }
                                    	echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                    }
                                    else
                                    {
                                    	$max_net_premium_id = $last_net_id->net_premium_id;
                                    	$com_net_premium_id = $max_net_premium_id+1;
                                    	$arr = array("net_premium_id" => $com_net_premium_id);
                                    	$insert = $this->pm->add_net_premium_id($arr);
                                    	if( $insert ) {
                                            $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                        }
                                    	echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                    }
                                }
                           }
                    }
              }
    	}
	  
	   
	    public function edit_payout_entry()
	    {
	        if($this->session->has_userdata('logged_in'))
    	    {
        	     $insurer_company = $this->input->post("insurer_company");
                 $insurer_class = $this->input->post("insurer_class");
                 $business_type = $this->input->post("business_type");
                 $ird_od_commission = $this->input->post("ird_od_commission");
                 $ird_tp_commission = $this->input->post("ird_tp_commission");
                 $premium_c_type = $this->input->post("premium_c_type");
                 $policy_type = $this->input->post("policy_type");
                 $commission_type = $this->input->post("commission_type");
                 $add_type = $this->input->post("add_type");
                 $v_type = "";
                 $id = $this->input->post("id");
                 
                 $make = explode(",",$this->input->post("make"));
                 $model = explode(",",$this->input->post("model"));
                 $varient = explode(",",$this->input->post("varient"));
                 
                 $fuel_type = $this->input->post("fuel_type");
                 $ins_classification = $this->input->post("ins_classification");
                 $ins_state = $this->input->post("ins_state");
                 $ins_rto = explode(",",$this->input->post("ins_rto"));
                 $vehicle_age_min = $this->input->post("vehicle_age_min");
                 $vehicle_age_max = $this->input->post("vehicle_age_max");
                 
                 $special_com = $this->input->post("special_com");
                 $add_agency = explode(",",$this->input->post("add_agency"));
                 
                 
                 $rto_category = $this->input->post("rto_category");
                 
                 
                
                   // nop
                $no_policy_min = $this->input->post("no_policy_min");
                $no_policy_max = $this->input->post("no_policy_max");
                
                // min-max val
                
                $min_amount = $this->input->post("min_amount");
                $max_amount = $this->input->post("max_amount");
                 
                 $agn_com_non_ncb = $this->input->post("agn_com_non_ncb");
                 $is_com_ncb= $this->input->post("is_com_ncb");
                
               // including
                $own_od= $this->input->post('own_od');
                $own_tp= $this->input->post('own_tp');
                $on_net= $this->input->post('on_net');
                 
                // Excluding
                $ncb_percentage= $this->input->post('ncb_percentage');
                $ird_com_od= $this->input->post('ird_com_od');
                $ird_com_tp= $this->input->post('ird_com_tp');
                 
                 
                // 2023-07-20 start
                $is_com_cpa= $this->input->post("is_com_cpa");
                $cpa_percentage= $this->input->post('cpa_percentage');
                 
                 // OD Agent Commission
                 $a_od= $this->input->post('a_od');
                 $b_od= $this->input->post('b_od');
                 $c_od= $this->input->post('c_od');
                 $d_od= $this->input->post('d_od');
                 // Tp Agent Commission
                 
                 $a_tp= $this->input->post('a_tp');
                 $b_tp= $this->input->post('b_tp');
                 $c_tp= $this->input->post('c_tp');
                 $d_tp= $this->input->post('d_tp');
                 
                 // NET Agent Commission
                 $a_net= $this->input->post('a_net');
                 $b_net= $this->input->post('b_net');
                 $c_net= $this->input->post('c_net');
                 $d_net= $this->input->post('d_net');
                 
                 // NCB
                 $a_ncb= $this->input->post('a_ncb');
                 $b_ncb= $this->input->post('b_ncb');
                 $c_ncb= $this->input->post('c_ncb');
                 $d_ncb= $this->input->post('d_ncb');
                 
                 // 2023-07-20 start
                 // NCB
                 $a_cpa= $this->input->post('a_cpa');
                 $b_cpa= $this->input->post('b_cpa');
                 $c_cpa= $this->input->post('c_cpa');
                 $d_cpa= $this->input->post('d_cpa');
                 // 2023-07-20 end
                 
                 // no policy id
                 $v_make = "";
                 $v_model = "";
                 $v_varient = "";
                 
                 
                 
                 if(in_array("all",$make))
                 {
                     $v_make = "all";
                     $old_mldata = $this->pm->get_make($id);
                     $make_log = $this->pm->delete_company_commission_make_list($id);
                    if( $make_log ) {
                        $this->audit->log('com_make_log', 'DELETE', null, $old_mldata, null);
                    }
                 }
                 else
                 {
                      $v_make = "";
                 }
                 
                 if(in_array("all",$model))
                 {
                     $v_model = "all";
                     $old_mdldata = $this->pm->get_model1($id);
                    $model_log = $this->pm->delete_company_commission_model_list($id);
                    if( $model_log ) {
                        $this->audit->log('com_model_log', 'DELETE', null, $old_mdldata, null);
                    }
                 }
                 else
                 {
                     $v_model = "";
                 }
                 
                 if(in_array("all",$varient))
                 {
                     $v_varient = "all";
                     $old_vldata = $this->pm->get_varient($id);
                     $varient_log = $this->pm->delete_company_commission_varient_list($id);
                    if( $varient_log ) {
                        $this->audit->log('com_varient_log', 'DELETE', null, $old_vldata, null);
                    }
                 }
                 else
                 {
                     $v_varient = "";
                 }
                 
                 $no_policy_id = $this->input->post("no_policy_id");
                 $net_id = $this->input->post("net_id");
                 $from_date = $this->input->post("f_date");
                 $to_date = $this->input->post("to_date");
                 
                     if($no_policy_id == "" || $no_policy_id == "undefined")
        	         {
        	             $no_policy_id = "";
        	         }
                     
                     if($net_id == "" || $net_id == "undefined")
                     {
                         $net_id = "";
                     }
                     
                     
                     // start 2023-08-17
                    $payout_type = $this->input->post("payout_type");
                    $payout_type = (empty($payout_type)) ? "Fresh" : $payout_type;

                     
                   if($insurer_class == "1")
                   {
                       // 2023-07-18 start
                        $ird_commission = $this->input->post("ird_commission");
                        
                       $data = array(
                                 "insurer_company" =>$insurer_company,
                                 "policy_premium_type" =>$premium_c_type,
                                 "class" =>$insurer_class,
                                 "business_type" =>$business_type,
                                 "ird_od_commission" => $ird_od_commission,
                                 "ird_tp_commission" =>$ird_tp_commission,
                                 "commission_type" =>$commission_type,
                                 "policy_type" =>$policy_type,
                                 "vehicle_type" =>$v_type,
                                 "state"=>$ins_state,
                                 "fuel_type" =>$fuel_type,
                                  "classification" =>$ins_classification,
                                 "vehicle_age_min"=>$vehicle_age_min,
                                 "vehicle_age_max"=>$vehicle_age_max,
                                 "v_make" =>$v_make,
                                 "v_model" =>$v_model,
                                 "v_varient" =>$v_varient,
                                 "no_policy_min" =>$no_policy_min,
                                 "no_policy_max" =>$no_policy_max,
                                 "min_val" =>$min_amount,
                                 "max_val" =>$max_amount,
                                 "type" =>$add_type,
                                "own_od"=>$own_od,
                                "own_tp"=>$own_tp,
                                "on_net"=>$on_net,
                                "is_ncb"=>$is_com_ncb,
                                "agn_com_type"=>$agn_com_non_ncb,
                                "ncb_percentage"=>$ncb_percentage,
                                "irda_od"=>$ird_com_od,
                                "irda_tp"=>$ird_com_tp,
                                "a_od"=>$a_od,
                                "b_od"=>$b_od,
                                "c_od"=>$c_od,
                                "d_od"=>$d_od,
                                "a_tp"=>$a_tp,
                                "b_tp"=>$b_tp,
                                "c_tp"=>$c_tp,
                                "d_tp"=>$d_tp,
                                "a_net"=>$a_net,
                                "b_net"=>$b_net,
                                "c_net"=>$c_net,
                                "d_net"=>$d_net,
                                "a_ncb"=>$a_ncb,
                                "b_ncb"=>$b_ncb,
                                "c_ncb"=>$c_ncb,
                                "d_ncb"=>$d_ncb,
                                "no_of_policy_id" =>$no_policy_id,
                                "from_date" =>$from_date,
                                "to_date" =>$to_date,
                                "net_premium_id" =>$net_id,
                                "updated_by" =>$this->session->userdata("session_id"),
                                "updated_time" =>date("Y-m-d H:i:s"),
                                "ird_commission_percentage"  => $ird_commission,
                                 "is_cpa"    => $is_com_cpa, // 2023-07-20 start
                                "cpa_percentage"    => $cpa_percentage, // 2023-07-20 start
                                "a_cpa"=>$a_cpa, // 2023-07-20 start
                                "b_cpa"=>$b_cpa, // 2023-07-20 start 
                                "c_cpa"=>$c_cpa, // 2023-07-20 start
                                "d_cpa"=>$d_cpa, // 2023-07-20 start
                                "payout_type"    => $payout_type // start 2023-08-17
                              );
                   }
                   else
                   {
                        // 2023-05-25 start
                        $ird_commission = $this->input->post("ird_commission");
                       $data = array(
                                 "insurer_company" =>$insurer_company,
                                 "class" =>$insurer_class,
                                 "business_type" =>$business_type,
                                 "commission_type" =>$commission_type,
                                 "policy_type" =>$policy_type,
                                 "state"=>$ins_state,
                                 "no_policy_min" =>$no_policy_min,
                                 "no_policy_max" =>$no_policy_max,
                                 "min_val" =>$min_amount,
                                 "max_val" =>$max_amount,
                                "on_net"=>$on_net,
                                "is_ncb"=>$is_com_ncb,
                                "ncb_percentage"=>$ncb_percentage,
                                "a_net"=>$a_net,
                                "b_net"=>$b_net,
                                "c_net"=>$c_net,
                                "d_net"=>$d_net,
                                "a_ncb"=>$a_ncb,
                                "b_ncb"=>$b_ncb,
                                "c_ncb"=>$c_ncb,
                                "d_ncb"=>$d_ncb,
                                "no_of_policy_id" =>$no_policy_id,
                                "from_date" =>$from_date,
                                "to_date" =>$to_date,
                                "net_premium_id" =>$net_id,
                                "updated_by" =>$this->session->userdata("session_id"),
                                "updated_time" =>date("Y-m-d H:i:s"),
                                "ird_commission_percentage"  => $ird_commission,
                                "payout_type"    => $payout_type // start 2023-08-17
                              );
                   }
                    
                  $res = $id;
                  $old_data = $this->pm->edit_commission_entry($id);
                  $updated = $this->pm->edit_payout_commission($data,$id);
                  if( $updated ) {
                    $this->audit->log('company_payout_commission', 'UPDATE', null, $old_data, $data,$id);
                  }
				  
                  
                  $date = date("Y-m-d H:i:s");
                  $old_amldata = $this->pm->fetch_select_agent_using_commission_id($id);
                  if($this->pm->delete_agent_commission_model_list($id)){
                      $this->audit->log('agent_special_com', 'DELETE', null, $old_amldata, null);
                  }
                   
                   
                         for($i=0;$i<count($add_agency);$i++)
                                  {      
                      $data_agency = array(
                                    "commission_id" =>$res,
                                    "special_com" =>$special_com,
                                 "agent_id" =>$add_agency[$i],
                                 "from_date" =>$from_date,
                                "to_date" =>$to_date,
                                 "created_time" =>date("Y-m-d H:i:s"),
                                "created_by"=>$this->session->userdata('session_id'),
                              );
                              
                      $res_agency = $this->pm->add_agents_special_com($data_agency);
                      if( $res_agency ) {
                            $this->audit->log('agent_special_com', 'INSERT', null, null, $data_agency);
                        }
                     }
                
                   
                    if(!in_array("all",$make))
                    {
                         $this->pm->delete_company_commission_make_list($id);
                         for($i=0;$i<count($make);$i++)
                          {
                                $make_arr = array(
                                                "commission_id" =>$res,
                                                "policy_type" =>$policy_type,
                                                "make" =>$make[$i],
                                                "created_by" =>$this->session->userdata("session_id"),
                                                "created_date" =>date("Y-m-d H:i:s"),
                                            );
                                $add_make = $this->pm->add_make_list($make_arr);
                                if( $add_make ) {
                                    $this->audit->log('com_make_log', 'INSERT', null, null, $make_arr);
                                }
                          }
                     }
                   
                    if(!in_array("all",$model))
                    {
                       $this->pm->delete_company_commission_model_list($id);
                        
                          for($i=0;$i<count($model);$i++)
                          {
                                if($policy_type == "1" || $policy_type == "3")
                                {
                                    $get_make_id =$this->pm->get_car_make_id($model[$i]);
                                    
                                    $model_arr = array(
                                                    "commission_id" =>$res,
                                                    "policy_type" =>$policy_type,
                                                    "make_id" =>$get_make_id,
                                                     "model_id" =>$model[$i],
                                                    "created_by" =>$this->session->userdata("session_id"),
                                                    "created_date" =>date("Y-m-d H:i:s"),
                                                );
                                    $model_add = $this->pm->add_model_list($model_arr);
                                    if( $model_add ) {
                                        $this->audit->log('com_model_log', 'INSERT', null, null, $model_arr);
                                    }
                                }
                                else if($policy_type == "2")
                                {
                                    $get_make_id =$this->pm->get_bike_make_id($model[$i]);
                                    
                                    $model_arr = array(
                                                    "commission_id" =>$res,
                                                    "policy_type" =>$policy_type,
                                                    "make_id" =>$get_make_id,
                                                     "model_id" =>$model[$i],
                                                    "created_by" =>$this->session->userdata("session_id"),
                                                    "created_date" =>date("Y-m-d H:i:s"),
                                                );
                                    $model_add = $this->pm->add_model_list($model_arr);
                                    if( $model_add ) {
                                        $this->audit->log('com_model_log', 'INSERT', null, null, $model_arr);
                                    }
                                }
                                else if($policy_type == "4")
                                {
                                    $get_make_id =$this->pm->get_e_two_wheeler_make_id($model[$i]);
                                    
                                    $model_arr = array(
                                                    "commission_id" =>$res,
                                                    "policy_type" =>$policy_type,
                                                    "make_id" =>$get_make_id,
                                                     "model_id" =>$model[$i],
                                                    "created_by" =>$this->session->userdata("session_id"),
                                                    "created_date" =>date("Y-m-d H:i:s"),
                                                );
                                    $model_add = $this->pm->add_model_list($model_arr);
                                    if( $model_add ) {
                                        $this->audit->log('com_model_log', 'INSERT', null, null, $model_arr);
                                    }
                                }
                               
                                else if($policy_type == "7")
                                {
                                    $get_make_id =$this->pm->get_pc_make_id($model[$i]);
                                    
                                    $model_arr = array(
                                                    "commission_id" =>$res,
                                                    "policy_type" =>$policy_type,
                                                    "make_id" =>$get_make_id,
                                                     "model_id" =>$model[$i],
                                                    "created_by" =>$this->session->userdata("session_id"),
                                                    "created_date" =>date("Y-m-d H:i:s"),
                                                );
                                    $model_add = $this->pm->add_model_list($model_arr);
                                    if( $model_add ) {
                                        $this->audit->log('com_model_log', 'INSERT', null, null, $model_arr);
                                    }
                                }
                                
                                else if($policy_type == "8" || $policy_type == "9" || $policy_type == "10" || $policy_type == "15" || $policy_type == "16" || $policy_type == "61")
                                {
                                    $get_make_id =$this->pm->get_gc_make_id($model[$i],$policy_type);
                                    
                                    $model_arr = array(
                                                    "commission_id" =>$res,
                                                    "policy_type" =>$policy_type,
                                                    "make_id" =>$get_make_id,
                                                     "model_id" =>$model[$i],
                                                    "created_by" =>$this->session->userdata("session_id"),
                                                    "created_date" =>date("Y-m-d H:i:s"),
                                                );
                                    $model_add = $this->pm->add_model_list($model_arr);
                                    if( $model_add ) {
                                        $this->audit->log('com_model_log', 'INSERT', null, null, $model_arr);
                                    }
                                }
                                
                                else if($policy_type == "20")
                                {
                                    $get_make_id =$this->pm->get_misc_make_id($model[$i]);
                                    
                                    $model_arr = array(
                                                    "commission_id" =>$res,
                                                    "policy_type" =>$policy_type,
                                                    "make_id" =>$get_make_id,
                                                     "model_id" =>$model[$i],
                                                    "created_by" =>$this->session->userdata("session_id"),
                                                    "created_date" =>date("Y-m-d H:i:s"),
                                                );
                                    $model_add = $this->pm->add_model_list($model_arr);
                                    if( $model_add ) {
                                        $this->audit->log('com_model_log', 'INSERT', null, null, $model_arr);
                                    }
                                }
                                
                                else if($policy_type == "55")
                                {
                                    $get_make_id =$this->pm->get_scooter_make_id($model[$i]);
                                    
                                    $model_arr = array(
                                                    "commission_id" =>$res,
                                                    "policy_type" =>$policy_type,
                                                    "make_id" =>$get_make_id,
                                                     "model_id" =>$model[$i],
                                                    "created_by" =>$this->session->userdata("session_id"),
                                                    "created_date" =>date("Y-m-d H:i:s"),
                                                );
                                    $model_add = $this->pm->add_model_list($model_arr);
                                    if( $model_add ) {
                                        $this->audit->log('com_model_log', 'INSERT', null, null, $model_arr);
                                    }
                                }
                          }
                    }

                    if(!in_array("all",$varient))
                    {
                      $this->pm->delete_company_commission_varient_list($id);
                      for($i=0;$i<count($varient);$i++)
                      {
                            if($policy_type == "1" || $policy_type == "3")
                            {
                                $get_id =$this->pm->get_car_model_varient_id($varient[$i]);
                                
                                $varient_arr = array(
                                                     "commission_id" =>$res,
                                                     "policy_type" =>$policy_type,
                                                     "make_id" =>$get_id->brand_id,
                                                     "model_id" =>$get_id->model_id,
                                                     "varient_id" =>$varient[$i],
                                                     "created_by" =>$this->session->userdata("session_id"),
                                                     "created_date" =>date("Y-m-d H:i:s"),
                                            );
                                $add_varient = $this->pm->add_varient_list($varient_arr);
                                if( $add_varient ) {
                                    $this->audit->log('com_varient_log', 'INSERT', null, null, $varient_arr);
                                }
                            }
                            else if($policy_type == "2" || $policy_type == "4")
                            {
                                $get_id =$this->pm->get_bike_model_varient_id($varient[$i]);
                                
                                $varient_arr = array(
                                                "commission_id" =>$res,
                                                "policy_type" =>$policy_type,
                                                "make_id" =>$get_id->brand_id,
                                                "model_id" =>$get_id->model_id,
                                                "varient_id" =>$varient[$i],
                                                "created_by" =>$this->session->userdata("session_id"),
                                                "created_date" =>date("Y-m-d H:i:s"),
                                            );
                                $add_varient = $this->pm->add_varient_list($varient_arr);
                                if( $add_varient ) {
                                    $this->audit->log('com_varient_log', 'INSERT', null, null, $varient_arr);
                                }
                            }
                            else if($policy_type == "4")
                            {
                                $get_id =$this->pm->get_e_two_wheeler_model_varient_id($varient[$i]);
                                
                                $varient_arr = array(
                                                "commission_id" =>$res,
                                                "policy_type" =>$policy_type,
                                                "make_id" =>$get_id->brand_id,
                                                "model_id" =>$get_id->model_id,
                                                "varient_id" =>$varient[$i],
                                                "created_by" =>$this->session->userdata("session_id"),
                                                "created_date" =>date("Y-m-d H:i:s"),
                                            );
                                $add_varient = $this->pm->add_varient_list($varient_arr);
                                if( $add_varient ) {
                                    $this->audit->log('com_varient_log', 'INSERT', null, null, $varient_arr);
                                }
                            }
                            else if($policy_type == "7")
                            {
                                $get_id =$this->pm->get_pc_model_varient_id($varient[$i]);
                                
                                $varient_arr = array(
                                                "commission_id" =>$res,
                                                "policy_type" =>$policy_type,
                                                "make_id" =>$get_id->brand_id,
                                                "model_id" =>$get_id->model_id,
                                                 "varient_id" =>$varient[$i],
                                                "created_by" =>$this->session->userdata("session_id"),
                                                "created_date" =>date("Y-m-d H:i:s"),
                                            );
                                $add_varient = $this->pm->add_varient_list($varient_arr);
                                if( $add_varient ) {
                                    $this->audit->log('com_varient_log', 'INSERT', null, null, $varient_arr);
                                }
                            }
                            
                            else if($policy_type == "8" || $policy_type == "9" || $policy_type == "10" || $policy_type == "15" || $policy_type == "16" || $policy_type == "61")
                            {
                                $get_id =$this->pm->get_gc_model_varient_id($varient[$i]);
                                
                                $varient_arr = array(
                                                "commission_id" =>$res,
                                                "policy_type" =>$policy_type,
                                                "make_id" =>$get_id->brand_id,
                                                "model_id" =>$get_id->model_id,
                                                 "varient_id" =>$varient[$i],
                                                "created_by" =>$this->session->userdata("session_id"),
                                                "created_date" =>date("Y-m-d H:i:s"),
                                            );
                                $add_varient = $this->pm->add_varient_list($varient_arr);
                                if( $add_varient ) {
                                    $this->audit->log('com_varient_log', 'INSERT', null, null, $varient_arr);
                                }
                            }
                            
                            else if($policy_type == "20")
                            {
                                $get_id =$this->pm->get_misc_model_varient_id($varient[$i]);
                                
                                $varient_arr = array(
                                                "commission_id" =>$res,
                                                "policy_type" =>$policy_type,
                                                "make_id" =>$get_id->brand_id,
                                                "model_id" =>$get_id->model_id,
                                                 "varient_id" =>$varient[$i],
                                                "created_by" =>$this->session->userdata("session_id"),
                                                "created_date" =>date("Y-m-d H:i:s"),
                                            );
                                $add_varient = $this->pm->add_varient_list($varient_arr);
                                if( $add_varient ) {
                                    $this->audit->log('com_varient_log', 'INSERT', null, null, $varient_arr);
                                }
                            }
                            else if($policy_type == "55")
                            {
                                $get_id =$this->pm->get_scooter_model_varient_id($varient[$i]);
                                
                                $varient_arr = array(
                                                "commission_id" =>$res,
                                                "policy_type" =>$policy_type,
                                                "make_id" =>$get_id->brand_id,
                                                "model_id" =>$get_id->model_id,
                                                 "varient_id" =>$varient[$i],
                                                "created_by" =>$this->session->userdata("session_id"),
                                                "created_date" =>date("Y-m-d H:i:s"),
                                            );
                                $add_varient = $this->pm->add_varient_list($varient_arr);
                                if( $add_varient ) {
                                    $this->audit->log('com_varient_log', 'INSERT', null, null, $varient_arr);
                                }
                            }
                        }
                    }
                 
                    $this->pm->delete_company_rto_log($id);
                   
                     if($rto_category == "ROTN_Exclude")
                     {
                              $get_rto = $this->pm->get_rto($ins_rto);
                              
                              foreach($get_rto as $da)
                              {
                                    $rto_arr = array(
                                            "commission_id" =>$res,
                                            "rto" =>$da->rto_no,
                                            "created_time" =>date("Y-m-d H:i:s"),
                                            );
                                            
                                    $add_rto = $this->pm->add_rto_log($rto_arr);
                                    if( $add_rto ) {
                                        $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                    }
                              }
                     }
                     else if($rto_category == "KA_Exclude")
                     {
                      $get_rto = $this->pm->get_rto_ka($ins_rto);
                      
                      foreach($get_rto as $da)
                      {
                    		$rto_arr = array(
                    				"commission_id" =>$res,
                    				"rto" =>$da->rto_no,
                    				"created_time" =>date("Y-m-d H:i:s"),
                    				);
                    				
                    		$add_rto = $this->pm->add_rto_log($rto_arr);
                    		if( $add_rto ) {
                                $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                            }
                      }
                    }
                     else
                     {
                          if(in_array('chennai',$ins_rto) || in_array('Coimbatore',$ins_rto) || in_array('Madurai',$ins_rto))
                          {
                                          $city_rto = $this->pm->get_city_rto($ins_rto);
                                           
                                          for($i=0;$i<=count($ins_rto);$i++)
                                      	  {
                                      	            if(in_array("chennai",$ins_rto))
                                      	            {
                                      	                  unset($ins_rto[$i]);
                                      	            }
                                      	            else if(in_array("Coimbatore",$ins_rto))
                                      	            {
                                      	                unset($ins_rto[$i]);
                                      	            }
                                      	            else if(in_array("Madurai",$ins_rto))
                                      	            {
                                      	                unset($ins_rto[$i]);
                                      	            }
                                      	     }
                                      	     
                                      	   $get_rto = $this->pm->get_rto_no($ins_rto);
                                        
                                           foreach($city_rto as $da)
                                           {
                                                  $rto_arr = array(
                                                        "commission_id" =>$res,
                                                        "rto" =>$da->rto_no,
                                                        "created_time" =>date("Y-m-d H:i:s"),
                                                        );
                                                        
                                                    $add_rto = $this->pm->add_rto_log($rto_arr);
                                                    if( $add_rto ) {
                                                        $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                                    }
                                           }
                                       
                                           if($get_rto != null)
                                           {
                                               foreach($get_rto as $da)
                                               {
                                                    $rto_arr = array(
                                                            "commission_id" =>$res,
                                                            "rto" =>$da->rto_no,
                                                            "created_time" =>date("Y-m-d H:i:s"),
                                                            );
                                                            
                                                        $add_rto = $this->pm->add_rto_log($rto_arr);
                                                        if( $add_rto ) {
                                                            $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                                        }
                                               }
                                           }
                            }
                          else if(in_array("ROTN",$ins_rto))
                          {
                               $get_rotn_rto = $this->pm->get_rotn_rto();
                               
                               foreach($get_rotn_rto as $da)
                               {
                                    $rto_arr = array(
                                        "commission_id" =>$res,
                                        "rto" =>$da->rto_no,
                                        "created_time" =>date("Y-m-d H:i:s"),
                                        );
                                        
                                    $add_rto = $this->pm->add_rto_log($rto_arr);
                                    if( $add_rto ) {
                                        $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                    }
                               }
                           }
                          else if(in_array("All TN",$ins_rto))
                          {
                               $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                               
                               foreach($get_all_tn_rto as $da)
                               {
                                   $rto_arr = array(
                                            "commission_id" =>$res,
                                            "rto" =>$da->rto_no,
                                            "created_time" =>date("Y-m-d H:i:s"),
                                            );
                                  $add_rto = $this->pm->add_rto_log($rto_arr);            
                                  if( $add_rto ) {
                                        $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                    }
                               }
                           }
                           else if(in_array("All KA",$ins_rto))
                           {
                               $get_all_ka_rto = $this->pm->get_all_ka_rto_list();
                               
                               foreach($get_all_ka_rto as $da)
                               {
                                   $rto_arr = array(
                                            "commission_id" =>$res,
                                            "rto" =>$da->rto_no,
                                            "created_time" =>date("Y-m-d H:i:s"),
                                            );
                                  $add_rto = $this->pm->add_rto_log($rto_arr);      
                                  if( $add_rto ) {
                                        $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                    }
                               }
                           }
                          else if(in_array("All RTO",$ins_rto))
                          {
                               $get_all_rto = $this->pm->get_all_rto_list();
                               
                               foreach($get_all_rto as $da)
                               {
                               $rto_arr = array(
                                        "commission_id" =>$res,
                                        "rto" =>$da->rto_no,
                                        "created_time" =>date("Y-m-d H:i:s"),
                                        );
                                  $add_rto = $this->pm->add_rto_log($rto_arr);
                                  if( $add_rto ) {
                                        $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                    }
                               }
                           }
                          else if(in_array('Bangalore',$ins_rto))
                          {
                            	$city_rto = $this->pm->get_ka_city_rto($ins_rto);
                            	
                            	for($i=0;$i<=count($ins_rto);$i++)
                            	{
                            	  if(in_array("Bangalore",$ins_rto))
                            	  {
                            			unset($ins_rto[$i]);
                            	  }
                            	}
                            				 
                            	$get_rto = $this->pm->get_rto_no($ins_rto);
                            	
                            	foreach($city_rto as $da)
                            	{
                            		$rto_arr = array(
                            			"commission_id" =>$res,
                            			"rto" =>$da->rto_no,
                            			"created_time" =>date("Y-m-d H:i:s"),
                            			);
                            			
                            		$add_rto = $this->pm->add_rto_log($rto_arr);
                            		if( $add_rto ) {
                                        $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                    }
                            	}
                            	
                            	if($get_rto != null)
                            	{
                            		foreach($get_rto as $da)
                            		{
                            			$rto_arr = array(
                            					"commission_id" =>$res,
                            					"rto" =>$da->rto_no,
                            					"created_time" =>date("Y-m-d H:i:s"),
                            					);
                            					
                            				$add_rto = $this->pm->add_rto_log($rto_arr);
                            				if( $add_rto ) {
                                                $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                            }
                            		}
                            	}
                            }
                          else
                          {
                            for($i=0;$i<count($ins_rto);$i++)
                            {
                                $rto_arr = array(
                                "commission_id" =>$res,
                                "rto" =>$ins_rto[$i],
                                "created_time" =>date("Y-m-d H:i:s"),
                                );
                                
                                $add_rto = $this->pm->add_rto_log($rto_arr);
                                if( $add_rto ) {
                                    $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                }
                             }
                           }
                      }
					//  var_dump($updated);
				 if( $updated ) {
				     
                     $affected_polices = $this->lm->get_policy_details_by_commission($id, $from_date, $to_date);
                     //var_dump($this->db->last_query());
                     
                    if( isset( $affected_polices ) && !empty( $affected_polices ) ) {
                        $_chkdate = new DateTime('2023-03-01');
                        foreach( $affected_polices as $arow ) {
                            $sync = "false";
                            if(isset($arow->policy_issue_date) && !empty($arow->policy_issue_date)){
                                $_date = new DateTime($arow->policy_issue_date);
                                
                                if($_date >= $_chkdate)
                                    $sync = "true";
                            }
                            //var_dump($_date->format('Y-m-d').'=>'.$_chkdate->format('Y-m-d').'=>'.$sync);
                            if( $sync == "true"){ //isset( $arow->vocher_status ) && ( $arow->vocher_status == "0" ) && 
                               // echo $arow->lead_id;
                                $updates = $this->update_commission_by_policy($arow->lead_id);
                            }
                        }
                    }
                 }
                 echo "success";
    	    }
	    } 
	    
	    
	    public function payout_grid()
	    {
	        if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
                {    		
                    $pro_data["project_info"] = $this->mm->fetch_project_info();
                    $data["insurer_company"] = $this->cm->get_insurer_company();
                    $data["type"] = $this->cm->get_policy_premium_type();
                    $data["category"] = $this->cm->get_motor_category();
                    $data["state"] = $this->cm->get_commission_state();
                    $data["rto"] = $this->cm->get_rto_list();
                    $data["class"] = $this->cm->get_insurer_class();
                    $data["business_type"] = $this->cm->get_business_type();
                    $data["commission_type"] = $this->cm->get_commission_type();
                    $data["policy_type"] = $this->pm->fetch_policy_type();
                    $data["fuel_type"] = $this->pm->get_fuel_type();
                    $this->load->view('header',$pro_data);
                    $this->load->view('payout_grid',$data);
                    $this->load->view('footer',$pro_data);
                }
                else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user")
                {
                        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
                        if($check_user_i->masters_view == "1")
                        {
                        $pro_data["project_info"] = $this->mm->fetch_project_info();
                        $data["insurer_company"] = $this->cm->get_insurer_company();
                        $data["type"] = $this->cm->get_policy_premium_type();
                        $data["category"] = $this->cm->get_motor_category();
                        $data["state"] = $this->cm->get_commission_state();
                        $data["rto"] = $this->cm->get_rto_list();
                        $data["class"] = $this->cm->get_insurer_class();
                        $data["business_type"] = $this->cm->get_business_type();
                        $data["commission_type"] = $this->cm->get_commission_type();
                        $data["fuel_type"] = $this->pm->get_fuel_type();
                        $this->load->view('header',$pro_data);
                        $this->load->view('payout_grid',$data);
                        $this->load->view('footer',$pro_data);
                }
                else
                {
                    echo "<script>alert('Permission Denied');window.location.href='home';</script>";
                }
             }
	    }
	    
	    public function add_payout_grid()
	    {
	        if($this->session->has_userdata('logged_in'))
	        {
	            $class= $this->input->post("ins_class");
	            $policy_type = $this->input->post("policy_type");
	            $rto_reigions = $this->input->post("rto_reigions");
	            $c_percentage = $this->input->post("c_percentage");
	            
	            $data = array(
	                             "class" =>$class,
	                             "policy_type"=>$policy_type,
	                             "rto_reigions"=>$rto_reigions,
	                             "commission" =>$c_percentage,
	                             "created_at" => date("Y-m-d H:i:s"),
	                             "created_by" =>$this->session->userdata("session_id"),
	                         );
	                         
	             $res = $this->pm->add_payout_grid($data);
	             if( $res ){
	                 $this->audit->log('company_payout_grid', 'INSERT', null, null, $data);
	             }
	        }
	    }
	    
	  public function fetch_payout_grid()
	  {
	      if($this->session->has_userdata('logged_in'))
	      {
	         $draw = intval($this->input->post("draw"));
			 $res = $this->pm->fetch_payout_grid();
	
    		$arr = [];
            $a = 0 ;
            
            foreach($res as $da)
            {
            	$a++;
    
                $action = "<button class='btn btn-info btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i></button>";
                
                $arr[] = array(
                    $a,
                    $da->ins_class,
                    $da->p_type,
                    $da->rto_reigions,
                    $da->commission,
                    $action,
                );
            }
    
            $result = array(
            			"draw"=> $draw,
    				    "recordsTotal"=>count($res),
    				    "recordsFiltered"=> count($res),
    				    "data"=>$arr,
    				);
            echo json_encode($result);
	      }
	  }
	  
	  public function fetch_edit_payout_grid()
	  {
	      if($this->session->has_userdata('logged_in'))
	      {
	          $id = $this->input->post("id");
	          $res = $this->pm->fetch_edit_payout_grid($id);
	          echo json_encode($res);
	      }
	  }
	  
	  public function edit_payout_grid()
	  {
	      if($this->session->has_userdata('logged_in'))
	      {
	          $id = $this->input->post("id");
	          $class= $this->input->post("ins_class");
	          $policy_type = $this->input->post("policy_type");
	          $rto_reigions = $this->input->post("rto_reigions");
	          $c_percentage = $this->input->post("c_percentage");
	            
	            $data = array(
	                             "class" =>$class,
	                             "policy_type"=>$policy_type,
	                             "rto_reigions"=>$rto_reigions,
	                             "commission" =>$c_percentage,
	                             "updated_at" => date("Y-m-d H:i:s"),
	                             "updated_by" =>$this->session->userdata("session_id"),
	                         );
	             $old_data = $this->pm->fetch_edit_payout_grid($id);
	             $res = $this->pm->update_payout_grid($data,$id);
	             if($res){
	                 $this->audit->log('company_payout_grid', 'UPDATE', null, $old_data, $data);
	             }
	             echo "success";
	      }
	  }
	  
	  public function filter_commission_motor()
	  {
	     if($this->session->has_userdata('logged_in'))
	     {
               $insurer = $this->input->post("insurer");
               $policy_type = $this->input->post("policy_type");
               $make = $this->input->post("make");
               $model  = $this->input->post("model");
               $varient  = $this->input->post("varient");
               $rto  = $this->input->post("rto");
               
               $f_date = $this->input->post("f_date");
               $to_date = $this->input->post("to_date");
              
	            $draw = intval($this->input->post("draw"));
                $res = $this->pm->filter_payout_commission($insurer,$policy_type,$make,$model,$varient,$rto,$f_date,$to_date);
               
        		$arr = [];
                $a = 0 ;
                
                foreach($res as $da)
                {
                	$a++;
                	
                  $action = "";
        
                  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
                   
        	        if($check_user_i->masters_edit == "1")
        	        {
        	          $action .= "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> </button>";  
        	        }
        	        if($check_user_i->masters_delete == "1")
        	        {
        	           $action .= " <button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> </button>";
        	        }
        
                    $view = "<a href='#' onclick='view_data(".$da->id.")'> ".$da->company_name."</a>";
                    
                    
                    $classifiaction = "";
                    
                      if($da->policy_type == "12" || $da->policy_type == "13" || $da->policy_type == "14" || $da->policy_type == "59" || $da->policy_type == "60" || $da->policy_type == "65" || $da->policy_type == "66")
                        {
                           
                          $classifiaction = $da->seating_capacity. "Seater";
                        }
                        else
                        {
                            $classifiaction = $da->from_gvw_cc.$da->classi."-".$da->to_gvw_cc.$da->classi;
                        }
                    
                    
                    $arr[] = array(
                        $a,
                        $view,
                        $da->premium_name,
                        $da->p_type,
                        $classifiaction,
                        $da->commission_state,
                        $da->type,
                        $da->own_od,
                        $da->own_tp,
                        $da->on_net,
                        $da->irda_od,
                        $da->irda_tp,
                        $da->ncb_percentage,
                        $action,
                    );
                }
                $result = array(
                			"draw"=> $draw,
        				    "recordsTotal"=>count($res),
        				    "recordsFiltered"=> count($res),
        				    "data"=>$arr,
        				);
                     echo json_encode($result);
    	    }
	  }
	  
	  public function remove_all_rto()
	  {
	     if($this->session->has_userdata('logged_in'))
	     {
	         $id = $this->input->post("id");
	         $old_rldata = $this->pm->get_rto1($id);
	         $res = $this->pm->remove_all_rto($id);
	         if( $res ) {
                $this->audit->log('commission_rto_log', 'DELETE', null, $old_rldata, null);
            }
	         echo "success";
	     }
	  }
	  
	  public function get_commission_details_by_id()
	  {
	     if($this->session->has_userdata('logged_in'))
	     {
	         $id = $this->input->post("id");
	         $data = $this->pm->get_commission_details_by_id($id);
	         
	         
	         
            $content = "<style> .wrap-it{
                                word-wrap: break-word;
                                }
                                *{
                                    font-weight:unset !important;
                                }
                                th {
                                    text-align: left;
                                    background-color: #66b2d3;
                                    color: #fff;
                                }
                                table{
                                    width:100% !important;
                                }
                                td{
                                    word-wrap: break-word !important;
                                }
                        </style>";

	                 
	                 $a = 0;
	   
            	     foreach($data as $info)
            	     {
            	         if($a > 0)
            	         {
            	             $content .="</hr>";
            	         }
            	         $a++;
            	         $content .="<h4 style='color:red;'>Payout Log $a :</h4>";
            	         
                	         if($info->class == "1")
                             {
                            	        $res = $this->pm->fetch_commission_details_motor($info->id);
                            	  
                                        if($info->policy_type == "1" || $info->policy_type == "3")
                                        {
                                            $make = $this->pm->fetch_make_car_brand($info->id,$info->policy_type);
                                            $model = $this->pm->fetch_car_model_name($info->id,$info->policy_type);
                                            $varient = $this->pm->fetch_car_varient_name($info->id,$info->policy_type);
                                        }
                                        else if($info->policy_type == "2")
                                        {
                                            $make = $this->pm->fetch_make_bike_brand($info->id,$info->policy_type);
                                            $model = $this->pm->fetch_bike_model_name($info->id,$info->policy_type);
                                            $varient = $this->pm->fetch_bike_varient_name($info->id,$info->policy_type);
                                        }
                                        else if($info->policy_type == "4")
                                        {
                                            $make = $this->pm->fetch_make_e_two_wheeler_brand($info->id,$info->policy_type);
                                            $model = $this->pm->fetch_e_two_wheeler_model_name($info->id,$info->policy_type);
                                            $varient = $this->pm->fetch_e_two_wheeler_varient_name($info->id,$info->policy_type);
                                        }
                                        else if($info->policy_type == "7" || $info->policy_type == "12" || $info->policy_type == "13" || $info->policy_type == "14" || $info->policy_type == "59" || $info->policy_type == "60" || $info->policy_type == "65" || $info->policy_type == "66")
                                        {
                                            $make = $this->pm->fetch_make_pc_brand($info->id,$info->policy_type);
                                            $model = $this->pm->fetch_pc_model_name($info->id,$info->policy_type);
                                            $varient = $this->pm->fetch_pc_varient_name($info->id,$info->policy_type);
                                        }
                                        else if($info->policy_type == "8" || $info->policy_type == "9" || $info->policy_type == "10" || $info->policy_type == "15" || $info->policy_type == "16" || $info->policy_type == "61")
                                        {
                                            $make = $this->pm->fetch_make_gc_brand($info->id,$info->policy_type);
                                            $model = $this->pm->fetch_gc_model_name($info->id,$info->policy_type);
                                            $varient = $this->pm->fetch_gc_varient_name($info->id,$info->policy_type);
                                        }
                                        else if($info->policy_type == "20")
                                        {
                                             $make = $this->pm->fetch_make_misc_brand($info->id,$info->policy_type);
                                            $model = $this->pm->fetch_misc_model_name($info->id,$info->policy_type);
                                            $varient = $this->pm->fetch_misc_varient_name($info->id,$info->policy_type);
                                        }
                                        else if($info->policy_type == "55")
                                        {
                                             $make = $this->pm->fetch_make_scooter_brand($info->id,$info->policy_type);
                                             $model = $this->pm->fetch_scooter_model_name($info->id,$info->policy_type);
                                             $varient = $this->pm->fetch_scooter_varient_name($info->id,$info->policy_type);
                                        }
                                        
                                    $rto_details = $this->pm->fech_rto_details($info->id);
                                }
                             else if($info->class == "2")
                             {
                                    $res = $this->pm->fetch_payout_commission_health_by_id($info->id);
                             }
            
                    	       $content .="<table class='table table-bordered' style='width:100%'>
                    	                       
        	                       <tr>
        	                            <th style='width:33%;word-break:break-word;'>Insurer</th>
        	                            <th style='width:33%;word-break:break-word;'>Premium Cover Type</th>
        	                            <th style='width:33%;word-break:break-word;'>Business Type</th>
        	                       </tr>
        	                       
        	                       <tr>
        	                             <td style='width:33%;word-break:break-word;'>".$res->company_name."</td>";
        	                             
        	                             if($res->class == "1")
        	                             {
        	                                $content .="<td style='width:33%;word-break:break-word;'>".$res->premium_name."</td>";
        	                             }
        	                             else
        	                             {
        	                                $content .=" <td style='width:33%;word-break:break-word;'>Health</td>";
        	                             }
        	                             $content .=" <td style='width:33%;word-break:break-word;'>".$res->b_type."</td>
        	                       </tr>";
            	              
            	              if($res->class == "1")
                              {
                                  
                                   $content .=" <tr style='width:33%;word-break:break-word;'>
            	                            <th style='width:33%;word-break:break-word;'>Class</th>
            	                            <th style='width:33%;word-break:break-word;'>Policy Type</th>
            	                            <th style='width:33%;word-break:break-word;'>Classification cc/gvw</th>
            	                       </tr>";
            	                       
            	                       $content .="<tr style='width:33%;word-break:break-word;'>
            	                            <td style='width:33%;word-break:break-word;'>Motor</td>
            	                            <td style='width:33%;word-break:break-word;'>".$res->p_type."</td>
            	                            <td style='width:33%;word-break:break-word;'>".$res->from_gvw_cc."".$res->classification." - ".$res->to_gvw_cc."".$res->classification."</td>
            	                       </tr>";
            	                       
            	                       
            	                       $content .="<tr style='width:33%;word-break:break-word;'>
            	                            <th style='width:33%;word-break:break-word;'>Make</th>
            	                            <th style='width:33%;word-break:break-word;'>Model</th>
            	                            <th style='width:33%;word-break:break-word;'>Varient</th>
            	                      </tr>
            	                      
            	                      <tr>
            	                      <td style='width:33%;word-break:break-word;' class='word-wrap'>";
            	                    
            	                    if($make != null)
            	                    {
            	                       foreach($make as $da)
        	                           {
        	                               $content .=$da->brand_name.",";
        	                           }
            	                    }
            	                    else
            	                    {
            	                         $content .="ALL";
            	                    }
        	                           
            	                     $content .="</td>
            	                                 <td style='width:33%;word-break:break-word;' class='word-wrap'>";
            	                     if($model != null)
            	                     {
            	                       foreach($model as $da)
        	                           {
        	                               $content .=$da->model_name.",";
        	                           }
            	                     }
            	                     else
            	                     {
            	                          $content .="ALL";
            	                     }
            	                     
            	                     $content .="</td>
            	                     <td style='width:33%;word-break:break-word;' class='word-wrap'>";
            	                    
            	                    if($varient != null)
            	                    {
            	                      foreach($varient as $da)
        	                           {
        	                               $content .=$da->varient_name.",";
        	                           }
            	                    }
            	                    else 
            	                    {
            	                         $content .="ALL";
            	                    }
            	                      $content .="</td>
            	                      </tr>
            	                      
            	                     <tr style='width:33%;word-break:break-word;'>
            	                            <th style='width:33%;word-break:break-word;'>Fuel type</th>
            	                            <th style='width:33%;word-break:break-word;'>Commission Type</th>
            	                            ";
            	                            
            	                            if($res->commission_type == "1")
            	                              {
            	                                  $content .= "<th style='width:33%;word-break:break-word;'>No Policy</th>";
            	                              }
            	                              else if($res->commission_type == "2")
            	                              {
            	                                  $content .= "<th style='width:33%;word-break:break-word;'>Vechicle Age</th>";
            	                              }
            	                              else if($res->commission_type == "3")
            	                              {
            	                                  $content .= "<th style='width:33%;word-break:break-word;'>Min Amount - Max Amount</th>";
            	                              }
            	                      $content .= "</tr>
            	                      
            	                      
            	                       <tr style='width:33%;word-break:break-word;'>
            	                          
            	                            <td style='width:33%;word-break:break-word;'>".$res->fuel_type."</td>
            	                            <td style='width:33%;word-break:break-word;'>".$res->c_type."</td>";
            	                           
            	                              if($res->commission_type == "1")
            	                              {
            	                                   $content .= "<td style='width:33%;word-break:break-word;'>".$res->no_policy_min."-".$res->no_policy_max."</td>";
            	                              }
            	                              else if($res->commission_type == "2")
            	                              {
            	                                   $content .= "<td style='width:33%;word-break:break-word;'>".$res->vehicle_age_min." - ".$res->vehicle_age_max."</td>";
            	                              }
            	                              else if($res->commission_type == "3")
            	                              {
            	                                   $content .= "<td style='width:33%;word-break:break-word;'>".$res->min_val." - ".$res->max_val."</td>";
            	                              }
            	                      $content .= "</tr>
            	                      
            	                      <tr style='width:33%;word-break:break-word;'>
            	                            <th style='width:33%;word-break:break-word;'>Vechicle Type(New/old)</th>
            	                            <th style='width:33%;word-break:break-word;'>State</th>
            	                            <th style='width:33%;word-break:break-word;'>RTO</th>
            	                      </tr>
            	                      
            	                       <tr style='width:33%;word-break:break-word;'>
            	                            <td style='width:33%;word-break:break-word;'>".$res->vehicle_type."</td>
            	                            <td style='width:33%;word-break:break-word;'>".$res->commission_state."</td>
            	                            <td style='width:33%;word-break:break-word;'>";
            	                             foreach($rto_details as $da)
                                	                   {
                                        	                  
                                        	               $content .= $da->rto.",";           
                                	                   }
            	                            
            	                            $content .= "</td>
            	                      </tr>
            	                      </table>";
            	                      
            	                      
            	                      $content .="<table class='table table-bordered'>
            	                                    
            	                                    <tr>
            	                                         <th>Commissions</th>
            	                                         <th>IDRA</th>
            	                                         <th>JAYANTHA Comm.</th>
            	                                         <th>A</th>
            	                                         <th>B</th>
            	                                         <th>C</th>
            	                                         <th>D</th>
            	                                    <tr>
            	                                    
            	                                    <tr>
            	                                         <th>OD</th>
            	                                         <td>".$res->irda_od."&nbsp;%</td>
            	                                         <td>".$res->own_od."&nbsp;%</td>
            	                                         <td>".$res->a_od."&nbsp;%</td>
            	                                         <td>".$res->b_od."&nbsp;%</td>
            	                                         <td>".$res->c_od."&nbsp;%</td>
            	                                         <td>".$res->d_od."&nbsp;%</td>
            	                                    <tr>
            	                                    
            	                                    <tr>
            	                                         <th>TP</th>
            	                                         <td>".$res->irda_tp."&nbsp;%</td>
            	                                         <td>".$res->own_tp."&nbsp;%</td>
            	                                         <td>".$res->a_tp."&nbsp;%</td>
            	                                         <td>".$res->b_tp."&nbsp;%</td>
            	                                         <td>".$res->c_tp."&nbsp;%</td>
            	                                         <td>".$res->d_tp."&nbsp;%</td>
            	                                    <tr>
            	                                    
            	                                     <tr>
            	                                         <th>ON NET</th>
            	                                         <td>0.00&nbsp;%</td>
            	                                         <td>".$res->on_net."&nbsp;%</td>
            	                                         <td>".$res->a_net."&nbsp;%</td>
            	                                         <td>".$res->b_net."&nbsp;%</td>
            	                                         <td>".$res->c_net."&nbsp;%</td>
            	                                         <td>".$res->d_net."&nbsp;%</td>
            	                                    <tr>
            	                                    
            	                                    <tr>
            	                                         <th>NCB</th>
            	                                         <td>0.00&nbsp;%</td>
            	                                         <td>".$res->ncb_percentage."&nbsp;%</td>
            	                                         <td>".$res->a_ncb."&nbsp;%</td>
            	                                         <td>".$res->b_ncb."&nbsp;%</td>
            	                                         <td>".$res->c_ncb."&nbsp;%</td>
            	                                         <td>".$res->d_ncb."&nbsp;%</td>
            	                                    <tr>
    
            	                             </table>";   
                              }
                              else
                              {
                                   $content .=" <tr style='width:33%;word-break:break-word;'>
            	                            <th style='width:33%;word-break:break-word;'>Class</th>
            	                            <th style='width:33%;word-break:break-word;'>Policy Type</th>";
            	                    if($res->commission_type == "1")
            	                              {
            	                                 $content .="<th style='width:33%;word-break:break-word;'>No of Policy Min- Max</th>";
            	                              }
            	                               else if($res->commission_type == "3")
            	                              {
            	                                $content .="<th style='width:33%;word-break:break-word;'>Target Amount Min- Max</th>";
            	                              }
            	                              
            	                       $content .="</tr>";
            	                       
                                  $content .="<tr style='width:33%;word-break:break-word;'>
            	                            <td style='width:33%;word-break:break-word;'>Health</td>
            	                            <td style='width:33%;word-break:break-word;'>".$res->p_type."</td>";
            	                            
            	                            if($res->commission_type == "1")
            	                              {
            	                                   $content .= "<td style='width:33%;word-break:break-word;'>".$res->no_policy_min."-".$res->no_policy_max."</td>";
            	                              }
            	                              else if($res->commission_type == "3")
            	                              {
            	                                   $content .= "<td style='width:33%;word-break:break-word;'>".$res->min_val." - ".$res->max_val."</td>";
            	                              }
            	                       $content .= "</tr>";
    
            	                       $content .="<table class='table table-bordered'>
            	                                    
            	                                    <tr>
            	                                         <th>Commissions</th>
            	                                         <th>JAYANTHA Comm.</th>
            	                                         <th>A</th>
            	                                         <th>B</th>
            	                                         <th>C</th>
            	                                         <th>D</th>
            	                                    <tr>
            	                                  
            	                                     <tr>
            	                                         <th>ON NET</th>
            	                                         <td>".$res->on_net."&nbsp;%</td>
            	                                         <td>".$res->a_net."&nbsp;%</td>
            	                                         <td>".$res->b_net."&nbsp;%</td>
            	                                         <td>".$res->c_net."&nbsp;%</td>
            	                                         <td>".$res->d_net."&nbsp;%</td>
            	                                    <tr>
            	                                    
            	                                    <tr>
            	                                         <th>NCB</th>
            	                                         <td>".$res->ncb_percentage."&nbsp;%</td>
            	                                         <td>".$res->a_ncb."&nbsp;%</td>
            	                                         <td>".$res->b_ncb."&nbsp;%</td>
            	                                         <td>".$res->c_ncb."&nbsp;%</td>
            	                                         <td>".$res->d_ncb."&nbsp;%</td>
            	                                    <tr>
    
            	                             </table>";   
                              }
            	     }
            	     echo $content;
	        }
	  }
	  
	  
	  public function view_old_log()
	  {
    	     if($this->session->has_userdata('logged_in'))
    	     {
    	         $insurance_company = $this->input->post("insurance_company");
    	         $ins_class =$this->input->post("ins_class");
    	         $business_type =$this->input->post("business_type");
    	         $premium_c_type =$this->input->post("premium_c_type");
    	         $policy_type = $this->input->post("policy_type");
    	         
    	         $data = $this->pm->get_old_payout_log($insurance_company,$ins_class,$business_type,$premium_c_type,$policy_type);
    	         
    	         
    	         $content = "<style> .wrap-it{
                                word-wrap: break-word;
                                }
                                *{
                                    font-weight:unset !important;
                                }
                                th {
                                    text-align: left;
                                    background-color: #66b2d3;
                                    color: #fff;
                                }
                                table{
                                    width:100% !important;
                                }
                                td{
                                    word-wrap: break-word !important;
                                }
                        </style>";

	                 
	                 $a = 0;
	   
            	     foreach($data as $info)
            	     {
            	         if($a > 0)
            	         {
            	             $content .="</hr>";
            	         }
            	         $a++;
                	         if($info->class == "1")
                             {
                            	       $res = $this->pm->fetch_commission_details_motor($info->id);
                            	       
                            	       if($res != "")
                            	       {
                            	          $content .="<h4 style='color:red;'>Payout Log $a : ".date_format(date_create($res->from_date),'d-m-Y')."- ".date_format(date_create($res->to_date),'d-m-Y')."</h4>";
                            	       }  
                                        if($info->policy_type == "1" || $info->policy_type == "3")
                                        {
                                            $make = $this->pm->fetch_make_car_brand($info->id,$info->policy_type);
                                            $model = $this->pm->fetch_car_model_name($info->id,$info->policy_type);
                                            $varient = $this->pm->fetch_car_varient_name($info->id,$info->policy_type);
                                        }
                                        else if($info->policy_type == "2")
                                        {
                                            $make = $this->pm->fetch_make_bike_brand($info->id,$info->policy_type);
                                            $model = $this->pm->fetch_bike_model_name($info->id,$info->policy_type);
                                            $varient = $this->pm->fetch_bike_varient_name($info->id,$info->policy_type);
                                        }
                                        else if($info->policy_type == "4")
                                        {
                                            $make = $this->pm->fetch_make_e_two_wheeler_brand($info->id,$info->policy_type);
                                            $model = $this->pm->fetch_e_two_wheeler_model_name($info->id,$info->policy_type);
                                            $varient = $this->pm->fetch_e_two_wheeler_varient_name($info->id,$info->policy_type);
                                        }
                                        else if($info->policy_type == "7" || $info->policy_type == "12" || $info->policy_type == "13" || $info->policy_type == "14" || $info->policy_type == "59" || $info->policy_type == "60" || $info->policy_type == "65" || $info->policy_type == "66")
                                        {
                                            $make = $this->pm->fetch_make_pc_brand($info->id,$info->policy_type);
                                            $model = $this->pm->fetch_pc_model_name($info->id,$info->policy_type);
                                            $varient = $this->pm->fetch_pc_varient_name($info->id,$info->policy_type);
                                        }
                                        else if($info->policy_type == "8" || $info->policy_type == "9" || $info->policy_type == "10" || $info->policy_type == "15" || $info->policy_type == "16" || $info->policy_type == "61")
                                        {
                                            $make = $this->pm->fetch_make_gc_brand($info->id,$info->policy_type);
                                            $model = $this->pm->fetch_gc_model_name($info->id,$info->policy_type);
                                            $varient = $this->pm->fetch_gc_varient_name($info->id,$info->policy_type);
                                        }
                                        else if($info->policy_type == "20")
                                        {
                                             $make = $this->pm->fetch_make_misc_brand($info->id,$info->policy_type);
                                            $model = $this->pm->fetch_misc_model_name($info->id,$info->policy_type);
                                            $varient = $this->pm->fetch_misc_varient_name($info->id,$info->policy_type);
                                        }
                                        else if($info->policy_type == "55")
                                        {
                                             $make = $this->pm->fetch_make_scooter_brand($info->id,$info->policy_type);
                                             $model = $this->pm->fetch_scooter_model_name($info->id,$info->policy_type);
                                             $varient = $this->pm->fetch_scooter_varient_name($info->id,$info->policy_type);
                                        }
                                        
                                    $rto_details = $this->pm->fech_rto_details($info->id);
                                }
                             else if($info->class == "2")
                             {
                                    $res = $this->pm->fetch_payout_commission_health_by_id($info->id);
                             }
                             
                             
                             if($res != null)
                             {
                    	        if($res->class == "1")
        	                    {     
        	                        
        	                      $content .="<table class='table table-bordered' style='width:100%'>";
        	                   
        	                      $content .="  <tr>
        	                            <th style='width:16.65%;word-break:break-word;'>Insurer</th>
        	                            <th style='width:16.65%;word-break:break-word;'>Premium Cover Type</th>
        	                            <th style='width:16.65%;word-break:break-word;'>Business Type</th>
        	                            <th style='width:16.65%;word-break:break-word;'>Class</th>
        	                            <th style='width:16.65%;word-break:break-word;'>Policy Type</th>
        	                            <th style='width:16.65%;word-break:break-word;'>Classification cc/gvw</th>
        	                       </tr>
        	                       
        	                       <tr>
        	                             <td style='width:16.65%;word-break:break-word;'>".$res->company_name."</td>";
        	                             $content .="<td style='width:16.65%;word-break:break-word;'>".$res->premium_name."</td>";
        	                             $content .=" <td style='width:16.65%;word-break:break-word;'>".$res->b_type."</td>";

                    	                 $content .="<td style='width:16.65%;word-break:break-word;'>Motor</td>
                    	                            <td style='width:16.65%;word-break:break-word;'>".$res->p_type."</td>
                    	                            <td style='width:16.65%;word-break:break-word;'>".$res->from_gvw_cc."".$res->classification." - ".$res->to_gvw_cc."".$res->classification."</td>
                    	                       </tr>";
                    	               $content .="</table>";         
                    	                  
                    	                 $content .="<table class='table table-bordered' style='width:100%'>";     
                    	                 $content .="<tr style='width:33%;word-break:break-word;'>
                    	                            <th style='width:33%;word-break:break-word;'>Make</th>
                    	                            <th style='width:33%;word-break:break-word;'>Model</th>
                    	                            <th style='width:33%;word-break:break-word;'>Varient</th>
                    	                      </tr>
                    	                      
                    	                      <tr>
                    	                      <td style='width:33%;word-break:break-word;' class='word-wrap'>";
                    	                    
                    	                    if($make != null)
                    	                    {
                    	                       foreach($make as $da)
                	                           {
                	                               $content .=$da->brand_name.",";
                	                           }
                    	                    }
                    	                    else
                    	                    {
                    	                         $content .="ALL";
                    	                    }
                	                           
                    	                     $content .="</td>
                    	                                 <td style='width:33%;word-break:break-word;' class='word-wrap'>";
                    	                     if($model != null)
                    	                     {
                    	                       foreach($model as $da)
                	                           {
                	                               $content .=$da->model_name.",";
                	                           }
                    	                     }
                    	                     else
                    	                     {
                    	                          $content .="ALL";
                    	                     }
                    	                     
                    	                     $content .="</td>
                    	                     <td style='width:33%;word-break:break-word;' class='word-wrap'>";
                    	                    
                    	                    if($varient != null)
                    	                    {
                    	                      foreach($varient as $da)
                	                           {
                	                               $content .=$da->varient_name.",";
                	                           }
                    	                    }
                    	                    else 
                    	                    {
                    	                         $content .="ALL";
                    	                    }
                    	                      $content .="</td>
                    	                      </tr>
                    	                      
                    	                     <tr style='width:33%;word-break:break-word;'>
                    	                            <th style='width:33%;word-break:break-word;'>Fuel type</th>
                    	                            <th style='width:33%;word-break:break-word;'>Commission Type</th>
                    	                            ";
                    	                            
                    	                            if($res->commission_type == "1")
                    	                              {
                    	                                  $content .= "<th style='width:33%;word-break:break-word;'>No Policy</th>";
                    	                              }
                    	                              else if($res->commission_type == "2")
                    	                              {
                    	                                  $content .= "<th style='width:33%;word-break:break-word;'>Vechicle Age</th>";
                    	                              }
                    	                              else if($res->commission_type == "3")
                    	                              {
                    	                                  $content .= "<th style='width:33%;word-break:break-word;'>Min Amount - Max Amount</th>";
                    	                              }
                    	                      $content .= "</tr>
                    	                      
                    	                      
                    	                       <tr style='width:33%;word-break:break-word;'>
                    	                          
                    	                            <td style='width:33%;word-break:break-word;'>".$res->fuel_type."</td>
                    	                            <td style='width:33%;word-break:break-word;'>".$res->c_type."</td>";
                    	                           
                    	                              if($res->commission_type == "1")
                    	                              {
                    	                                   $content .= "<td style='width:33%;word-break:break-word;'>".$res->no_policy_min."-".$res->no_policy_max."</td>";
                    	                              }
                    	                              else if($res->commission_type == "2")
                    	                              {
                    	                                   $content .= "<td style='width:33%;word-break:break-word;'>".$res->vehicle_age_min." - ".$res->vehicle_age_max."</td>";
                    	                              }
                    	                              else if($res->commission_type == "3")
                    	                              {
                    	                                   $content .= "<td style='width:33%;word-break:break-word;'>".$res->min_val." - ".$res->max_val."</td>";
                    	                              }
                    	                      $content .= "</tr>
                    	                      
                    	                      <tr style='width:33%;word-break:break-word;'>
                    	                            <th style='width:33%;word-break:break-word;'>Vechicle Type(New/old)</th>
                    	                            <th style='width:33%;word-break:break-word;'>State</th>
                    	                            <th style='width:33%;word-break:break-word;'>RTO</th>
                    	                      </tr>
                    	                      
                    	                       <tr style='width:33%;word-break:break-word;'>
                    	                            <td style='width:33%;word-break:break-word;'>".$res->vehicle_type."</td>
                    	                            <td style='width:33%;word-break:break-word;'>".$res->commission_state."</td>
                    	                            <td style='width:33%;word-break:break-word;'>";
                    	                             foreach($rto_details as $da)
                                        	                   {
                                                	                  
                                                	               $content .= $da->rto.",";           
                                        	                   }
                    	                            
                    	                            $content .= "</td>
                    	                      </tr>
                    	                      </table>";
                    	                      
                    	                      
                    	                      $content .="<table class='table table-bordered'>
                    	                                    
                    	                                    <tr>
                    	                                         <th>Commissions</th>
                    	                                         <th>IDRA</th>
                    	                                         <th>JAYANTHA Comm.</th>
                    	                                         <th>A</th>
                    	                                         <th>B</th>
                    	                                         <th>C</th>
                    	                                         <th>D</th>
                    	                                    <tr>
                    	                                    
                    	                                    <tr>
                    	                                         <th>OD</th>
                    	                                         <td>".$res->irda_od."&nbsp;%</td>
                    	                                         <td>".$res->own_od."&nbsp;%</td>
                    	                                         <td>".$res->a_od."&nbsp;%</td>
                    	                                         <td>".$res->b_od."&nbsp;%</td>
                    	                                         <td>".$res->c_od."&nbsp;%</td>
                    	                                         <td>".$res->d_od."&nbsp;%</td>
                    	                                    <tr>
                    	                                    
                    	                                    <tr>
                    	                                         <th>TP</th>
                    	                                         <td>".$res->irda_tp."&nbsp;%</td>
                    	                                         <td>".$res->own_tp."&nbsp;%</td>
                    	                                         <td>".$res->a_tp."&nbsp;%</td>
                    	                                         <td>".$res->b_tp."&nbsp;%</td>
                    	                                         <td>".$res->c_tp."&nbsp;%</td>
                    	                                         <td>".$res->d_tp."&nbsp;%</td>
                    	                                    <tr>
                    	                                    
                    	                                     <tr>
                    	                                         <th>ON NET</th>
                    	                                         <td>0.00&nbsp;%</td>
                    	                                         <td>".$res->on_net."&nbsp;%</td>
                    	                                         <td>".$res->a_net."&nbsp;%</td>
                    	                                         <td>".$res->b_net."&nbsp;%</td>
                    	                                         <td>".$res->c_net."&nbsp;%</td>
                    	                                         <td>".$res->d_net."&nbsp;%</td>
                    	                                    <tr>
                    	                                    
                    	                                    <tr>
                    	                                         <th>NCB</th>
                    	                                         <td>0.00&nbsp;%</td>
                    	                                         <td>".$res->ncb_percentage."&nbsp;%</td>
                    	                                         <td>".$res->a_ncb."&nbsp;%</td>
                    	                                         <td>".$res->b_ncb."&nbsp;%</td>
                    	                                         <td>".$res->c_ncb."&nbsp;%</td>
                    	                                         <td>".$res->d_ncb."&nbsp;%</td>
                    	                                    <tr>
            
                    	                             </table>";   
                                      }
                                else
                                {
                                   $content .="<table class='table table-bordered' style='width:100%'>";
                                
                                     $content .="<tr>
        	                            <th style='width:33%;word-break:break-word;'>Insurer</th>
        	                            <th style='width:33%;word-break:break-word;'>Premium Cover Type</th>
        	                            <th style='width:33%;word-break:break-word;'>Business Type</th>
        	                            </tr>";
        	                            
        	                            
        	                             $content .="<td style='width:33%;word-break:break-word;'>".$res->company_name."</td>";
        	                             $content .="<td style='width:33%;word-break:break-word;'>Health</td>";
        	                             $content .=" <td style='width:33%;word-break:break-word;'>".$res->b_type."</td>";
                                    
                                           $content .=" <tr style='width:33%;word-break:break-word;'>
                    	                            <th style='width:33%;word-break:break-word;'>Class</th>
                    	                            <th style='width:33%;word-break:break-word;'>Policy Type</th>";
                    	                    if($res->commission_type == "1")
                    	                              {
                    	                                 $content .="<th style='width:33%;word-break:break-word;'>No of Policy Min- Max</th>";
                    	                              }
                    	                               else if($res->commission_type == "3")
                    	                              {
                    	                                $content .="<th style='width:33%;word-break:break-word;'>Target Amount Min- Max</th>";
                    	                              }
                    	                              
                    	                       $content .="</tr>";
                    	                       
                                          $content .="<tr style='width:33%;word-break:break-word;'>
                    	                            <td style='width:33%;word-break:break-word;'>Health</td>
                    	                            <td style='width:33%;word-break:break-word;'>".$res->p_type."</td>";
                    	                            
                    	                            if($res->commission_type == "1")
                    	                              {
                    	                                   $content .= "<td style='width:33%;word-break:break-word;'>".$res->no_policy_min."-".$res->no_policy_max."</td>";
                    	                              }
                    	                              else if($res->commission_type == "3")
                    	                              {
                    	                                   $content .= "<td style='width:33%;word-break:break-word;'>".$res->min_val." - ".$res->max_val."</td>";
                    	                              }
                    	                       $content .= "</tr>";
            
                    	                       $content .="<table class='table table-bordered'>
                    	                                    
                    	                                    <tr>
                    	                                         <th>Commissions</th>
                    	                                         <th>JAYANTHA Comm.</th>
                    	                                         <th>A</th>
                    	                                         <th>B</th>
                    	                                         <th>C</th>
                    	                                         <th>D</th>
                    	                                    <tr>
                    	                                  
                    	                                     <tr>
                    	                                         <th>ON NET</th>
                    	                                         <td>".$res->on_net."&nbsp;%</td>
                    	                                         <td>".$res->a_net."&nbsp;%</td>
                    	                                         <td>".$res->b_net."&nbsp;%</td>
                    	                                         <td>".$res->c_net."&nbsp;%</td>
                    	                                         <td>".$res->d_net."&nbsp;%</td>
                    	                                    <tr>
                    	                                    
                    	                                    <tr>
                    	                                         <th>NCB</th>
                    	                                         <td>".$res->ncb_percentage."&nbsp;%</td>
                    	                                         <td>".$res->a_ncb."&nbsp;%</td>
                    	                                         <td>".$res->b_ncb."&nbsp;%</td>
                    	                                         <td>".$res->c_ncb."&nbsp;%</td>
                    	                                         <td>".$res->d_ncb."&nbsp;%</td>
                    	                                    <tr>
            
                    	                             </table>";   
                                      }
                                      
                                $content .="<button type='button' id='add_data_btn' class='btn btn-primary' onclick=add_data(".$res->id.")>Add</button>";
                             }
            	     }
            	     echo $content;
    	         
    	     }
	  }
	  
	  public function fetch_policy_type_using_class()
	  {
	      if($this->session->has_userdata('logged_in'))
    	  {
    	      $policy_class = $this->input->post("policy_class");
    	      $res = $this->pm->fetch_policy_type_using_class($policy_class);
    	      echo json_encode($res);
    	  }
	  }
	  
	  public function get_old_entry()
	  {
	      if($this->session->has_userdata('logged_in'))
    	  {
    	      $insurer_company = $this->input->post("insurer_company");
    	      $policy_type = $this->input->post("policy_type");
    	      $f_date = $this->input->post("f_date");
    	      $to_date = $this->input->post("to_date");
    	      $commission_type = $this->input->post("commission_type");
    	      $res = $this->pm->get_old_entry($insurer_company,$policy_type,$f_date,$to_date,$commission_type);
    	      
    	      if($commission_type == "1")
    	      {
    	          $th = "NOP";
    	      }
    	      else if($commission_type == "2")
    	      {
    	          $th = "V_Age";
    	      }
    	      else if($commission_type == "3")
    	      {
    	          $th = "Target";
    	      }
    	      
    	      
    	   $content = "<div class='table table-responsive'><table class='table table-bordered' style='width:100%'>
    	                 <thead>
    	                    <tr>
                                <th>Payout Type</th>
                                <th>Type</th>
                                <th>cover_Type</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Varient</th>
                                <th>Fuel</th>
                                <th>Classification</th>
                                <th>Rto</th>
                                <th>".$th."</th>
                                <th>NCB</th>
                                <th>NCB(%)</th>
                                <th>On_net</th>
                                <th>OD</th>
                                <th>Tp</th>
                                <th>Agn_Com</th>
                            </tr>
    	                 </thead>";
    	                 
    	                 
    	           foreach($res as $da)
    	           { 
    	                  $rto_details = $this->pm->fech_rto_details($da->id);
    	                  
        	               if($da->policy_type == "1" || $da->policy_type == "3")
                            {
                                $make = $this->pm->fetch_make_car_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_car_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_car_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "2")
                            {
                                $make = $this->pm->fetch_make_bike_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_bike_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_bike_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "4")
                            {
                                $make = $this->pm->fetch_make_e_two_wheeler_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_e_two_wheeler_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_e_two_wheeler_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "7" || $da->policy_type == "12" || $da->policy_type == "13" || $da->policy_type == "14" || $da->policy_type == "59" || $da->policy_type == "60" || $da->policy_type == "65" || $da->policy_type == "66" || $da->policy_type == "69" )
                            {
                                $make = $this->pm->fetch_make_pc_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_pc_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_pc_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "8" || $da->policy_type == "9" || $da->policy_type == "10" || $da->policy_type == "15" || $da->policy_type == "16" || $da->policy_type == "61")
                            {
                                $make = $this->pm->fetch_make_gc_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_gc_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_gc_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "20")
                            {
                                 $make = $this->pm->fetch_make_misc_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_misc_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_misc_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "55")
                            {
                                 $make = $this->pm->fetch_make_scooter_brand($da->id,$da->policy_type);
                                 $model = $this->pm->fetch_scooter_model_name($da->id,$da->policy_type);
                                 $varient = $this->pm->fetch_scooter_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "18")
                            {
                                 $make = $this->pm->fetch_make_ambulance_brand($da->id,$da->policy_type);
                                 $model = $this->pm->fetch_ambulance_model_name($da->id,$da->policy_type);
                                 $varient = $this->pm->list_of_ambulance_varient($da->id,$da->policy_type);
                            }
                            
        	                $content .= "<tbody>
                            <tr>
                                <td>".$da->payout_type."</td>
                                <td>".$da->type."</td>
                                <td>".$da->pc_type."</td>";
                                
                                if($da->v_make != "all")
                                {
                                    $content .= " <td>";
                                    $i = 0;
                                    
                                    foreach($make as $br)
                                    {
                                        $i++;
                                        
                                        if($i < 3)
                                        {
                                             $content .= $br->brand_name.",";
                                        }
                                        else if($i > 3)
                                        {
                                          $content .="...<button class='btn btn-default btn-xs popper' onclick=load_brand(".$da->id.")>load more >></button>";
                                          break;
                                        }
                                    }
                                    $content .= " </td>";
                                }
                                else
                                {
                                    $content .= " <td>".$da->v_make."</td>";
                                }
                                
                                if($da->v_model != "all")
                                {
                                    $content .= " <td>";
                                    
                                    $j = 0;
                                    
                                    foreach($model as $mod)
                                    {
                                        $j++;
                                        
                                        if($j < 3)
                                        {
                                            $content .= $mod->model_name.",";
                                        }
                                        else if($j > 3)
                                        {
                                            $content .="...<button class='btn btn-default btn-xs popper' onclick=load_model(".$da->id.")>load more >></button>";
                                            break;
                                        }
                                    }
                                    $content .= " </td>";
                                }
                                else
                                {
                                   $content .= " <td>".$da->v_model."</td>";
                                }
                                
                                $k = 0;
                                
                                if($da->v_varient != "all")
                                {
                                    $content .= " <td>";
                                    
                                    foreach($varient as $var)
                                    {
                                        $k++; 
                                        if($k < 3)
                                        {
                                            $content .= $var->varient_name.",";
                                             
                                        }
                                        else if($k > 3)
                                        {
                                              $content .="...<button class='btn btn-default btn-xs popper' onclick=load_varient(".$da->id.")>load more >></button>";
                                               break;
                                        }
                                   }
                                    $content .= " </td>";
                                }
                                else
                                {
                                   $content .= " <td>".$da->v_varient."</td>";
                                }
                                $content .= "<td>".$da->fuel."</td>";
                                $l = 0;

                                $content .= "<td>".$da->from_gvw_cc."".$da->classification." - ".$da->to_gvw_cc."".$da->classification."</td>";
                                $content .= "<td>"; 
                                
                                foreach($rto_details as $rto)
                                {
                                    $l++;
                                    
                                    if($l < 3)
                                    {
                                        $content .= $rto->rto.",";
                                        
                                    }
                                    else if($l > 3)
                                     {
                                          $content .="...<a class='btn btn-default btn-xs' onclick=load_rto(".$da->id.")>load more >></a>";
                                          break;
                                     }
                               }
                               
                            $content .= " </td>";
                            
                            if($da->commission_type == "1")
                            {
                               $content .= "<td>".$da->no_policy_min." - ".$da->no_policy_max."</td>";
                            }
                            else if($da->commission_type == "2")
                            {
                                $content .= "<td>".$da->vehicle_age_min." - ".$da->vehicle_age_max."</td>";
                            }
                            else if($da->commission_type == "3")
                            {
                                $content .= "<td>".$da->min_val." - ".$da->max_val."</td>";
                            }
                            $content .= "<td>".$da->is_ncb."</td>";
                            $content .= "<td>".$da->ncb_percentage."</td>";
                            $content .= "<td>".$da->on_net."</td>";
                            $content .= "<td>".$da->own_od."</td>";
                            $content .= "<td>".$da->own_tp."</td>";
                            $content .= "<td><button class='btn btn-default btn-xs' onclick=load_agn_com(".$da->id.")>load>></button></td>";
                            $content .= "</tr>";
    	           }
    	           
    	            $content .= "</tbody>
    	             </table></div>";
    	               
    	               echo $content;
    	  }
	  }
	  
	  public function load_all_rto()
	  {
	      if($this->session->has_userdata('logged_in'))
    	  {
    	    $pro_data["project_info"] = $this->mm->fetch_project_info();
            $id = $this->input->post("id");
            $res = $this->pm->load_all_rto($id);
            
            $content = "<p style='word-break:break-word;'>";
            
            
            foreach($res as $da){ 
                    $content .=$da->rto.",";
            }
            $content .="</p>";
            
            echo $content;
    	      
    	  }
	  }
	  
	  public function load_motors_list()
	  {
	      
	      if($this->session->has_userdata('logged_in'))
    	  {
    	    $pro_data["project_info"] = $this->mm->fetch_project_info();
            $id = $this->input->post("id");
            $tab = $this->input->post("tab");
            $res = $this->pm->load_all_varient($id);
            $varient = $this->pm->load_all_varient_by_commission_id($id);
            
            if($res->policy_type == "1" || $res->policy_type == "3")
            {
                $make = $this->pm->fetch_make_car_brand($id,$res->policy_type);
                $model = $this->pm->fetch_car_model_name($id,$res->policy_type);
                $varient = $this->pm->fetch_car_varient_name($id,$res->policy_type);
            }
            else if($res->policy_type == "2")
            {
                $make = $this->pm->fetch_make_bike_brand($id,$res->policy_type);
                $model = $this->pm->fetch_bike_model_name($id,$res->policy_type);
                $varient = $this->pm->fetch_bike_varient_name($id,$res->policy_type);
            }
            else if($res->policy_type == "4")
            {
                $make = $this->pm->fetch_make_e_two_wheeler_brand($id,$res->policy_type);
                $model = $this->pm->fetch_e_two_wheeler_model_name($id,$res->policy_type);
                $varient = $this->pm->fetch_e_two_wheeler_varient_name($id,$res->policy_type);
            }
            else if($res->policy_type == "7" || $res->policy_type == "12" || $res->policy_type == "13" || $res->policy_type == "14" || $res->policy_type == "59" || $res->policy_type == "60" || $res->policy_type == "65" || $res->policy_type == "66" || $res->policy_type == "69" )
            {
                $make = $this->pm->fetch_make_pc_brand($id,$res->policy_type);
                $model = $this->pm->fetch_pc_model_name($id,$res->policy_type);
                $varient = $this->pm->fetch_pc_varient_name($id,$res->policy_type);
            }
            else if($res->policy_type == "8" || $res->policy_type == "9" || $res->policy_type == "10" || $res->policy_type == "15" || $res->policy_type == "16" || $res->policy_type == "61")
            {
                $make = $this->pm->fetch_make_gc_brand($id,$res->policy_type);
                $model = $this->pm->fetch_gc_model_name($id,$res->policy_type);
                $varient = $this->pm->fetch_gc_varient_name($id,$res->policy_type);
            }
            else if($res->policy_type == "20")
            {
                 $make = $this->pm->fetch_make_misc_brand($id,$res->policy_type);
                $model = $this->pm->fetch_misc_model_name($id,$res->policy_type);
                $varient = $this->pm->fetch_misc_varient_name($id,$res->policy_type);
            }
            else if($res->policy_type == "55")
            {
                 $make = $this->pm->fetch_make_scooter_brand($id,$res->policy_type);
                 $model = $this->pm->fetch_scooter_model_name($id,$res->policy_type);
                 $varient = $this->pm->fetch_scooter_varient_name($id,$res->policy_type);
            }
      
            $content = "";

        	       $content .="<table class='table table-bordered' style='width:100%'>";
        	       $content .="<tr style='width:33%;word-break:break-word;'>
        	                            <th style='width:33%;word-break:break-word;'>Make</th>
        	                            <th style='width:33%;word-break:break-word;'>Model</th>
        	                            <th style='width:33%;word-break:break-word;'>Varient</th>
        	                    </tr>
        	                      
        	                   <tr>
        	                   
        	                      <td style='width:33%;word-break:break-word;' class='word-wrap'>";
        	                      
                                    if($make != null)
                                    {
                                       foreach($make as $da)
                                       {
                                           $content .=$da->brand_name.",";
                                       }
                                    }
                                    else
                                    {
                                         $content .="ALL";
                                    }
    	                           
        	                     $content .="</td>
        	                     
        	                     <td style='width:33%;word-break:break-word;' class='word-wrap'>";
        	                     
        	                     if($model != null)
        	                     {
        	                       foreach($model as $da)
    	                           {
    	                               $content .=$da->model_name.",";
    	                           }
        	                     }
        	                     else
        	                     {
        	                          $content .="ALL";
        	                     }
        	                     
        	                     $content .="</td>
        	                     <td style='width:33%;word-break:break-word;' class='word-wrap'>";
        	                    
        	                    if($varient != null)
        	                    {
        	                      foreach($varient as $da)
    	                           {
    	                               $content .=$da->varient_name.",";
    	                           }
        	                    }
        	                    else 
        	                    {
        	                         $content .="ALL";
        	                    }
        	                      $content .="</td>
        	       </tr></table>";
        	       
              echo json_encode(array("content" =>$content,"tab" =>$tab));
    	  }
	  }
	  
	  public function load_agent_commission()
	  {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
	        
            $id = $this->input->post("id");
            $res = $this->pm->load_agent_commission($id);
            $content = "";
            $content .="<table class='table table-bordered'>
                            <tr>
                                 <th>Commissions</th>
                                 <th>IDRA</th>
                                 <th>JAYANTHA Comm.</th>
                                 <th>A</th>
                                 <th>B</th>
                                 <th>C</th>
                                 <th>D</th>
                            <tr>
        	                                    
                    <tr>
                         <th>OD</th>
                         <td>".$res->irda_od."&nbsp;%</td>
                         <td>".$res->own_od."&nbsp;%</td>
                         <td>".$res->a_od."&nbsp;%</td>
                         <td>".$res->b_od."&nbsp;%</td>
                         <td>".$res->c_od."&nbsp;%</td>
                         <td>".$res->d_od."&nbsp;%</td>
                    <tr>
                    
                    <tr>
                         <th>TP</th>
                         <td>".$res->irda_tp."&nbsp;%</td>
                         <td>".$res->own_tp."&nbsp;%</td>
                         <td>".$res->a_tp."&nbsp;%</td>
                         <td>".$res->b_tp."&nbsp;%</td>
                         <td>".$res->c_tp."&nbsp;%</td>
                         <td>".$res->d_tp."&nbsp;%</td>
                    <tr>
                    
                     <tr>
                         <th>ON NET</th>
                         <td>0.00&nbsp;%</td>
                         <td>".$res->on_net."&nbsp;%</td>
                         <td>".$res->a_net."&nbsp;%</td>
                         <td>".$res->b_net."&nbsp;%</td>
                         <td>".$res->c_net."&nbsp;%</td>
                         <td>".$res->d_net."&nbsp;%</td>
                    <tr>
                    
                    <tr>
                         <th>NCB</th>
                         <td>0.00&nbsp;%</td>
                         <td>".$res->ncb_percentage."&nbsp;%</td>
                         <td>".$res->a_ncb."&nbsp;%</td>
                         <td>".$res->b_ncb."&nbsp;%</td>
                         <td>".$res->c_ncb."&nbsp;%</td>
                         <td>".$res->d_ncb."&nbsp;%</td>
                    <tr>
                    
                      <tr>
                         <th>CPA</th>
                         <td>0.00&nbsp;%</td>
                         <td>".$res->cpa_percentage."&nbsp;%</td>
                         <td>".$res->a_cpa."&nbsp;%</td>
                         <td>".$res->b_cpa."&nbsp;%</td>
                         <td>".$res->c_cpa."&nbsp;%</td>
                         <td>".$res->d_cpa."&nbsp;%</td>
                    <tr>

             </table>";   
             
           echo $content;
	  }
	  
	   public function fetch_payout_commission_entry()
	   {
	        if($this->session->has_userdata('logged_in'))
    	    {
                $draw = intval($this->input->post("draw"));
                $class = $this->input->post("ins_class");
                $f_date = $this->input->post("f_date");
                $to_date = $this->input->post("to_date");
                $sql = "";
                if($class == "1")
                {
                   $res = $this->pm->fetch_payout_commission_entry_motor($class,$f_date,$to_date);
                 //  echo $res;
                }
                else 
                {
                     $res = $this->pm->fetch_payout_commission_health($class,$f_date,$to_date);
                     $sql = $this->db->last_query();
                }
               
        		$arr = [];
                $a = 0 ;
                
                foreach($res as $da)
                {
                   $a++;
                   $action = "";
                    
                    // start 2023-08-17
                    $isrenewal = false;
                    
                    if($da->class == "1")
                    {
                      //$view = "<a href='#' onclick=view_data(".$da->insurer_company.",".$da->policy_premium_type.",".$da->policy_type.",'".$da->type."')> ".$da->company_name."</a>";
                      
                      // start 2023-08-17
                        if(isset($da->payout_type) && !empty($da->payout_type) && $da->payout_type == "Renewal"){
                            $isrenewal = true;
                            $view = "<a href='#' style='color:green' onclick=view_data(".$da->insurer_company.",".$da->policy_premium_type.",".$da->policy_type.",'".$da->type."')> ".$da->company_name."</a>";
                        } else {
                            $view = "<a href='#' onclick=view_data(".$da->insurer_company.",".$da->policy_premium_type.",".$da->policy_type.",'".$da->type."')> ".$da->company_name."</a>";
                        }
                        // end 2023-08-17

                    }
                    else
                    {
                     $view = "<a href='#' onclick=view_health_data(".$da->insurer_company.",".$da->policy_type.",'".$da->business_type."') title=".$da->business_type."-".$da->policy_type."-".$da->id."> ".$da->company_name."</a>";
                    }
                      if($class == "1")  
                      {
                           $classifiaction = "";
                        
                            if($da->policy_type == "12" || $da->policy_type == "13" || $da->policy_type == "14" || $da->policy_type == "59" || $da->policy_type == "60" || $da->policy_type == "65" || $da->policy_type == "66")
                            {
                               
                               $classifiaction = $da->seating_capacity. "Seater";
                            }
                            else
                            {
                                $classifiaction = $da->from_gvw_cc.$da->classi."-".$da->to_gvw_cc.$da->classi;
                            }
                        
                        
                        // $arr[] = array(
                        //     $a,
                        //     $view,
                        //     $da->premium_name,
                        //     $da->p_type,
                        //     $da->type,
                        // );
                        
                         // start 2023-08-17
                        $arr[] = array(
                            $a,
                            (($isrenewal) ?  "<span style='color:green'>{$view}</span>" : $view),
                            (($isrenewal) ?  "<span style='color:green'>{$da->premium_name}</span>" : $da->premium_name),
                            (($isrenewal) ?  "<span style='color:green'>{$da->p_type}</span>" : $da->p_type),
                            (($isrenewal) ?  "<span style='color:green'>{$da->type}</span>" : $da->type),                            
                        );
                      }
                      else
                      {
                              $arr[] = array(
                                $a,
                                $view,
                                $da->bussiness_type,
                                $da->p_type,
                            );
                      }
              }
                $result = array(
                			"draw"=> $draw,
        				    "recordsTotal"=>count($res),
        				    "recordsFiltered"=> count($res),
        				    "data"=>$arr,
        				    "sql" => $sql
        				);
                     echo json_encode($result);
    	    }
	    }
	    
	     
       public function view_payout_commission_entry()
       {
           if($this->session->has_userdata('logged_in')) 
        	{
        	    $ins_company = $this->input->post("ins_company");
        	    $p_cover = $this->input->post("p_cover");
        	    $policy_type = $this->input->post("policy_type");
        	    $type = $this->input->post("type");
        	    
        	    $s_f_date = $this->input->post("s_f_date");
        	    $s_to_date = $this->input->post("s_to_date");

        	    $res = $this->pm->view_payout_commission_entry($ins_company,$p_cover,$policy_type,$type,$s_f_date,$s_to_date);
        	    
        	    $content = "<style> .wrap-it{
                                            word-wrap: break-word;
                                            }
                                            *{
                                                font-weight:unset !important;
                                            }
                                            th {
                                                text-align: left;
                                            }
                                            table{
                                                width:100% !important;
                                            }
                                            td{
                                                word-wrap: break-word !important;
                                            }
                                            .renewal-td {
                                                color: green;
                                            }
                                    </style>";

        	       $content .= "<table class='table table-bordered' style='width:100%'>
    	                 <thead>
    	                    <tr>
    	                        <th>S.No</th>
                                <th>Payout Type</th>
                                <th>Type</th>
                                <th>Date_Period</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Varient</th>
                                <th>Fuel</th>
                                <th>Classification</th>
                                <th>Rto</th>
                                <th>V_age</th>
                                <th>NCB</th>
                                <th>NCB(%)</th>
                                <th>On_net</th>
                                <th>OD</th>
                                <th>Tp</th>
                                <th>Agn_Com</th>
                                <th>Action_Record</th>
                            </tr>
    	                 </thead>";
    	           
    	           $a = 0;      
    	                 
    	           foreach($res as $da)
    	           { 
    	               $a++;
    	               
    	                    $title = $da->company_name." / ".$da->p_type." / ".$da->premium_name." / ".$da->type;
    	               
    	                    $isrenewal = (isset($da->payout_type) && !empty($da->payout_type) && $da->payout_type == "Renewal") ? true : false;
    	                    
    	                   $rto_details = $this->pm->fech_rto_details($da->id);
    	                   
        	               if($da->policy_type == "1" || $da->policy_type == "3")
                            {
                                $make = $this->pm->fetch_make_car_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_car_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_car_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "2")
                            {
                                $make = $this->pm->fetch_make_bike_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_bike_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_bike_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "4")
                            {
                                $make = $this->pm->fetch_make_e_two_wheeler_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_e_two_wheeler_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_e_two_wheeler_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "7" || $da->policy_type == "12" || $da->policy_type == "13" || $da->policy_type == "14" || $da->policy_type == "59" || $da->policy_type == "60" || $da->policy_type == "65" || $da->policy_type == "66" || $da->policy_type == "69" )
                            {
                                $make = $this->pm->fetch_make_pc_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_pc_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_pc_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "8" || $da->policy_type == "9" || $da->policy_type == "10" || $da->policy_type == "15" || $da->policy_type == "16" || $da->policy_type == "61")
                            {
                                $make = $this->pm->fetch_make_gc_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_gc_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_gc_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "20")
                            {
                                 $make = $this->pm->fetch_make_misc_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_misc_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_misc_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "55")
                            {
                                 $make = $this->pm->fetch_make_scooter_brand($da->id,$da->policy_type);
                                 $model = $this->pm->fetch_scooter_model_name($da->id,$da->policy_type);
                                 $varient = $this->pm->fetch_scooter_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "18")
                            {
                                 $make = $this->pm->fetch_make_ambulance_brand($da->id,$da->policy_type);
                                 $model = $this->pm->fetch_ambulance_model_name($da->id,$da->policy_type);
                                 $varient = $this->pm->fetch_ambulance_varient_name($da->id,$da->policy_type);
                            }
                            
        	                $content .= "<tbody>
                            <tr>
                                <td class='".(($isrenewal) ? 'renewal-td' : '')."'>".$a."</td>
                                <td class='".(($isrenewal) ? 'renewal-td' : '')."'>".$da->payout_type."</td>
                                <td class='".(($isrenewal) ? 'renewal-td' : '')."'>".$da->type."</td>
                                <td class='".(($isrenewal) ? 'renewal-td' : '')."'>".date_format(date_create($da->from_date),"d-m")." - ".date_format(date_create($da->to_date),"d-m")."</td>";
                                
                                if($da->v_make != "all")
                                {
                                    $content .= " <td class='".(($isrenewal) ? 'renewal-td' : '')."'>";
                                    $i = 0;
                                    
                                    foreach($make as $br)
                                    {
                                        $i++;
                                        
                                        if($i < 3)
                                        {
                                             $content .= $br->brand_name.",";
                                        }
                                        else if($i > 3)
                                        {
                                          $content .="...<button class='btn btn-default btn-xs' onclick=load_brand(".$da->id.")>load more >></button>";
                                          break;
                                        }
                                    }
                                    $content .= " </td>";
                                }
                                else
                                {
                                    $content .= " <td class='".(($isrenewal) ? 'renewal-td' : '')."'>".$da->v_make."</td>";
                                }
                                
                                if($da->v_model != "all")
                                {
                                    $content .= " <td class='".(($isrenewal) ? 'renewal-td' : '')."'>";
                                    
                                    $j = 0;
                                    
                                    if( isset($model) && !empty($model)){
                                        foreach($model as $mod)
                                        {
                                            $j++;
                                            
                                            if($j < 3)
                                            {
                                                $content .= $mod->model_name.",";
                                            }
                                            else if($j > 3)
                                            {
                                                $content .="...<button class='btn btn-default btn-xs' onclick=load_model(".$da->id.")>load more >></button>";
                                                break;
                                            }
                                        }
                                    }
                                    $content .= " </td>";
                                }
                                else
                                {
                                   $content .= " <td class='".(($isrenewal) ? 'renewal-td' : '')."'>".$da->v_model."</td>";
                                }
                                
                                $k = 0;
                                
                                if($da->v_varient != "all")
                                {
                                    $content .= " <td class='".(($isrenewal) ? 'renewal-td' : '')."'>";
                                    
                                    foreach($varient as $var)
                                    {
                                        $k++; 
                                        if($k < 3)
                                        {
                                            $content .= $var->varient_name.",";
                                             
                                        }
                                        else if($k > 3)
                                        {
                                              $content .="...<button class='btn btn-default btn-xs' onclick=load_varient(".$da->id.")>load more >></button>";
                                               break;
                                        }
                                   }
                                    $content .= " </td>";
                                }
                                else
                                {
                                   $content .= " <td class='".(($isrenewal) ? 'renewal-td' : '')."'>".$da->v_varient."</td>";
                                }
                                $content .= "<td class='".(($isrenewal) ? 'renewal-td' : '')."'>".$da->fuel_type."</td>";
                                $l = 0;

                                $content .= "<td class='".(($isrenewal) ? 'renewal-td' : '')."'>".$da->from_gvw_cc."".$da->classification." - ".$da->to_gvw_cc."".$da->classification."</td>";
                                $content .= "<td class='".(($isrenewal) ? 'renewal-td' : '')."'>"; 
                                
                                foreach($rto_details as $rto)
                                {
                                    $l++;
                                    
                                    if($l < 3)
                                    {
                                        $content .= $rto->rto.",";
                                        
                                    }
                                    else if($l > 3)
                                     {
                                          $content .="...<button class='btn btn-default btn-xs' onclick=load_rto(".$da->id.")>load more >></button>";
                                          break;
                                     }
                               }
                               
                            $content .= " </td>";
                            
                            if($da->commission_type == "1")
                            {
                               $content .= "<td class='".(($isrenewal) ? 'renewal-td' : '')."'>".$da->no_policy_min." - ".$da->no_policy_max."</td>";
                            }
                            else if($da->commission_type == "2")
                            {
                                $content .= "<td class='".(($isrenewal) ? 'renewal-td' : '')."'>".$da->vehicle_age_min." - ".$da->vehicle_age_max."</td>";
                            }
                            else if($da->commission_type == "3")
                            {
                                $content .= "<td class='".(($isrenewal) ? 'renewal-td' : '')."'>".$da->min_val." - ".$da->max_val."</td>";
                            }
                            $content .= "<td class='".(($isrenewal) ? 'renewal-td' : '')."'>".$da->is_ncb."</td>";
                            $content .= "<td class='".(($isrenewal) ? 'renewal-td' : '')."'>".$da->ncb_percentage."</td>";
                            $content .= "<td class='".(($isrenewal) ? 'renewal-td' : '')."'>".$da->on_net."</td>";
                            $content .= "<td class='".(($isrenewal) ? 'renewal-td' : '')."'>".$da->own_od."</td>";
                            $content .= "<td class='".(($isrenewal) ? 'renewal-td' : '')."'>".$da->own_tp."</td>";
                            $content .= "<td><button class='btn btn-default btn-xs' onclick=load_agn_com(".$da->id.")>load>></button></td><td>";
                            // if($da->from_date>date("Y-m-d")){
                                $content .= "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> 
                            ";  
                            
                           // </button>&nbsp;&nbsp;<button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> </button>&nbsp;&nbsp;
                            //}
                            $content .= "<button class='btn btn-warning btn-xs' onclick=forward(".$da->id.")><i class='fa fa-forward'></i></button></td></tr>";
    	           }
    	           
    	            $content .= "</tbody>
    	             </table>";
    	             
    	             echo json_encode(array("content" =>$content,"title" =>$title));
        	   }
       }
       
       public function _view_payout_commission_entry()
       {
           if($this->session->has_userdata('logged_in')) 
        	{
        	    $ins_company = $this->input->post("ins_company");
        	    $p_cover = $this->input->post("p_cover");
        	    $policy_type = $this->input->post("policy_type");
        	    $type = $this->input->post("type");
        	    
        	    $s_f_date = $this->input->post("s_f_date");
        	    $s_to_date = $this->input->post("s_to_date");

        	    $res = $this->pm->view_payout_commission_entry($ins_company,$p_cover,$policy_type,$type,$s_f_date,$s_to_date);
        	    $commission_id = $policytypelist = [];
                if( isset( $res ) && !empty( $res ) ) {
                    // foreach($res as $_r) {
                    //     $commission_id[] = $_r->id;
                    //     $policytypelist[] = $_r->policy_type;
                    // }
                    //$commission_id = array_column($res, 'id');
                    $commission_id = array_map(function($e) {
                        return is_object($e) ? $e->id : $e['id'];
                    }, $res);

                    //$policytypelist = array_column($res, 'policy_type');
                    $policytypelist = array_map(function($e) {
                        return is_object($e) ? $e->policy_type : $e['policy_type'];
                    }, $res);
                    
                    $rtodetails = $this->pm->get_rto_details($commission_id);

                    if(isset( $rtodetails ) && !empty( $rtodetails ) ) {
                        foreach($rtodetails as $_rto) {
                            $rto_details[$_rto->commission_id][] = $_rto;
                        }
                    }

                    if(in_array("1", $policytypelist) || in_array("3", $policytypelist)) {
                        $makes = $this->pm->fetch_make_car_brands($commission_id);
                        $models = $this->pm->fetch_car_model_names($commission_id);
                        $varients = $this->pm->fetch_car_varient_names($commission_id);
                    }
                    else if(in_array("2", $policytypelist)) {
                        $makes = $this->pm->fetch_make_bike_brands($commission_id);
                        $models = $this->pm->fetch_bike_model_names($commission_id);
                        $varients = $this->pm->fetch_bike_varient_names($commission_id);
                    }
                    else if(in_array("4", $policytypelist)) {
                        $makes = $this->pm->fetch_make_e_two_wheeler_brands($commission_id);
                        $models = $this->pm->fetch_e_two_wheeler_model_names($commission_id);
                        $varients = $this->pm->fetch_e_two_wheeler_varient_names($commission_id);
                    }
                    else if(in_array("7", $policytypelist) || in_array("12", $policytypelist) || in_array("13", $policytypelist) || in_array("14", $policytypelist)
                        || in_array("59", $policytypelist) || in_array("60", $policytypelist) || in_array("65", $policytypelist) || in_array("66", $policytypelist)
                        || in_array("69", $policytypelist)
                    ) {
                        $makes = $this->pm->fetch_make_car_brands($commission_id);
                        $models = $this->pm->fetch_car_model_names($commission_id);
                        $varients = $this->pm->fetch_car_varient_names($commission_id);
                    }

                    else if(in_array("8", $policytypelist) || in_array("9", $policytypelist) || in_array("10", $policytypelist) || in_array("15", $policytypelist)
                        || in_array("16", $policytypelist) || in_array("61", $policytypelist)                        
                    ) {
                        $makes = $this->pm->fetch_make_car_brands($commission_id);
                        $models = $this->pm->fetch_car_model_names($commission_id);
                        $varients = $this->pm->fetch_car_varient_names($commission_id);
                    }
                    else if(in_array("20", $policytypelist) ) {
                        $makes = $this->pm->fetch_make_misc_brands($commission_id);
                        $models = $this->pm->fetch_misc_model_names($commission_id);
                        $varients = $this->pm->fetch_misc_varient_names($commission_id);
                    }
                    else if(in_array("55", $policytypelist) ) {
                        $makes = $this->pm->fetch_make_scooter_brands($commission_id);
                        $models = $this->pm->fetch_scooter_model_names($commission_id);
                        $varients = $this->pm->fetch_scooter_varient_names($commission_id);
                    }
                    else if(in_array("18", $policytypelist) ) {
                        $makes = $this->pm->fetch_make_ambulance_brands($commission_id);
                        $models = $this->pm->fetch_ambulance_model_names($commission_id);
                        $varients = $this->pm->fetch_ambulance_varient_names($commission_id);
                    }
                    
                }
        	    
                if(isset( $makes ) && !empty( $makes ) ) {
                    foreach($makes as $_make) {
                        $make[$_make->commission_id][$_make->policy_type][] = $_make;
                    }
                }
                if(isset( $models ) && !empty( $models ) ) {
                    foreach($models as $_model) {
                        $model[$_model->commission_id][$_model->policy_type][] = $_model;
                    }
                }
                if(isset( $varients ) && !empty( $varients ) ) {
                    foreach($varients as $_varient) {
                        $varient[$_varient->commission_id][$_varient->policy_type][] = $_varient;
                    }
                }
                
        	    $content = "<style> .wrap-it{
                                            word-wrap: break-word;
                                            }
                                            *{
                                                font-weight:unset !important;
                                            }
                                            th {
                                                text-align: left;
                                            }
                                            table{
                                                width:100% !important;
                                            }
                                            td{
                                                word-wrap: break-word !important;
                                            }
                                    </style>";

        	       $content .= "<table class='table table-bordered' style='width:100%'>
    	                 <thead>
    	                    <tr>
    	                        <th>S.No</th>
                                <th>Type</th>
                                <th>Date_Period</th>
                                <th>Make</th>
                                <th>Model</th>
                                <th>Varient</th>
                                <th>Fuel</th>
                                <th>Classification</th>
                                <th>Rto</th>
                                <th>V_age</th>
                                <th>NCB</th>
                                <th>NCB(%)</th>
                                <th>On_net</th>
                                <th>OD</th>
                                <th>Tp</th>
                                <th>Agn_Com</th>
                                <th>Action_Record</th>
                            </tr>
    	                 </thead>";
    	           
    	           $a = 0;      
    	                 
    	           foreach($res as $da)
    	           { 
    	               $a++;
    	               
    	                    $title = $da->company_name." / ".$da->p_type." / ".$da->premium_name." / ".$da->type;
    	                    
/* 2023-06-20 by kgk time reduce   	               
    	                   $rto_details = $this->pm->fech_rto_details($da->id);
    	                   
        	               if($da->policy_type == "1" || $da->policy_type == "3")
                            {
                                $make = $this->pm->fetch_make_car_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_car_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_car_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "2")
                            {
                                $make = $this->pm->fetch_make_bike_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_bike_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_bike_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "4")
                            {
                                $make = $this->pm->fetch_make_e_two_wheeler_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_e_two_wheeler_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_e_two_wheeler_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "7" || $da->policy_type == "12" || $da->policy_type == "13" || $da->policy_type == "14" || $da->policy_type == "59" || $da->policy_type == "60" || $da->policy_type == "65" || $da->policy_type == "66" || $da->policy_type == "69" )
                            {
                                $make = $this->pm->fetch_make_pc_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_pc_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_pc_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "8" || $da->policy_type == "9" || $da->policy_type == "10" || $da->policy_type == "15" || $da->policy_type == "16" || $da->policy_type == "61")
                            {
                                $make = $this->pm->fetch_make_gc_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_gc_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_gc_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "20")
                            {
                                 $make = $this->pm->fetch_make_misc_brand($da->id,$da->policy_type);
                                $model = $this->pm->fetch_misc_model_name($da->id,$da->policy_type);
                                $varient = $this->pm->fetch_misc_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "55")
                            {
                                 $make = $this->pm->fetch_make_scooter_brand($da->id,$da->policy_type);
                                 $model = $this->pm->fetch_scooter_model_name($da->id,$da->policy_type);
                                 $varient = $this->pm->fetch_scooter_varient_name($da->id,$da->policy_type);
                            }
                            else if($da->policy_type == "18")
                            {
                                 $make = $this->pm->fetch_make_ambulance_brand($da->id,$da->policy_type);
                                 $model = $this->pm->fetch_ambulance_model_name($da->id,$da->policy_type);
                                 $varient = $this->pm->fetch_ambulance_varient_name($da->id,$da->policy_type);
                            }
*/                            
        	                $content .= "<tbody>
                            <tr>
                                <td>".$a."</td>
                                <td>".$da->type."</td>
                                <td>".date_format(date_create($da->from_date),"d-m")." - ".date_format(date_create($da->to_date),"d-m")."</td>";
                                
                                if($da->v_make != "all")
                                {
                                    $content .= " <td>";
                                    $i = 0;
                                    
                                    /* 2023-06-20 by kgk time reduce   	
                                    foreach($make as $br)
                                    {
                                        $i++;
                                        
                                        if($i < 3)
                                        {
                                             $content .= $br->brand_name.",";
                                        }
                                        else if($i > 3)
                                        {
                                          $content .="...<button class='btn btn-default btn-xs' onclick=load_brand(".$da->id.")>load more >></button>";
                                          break;
                                        }
                                    }
                                    */
                                    
                                    if(isset($make[$da->id][$da->policy_type]) && !empty($make[$da->id][$da->policy_type])) {
                                        foreach($make[$da->id][$da->policy_type] as $br)
                                        {
                                            $i++;
                                            
                                            if($i < 3)
                                            {
                                                 $content .= $br->brand_name.",";
                                            }
                                            else if($i > 3)
                                            {
                                              $content .="...<button class='btn btn-default btn-xs' onclick=load_brand(".$da->id.")>load more >></button>";
                                              break;
                                            }
                                        }
                                    }
                                    
                                    $content .= " </td>";
                                }
                                else
                                {
                                    $content .= " <td>".$da->v_make."</td>";
                                }
                                
                                if($da->v_model != "all")
                                {
                                    $content .= " <td>";
                                    
                                    $j = 0;
                                    
                                    /* 2023-06-20 by kgk time reduce   	
                                    if( isset($model) && !empty($model)){
                                        foreach($model as $mod)
                                        {
                                            $j++;
                                            
                                            if($j < 3)
                                            {
                                                $content .= $mod->model_name.",";
                                            }
                                            else if($j > 3)
                                            {
                                                $content .="...<button class='btn btn-default btn-xs' onclick=load_model(".$da->id.")>load more >></button>";
                                                break;
                                            }
                                        }
                                    }
                                    */
                                    
                                    if( isset($model[$da->id][$da->policy_type]) && !empty($model[$da->id][$da->policy_type])){
                                        foreach($model[$da->id][$da->policy_type] as $mod)
                                        {
                                            $j++;
                                            
                                            if($j < 3)
                                            {
                                                $content .= $mod->model_name.",";
                                            }
                                            else if($j > 3)
                                            {
                                                $content .="...<button class='btn btn-default btn-xs' onclick=load_model(".$da->id.")>load more >></button>";
                                                break;
                                            }
                                        }
                                    }
                                    $content .= " </td>";
                                }
                                else
                                {
                                   $content .= " <td>".$da->v_model."</td>";
                                }
                                
                                $k = 0;
                                
                                if($da->v_varient != "all")
                                {
                                    $content .= " <td>";
                                    /* 2023-06-20 by kgk time reduce   	
                                    foreach($varient as $var)
                                    {
                                        $k++; 
                                        if($k < 3)
                                        {
                                            $content .= $var->varient_name.",";
                                             
                                        }
                                        else if($k > 3)
                                        {
                                              $content .="...<button class='btn btn-default btn-xs' onclick=load_varient(".$da->id.")>load more >></button>";
                                               break;
                                        }
                                   }
                                    */
                                    
                                    if(isset($varient[$da->id][$da->policy_type]) && !empty($varient[$da->id][$da->policy_type])) {
                                        foreach($varient[$da->id][$da->policy_type] as $var)
                                        {
                                            $k++; 
                                            if($k < 3)
                                            {
                                                $content .= $var->varient_name.",";
                                                 
                                            }
                                            else if($k > 3)
                                            {
                                                  $content .="...<button class='btn btn-default btn-xs' onclick=load_varient(".$da->id.")>load more >></button>";
                                                   break;
                                            }
                                        }
                                    }
                                    $content .= " </td>";
                                }
                                else
                                {
                                   $content .= " <td>".$da->v_varient."</td>";
                                }
                                $content .= "<td>".$da->fuel_type."</td>";
                                $l = 0;

                                $content .= "<td>".$da->from_gvw_cc."".$da->classification." - ".$da->to_gvw_cc."".$da->classification."</td>";
                                $content .= "<td>"; 
                                
                                /* 2023-06-20 by kgk time reduce   	
                                foreach($rto_details as $rto)
                                {
                                    $l++;
                                    
                                    if($l < 3)
                                    {
                                        $content .= $rto->rto.",";
                                        
                                    }
                                    else if($l > 3)
                                     {
                                          $content .="...<button class='btn btn-default btn-xs' onclick=load_rto(".$da->id.")>load more >></button>";
                                          break;
                                     }
                               }
                                */
                                
                                if(isset($rto_details[$da->id]) && !empty($rto_details[$da->id])) {
                                    foreach($rto_details[$da->id] as $rto)
                                    {
                                        $l++;
                                        
                                        if($l < 3)
                                        {
                                            $content .= $rto->rto.",";
                                            
                                        }
                                        else if($l > 3)
                                         {
                                              $content .="...<button class='btn btn-default btn-xs' onclick=load_rto(".$da->id.")>load more >></button>";
                                              break;
                                         }
                                    }
                                }
                                
                            $content .= " </td>";
                            
                            if($da->commission_type == "1")
                            {
                               $content .= "<td>".$da->no_policy_min." - ".$da->no_policy_max."</td>";
                            }
                            else if($da->commission_type == "2")
                            {
                                $content .= "<td>".$da->vehicle_age_min." - ".$da->vehicle_age_max."</td>";
                            }
                            else if($da->commission_type == "3")
                            {
                                $content .= "<td>".$da->min_val." - ".$da->max_val."</td>";
                            }
                            $content .= "<td>".$da->is_ncb."</td>";
                            $content .= "<td>".$da->ncb_percentage."</td>";
                            $content .= "<td>".$da->on_net."</td>";
                            $content .= "<td>".$da->own_od."</td>";
                            $content .= "<td>".$da->own_tp."</td>";
                            $content .= "<td><button class='btn btn-default btn-xs' onclick=load_agn_com(".$da->id.")>load>></button></td><td>";
                            // if($da->from_date>date("Y-m-d")){
                                $content .= "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> 
                            ";  
                            
                           // </button>&nbsp;&nbsp;<button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> </button>&nbsp;&nbsp;
                            //}
                            $content .= "<button class='btn btn-warning btn-xs' onclick=forward(".$da->id.")><i class='fa fa-forward'></i></button></td></tr>";
    	           }
    	           
    	            $content .= "</tbody>
    	             </table>";
    	             
    	             echo json_encode(array("content" =>$content,"title" =>$title));
        	   }
       }
       
       public function edit_commission_entry_motor()
       {
            if($this->session->has_userdata('logged_in')) 
            { 
                $id = $this->input->post("id");
                $res = $this->pm->edit_commission_entry($id);
                
                        $select_make_arr = $this->pm->fetch_commission_make_log($res->id,$res->policy_type);
                        
                        $select_make = array();
                        
                        foreach($select_make_arr as $sma)
                        {
                           $select_make[] = $sma->make;
                        }
                        
                        $select_model_arr = $this->pm->fetch_commission_model_log($res->id,$res->policy_type);
                        
                        $select_model = array();
                        
                        foreach($select_model_arr as $sma)
                        {
                           $select_model[] = $sma->model_id;
                        }
                        
                        $select_varient_arr = $this->pm->fetch_commission_varient_log($res->id,$res->policy_type);
                        
                        $select_varient = array();
                        
                        foreach($select_varient_arr as $sma)
                        {
                        $select_varient[] = $sma->varient_id;
                        }
                        
                        $vechile_type = $res->policy_type;
                        
                        $make_list = array();
                        
                        if($vechile_type == "1" || $vechile_type == "3")
                        {
                           $make_list = $this->pm->fetch_make_car();
                        }
                        else if($vechile_type == "2")
                        {
                            $make_list = $this->pm->fetch_make_bike();
                        }
                        else if($vechile_type == "4")
                        {
                            $make_list = $this->pm->fetch_make_e_two_wheeler();
                        }
                        else if($vechile_type == "7" || $vechile_type == "12" || $vechile_type == "13" || $vechile_type == "14" || $vechile_type == "59" || $vechile_type == "60" || $vechile_type == "65" || $vechile_type == "66" || $vechile_type == "69")
                        {
                            $make_list = $this->pm->fetch_make_pc($vechile_type);
                        }
                        else if($vechile_type == "8" || $vechile_type == "9" || $vechile_type == "10" || $vechile_type == "15" || $vechile_type == "16" || $vechile_type == "61")
                        {
                            $make_list = $this->pm->fetch_make_gc($vechile_type);
                        }
                        else if($vechile_type == "20")
                        {
                           $make_list = $this->pm->fetch_make_misc();
                        }
                        else if($vechile_type == "55")
                        {
                           $make_list = $this->pm->fetch_make_scooter();
                        }
                        if($select_make != null)
                        {
                        $vechi_make = $select_make;
                        }
                        else
                        {
                        $vechi_make = array("all");
                        }
                        
                        $model_list = array();
                        
                        if($vechile_type == "1" || $vechile_type == "3")
                        {
                            $model_list = $this->pm->fetch_car_model($vechi_make);
                        }
                        else if($vechile_type == "2")
                        {
                            $model_list = $this->pm->fetch_bike_model($vechi_make);
                        }
                        else if($vechile_type == "4")
                        {
                            $model_list = $this->pm->fetch_e_two_wheeler_model($vechi_make);
                        }
                        else if($vechile_type == "7" || $vechile_type == "12" || $vechile_type == "13" || $vechile_type == "14" || $vechile_type == "59" || $vechile_type == "60" || $vechile_type == "65" || $vechile_type == "66")
                        {
                           $model_list = $this->pm->fetch_pc_model($vechile_type,$vechi_make);
                        }
                        else if($vechile_type == "8" || $vechile_type == "9" || $vechile_type == "10" || $vechile_type == "15" || $vechile_type == "16" || $vechile_type == "61")
                        {
                            $model_list = $this->pm->fetch_gc_model($vechile_type,$vechi_make);
                        }
                        else if($vechile_type == "20")
                        {
                            $model_list = $this->pm->fetch_misc_model($vechi_make);
                        }
                        else if($vechile_type == "55")
                        {
                            $model_list = $this->pm->fetch_scooter_model($vechi_make);
                        }
                        
                        $varient_list = array();
                        
                        if($select_model != null)
                        {
                           $vechi_model = $select_model;
                        }
                        else
                        {
                           $vechi_model = array("all");
                        }
                        if($vechile_type == "1" || $vechile_type == "3")
                        {
                           $varient_list = $this->pm->fetch_car_varient($vechi_make,$vechi_model);
                        }
                        else if($vechile_type == "2")
                        {
                           $varient_list = $this->pm->fetch_bike_varient($vechi_make,$vechi_model);
                        }
                        
                        else if($vechile_type == "4")
                        {
                        $varient_list = $this->pm->fetch_e_two_wheeler_varient($vechi_make,$vechi_model);
                        }
                        
                        if($vechile_type == "7" || $vechile_type == "12" || $vechile_type == "13" || $vechile_type == "14" || $vechile_type == "59" || $vechile_type == "60" || $vechile_type == "65" || $vechile_type == "66")
                        {
                        $varient_list = $this->pm->fetch_pc_varient($vechile_type,$vechi_make,$vechi_model);
                        }
                        else if($vechile_type == "8" || $vechile_type == "9" || $vechile_type == "10" || $vechile_type == "15" || $vechile_type == "16" || $vechile_type == "61")
                        {
                        $varient_list = $this->pm->fetch_gc_varient($vechile_type,$vechi_make,$vechi_model);
                        }
                        
                        else if($vechile_type == "20")
                        {
                        $varient_list = $this->pm->fetch_misc_varient($vechi_make,$vechi_model);
                        }
                        
                        else if($vechile_type == "55")
                        {
                        $varient_list = $this->pm->fetch_scooter_varient($vechi_make,$vechi_model);
                        }
                        
                        $classification_arr = $this->pm->fetch_classification($res->policy_type);
                        
                        $classification_content = "<option value=''>--select--</option>";
                        
                        foreach($classification_arr as $da)
                        {
                        $classification_content .="<option value='".$da->id."'>".$da->from_gvw_cc.$da->classification." - ".$da->to_gvw_cc.$da->classification."</option>";
                        }
                        
                        $select_rto_arr = $this->pm->fetch_select_rto_using_commission_id($res->id);
                        
                        $select_rto = array();
                        
                        foreach($select_rto_arr as $sra)
                        {
                        $select_rto[] = $sra->rto;
                        }
                        
                        $select_agent_arr = $this->pm->fetch_select_agent_using_commission_id($res->id);
                        
                        $special_com = "";
                        
                        $select_agent = array();
                        
                        foreach($select_agent_arr as $sag)
                        {
                        $select_agent[] = $sag->agent_id;
                        $special_com = $sag->special_com;
                        }
                        
                        $data = array("res" => $res,"class"=>$res->class, "make_list" => $make_list, "model_list" => $model_list, "varient_list" => $varient_list, "select_make" => $select_make, "select_model" => $select_model, "select_varient" => $select_varient, "classification_content" => $classification_content, "select_rto" => $select_rto,  "select_agent" =>$select_agent, "special_com" =>$special_com);
                        
                        echo json_encode($data);
            }
        }
        
        public function test()
        {
                $check =$this->pm->check_this_com_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type);
                
                $ins_rto_1 = []; 
                
                $commission_id = [];
                
                foreach($check as $da)
                {
                    $commission_id[] = $da->id;
                }
                
                $rto_status = '0';
                
                if($rto_category == "ROTN_Exclude")
                {
                   $get_rto = $this->pm->get_rto($ins_rto);
                   
                    foreach($get_rto as $da)
                    {
                       $ins_rto_1[] = $da->rto_no;
                    }
                
                   $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                
                    if(count(count($check_rto) > 0))
                    {
                        $rto_status = "1";
                        
                          foreach($check_rto as $da)
                          {
                             $commission_id = [];
                            $commission_id[] = $da->commission_id;
                          }    
                       
                    }
                }
                else
                {
                    if(in_array('chennai',$ins_rto) || in_array('Coimbatore',$ins_rto) || in_array('Madurai',$ins_rto))
                    {
                       $city_rto = $this->pm->get_city_rto($ins_rto);
                       
                      for($i=0;$i<=count($ins_rto);$i++)
                        {
                                  if(in_array("chennai",$ins_rto))
                                  {
                                        unset($ins_rto[$i]);
                                  }
                                  else if(in_array("Coimbatore",$ins_rto))
                                  {
                                      unset($ins_rto[$i]);
                                  }
                                  else if(in_array("Madurai",$ins_rto))
                                  {
                                      unset($ins_rto[$i]);
                                  }
                           }
                           
                         $get_rto = $this->pm->get_rto_no($ins_rto);
                    
                       foreach($city_rto as $da)
                       {
                           $ins_rto_1[] = $da->rto_no;
                       }
                       
                       foreach($get_rto as $da)
                       {
                            $ins_rto_1[] = $da->rto_no;
                       }
                       
                       $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                      
                        if(count($check_rto) > 0)
                        {
                            $rto_status = "1";
                            foreach($check_rto as $da)
                              {
                                 $commission_id = [];
                                $commission_id[] = $da->commission_id;
                              }
                        }
                    }
                    else if(in_array("ROTN",$ins_rto))
                    {
                       $get_rotn_rto = $this->pm->get_rotn_rto();
                       
                       foreach($get_rotn_rto as $da)
                       {
                            $ins_rto_1[] = $da->rto_no;
                       }
                       $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                       
                        if(count($check_rto) > 0)
                        {
                            $rto_status = "1";
                            
                              foreach($check_rto as $da)
                              {
                                 $commission_id = [];
                                $commission_id[] = $da->commission_id;
                              }
                        }
                    }
                    else if(in_array("All TN",$ins_rto))
                    {
                        $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                        
                           foreach($get_all_tn_rto as $da)
                           {
                                $ins_rto_1[] = $da->rto_no;
                           }
                        $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                        
                        if(count($check_rto) > 0)
                        {
                            $rto_status = "1";
                            
                            foreach($check_rto as $da)
                            {
                                 $commission_id = [];
                                $commission_id[] = $da->commission_id;
                            }
                        }
                    }
                    else if(in_array("All RTO",$ins_rto))
                    {
                       $get_all_rto = $this->pm->get_all_rto_list();
                       
                       foreach($get_all_rto as $da)
                       {
                              $ins_rto_1[] = $da->rto_no;
                       }
                       
                        $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                        
                        if(count($check_rto) > 0)
                        {
                            $rto_status = "1";
                            foreach($check_rto as $da)
                            {
                                $commission_id = [];
                                $commission_id[] = $da->commission_id;
                            }
                        }
                    }
                    else
                    {
                        $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto);
                        
                        if(count($check_rto) > 0)
                        {
                            $rto_status = "1";
                            
                            foreach($check_rto as $da)
                            {
                                 $commission_id = [];
                                $commission_id[] = $da->commission_id;
                            }
                        }
                    }
                }
                
                if($rto_status == "0")
                {
                    $last_policy_id = $this->pm->get_last_policy_id();
                    if($last_policy_id == "")
                    {
                            $com_policy_id = "1";
                            $arr = array("policy_id" => $com_policy_id);
                            $insert = $this->pm->add_policy_id($arr);
                            if( $insert ) {
                                $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                            }
                    }
                    else
                    {
                        $max_policy_id = $last_policy_id->policy_id;
                        $com_policy_id = $max_policy_id+1;
                        $arr = array("policy_id" => $com_policy_id);
                        $insert = $this->pm->add_policy_id($arr);
                        if( $insert ) {
                            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                        }
                    }
                    echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                }
                else if($rto_status == "1")
                {
                    $check_make = $this->pm->check_this_com_already_exits_by_commission_id($commission_id,$policy_type);
                    
                    if(count($check_make) > 0)
                    {
                        $commission_id = [];
                        
                        foreach($check_make as $da)
                        {
                             $commission_id[] = $da->id;
                        }
                        
                        $status = "1";
                        $make_status = "1";
                    }
                    else
                    {
                         $check_make_1 = $this->pm->check_make_already_exits($commission_id,$policy_type,$make);
                            
                            if(count($check_make_1) > 0)
                            {
                                $commission_id = [];
                                
                                foreach($check_make as $da)
                                {
                                     $commission_id[] = $da->commission_id;
                                }
                        
                                $status = "1";
                                $make_status = "1";
                            }
                            else
                            {
                                $make_status = "0";
                            }
                }
                    
                    if($make_status == "1")
                    {
                        $check_model = $this->pm->check_model_all_already_exits($commission_id,$policy_type);
                        
                        if(count($check_model) > 0)
                        {
                                $commission_id = [];
                                foreach($check_make as $da)
                                {
                                     $commission_id[] = $da->id;
                                }
                             $status = "1";
                             $model_status = "1";
                        }
                        else
                        {
                            $check_model_1 = $this->pm->check_model_already_exits($commission_id,$policy_type,$make,$model);
                            
                            if(count($check_model_1) > 0)
                            {
                                    $commission_id = [];
                                    foreach($check_make as $da)
                                    {
                                         $commission_id[] = $da->commission_id;
                                    }
                                 $status = "1";
                                 $model_status = "1";
                            }
                            else
                            {
                                $model_status = "0";
                            }
                        }
                    }
                    
                    if($make_status == "1" && $model_status == "1")
                    {
                       $check_varient = $this->pm->check_varient_all_already_exits($commission_id,$policy_type);
                      
                        if(count($check_varient) > 0)
                        {
                            $commission_id = [];
                            foreach($check_make as $da)
                            {
                                 $commission_id[] = $da->id;
                            }
                             $status = "1";
                             $varient_status = "1";
                        }
                        else 
                        {
                          $check_varient_1 = $this->pm->check_varient_already_exits($commission_id,$policy_type,$make,$model,$varient);
                           
                            if(count($check_varient_1) > 0)
                            {
                                $commission_id = [];
                                foreach($check_make as $da)
                                {
                                     $commission_id[] = $da->commission_id;
                                }
                                 $status = "1";
                                 $varient_status = "1";
                            }
                            else
                            {
                                 $varient_status = "0";
                            }
                        }
                    }
                    
                    if($ins_classification != "")
                    {
                       $classification = $this->pm->get_classification($commission_id,$ins_classification,$policy_type);
                    
                        if(count($classification > 0))
                        {
                           $commission_id = [];
                           
                           foreach($classification as $da)
                           {
                               $commission_id[] = $da->id;
                           }
                           
                           $gvw_status = "1";
                        }
                    }
                    else
                    {
                       $commission_id = [];
                       $gvw_status = "1";
                    }
                 
                 $check =$this->pm->check_this_com_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type,$commission_id);
                 
                 if(count($check) > 0)
                 {
                       foreach($check as $da)
                	   {
                	            $g_status = "0";
                	            $fuel_status = "0";
                	            
                                $temp_min = $da->no_policy_min;
                				$temp_max = $da->no_policy_max;
                				
                				if($temp_min <= $no_policy_min && $temp_max >= $no_policy_min)
                				{
                					$g_status = "1";
                				}
                				if($temp_min <= $no_policy_max && $temp_max >= $no_policy_max)
                				{
                					$g_status = "1";
                				}
                				if($temp_min > $no_policy_min && $temp_max < $no_policy_max)
                				{
                					$g_status = "1";
                				}
                
                                if($fuel_type == "1")
                                {
                                	if($da->fuel_type == "4" || $da->fuel_type == "1")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                                if($fuel_type == "2")
                                {
                                    if($da->fuel_type == "5" || $da->fuel_type == "2")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                                if($fuel_type == "5")
                                {
                                    if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                                if($fuel_type == "6")
                                {
                                    if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                                if($fuel_type == "7")
                                {
                                    if($da->fuel_type == "7")
                                	{
                                	    $fuel_status = "1";
                                	}
                                }
                    			
                    			if($g_status == "1" && $fuel_status == "1")
                        	    {
                        			 echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                        			 break;
                        		}
                        		else if($g_status == "0" && $fuel_status == "1")
                        		{
                        		    $get_nop_id = $this->pm->get_no_of_policy_id($da->id);
                        		    
                                    if($get_nop_id != "")
                                    {
                                        echo json_encode(array("status"=>"success","no_of_policy_id"=>$get_nop_id->no_of_policy_id));
                                        break;
                                    }
                        		}
                        }
                 }
                 else
                 {
                    $last_policy_id = $this->pm->get_last_policy_id();
                    
                    if($last_policy_id == "")
                    {
                            $com_policy_id = "1";
                            $arr = array("policy_id" => $com_policy_id);
                            $insert = $this->pm->add_policy_id($arr);
                            if( $insert ) {
                                $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                            }
                    }
                    else
                    {
                        $max_policy_id = $last_policy_id->policy_id;
                        $com_policy_id = $max_policy_id+1;
                        $arr = array("policy_id" => $com_policy_id);
                        $insert = $this->pm->add_policy_id($arr);
                        if( $insert ) {
                            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                        }
                    }
                    echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                 }
                }
            }
            
        public function check_payout_entry()
        {
            if($this->session->has_userdata('logged_in'))
    	    {
    	         $insurer_company = $this->input->post("insurer_company");
                 $insurer_class = $this->input->post("insurer_class");
                 $business_type = $this->input->post("business_type");
                 $premium_c_type = $this->input->post("premium_c_type");
                 $policy_type = $this->input->post("policy_type");
                 $commission_type = $this->input->post("commission_type");
                 $add_type = $this->input->post("add_type");
                 $v_type = "";
                 
                 $make    = explode(",", $this->input->post("make") ?? '');
                $model   = explode(",", $this->input->post("model") ?? '');
                $varient = explode(",", $this->input->post("varient") ?? '');
    
                 
                 $fuel_type = $this->input->post("fuel_type");
                 $ins_classification = $this->input->post("ins_classification");
                 $ins_state = $this->input->post("ins_state");
                 $ins_rto = explode(",", $this->input->post("ins_rto") ?? '');
                 $rto_category = $this->input->post("rto_category");
                 $vehicle_age_min = $this->input->post("vehicle_age_min");
                 $vehicle_age_max = $this->input->post("vehicle_age_max");
                

                // nop
                $no_policy_min = $this->input->post("no_policy_min");
                $no_policy_max = $this->input->post("no_policy_max");
                
                // target amount
                $min_amount = $this->input->post("min_amount");
                $max_amount = $this->input->post("max_amount");
                
                $f_date = $this->input->post("f_date");
                $to_date = $this->input->post("to_date");
                
                // start 2023-08-17
                $payout_type = $this->input->post("payout_type"); 
               
                 $commission_id = [];
                 
                 $g_status = "0";
                 
                 $status = "0";
                 $make_status = "0";
                 $model_status = "0";
                 $varient_status = "0";
                 $rto_status = "0";
                 $fuel_status = "0";
                 $gvw_status = "0";
                 $nop_status = "0";
                 $fuel_type_status = "0";
                 $com_policy_id = "";
                 $net_status = "0";
           
               if($insurer_class == "1")  
               {
                     if($commission_type == "2")
                     {
                            $check = $this->pm->check_vechi_age_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type, $payout_type);
        	           
                    	    foreach($check as $da)
                    		{
                        		    $temp_min = $da->vehicle_age_min;
                        		    $temp_max = $da->vehicle_age_max;
                        		    
                        		    $g_status = "0";
                        		    
                    		        $fuel_status = "0";
                        		    
                        		    if($temp_min <= $vehicle_age_min && $temp_max >= $vehicle_age_min)
                    				{
                    					$g_status = "1";
                    				}
                    				if($temp_min <= $vehicle_age_max && $temp_max >= $vehicle_age_max)
                    				{
                    					$g_status = "1";
                    				}
                    				if($temp_min > $vehicle_age_min && $temp_max < $vehicle_age_max)
                    				{
                    					$g_status = "1";
                    				}
                    				
                            		    if($fuel_type == "1")
                            		    {
                            				if($da->fuel_type == "4" || $da->fuel_type == "1" || $da->fuel_type == "6")
                            				{
                            				    $fuel_status = "1";
                            				}
                            			}

                            			
                            			if($fuel_type == "2")
                            			{
                            			    if($da->fuel_type == "5" || $da->fuel_type == "2")
                            				{
                            				    $fuel_status = "1";
                            				}
                            			}
                            			if($fuel_type == "5")
                            			{
                            			    if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2")
                            				{
                            				    $fuel_status = "1";
                            				}
                            			}
                            			if($fuel_type == "6")
                            			{
                            			    if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                            				{
                            				    $fuel_status = "1";
                            				}
                            			}
                            			if($fuel_type == "7")
                            			{
                            			    if($da->fuel_type == "7")
                            				{
                            				    $fuel_status = "1";
                            				}
                            			}

                            			if($g_status == "1" && $fuel_status == "1")
                            			{
                            			    $commission_id[] = $da->id;
                            			    $status = "1";
                    	                    $fuel_type_status = "1";
                            			}
                    		      }
                    		      
                            if($status == "1")
                            {
                                if($ins_classification != "")
                                {
                                   $classification = $this->pm->get_classification(array_unique($commission_id),$ins_classification,$policy_type);
                                
                                    if (count($classification) > 0)
                                    {
                                       $commission_id = [];
                                       
                                       foreach($classification as $da)
                                       {
                                           $commission_id[] = $da->id;
                                       }
                                       
                                       $gvw_status = "1";
                                    }
                                }
                                else
                                {
                                   $gvw_status = "1";
                                }
                                
                                $check_make = $this->pm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                
                                if(count($check_make) > 0)
                                {
                                    $commission_id = [];
                                    
                                    foreach($check_make as $da)
                                    {
                                         $commission_id[] = $da->id;
                                    }
                                    
                                    $status = "1";
                                    $make_status = "1";
                                }
                                else
                                {
                                     $check_make_1 = $this->pm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                        
                                        if(count($check_make_1) > 0)
                                        {
                                            $commission_id = [];
                                            
                                            foreach($check_make_1 as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                                    
                                            $status = "1";
                                            $make_status = "1";
                                        }
                                        else
                                        {
                                            $make_status = "0";
                                        }
                                }
                                    
                                if($make_status == "1")
                                {
                                    $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                                    
                                    if(count($check_model) > 0)
                                    {
                                            $commission_id = [];
                                            foreach($check_model as $da)
                                            {
                                                 $commission_id[] = $da->id;
                                            }
                                         $status = "1";
                                         $model_status = "1";
                                    }
                                    else
                                    {
                                        $check_model_1 = $this->pm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                        
                                        if(count($check_model_1) > 0)
                                        {
                                                $commission_id = [];
                                                
                                                foreach($check_model_1 as $da)
                                                {
                                                     $commission_id[] = $da->commission_id;
                                                }
                                             $status = "1";
                                             $model_status = "1";
                                        }
                                        else
                                        {
                                            $model_status = "0";
                                        }
                                    }
                                }
                                
                                if($make_status == "1" && $model_status == "1")
                                {
                                    $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                                  
                                    if(count($check_varient) > 0)
                                    {
                                        $commission_id = [];
                                        
                                        foreach($check_varient as $da)
                                        {
                                             $commission_id[] = $da->id;
                                        }
                                         $status = "1";
                            	         $varient_status = "1";
                                    }
                                    else 
                                    {
                                      $check_varient_1 = $this->pm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$varient);
                        	           
                        	            if(count($check_varient_1) > 0)
                        	            {
                            	            $commission_id = [];
                                            foreach($check_varient_1 as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                        	                 $status = "1";
                        	                 $varient_status = "1";
                        	            }
                        	            else
                        	            {
                        	                 $varient_status = "0";
                        	            }
                                    }
                                }
                                
                                 $ins_rto_1 = []; 
                    
                                if($status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                {
                                      if($rto_category == "ROTN_Exclude")
                                      {
                                          $get_rto = $this->pm->get_rto($ins_rto);
                                          
                                          foreach($get_rto as $da)
                                          {
                                               $ins_rto_1[] = $da->rto_no;
                                          }
                                          
                                           $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                          
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                                echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                            }
                                            else
                                            {
                                                echo json_encode(array("status"=>"success"));
                                            }
                                      }
                                      else if($rto_category == "KA_Exclude")
                                      {
                                          $get_rto = $this->pm->get_rto_ka($ins_rto);
                                          
                                          foreach($get_rto as $da)
                                          {
                                               $ins_rto_1[] = $da->rto_no;
                                          }
                                          
                                           $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                          
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                                echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                            }
                                            else
                                            {
                                                echo json_encode(array("status"=>"success"));
                                            }
                                      }
                                      else
                                      {
                                           if(in_array('chennai',$ins_rto) || in_array('Coimbatore',$ins_rto) || in_array('Madurai',$ins_rto))
                                           {
                                               $city_rto = $this->pm->get_city_rto($ins_rto);
                                               
                                              for($i=0;$i<=count($ins_rto);$i++)
                                          	  {
                                          	            if(in_array("chennai",$ins_rto))
                                          	            {
                                          	                  unset($ins_rto[$i]);
                                          	            }
                                          	            else if(in_array("Coimbatore",$ins_rto))
                                          	            {
                                          	                unset($ins_rto[$i]);
                                          	            }
                                          	            else if(in_array("Madurai",$ins_rto))
                                          	            {
                                          	                unset($ins_rto[$i]);
                                          	            }
                                          	     }
                                          	     
                                          	   $get_rto = $this->pm->get_rto_no($ins_rto);
                                            
                                               foreach($city_rto as $da)
                                               {
                                                   $ins_rto_1[] = $da->rto_no;
                                               }
                                             
                                              if($get_rto != null)
                                              {
                                                   foreach($get_rto as $da)
                                                   {
                                                        $ins_rto_1[] = $da->rto_no;
                                                   }
                                              }
                                              
                                               $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                              
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status = "1";
                                                    echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                }
                                                else
                                                {
                                                    echo json_encode(array("status"=>"success"));
                                                }
                                           }
                                           else if(in_array("ROTN",$ins_rto))
                                           {
                                               $get_rotn_rto = $this->pm->get_rotn_rto();
                                               
                                               foreach($get_rotn_rto as $da)
                                               {
                                                    $ins_rto_1[] = $da->rto_no;
                                               }
                                               
                                               $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                               
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status = "1";
                                                    echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                }
                                                else
                                                {
                                                    echo json_encode(array("status"=>"success"));
                                                }
                                           }
                                           else if(in_array("All TN",$ins_rto))
                                           {
                                                $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                                                
                                                   foreach($get_all_tn_rto as $da)
                                                   {
                                                        $ins_rto_1[] = $da->rto_no;
                                                   }
                                                $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                                
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status = "1";
                                                    echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                }
                                                else
                                                {
                                                    echo json_encode(array("status"=>"success"));
                                                }
                                           }
                                           else if(in_array("All KA",$ins_rto))
                                           {
                                                $get_all_tn_rto = $this->pm->get_all_ka_rto_list();
                                                
                                                   foreach($get_all_tn_rto as $da)
                                                   {
                                                        $ins_rto_1[] = $da->rto_no;
                                                   }
                                                $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                                
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status = "1";
                                                    echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                }
                                                else
                                                {
                                                    echo json_encode(array("status"=>"success"));
                                                }
                                           }
                                           else if(in_array("All RTO",$ins_rto))
                                           {
                                               $get_all_rto = $this->pm->get_all_rto_list();
                                               
                                               foreach($get_all_rto as $da)
                                               {
                                                      $ins_rto_1[] = $da->rto_no;
                                               }
                                               
                                                $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                                
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status = "1";
                                                    echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                }
                                                else
                                                {
                                                    echo json_encode(array("status"=>"success"));
                                                }
                                           }
                                           else if(in_array('Bangalore',$ins_rto))
                                           {
                                              $city_rto = $this->pm->get_ka_city_rto($ins_rto);
                                              
                                              for($i=0;$i<=count($ins_rto);$i++)
                                              {
                                      	            if(in_array("Bangalore",$ins_rto))
                                      	            {
                                      	                  unset($ins_rto[$i]);
                                      	            }
                                              	}
                                              	     
                                                $get_rto = $this->pm->get_rto_no($ins_rto);
                                                
                                                foreach($city_rto as $da)
                                                {
                                                    $ins_rto_1[] = $da->rto_no;
                                                }
                                                
                                                if($get_rto != null)
                                                {
                                                    foreach($get_rto as $da)
                                                    {
                                                        $ins_rto_1[] = $da->rto_no;
                                                    }
                                                }
                                                  
                                                   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                                  
                                                    if(count($check_rto) > 0)
                                                    {
                                                        $rto_status = "1";
                                                        echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                    }
                                                    else
                                                    {
                                                        echo json_encode(array("status"=>"success"));
                                                    }
                                          }
                                           else
                                           {
                                                $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto);
                                                
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status = "1";
                                                    echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                }
                                                else
                                                {
                                                   echo json_encode(array("status"=>"success"));
                                                }
                                            }
                                      }
                                }
                                else
                                {
                                    echo json_encode(array("status"=>"success"));
                                }
                            }
                            else
                            {
                               echo json_encode(array("status"=>"success"));
                            }
                      }
                     else if($commission_type == "1")
                     {
                            $check =$this->pm->check_this_com_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type);
                           
                            $ins_rto_1 = []; 
                            
                            $commission_id = [];
                            
                            foreach($check as $da)
                            {
                                $commission_id[] = $da->id;
                            }

                            if($rto_category == "ROTN_Exclude")
                            {
                               $get_rto = $this->pm->get_rto($ins_rto);
                               
                                foreach($get_rto as $da)
                                {
                                   $ins_rto_1[] = $da->rto_no;
                                }
                            
                               $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                
                                if(count($check_rto) > 0)
                                {
                                    $rto_status = "1";
                                    
                                    $commission_id = [];
                                    
                                      foreach($check_rto as $da)
                                      {
                                          $commission_id[] = $da->commission_id;
                                      }    
                                   
                                }
                                 
                            
                            }
                            else if($rto_category == "KA_Exclude")
                            {
                                  $get_rto = $this->pm->get_rto_ka($ins_rto);
                                  
                                  foreach($get_rto as $da)
                                  {
                                       $ins_rto_1[] = $da->rto_no;
                                  }
                                  
                                   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                  
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                    }
                                    else
                                    {
                                        echo json_encode(array("status"=>"success"));
                                    }
                              }
                            else
                            {
                                if(in_array('chennai',$ins_rto) || in_array('Coimbatore',$ins_rto) || in_array('Madurai',$ins_rto))
                                {
                                   $city_rto = $this->pm->get_city_rto($ins_rto);
                                   
                                  for($i=0;$i<=count($ins_rto);$i++)
                                  {
                                              if(in_array("chennai",$ins_rto))
                                              {
                                                    unset($ins_rto[$i]);
                                              }
                                              else if(in_array("Coimbatore",$ins_rto))
                                              {
                                                  unset($ins_rto[$i]);
                                              }
                                              else if(in_array("Madurai",$ins_rto))
                                              {
                                                  unset($ins_rto[$i]);
                                              }
                                       }
                                       
                                  $get_rto = $this->pm->get_rto_no($ins_rto);
                                
                                   foreach($city_rto as $da)
                                   {
                                       $ins_rto_1[] = $da->rto_no;
                                   }
                                
                                  if($get_rto != null || $get_rto != "")
                                  {
                                       foreach($get_rto as $da)
                                       {
                                            $ins_rto_1[] = $da->rto_no;
                                       }
                                    }
                                   
                                   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                  
                                    if(count($check_rto) > 0)
                                    {
                                         $rto_status = "1";
                                         
                                         $commission_id = [];
                                        
                                          foreach($check_rto as $da)
                                          {
                                             $commission_id[] = $da->commission_id;
                                          }
                                    }
                                }
                                else if(in_array("ROTN",$ins_rto))
                                {
                                   $get_rotn_rto = $this->pm->get_rotn_rto();
                                   
                                   foreach($get_rotn_rto as $da)
                                   {
                                        $ins_rto_1[] = $da->rto_no;
                                   }
                                   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                   
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        
                                          $commission_id = [];
                                        
                                          foreach($check_rto as $da)
                                          {
                                            $commission_id[] = $da->commission_id;
                                          }
                                    }
                                }
                                else if(in_array("All TN",$ins_rto))
                                {
                                    $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                                    
                                       foreach($get_all_tn_rto as $da)
                                       {
                                            $ins_rto_1[] = $da->rto_no;
                                       }
                                    $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                    
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        
                                        $commission_id = [];
                                        
                                        foreach($check_rto as $da)
                                        {
                                            $commission_id[] = $da->commission_id;
                                        }
                                    }
                                }
                                else if(in_array("All RTO",$ins_rto))
                                {
                                   $get_all_rto = $this->pm->get_all_rto_list();
                                   
                                   foreach($get_all_rto as $da)
                                   {
                                          $ins_rto_1[] = $da->rto_no;
                                   }
                                   
                                    $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                    
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        
                                        $commission_id = [];
                                        
                                        foreach($check_rto as $da)
                                        {
                                            $commission_id[] = $da->commission_id;
                                        }
                                    }
                                }
                                else if(in_array('Bangalore',$ins_rto))
                                {
                                  $city_rto = $this->pm->get_ka_city_rto($ins_rto);
                                  
                                  for($i=0;$i<=count($ins_rto);$i++)
                                  {
                                		if(in_array("Bangalore",$ins_rto))
                                		{
                                			  unset($ins_rto[$i]);
                                		}
                                	}
                                		 
                                	$get_rto = $this->pm->get_rto_no($ins_rto);
                                	
                                	foreach($city_rto as $da)
                                	{
                                		$ins_rto_1[] = $da->rto_no;
                                	}
                                	
                                	if($get_rto != null)
                                	{
                                		foreach($get_rto as $da)
                                		{
                                			$ins_rto_1[] = $da->rto_no;
                                		}
                                	}
                                	  
                                	   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                	  
                                		if(count($check_rto) > 0)
                                		{
                                			$rto_status = "1";
                                			echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                		}
                                		else
                                		{
                                			echo json_encode(array("status"=>"success"));
                                		}
                                }
                                else
                                {
                                    $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto);
                                    
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                         
                                         $commission_id = [];
                                         
                                        foreach($check_rto as $da)
                                        {
                                            $commission_id[] = $da->commission_id;
                                        }
                                    }
                                }
                            }

                           
                            if($rto_status == "0" || $commission_id == "")
                            {
                                $last_policy_id = $this->pm->get_last_policy_id();
                                
                                if($last_policy_id == "")
                                {
                                        $com_policy_id = "1";
                                        $arr = array("policy_id" => $com_policy_id);
                                        $insert = $this->pm->add_policy_id($arr);
                                        if( $insert ) {
                                            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                        }
                                }
                                else
                                {
                                    $max_policy_id = $last_policy_id->policy_id;
                                    $com_policy_id = $max_policy_id+1;
                                    $arr = array("policy_id" => $com_policy_id);
                                    $insert = $this->pm->add_policy_id($arr);
                                    if( $insert ) {
                                        $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                    }
                                }
                                echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                            }
                            else if($rto_status == "1")
                            {
                                $check_make = $this->pm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                
                                if(count($check_make) > 0)
                                {
                                    $commission_id = [];
                                    
                                    foreach($check_make as $da)
                                    {
                                         $commission_id[] = $da->id;
                                    }
                                    
                                    $make_status = "1";
                                }
                                else
                                {
                                     $check_make_1 = $this->pm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                        
                                        if(count($check_make_1) > 0)
                                        {
                                            $commission_id = [];
                                            
                                            foreach($check_make_1 as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                                    
                                            $make_status = "1";
                                        }
                                        else
                                        {
                                            $make_status = "0";
                                        }
                                }
                                    
                               
                                if($make_status == "1")
                                {
                                    $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                                    
                                    if(count($check_model) > 0)
                                    {
                                            $commission_id = [];
                                            foreach($check_model as $da)
                                            {
                                                 $commission_id[] = $da->id;
                                            }
                                         $model_status = "1";
                                    }
                                    else
                                    {
                                        $check_model_1 = $this->pm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                        
                                        if(count($check_model_1) > 0)
                                        {
                                                $commission_id = [];
                                                
                                                foreach($check_model_1 as $da)
                                                {
                                                     $commission_id[] = $da->commission_id;
                                                }
                                             $model_status = "1";
                                        }
                                        else
                                        {
                                            $model_status = "0";
                                        }
                                    }
                                }
                                
                                if($make_status == "1" && $model_status == "1")
                                {
                                    $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                                  
                                    if(count($check_varient) > 0)
                                    {
                                        $commission_id = [];
                                        
                                        foreach($check_varient as $da)
                                        {
                                             $commission_id[] = $da->id;
                                        }
                            	         $varient_status = "1";
                                    }
                                    else 
                                    {
                                      $check_varient_1 = $this->pm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$varient);
                        	           
                        	            if(count($check_varient_1) > 0)
                        	            {
                            	            $commission_id = [];
                                            foreach($check_varient_1 as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                        	                 $varient_status = "1";
                        	            }
                        	            else
                        	            {
                        	                 $varient_status = "0";
                        	            }
                                    }
                                }
                                
                                if($ins_classification != "")
                                {
                                    
                                   $classification = $this->pm->get_classification(array_unique($commission_id),$ins_classification,$policy_type);
                                   
                                    if (count($classification) > 0)
                                    {
                                       $commission_id = [];
                                       
                                       foreach($classification as $da)
                                       {
                                           $commission_id[] = $da->id;
                                       }
                                       
                                       $gvw_status = "1";
                                    }
                                }
                                else
                                {
                                   $gvw_status = "1";
                                }
                                
                               $check =$this->pm->check_this_com_already_exits_by_commission_id($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type,array_unique($commission_id));
                               
                                 if(count($check) > 0)
                                 {
                                       foreach($check as $da)
                                	   {
                                	            $g_status = "0";
                                	            $fuel_status = "0";
                                	            
                                                $temp_min = $da->no_policy_min;
                                				$temp_max = $da->no_policy_max;
                                				

                                				if($temp_min <= $no_policy_min && $temp_max >= $no_policy_min)
                                				{
                                					$g_status = "1";
                                				}
                                				if($temp_min <= $no_policy_max && $temp_max >= $no_policy_max)
                                				{
                                					$g_status = "1";
                                				}
                                				if($temp_min > $no_policy_min && $temp_max < $no_policy_max)
                                				{
                                					$g_status = "1";
                                				}
                                				

                                                if($fuel_type == "1")
                                                {
                                                  
                                                	if($da->fuel_type == "4" || $da->fuel_type == "1" || $da->fuel_type == "6")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                

                                                if($fuel_type == "2")
                                                {
                                                    if($da->fuel_type == "5" || $da->fuel_type == "2")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                	
                                                }
                                                
                                                if($fuel_type == "5")
                                                {
                                                    if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "6")
                                                {
                                                    if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                
                                                if($fuel_type == "7")
                                                {
                                                    if($da->fuel_type == "7")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                               
                                                if($g_status == "1" && $fuel_status == "1")
                                    			{
                                    			    $status = "1";
                            	                    $fuel_type_status = "1";
                            	                    break;
                                    			}
                                    			else if($g_status == "0" && $fuel_status == "1")
                                    			{
                                    			    $nop_status = "1";
                                    			    $commission_id = [];
                                    			    $commission_id[] = $da->id;
                                    			}
                                        }
                                        
                                        if($rto_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1" && $gvw_status == "1" && $status == "1")
                                        {
                                            
                                        	 echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                        }
                                        else if($nop_status == "1")
                                        {
                                            
                                            $get_nop_id = $this->pm->get_no_of_policy_id($commission_id);
                                            
                                            if($get_nop_id != "")
                                            {
                                                echo json_encode(array("status"=>"success","no_of_policy_id"=>$get_nop_id->no_of_policy_id));
                                            }
                                        }
                                 }
                                 else
                                 {
                                    $last_policy_id = $this->pm->get_last_policy_id();
                                    
                                    if($last_policy_id == "")
                                    {
                                            $com_policy_id = "1";
                                            $arr = array("policy_id" => $com_policy_id);
                                            $insert = $this->pm->add_policy_id($arr);
                                            if( $insert ) {
                                                $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                            }
                                    }
                                    else
                                    {
                                        $max_policy_id = $last_policy_id->policy_id;
                                        $com_policy_id = $max_policy_id+1;
                                        $arr = array("policy_id" => $com_policy_id);
                                        $insert = $this->pm->add_policy_id($arr);
                                        if( $insert ) {
                                            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                        }
                                    }
                                    echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                                 }
                            }

                      }
                     else if($commission_type == "3")
                     {
                            $check =$this->pm->check_target_amount_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type);
                            
                            $ins_rto_1 = []; 
                            $commission_id = [];
                            
                            foreach($check as $da)
                            {
                                $commission_id[] = $da->id;
                            }

                            if($rto_category == "ROTN_Exclude")
                            {
                               $get_rto = $this->pm->get_rto($ins_rto);
                               
                                foreach($get_rto as $da)
                                {
                                   $ins_rto_1[] = $da->rto_no;
                                }
                            
                               $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                            
                                if(count($check_rto) > 0)
                                {
                                    $rto_status = "1";
                                    
                                    $commission_id = [];
                                    
                                      foreach($check_rto as $da)
                                      {
                                          $commission_id[] = $da->commission_id;
                                      }    
                                   
                                }
                            }
                            else if($rto_category == "KA_Exclude")
                            {
                              $get_rto = $this->pm->get_rto_ka($ins_rto);
                              
                              foreach($get_rto as $da)
                              {
                            	   $ins_rto_1[] = $da->rto_no;
                              }
                              
                               $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                              
                            	if(count($check_rto) > 0)
                            	{
                            		$rto_status = "1";
                            		echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                            	}
                            	else
                            	{
                            		echo json_encode(array("status"=>"success"));
                            	}
                            }
                            else
                            {
                                if(in_array('chennai',$ins_rto) || in_array('Coimbatore',$ins_rto) || in_array('Madurai',$ins_rto))
                                {
                                   $city_rto = $this->pm->get_city_rto($ins_rto);
                                   
                                  for($i=0;$i<=count($ins_rto);$i++)
                                  {
                                              if(in_array("chennai",$ins_rto))
                                              {
                                                    unset($ins_rto[$i]);
                                              }
                                              else if(in_array("Coimbatore",$ins_rto))
                                              {
                                                  unset($ins_rto[$i]);
                                              }
                                              else if(in_array("Madurai",$ins_rto))
                                              {
                                                  unset($ins_rto[$i]);
                                              }
                                       }
                                       
                                  $get_rto = $this->pm->get_rto_no($ins_rto);
                                
                                   foreach($city_rto as $da)
                                   {
                                       $ins_rto_1[] = $da->rto_no;
                                   }
                                
                                  if($get_rto != null || $get_rto != "")
                                  {
                                       foreach($get_rto as $da)
                                       {
                                            $ins_rto_1[] = $da->rto_no;
                                       }
                                    }
                                   
                                   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                  
                                    if(count($check_rto) > 0)
                                    {
                                         $rto_status = "1";
                                         
                                         $commission_id = [];
                                        
                                          foreach($check_rto as $da)
                                          {
                                             $commission_id[] = $da->commission_id;
                                          }
                                    }
                                }
                                else if(in_array("ROTN",$ins_rto))
                                {
                                   $get_rotn_rto = $this->pm->get_rotn_rto();
                                   
                                   foreach($get_rotn_rto as $da)
                                   {
                                        $ins_rto_1[] = $da->rto_no;
                                   }
                                   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                   
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        
                                          $commission_id = [];
                                        
                                          foreach($check_rto as $da)
                                          {
                                            $commission_id[] = $da->commission_id;
                                          }
                                    }
                                }
                                else if(in_array("All TN",$ins_rto))
                                {
                                    $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                                    
                                       foreach($get_all_tn_rto as $da)
                                       {
                                            $ins_rto_1[] = $da->rto_no;
                                       }
                                    $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                    
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        
                                        $commission_id = [];
                                        
                                        foreach($check_rto as $da)
                                        {
                                            $commission_id[] = $da->commission_id;
                                        }
                                    }
                                }
                                else if(in_array("All RTO",$ins_rto))
                                {
                                   $get_all_rto = $this->pm->get_all_rto_list();
                                   
                                   foreach($get_all_rto as $da)
                                   {
                                          $ins_rto_1[] = $da->rto_no;
                                   }
                                   
                                    $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                    
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        
                                        $commission_id = [];
                                        
                                        foreach($check_rto as $da)
                                        {
                                            $commission_id[] = $da->commission_id;
                                        }
                                    }
                                }
                                else if(in_array('Bangalore',$ins_rto))
                                {
                                  $city_rto = $this->pm->get_ka_city_rto($ins_rto);
                                  
                                  for($i=0;$i<=count($ins_rto);$i++)
                                  {
                                		if(in_array("Bangalore",$ins_rto))
                                		{
                                			  unset($ins_rto[$i]);
                                		}
                                	}
                                		 
                                	$get_rto = $this->pm->get_rto_no($ins_rto);
                                	
                                	foreach($city_rto as $da)
                                	{
                                		$ins_rto_1[] = $da->rto_no;
                                	}
                                	
                                	if($get_rto != null)
                                	{
                                		foreach($get_rto as $da)
                                		{
                                			$ins_rto_1[] = $da->rto_no;
                                		}
                                	}
                                	  
                                	   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                	  
                                		if(count($check_rto) > 0)
                                		{
                                			$rto_status = "1";
                                			echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                		}
                                		else
                                		{
                                			echo json_encode(array("status"=>"success"));
                                		}
                                }
                                else
                                {
                                    $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto);
                                    
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                         
                                         $commission_id = [];
                                         
                                        foreach($check_rto as $da)
                                        {
                                            $commission_id[] = $da->commission_id;
                                        }
                                    }
                                }
                            }

                            if($rto_status == "0" || $commission_id == "")
                            {
                                 
							 $last_net_id = $this->cm->get_last_net_premium_id();
								
								if($last_net_id->net_premium_id == "")
								{
									$com_net_premium_id = "1";
									$arr = array("net_premium_id" => $com_net_premium_id);
									$insert = $this->pm->add_net_premium_id($arr);
									if( $insert ) {
                                        $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                    }
									echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
								}
								else
								{
									$max_net_premium_id = $last_net_id->net_premium_id;
									$com_net_premium_id = $max_net_premium_id+1;
									$arr = array("net_premium_id" => $com_net_premium_id);
									$insert = $this->pm->add_net_premium_id($arr);
									if( $insert ) {
                                        $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                    }
									echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
								}
                            }
                            else if($rto_status == "1")
                            {
                                $check_make = $this->pm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                
								if(count($check_make) > 0)
                                {
                                    $commission_id = [];
                                    
                                    foreach($check_make as $da)
                                    {
                                         $commission_id[] = $da->id;
                                    }
                                    
                                    $make_status = "1";
                                }
                                else
                                {
                                     $check_make_1 = $this->pm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                        
                                        if(count($check_make_1) > 0)
                                        {
                                            $commission_id = [];
                                            
                                            foreach($check_make_1 as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                                    
                                            $make_status = "1";
                                        }
                                        else
                                        {
                                            $make_status = "0";
                                        }
                                }
                                if($make_status == "1")
                                {
                                    $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                                    
                                    if(count($check_model) > 0)
                                    {
                                            $commission_id = [];
											
                                            foreach($check_model as $da)
                                            {
                                                 $commission_id[] = $da->id;
                                            }
                                         $model_status = "1";
                                    }
                                    else
                                    {
                                        $check_model_1 = $this->pm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                        
                                        if(count($check_model_1) > 0)
                                        {
                                                $commission_id = [];
                                                
                                                foreach($check_model_1 as $da)
                                                {
                                                     $commission_id[] = $da->commission_id;
                                                }
                                             $model_status = "1";
                                        }
                                        else
                                        {
                                            $model_status = "0";
                                        }
                                    }
                                }
                                
                                if($make_status == "1" && $model_status == "1")
                                {
                                    $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                                  
                                    if(count($check_varient) > 0)
                                    {
                                        $commission_id = [];
                                        
                                        foreach($check_varient as $da)
                                        {
                                             $commission_id[] = $da->id;
                                        }
                            	         $varient_status = "1";
                                    }
                                    else 
                                    {
                                      $check_varient_1 = $this->pm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$varient);
                        	           
                        	            if(count($check_varient_1) > 0)
                        	            {
                            	            $commission_id = [];
                                            foreach($check_varient_1 as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                        	                 $varient_status = "1";
                        	            }
                        	            else
                        	            {
                        	                 $varient_status = "0";
                        	            }
                                    }
                                }
                                
                                if($ins_classification != "")
                                {
                                   $classification = $this->pm->get_classification(array_unique($commission_id),$ins_classification,$policy_type);
                                
                                    if (count($classification) > 0)
                                    {
                                       $commission_id = [];
                                       
                                       foreach($classification as $da)
                                       {
                                           $commission_id[] = $da->id;
                                       }
                                       
                                       $gvw_status = "1";
                                    }
                                }
                                else
                                {
                                   $gvw_status = "1";
                                }

                               $check =$this->pm->check_target_amount_already_exits_by_commission_id($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type,array_unique($commission_id));
                         
                                 if(count($check) > 0)
                                 {
                                       foreach($check as $da)
                                	   {
                                	            $g_status = "0";
                                	            $fuel_status = "0";
                                	            
                                                $temp_min = $da->min_val;
                                				$temp_max = $da->max_val;
                                				
                                				if($temp_min <= $min_amount && $temp_max >= $min_amount)
                                				{
                                					$g_status = "1";
                                				}
                                				if($temp_min <= $max_amount && $temp_max >= $max_amount)
                                				{
                                					$g_status = "1";
                                				}
                                				if($temp_min > $min_amount && $temp_max < $max_amount)
                                				{
                                					$g_status = "1";
                                				}
                                
                                                if($fuel_type == "1")
                                                {
                                                	if($da->fuel_type == "4" || $da->fuel_type == "1")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "2")
                                                {
                                                    if($da->fuel_type == "5" || $da->fuel_type == "2")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "5")
                                                {
                                                    if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "6")
                                                {
                                                    if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "7")
                                                {
                                                    if($da->fuel_type == "7")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($g_status == "1" && $fuel_status == "1")
                                    			{
                                    			    $status = "1";
                            	                    $fuel_type_status = "1";
                            	                    break;
                                    			}
                                    			else if($g_status == "0" && $fuel_status == "1")
                                    			{
                                    			    $net_status = "1";
                                    			    $commission_id = [];
                                    			    $commission_id[] = $da->id;
                                    			}
                                        }

                                        if($rto_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1" && $gvw_status == "1" && $status == "1")
                                        {
                                        	 echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                        }
                                        else if($net_status == "1")
                                        {
											$get_net_id = $this->pm->get_net_id(array_unique($commission_id));

											if($get_net_id != "")
											{
												echo json_encode(array("status"=>"success","net_id"=>$get_net_id->net_premium_id));
											}
                                        }
                                 }
                                 else
                                 {
										$last_net_id = $this->cm->get_last_net_premium_id();
										
										if($last_net_id->net_premium_id == "")
										{
											$com_net_premium_id = "1";
											$arr = array("net_premium_id" => $com_net_premium_id);
											$insert = $this->pm->add_net_premium_id($arr);
											if( $insert ) {
                                                $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                            }
											echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
										}
										else
										{
											$max_net_premium_id = $last_net_id->net_premium_id;
											$com_net_premium_id = $max_net_premium_id+1;
											$arr = array("net_premium_id" => $com_net_premium_id);
											$insert = $this->pm->add_net_premium_id($arr);
											if( $insert ) {
                                                $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                            }
											echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
										}
                                 }
                            }
                      }
    	       }
    	       else
    	       {
    	             if($commission_type == "1")
                     {
                            $check =$this->pm->check_health_this_com_already_exits($insurer_company,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date);
                            
                            foreach($check as $da)
                    		{
                        		    $temp_min = $da->no_policy_min;
                        		    $temp_max = $da->no_policy_max;
                        		    
                        		    $g_status = "0";

                        		    if($temp_min <= $no_policy_min && $temp_max >= $no_policy_min)
                    				{
                    					$g_status = "1";
                    				}
                    				if($temp_min <= $no_policy_max && $temp_max >= $no_policy_max)
                    				{
                    					$g_status = "1";
                    				}
                    				if($temp_min > $no_policy_min && $temp_max < $no_policy_max)
                    				{
                    					$g_status = "1";
                    				}
                    				
                        			if($g_status == "1")
                        			{
                        			    $status = "1";
                        			}
                        			else
                        			{
                        			     $commission_id[] = $da->id;
                        			}
                    		  }
                    		  
                    		  if(count($check) > 0)
                    		  {
                        		  if($status == "1")
                        		  {
                        		      echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                        		  }
                        		  else
                        		  {
                        		       $get_nop_id = $this->pm->get_no_of_policy_id($commission_id);
                                        
                                        if($get_nop_id != "")
                                        {
                                           echo json_encode(array("status"=>"success","no_of_policy_id"=>$get_nop_id->no_of_policy_id));
                                        }
                        		  }
                    		  }
                    		  else
                    		  {
                        		    $last_policy_id = $this->pm->get_last_policy_id();
                                    
                                    if($last_policy_id == "")
                                    {
                                            $com_policy_id = "1";
                                            $arr = array("policy_id" => $com_policy_id);
                                            $insert = $this->pm->add_policy_id($arr);
                                            if( $insert ) {
                                                $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                            }
                                    }
                                    else
                                    {
                                        $max_policy_id = $last_policy_id->policy_id;
                                        $com_policy_id = $max_policy_id+1;
                                        $arr = array("policy_id" => $com_policy_id);
                                        $insert = $this->pm->add_policy_id($arr);
                                        if( $insert ) {
                                            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                        }
                                    }
                                    echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                    		  }
                      }
                     else if($commission_type == "3")
                     {
                            $check =$this->pm->check_target_amount_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type);
                            
                            foreach($check as $da)
                            {
                                $temp_min = $da->min_val;
                                $temp_max = $da->max_val;
                                
                                $g_status = "0";
                            
                                if($temp_min <= $min_amount && $temp_max >= $min_amount)
                            	{
                            		$g_status = "1";
                            	}
                            	if($temp_min <= $max_amount && $temp_max >= $max_amount)
                            	{
                            		$g_status = "1";
                            	}
                            	if($temp_min > $min_amount && $temp_max < $max_amount)
                            	{
                            		$g_status = "1";
                            	}
                            	
                            	if($g_status == "1")
                            	{
                            	    $status = "1";
                            	}
                            	else
                            	{
                            	     $commission_id[] = $da->id;
                            	}
                            }
                            
                            if(count($check) > 0)
                            {
                                if($status == "1")
                                {
                                  echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                }
                                else
                                {
                                    $get_net_id = $this->pm->get_net_id(array_unique($commission_id));
                                    
                                    if($get_net_id != "")
                                    {
                                    	echo json_encode(array("status"=>"success","net_id"=>$get_net_id->net_premium_id));
                                    }
                                }
                            }
                            else
                            {
                                $last_net_id = $this->cm->get_last_net_premium_id();
                            
                                if($last_net_id->net_premium_id == "")
                                {
                                	$com_net_premium_id = "1";
                                	$arr = array("net_premium_id" => $com_net_premium_id);
                                	$insert = $this->pm->add_net_premium_id($arr);
                                	if( $insert ) {
                                        $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                    }
                                	echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                }
                                else
                                {
                                	$max_net_premium_id = $last_net_id->net_premium_id;
                                	$com_net_premium_id = $max_net_premium_id+1;
                                	$arr = array("net_premium_id" => $com_net_premium_id);
                                	$insert = $this->pm->add_net_premium_id($arr);
                                	if( $insert ) {
                                        $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                    }
                                	echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                }
                            }
                       }
                }
    	}
}  
    
        public function forward_to_next_month()
        {
            if($this->session->has_userdata('logged_in'))
    	    {
                $id = $this->input->post("id"); 
                $res = $this->pm->get_payout_entry_by_id($id);
                $fromDate = date('Y-m-d', strtotime($res->from_date. 'Next month'));
                $toDate = date('Y-m-t', strtotime($fromDate));
                $no_policy_id = $this->input->post("no_policy_id");
                $net_id = $this->input->post("net_id");
                
                if($no_policy_id == "undefined")
                {
                    $no_policy_id = "";
                }
                
                if($net_id == "undefined")
                {
                    $net_id = "";
                }
                
               
                
                $v_make = "";
                $v_model = "";
                
                $v_varient = "";
                
                 if($res->v_make == "all")
    	         {
    	             $v_make = "all"; 
    	         }
    	         
    	         if($res->v_model =="all")
    	         {
    	             $v_model = "all";
    	         }
    	         
    	         if($res->v_varient =="all")
    	         {
    	             $v_varient = "all";
    	         }
                  if($res->class == "1")
                  {
                      $data = array(
                            "insurer_company" =>$res->insurer_company,
                            "policy_premium_type" =>$res->policy_premium_type,
                            "class" =>$res->class,
                            "business_type" =>$res->business_type,
                            "commission_type" =>$res->commission_type,
                            "policy_type" =>$res->policy_type,
                            "state"=>$res->state,
                            "fuel_type" =>$res->fuel_type,
                            "rto_type" =>$res->rto_type,
                            "classification" =>$res->classification,
                            "vehicle_age_min"=>$res->vehicle_age_min,
                            "vehicle_age_max"=>$res->vehicle_age_max,
                            "v_make" =>$v_make,
                            "v_model" =>$v_model,
                            "v_varient" =>$v_varient,
                            "no_policy_min" =>$res->no_policy_min,
                            "no_policy_max" =>$res->no_policy_max,
                            "min_val" =>$res->min_val,
                            "max_val" =>$res->max_val,
                            "from_date" =>$fromDate,
                            "to_date"=>$toDate,
                            "type" =>$res->type,
                            "own_od"=>$res->own_od,
                            "own_tp"=>$res->own_tp,
                            "on_net"=>$res->on_net,
                            "is_ncb"=>$res->is_ncb,
                            "agn_com_type"=>$res->agn_com_type,
                            "ncb_percentage"=>$res->ncb_percentage,
                            "irda_od"=>$res->irda_od,
                            "irda_tp"=>$res->irda_tp,
                            "a_od"=>$res->a_od,
                            "b_od"=>$res->b_od,
                            "c_od"=>$res->c_od,
                            "d_od"=>$res->d_od,
                            "a_tp"=>$res->a_tp,
                            "b_tp"=>$res->b_tp,
                            "c_tp"=>$res->c_tp,
                            "d_tp"=>$res->d_tp,
                            "a_net"=>$res->a_net,
                            "b_net"=>$res->b_net,
                            "c_net"=>$res->c_net,
                            "d_net"=>$res->d_net,
                            "a_ncb"=>$res->a_ncb,
                            "b_ncb"=>$res->b_ncb,
                            "c_ncb"=>$res->c_ncb,
                            "d_ncb"=>$res->d_ncb,
                            "no_of_policy_id" =>$no_policy_id,
                            "net_premium_id" =>$net_id,
                            "created_time" =>date("Y-m-d H:i:s"),
                            "created_by"=>$this->session->userdata('session_id'),
                        );
               
                        $arr = $this->pm->add_payout_commission($data);
                        if( $arr ) {
                            $this->audit->log('company_payout_commission', 'INSERT', null, null, $data);
                        } 
                        
                         if($res->v_make != "all")
            	         {
            	             $v_make = "";
            	             $make = $this->pm->get_make($res->id);
            	             
                            foreach($make as $da)
                            {
                                $make_arr = array(
                                    "commission_id" =>$arr,
                                    "policy_type" =>$da->policy_type,
                                    "make" =>$da->make,
                                    "created_by" =>$this->session->userdata("session_id"),
                                    "created_date" =>date("Y-m-d H:i:s"),
                                    );
                                $add_make = $this->pm->add_make_list($make_arr);
                                if( $add_make ) {
                                    $this->audit->log('com_make_log', 'INSERT', null, null, $make_arr);
                                }
                            }
            	            
            	         }
            	         else
            	         {
            	             $v_make = "all";
            	         }
            	                      
            	         if($res->v_model != "all")
            	         {
            	              $v_model = "";
            	              $model = $this->pm->get_model1($res->id);
            	              
                                foreach($model as $da)
                                {
                                    $model_arr = array(
                                        "commission_id" =>$arr,
                                        "policy_type" =>$da->policy_type,
                                        "make_id" =>$da->make_id,
                                        "model_id" =>$da->model_id,
                                        "created_by" =>$this->session->userdata("session_id"),
                                        "created_date" =>date("Y-m-d H:i:s"),
                                        );
                                }
            	         }
            	         else
            	         {
            	             $v_model = "all";
            	         }
            	         
            	         if($res->v_varient != "all")
            	         {
            	             $v_varient = "";
            	             
            	             $varient = $this->pm->get_varient($res->id);
            	             
            	             foreach($varient as $da)
            	             {
                                    $varient_arr = array(
                                            "commission_id" =>$arr,
                                            "policy_type" =>$da->policy_type,
                                            "make_id" =>$da->make_id,
                                            "model_id" =>$da->model_id,
                                            "varient_id" =>$da->varient_id,
                                            "created_by" =>$this->session->userdata("session_id"),
                                            "created_date" =>date("Y-m-d H:i:s"),
                                            );
                                    $add_varient = $this->pm->add_varient_list($varient_arr);
                                    if( $add_varient ) {
                                        $this->audit->log('com_varient_log', 'INSERT', null, null, $varient_arr);
                                    }
            	             }
            	         }
            	         else
            	         {
            	             $v_varient = "all";
            	         }
            	         
            	         $old_rto = $this->pm->get_rto1($res->id);
            	         
    
            	          foreach($old_rto as $da)
                          {
                                $rto_arr = array(
                                        "commission_id" =>$arr,
                                        "rto" =>$da->rto,
                                        "created_time" =>date("Y-m-d H:i:s"),
                                        );
                                        
                                $add_rto = $this->pm->add_rto_log($rto_arr);
                                if( $add_rto ) {
                                    $this->audit->log('commission_rto_log', 'INSERT', null, null, $rto_arr);
                                }
                          }
                  }
                  else
                  {
                        $data = array(
                            "insurer_company" =>$res->insurer_company,
                            "class" =>$res->class,
                            "business_type" =>$res->business_type,
                            "commission_type" =>$res->commission_type,
                            "policy_type" =>$res->policy_type,
                            "state"=>$res->state,
                            "no_policy_min" =>$res->no_policy_min,
                            "no_policy_max" =>$res->no_policy_max,
                            "min_val" =>$res->min_val,
                            "max_val" =>$res->max_val,
                            "from_date" =>$fromDate,
                            "to_date"=>$toDate,
                            "on_net"=>$res->on_net,
                            "is_ncb"=>$res->is_ncb,
                            "ncb_percentage"=>$res->ncb_percentage,
                            "a_net"=>$res->a_net,
                            "b_net"=>$res->b_net,
                            "c_net"=>$res->c_net,
                            "d_net"=>$res->d_net,
                            "a_ncb"=>$res->a_ncb,
                            "b_ncb"=>$res->b_ncb,
                            "c_ncb"=>$res->c_ncb,
                            "d_ncb"=>$res->d_ncb,
                            "no_of_policy_id" =>$no_policy_id,
                            "net_premium_id" =>$net_id,
                            "created_time" =>date("Y-m-d H:i:s"),
                            "created_by"=>$this->session->userdata('session_id'),
                        );
               
                        $arr = $this->pm->add_payout_commission($data);
                        if( $arr ) {
                            $this->audit->log('company_payout_commission', 'INSERT', null, null, $data);
                        }
                  }
    	    }
        }
      
        public function forward_check_payout_entry()
        {
            if($this->session->has_userdata('logged_in'))
            {
        	        $id = $this->input->post("id"); 
                    $res = $this->pm->get_payout_entry_by_id($id);
                    
                     $fromDate = date('Y-m-d', strtotime($res->from_date. 'Next month'));
                     $toDate = date('Y-m-t', strtotime($fromDate));
                
                    $insurer_company = $res->insurer_company;
                    $premium_c_type = $res->policy_premium_type;
                    $insurer_class = $res->class;
                    $business_type = $res->business_type;
                    $commission_type = $res->commission_type;
                    $policy_type = $res->policy_type;
                    $ins_state = $res->state;
                    $fuel_type = $res->fuel_type;
                    $rto_type = $res->rto_type;
                    $ins_classification = $res->classification;
                    $vehicle_age_min = $res->vehicle_age_min;
                    $vehicle_age_max = $res->vehicle_age_max;
                    $no_policy_min = $res->no_policy_min;
                    $no_policy_max = $res->no_policy_max;
                    $min_amount = $res->min_val;
                    $max_amount = $res->max_val;
                    $f_date = $fromDate;
                    $to_date = $toDate;
                    $add_type =  $res->type;
                    $rto_category = $res->rto_type;
                    $rto = $this->pm->get_rto1($id);
                    
                    // start 2023-08-17
                    $payout_type = $res->payout_type;

                
                     if($res->v_make == "all")
        	         {
        	             $make = "all"; 
        	         }
        	         else
        	         {
        	             $get_make = $this->pm->get_make($id);
        	             
        	             $make = [];  
        	             
        	             foreach($get_make as $da)
        	             {
        	                 $make[] = $da->make;
        	             }
        	         }
        	         
        	         if($res->v_model =="all")
        	         {
        	             $model = "all";
        	         }
        	         else
        	         {
                        $get_model = $this->pm->get_model1($id);
                        
                        $model = [];
                        
                        foreach($get_model as $da)
                        {
                           $model[] = $da->model_id;
                        }
        	         }
        	
        	         if($res->v_varient =="all")
        	         {
        	             $varient = "all";
        	         }
        	         else
        	         {
                        $get_varient = $this->pm->get_varient($id);
                        
                        $varient = [];
                        
                        foreach($get_varient as $da)
                        {
                           $varient[] = $da->varient_id;
                        }
        	         }
                    
                    
                    
                    $ins_rto = [];
                    
                    foreach($rto as $da)
                    {
                        $ins_rto[] = $da->rto;
                    }
        
                 $commission_id = [];
                 
                 $g_status = "0";
                 
                 $status = "0";
                 $make_status = "0";
                 $model_status = "0";
                 $varient_status = "0";
                 $rto_status = "0";
                 $fuel_status = "0";
                 $gvw_status = "0";
                 $nop_status = "0";
                 $fuel_type_status = "0";
                 $com_policy_id = "";
                 $net_status = "0";
           
               if($insurer_class == "1")  
               {
                     if($commission_type == "2")
                     {
                            $check = $this->pm->check_vechi_age_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type, $payout_type);
        	           
                    	    foreach($check as $da)
                    		{
                        		    $temp_min = $da->vehicle_age_min;
                        		    $temp_max = $da->vehicle_age_max;
                        		    
                        		    $g_status = "0";
                        		    
                    		        $fuel_status = "0";
                        		    
                        		    if($temp_min <= $vehicle_age_min && $temp_max >= $vehicle_age_min)
                    				{
                    					$g_status = "1";
                    				}
                    				if($temp_min <= $vehicle_age_max && $temp_max >= $vehicle_age_max)
                    				{
                    					$g_status = "1";
                    				}
                    				if($temp_min > $vehicle_age_min && $temp_max < $vehicle_age_max)
                    				{
                    					$g_status = "1";
                    				}
                    				
                            		    if($fuel_type == "1")
                            		    {
                            				if($da->fuel_type == "4" || $da->fuel_type == "1")
                            				{
                            				    $fuel_status = "1";
                            				}
                            			}
                            			if($fuel_type == "2")
                            			{
                            			    if($da->fuel_type == "5" || $da->fuel_type == "2")
                            				{
                            				    $fuel_status = "1";
                            				}
                            			}
                            			if($fuel_type == "5")
                            			{
                            			    if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2")
                            				{
                            				    $fuel_status = "1";
                            				}
                            			}
                            			if($fuel_type == "6")
                            			{
                            			    if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                            				{
                            				    $fuel_status = "1";
                            				}
                            			}
                            			if($fuel_type == "7")
                            			{
                            			    if($da->fuel_type == "7")
                            				{
                            				    $fuel_status = "1";
                            				}
                            			}
                            			
                            			if($g_status == "1" && $fuel_status == "1")
                            			{
                            			    $commission_id[] = $da->id;
                            			    $status = "1";
                    	                    $fuel_type_status = "1";
                            			}
                    		      }
                    		      
                            if($status == "1")
                            {
                                if($ins_classification != "")
                                {
                                   $classification = $this->pm->get_classification(array_unique($commission_id),$ins_classification,$policy_type);
                                
                                    if(count($classification > 0))
                                    {
                                       $commission_id = [];
                                       
                                       foreach($classification as $da)
                                       {
                                           $commission_id[] = $da->id;
                                       }
                                       
                                       $gvw_status = "1";
                                    }
                                }
                                else
                                {
                                   $gvw_status = "1";
                                }
                                
                                $check_make = $this->pm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                
                                if(count($check_make) > 0)
                                {
                                    $commission_id = [];
                                    
                                    foreach($check_make as $da)
                                    {
                                         $commission_id[] = $da->id;
                                    }
                                    
                                    $status = "1";
                                    $make_status = "1";
                                }
                                else
                                {
                                     $check_make_1 = $this->pm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                        
                                        if(count($check_make_1) > 0)
                                        {
                                            $commission_id = [];
                                            
                                            foreach($check_make_1 as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                                    
                                            $status = "1";
                                            $make_status = "1";
                                        }
                                        else
                                        {
                                            $make_status = "0";
                                        }
                                }
                                    
                                if($make_status == "1")
                                {
                                    $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                                    
                                    if(count($check_model) > 0)
                                    {
                                            $commission_id = [];
                                            foreach($check_model as $da)
                                            {
                                                 $commission_id[] = $da->id;
                                            }
                                         $status = "1";
                                         $model_status = "1";
                                    }
                                    else
                                    {
                                        $check_model_1 = $this->pm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                        
                                        if(count($check_model_1) > 0)
                                        {
                                                $commission_id = [];
                                                
                                                foreach($check_model_1 as $da)
                                                {
                                                     $commission_id[] = $da->commission_id;
                                                }
                                             $status = "1";
                                             $model_status = "1";
                                        }
                                        else
                                        {
                                            $model_status = "0";
                                        }
                                    }
                                }
                                
                                if($make_status == "1" && $model_status == "1")
                                {
                                    $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                                  
                                    if(count($check_varient) > 0)
                                    {
                                        $commission_id = [];
                                        
                                        foreach($check_varient as $da)
                                        {
                                             $commission_id[] = $da->id;
                                        }
                                         $status = "1";
                            	         $varient_status = "1";
                                    }
                                    else 
                                    {
                                      $check_varient_1 = $this->pm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$varient);
                        	           
                        	            if(count($check_varient_1) > 0)
                        	            {
                            	            $commission_id = [];
                                            foreach($check_varient_1 as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                        	                 $status = "1";
                        	                 $varient_status = "1";
                        	            }
                        	            else
                        	            {
                        	                 $varient_status = "0";
                        	            }
                                    }
                                }
                                
                                 $ins_rto_1 = []; 
                    
                                if($status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                {
                                       if($rto_category == "ROTN_Exclude")
                                       {
                                          $get_rto = $this->pm->get_rto($ins_rto);
                                          
                                          foreach($get_rto as $da)
                                          {
                                               $ins_rto_1[] = $da->rto_no;
                                          }
                                          
                                           $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                          
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status = "1";
                                                echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                            }
                                            else
                                            {
                                                echo json_encode(array("status"=>"success"));
                                            }
                                      }
                                       else if($rto_category == "KA_Exclude")
                                       {
                                          $get_rto = $this->pm->get_rto_ka($ins_rto);
                                          
                                          foreach($get_rto as $da)
                                          {
                                        	   $ins_rto_1[] = $da->rto_no;
                                          }
                                          
                                           $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                          
                                        	if(count($check_rto) > 0)
                                        	{
                                        		$rto_status = "1";
                                        		echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                        	}
                                        	else
                                        	{
                                        		echo json_encode(array("status"=>"success"));
                                        	}
                                        }
                                      else
                                      {
                                           if(in_array('chennai',$ins_rto) || in_array('Coimbatore',$ins_rto) || in_array('Madurai',$ins_rto))
                                           {
                                               $city_rto = $this->pm->get_city_rto($ins_rto);
                                               
                                              for($i=0;$i<=count($ins_rto);$i++)
                                          	  {
                                          	            if(in_array("chennai",$ins_rto))
                                          	            {
                                          	                  unset($ins_rto[$i]);
                                          	            }
                                          	            else if(in_array("Coimbatore",$ins_rto))
                                          	            {
                                          	                unset($ins_rto[$i]);
                                          	            }
                                          	            else if(in_array("Madurai",$ins_rto))
                                          	            {
                                          	                unset($ins_rto[$i]);
                                          	            }
                                          	     }
                                          	     
                                          	   $get_rto = $this->pm->get_rto_no($ins_rto);
                                            
                                               foreach($city_rto as $da)
                                               {
                                                   $ins_rto_1[] = $da->rto_no;
                                               }
                                             
                                              if($get_rto != null)
                                              {
                                                   foreach($get_rto as $da)
                                                   {
                                                        $ins_rto_1[] = $da->rto_no;
                                                   }
                                              }
                                              
                                               $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                              
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status = "1";
                                                    echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                }
                                                else
                                                {
                                                    echo json_encode(array("status"=>"success"));
                                                }
                                           }
                                           else if(in_array("ROTN",$ins_rto))
                                           {
                                               $get_rotn_rto = $this->pm->get_rotn_rto();
                                               
                                               foreach($get_rotn_rto as $da)
                                               {
                                                    $ins_rto_1[] = $da->rto_no;
                                               }
                                               
                                               $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                               
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status = "1";
                                                    echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                }
                                                else
                                                {
                                                    echo json_encode(array("status"=>"success"));
                                                }
                                           }
                                           else if(in_array("All TN",$ins_rto))
                                           {
                                                $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                                                
                                                   foreach($get_all_tn_rto as $da)
                                                   {
                                                        $ins_rto_1[] = $da->rto_no;
                                                   }
                                                $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                                
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status = "1";
                                                    echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                }
                                                else
                                                {
                                                    echo json_encode(array("status"=>"success"));
                                                }
                                           }
                                           else if(in_array("All RTO",$ins_rto))
                                           {
                                               $get_all_rto = $this->pm->get_all_rto_list();
                                               
                                               foreach($get_all_rto as $da)
                                               {
                                                      $ins_rto_1[] = $da->rto_no;
                                               }
                                               
                                                $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                                
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status = "1";
                                                    echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                }
                                                else
                                                {
                                                    echo json_encode(array("status"=>"success"));
                                                }
                                           }
                                           else if(in_array('Bangalore',$ins_rto))
                                           {
                                              $city_rto = $this->pm->get_ka_city_rto($ins_rto);
                                              
                                              for($i=0;$i<=count($ins_rto);$i++)
                                              {
                                            		if(in_array("Bangalore",$ins_rto))
                                            		{
                                            			  unset($ins_rto[$i]);
                                            		}
                                            	}
                                            		 
                                            	$get_rto = $this->pm->get_rto_no($ins_rto);
                                            	
                                            	foreach($city_rto as $da)
                                            	{
                                            		$ins_rto_1[] = $da->rto_no;
                                            	}
                                            	
                                            	if($get_rto != null)
                                            	{
                                            		foreach($get_rto as $da)
                                            		{
                                            			$ins_rto_1[] = $da->rto_no;
                                            		}
                                            	}
                                            	  
                                            	   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                            	  
                                            		if(count($check_rto) > 0)
                                            		{
                                            			$rto_status = "1";
                                            			echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                            		}
                                            		else
                                            		{
                                            			echo json_encode(array("status"=>"success"));
                                            		}
                                            }
                                           else
                                           {
                                                $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto);
                                                
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status = "1";
                                                    echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                                }
                                                else
                                                {
                                                   echo json_encode(array("status"=>"success"));
                                                }
                                            }
                                      }
                                }
                                else
                                {
                                    echo json_encode(array("status"=>"success"));
                                }
                            }
                            else
                            {
                               echo json_encode(array("status"=>"success"));
                            }
                      }
                     else if($commission_type == "1")
                     {
                            $check =$this->pm->check_this_com_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type);
                           
                            $ins_rto_1 = []; 
                            
                            $commission_id = [];
                            
                            foreach($check as $da)
                            {
                                $commission_id[] = $da->id;
                            }
        
                            if($rto_category == "ROTN_Exclude")
                            {
                               $get_rto = $this->pm->get_rto($ins_rto);
                               
                                foreach($get_rto as $da)
                                {
                                   $ins_rto_1[] = $da->rto_no;
                                }
                            
                               $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                            
                                if(count($check_rto) > 0)
                                {
                                    $rto_status = "1";
                                    
                                    $commission_id = [];
                                    
                                      foreach($check_rto as $da)
                                      {
                                          $commission_id[] = $da->commission_id;
                                      }    
                                   
                                }
                            }
                            else if($rto_category == "KA_Exclude")
                            {
                              $get_rto = $this->pm->get_rto_ka($ins_rto);
                              
                              foreach($get_rto as $da)
                              {
                            	   $ins_rto_1[] = $da->rto_no;
                              }
                              
                               $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                              
                            	if(count($check_rto) > 0)
                            	{
                            		$rto_status = "1";
                            		echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                            	}
                            	else
                            	{
                            		echo json_encode(array("status"=>"success"));
                            	}
                            }
                            else
                            {
                                if(in_array('chennai',$ins_rto) || in_array('Coimbatore',$ins_rto) || in_array('Madurai',$ins_rto))
                                {
                                   $city_rto = $this->pm->get_city_rto($ins_rto);
                                   
                                  for($i=0;$i<=count($ins_rto);$i++)
                                  {
                                              if(in_array("chennai",$ins_rto))
                                              {
                                                    unset($ins_rto[$i]);
                                              }
                                              else if(in_array("Coimbatore",$ins_rto))
                                              {
                                                  unset($ins_rto[$i]);
                                              }
                                              else if(in_array("Madurai",$ins_rto))
                                              {
                                                  unset($ins_rto[$i]);
                                              }
                                       }
                                       
                                  $get_rto = $this->pm->get_rto_no($ins_rto);
                                
                                   foreach($city_rto as $da)
                                   {
                                       $ins_rto_1[] = $da->rto_no;
                                   }
                                
                                  if($get_rto != null || $get_rto != "")
                                  {
                                       foreach($get_rto as $da)
                                       {
                                            $ins_rto_1[] = $da->rto_no;
                                       }
                                    }
                                   
                                   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                  
                                    if(count($check_rto) > 0)
                                    {
                                         $rto_status = "1";
                                         
                                         $commission_id = [];
                                        
                                          foreach($check_rto as $da)
                                          {
                                             $commission_id[] = $da->commission_id;
                                          }
                                    }
                                }
                                else if(in_array("ROTN",$ins_rto))
                                {
                                   $get_rotn_rto = $this->pm->get_rotn_rto();
                                   
                                   foreach($get_rotn_rto as $da)
                                   {
                                        $ins_rto_1[] = $da->rto_no;
                                   }
                                   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                   
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        
                                          $commission_id = [];
                                        
                                          foreach($check_rto as $da)
                                          {
                                            $commission_id[] = $da->commission_id;
                                          }
                                    }
                                }
                                else if(in_array("All TN",$ins_rto))
                                {
                                    $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                                    
                                       foreach($get_all_tn_rto as $da)
                                       {
                                            $ins_rto_1[] = $da->rto_no;
                                       }
                                    $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                    
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        
                                        $commission_id = [];
                                        
                                        foreach($check_rto as $da)
                                        {
                                            $commission_id[] = $da->commission_id;
                                        }
                                    }
                                }
                                else if(in_array("All RTO",$ins_rto))
                                {
                                   $get_all_rto = $this->pm->get_all_rto_list();
                                   
                                   foreach($get_all_rto as $da)
                                   {
                                          $ins_rto_1[] = $da->rto_no;
                                   }
                                   
                                    $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                    
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        
                                        $commission_id = [];
                                        
                                        foreach($check_rto as $da)
                                        {
                                            $commission_id[] = $da->commission_id;
                                        }
                                    }
                                }
                                else if(in_array('Bangalore',$ins_rto))
                                {
                                  $city_rto = $this->pm->get_ka_city_rto($ins_rto);
                                  
                                  for($i=0;$i<=count($ins_rto);$i++)
                                  {
                                		if(in_array("Bangalore",$ins_rto))
                                		{
                                			  unset($ins_rto[$i]);
                                		}
                                	}
                                		 
                                	$get_rto = $this->pm->get_rto_no($ins_rto);
                                	
                                	foreach($city_rto as $da)
                                	{
                                		$ins_rto_1[] = $da->rto_no;
                                	}
                                	
                                	if($get_rto != null)
                                	{
                                		foreach($get_rto as $da)
                                		{
                                			$ins_rto_1[] = $da->rto_no;
                                		}
                                	}
                                	  
                                	   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                	  
                                		if(count($check_rto) > 0)
                                		{
                                			$rto_status = "1";
                                			echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                		}
                                		else
                                		{
                                			echo json_encode(array("status"=>"success"));
                                		}
                                }
                                else
                                {
                                    $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto);
                                    
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                         
                                         $commission_id = [];
                                         
                                        foreach($check_rto as $da)
                                        {
                                            $commission_id[] = $da->commission_id;
                                        }
                                    }
                                }
                            }
        
                            if($rto_status == "0" || $commission_id == "")
                            {
                                $last_policy_id = $this->pm->get_last_policy_id();
                                
                                if($last_policy_id == "")
                                {
                                        $com_policy_id = "1";
                                        $arr = array("policy_id" => $com_policy_id);
                                        $insert = $this->pm->add_policy_id($arr);
                                        if( $insert ) {
                                            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                        }
                                }
                                else
                                {
                                    $max_policy_id = $last_policy_id->policy_id;
                                    $com_policy_id = $max_policy_id+1;
                                    $arr = array("policy_id" => $com_policy_id);
                                    $insert = $this->pm->add_policy_id($arr);
                                    if( $insert ) {
                                        $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                    }
                                }
                                echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                            }
                            else if($rto_status == "1")
                            {
                                $check_make = $this->pm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                if(count($check_make) > 0)
                                {
                                    $commission_id = [];
                                    
                                    foreach($check_make as $da)
                                    {
                                         $commission_id[] = $da->id;
                                    }
                                    
                                    $make_status = "1";
                                }
                                else
                                {
                                     $check_make_1 = $this->pm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                        
                                        if(count($check_make_1) > 0)
                                        {
                                            $commission_id = [];
                                            
                                            foreach($check_make_1 as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                                    
                                            $make_status = "1";
                                        }
                                        else
                                        {
                                            $make_status = "0";
                                        }
                                }
                                    
                                if($make_status == "1")
                                {
                                    $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                                    
                                    if(count($check_model) > 0)
                                    {
                                            $commission_id = [];
                                            foreach($check_model as $da)
                                            {
                                                 $commission_id[] = $da->id;
                                            }
                                         $model_status = "1";
                                    }
                                    else
                                    {
                                        $check_model_1 = $this->pm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                        
                                        if(count($check_model_1) > 0)
                                        {
                                                $commission_id = [];
                                                
                                                foreach($check_model_1 as $da)
                                                {
                                                     $commission_id[] = $da->commission_id;
                                                }
                                             $model_status = "1";
                                        }
                                        else
                                        {
                                            $model_status = "0";
                                        }
                                    }
                                }
                                
                                if($make_status == "1" && $model_status == "1")
                                {
                                    $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                                  
                                    if(count($check_varient) > 0)
                                    {
                                        $commission_id = [];
                                        
                                        foreach($check_varient as $da)
                                        {
                                             $commission_id[] = $da->id;
                                        }
                            	         $varient_status = "1";
                                    }
                                    else 
                                    {
                                      $check_varient_1 = $this->pm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$varient);
                        	           
                        	            if(count($check_varient_1) > 0)
                        	            {
                            	            $commission_id = [];
                                            foreach($check_varient_1 as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                        	                 $varient_status = "1";
                        	            }
                        	            else
                        	            {
                        	                 $varient_status = "0";
                        	            }
                                    }
                                }
                                
                                if($ins_classification != "")
                                {
                                   $classification = $this->pm->get_classification(array_unique($commission_id),$ins_classification,$policy_type);
                                
                                    if(count($classification > 0))
                                    {
                                       $commission_id = [];
                                       
                                       foreach($classification as $da)
                                       {
                                           $commission_id[] = $da->id;
                                       }
                                       
                                       $gvw_status = "1";
                                    }
                                }
                                else
                                {
                                   $gvw_status = "1";
                                }
                                
        
                               $check =$this->pm->check_this_com_already_exits_by_commission_id($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type,array_unique($commission_id));
                         
                                 if(count($check) > 0)
                                 {
                                       foreach($check as $da)
                                	   {
                                	            $g_status = "0";
                                	            $fuel_status = "0";
                                	            
                                                $temp_min = $da->no_policy_min;
                                				$temp_max = $da->no_policy_max;
                                				
                                				if($temp_min <= $no_policy_min && $temp_max >= $no_policy_min)
                                				{
                                					$g_status = "1";
                                				}
                                				if($temp_min <= $no_policy_max && $temp_max >= $no_policy_max)
                                				{
                                					$g_status = "1";
                                				}
                                				if($temp_min > $no_policy_min && $temp_max < $no_policy_max)
                                				{
                                					$g_status = "1";
                                				}
                                
                                                if($fuel_type == "1")
                                                {
                                                	if($da->fuel_type == "4" || $da->fuel_type == "1")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "2")
                                                {
                                                    if($da->fuel_type == "5" || $da->fuel_type == "2")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "5")
                                                {
                                                    if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "6")
                                                {
                                                    if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "7")
                                                {
                                                    if($da->fuel_type == "7")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($g_status == "1" && $fuel_status == "1")
                                    			{
                                    			    $status = "1";
                            	                    $fuel_type_status = "1";
                            	                    break;
                                    			}
                                    			else if($g_status == "0" && $fuel_status == "1")
                                    			{
                                    			    $nop_status = "1";
                                    			    $commission_id = [];
                                    			    $commission_id[] = $da->id;
                                    			}
                                        }
                                        
                                        if($rto_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1" && $gvw_status == "1" && $status == "1")
                                        {
                                        	 echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                        }
                                        else if($nop_status == "1")
                                        {
                                            $get_nop_id = $this->pm->get_no_of_policy_id($commission_id);
                                            
                                            if($get_nop_id != "")
                                            {
                                                echo json_encode(array("status"=>"success","no_of_policy_id"=>$get_nop_id->no_of_policy_id));
                                            }
                                        }
                                 }
                                 else
                                 {
                                    $last_policy_id = $this->pm->get_last_policy_id();
                                    
                                    if($last_policy_id == "")
                                    {
                                            $com_policy_id = "1";
                                            $arr = array("policy_id" => $com_policy_id);
                                            $insert = $this->pm->add_policy_id($arr);
                                            if( $insert ) {
                                                $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                            }
                                    }
                                    else
                                    {
                                        $max_policy_id = $last_policy_id->policy_id;
                                        $com_policy_id = $max_policy_id+1;
                                        $arr = array("policy_id" => $com_policy_id);
                                        $insert = $this->pm->add_policy_id($arr);
                                        if( $insert ) {
                                            $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                        }
                                    }
                                    echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                                 }
                            }
                      }
                     else if($commission_type == "3")
                     {
                            $check =$this->pm->check_target_amount_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type);
                            
                            $ins_rto_1 = []; 
                            $commission_id = [];
                            
                            foreach($check as $da)
                            {
                                $commission_id[] = $da->id;
                            }
        
                            if($rto_category == "ROTN_Exclude")
                            {
                               $get_rto = $this->pm->get_rto($ins_rto);
                               
                                foreach($get_rto as $da)
                                {
                                   $ins_rto_1[] = $da->rto_no;
                                }
                            
                               $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                            
                                if(count($check_rto) > 0)
                                {
                                    $rto_status = "1";
                                    
                                    $commission_id = [];
                                    
                                      foreach($check_rto as $da)
                                      {
                                          $commission_id[] = $da->commission_id;
                                      }    
                                   
                                }
                            }
                            else if($rto_category == "KA_Exclude")
                            {
                              $get_rto = $this->pm->get_rto_ka($ins_rto);
                              
                              foreach($get_rto as $da)
                              {
                            	   $ins_rto_1[] = $da->rto_no;
                              }
                              
                               $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                              
                            	if(count($check_rto) > 0)
                            	{
                            		$rto_status = "1";
                            		echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                            	}
                            	else
                            	{
                            		echo json_encode(array("status"=>"success"));
                            	}
                            }
                            else
                            {
                                if(in_array('chennai',$ins_rto) || in_array('Coimbatore',$ins_rto) || in_array('Madurai',$ins_rto))
                                {
                                   $city_rto = $this->pm->get_city_rto($ins_rto);
                                   
                                  for($i=0;$i<=count($ins_rto);$i++)
                                  {
                                              if(in_array("chennai",$ins_rto))
                                              {
                                                    unset($ins_rto[$i]);
                                              }
                                              else if(in_array("Coimbatore",$ins_rto))
                                              {
                                                  unset($ins_rto[$i]);
                                              }
                                              else if(in_array("Madurai",$ins_rto))
                                              {
                                                  unset($ins_rto[$i]);
                                              }
                                       }
                                       
                                  $get_rto = $this->pm->get_rto_no($ins_rto);
                                
                                   foreach($city_rto as $da)
                                   {
                                       $ins_rto_1[] = $da->rto_no;
                                   }
                                
                                  if($get_rto != null || $get_rto != "")
                                  {
                                       foreach($get_rto as $da)
                                       {
                                            $ins_rto_1[] = $da->rto_no;
                                       }
                                    }
                                   
                                   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                  
                                    if(count($check_rto) > 0)
                                    {
                                         $rto_status = "1";
                                         
                                         $commission_id = [];
                                        
                                          foreach($check_rto as $da)
                                          {
                                             $commission_id[] = $da->commission_id;
                                          }
                                    }
                                }
                                else if(in_array("ROTN",$ins_rto))
                                {
                                   $get_rotn_rto = $this->pm->get_rotn_rto();
                                   
                                   foreach($get_rotn_rto as $da)
                                   {
                                        $ins_rto_1[] = $da->rto_no;
                                   }
                                   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                   
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        
                                          $commission_id = [];
                                        
                                          foreach($check_rto as $da)
                                          {
                                            $commission_id[] = $da->commission_id;
                                          }
                                    }
                                }
                                else if(in_array("All TN",$ins_rto))
                                {
                                    $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                                    
                                       foreach($get_all_tn_rto as $da)
                                       {
                                            $ins_rto_1[] = $da->rto_no;
                                       }
                                    $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                    
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        
                                        $commission_id = [];
                                        
                                        foreach($check_rto as $da)
                                        {
                                            $commission_id[] = $da->commission_id;
                                        }
                                    }
                                }
                                else if(in_array("All RTO",$ins_rto))
                                {
                                   $get_all_rto = $this->pm->get_all_rto_list();
                                   
                                   foreach($get_all_rto as $da)
                                   {
                                          $ins_rto_1[] = $da->rto_no;
                                   }
                                   
                                    $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                    
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                        
                                        $commission_id = [];
                                        
                                        foreach($check_rto as $da)
                                        {
                                            $commission_id[] = $da->commission_id;
                                        }
                                    }
                                }
                                else if(in_array('Bangalore',$ins_rto))
                                {
                                  $city_rto = $this->pm->get_ka_city_rto($ins_rto);
                                  
                                  for($i=0;$i<=count($ins_rto);$i++)
                                  {
                                		if(in_array("Bangalore",$ins_rto))
                                		{
                                			  unset($ins_rto[$i]);
                                		}
                                	}
                                		 
                                	$get_rto = $this->pm->get_rto_no($ins_rto);
                                	
                                	foreach($city_rto as $da)
                                	{
                                		$ins_rto_1[] = $da->rto_no;
                                	}
                                	
                                	if($get_rto != null)
                                	{
                                		foreach($get_rto as $da)
                                		{
                                			$ins_rto_1[] = $da->rto_no;
                                		}
                                	}
                                	  
                                	   $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto_1);
                                	  
                                		if(count($check_rto) > 0)
                                		{
                                			$rto_status = "1";
                                			echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                		}
                                		else
                                		{
                                			echo json_encode(array("status"=>"success"));
                                		}
                                }
                                else
                                {
                                    $check_rto = $this->pm->check_rto_already_exits(array_unique($commission_id),$ins_rto);
                                    
                                    if(count($check_rto) > 0)
                                    {
                                        $rto_status = "1";
                                         
                                         $commission_id = [];
                                         
                                        foreach($check_rto as $da)
                                        {
                                            $commission_id[] = $da->commission_id;
                                        }
                                    }
                                }
                            }
        
                            if($rto_status == "0" || $commission_id == "")
                            {
                                 
        					 $last_net_id = $this->cm->get_last_net_premium_id();
        						
        						if($last_net_id->net_premium_id == "")
        						{
        							$com_net_premium_id = "1";
        							$arr = array("net_premium_id" => $com_net_premium_id);
        							$insert = $this->pm->add_net_premium_id($arr);
        							if( $insert ) {
                                        $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                    }
        							echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
        						}
        						else
        						{
        							$max_net_premium_id = $last_net_id->net_premium_id;
        							$com_net_premium_id = $max_net_premium_id+1;
        							$arr = array("net_premium_id" => $com_net_premium_id);
        							$insert = $this->pm->add_net_premium_id($arr);
        							if( $insert ) {
                                        $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                    }
        							echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
        						}
                            }
                            else if($rto_status == "1")
                            {
                                $check_make = $this->pm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                
        						if(count($check_make) > 0)
                                {
                                    $commission_id = [];
                                    
                                    foreach($check_make as $da)
                                    {
                                         $commission_id[] = $da->id;
                                    }
                                    
                                    $make_status = "1";
                                }
                                else
                                {
                                     $check_make_1 = $this->pm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                        
                                        if(count($check_make_1) > 0)
                                        {
                                            $commission_id = [];
                                            
                                            foreach($check_make_1 as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                                    
                                            $make_status = "1";
                                        }
                                        else
                                        {
                                            $make_status = "0";
                                        }
                                }
                                if($make_status == "1")
                                {
                                    $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
                                    
                                    if(count($check_model) > 0)
                                    {
                                            $commission_id = [];
        									
                                            foreach($check_model as $da)
                                            {
                                                 $commission_id[] = $da->id;
                                            }
                                         $model_status = "1";
                                    }
                                    else
                                    {
                                        $check_model_1 = $this->pm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                        
                                        if(count($check_model_1) > 0)
                                        {
                                                $commission_id = [];
                                                
                                                foreach($check_model_1 as $da)
                                                {
                                                     $commission_id[] = $da->commission_id;
                                                }
                                             $model_status = "1";
                                        }
                                        else
                                        {
                                            $model_status = "0";
                                        }
                                    }
                                }
                                
                                if($make_status == "1" && $model_status == "1")
                                {
                                    $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
                                  
                                    if(count($check_varient) > 0)
                                    {
                                        $commission_id = [];
                                        
                                        foreach($check_varient as $da)
                                        {
                                             $commission_id[] = $da->id;
                                        }
                            	         $varient_status = "1";
                                    }
                                    else 
                                    {
                                      $check_varient_1 = $this->pm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$varient);
                        	           
                        	            if(count($check_varient_1) > 0)
                        	            {
                            	            $commission_id = [];
                                            foreach($check_varient_1 as $da)
                                            {
                                                 $commission_id[] = $da->commission_id;
                                            }
                        	                 $varient_status = "1";
                        	            }
                        	            else
                        	            {
                        	                 $varient_status = "0";
                        	            }
                                    }
                                }
                                
                                if($ins_classification != "")
                                {
                                   $classification = $this->pm->get_classification(array_unique($commission_id),$ins_classification,$policy_type);
                                
                                    if(count($classification > 0))
                                    {
                                       $commission_id = [];
                                       
                                       foreach($classification as $da)
                                       {
                                           $commission_id[] = $da->id;
                                       }
                                       
                                       $gvw_status = "1";
                                    }
                                }
                                else
                                {
                                   $gvw_status = "1";
                                }
        
                               $check =$this->pm->check_target_amount_already_exits_by_commission_id($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type,array_unique($commission_id));
                         
                                 if(count($check) > 0)
                                 {
                                       foreach($check as $da)
                                	   {
                                	            $g_status = "0";
                                	            $fuel_status = "0";
                                	            
                                                $temp_min = $da->min_val;
                                				$temp_max = $da->max_val;
                                				
                                				if($temp_min <= $min_amount && $temp_max >= $min_amount)
                                				{
                                					$g_status = "1";
                                				}
                                				if($temp_min <= $max_amount && $temp_max >= $max_amount)
                                				{
                                					$g_status = "1";
                                				}
                                				if($temp_min > $min_amount && $temp_max < $max_amount)
                                				{
                                					$g_status = "1";
                                				}
                                
                                                if($fuel_type == "1")
                                                {
                                                	if($da->fuel_type == "4" || $da->fuel_type == "1")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "2")
                                                {
                                                    if($da->fuel_type == "5" || $da->fuel_type == "2")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "5")
                                                {
                                                    if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "6")
                                                {
                                                    if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($fuel_type == "7")
                                                {
                                                    if($da->fuel_type == "7")
                                                	{
                                                	    $fuel_status = "1";
                                                	}
                                                }
                                                if($g_status == "1" && $fuel_status == "1")
                                    			{
                                    			    $status = "1";
                            	                    $fuel_type_status = "1";
                            	                    break;
                                    			}
                                    			else if($g_status == "0" && $fuel_status == "1")
                                    			{
                                    			    $net_status = "1";
                                    			    $commission_id = [];
                                    			    $commission_id[] = $da->id;
                                    			}
                                        }
        
                                        if($rto_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1" && $gvw_status == "1" && $status == "1")
                                        {
                                        	 echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                        }
                                        else if($net_status == "1")
                                        {
        									$get_net_id = $this->pm->get_net_id(array_unique($commission_id));
        
        									if($get_net_id != "")
        									{
        										echo json_encode(array("status"=>"success","net_id"=>$get_net_id->net_premium_id));
        									}
                                        }
                                 }
                                 else
                                 {
        								$last_net_id = $this->cm->get_last_net_premium_id();
        								
        								if($last_net_id->net_premium_id == "")
        								{
        									$com_net_premium_id = "1";
        									$arr = array("net_premium_id" => $com_net_premium_id);
        									$insert = $this->pm->add_net_premium_id($arr);
        									if( $insert ) {
                                                $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                            }
        									echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
        								}
        								else
        								{
        									$max_net_premium_id = $last_net_id->net_premium_id;
        									$com_net_premium_id = $max_net_premium_id+1;
        									$arr = array("net_premium_id" => $com_net_premium_id);
        									$insert = $this->pm->add_net_premium_id($arr);
        									if( $insert ) {
                                                $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                            }
        									echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
        								}
                                 }
                            }
                      }
                }
               else
        	   {
        	             if($commission_type == "1")
                         {
                                $check =$this->pm->check_health_this_com_already_exits($insurer_company,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date);
                                
                                foreach($check as $da)
                        		{
                            		    $temp_min = $da->no_policy_min;
                            		    $temp_max = $da->no_policy_max;
                            		    
                            		    $g_status = "0";
        
                            		    if($temp_min <= $no_policy_min && $temp_max >= $no_policy_min)
                        				{
                        					$g_status = "1";
                        				}
                        				if($temp_min <= $no_policy_max && $temp_max >= $no_policy_max)
                        				{
                        					$g_status = "1";
                        				}
                        				if($temp_min > $no_policy_min && $temp_max < $no_policy_max)
                        				{
                        					$g_status = "1";
                        				}
                        				
                            			if($g_status == "1")
                            			{
                            			    $status = "1";
                            			}
                            			else
                            			{
                            			     $commission_id[] = $da->id;
                            			}
                        		  }
                        		  
                        		  if(count($check) > 0)
                        		  {
                            		  if($status == "1")
                            		  {
                            		      echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                            		  }
                            		  else
                            		  {
                            		       $get_nop_id = $this->pm->get_no_of_policy_id($commission_id);
                                            
                                            if($get_nop_id != "")
                                            {
                                               echo json_encode(array("status"=>"success","no_of_policy_id"=>$get_nop_id->no_of_policy_id));
                                            }
                            		  }
                        		  }
                        		  else
                        		  {
                            		    $last_policy_id = $this->pm->get_last_policy_id();
                                        
                                        if($last_policy_id == "")
                                        {
                                                $com_policy_id = "1";
                                                $arr = array("policy_id" => $com_policy_id);
                                                $insert = $this->pm->add_policy_id($arr);
                                                if( $insert ) {
                                                    $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                                }
                                        }
                                        else
                                        {
                                            $max_policy_id = $last_policy_id->policy_id;
                                            $com_policy_id = $max_policy_id+1;
                                            $arr = array("policy_id" => $com_policy_id);
                                            $insert = $this->pm->add_policy_id($arr);
                                            if( $insert ) {
                                                $this->audit->log('no_of_policy', 'INSERT', null, null, $arr);
                                            }
                                        }
                                        echo json_encode(array("status"=>"success","no_of_policy_id"=>$com_policy_id));
                        		  }
                          }
                         else if($commission_type == "3")
                         {
                                $check =$this->pm->check_target_amount_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$f_date,$to_date,$add_type);
                                
                                foreach($check as $da)
                                {
                                    $temp_min = $da->min_val;
                                    $temp_max = $da->max_val;
                                    
                                    $g_status = "0";
                                
                                    if($temp_min <= $min_amount && $temp_max >= $min_amount)
                                	{
                                		$g_status = "1";
                                	}
                                	if($temp_min <= $max_amount && $temp_max >= $max_amount)
                                	{
                                		$g_status = "1";
                                	}
                                	if($temp_min > $min_amount && $temp_max < $max_amount)
                                	{
                                		$g_status = "1";
                                	}
                                	
                                	if($g_status == "1")
                                	{
                                	    $status = "1";
                                	}
                                	else
                                	{
                                	     $commission_id[] = $da->id;
                                	}
                                }
                                
                                if(count($check) > 0)
                                {
                                    if($status == "1")
                                    {
                                      echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                    }
                                    else
                                    {
                                        $get_net_id = $this->pm->get_net_id(array_unique($commission_id));
                                        
                                        if($get_net_id != "")
                                        {
                                        	echo json_encode(array("status"=>"success","net_id"=>$get_net_id->net_premium_id));
                                        }
                                    }
                                }
                                else
                                {
                                    $last_net_id = $this->cm->get_last_net_premium_id();
                                
                                    if($last_net_id->net_premium_id == "")
                                    {
                                    	$com_net_premium_id = "1";
                                    	$arr = array("net_premium_id" => $com_net_premium_id);
                                    	$insert = $this->pm->add_net_premium_id($arr);
                                    	if( $insert ) {
                                            $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                        }
                                    	echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                    }
                                    else
                                    {
                                    	$max_net_premium_id = $last_net_id->net_premium_id;
                                    	$com_net_premium_id = $max_net_premium_id+1;
                                    	$arr = array("net_premium_id" => $com_net_premium_id);
                                    	$insert = $this->pm->add_net_premium_id($arr);
                                    	if( $insert ) {
                                            $this->audit->log('net_premium', 'INSERT', null, null, $arr);
                                        }
                                    	echo json_encode(array("status"=>"success","net_id"=>$com_net_premium_id));
                                    }
                                }
                           }
                    }
        }  
        }
            
            
       public function view_health_payout_commission_entry()
       {
           if($this->session->has_userdata('logged_in')) 
        	{
        	    $ins_company = $this->input->post("ins_company");
        	    $policy_type = $this->input->post("policy_type");
        	    $business_type = $this->input->post("b_type");
        	    
        	      
        	    $s_f_date = $this->input->post("s_f_date");
        	    $s_to_date = $this->input->post("s_to_date");

        	    $res = $this->pm->view_health_payout_commission_entry($ins_company,$policy_type,$business_type,$s_f_date,$s_to_date);
        	    
        	    $content = "<style> .wrap-it{
                                            word-wrap: break-word;
                                            }
                                            *{
                                                font-weight:unset !important;
                                            }
                                            th {
                                                text-align: left;
                                            }
                                            table{
                                                width:100% !important;
                                            }
                                            td{
                                                word-wrap: break-word !important;
                                            }
                                    </style>";

        	       $content .= "<table class='table table-bordered' style='width:100%'>
    	                 <thead>
    	                    <tr>
    	                        <th>S.No</th>
                                <th>Date_Period</th>
                                <th>Commission Type</th>
                                <th>Min Slab</th>
                                <th>Max Slab</th>
                                <th>On_net</th>
                                <th>A Net</th>
                                <th>B Net</th>
                                <th>C Net</th>
                                <th>D Net</th>
                                <th>NCB</th>
                                <th>NCB (%)(A/B/C/D)</th>
                                <th>Action_Record</th>
                            </tr>
    	                 </thead>";
    	           
    	           $a = 0;      
    	                 
    	           foreach($res as $da)
    	           { 
    	               $a++;
    	               
    	                    $title = $da->company_name." / ".$da->p_type." / ".$da->b_type." / ".$da->commission_state;
    	               
        	                $content .= "
        	                <tbody>
                            <tr>
                                <td>".$a."</td>
                                <td>".date_format(date_create($da->from_date),"d-m")." - ".date_format(date_create($da->to_date),"d-m")."</td>";
                                $content .="<td>". $da->ctype."</td>";
                                
                                if($da->commission_type == "1")
                                {
                                    $content .="<td>". $da->no_policy_min."</td>
                                                <td>". $da->no_policy_max."</td>";
                                }
                                else
                                {
                                     $content .="<td>".$da->min_val."</td>
                                                 <td>".$da->max_val."</td>";
                                }
                                
                            $content .="
                                <td>".$da->on_net."</td>
                                <td>".$da->a_net."</td>
                                <td>". $da->b_net."</td>
                                <td>".$da->c_net."</td>
                                <td>".$da->d_net."</td>
                                <td>".$da->is_ncb."</td>
                                <td>".$da->a_ncb." / ".$da->b_ncb."/".$da->c_ncb."/".$da->d_ncb."</td><td>";
                            // if($da->from_date>date("Y-m-d")){
                                $content .= "<button class='btn btn-warning btn-xs' onclick=edit_health_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> </button>&nbsp;&nbsp;
                                          ";  
                            // }
                            $content .= "<button class='btn btn-warning btn-xs' onclick=health_forward(".$da->id.")><i class='fa fa-forward'></i></td></tr>";
    	           }
    	           
    	          // <button class='btn btn-danger btn-xs' onclick=delete_health_data(".$da->id.")><i class='fa fa-trash-o'></i> </button>&nbsp;&nbsp;
    	            $content .= "</tbody>
    	             </table>";
    	             echo json_encode(array("content" =>$content,"title" =>$title));
        	   }
       }
       
        public function edit_commission_entry_health()
        {
            if($this->session->has_userdata('logged_in')) 
            { 
                $id = $this->input->post("id");
                $res = $this->pm->edit_health_commission_entry($id);
                echo json_encode($res);
            }
        }
        
        // include rtos
        
         public function include_rtos()
         {
              if($this->session->has_userdata('logged_in')) 
              {
                    $state = $this->input->post("state");
                    $from_date = $this->input->post("f_date");
                    $to_date = $this->input->post("to_date");
                    $rto_type = $this->input->post("rto_type");
                    $rto = $this->input->post("rto");
                    
                    $res = $this->pm->get_state_wise_payout_commission($state,$from_date,$to_date,$rto_type);
                    
                    foreach($res as $da)
                    {
                        $data = array("commission_id" =>$da->id,"rto" =>$rto);
                        $res = $this->pm->insert_rto($data);
                        if( $res ){
                            $this->audit->log('commission_rto_log', 'INSERT', null, null, $data);
                        }
                    }
                  echo "success";
              }
         }
         
         
         // Extra commission
         
         public function extra_payout()
         {
              if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
                {    		
                    $pro_data["project_info"] = $this->mm->fetch_project_info();
                    $data["policy_type"] = $this->pm->fetch_policy_type();
                    $data["cover"] = $this->pm->get_policy_cover_type();
                    $data["agents"] = $this->pm->get_pos_and_agents();
                    $data["insurer_company"] = $this->cm->get_insurer_company();
                    $this->load->view('header',$pro_data);
                    $this->load->view('extra_commission',$data);
                    $this->load->view('footer',$pro_data);
                }
         }
         
         public function add_extra_com_details()
         {
             if($this->session->has_userdata('logged_in')) 
             { 
                $insurer = $this->input->post("insurer");
                $agent = $this->input->post("agent");
                $month = $this->input->post("month");
                $policy_type = $this->input->post("policy_type");
                $policy_c_type = $this->input->post("policy_c_type");
                $target = $this->input->post("target");
                $target_value = $this->input->post("target_value");
                $com_percentage = $this->input->post("com_per");
                $remarks = $this->input->post("remarks");   
                $date =$month."-01";
                $check = $this->pm->check_extra_com_already_exits($agent,$date,$policy_type,$policy_c_type);
              
                if($check > 0)
                {
                    echo "exits";
                }
                else 
                {
                    $data = array(
                                   "insurer"  =>$insurer,
                                   "agent_id" =>$agent,
                                   "month" =>$date,
                                   "target" =>$target,
                                   "target_val" =>$target_value,
                                   "remarks" =>$remarks,
                                   "extra_com" =>$com_percentage,
                                   "created_by" =>$this->session->userdata("session_id"),
                                   "created_date" =>date("Y-m-d H:i:s"),
                              );
                              
                    $res = $this->pm->add_extra_commission_payout($data);
                    if( $res ){
                        $this->audit->log('extra_commission', 'INSERT', null, null, $data);
                    }
                
                    $data_1 = array(
                                       "com_id" =>$res,
                                       "policy_type" =>$policy_type,
                                       "created_by" =>$this->session->userdata("session_id"),
                                       "created_date" =>date("Y-m-d H:i:s"),
                                  );
                  
                    $res_1 = $this->pm->extra_commission_policy_type($data_1);
                    if( $res_1 ){
                        $this->audit->log('extra_commission_policy_types', 'INSERT', null, null, $data_1);
                    }

                    
                    $data_2 = array(
                           "com_id" =>$res,
                           "policy_cover" =>$policy_c_type,
                      );
                    $res_2 = $this->pm->extra_commission_policy_covers($data_2);
                    if( $res_2 ){
                        $this->audit->log('extra_commission_covers', 'INSERT', null, null, $data_2);
                    }
                    echo "success";
                }
            
             }
         }
         
         
        public function fetch_extra_commission()
        {
            if($this->session->has_userdata('logged_in')) 
            {
                $draw = intval($this->input->post("draw"));
                
                $res = $this->pm->fetch_extra_commission();
            
                $arr = [];
                $a = 0 ;
                
                foreach($res as $da)
                {
                    $a++;
                    
                
                   $view = "<a href='#' onclick=view_data(".$da->agent_id.")>".$da->agn_name ."  (".$da->agn_code.")"."</a>";
                  
                    $arr[] = array(
                        $a,
                        $view,
                        $da->company,
                        date_format(date_create($da->month),"M-Y"),
                        $da->target,
                        $da->target_val,
                        $da->created_name,
                        date_format(date_create($da->created_date),"d-m-Y h:i:s a"),
                    );
                }
                
                $result = array(
                	"draw"=> $draw,
                    "recordsTotal"=>count($res),
                    "recordsFiltered"=> count($res),
                    "data"=>$arr,
                );
                echo json_encode($result);
             }
        }
        
     public function fetch_agent_extra_com_details()
     {
         if($this->session->has_userdata('logged_in')) 
         {
                 $agent_id = $this->input->post("id");
                 $month = "2022-10-01"; //$this->input->post("month");
                 
                 $res = $this->pm->fetch_agent_extra_com_details($agent_id,$month);
                 

                 $content = "";
                 $content .="<table class='table table-bordered'>
                                <thead>
                                       <tr>
                                           <th>S.no</th>
                                           <th>Policy Type</th>
                                           <th>Policy Covers</th>
                                           <th>Target Type</th>
                                           <th>Target Value</th>
                                           <th>Extra Com(%)</th>
                                           <th>Date</th>
                                           <th>Action</th>
                                       </tr>
                                </thead><tbody>";
                 
                 
                 $a = 0;
                 
                 foreach($res as $da)
                 {
                     $a++;
                     
                         
                 $action = "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i></button> 
                    	 <button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i></button>";
                     
                     $res_1 = $this->pm->get_policy_cover_types($da->id);
                     $content .="<tr>
                                         <td>".$a."</td>
                                         <td>".$da->p_type."</td>
                                         <td>".$res_1->pc_name."</td>
                                         <td>".$da->target."</td>
                                         <td>".$da->target_val."</td>
                                         <td>".$da->extra_com."(%)</td>
                                         <td>".date_format(date_create($da->created_date),"d-m-Y h:i:s a")."</td>
                                         <td>".$action."</td>
                                 </tr>";
                 }
                  $content .="</tbody></table>";
                  echo $content;
         }
     }
     
     
     
    function update_commission_by_policy($lead_id) {
        
        if( isset( $lead_id ) && !empty( $lead_id ) )
        {
            
            //$result = $this->cm->get_active_policy_details_fortc($fromdate = '', $todate = '', $lead_id, $agent_id = '', $insure_id = '');
            $result = $this->cm->getActivePolicyDetailsFortc($fromdate = '', $todate = '', $lead_id, $agent_id = '', $insure_id = '');
            
            if( empty( $result[0] ) ){
                return ;
            }
            
            $policy = $result[0];
            
        //  $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
         
        	if( isset( $policy ) && !empty( $policy ) )
        	{
        		/*foreach($check_rto as $rt)
        		{
        			$com_id = $rt->commission_id;
        		}*/
        		/*$data1 = array("commission_id"=>$policy->commission_id,"com_trigger_status" => "1","com_trigger_date" =>date("Y-m-d"));
        		$update = $this->cm->update_commissions($data1,$re->id);*/
        		
        // 		$commission_id = $com_id;
        
                
                $total_premium = $policy->total_premium;
        		$own_damage = $policy->total_own_damage;
        		$no_claim_bonus = $policy->no_claim_bonus;
        		$tp = $policy->tot_liability_premium;
        		
        		$cpa = $policy->cpa; // 2023-05-26 start
        		
        		$res123 = $this->lm->fetch_policy_info($policy->commission_id);
        		$agn_commission_type = $res123->agn_com_type ;
        		
        		$ird_od_commission = (isset($res123->ird_od_commission) && ($res123->ird_od_commission) > 0) ? $res123->ird_od_commission : 0;
        		$ird_tp_commission = (isset($res123->ird_tp_commission) && ($res123->ird_tp_commission) > 0) ? $res123->ird_tp_commission : 0;
        		
        		$jayantha_commission = $jayantha_agent_commission = 0;
        		if( isset( $policy->class ) && !empty( $policy->class ) && $policy->class == "1" ) {
            		if($agn_commission_type != "TP")
            		{
            			$jayantha_commission = ($own_damage * $ird_od_commission)/100;
            			$jayantha_agent_commission = ($own_damage * $ird_od_commission)/100;
            		}
            		if($agn_commission_type != "OD")
            		{
            			$jayantha_commission = $jayantha_commission + (($tp * $ird_tp_commission)/100);   
            		}
            		
            		if($agn_commission_type == "ON-NET" && empty($ird_od_commission) && empty($ird_tp_commission))
                    {
                        $ird_commission = (isset($res123->ird_commission_percentage) && ($res123->ird_commission_percentage) > 0) ? $res123->ird_commission_percentage : $res123->on_net;;
                        $jayantha_commission = ($total_premium * $ird_commission)/100;
                        $jayantha_agent_commission = ($total_premium * $ird_commission)/100;   
                    }
        		}
        		
        		$res = $this->lm->fetch_policy_info($policy->commission_id);
        		$commission_type = $res->commission_type;
        		
        		if( isset( $policy->class ) && !empty( $policy->class ) && $policy->class == "2" ) {
        		    if( isset( $agn_commission_type ) && $agn_commission_type == '' ) {
        		        $res->agn_com_type = $agn_commission_type = "ON-NET";
        		    }
        		    
        		    $ird_commission = (isset($res123->ird_commission_percentage) && ($res123->ird_commission_percentage) > 0) ? $res123->ird_commission_percentage : $res123->on_net;
                    $jayantha_commission = ($total_premium * $ird_commission)/100;
                    $jayantha_agent_commission = ($total_premium * $ird_commission)/100;
        		}
        		
        		$spl_com = $this->lm->check_spl_commission_for_agent($policy->commission_id,$policy->policy_agency_pos); 
         
        		if( isset( $res ) && !empty($res) && (in_array($res->commission_type, ['1','2','3'])) )
        		{
                    $comtypes = [
                        'OD'        => $own_damage,
                        'TP'        => $tp,
                        'ON-NET'    => $total_premium,
                        'OD_AND_TP' => $total_premium
                    ];
                    $ncategories = [
                        'A' => $res->a_ncb,
                        'B' => $res->b_ncb,
                        'C' => $res->c_ncb,
                        'D' => $res->d_ncb
                    ];
                    
                    $capcategories = [
                        'A' => $res->a_cpa,
                        'B' => $res->b_cpa,
                        'C' => $res->c_cpa,
                        'D' => $res->d_cpa
                    ];
                    
                    $commission_categories = [
                        'OD' => [
                            'A' => $res->a_od,
                            'B' => $res->b_od,
                            'C' => $res->c_od,
                            'D' => $res->d_od,
                        ],
                        'TP' => [
                            'A' => $res->a_tp,
                            'B' => $res->b_tp,
                            'C' => $res->c_tp,
                            'D' => $res->d_tp,
                        ],
                        'ON-NET' => [
                            'A' => $res->a_net,
                            'B' => $res->b_net,
                            'C' => $res->c_net,
                            'D' => $res->d_net,
                        ],
                        /*
                        'OD_AND_TP' => [
                            'A' => [$res->a_od, $res->a_tp],
                            'B' => [$res->b_od, $res->a_tp],
                            'C' => [$res->c_od, $res->a_tp],
                            'D' => [$res->d_od, $res->a_tp],
                        ],*/
                    ];
                    
                    $agent_status = $this->lm->fetch_agent_category($policy->policy_agency_pos);
                    //echo '<pre>';print_r($agent_status);print'</pre>';
        				if($res->is_ncb == "Yes" && $no_claim_bonus == "Yes")
        				{
        					$status = "1";
        					$company_com = $total_premium * ($res->ncb_percentage)/100;
        					
        					   if( isset( $spl_com ) && !empty( $spl_com ) )
        					   {
        					       if( isset( $comtypes[$res->agn_com_type] ) && !empty( $comtypes[$res->agn_com_type] ) )
        					       {
        					           $agent_commission = ($comtypes[$res->agn_com_type] * $spl_com->special_com)/100;
        					       }
        					   }
        					   else
        					   {
                                    if( isset( $ncategories[$agent_status->commission_category] ) && !empty( $ncategories[$agent_status->commission_category] ) )
                                    {
                                        $agent_commission = ($total_premium * $ncategories[$agent_status->commission_category])/100;
                                    }
        					   }
        				}
        				else if($res->is_cpa == "Yes" && $cpa == "Yes") { // 2023-05-26 start
        					$status = "1";
        					$company_com = $total_premium * ($res->cpa_percentage)/100;
        					
        					   if( isset( $spl_com ) && !empty( $spl_com ) )
        					   {
        					       if( isset( $comtypes[$res->agn_com_type] ) && !empty( $comtypes[$res->agn_com_type] ) )
        					       {
        					           $agent_commission = ($comtypes[$res->agn_com_type] * $spl_com->special_com)/100;
        					       }
        					   }
        					   else
        					   {
                                    if( isset( $cpacategories[$agent_status->commission_category] ) && !empty( $cpacategories[$agent_status->commission_category] ) )
                                    {
                                        $agent_commission = ($total_premium * $cpacategories[$agent_status->commission_category])/100;
                                    }
        					   }
        				}
        				else
        				{
        					if($res->on_net != "0")
        					{
        						$own_od = "";
        						$own_tp = "";
        						$company_com = $total_premium * ($res->on_net)/100;
        						$on_net = $company_com;
        					}
        					else if($res->own_od != "0" && $res->own_tp != "0")
        					{
        						$own_od = $own_damage * ($res->own_od)/100;
        						$own_tp = $tp * ($res->own_tp)/100;
        						$company_com = $own_od+$own_tp;
        						$on_net = "";
        					}
        					else if($res->own_od != "0")
        					{
        						$on_net = ""; 
        						$own_tp = "";
        						$company_com = $own_damage * ($res->own_od)/100;
        						$own_od = $company_com;
        					}
        					else if($res->own_tp != "0")
        					{
        						$own_od = ""; 
        						$on_net = "";
        						$company_com = $tp * ($res->own_tp)/100;
        						$own_tp = $company_com;
        					}
        				
        				   if( isset( $spl_com ) && !empty( $spl_com ) )
        				   {
        				       if( isset( $comtypes[$res->agn_com_type] ) && !empty( $comtypes[$res->agn_com_type] ) )
    					       {
    					           $agent_commission = ($comtypes[$res->agn_com_type] * $spl_com->special_com)/100;
    					       }
        				   }
        				   else
        				   {
    						      if(isset($commission_categories[$res->agn_com_type][$agent_status->commission_category]) && !empty($commission_categories[$res->agn_com_type][$agent_status->commission_category])) {
    						          
    						          $percent = $commission_categories[$res->agn_com_type][$agent_status->commission_category];
    						          
    						          $agent_commission = ($comtypes[$res->agn_com_type] * $percent)/100;
    						          
    						      }
        						  else if($res->agn_com_type == "OD_AND_TP")
        						  {
        							  if($agent_status->commission_category == "A")
        							  {
        								  $agent_od = ($own_damage * $res->a_od)/100;
        								  $agent_tp = ($tp * $res->a_tp)/100;
        								  $agent_commission = $agent_od+$agent_tp;
        							  }
        							  else if($agent_status->commission_category == "B")
        							  {
        								  $agent_od = ($own_damage * $res->b_od)/100;
        								  $agent_tp = ($tp * $res->b_tp)/100;
        								  $agent_commission = $agent_od+$agent_tp;
        							  }
        							  else if($agent_status->commission_category == "C")
        							  {
        								  $agent_od = ($own_damage * $res->c_od)/100;
        								  $agent_tp = ($tp * $res->c_tp)/100;
        								  $agent_commission = $agent_od+$agent_tp;
        							  }
        							  else if($agent_status->commission_category == "D")
        							  {
        								  $agent_od = ($own_damage * $res->d_od)/100;
        								  $agent_tp = ($tp * $res->d_tp)/100;
        								  $agent_commission = $agent_od+$agent_tp;
        							  }
        						 }
        				   }
        			 }
        			
        			 if( isset( $policy->class ) && !empty( $policy->class ) && in_array($policy->class, ['1', '2']) ) {
        				if($company_com <= $jayantha_commission)
        				{
        					$jayantha_commission = $company_com;
        					$company_com = 0;
        				}
        				else
        				{
        					 $company_com = (float)$company_com - (float)$jayantha_commission;
        				}
        				if($agent_commission <= $jayantha_agent_commission)
        				{
        					   $jayantha_agent_commission = $agent_commission;
        					   $agent_commission = 0;
        				}
        				else
        				{
        				    
        					$agent_commission = (float)$agent_commission - (float)$jayantha_agent_commission;
        				}
        				
        			} elseif( isset( $policy->class ) && !empty( $policy->class ) && $policy->class == "-2" ) {
                        $jayantha_commission = $company_com;
    					$jayantha_agent_commission = $agent_commission;
					    $agent_commission = $company_com = 0;
                    } 
        				
        				$_policies = $this->lm->get_policy_details($lead_id);
        				
        				$data12 = array("agent_commission"=> $agent_commission,
        								"agent_commission_amt"=> $jayantha_agent_commission,
        								"own_commission_amt"=> $jayantha_commission,
        								"own_commission"=> $company_com,
        								"calc_com_status" =>"1");
        				
        				// New
        				$data = []; $agn_status = $comp_status = "N";
        				if($policy->vocher_status == '0'){
        				    $data   = [
        				        'agent_commission_amt'  => $jayantha_agent_commission, 
        				        'agent_commission'      => $agent_commission
        				    ];
        				    $agn_status = "Y";
        				}
        				if($policy->company_vocher_status == '0') {
        				    $data['own_commission_amt'] = $jayantha_commission;
        				    $data['own_commission']     = $company_com;
        				    $comp_status                = 'Y';
        				}				
        				echo '<pre>';print_r($data);print'</pre>';
        				
        				if( isset( $data ) && !empty( $data ) ) {
        				    $data['calc_com_status'] = '1';
        				    $update = $this->cm->update_commissions_by_lead_id($data,$lead_id);
        				    if( $update ) {
                	            $this->audit->log('policy_info', 'UPDATE', null, $_policies, $data);
                	        }
        				}
        				
        				if( $agn_status == "Y") {
        				    // Jantha Agent Commission
        				    
        				    //Credit
        				    $agc_credit = array(
            					'credit'=>$jayantha_agent_commission,
            				);
            				
            				$agc_credit_data = $this->cm->getAccountsByLead($lead_id, 'Agent commission Credit', 'acc_commission_ledger');
        				
            				$agc_credit_res = $this->cm->accouts_update($agc_credit,'jayantha',$lead_id,'Agent commission Credit');
            				
            				if( $agc_credit_res ) {
                	            $this->audit->log('acc_commission_ledger', 'UPDATE', null, $agc_credit_data, $agc_credit);
                	        }
                	        
                	        //Debit
                	        $agc_debit = array(
            					'debit'=>$jayantha_agent_commission,
            				);
            				
                	        $agc_debit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Debit', 'acc_commission_ledger');
                	        
                	        $agc_credit_res = $this->cm->accouts_update($agc_debit,'jayantha',$lead_id,'Own commission Debit');
                	        
                	        if( $agc_credit_res ) {
                	            $this->audit->log('acc_commission_ledger', 'UPDATE', null, $agc_debit_data, $agc_debit);
                	        }
                	        
                	        // Unicorn Agent Commission
                	        //Credit
                	        $agc_credit = array(
            					'credit'=>$agent_commission,
            				);
            				
            				$oagc_credit_data = $this->cm->getAccountsByLead($lead_id, 'Agent commission Credit', 'acc_commission_ledger_orc');
        				
            				$oagc_credit_res = $this->cm->accouts_update($agc_credit,'unicorn',$lead_id,'Agent commission Credit');
            				
            				if( $agc_credit_res ) {
                	            $this->audit->log('acc_commission_ledger_orc', 'UPDATE', null, $oagc_credit_data, $agc_credit);
                	        }
                	        
                	        //Debit
                	        $agc_debit = array(
            					'debit'=>$agent_commission,
            				);
                	        $oagc_debit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Debit', 'acc_commission_ledger_orc');
                	        
            				$oagc_debit_res = $this->cm->accouts_update($agc_debit,'unicorn',$lead_id,'Own commission Debit');
            				
            				if( $oagc_debit_res ) {
                	            $this->audit->log('acc_commission_ledger_orc', 'UPDATE', null, $oagc_debit_data, $agc_debit);
                	        }
        				}
        				
        				if($comp_status == "Y") {
        				    // Jantha Own Commission
        				    // Credit
        				    $com_credit = array(
            					'credit'=>$jayantha_commission,
            				);
        				    $com_credit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Credit', 'acc_commission_ledger');
            	        
                	        $com_credit_res = $this->cm->accouts_update($com_credit,'jayantha',$lead_id,'Own commission Credit');
                	        
                	        if( $com_credit_res ) {
                	            $this->audit->log('acc_commission_ledger', 'UPDATE', null, $com_credit_data, $com_credit);
                	        }
                	        
                	        // Unicorn Own Commission
                	        // Credit
                	        $com_credit = array(
            					'credit'=>$company_com,
            				);
            				
            				$ocom_credit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Credit', 'acc_commission_ledger_orc');
        				
            				$ocom_credit_res = $this->cm->accouts_update($com_credit,'unicorn',$lead_id,'Own commission Credit');
            				
            				if( $ocom_credit_res ) {
                	            $this->audit->log('acc_commission_ledger_orc', 'UPDATE', null, $ocom_credit_data, $com_credit);
                	        }
        				}
/*        				
        				$update = $this->cm->update_commissions_by_lead_id($data,$lead_id);
        				if( $update ) {
            	            $this->audit->log('policy_info', 'UPDATE', null, $_policies, $data);
            	        }
        				$agc_credit = array(
        					'credit'=>$jayantha_agent_commission,
        				);
        				$agc_debit = array(
        					'debit'=>$jayantha_agent_commission,
        				);
        				$com_credit = array(
        					'credit'=>$jayantha_commission,
        				);
        				
        				
        				$agc_credit_data = $this->cm->getAccountsByLead($lead_id, 'Agent commission Credit', 'acc_commission_ledger');
        				
        				$agc_credit_res = $this->cm->accouts_update($agc_credit,'jayantha',$lead_id,'Agent commission Credit');
        				
        				if( $agc_credit_res ) {
            	            $this->audit->log('acc_commission_ledger', 'UPDATE', null, $agc_credit_data, $agc_credit);
            	        }
            	        
            	        $agc_debit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Debit', 'acc_commission_ledger');
            	        
            	        $agc_credit_res = $this->cm->accouts_update($agc_debit,'jayantha',$lead_id,'Own commission Debit');
            	        
            	        if( $agc_credit_res ) {
            	            $this->audit->log('acc_commission_ledger', 'UPDATE', null, $agc_debit_data, $agc_debit);
            	        }
            	        
            	        $com_credit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Credit', 'acc_commission_ledger');
            	        
            	        $com_credit_res = $this->cm->accouts_update($com_credit,'jayantha',$lead_id,'Own commission Credit');
            	        
            	        if( $com_credit_res ) {
            	            $this->audit->log('acc_commission_ledger', 'UPDATE', null, $com_credit_data, $com_credit);
            	        }
        				
        				$agc_credit = array(
        					'credit'=>$agent_commission,
        				);
        				$agc_debit = array(
        					'debit'=>$agent_commission,
        				);
        				$com_credit = array(
        					'credit'=>$company_com,
        				);
        				        			        				
        				$oagc_credit_data = $this->cm->getAccountsByLead($lead_id, 'Agent commission Credit', 'acc_commission_ledger_orc');
        				
        				$oagc_credit_res = $this->cm->accouts_update($agc_credit,'unicorn',$lead_id,'Agent commission Credit');
        				
        				if( $agc_credit_res ) {
            	            $this->audit->log('acc_commission_ledger_orc', 'UPDATE', null, $oagc_credit_data, $agc_credit);
            	        }
            	        
            	        $oagc_debit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Debit', 'acc_commission_ledger_orc');
            	        
        				$oagc_debit_res = $this->cm->accouts_update($agc_debit,'unicorn',$lead_id,'Own commission Debit');
        				
        				if( $oagc_debit_res ) {
            	            $this->audit->log('acc_commission_ledger_orc', 'UPDATE', null, $oagc_debit_data, $agc_debit);
            	        }
        				
        				$ocom_credit_data = $this->cm->getAccountsByLead($lead_id, 'Own commission Credit', 'acc_commission_ledger_orc');
        				
        				$ocom_credit_res = $this->cm->accouts_update($com_credit,'unicorn',$lead_id,'Own commission Credit');
        				
        				if( $ocom_credit_res ) {
            	            $this->audit->log('acc_commission_ledger_orc', 'UPDATE', null, $ocom_credit_data, $com_credit);
            	        }
*/        				
        				
        				return;
        		}
        			
        		
        	}
        }
    }
    
    
    

    
}