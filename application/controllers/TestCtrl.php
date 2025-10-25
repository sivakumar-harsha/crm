<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class LeadCtrl extends CI_Controller {
     public $pm;
    public $lm;
    public $mm;
    public $tm;
    public $db;
     public $auth;
    public $audit;
    public $cookie;
    public $url;
    public $db;
    public $database;
    public $session;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('PayoutMod','pm');
		$this->load->model('LeadMod','lm');
		$this->load->model('MasterMod','mm');
		$this->load->model('TestMod','tm');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('cookie');
	}
    public function trigger_accounts_table(){
        if($this->session->has_userdata('logged_in')) 
    	{
    	    $data = $this->tm->get_unaccounts_data();
    	}
    }
       public function check_commission_status()
       {
            if($this->session->has_userdata('logged_in')) 
        	{
        	     $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
        	     
        	    if($check_user_i->policy_add == "1")
    	        {   
                   $policy_no = $this->input->post("policy_no");
                   $client_type = $this->input->post("client_type");
                   $client_name = $this->input->post("client_name");
                   $mobile_no = $this->input->post("mobile_no");
                   $pin = $this->input->post("pin_code");
                   $policy_source = $this->input->post("policy_source");
                   $lead_created_by = $this->session->userdata('session_name');
                   $rto = $this->input->post("rto");
                   $age = $this->input->post("age");
                   $nominee_name = $this->input->post("nominee_name");
                   $adharcard_no = $this->input->post("adharcard_no");
                   $n_mobile_no = $this->input->post("n_mobile_no");
                   $n_adhar_card_upload = $this->input->post("n_adhar_card_upload");
                   $register_no = $this->input->post("vechi_register_no");
                   $year_of_manu = $this->input->post("vechi_manu_year");
                   $engine_num = $this->input->post("vechi_engine_num");
                   $fuel_type = $this->input->post("fuel_type");
                   $cc  = $this->input->post("vechi_cc");
                   $v_gvw = $this->input->post("v_gvw");
                   
                   $lead_id = $this->input->post("lead_id");
                   $get_lead_info = $this->lm->get_lead_info($lead_id);
                   
                   $bussiness_type = $get_lead_info->business_type;
                   $policy_premium= $this->input->post("policy_premium");
                   $policy_class = $get_lead_info->class;
                   $policy_type =  $get_lead_info->policy_type;
                   $policy_agency_pos = $this->input->post("policy_agency_pos");
                   $state = $get_lead_info->state;
                   $company = $this->input->post("company");
                   $rto = $get_lead_info->rto;
                   $manufacture = "01-".$get_lead_info->vechi_manu_month."-".$get_lead_info->vechi_manu_year;
                   $today = date("Y-m-d");
                   $diff = date_diff(date_create($manufacture), date_create($today));
                   $age = $diff->format('%y');
                   $fuel_type = $get_lead_info->vechi_fuel_type;
                   $cc  = $get_lead_info->vechi_cc;
                   $v_gvw = $get_lead_info->vechi_gvw;
                 
                   $make = $get_lead_info->vechi_make;
                   $model = $get_lead_info->vechi_model;
                   $Varient = $get_lead_info->vechi_varient;
                   
                   $total_premium =$this->input->post("total_premium");
                 
                    $commission_id = [];
                    $status = "0";
                    $make_status = "0";
                    $model_status = "0";
                    $varient_status = "0";
                    $rto_status = "0";
                    $gvw_status = "0";
                    $fuel_status = "0";

                   $check = $this->lm->check_this_nop_already_exits($company,$policy_premium,$policy_class,$bussiness_type,$policy_type,$state);
                   
                    foreach($check as $da)
                    {
                        if($da->class == "1" && $da->commission_type == "2")
                        {
                    	    foreach($check as $da)
                    		{
                        		    $temp_min = $da->vehicle_age_min;
                        		    $temp_max = $da->vehicle_age_max;
                        		    $commission_id[] = $da->id;
                        		    
                    				if($temp_min <= $age && $temp_max >= $age)
                    				{
                    					$status = "1";
                    				}
                    			
                    			if($fuel_type == "1")
                    			{
                    				if($da->fuel_type != "4" || $da->fuel_type != "1")
                    				{
                    				    $fuel_status = 1;
                    				}
                    			}
                    			if($fuel_type == "2")
                    			{
                    			    if($da->fuel_type != "4" || $da->fuel_type != "2")
                    				{
                    				    $fuel_status = 1;
                    				}
                    			}
                    			if($fuel_type == "5")
                    			{
                    			    if($da->fuel_type != "5")
                    				{
                    				    $fuel_status = 1;
                    				}
                    			}
                    			
                    			if($da->fuel_type == "6")
                    			{
                    				    $fuel_status = 1;
                    			}
                    		 }
                		 
                    		if($status == "1")
                    		{
                    		    if($policy_type == "1" ||  $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
                    		    {
                                	   foreach($check as $da)
                                		{
                                		    if($da->classification != "")
                                		    {
                                                $classification = $this->lm->get_classification($da->classification,$policy_type);
                                                if($classification != null)
                                                {
                                                    $temp_min = $classification->from_gvw_cc;
                                                    $temp_max = $classification->to_gvw_cc;
                                                }
                                                else
                                                {
                                                    $temp_min = 0;
                                                    $temp_max = 0;
                                                }
                                                if($temp_min <= $cc && $temp_max >= $cc)
                                                {
                                                    $gvw_status = "1";
                                                }
                                		    }
                                		    else
                                		    {
                                		        $gvw_status = "1";
                                		    }
                                		 }
                    		    }
                    		    else
                    		    {
                    		         foreach($check as $da)
                                	 {
                                	       if($da->classification != "")
                                    		 {
                                                $classification = $this->lm->get_classification($da->classification,$policy_type);
                                                $temp_min = $da->from_gvw_cc;
                                                $temp_max = $da->to_gvw_cc;
                                                
                                                if($temp_min <= $v_gvw && $temp_max >= $v_gvw)
                                                {
                                                    $gvw_status = "1";
                                                }
                                		  }
                                		  else
                                		  {
                                		      $gvw_status = "1";
                                		  }
                                	  }
                    		    }
                    		    
                    		      $check_make = $this->lm->check_make_all_already_exits($commission_id,$policy_type);

                                    if($check_make != null)
                                    {
                                       $status = "1";
                                        $make_status = "1";
                                        $commission_id = [];
                            		          
                        		          foreach($check_make as $da)
                        		          {
                        		              $commission_id[] = $da->id;
                        		          }
                                     }
                                    else
                                    {
                                          $check_make_1 = $this->lm->check_make_already_exits($commission_id,$policy_type,$make);
                            		       
                            		        if($check_make_1 != "" || $check_make_1 != null)
                            		        {
                            		            $status = "1";
                            		            
                            		            $make_status = "1";
                            		            
                                		          $commission_id = [];
                                		          
                                		          foreach($check_make_1 as $da)
                                		          {
                                		              $commission_id[] = $da->commission_id;
                                		          }
                            		        }
                            		        else
                            		        {
                            		            $make_status = "0";
                            		        }
                                    }
                                   
                    		        if($make_status == "1")
                    		        {
                    		            $check_model = $this->lm->check_model_all_already_exits($commission_id,$policy_type);
                                        
                                        if($check_make != null)
                                        {
                                             $status = "1";
                                             $model_status = "1";
                                             $commission_id = [];
                                             
                            		          foreach($check_model as $da)
                            		          {
                            		              $commission_id[] = $da->id;
                            		          }
                                        }
                                        else
                                        {
                        		            $check_model_1 = $this->lm->check_model_already_exits($commission_id,$policy_type,$make,$model);
                        		            
                        		            if($check_model_1 != "" || $check_model_1 != null)
                        		            {
                        		                  $status = "1";
                        		                  $model_status = "1";
                            		               $commission_id = [];
                                		          foreach($check_model_1 as $da)
                                		          {
                                		              $commission_id[] = $da->commission_id;
                                		          }
                        		            }
                        		            else
                        		            {
                        		                $model_status = "0";
                        		            }
                                        }
                    		        }
                    		       
                    		        if($make_status == "1" && $model_status == "1")
                    		        {
                    		            $check_varient = $this->lm->check_varient_all_already_exits($commission_id,$policy_type);
                    		            
                                        if($check_varient != null)
                                        {
                                             $status = "1";
                                	         $varient_status = "1";
                                	         
                                	          $commission_id = [];
                                	          
                            		          foreach($check_varient as $da)
                            		          {
                            		              $commission_id[] = $da->id;
                            		          }
                                        }
                                        else 
                                        {
                    		                 $check_varient_1 = $this->lm->check_varient_already_exits($commission_id,$policy_type,$make,$model,$Varient);
                            		            
                            		            if($check_varient_1 != null)
                            		            {
                            		                 $status = "1";
                            		                 $varient_status = "1";
                                    		          $commission_id = [];
                                    		          foreach($check_varient_1 as $da)
                                    		          {
                                    		              $commission_id[] = $da->commission_id;
                                    		          }
                            		            }
                            		            else
                            		            {
                            		                 $varient_status = "0";
                            		            }
                                        }
                    		        }
                    		       
                    		        if($status == "1" && $fuel_status =="1" && $gvw_status =="1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                    		        {
                                        $check_rto = $this->lm->check_rto_already_exits($commission_id,$rto);
                                        
                                            if(count($check_rto) > 0)
                                            {
                                                $rto_status == "1";
                                                $data_arr = array("status"=>"success","id"=>$check_rto->commission_id);
                                                echo json_encode($data_arr);
                                                die();
                                            }
                                            else
                                            {
                                                  $data_arr = array("status"=>"no");
                                            }
                    		        }
                    		        else
                    		        {
                    		            $data_arr = array("status"=>"no");
                    		        }
                    		  }
                          else
                          {
                              $data_arr = array("status"=>"no");
                          }
                        }
                        else if($da->class == "1" && $da->commission_type == "1")
                        {
                             $res ="";
                            
                            if(count($check) > 0)
                            {
                                foreach($check as $da)
                                {
                                   $commission_id[] = $da->id;
                                   
                                   $status = "1";
                                   
                                   if($fuel_type == "1")
                        			{
                        				if($da->fuel_type != "4" || $da->fuel_type != "1")
                        				{
                        				    $fuel_status = 1;
                        				}
                        			}
                        			if($fuel_type == "2")
                        			{
                        			    if($da->fuel_type != "4" || $da->fuel_type != "2")
                        				{
                        				    $fuel_status = 1;
                        				}
                        			}
                        			if($fuel_type == "5")
                        			{
                        			    if($da->fuel_type != "5")
                        				{
                        				    $fuel_status = 1;
                        				}
                        			}
                                }
                                
                                if($status == "1")
                        		{
                        		    if($policy_type == "1" ||  $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
                        		    {
                                    	   foreach($check as $da)
                                    		{
                                    		    if($da->classification != "")
                                    		    {
                                                    $classification = $this->lm->get_classification($da->classification,$policy_type);
                                                    $temp_min = $da->from_gvw_cc;
                                                    $temp_max = $da->to_gvw_cc;
                                                    if($temp_min <= $cc && $temp_max >= $cc)
                                                    {
                                                        $gvw_status = "1";
                                                    }
                                    		    }
                                    		    else
                                    		    {
                                    		        $gvw_status = "1";
                                    		    }
                                    		 }
                        		    }
                        		    else
                        		    {
                        		         foreach($check as $da)
                                    	 {
                                    	       if($da->classification != "")
                                        		 {
                                                    $classification = $this->lm->get_classification($da->classification,$policy_type);
                                                    $temp_min = $da->from_gvw_cc;
                                                    $temp_max = $da->to_gvw_cc;
                                                    
                                                    if($temp_min <= $v_gvw && $temp_max >= $v_gvw)
                                                    {
                                                        $gvw_status = "1";
                                                    }
                                    		  }
                                    		  else
                                    		  {
                                    		      $gvw_status = "1";
                                    		  }
                                    	  }
                        		    }
                        		        $check_make = $this->lm->check_make_all_already_exits($commission_id,$policy_type);
    
                                        if($check_make != null)
                                        {
                                           $status = "1";
                                            $make_status = "1";
                                            $commission_id = [];
                                		          
                            		          foreach($check_make as $da)
                            		          {
                            		              $commission_id[] = $da->id;
                            		          }
                                         }
                                        else
                                        {
                                              $check_make_1 = $this->lm->check_make_already_exits($commission_id,$policy_type,$make);
                                		       
                                		        if($check_make_1 != "" || $check_make_1 != null)
                                		        {
                                		            $status = "1";
                                		            
                                		            $make_status = "1";
                                		            
                                    		          $commission_id = [];
                                    		          
                                    		          foreach($check_make_1 as $da)
                                    		          {
                                    		              $commission_id[] = $da->commission_id;
                                    		          }
                                		        }
                                		        else
                                		        {
                                		            $make_status = "0";
                                		        }
                                        }
                                       
                        		        if($make_status == "1")
                        		        {
                        		            $check_model = $this->lm->check_model_all_already_exits($commission_id,$policy_type);
                                            
                                            if($check_make != null)
                                            {
                                                 $status = "1";
                                                 $model_status = "1";
                                                 $commission_id = [];
                                                 
                                		          foreach($check_model as $da)
                                		          {
                                		              $commission_id[] = $da->id;
                                		          }
                                            }
                                            else
                                            {
                            		            $check_model_1 = $this->lm->check_model_already_exits($commission_id,$policy_type,$make,$model);
                            		            
                            		            if($check_model_1 != "" || $check_model_1 != null)
                            		            {
                            		                  $status = "1";
                            		                  $model_status = "1";
                                		               $commission_id = [];
                                    		          foreach($check_model_1 as $da)
                                    		          {
                                    		              $commission_id[] = $da->commission_id;
                                    		          }
                            		            }
                            		            else
                            		            {
                            		                $model_status = "0";
                            		            }
                                            }
                        		        }
                        		       
                        		        if($make_status == "1" && $model_status == "1")
                        		        {
                        		            $check_varient = $this->lm->check_varient_all_already_exits($commission_id,$policy_type);
                        		            
                                            if($check_varient != null)
                                            {
                                                 $status = "1";
                                    	         $varient_status = "1";
                                    	         
                                    	          $commission_id = [];
                                    	          
                                		          foreach($check_varient as $da)
                                		          {
                                		              $commission_id[] = $da->id;
                                		          }
                                            }
                                            else 
                                            {
                        		                 $check_varient_1 = $this->lm->check_varient_already_exits($commission_id,$policy_type,$make,$model,$Varient);
                                		            
                                		            if($check_varient_1 != null)
                                		            {
                                		                 $status = "1";
                                		                 $varient_status = "1";
                                        		          $commission_id = [];
                                        		          foreach($check_varient_1 as $da)
                                        		          {
                                        		              $commission_id[] = $da->commission_id;
                                        		          }
                                		            }
                                		            else
                                		            {
                                		                 $varient_status = "0";
                                		            }
                                            }
                        		        }
                        		       
                        		        if($status == "1" && $fuel_status =="1" && $gvw_status =="1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                        		        {
                                            $check_rto = $this->lm->check_rto_already_exits($commission_id,$rto);
                                            
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status == "1";
                                                    $data_arr = array("status"=>"success","id"=>$check_rto->commission_id);
                                                    echo json_encode($data_arr);
                                                    die();
                                                }
                                                else
                                                {
                                                      $data_arr = array("status"=>"no");
                                                }
                        		        }
                        		        else
                        		        {
                        		            $data_arr = array("status"=>"no");
                        		        }
                        		}
                                else
                                {
                                    $data_arr = array("status"=>"no");
                                    //echo json_encode($data_arr);
                                }
                            }
                            else
                            {
                                $data_arr = array("status"=>"no");
                            }
                         }
                        else if($da->class == "1" && $da->commission_type == "3")
                        {
                            foreach($check as $da)
                    		{
                    		    $temp_min = $da->min_val;
                    		    $temp_max = $da->max_val;
                        		    
                        		$commission_id[] = $da->id;
                        		    
                				if($temp_min <= $total_premium && $temp_max >= $total_premium)
                				{
                					$status = "1";
                				}
                    			
                    			if($fuel_type == "1")
                    			{
                    				if($da->fuel_type != "4" || $da->fuel_type != "1")
                    				{
                    				    $fuel_status = 1;
                    				}
                    			}
                    			if($fuel_type == "2")
                    			{
                    			    if($da->fuel_type != "4" || $da->fuel_type != "2")
                    				{
                    				    $fuel_status = 1;
                    				}
                    			}
                    			if($fuel_type == "5")
                    			{
                    			    if($da->fuel_type != "5")
                    				{
                    				    $fuel_status = 1;
                    				}
                    			}
                    			
                    			if($da->fuel_type == "6")
                    			{
                    				    $fuel_status = 1;
                    			}
                    		 }
                		 
                        	  if($status == "1")
                        	  {
                        		    if($policy_type == "1" ||  $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
                        		    {
                                    	   foreach($check as $da)
                                    		{
                                    		    if($da->classification != "")
                                    		    {
                                                    $classification = $this->lm->get_classification($da->classification,$policy_type);
                                                   
                                                    if($classification != null)
                                                    {
                                                        $temp_min = $classification->from_gvw_cc;
                                                        $temp_max = $classification->to_gvw_cc;
                                                        
                                                        if($temp_min <= $cc && $temp_max >= $cc)
                                                        {
                                                            $gvw_status = "1";
                                                        }
                                                    }
                                    		    }
                                    		    else
                                    		    {
                                    		        $gvw_status = "1";
                                    		    }
                                    		 }
                        		    }
                        		    else
                        		    {
                        		         foreach($check as $da)
                                    	 {
                                    	       if($da->classification != "")
                                        		 {
                                                    $classification = $this->lm->get_classification($da->classification,$policy_type);
                                                    
                                                    $temp_min = $da->from_gvw_cc;
                                                    $temp_max = $da->to_gvw_cc;
                                                    
                                                    if($temp_min <= $v_gvw && $temp_max >= $v_gvw)
                                                    {
                                                        $gvw_status = "1";
                                                    }
                                    		  }
                                    		  else
                                    		  {
                                    		      $gvw_status = "1";
                                    		  }
                                    	  }
                        		    }
                        		    
                        		      $check_make = $this->lm->check_make_all_already_exits($commission_id,$policy_type);
    
                                        if($check_make != null)
                                        {
                                           $status = "1";
                                            $make_status = "1";
                                            $commission_id = [];
                                		          
                            		          foreach($check_make as $da)
                            		          {
                            		              $commission_id[] = $da->id;
                            		          }
                                         }
                                        else
                                        {
                                              $check_make_1 = $this->lm->check_make_already_exits($commission_id,$policy_type,$make);
                                		       
                                		        if($check_make_1 != "" || $check_make_1 != null)
                                		        {
                                		            $status = "1";
                                		            
                                		            $make_status = "1";
                                		            
                                    		          $commission_id = [];
                                    		          
                                    		          foreach($check_make_1 as $da)
                                    		          {
                                    		              $commission_id[] = $da->commission_id;
                                    		          }
                                		        }
                                		        else
                                		        {
                                		            $make_status = "0";
                                		        }
                                        }
                                       
                        		        if($make_status == "1")
                        		        {
                        		            $check_model = $this->lm->check_model_all_already_exits($commission_id,$policy_type);
                                            
                                            if($check_make != null)
                                            {
                                                 $status = "1";
                                                 $model_status = "1";
                                                 $commission_id = [];
                                                 
                                		          foreach($check_model as $da)
                                		          {
                                		              $commission_id[] = $da->id;
                                		          }
                                            }
                                            else
                                            {
                            		            $check_model_1 = $this->lm->check_model_already_exits($commission_id,$policy_type,$make,$model);
                            		            
                            		            if($check_model_1 != "" || $check_model_1 != null)
                            		            {
                            		                  $status = "1";
                            		                  $model_status = "1";
                                		               $commission_id = [];
                                    		          foreach($check_model_1 as $da)
                                    		          {
                                    		              $commission_id[] = $da->commission_id;
                                    		          }
                            		            }
                            		            else
                            		            {
                            		                $model_status = "0";
                            		            }
                                            }
                        		        }
                        		       
                        		        if($make_status == "1" && $model_status == "1")
                        		        {
                        		            $check_varient = $this->lm->check_varient_all_already_exits($commission_id,$policy_type);
                        		            
                                            if($check_varient != null)
                                            {
                                                 $status = "1";
                                    	         $varient_status = "1";
                                    	         
                                    	          $commission_id = [];
                                    	          
                                		          foreach($check_varient as $da)
                                		          {
                                		              $commission_id[] = $da->id;
                                		          }
                                            }
                                            else 
                                            {
                        		                 $check_varient_1 = $this->lm->check_varient_already_exits($commission_id,$policy_type,$make,$model,$Varient);
                                		            
                                		            if($check_varient_1 != null)
                                		            {
                                		                 $status = "1";
                                		                 $varient_status = "1";
                                        		          $commission_id = [];
                                        		          foreach($check_varient_1 as $da)
                                        		          {
                                        		              $commission_id[] = $da->commission_id;
                                        		          }
                                		            }
                                		            else
                                		            {
                                		                 $varient_status = "0";
                                		            }
                                            }
                        		        }
                        		  echo $status."<br>".$fuel_status."<br>".$gvw_status."<br>".$make_status."<br>".$model_status."<br>".$model_status."<br>".$varient_status;
                                  die();
                        		       
                        		        if($status == "1" && $fuel_status =="1" && $gvw_status =="1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                        		        {
                                            $check_rto = $this->lm->check_rto_already_exits($commission_id,$rto);
                                            
                                                if(count($check_rto) > 0)
                                                {
                                                    $rto_status == "1";
                                                    $data_arr = array("status"=>"success","id"=>$check_rto->commission_id);
                                                    echo json_encode($data_arr);
                                                    die();
                                                }
                                                else
                                                {
                                                      $data_arr = array("status"=>"no");
                                                }
                        		        }
                        		        else
                        		        {
                        		            $data_arr = array("status"=>"no");
                        		        }
                        		  }
                              else
                              {
                                  $data_arr = array("status"=>"no");
                              }
                        }
                    }
                    echo json_encode($data_arr);
    	        }
    	        else 
    	        {
    	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
    	        }
        	}
       }
       
       
}
       ?>