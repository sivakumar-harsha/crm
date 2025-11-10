<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ReportCtrl extends CI_Controller {
    
    public $rolepermissionModel;
    public $auth;
    public $rm;
    public $mm;
    public $session;
    public $upload;
    public $audit_model;
    public $audit;
    public $invoicerevModel;
    public $invoiceorcModel;
    public $invoiceorcrevModel;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('ReportMod','rm');
		$this->load->model('MasterMod','mm');
		$this->load->library('session');
		$this->load->library('audit');
		//$this->load->library('auth');
		$this->load->helper('url');
		$this->load->helper('cookie');
		$this->load->library('upload');
	}
	
	// excell add 
	
	public function upload_excel_data()
	{
		if($this->session->has_userdata('logged_in'))
    	{
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('upload_excel_data');
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}
	public function excell_data_file_get(){

		$this->load->library('excel');
		$file = $this->input->post("upload_file");

        
        		$path = $_FILES["upload_file"]["tmp_name"];
        		$object = PHPExcel_IOFactory::load($path);
        		
        		foreach($object->getWorksheetIterator() as $worksheet)
        		{
        			$highestRow    = $worksheet->getHighestRow();
        			$highestColumn = $worksheet->getHighestColumn();
        			
        			  for($row=2; $row<= $highestRow ; $row++)
        			  {
                            $name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                            $mobile_no = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                            $address = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                            $area = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                            $sub_model = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                            $model = $worksheet->getCellByColumnAndRow(6, $row)->getValue();

                           $data = array(
                                           "client_type_id" =>"1",
                                           "client_name" =>$name,
                                           "mobile_no" =>$mobile_no,
                                           "address" =>$address,
                                           "area" =>$area,
                                          ); 
                          
                          $res = $this->rm->add_clients_data($data);
                          
                          $arr = array(
                                         "client_id" =>$res,
                                         "lead_status" =>"open",
                                         "lead_type" =>0,
                                         "business_type" =>"3",
                                         "class" =>"1",
                                         "policy_type" =>"1",
                                         "policy_type" =>"1",
                                         "lead_generated_date" =>date("Y-m-d H:i:s"),
                                         "source" =>"Jayantha Insurance",
                                         "assigned_user" =>"all",
                                         "lead_created_by" =>"1",
                                         "created_date" =>date("Y-m-d H:i:s"),
                                         "classfication" => "3",
                                         "Model" =>$model,
                                         "sub_model" =>$sub_model,
                                       );
                                
                            $lead = $this->rm->add_lead_details($arr);
                               
        				}
        		}
        	echo "success";
	}
	
	public function agent_commission_closure()
	{
	    if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        // if(!$this->auth->can_access('Agent Commission Closure')){
        //     redirect('access_denied', 'refresh');
        // }
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{ 
    	    $pro_data["project_info"] = $this->mm->fetch_project_info();
    	    $userslist = $this->rm->getUserList();
    	    $data['userslist'] = $userslist;
    	    
    		$this->load->view('header',$pro_data);
    		$this->load->view('agent_commission_closure', $data);
    		$this->load->view('footer',$pro_data);
    	}
	}
	
	
	public function fetch_policy_report()
    {
        if($this->session->has_userdata('logged_in')) 
    	{
            $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
            
            if($check_user_i->policy_view == "1")
            { 
                $from_date = $this->input->post("from_date");
                $to_date = $this->input->post("to_date");
                $select_agents = $this->input->post("select_agents");
                $select_insurance = $this->input->post("select_insurance");
                $user = $this->input->post("user");
                $select_class = $this->input->post("select_class");
               
                
                $res = $this->rm->fetch_generate_policy_class($from_date,$to_date,$select_agents,$select_insurance, $user,$select_class);
                
                $fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
               
                $content = "";
                
                $content .="
                <style>
                    tfoot {
                        font-weight: bold;
                    }
                </style>";
                if($res){
                    $content .= '<div class="row">
                         <div class="col-md-12 ">
                             <button class="btn btn-primary pull-right" id="fix_btn">Fix Agent Commission</button>
                         </div>
                     </div>';
                }
                
                $content .="<div class='table-responsive'>
                <table class='table' id='policy_list'>
                <thead>
                    <th>S.No</th>
                    <th>Customer</th>
                    <th>Agent id</th>
                    <th>Policy No</th>
                    <th>Insurer</th>
                    <th>User</th>
                    <th>OD</th>
                    <th>TP</th>
                    <th>Net Premium</th>
                    <th>Jan Own Com</th>
                    <th>Uni Own Com</th>
                    <th style='color:red'>Add Com</th>
                    <th>Total Com</th>
                    <th>Jan Agent Com</th>
                    <th>Uni Agent Com</th>
                    <th style='color:red'>Agn Add Com</th>
                    <th>Total Agn Com</th>
                    
                    <th>Total Com + Agn</th>
                    
                    <th>Bussiness Type</th>
                    <th>Class</th>
                    <th>Pol Type</th>
                    <th>Action</th>
                </thead>
                <tbody>
                ";
                $a = 0;
                
                
                if( isset( $res ) && !empty( $res ) ) {
                    foreach($res as $da)
                    {
                         	$a++;
                         	$additional_com = 0;
                            $agn_add_com = 0;
                            $agent_commission = 0;
                            $company_com = 0;
                            $agent_commission = 0;
                         	    
                            if($da->class == "1")
                            {
                                if($da->commission_type == "3")
                                {
                                    $total_premium = 0;
                                    
                                    $get_net_id = $this->rm->get_net_premium_id($da->net_premium_id);
                                    
                                    //ranjith
                                    // foreach($res as $r)
                                    // {
                                    //     if($r->net_premium_id == $da->net_premium_id)
                                    //     {
                                    //         $total_premium = $total_premium + $r->total_premium;
                                    //     }
                                        
                                    // }
                                    // $get_policy = $this->rm->get_policy_id($total_premium,$da->net_premium_id);
                                    // if($get_policy!=null){
                                    //     if($get_policy->on_net != "0")
                                    //     {
                                    //         $company_com = $da->total_premium * ($get_policy->on_net)/100;
                                    //     }
                                    //     else if($get_policy->own_od != "0" && $get_policy->own_tp != "0")
                                    //     {
                                    //         $own_od = $da->total_own_damage * ($get_policy->own_od)/100;
                                    //         $own_tp = $da->tot_liability_premium * ($get_policy->own_tp)/100;
                                    //         $company_com = $own_od+$own_tp;
                                    //     }
                                    //     else if($get_policy->own_od != "0")
                                    //     {
                                    //         $company_com = $da->total_own_damage * ($get_policy->own_od)/100;
                                    //     }
                                    //     else if($get_policy->own_tp != "0")
                                    //     {
                                    //         $company_com = $da->tot_liability_premium * ($get_policy->own_tp)/100;
                                    //     }
                                        
                                    //     $additional_com = $company_com - $da->own_commission_amt - $da->own_commission;
                                        
                                    //     $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);
                                     
                                    //       if($get_policy->agn_com_type == "OD")
                                    //       {
                                    //           if($agent_status->commission_category == "A")
                                    //           {
                                    //               $agent_commission = ($da->total_own_damage * $get_policy->a_od)/100;
                                    //           }
                                    //           else if($agent_status->commission_category == "B")
                                    //           {
                                    //               $agent_commission = ($da->total_own_damage * $get_policy->b_od)/100;
                                    //           }
                                    //           else if($agent_status->commission_category == "C")
                                    //           {
                                    //               $agent_commission = ($da->total_own_damage * $get_policy->c_od)/100;
                                    //           }
                                    //           else if($agent_status->commission_category == "D")
                                    //           {
                                    //               $agent_commission = ($da->total_own_damage * $get_policy->d_od)/100;
                                    //           }
                                    //       }
                                    //       else if($get_policy->agn_com_type == "TP")
                                    //       {
                                    //           if($agent_status->commission_category == "A")
                                    //           {
                                    //               $agent_commission = ($da->tot_liability_premium * $get_policy->a_tp)/100;
                                    //           }
                                    //           else if($agent_status->commission_category == "B")
                                    //           {
                                    //               $agent_commission = ($da->tot_liability_premium * $get_policy->b_tp)/100;
                                    //           }
                                    //           else if($agent_status->commission_category == "C")
                                    //           {
                                    //               $agent_commission = ($da->tot_liability_premium * $get_policy->c_tp)/100;
                                    //           }
                                    //           else if($agent_status->commission_category == "D")
                                    //           {
                                    //               $agent_commission = ($da->tot_liability_premium * $get_policy->d_tp)/100;
                                    //           }
                                    //       }
                                    //       else if($get_policy->agn_com_type == "ON-NET")
                                    //       {
                                    //           if($agent_status->commission_category == "A")
                                    //           {
                                    //               $agent_commission = ($da->total_premium * $get_policy->a_net)/100;
                                    //           }
                                    //           else if($agent_status->commission_category == "B")
                                    //           {
                                    //               $agent_commission = ($da->total_premium * $get_policy->b_net)/100;
                                    //           }
                                    //           else if($agent_status->commission_category == "C")
                                    //           {
                                    //               $agent_commission = ($da->total_premium * $get_policy->c_net)/100;
                                    //           }
                                    //           else if($agent_status->commission_category == "D")
                                    //           {
                                    //               $agent_commission = ($da->total_premium * $get_policy->d_net)/100;
                                    //           }
                                    //       }
                                    //       else if($get_policy->agn_com_type == "OD_AND_TP")
                                    //       {
                                    //           if($agent_status->commission_category == "A")
                                    //           {
                                    //               $agent_od = ($da->total_own_damage * $get_policy->a_od)/100;
                                    //               $agent_tp = ($da->tot_liability_premium * $get_policy->a_tp)/100;
                                    //               $agent_commission = $agent_od+$agent_tp;
                                    //           }
                                    //           else if($agent_status->commission_category == "B")
                                    //           {
                                    //               $agent_od = ($da->total_own_damage * $get_policy->b_od)/100;
                                    //               $agent_tp = ($da->tot_liability_premium * $get_policy->b_tp)/100;
                                    //               $agent_commission = $agent_od+$agent_tp;
                                    //           }
                                    //           else if($agent_status->commission_category == "C")
                                    //           {
                                    //               $agent_od = ($da->total_own_damage * $get_policy->c_od)/100;
                                    //               $agent_tp = ($da->tot_liability_premium * $get_policy->c_tp)/100;
                                    //               $agent_commission = $agent_od+$agent_tp;
                                    //           }
                                    //           else if($agent_status->commission_category == "D")
                                    //           {
                                    //               $agent_od = ($da->total_own_damage * $get_policy->d_od)/100;
                                    //               $agent_tp = ($da->tot_liability_premium * $get_policy->d_tp)/100;
                                    //               $agent_commission = $agent_od+$agent_tp;
                                    //           }
                                    //      }
                                    //      $agn_add_com = $agent_commission - $da->agent_commission_amt - $da->agent_commission;
                                    // }
                                    
                            		
                                    //ranjith
                                    
                                    //comment
                                    foreach($get_net_id as $re)
                                    {
                                        $get_total_premium = $this->rm->get_total_premium($da->net_premium_id);
                                        
                                        foreach($get_total_premium as $am)
                                        {
                                          $total_premium = $total_premium + $am->total_premium;
                                        }
                                    }
                                    
                                    foreach($get_net_id as $das)
                                    {
                                        $temp_min = $das->min_val;
                                    	$temp_max = $das->max_val;
                                    	
                                    	if($temp_min <= $total_premium && $temp_max >= $total_premium)
                                    	{
                                    		    if($das->on_net != "0")
                                                {
                                                    $company_com = $da->total_premium * ($das->on_net)/100;
                                                }
                                                else if($das->own_od != "0" && $das->own_tp != "0")
                                                {
                                                    $own_od = $da->total_own_damage * ($das->own_od)/100;
                                                    $own_tp = $da->tot_liability_premium * ($das->own_tp)/100;
                                                    $company_com = $own_od+$own_tp;
                                                }
                                                else if($das->own_od != "0")
                                                {
                                                    $company_com = $da->total_own_damage * ($das->own_od)/100;
                                                }
                                                else if($das->own_tp != "0")
                                                {
                                                    $company_com = $da->tot_liability_premium * ($das->own_tp)/100;
                                                }
                                                
                                                $additional_com = $company_com - $da->own_commission_amt - $da->own_commission;
                                                
                                                $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);
                                             
                                                  if($das->agn_com_type == "OD")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->a_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->b_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->c_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->d_od)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->a_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->b_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->c_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->d_tp)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "ON-NET")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->a_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->b_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->c_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->d_net)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "OD_AND_TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->a_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->a_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->b_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->b_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->c_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->c_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->d_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->d_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                 }
                                                 $agn_add_com = $agent_commission - $da->agent_commission_amt - $da->agent_commission;
                                    		}
                                    	}
                                    //comment
                                }
                                else if($da->commission_type == "1")
                                {
                                    $tot_policy = 0;
                                    $get_nop_id = $this->rm->get_no_of_policy_id($da->no_of_policy_id);
                                    
                                    foreach($get_nop_id as $re)
                                    {
                                        $get_total_policy = $this->rm->get_total_policy($re->id);
                                        $tot_policy = $tot_policy + count($get_total_policy) ;
                                    }
                                    
                                    foreach($get_nop_id as $das)
                                    {
                                        $temp_min = $das->no_policy_min;
                                    	$temp_max = $das->no_policy_max;
                                    	
                                    	if($temp_min <= $tot_policy && $temp_max >= $tot_policy)
                                    	{
                                    
                                    		    if($das->on_net != "0")
                                                {
                                                    $company_com = $da->total_premium * ($das->on_net)/100;
                                                }
                                                else if($das->own_od != "0" && $das->own_tp != "0")
                                                {
                                                    $own_od = $da->total_own_damage * ($das->own_od)/100;
                                                    $own_tp = $da->tot_liability_premium * ($das->own_tp)/100;
                                                    $company_com = $own_od+$own_tp;
                                                }
                                                else if($das->own_od != "0")
                                                {
                                                    $company_com = $da->total_own_damage * ($das->own_od)/100;
                                                    $own_od = $company_com;
                                                }
                                                else if($das->own_tp != "0")
                                                {
                                                    $company_com = $da->tot_liability_premium * ($das->own_tp)/100;
                                                    $own_tp = $company_com;
                                                }
                                                
                                                $additional_com = $company_com - $da->own_commission_amt - $da->own_commission;
                                                $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);
                                             
                                                  if($das->agn_com_type == "OD")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->a_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->b_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->c_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->d_od)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->a_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->b_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->c_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->d_tp)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "ON-NET")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->a_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->b_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->c_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->d_net)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "OD_AND_TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->a_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->a_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->b_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->b_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->c_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->c_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->d_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->d_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                 }
                                                 $agn_add_com = $agent_commission - $da->agent_commission_amt - $da->agent_commission;
                                    	}
                                    }	
                                }
                                else
                                {
                                      $da->agent_commission_amt;
                                      $da->own_commission_amt;
                                }
                            }
                            else
                            {
                                 $total_premium = 0;
                                if($da->commission_type == "1")
                                {
                                    $tot_policy = 0;
                                    $get_nop_id = $this->rm->get_no_of_policy_id($da->no_of_policy_id);
                                    
                                    foreach($get_nop_id as $re)
                                    {
                                        $get_total_policy = $this->rm->get_total_policy($re->id);
                                        $tot_policy = $tot_policy + count($get_total_policy) ;
                                    }
                                    
                                    foreach($get_nop_id as $das)
                                    {
                                        $temp_min = $das->no_policy_min;
                                    	$temp_max = $das->no_policy_max;
                                    	
                                    	if($temp_min <= $tot_policy && $temp_max >= $tot_policy)
                                    	{
                                    
                                    		    if($das->on_net != "0")
                                                {
                                                    $company_com = $da->total_premium * ($das->on_net)/100;
                                                }
                                                else if($das->own_od != "0" && $das->own_tp != "0")
                                                {
                                                    $own_od = $da->total_own_damage * ($das->own_od)/100;
                                                    $own_tp = $da->tot_liability_premium * ($das->own_tp)/100;
                                                    $company_com = $own_od+$own_tp;
                                                }
                                                else if($das->own_od != "0")
                                                {
                                                    $company_com = $da->total_own_damage * ($das->own_od)/100;
                                                    $own_od = $company_com;
                                                }
                                                else if($das->own_tp != "0")
                                                {
                                                    $company_com = $da->tot_liability_premium * ($das->own_tp)/100;
                                                    $own_tp = $company_com;
                                                }
                                                
                                                $additional_com = $company_com - $da->own_commission_amt - $da->own_commission;
                                                $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);
                                             
                                                  if($das->agn_com_type == "OD")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->a_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->b_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->c_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->d_od)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->a_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->b_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->c_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->d_tp)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "ON-NET")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->a_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->b_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->c_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->d_net)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "OD_AND_TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->a_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->a_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->b_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->b_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->c_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->c_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->d_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->d_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                 }
                                                 $agn_add_com = $agent_commission - $da->agent_commission_amt - $da->agent_commission;
                                    	}
                                    }	
                                }
                                else{
                                 
                                    $get_net_id = $this->rm->get_net_premium_id($da->net_premium_id);
                                    
                                    foreach($get_net_id as $re)
                                    {
                                        // $get_total_premium = $this->rm->get_total_premium($re->id);
                                        
                                        $get_total_premium = $this->rm->getTotalPremium($re->id);
                                        
                                        foreach($get_total_premium as $am)
                                        {
                                           $total_premium = $total_premium + $am->total_premium;
                                        }
                                    }
                                    
                                    foreach($get_net_id as $das)
                                    {
                                        $temp_min = $das->min_val;
                                    	$temp_max = $das->max_val;
                                    	
                                    	if($temp_min <= $total_premium && $temp_max >= $total_premium)
                                    	{
                                    		    if($das->on_net != "0")
                                                {
                                                    $own_od = "";
                                                    $own_tp = "";
                                                    $company_com = $da->total_premium * ($das->on_net)/100;
                                                    $on_net = $company_com;
                                                }
                                             
                                                $additional_com = $company_com - $da->own_commission_amt - $da->own_commission;
                                                $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);
                                                
                                            
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->a_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->b_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->c_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->d_net)/100;
                                                      }
                                                      
                                                      $agn_add_com = $agent_commission - $da->agent_commission_amt - $da->agent_commission;
                                                      //$agn_add_com = $agent_commission;
                                    		}
                                    	}
                                }
                            }
                        
                            $jan_com = $jan_agn_com = $uni_com = $uni_agn_com = 0;
                            $jan_com = $da->own_commission_amt;
                            $jan_agn_com = $da->agent_commission_amt;
                            $uni_com = $da->own_commission;
                            $uni_agn_com = $da->agent_commission;
                            
            
                            $content .="<tr>";
                            $content .="<td>".$a."</td>";
                            $content .="<td>".$da->client_name."</td>";
                            $content .="<td>".$da->agent_pos_code."</td>";
                            $content .="<td>".$da->policy_no."</td>";
                            $content .="<td>".$da->company_name."</td>";
                            $content .="<td>".$da->user."</td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->total_own_damage,"INR")."</td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->tot_liability_premium,"INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->total_premium,"INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($jan_com,"INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($uni_com,"INR")."</span></td>";
                            $content .="<td style='color:red'><span class='pull-right'>".$fmt->formatCurrency($additional_com,"INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency(($jan_com + $uni_com + $additional_com),"INR")."</span></td>";
                            
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($jan_agn_com,"INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($uni_agn_com,"INR")."</span></td>";
                            $content .="<td style='color:red'><span class='pull-right'>".$fmt->formatCurrency($agn_add_com,"INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency(($jan_agn_com + $uni_agn_com + $agn_add_com),"INR")."</span></td>";
                            
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency(($jan_com + $jan_agn_com + $uni_com + $uni_agn_com + $additional_com + $agn_add_com),"INR")."</span></td>";
                            $content .="<td>".$da->business_name."</td>";
                            $content .="<td>".$da->class_name."</td>";
                            $content .="<td>".$da->policy_type."</td>";
                            $content .=" <td><button type='button' class='btn btn-danger pull-right' id='cancel_data_btn' onclick=cancel_data(".$da->id.")> Cancel</button>&nbsp;
                            <button type='button' class='btn btn-primary pull-right' id='hold_data_btn' onclick=hold_data(".$da->id.")> Hold</button></td>";
                            $content .="</tr>";
                            
                            $od_total[] = $da->total_own_damage;
                            $lia_total[] = $da->tot_liability_premium;
                            $premium_total[] = $da->total_premium;
                            $owncom_total[] = $jan_com;//$da->own_commission_amt;
                            $agcom_total[] = $jan_agn_com;//$da->agent_commission_amt;
                            
                            $uowncom_total[] = $uni_com;//$da->own_commission_amt;
                            $uagcom_total[] = $uni_agn_com;//$da->agent_commission_amt;
                            
                            $addcom_total[] = $additional_com;
                            $addagcom_total[] = $agn_add_com;
                    }
                } else {
                    //$content .= '<tr><td colspan="16" style="font-weight: bold;text-align: center">Not Found(s)</td></th>';
                }
                $content .='</tbody>';
                if($res){
                    $content.= '<tfoot>';
                        $content .= '<tr>';
                            $content .= '<td colspan="6"><span  class="pull-right">Grand Total</span></td>';
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency(array_sum($od_total),"INR").'</span></td>';
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency(array_sum($lia_total),"INR").'</span></td>';
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency(array_sum($premium_total),"INR").'</span></td>';
                            
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency(array_sum($owncom_total),"INR").'</span></td>';
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency(array_sum($uowncom_total),"INR").'</span></td>';
                            $content .= '<td><span class="pull-right" style="color:red">'.$fmt->formatCurrency(array_sum($addcom_total),"INR").'</span></td>';
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency((array_sum($owncom_total) + array_sum($uowncom_total) + array_sum($addcom_total)),"INR").'</span></td>';
                            
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency(array_sum($agcom_total),"INR").'</span></td>';
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency(array_sum($uagcom_total),"INR").'</span></td>';
                            $content .= '<td><span class="pull-right" style="color:red">'.$fmt->formatCurrency(array_sum($addagcom_total),"INR").'</span></td>';
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency((array_sum($agcom_total) + array_sum($uagcom_total) + array_sum($addagcom_total)),"INR").'</span></td>';
                            
                            $_total_comm = array_sum($owncom_total) + array_sum($agcom_total) + array_sum($uowncom_total) + array_sum($uagcom_total) + array_sum($addcom_total) + array_sum($addagcom_total);
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency($_total_comm,"INR").'</span></td>';
                            
                            $content .= '<td colspan="4"></td>';
                        $content .= '</tr>';
                    $content .='</tfoot>';
                }
                $content .= '</table></div>';
                echo $content;
            }
            else
            {
                echo "<script>alert('Permission Dinied');window.location.href='home';</script>";
            }
    	}
    }
    
    
    public function fix_agent_commission()
    {
        if($this->session->has_userdata('logged_in')) 
    	{
    	   $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
                
            if($check_user_i->policy_view == "1")
            { 
                $from_date = $this->input->post("from_date");
                $to_date = $this->input->post("to_date");
                $agent = $this->input->post("agent");
                $user = $this->input->post("user");
                $company = $this->input->post("company");
                
                $res = $this->rm->fetch_generate_policy($from_date,$to_date, $agent, $company, $user);
                $lead_id = "";
                $additional_com = 0;
                $agn_add_com = 0;
                
                foreach($res as $da)
                {
                    if($da->class == "1")
                    {
                    	if($da->commission_type == "3")
                    	{
                    	    $lead_id = $da->lead_id;
                    	    $total_premium = 0;
                    	    
                    	    $get_net_id = $this->rm->get_net_premium_id($da->net_premium_id);
                    	    
                    	    foreach($get_net_id as $re)
                    	    {
                    	        $get_total_premium = $this->rm->get_total_premium($re->net_premium_id);
                    	        
                    	        foreach($get_total_premium as $am)
                    	        {
                    	           $total_premium = $total_premium + $am->total_premium;
                    	        }
                    	    }
                    	    
                            foreach($get_net_id as $das)
                            {
                                $temp_min = $das->min_val;
                            	$temp_max = $das->max_val;
                            	
                            	if($temp_min <= $total_premium && $temp_max >= $total_premium)
                            	{
                            		    if($das->on_net != "0")
                                        {
                                            $company_com = $da->total_premium * ($das->on_net)/100;
                                            $on_net = $company_com;
                                        }
                                        else if($das->own_od != "0" && $das->own_tp != "0")
                                        {
                                            $own_od = $da->total_own_damage * ($das->own_od)/100;
                                            $own_tp = $da->tot_liability_premium * ($das->own_tp)/100;
                                            $company_com = $own_od+$own_tp;
                                        }
                                        else if($das->own_od != "0")
                                        {
                                            $company_com = $da->total_own_damage * ($das->own_od)/100;
                                            $own_od = $company_com;
                                        }
                                        else if($das->own_tp != "0")
                                        {
                                            $company_com = $da->tot_liability_premium * ($das->own_tp)/100;
                                            $own_tp = $company_com;
                                        }
                                        
                                        $additional_com = $company_com - $da->own_commission_amt - $da->own_commission;
                                        
                                        $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);
                                     
                                          if($das->agn_com_type == "OD")
                                          {
                                              if($agent_status->commission_category == "A")
                                              {
                                                  $agent_commission = ($da->total_own_damage * $das->a_od)/100;
                                              }
                                              else if($agent_status->commission_category == "B")
                                              {
                                                  $agent_commission = ($da->total_own_damage * $das->b_od)/100;
                                              }
                                              else if($agent_status->commission_category == "C")
                                              {
                                                  $agent_commission = ($da->total_own_damage * $das->c_od)/100;
                                              }
                                              else if($agent_status->commission_category == "D")
                                              {
                                                  $agent_commission = ($da->total_own_damage * $das->d_od)/100;
                                              }
                                          }
                                          else if($das->agn_com_type == "TP")
                                          {
                                              if($agent_status->commission_category == "A")
                                              {
                                                  $agent_commission = ($da->tot_liability_premium * $das->a_tp)/100;
                                              }
                                              else if($agent_status->commission_category == "B")
                                              {
                                                  $agent_commission = ($da->tot_liability_premium * $das->b_tp)/100;
                                              }
                                              else if($agent_status->commission_category == "C")
                                              {
                                                  $agent_commission = ($da->tot_liability_premium * $das->c_tp)/100;
                                              }
                                              else if($agent_status->commission_category == "D")
                                              {
                                                  $agent_commission = ($da->tot_liability_premium * $das->d_tp)/100;
                                              }
                                          }
                                          else if($das->agn_com_type == "ON-NET")
                                          {
                                              if($agent_status->commission_category == "A")
                                              {
                                                  $agent_commission = ($da->total_premium * $das->a_net)/100;
                                              }
                                              else if($agent_status->commission_category == "B")
                                              {
                                                  $agent_commission = ($da->total_premium * $das->b_net)/100;
                                              }
                                              else if($agent_status->commission_category == "C")
                                              {
                                                  $agent_commission = ($da->total_premium * $das->c_net)/100;
                                              }
                                              else if($agent_status->commission_category == "D")
                                              {
                                                  $agent_commission = ($da->total_premium * $das->d_net)/100;
                                              }
                                          }
                                          else if($das->agn_com_type == "OD_AND_TP")
                                          {
                                              if($agent_status->commission_category == "A")
                                              {
                                                  $agent_od = ($da->total_own_damage * $das->a_od)/100;
                                                  $agent_tp = ($da->tot_liability_premium * $das->a_tp)/100;
                                                  $agent_commission = $agent_od+$agent_tp;
                                              }
                                              else if($agent_status->commission_category == "B")
                                              {
                                                  $agent_od = ($da->total_own_damage * $das->b_od)/100;
                                                  $agent_tp = ($da->tot_liability_premium * $das->b_tp)/100;
                                                  $agent_commission = $agent_od+$agent_tp;
                                              }
                                              else if($agent_status->commission_category == "C")
                                              {
                                                  $agent_od = ($da->total_own_damage * $das->c_od)/100;
                                                  $agent_tp = ($da->tot_liability_premium * $das->c_tp)/100;
                                                  $agent_commission = $agent_od+$agent_tp;
                                              }
                                              else if($agent_status->commission_category == "D")
                                              {
                                                  $agent_od = ($da->total_own_damage * $das->d_od)/100;
                                                  $agent_tp = ($da->tot_liability_premium * $das->d_tp)/100;
                                                  $agent_commission = $agent_od+$agent_tp;
                                              }
                                         }
                                          $agn_add_com = $agent_commission - $da->agent_commission_amt - $da->agent_commission;
                                         $update = array("com_add_com" =>$additional_com,"agn_add_com" =>$agn_add_com,"commission_status"=>"1");
                                         
                                         $old_data = $this->rm->getPolicyByID($da->id);
                                         $res = $this->rm->update_additional_commissions($da->id,$update);
                                         if($res){
                                            $this->audit->log('policy_info', 'UPDATE', null, $old_data, $update);
                                         } 
                                         
                                         $get_ledger_orc = $this->rm->fetch_ledger_orc($lead_id,"cr_parent_id");
                                         $add_own_ledger_orc = array(
                                             "sr_no" => $get_ledger_orc->sr_no,
                                             "credit" => $additional_com,
                                             "cr_parent_id" => $get_ledger_orc->cr_parent_id,
                                             "dr_parent_id" => $get_ledger_orc->dr_parent_id,
                                             "lead_id" => $get_ledger_orc->lead_id,
                                             "sub_id" => $get_ledger_orc->sub_id,
                                             "insurer_id" => $get_ledger_orc->insurer_id,
                                             "note" => $get_ledger_orc->note,
                                             "datetime" => date("Y-m-d h:i:s"),
                                             );
                                              $get_ledger_orc = $this->rm->fetch_ledger_orc($lead_id,"dr_parent_id");
                                         $add_agn_ledger_orc = array(
                                             "sr_no" => $get_ledger_orc->sr_no,
                                             "debit" => $agn_add_com,
                                             "cr_parent_id" => $get_ledger_orc->cr_parent_id,
                                             "dr_parent_id" => $get_ledger_orc->dr_parent_id,
                                             "lead_id" => $get_ledger_orc->lead_id,
                                             "sub_id" => $get_ledger_orc->sub_id,
                                             "insurer_id" => $get_ledger_orc->insurer_id,
                                             "note" => $get_ledger_orc->note,
                                             "datetime" => date("Y-m-d h:i:s"),
                                             );
                                         $add_agn_ledger_orc1 = array(
                                             "sr_no" => $get_ledger_orc->sr_no,
                                             "credit" => $agn_add_com,
                                             "cr_parent_id" => $get_ledger_orc->cr_parent_id,
                                             "dr_parent_id" => $get_ledger_orc->dr_parent_id,
                                             "lead_id" => $get_ledger_orc->lead_id,
                                             "sub_id" => $get_ledger_orc->sub_id,
                                             "insurer_id" => $get_ledger_orc->insurer_id,
                                             "note" => $get_ledger_orc->note,
                                             "datetime" => date("Y-m-d h:i:s"),
                                         );
                                         $this->rm->insert_ledger_data($add_own_ledger_orc);
                                         $this->audit->log('acc_commission_ledger_orc', 'INSERT', null, null, $add_own_ledger_orc);
                                         $this->rm->insert_ledger_data($add_agn_ledger_orc);
                                         $this->audit->log('acc_commission_ledger_orc', 'INSERT', null, null, $add_agn_ledger_orc);
                                         $this->rm->insert_ledger_data($add_agn_ledger_orc1);
                                         $this->audit->log('acc_commission_ledger_orc', 'INSERT', null, null, $add_agn_ledger_orc1);
                            	}
                            }	
                            
                    	}
                	    else if($da->commission_type == "1")
                        {
                            $lead_id = $da->lead_id;
                            
                    	    $tot_policy = 0;
                    	    
                    	    $get_nop_id = $this->rm->get_no_of_policy_id($da->no_of_policy_id);
                    	    
                    	    foreach($get_nop_id as $re)
                    	    {
                    	        $get_total_policy = $this->rm->get_total_policy($re->id);
                    	        $tot_policy = $tot_policy + count($get_total_policy) ;
                    	    }
                    	    
                            foreach($get_nop_id as $das)
                            {
                                $temp_min = $das->no_policy_min;
                            	$temp_max = $das->no_policy_max;
                            	
                            	if($temp_min <= $tot_policy && $temp_max >= $tot_policy)
                            	{
                            		    if($das->on_net != "0")
                                        {
                                            $own_od = "";
                                            $own_tp = "";
                                            $company_com = $da->total_premium * ($das->on_net)/100;
                                            $on_net = $company_com;
                                        }
                                        else if($das->own_od != "0" && $das->own_tp != "0")
                                        {
                                            $own_od = $da->total_own_damage * ($das->own_od)/100;
                                            $own_tp = $da->tot_liability_premium * ($das->own_tp)/100;
                                            $company_com = $own_od+$own_tp;
                                            $on_net = "";
                                        }
                                        else if($das->own_od != "0")
                                        {
                                            $on_net = ""; 
                                            $own_tp = "";
                                            $company_com = $da->total_own_damage * ($das->own_od)/100;
                                            $own_od = $company_com;
                                        }
                                        else if($das->own_tp != "0")
                                        {
                                            $own_od = ""; 
                                            $on_net = "";
                                            $company_com = $da->tot_liability_premium * ($das->own_tp)/100;
                                            $own_tp = $company_com;
                                        }
                                        
                                        $additional_com = $company_com - $da->own_commission_amt - $da->own_commission;
                                        $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);
                                     
                                          if($das->agn_com_type == "OD")
                                          {
                                              if($agent_status->commission_category == "A")
                                              {
                                                  $agent_commission = ($da->total_own_damage * $das->a_od)/100;
                                              }
                                              else if($agent_status->commission_category == "B")
                                              {
                                                  $agent_commission = ($da->total_own_damage * $das->b_od)/100;
                                              }
                                              else if($agent_status->commission_category == "C")
                                              {
                                                  $agent_commission = ($da->total_own_damage * $das->c_od)/100;
                                              }
                                              else if($agent_status->commission_category == "D")
                                              {
                                                  $agent_commission = ($da->total_own_damage * $das->d_od)/100;
                                              }
                                          }
                                          else if($das->agn_com_type == "TP")
                                          {
                                              if($agent_status->commission_category == "A")
                                              {
                                                  $agent_commission = ($da->tot_liability_premium * $das->a_tp)/100;
                                              }
                                              else if($agent_status->commission_category == "B")
                                              {
                                                  $agent_commission = ($da->tot_liability_premium * $das->b_tp)/100;
                                              }
                                              else if($agent_status->commission_category == "C")
                                              {
                                                  $agent_commission = ($da->tot_liability_premium * $das->c_tp)/100;
                                              }
                                              else if($agent_status->commission_category == "D")
                                              {
                                                  $agent_commission = ($da->tot_liability_premium * $das->d_tp)/100;
                                              }
                                          }
                                          else if($das->agn_com_type == "ON-NET")
                                          {
                                              if($agent_status->commission_category == "A")
                                              {
                                                  $agent_commission = ($da->total_premium * $das->a_net)/100;
                                              }
                                              else if($agent_status->commission_category == "B")
                                              {
                                                  $agent_commission = ($da->total_premium * $das->b_net)/100;
                                              }
                                              else if($agent_status->commission_category == "C")
                                              {
                                                  $agent_commission = ($da->total_premium * $das->c_net)/100;
                                              }
                                              else if($agent_status->commission_category == "D")
                                              {
                                                  $agent_commission = ($da->total_premium * $das->d_net)/100;
                                              }
                                          }
                                          else if($das->agn_com_type == "OD_AND_TP")
                                          {
                                              if($agent_status->commission_category == "A")
                                              {
                                                  $agent_od = ($da->total_own_damage * $das->a_od)/100;
                                                  $agent_tp = ($da->tot_liability_premium * $das->a_tp)/100;
                                                  $agent_commission = $agent_od+$agent_tp;
                                              }
                                              else if($agent_status->commission_category == "B")
                                              {
                                                  $agent_od = ($da->total_own_damage * $das->b_od)/100;
                                                  $agent_tp = ($da->tot_liability_premium * $das->b_tp)/100;
                                                  $agent_commission = $agent_od+$agent_tp;
                                              }
                                              else if($agent_status->commission_category == "C")
                                              {
                                                  $agent_od = ($da->total_own_damage * $das->c_od)/100;
                                                  $agent_tp = ($da->tot_liability_premium * $das->c_tp)/100;
                                                  $agent_commission = $agent_od+$agent_tp;
                                              }
                                              else if($agent_status->commission_category == "D")
                                              {
                                                  $agent_od = ($da->total_own_damage * $das->d_od)/100;
                                                  $agent_tp = ($da->tot_liability_premium * $das->d_tp)/100;
                                                  $agent_commission = $agent_od+$agent_tp;
                                              }
                                         }
                                         $agn_add_com = $agent_commission - $da->agent_commission_amt - $da->agent_commission;
                                         $update = array("com_add_com" =>$additional_com,"agn_add_com" =>$agn_add_com,"commission_status"=>"1");
                                         
                                         
                                         $old_data = $this->rm->getPolicyByID($da->id);
                                         $res = $this->rm->update_additional_commissions($da->id,$update);
                                         if($res){
                                            $this->audit->log('policy_info', 'UPDATE', null, $old_data, $update);
                                         }
                                         
                                         $get_ledger_orc = $this->rm->fetch_ledger_orc($lead_id,"cr_parent_id");
                                         $add_own_ledger_orc = array(
                                             "sr_no" => $get_ledger_orc->sr_no,
                                             "credit" => $additional_com,
                                             "cr_parent_id" => $get_ledger_orc->cr_parent_id,
                                             "dr_parent_id" => $get_ledger_orc->dr_parent_id,
                                             "lead_id" => $get_ledger_orc->lead_id,
                                             "sub_id" => $get_ledger_orc->sub_id,
                                             "insurer_id" => $get_ledger_orc->insurer_id,
                                             "note" => $get_ledger_orc->note,
                                             "datetime" => date("Y-m-d h:i:s"),
                                             );
                                              $get_ledger_orc = $this->rm->fetch_ledger_orc($lead_id,"dr_parent_id");
                                         $add_agn_ledger_orc = array(
                                             "sr_no" => $get_ledger_orc->sr_no,
                                             "debit" => $agn_add_com,
                                             "cr_parent_id" => $get_ledger_orc->cr_parent_id,
                                             "dr_parent_id" => $get_ledger_orc->dr_parent_id,
                                             "lead_id" => $get_ledger_orc->lead_id,
                                             "sub_id" => $get_ledger_orc->sub_id,
                                             "insurer_id" => $get_ledger_orc->insurer_id,
                                             "note" => $get_ledger_orc->note,
                                             "datetime" => date("Y-m-d h:i:s"),
                                             );
                                         $add_agn_ledger_orc1 = array(
                                             "sr_no" => $get_ledger_orc->sr_no,
                                             "credit" => $agn_add_com,
                                             "cr_parent_id" => $get_ledger_orc->cr_parent_id,
                                             "dr_parent_id" => $get_ledger_orc->dr_parent_id,
                                             "lead_id" => $get_ledger_orc->lead_id,
                                             "sub_id" => $get_ledger_orc->sub_id,
                                             "insurer_id" => $get_ledger_orc->insurer_id,
                                             "note" => $get_ledger_orc->note,
                                             "datetime" => date("Y-m-d h:i:s"),
                                         );
                                         $this->rm->insert_ledger_data($add_own_ledger_orc);
                                         $this->audit->log('acc_commission_ledger_orc', 'INSERT', null, null, $add_own_ledger_orc);
                                         $this->rm->insert_ledger_data($add_agn_ledger_orc);
                                         $this->audit->log('acc_commission_ledger_orc', 'INSERT', null, null, $add_agn_ledger_orc);
                                         $this->rm->insert_ledger_data($add_agn_ledger_orc1);
                                         $this->audit->log('acc_commission_ledger_orc', 'INSERT', null, null, $add_agn_ledger_orc1);
                            	}
                            }	
                    	}
                    	else
                    	{
                    	      $da->agent_commission_amt;
                              $da->own_commission_amt;
                              
                               $update = array("commission_status"=>"1");
                              
                             $old_data = $this->rm->getPolicyByID($da->id);
                             $res = $this->rm->update_additional_commissions($da->id,$update);
                             if($res){
                                $this->audit->log('policy_info', 'UPDATE', null, $old_data, $update);
                             }
                    	}
                    }
                    else if($da->class == "2")
                    {
                        if($da->commission_type == "3")
                    	{
                    	    $total_premium = 0;
                    	    $get_net_id = $this->rm->get_net_premium_id($da->net_premium_id);
                    	    //var_dump($this->db->last_query());
                    	    foreach($get_net_id as $re)
                    	    {
                    	        //$get_total_premium = $this->rm->get_total_premium($re->id);
                    	        $get_total_premium = $this->rm->getTotalPremium($re->id);
                    	        
                    	        foreach($get_total_premium as $am)
                    	        {
                    	           $total_premium = $total_premium + $am->total_premium;
                    	        }
                    	    }
                    	    
                    	    
                    	    
                            foreach($get_net_id as $das)
                            {
                                $temp_min = $das->min_val;
                            	$temp_max = $das->max_val;
                            	
                                	if($temp_min <= $total_premium && $temp_max >= $total_premium)
                                	{
                                		    if($das->on_net != "0")
                                            {
                                                $company_com = $da->total_premium * ($das->on_net)/100;
                                            }
                                            
                                            $additional_com = $company_com - $da->own_commission_amt;
                                            
                                            $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);
                                         
                                                  if($agent_status->commission_category == "A")
                                                  {
                                                      $agent_commission = ($da->total_premium * $das->a_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "B")
                                                  {
                                                      $agent_commission = ($da->total_premium * $das->b_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "C")
                                                  {
                                                      $agent_commission = ($da->total_premium * $das->c_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "D")
                                                  {
                                                      $agent_commission = ($da->total_premium * $das->d_net)/100;
                                                  }
                                              
                                             $agn_add_com = $agent_commission - $da->agent_commission_amt;
                                             $update = array("com_add_com" =>$additional_com,"agn_add_com" =>$agn_add_com,"commission_status"=>"1");
                                             
                                            
                                             $old_data = $this->rm->getPolicyByID($da->id);
                                             $res = $this->rm->update_additional_commissions($da->id,$update);
                                             if($res){
                                                $this->audit->log('policy_info', 'UPDATE', null, $old_data, $update);
                                             }
                                		}
                            }
                        }
                	    else if($da->commission_type == "1")
                        {
                    	    $tot_policy = 0;
                    	    
                    	    $get_nop_id = $this->rm->get_no_of_policy_id($da->no_of_policy_id);
                    	    
                    	    foreach($get_nop_id as $re)
                    	    {
                    	        $get_total_policy = $this->rm->get_total_policy($re->id);
                    	        $tot_policy = $tot_policy + count($get_total_policy) ;
                    	    }
                    	    
                            foreach($get_nop_id as $das)
                            {
                                $temp_min = $das->no_policy_min;
                            	$temp_max = $das->no_policy_max;
                            	
                            	if($temp_min <= $tot_policy && $temp_max >= $tot_policy)
                            	{
                            		    if($das->on_net != "0")
                                        {
                                            $company_com = $da->total_premium * ($das->on_net)/100;
                                        }
                                      
                                            $additional_com = $company_com - $da->own_commission_amt;
                                            $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);

                                              if($agent_status->commission_category == "A")
                                              {
                                                  $agent_commission = ($da->total_premium * $das->a_net)/100;
                                              }
                                              else if($agent_status->commission_category == "B")
                                              {
                                                  $agent_commission = ($da->total_premium * $das->b_net)/100;
                                              }
                                              else if($agent_status->commission_category == "C")
                                              {
                                                  $agent_commission = ($da->total_premium * $das->c_net)/100;
                                              }
                                              else if($agent_status->commission_category == "D")
                                              {
                                                  $agent_commission = ($da->total_premium * $das->d_net)/100;
                                              }

                                         $agn_add_com = $agent_commission - $da->agent_commission_amt;
                                         $update = array("com_add_com" =>$additional_com,"agn_add_com" =>$agn_add_com,"commission_status"=>"1");
                                         
                                         $old_data = $this->rm->getPolicyByID($da->id);
                                         $res = $this->rm->update_additional_commissions($da->id,$update);
                                         if($res){
                                            $this->audit->log('policy_info', 'UPDATE', null, $old_data, $update);
                                         }
                            	}
                            }	
                    	}
                    }
                    else{
                        $update = array("commission_status"=>"1");
                        
                        $old_data = $this->rm->getPolicyByID($da->id);
                        $res = $this->rm->update_additional_commissions($da->id,$update);
                        if($res){
                            $this->audit->log('policy_info', 'UPDATE', null, $old_data, $update);
                        }
                    }
                }
            }
    	}
    }
    
    
    public function agent_commission_report()
    {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        // if(!$this->auth->can_access('Agent Commission Report')){
        //     redirect('access_denied', 'refresh');
        // }
         if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{ 
    	    $pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('agent_commission_report');
    		$this->load->view('footer',$pro_data);
    	}
    }
    
    
    public function fetch_all_agents_list()
    {
        if($this->session->has_userdata('logged_in')) 
    	{
    	    $res = $this->rm->fetch_all_agents_list();
    	    echo json_encode($res);
    	}
    }
    
    // agent commission report
    
    public function fetch_agent_commision_report()
    {
        if($this->session->has_userdata('logged_in')) 
    	{
    	    $from_date = $this->input->post("from_date");
    	    $to_date = $this->input->post("to_date");
    	    $agent_list = $this->input->post("agents");
    	    
    	    $content = "<style>
                            .table {
                                width: 100%;
                                max-width: 100%;
                                margin-bottom: -3px;
                            }
    	                </style>";
    	        
    	         if($agent_list == "all")
    	         {
    	             $get_agent_code = $this->rm->get_agent_code($from_date,$to_date);
    	             
    	             foreach($get_agent_code as $agn)
    	             {
    	               $res = $this->rm->fetch_agent_commission_report($from_date,$to_date,$agn->policy_agency_pos);
    	               
        	           $content .="<table class='table' border='0'>
                            <tr>
                                <td style='font-size:16px;'>AGENT Code : ".$agn->agent_pos_code."</td>
                                <td style='font-size:16px;'>Total no policies : ".count($res)."</td>
                            </tr>
                         </table>";
    	                 
    	                 $content .="<table class='table table-bordered'>
                                <tr>
                                      <td>Policy No</td>
                                      <td>Customer Name</td>
                                      <td>Agent Code</td>
                                      <td>IRD Commisison</td>
                                      <td>Additional Commission</td>
                                      <td>Total</td>
                                      <td>Debit</td>
                                </tr>
                                <tbody>";
                     $total_ird = 0;
                     $total_additional = 0;
                     $agent_commission = 0;
                     $agent_debit = 0;
                                
                    foreach($res as $da)
                    {
                       $total_ird = $total_ird +  $da->irdi_commission;
                       $total_additional = $total_additional + $da->additional_commission;
                       $agent_commission = $agent_commission + $da->agent_commission;
                       $agent_debit  = $agent_debit + $da->agent_debit;
                      
                        $content .="<tr>
                            <td>".$da->policy_no."</td>
                            <td>".$da->client_name."</td>
                            <td>".$da->agent_pos_code."</td>
                            <td style='text-align:right'>".number_format($da->irdi_commission,2)."</td>
                            <td style='text-align:right'>".number_format($da->additional_commission,2)."</td>
                            <td style='text-align:right'>".number_format($da->agent_commission,2)."</td>
                            <td style='text-align:right'>".number_format($da->agent_debit,2)."</td>
                        </tr>";
                    }
                    
                    $content .="<tr>
                            <td></td>
                            <td></td>
                            <td><b>Total</b></td>
                             <td style='text-align:right'><b>".number_format($total_ird,2)."</b></td>
                            <td style='text-align:right'><b>".number_format($total_additional,2)."</b></td>
                            <td style='text-align:right'><b>".number_format($agent_commission,2)."</b></td>
                            <td style='text-align:right'><b>".number_format($agent_debit,2)."</b></td>
                        </tr>";
                        
                     $content .="</tbody></table><br>";
            	    }
    	    echo $content;
               }
               
               else if($agent_list != "all")
               {
                   $agent_code_1 = $this->rm->get_single_agent_code($agent_list);
                   
                   if($agent_code_1 != NULL || $agent_code_1 !="")
                   {
                      $code=  $agent_code_1->agent_pos_code;
                   }
                   else
                   {
                      $code=  "";
                   }
                   
                   $res = $this->rm->fetch_agent_commission_report($from_date,$to_date,$agent_list);
    	               
        	           $content .="<table class='table' border='0'>
                            <tr>
                                <td style='font-size:16px;'>AGENT Code : ".$code."</td>
                                <td style='font-size:16px;'>Total no policies : ".count($res)."</td>
                            </tr>
                         </table>";
    	                 
    	                 $content .="<table class='table table-bordered'>
                                <tr>
                                      <td>Policy No</td>
                                      <td>Customer Name</td>
                                      <td>Agent Code</td>
                                      <td>IRD Commisison</td>
                                      <td>Additional Commission</td>
                                      <td>Total</td>
                                      <td>Debit</td>
                                </tr>
                                <tbody>";
                     $total_ird = 0;
                     $total_additional = 0;
                     $agent_commission = 0;
                     $agent_debit = 0;
                                
                    foreach($res as $da)
                    {
                       $total_ird = $total_ird +  $da->irdi_commission;
                       $total_additional = $total_additional + $da->additional_commission;
                       $agent_commission = $agent_commission + $da->agent_commission;
                       $agent_debit  = $agent_debit + $da->agent_debit;
                      
                        $content .="<tr>
                            <td>".$da->policy_no."</td>
                            <td>".$da->client_name."</td>
                            <td>".$da->agent_pos_code."</td>
                            <td style='text-align:right'>".number_format($da->irdi_commission,2)."</td>
                            <td style='text-align:right'>".number_format($da->additional_commission,2)."</td>
                            <td style='text-align:right'>".number_format($da->agent_commission,2)."</td>
                            <td style='text-align:right'>".number_format($da->agent_debit,2)."</td>
                        </tr>";
                    }
                    
                    $content .="<tr>
                            <td></td>
                            <td></td>
                            <td><b>Total</b></td>
                             <td style='text-align:right'><b>".number_format($total_ird,2)."</b></td>
                            <td style='text-align:right'><b>".number_format($total_additional,2)."</b></td>
                            <td style='text-align:right'><b>".number_format($agent_commission,2)."</b></td>
                            <td style='text-align:right'><b>".number_format($agent_debit,2)."</b></td>
                        </tr>";
                        
                     $content .="</tbody></table><br>";
                      echo $content;
            	    }
               }
            }
            
            
    public function fetch_agent_commision_report_excel()
    {
        if($this->session->has_userdata('logged_in')) 
    	{
    	    $this->load->library('Excel');
    	    $from_date = $this->input->post("from_date");
    	    $to_date = $this->input->post("to_date");
    	    $agent_list = $this->input->post("agents");
    	    
        	$objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            $rowCount = 4;
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'Agent Commission Report');
            
           $objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray( 
           array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'F50A1B')
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
            
            $objPHPExcel->getActiveSheet()->getStyle('3')->applyFromArray(
                array(
                    
                    'font'  => array(
                        'bold'  => true,
                        'color' => array('rgb' => '000000'),
                        'size'  => 13,
                    ),
                )
            );
            
           

            $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->SetCellValue('I3', 'Excel Date : ');
            $objPHPExcel->getActiveSheet()->SetCellValue('J3', date("d-m-Y"));
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
            $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Policy no');
            $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Customer Name');
            $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Agent Code');
            $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'IRD Commission');
            $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Additional Commission');
            $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Total Commission');
            $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'TDS');
        
            $row_count = 5;
            $a = 0;
        
            if($agent_list == "all")
            {
             $get_agent_code = $this->rm->get_agent_code($from_date,$to_date);
             
             foreach($get_agent_code as $agn)
             {
                $res = $this->rm->fetch_agent_commission_report($from_date,$to_date,$agn->policy_agency_pos);
                
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , "AGENT Code : ". $agn->agent_pos_code);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , "No of policies :". count($res));
                
                $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.'')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'DC5437')
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
            
                $objPHPExcel->getActiveSheet()->getStyle('C'.$row_count.'')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'DC5437')
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
            
                $row_count++;
                
             $total_ird = 0;
             $total_additional = 0;
             $agent_commission = 0;
             $agent_debit = 0;
                        
            foreach($res as $da)
            {
               $total_ird = $total_ird +  $da->irdi_commission;
               $total_additional = $total_additional + $da->additional_commission;
               $agent_commission = $agent_commission + $da->agent_commission;
               $agent_debit  = $agent_debit + $da->agent_debit;

                $a++;
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->policy_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->client_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->agent_pos_code);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , $da->irdi_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $da->additional_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->agent_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $da->agent_debit);
                
                $objPHPExcel->getActiveSheet()->getStyle('E'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('F'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('G'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('H'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');

                
                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
            }
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , "TOTAL ");
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , $total_ird);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $total_additional);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $agent_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $agent_debit);
                
                $objPHPExcel->getActiveSheet()->getStyle('D'.$row_count.'')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '37DCD2')
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
                $objPHPExcel->getActiveSheet()->getStyle('E'.$row_count.'')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '37DCD2')
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
                $objPHPExcel->getActiveSheet()->getStyle('F'.$row_count.'')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '37DCD2')
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
                $objPHPExcel->getActiveSheet()->getStyle('G'.$row_count.'')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '37DCD2')
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
                $objPHPExcel->getActiveSheet()->getStyle('H'.$row_count.'')->applyFromArray(
                    array(
                        'fill' => array(
                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array('rgb' => '37DCD2')
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
                
                $objPHPExcel->getActiveSheet()->getStyle('E'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('F'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('G'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('H'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');

                
                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
               $row_count++;
            }
            
              $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            	$objWriter->save('./datas/reports/agent_commission_report.xlsx');
            	echo base_url()."/datas/reports/agent_commission_report.xlsx";
            }
            else if($agent_list != "all")
            {
                $agent_code_1 = $this->rm->get_single_agent_code($agent_list);
                
                if($agent_code_1 != NULL || $agent_code_1 !="")
                {
                  $code=  $agent_code_1->agent_pos_code;
                }
                else
                {
                  $code=  "";
                }
                
                $res = $this->rm->fetch_agent_commission_report($from_date,$to_date,$agent_list);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , "AGENT Code : ". $code);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , "No of policies :". count($res));
                
                $objPHPExcel->getActiveSheet()->getStyle('B'.$row_count.'')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'DC5437')
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
                
                $objPHPExcel->getActiveSheet()->getStyle('C'.$row_count.'')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'DC5437')
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
                
                $row_count++;
                
                $total_ird = 0;
                $total_additional = 0;
                $agent_commission = 0;
                $agent_debit = 0;
                        
                foreach($res as $da)
                {
                $total_ird = $total_ird +  $da->irdi_commission;
                $total_additional = $total_additional + $da->additional_commission;
                $agent_commission = $agent_commission + $da->agent_commission;
                $agent_debit  = $agent_debit + $da->agent_debit;
                
                $a++;
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->policy_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->client_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->agent_pos_code);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , $da->irdi_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $da->additional_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->agent_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $da->agent_debit);
                
                $objPHPExcel->getActiveSheet()->getStyle('E'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('F'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('G'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('H'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                
                
                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
                }
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , "TOTAL ");
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , $total_ird);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $total_additional);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $agent_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $agent_debit);
                
                $objPHPExcel->getActiveSheet()->getStyle('D'.$row_count.'')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '37DCD2')
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
                $objPHPExcel->getActiveSheet()->getStyle('E'.$row_count.'')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '37DCD2')
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
                $objPHPExcel->getActiveSheet()->getStyle('F'.$row_count.'')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '37DCD2')
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
                $objPHPExcel->getActiveSheet()->getStyle('G'.$row_count.'')->applyFromArray(
                array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => '37DCD2')
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
                $objPHPExcel->getActiveSheet()->getStyle('H'.$row_count.'')->applyFromArray(
                    array(
                        'fill' => array(
                            'type' => PHPExcel_Style_Fill::FILL_SOLID,
                            'color' => array('rgb' => '37DCD2')
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
                
                $objPHPExcel->getActiveSheet()->getStyle('E'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('F'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('G'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('H'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                
                
                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
                }
                
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                $objWriter->save('./datas/reports/agent_commission_report.xlsx');
                echo base_url()."/datas/reports/agent_commission_report.xlsx";
        }
    }
        
    public function fetch_agent_report_excel()
    {
        if($this->session->has_userdata('logged_in')) 
    	{
    	    $this->load->library('Excel');
    	    
        	$objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            $rowCount = 4;
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
            $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(20);
            $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
            $agent_type = $this->input->post("agent_type");
            if($agent_type == "agent")
            {
                $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'Agent Report');
            }
            else
            {
                $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'POS Report');
            }
            
           $objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray( 
           array(
                    'fill' => array(
                        'type' => PHPExcel_Style_Fill::FILL_SOLID,
                        'color' => array('rgb' => 'F50A1B')
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
            
            $objPHPExcel->getActiveSheet()->getStyle('3')->applyFromArray(
                array(
                    
                    'font'  => array(
                        'bold'  => true,
                        'color' => array('rgb' => '000000'),
                        'size'  => 13,
                    ),
                )
            );
            
           

            $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Excel Generated Date : ');
            $objPHPExcel->getActiveSheet()->SetCellValue('D3', date("d-m-Y"));
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
            $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Agent Code');
            $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Agent Name');
             $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Region');
              $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Area Incharge');
               $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'FOE');
            $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Email');
            $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Mobile');
            $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Agent Status');
            $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Agent Category');
            $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'Address');
            $objPHPExcel->getActiveSheet()->SetCellValue('L4', 'State');
            $objPHPExcel->getActiveSheet()->SetCellValue('M4', 'City');
            $objPHPExcel->getActiveSheet()->SetCellValue('N4', 'Pincode');
            $objPHPExcel->getActiveSheet()->SetCellValue('O4', 'Office Address');
            $objPHPExcel->getActiveSheet()->SetCellValue('P4', 'Dob');
            $objPHPExcel->getActiveSheet()->SetCellValue('Q4', 'Bank Name');
            $objPHPExcel->getActiveSheet()->SetCellValue('R4', 'Bank A/c no');
            $objPHPExcel->getActiveSheet()->SetCellValue('S4', 'IFSC Code');
            $objPHPExcel->getActiveSheet()->SetCellValue('T4', 'Bank Branch');
            $objPHPExcel->getActiveSheet()->SetCellValue('U4', 'Pan No');
            $objPHPExcel->getActiveSheet()->SetCellValue('V4', 'Aadhar No');
        
                $row_count = 5;
                $a = 0;//
                if(!empty($_POST["agent_type"]))
                {
                    $agent_type = $this->input->post("agent_type");
                    $agent_list = $this->rm->fetch_agent_using_type($agent_type);
                     foreach($agent_list as $da)
                     {
                        
                        $foe = $this->rm->get_user_name($da->user_id);
                        
                        $foe_name = "";
                        
                        if($foe != null)
                        {
                           $foe_name  = $foe->name;
                        }
                        else
                        {
                            $foe_name  = "";
                        }
                        
                        $a++;
                        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->agent_pos_code);
                        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->name);
                        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->region_name);
                        $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , $da->ai_name);
                        $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $foe_name);
                           
                        $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->email_id);
                        $objPHPExcel->getActiveSheet()->setCellValueExplicit('H'.$row_count , $da->phoneno);
                        $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , $da->status);
                        $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row_count , $da->commission_category);
                        $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row_count , $da->address);
                        $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row_count , $da->state);
                        $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row_count , $da->city);
                        $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row_count , $da->pincode);
                        $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row_count , $da->office_address);
                        $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row_count , date('d-m-Y', strtotime($da->dob)));
                        $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row_count , $da->bank_name);
                        $objPHPExcel->getActiveSheet()->setCellValueExplicit('R'.$row_count , $da->bank_acc_no);
                        $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row_count , $da->ifsc_code);
                        $objPHPExcel->getActiveSheet()->SetCellValue('T'.$row_count , $da->branch);
                        $objPHPExcel->getActiveSheet()->setCellValueExplicit('U'.$row_count , $da->pan_card_no);
                        $objPHPExcel->getActiveSheet()->setCellValueExplicit('V'.$row_count , $da->adhar_card_no);
                        
                        $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                       $row_count++;
                    }
                    
                  $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                   $agent_type = $this->input->post("agent_type");
                    if($agent_type == "agent")
                    {
                	    $objWriter->save('./datas/reports/agent_report.xlsx');
                	    echo base_url()."/datas/reports/agent_report.xlsx";
                    }
                    else
                    {
                        $objWriter->save('./datas/reports/pos_report.xlsx');
                	    echo base_url()."/datas/reports/pos_report.xlsx";
                    }
                }
                else
                {
                    echo "authentication failed";
                }
            }
        }
    // Insurance Invoice generation
    
    public function insurance_invoice_generation()
    {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        // if(!$this->auth->can_access('Insurance Invoice Generation')){
        //     redirect('access_denied', 'refresh');
        // }
        if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        { 
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $this->load->view('header',$pro_data);
            $data["class"] = $this->rm->fetch_list_of_class();
            $this->load->view('insurance_invoice_generation',$data);
            $this->load->view('footer',$pro_data);
        }
    }
    
    public function load_all_insurances_list()
    {
        if($this->session->has_userdata('logged_in')) 
    	{
    	    $res = $this->rm->fetch_all_insurances_list();
    	    echo json_encode($res);
    	}
    }
    
    // comment by kgk on 2023-05-09
    public function _single_insurance_policies()
    {
        if($this->session->has_userdata('logged_in')) 
        { 
            $content = "";
    	    $insurance = $this->input->post("insurance");
    	    $from_date = $this->input->post("from_date");
    	    $to_date = $this->input->post("to_date");
    	    $policy_class = $this->input->post("policy_class");
    	    $policy_gen_from = $this->input->post("policy_gen_from");
    	    
    	    $insurance_data = $this->rm->get_insurance_company($insurance);
            
            $insurance_1 = $this->rm->get_single_insurance_company($insurance);
            
            if($insurance_1 != NULL || $insurance_1 !="")
            {
                $code = $insurance_1->vchaccid;
            }
            else
            {
                $code=  "";
            }
            
    

            $res = $this->rm->fetch_single_insurance_company_invoice($code,$from_date,$to_date,$policy_class, $policy_gen_from);
            
            //echo $this->db->last_query();
            
        
            
        $res1 = $this->rm->fetch_single_insurance_company_invoice_acc($code,$from_date,$to_date,$policy_class, $policy_gen_from);
        
            $policy_type = [];
            
             foreach($res as $da)
             {
                 if(!in_array(trim($da->policy_type),$policy_type))
                 {
                    array_push($policy_type,trim($da->policy_type)); 
                 }
             }         
             
             //echo '<pre>';print_r($policy_type);print'</pre>';

            $content .="<table class='table' border='0'>
                            <tr>
                            <td style='font-size:16px;'>Insurance Name : ".$insurance_data->company_name."</td>
                            <td style='font-size:16px;'>Total no policies : ".count($res)."</td>
                            </tr>
                        </table>";
            
            $content .="<table class='table table-bordered'>
            <tr>
                  <td>Policy Type</td>
                  <td>Policy Count</td>
                  <td>Own Commisison</td>
            </tr>
            <tbody>";
            $total_ird = 0;
            $total_additional = 0;
            $tot_agent_commission = 0;
            $agent_debit = 0;
            $tot_tds = 0;
            $policy_count = 0;
            $policy_total_count =0;
            
            
      if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") 
         {
            
            foreach($policy_type as $pt)
            {
                $own_commission =0;
                $policy_count =0;
                $irdi_commission =0;
                  foreach($res as $da)
                 {

                  if($pt == trim($da->policy_type))
                  {
                      $policy_count++;
                      
                   $own_commission = $own_commission + $da->credit;
                }
            }
             $total_ird = $own_commission+$total_ird;
              $policy_total_count = $policy_count+$policy_total_count;
              
            $content .="<tr>
                    <td>".$pt."</td>
                    <td style='text-align:right'>".$policy_count."</td>
                    <td style='text-align:right'>".number_format(floor($own_commission),2)."</td>
                    </tr>";
            
          }
            
         }
         else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
        { 
            
            $policy_type1 =[];
            
            foreach($res1 as $da)
             {
                 if(!in_array(trim($da->policy_type),$policy_type1))
                 {
                    array_push($policy_type1,trim($da->policy_type)); 
                 }
             }
            
            
            foreach($policy_type1 as $pt)
            {
                $own_commission =0;
                $policy_count =0;
                $irdi_commission =0;
                  foreach($res1 as $da1)
                 {

                  if($pt == trim($da1->policy_type))
                  {
                      $policy_count++;
                      
                   $own_commission =  $da1->credit + $own_commission;


                }
            }
            $total_ird = $own_commission+$total_ird;
            $policy_total_count = $policy_count+$policy_total_count;
            $content .="<tr>
                    <td>".$pt." 
                    <input type='text' class='pt' name='custom_policy_name[".$da1->policy_type."]' value='' data-value = '".$da1->policy_type."'></td>
                    <td style='text-align:right'>".$policy_count."</td>
                    <td style='text-align:right'>".number_format(floor($own_commission),2)."</td>
                    </tr>";
            
          }
         }
            
            $content .="<tr>
            <td><b>Total</b></td>
            <td style='text-align:right'><b>".number_format(floor($policy_total_count))."</b></td>
            <td style='text-align:right'><b>".number_format(floor($total_ird),2)."</b></td>
            </tr>";
            $content .="</tbody></table><br>";
            
            if(count($res) > 0 || count($res1) > 0) {
                $content .="<button type='button' class='btn btn-primary pull-right' id='vocher_gen_btn' onclick=vocher()>Save Vocher</button>";    
            }
            
            echo $content;
	   }
	}
    
    // comment by kgk on 2023-05-09
    public function _save_insurance_policy()
    {
        if($this->session->has_userdata('logged_in')) 
        { 
            $today = new DateTime();
    	    $insurance = $this->input->post("insurance");
    	    $from_date = $this->input->post("from_date");
    	    $to_date = $this->input->post("to_date");
    	    $policy_class = $this->input->post("policy_class");
    	    $policy_arr = $this->input->post("policy_arr");
    	    $policy_gen_from = $this->input->post("policy_gen_from");
    	    
    	    $insur_commission_status = "1";
            $custom_policy_name = [];
            if( isset( $policy_arr ) && !empty($policy_arr)){
                $custom_policy_name = array_values($policy_arr);
            }
            
            //echo '<pre>';print_r($policy_arr);print_r($custom_policy_name);echo '</pre>';
            
            
    	    $insurance_data = $this->rm->get_insurance_company($insurance);
            $date = date("Y-m-d H:i:s");
            $year = date('y');
            $month = date('m');
            if($month < 4)
             {
                $year = $year-1;
             }
             
    	    $i = 0;

            $insurance_1 = $this->rm->get_single_insurance_company($insurance);
            
            if($insurance_1 != NULL || $insurance_1 !="")
            {
                $code = $insurance_1->vchaccid;
            }
            else
            {
                $code=  "";
            }
            

            $res = $this->rm->fetch_single_insurance_company_invoice($code,$from_date,$to_date,$policy_class, $policy_gen_from);
        
            
        $res1 = $this->rm->fetch_single_insurance_company_invoice_acc($code,$from_date,$to_date,$policy_class, $policy_gen_from);
        
            $policy_type = [];
            
             foreach($res as $da)
             {
                 if(!in_array($da->policy_type,$policy_type))
                 {
                    array_push($policy_type,$da->policy_type); 
                 }
             } 
             
              $policy_type_orc = [];
            
             foreach($res1 as $da1)
             {
                 if(!in_array($da1->policy_type,$policy_type_orc))
                 {
                    array_push($policy_type_orc,$da1->policy_type); 
                 }
             } 
             
             
           $data = [];     


            $total_ird = 0;
            $total_additional = 0;
            $tot_agent_commission = 0;
            $agent_debit = 0;
            $tot_tds = 0;
            $policy_count = 0;
            $policy_total_count =0;
            
            
            $x = 0;
                do 
                {
                  $x++;
                  $new_vocher_no = "inv".$x."/".$year;
                } 
                while($this->rm->vocher_number_already_exit($new_vocher_no));
            
            foreach($policy_type as $pt)
            {
                $own_commission =0;
                $policy_count =0;
                $irdi_commission =0;
                  foreach($res as $da)
                 {

                  if($pt == $da->policy_type)
                  {
                      $policy_count++;
                      
                   $own_commission = $own_commission + $da->credit;
                    $data[$i]['insurer_id'] = $insurance;//$insurance_data->company_name;
                    $data[$i]['polic_type'] = $da->policy_type;
                    $data[$i]['voucher_no'] = $new_vocher_no;
                    $data[$i]['lead_id'] = $da->lead_id;
                    $data[$i]['own_commission'] = $da->credit;
                    $data[$i]['fromdate'] = $from_date; 
                    $data[$i]['todate'] = $to_date;
                    $data[$i]['created_at'] = $today->format('Y-m-d H:i:s');
                    $data[$i]['created_by'] = $this->session->userdata("session_id");
                    $i++;

                }
                
                 //$lead_id = $da->lead_id;
                 
                 $leadIDS[] = $da->lead_id;

                 
            }
             $total_ird = $own_commission+$total_ird;
             $policy_total_count = $policy_count+$policy_total_count;

          }
            
            
          
            $result = $this->rm->add_insurance_voucher_details($data);
            
            $data_1 = array("insur_commission_status" =>$insur_commission_status);
            

            $res_1 = $this->rm->add_insur_commission_status($data_1);
            
            
            $lead_update = array("company_vocher_status" =>"1");
             
              $lead_update = $this->rm->update_company_vocher_status($leadIDS,$lead_update);
              
              
              $u = 0;
               do
               {
                   $u++;
                   $unicorn_vocher_no = "uni".$u."/".$year;
               }
               while($this->rm->vocher_unicorn_no_already_exit($unicorn_vocher_no));
               
            $data1= [];
            
            $j = 0;
            
            foreach($policy_type_orc as $pt1)
            {
                $own_commission =0;
                $policy_count =0;
                $irdi_commission =0;
                  foreach($res1 as $da1)
                 {

                  if($pt1 == $da1->policy_type)
                  { 
                      $policy_count++;
                    $data1[$j]['insurer_id']  = $insurance;//$insurance_data->company_name;
                    $data1[$j]['polic_type'] = (isset($custom_policy_name[0][$da1->policy_type]) && !empty($custom_policy_name[0][$da1->policy_type])) ?   $custom_policy_name[0][$da1->policy_type] : $da1->policy_type;
                    $data1[$j]['voucher_no'] = $unicorn_vocher_no;
                    $data1[$j]['lead_id'] = $da1->lead_id;
                    $data1[$j]['own_commission'] = $da1->credit; 
                    $data1[$j]['fromdate'] = $from_date; 
                    $data1[$j]['todate'] = $to_date;
                    $data1[$j]['created_at'] = $today->format('Y-m-d H:i:s');
                    $data1[$j]['created_by'] = $this->session->userdata("session_id");
                   $j++;

                }
            }
            $total_ird = $own_commission+$total_ird;
            $policy_total_count = $policy_count+$policy_total_count;
    
          }
          
          $result = $this->rm->add_insurance_voucher_details_orc($data1);
            
            
            
             echo json_encode(array("status"=>"success","arr" =>$new_vocher_no,'uni' => $unicorn_vocher_no));
            
/*            
      if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") 
         {
             
             $x = 0;
                do 
                {
                  $x++;
                  $new_vocher_no = "inv".$x."/".$year;
                } 
                while($this->rm->vocher_number_already_exit($new_vocher_no));
            
            foreach($policy_type as $pt)
            {
                $own_commission =0;
                $policy_count =0;
                $irdi_commission =0;
                  foreach($res as $da)
                 {

                  if($pt == $da->policy_type)
                  {
                      $policy_count++;
                      
                   $own_commission = $own_commission + $da->credit;
                    $data[$i]['insurer_id']  =$insurance_data->company_name;
                    $data[$i]['polic_type'] = $da->policy_type;
                    $data[$i]['voucher_no'] = $new_vocher_no;
                    $data[$i]['lead_id'] = $da->lead_id;
                    $data[$i]['own_commission'] = $da->credit;
                    $i++;

                }
                
                 //$lead_id = $da->lead_id;
                 
                 $leadIDS[] = $da->lead_id;

                 
            }
             $total_ird = $own_commission+$total_ird;
             $policy_total_count = $policy_count+$policy_total_count;

          }
            
            
          
            $result = $this->rm->add_insurance_voucher_details($data);
            
            $data_1 = array("insur_commission_status" =>$insur_commission_status);
            

            $res_1 = $this->rm->add_insur_commission_status($data_1);
            
            
            $lead_update = array("company_vocher_status" =>"1");
             
              $lead_update = $this->rm->update_company_vocher_status($leadIDS,$lead_update);
             echo json_encode(array("status"=>"success","arr" =>$new_vocher_no));
         }
         else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
        { 
            
             $u = 0;
               do
               {
                   $u++;
                   $unicorn_vocher_no = "uni".$u."/".$year;
               }
               while($this->rm->vocher_unicorn_no_already_exit($unicorn_vocher_no));
               
            $data1= [];
            
            $j = 0;
            
            foreach($policy_type_orc as $pt1)
            {
                $own_commission =0;
                $policy_count =0;
                $irdi_commission =0;
                  foreach($res1 as $da1)
                 {

                  if($pt1 == $da1->policy_type)
                  { 
                      $policy_count++;
                    $data1[$j]['insurer_id']  =$insurance_data->company_name;
                    $data1[$j]['polic_type'] = (isset($custom_policy_name[0][$da1->policy_type]) && !empty($custom_policy_name[0][$da1->policy_type])) ?   $custom_policy_name[0][$da1->policy_type] : $da1->policy_type;
                    $data1[$j]['voucher_no'] = $unicorn_vocher_no;
                    $data1[$j]['lead_id'] = $da1->lead_id;
                    $data1[$j]['own_commission'] = $da1->credit; 
                   $j++;

                }
            }
            $total_ird = $own_commission+$total_ird;
            $policy_total_count = $policy_count+$policy_total_count;
    
          }
          
          $result = $this->rm->add_insurance_voucher_details_orc($data1);
           echo json_encode(array("status"=>"success","arr" =>$unicorn_vocher_no));
           
         }
*/       
	   }
	}
	
	// comment by kgk on 2023-05-09
	public function _company_invoice_report() {
        if(!$this->session->has_userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        
        // if(!$this->auth->can_access('Company Invoice Report')){
        //     redirect('access_denied', 'refresh');
        // }
        
        $pro_data["project_info"]   = $this->mm->fetch_project_info();
        $data["monthlist"]          = $this->getMonthList();
        $companylist                = $this->rm->getCompanyByInvoice();
        $data['invoiceinfo']        = ( isset( $results ) && !empty( $results ) ) ? $results : [];
        
        $data['companylist']        = $companylist;
        $data["classlist"]          = $this->rm->get_class_list();
        
        $this->load->view('header',$pro_data);
        $this->load->view('company_invoice_report',$data);
        $this->load->view('footer',$pro_data);
    }
    
    // comment by kgk on 2023-05-09
    public function _fetch_company_invoice_report()
    {
        if($this->session->has_userdata('logged_in')) 
        { 
            $content = "";
            
            $org = 1;     
            if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") {
                  $org = 1;                             
            } else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn") {
                $org = 2;
            }
        
    	    $insurance = $this->input->post("insurance");
    	    $from_date = $this->input->post("from_date");
    	    $to_date = $this->input->post("to_date");
    	    $policy_class = $this->input->post("policy_class");
    	    
    	    $insurance_data = $this->rm->get_insurance_company($insurance);

            $insurance_1 = $this->rm->get_single_insurance_company($insurance);
            
            if($insurance_1 != NULL || $insurance_1 !="")
            {
                $code = $insurance_1->vchaccid;
            }
            else
            {
                $code=  "";
            }
            
            $policy_type = [];

            $invoices = $this->rm->getCompanyinvoice($insurance,$from_date,$to_date,$policy_class,$org, '');
            
            //echo $this->db->last_query();
            
            $vouchar = (isset($invoices[0]->invvouchar) && !empty($invoices[0]->invvouchar)) ? trim($invoices[0]->invvouchar) : "";
            
            $vouchar_date = (isset($invoices[0]->created_at) && !empty($invoices[0]->created_at)) ? $invoices[0]->created_at : "";
            
            $fn = "exportpdf('{$vouchar}', '{$org}')";
            
            $content .="<table class='table' border='0'>
                            <tr>
                                <td style='font-size:16px;'>Insurance Name : ".((isset($insurance_data->company_name)) ? $insurance_data->company_name : "")."</td>
                                <td style='font-size:16px;'>Total no policies : ".count($invoices)."</td>
                                
                                <td style='font-size:16px;'>Vouchar No : ".$vouchar."</td>
                                
                                <td style='font-size:16px;'>Vouchar Date : ".$vouchar_date." </td>";
                                
                                if( isset( $invoices ) && !empty( $invoices ) )
                                    $content .= '<td><input type="button" value="Export PDF" onclick="exportpdf(\''.$vouchar.'\', '.$org.')"/></td>';
                                
                            $content .= "</tr>
                                        </table>";
                        
            $total_amt = $total_cnt = 0;$policylist = [];
            foreach($invoices as $row) {
                $policy_type = trim($row->polic_type);
                if(!isset($policylist[$policy_type])){
                    $policylist[$policy_type] = 0;
                    $policycount[$policy_type] = 1;
                }
                
                $policylist[$policy_type] += (float)$row->own_commission;
                $policycount[$policy_type] += 1;
                $total_amt += (float)$row->own_commission;
                $total_cnt += 1;
            }
            
            $content .="<table class='table table-bordered'>
                            <tr>
                                <td>Sl.No.</td>
                                <td>Policy Type</td>
                                <td style='text-align:right'>Policy Count</td>
                                <td style='text-align:right'>Own Commisison</td>
                            </tr>
                        <tbody>";
                        
            if(isset($policylist) && !empty($policylist)){
                $sl = 1;
                foreach($policylist as $policy_name => $policy_amt){
                    $policy_count = (isset($policycount[$policy_name]) && !empty($policycount[$policy_name])) ? $policycount[$policy_name] : 0;
                    $content .= "<tr>";
                        $content .= "<td>".($sl++)."</td>";
                        $content .= "<td>".$policy_name."</td>";
                        $content .= "<td><span class='pull-right'>".$policy_count."</span></td>";
                        
                        $content .= "<td><span class='pull-right'>".$policy_amt."</span></td>";
                    $content .= "</tr>";
                }
            }
            
            $content .="<tr>
                            <td colspan='2' style='text-align:right' ><b>Total</b></td>
                            <td style='text-align:right'><b>".number_format(floor($total_cnt))."</b></td>
                            <td style='text-align:right'><b>".number_format(floor($total_amt),2)."</b></td>
                            </tr>";
            $content .="</tbody></table><br>";
            
            $content .="<h4>Invoice Breakup List</h4><hr>";
            
            $content .="<table class='table' id='tbl_invoice'>
                        <thead>
                            <tr>
                                  <th>Sl.No.</th>
                                  <th>Policy Type</th>
                                  <th>Policy No</th>
                                  
                                  <th style='text-align:right'>Own Commisison</th>
                            </tr>
                        </thead>
                        <tbody>";
            
            if(isset($invoices) && !empty($invoices)) {
                $sl = 1;
                foreach( $invoices as $invoice ) {
                    $content .= "<tr>";
                        $content .= "<td>".($sl++)."</td>";
                        $content .= "<td>".trim($invoice->polic_type)."</td>";
                        $content .= "<td>".trim($invoice->policy_no)."</td>";
                        $content .= "<td><span class='pull-right'>".$invoice->own_commission."</span></td>";
                    $content .= "</tr>";
                }
                $content .="</tbody><tfoot>";
                $content .="<tr>
                            <td></td>
                            <td></td>
                            <td style='text-align:right'><b>Total : </b></td>
                            <td style='text-align:right'><b>".number_format(floor($total_amt),2)."</b></td>
                            </tr>";
                $content .="</tfoot></table><br>";
            }
        
            echo $content;
	   }
	}

    public function agent_vocher_generation()
    {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        // if(!$this->auth->can_access('Agent Vocher Generation')){
        //     redirect('access_denied', 'refresh');
        // }
        if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        { 
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $userslist = $this->rm->getUserList();
    	    $data['userslist'] = $userslist;
    	    
            $this->load->view('header',$pro_data);
            $this->load->view('agent_vocher_generation', $data);
            $this->load->view('footer',$pro_data);
        }
    }
    	
	public function single_agent_policies()
	{
	    if($this->session->has_userdata('logged_in')) 
        { 
            $content = "";
            $from_date = $this->input->post("from_date");
    	    $to_date = $this->input->post("to_date");
    	    $agent_list = $this->input->post("agents"); 
    	    
            
            $agent_code_1 = $this->rm->get_single_agent_code($agent_list);
            
            if($agent_code_1 != NULL || $agent_code_1 !="")
            {
                $code=  $agent_code_1->agent_pos_code;
            }
            else
            {
                $code=  "";
            }
            
            $res = $this->rm->fetch_single_agent_commission_report($from_date,$to_date,$agent_list);
            
            $res1 = $this->rm->fetch_single_agent_commission_report_orc($from_date,$to_date,$agent_list);
            
            $this->fetch_policy_list_table($res,$res1,$code);
	   }
	}
	
	public function fetch_policy_list_table($res,$res1,$code = '')
	{
	    $content ="";
	    
	               $content .="<table class='table' border='0'>
                            <tr>
                            <td style='font-size:16px;'>AGENT Code : ".$code."</td>
                            <td style='font-size:16px;'>Total no policies : ".count($res)."</td>
                            </tr>
                        </table>";
            
            $content .="<table class='table table-bordered' id='policy_list'>
            <thead>
            <tr>
                  <td><input type='checkbox' class='form-check-input select_all' id='select_all' onclick=select_all()>&nbsp;Select All</td>
                  <td>Policy No</td>
                  <td>Insurer</td>
                  <td>Customer Name</td>
                  <td> Commisison</td>
    
            </tr>
            </thead>
            <tbody>";
            $total_ird = 0;
            $total_additional = 0;
            $tot_agent_commission = 0;
            $agent_debit = 0;
            $tot_tds = 0;
            
         if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") 
         {

            foreach($res as $da)
            {
                $agent_commission = $da->agent_commission_amt;
                //$irdi_commission = $agent_commission * 15/100; 
                //$additional_commission = $agent_commission - $irdi_commission;
                $tds = "0";
                
                //$total_ird = $irdi_commission + $total_ird;
                //$total_additional = $additional_commission + $total_additional;
                $tot_agent_commission = $tot_agent_commission + $agent_commission;
                
                $content .="<tr>
                <td><input type='checkbox' value=".$da->id." class='form-check-input check'></td>
                <td>".$da->policy_no."</td>
                <td>".$da->company_name."</td>
                <td>".$da->client_name."</td>
                <td style='text-align:right'>".number_format(floor($agent_commission),2)."</td>";
            }
            
         }
        else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
        {
             foreach($res1 as $daa)
            {
                $agent_commission = $daa->agent_commission + $daa->additional_commission + $daa->agn_add_com;
                $irdi_commission = 0; 
               //$additional_commission = $agent_commission - $irdi_commission;
                $tds = "0";
                
                //$total_ird = $irdi_commission + $total_ird;
                //$total_additional = $additional_commission + $total_additional;
                $tot_agent_commission = $tot_agent_commission + $agent_commission;
                
                $content .="<tr>
                <td><input type='checkbox' value=".$daa->id." class='form-check-input check'></td>
                <td>".$daa->policy_no."</td>
                <td>".$daa->company_name."</td>
                <td>".$daa->client_name."</td>
                <td style='text-align:right'>".number_format(floor($agent_commission),2)."</td>";
            }
            
            
        } 
            
            $content .="<tr>
            <td>z</td>
            <td></td>
            <td></td>
            <td><b>Total</b></td>

            <td style='text-align:right'><b>".number_format(floor($tot_agent_commission),2)."</b></td>
            </tr>";
            $content .="</tbody></table><br>";
            $content .="<button type='button' class='btn btn-success pull-right' id='vocher_gen_btn' onclick=vocher()>Generate Vocher</button>";
            echo $content;
	}
    	
     public function _generate_vocher1()
     {
         if($this->session->has_userdata('logged_in')) 
         { 
                $policy_arr = $this->input->post("policy_arr");
                $agent = $this->input->post("agent");
                $date = date("Y-m-d H:i:s");
                $year = date('y');
                $month = date('m');
                if($month < 4)
                {
                    $year = $year-1;
                }
                $agent_code = $this->rm->get_agent_code_by_id($agent);
                
                //$data0 = $this->rm->get_tds_accvarcharid($agent_code->agent_pos_code);
                
                // if($data0 != "")
                // {
                
                    $x = 0;
                    do 
                    {
                      $x++;
                      $new_vocher_no = "av".$x."/".$year;
                    } 
                    while($this->rm->vocher_no_already_exits($new_vocher_no));
                    
                    $data = array("vocher_no" =>$new_vocher_no,"vocher_status" =>"1","vocher_date"=>$date);
                    
                    $total_commission = 0;
                    
                    for($i= 0;$i<count($policy_arr);$i++)
                    {
                         $res = $this->rm->update_vocher_details($data,$policy_arr[$i]);
                         $total_commission = $total_commission + $res->agent_commission_amt + $res->agn_add_com;
                         $agent_id = $res->policy_agency_pos;
                    }
                    
                    $tds_data = $this->rm->get_tds_percentage();
                    
                    // if($tds_data != "")
                    // {
                    //   $tds = $tds_data->tds_percentage;
                    // }
                    // else
                    // {
                    //   $tds = 0;
                    // }
                    
                    //$tds_amount = floor($total_commission) * $tds/100;
                   
                    // $tds_arr = array(
                    //                     "agent_id" =>$agent_id,
                    //                     "vhcharaccid" =>$data0->account_id,
                    //                     "vocher_no" =>$new_vocher_no,
                    //                     "tds_amount" =>ceil($tds_amount),
                    //                     "created_at"=>date("Y-m-d H:i:s"),
                    //                     "created_by"=>$this->session->userdata("session_id")
                    //             );
                    // $tds_log = $this->rm->update_tds_log($tds_arr);
                    
                    $agent_commission = $total_commission;
                    $net = floor($total_commission) - 0;
                    
                    // Voucher Details Table
                    
                    $voucher_data = array(
                                        "agent_id" =>$agent_id,
                                        "voucher_no" =>$new_vocher_no,
                                        "total_commission" =>floor($net),
                                        "created_by"=>$this->session->userdata("session_id"),
                                        "created_at" =>date("Y-m-d H:i:s"),
                                     );
                    
                    $result = $this->rm->add_agent_voucher_details($voucher_data);
                    $main_ledger = $this->rm->get_ledger_acc($agent_id);
                    
                   //Agent commission table IRDA
                   
                    $irda_com = 15/100 * $net;
                    $orc_com = $net - $irda_com;
                    
                    $commission_arr = array(
                                "agent_id" =>$agent_id,
                                "voucher_no" =>$new_vocher_no,
                                "vhcharaccid" =>$main_ledger->vchaccname,
                                "credit" =>floor($irda_com),
                                "date" =>date("Y-m-d"),
                                "tds" =>0,
                                "created_by"=>$this->session->userdata("session_id"),
                                "created_at" =>date("Y-m-d H:i:s"),
                             );
                             
                    if( isset( $main_ledger->vchaccname ) && !empty( $main_ledger->vchaccname ) ) {
                        $res_1 = $this->rm->add_agent_commission($commission_arr); 
                    }
                    
                    
                    
                  //Agent commission table ORC
                  $commission_arr_2 = array(
                                "agent_id" =>$agent_id,
                                "voucher_no" =>$new_vocher_no,
                                "vhcharaccid" =>$main_ledger->vchaccname,
                                "credit" =>floor($orc_com),
                                "date" =>date("Y-m-d"),
                                "tds" =>0,
                                "created_by"=>$this->session->userdata("session_id"),
                                "created_at" =>date("Y-m-d H:i:s"),
                             );
                             
                    if( isset( $main_ledger->vchaccname ) && !empty( $main_ledger->vchaccname ) ) {
                        $res_2 = $this->rm->add_agent_commission_orc($commission_arr_2); 
                    }
                    
                    //Calculations 
                    //$this->calc_agent_commission($agent_id,$main_ledger->account_id);
                   // $this->calc_tds_amount($agent_id,$data0->account_id);
                    echo json_encode(array("status"=>"success","arr" =>$res));
                // }
                // else
                // {
                //     echo json_encode(array("status"=>"Agent Ledger Not Available"));
                // }
               
         }
     }

    // comments by kgk on 2023-05-09
    public function _generate_vocher()
    {
        
        if($this->session->has_userdata('logged_in')) 
        { 
            $this->db->trans_begin(); #begin transaction
            
            $policy_arr = $this->input->post("policy_arr");
            $from_date = $this->input->post("from_date");
            $to_date = $this->input->post("to_date");
            $agent = $this->input->post("agent");
            $date = date("Y-m-d H:i:s");
            $year = date('y');
            $month = date('m');
            if($month < 4) {
                $year = $year-1;
            }
                
            
                    
            $total_commission = 0;
            $agent_commissions = $agentlists = [];
            for($i= 0;$i<count($policy_arr);$i++)
            {
                $res    = $this->rm->getPolicyByID($policy_arr[$i]);
                
                if( isset( $res ) && !empty( $res ) ){
                    $agent_id   = $res->policy_agency_pos;
                    
                    if( !in_array($agent_id, $agentlists) ){
                        $agents = $this->rm->get_agent_code_by_id($agent_id);
                        $_agent_code = (isset($agents) && !empty($agents) ) ? $agents->agent_pos_code : "";
                        $x = 0;
                        do 
                        {
                          $x++;
                          $new_vocher_no = "av/{$_agent_code}/".$x."/".$year;
                        }
                        while($this->rm->vocher_no_already_exits($new_vocher_no));
                       
                        
            	       
                        $agentlists[] = $agent_id;
                        $vouchlist[$agent_id] = $new_vocher_no;
                        
                        
                        $agent_commissions[$agent_id] = 0;
                    }
                    
                    $data   = array("vocher_no" =>$new_vocher_no,"vocher_status" =>"1","vocher_date"=>$date);
                        
                        $upres    = $this->rm->update_vocher_details($data,$policy_arr[$i]);
                        if( $upres ) {
            	            $this->audit->log('policy_info', 'UPDATE', null, $res, $data);
            	        }
            	        
                    $policyinfo[$agent_id][$res->id] = $vouchlist[$agent_id];
                     
                    
                    $agent_commissions[$agent_id] += $res->agent_commission_amt + $res->agn_add_com;
                    //$agent_commissions_data[$agent_id][]= $res->agent_commission_amt + $res->agn_add_com;                    
                }

            }
            
           
            if( isset($agentlists) && !empty($agentlists) ) {
                foreach($agentlists as $_agent_id) {
                    
                    $total_commission   = (isset($agent_commissions[$_agent_id]) && $agent_commissions[$_agent_id] != '') ? $agent_commissions[$_agent_id] : 0;
                    $agent_commission   = $total_commission;
                    $net                = floor($total_commission) - 0;
                    
                    $voucher_data = array(
                        "agent_id"          => $_agent_id,
                        "voucher_no"        => $vouchlist[$_agent_id],//$new_vocher_no,
                        "total_commission"  => floor($net),
                        "created_by"        => $this->session->userdata("session_id"),
                        "created_at"        => date("Y-m-d H:i:s"),
                        'from_date'         => $from_date,
                        'to_date'           => $to_date,
                        
                    );
            
                    $result      = $this->rm->add_agent_voucher_details($voucher_data);
                    $main_ledger = $this->rm->get_ledger_acc($_agent_id);
                    $irda_com    = 15/100 * $net;
                    $orc_com     = $net - $irda_com;
                    
                    /*
                    $tds_data    = $this->rm->get_tds_percentage();
                    $tds         = (isset($tds_data->tds_percentage) && $tds_data->tds_percentage; != '') ? $tds_data->tds_percentage : 0;
                    $tds_amount  = floor($total_commission) * $tds/100;
                    */
                    
                    //Agent commission table IRDA
                    if( isset( $main_ledger->vchaccname ) && !empty( $main_ledger->vchaccname ) ) {
                    $commission_arr = array(
                        "agent_id"      => $_agent_id,
                        "voucher_no"    => $vouchlist[$_agent_id],//$new_vocher_no,
                        "vhcharaccid"   => $main_ledger->vchaccname,
                        "credit"        => floor($irda_com),
                        "date"          => date("Y-m-d"),
                        "tds"           => 0,
                        "created_by"    => $this->session->userdata("session_id"),
                        "created_at"    => date("Y-m-d H:i:s"),
                    );
                     
                    
                        $res_1 = $this->rm->add_agent_commission($commission_arr);
                    }
                    if( $res_1 ) {
        	            $this->audit->log('agent_commission', 'INSERT', null, null, $commission_arr);
        	        }
                    
                    if( isset( $main_ledger->vchaccname ) && !empty( $main_ledger->vchaccname ) ) {
                    //Agent commission table ORC
                    $commission_arr_2 = array(
                        "agent_id"      => $_agent_id,
                        "voucher_no"    => $vouchlist[$_agent_id],//$new_vocher_no,
                        "vhcharaccid"   => $main_ledger->vchaccname,
                        "credit"        => floor($orc_com),
                        "date"          => date("Y-m-d"),
                        "tds"           => 0,
                        "created_by"    => $this->session->userdata("session_id"),
                        "created_at"    => date("Y-m-d H:i:s"),
                    );
                    
                    
                        $res_2 = $this->rm->add_agent_commission_orc($commission_arr_2);
                    }
                    if( $res_2 ) {
        	            $this->audit->log('agent_commission_orc', 'INSERT', null, null, $commission_arr_2);
        	        }
        	        
                }
            }
            
            //$status = $this->GeneratePDF($policyinfo, $vouchlist);
            
            if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            
            echo json_encode(array("status"=>"success","arr" =>$res));
         }
     }
     
    public function GeneratePDF($policyinfo, $vouchlist) {
         set_time_limit(1000);
         if(!$this->session->has_userdata('logged_in')) 
         { 
             redirect('login', 'refresh');
         }
         
        //  echo '<pre>';print_r(count($policyinfo));print'</pre>';
         if( isset( $policyinfo ) && !empty( $policyinfo ) ) {
             
             foreach( $policyinfo as $agent_id => $row ) {
                 $policyids = array_keys($row);
                 
                 $agent_details = $this->rm->get_single_agent_code($agent_id);
                 $agent_vocher = $this->rm->getAgentVoucharByPolicy($policyids);  
                 //echo '<pre>';print_r($this->db->last_query());print'</pre>';
                 if(isset($vouchlist[$agent_id]) && !empty($vouchlist[$agent_id])){
                     $file = $this->pdf_template($vouchlist[$agent_id], $agent_details, $agent_vocher, $agent_id);
                 }
                 
             }
         }
     }
     
    public function pdf_template($voucharno, $agent_details, $agent_vocher, $_agent_id) {
         
        if($agent_details && $agent_vocher){
            $date = new DateTime();
            $v_date = $date->format('Y-m-d');
            
            $company_details = $this->rm->get_company_details();
            
            $content = "<!DOCTYPE html>
                        <html>
                            <head>
                                <title>Voucher ID : ".$voucharno." </title>
                                <style>
                                    *{
                                        padding:1px;
                                        margin:0px;
                                        font-family: 'Courier';
                                        font-size:12px;
                                    }
                                </style>
                            </head>
                            <body>
                                <div style='border:1px solid #aaa;padding:10px;margin:30px;'>
                                <center><p style='font-size:20px;padding-top:0px;'>VOUCHER</p></center>
                                <table style='width:100%'>
                                    <tr>
                                        <td style='padding:15px;'>
                                            <p style='margin-top:5px;font-size:17px;'>#companyname#</p>
                                            <p style='margin-top:5px;'>".$company_details->address."</p>
                                         </td>
                                        <td style='text-align: right;padding:15px;'>
                                            <p style='margin-top:5px;'><img src='./datas/temp/phone-icon.PNG' style='width:12px;'> +91 ".$company_details->phone." </p>
                                            <p style='margin-top:5px;'><img src='./datas/temp/email-icon.PNG' style='width:12px;'> ".$company_details->email." </p>
                                            <br>
                                        </td>
                                    </tr>
                                </table>";
                                
                                
            $content .= "<table style='width:100%;margin-top:-10px;'>
                            <tr>
                                <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'> Agent Code : ".$agent_details->agent_pos_code." </td>
                                <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'> Agent Name : ".$agent_details->name." </td>
                                <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Vocher No  : ".$voucharno."</td>
                                <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Date  : ".date_format(date_create($v_date),"d-m-Y")."</td>
                            </tr>";
                      
            $content .= "</table>";
            
            
            $content .= "<table style='width:100%;margin-top:0px;'>
                            <tr>
                                <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'> Pan No : ".$agent_details->pan_card_no." </td>
                                <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'> Acc No : ".$agent_details->bank_acc_no." </td>
                                <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Bank  : ".$agent_details->bank_name."</td>
                                <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Branch  : ".$agent_details->branch."</td>
                            </tr>";
                      
            $content .= "</table>";

            $jcontent = $content;

            $jcontent .= "<table style='width:100%;margin-top:10px;'>
                            <tr>
                                <td style='background-color:#dff0d8;width:5%;text-align: center;'>S.no</td>
                                <td style='background-color:#dff0d8;width:10%;text-align: center;'>P Date</td>
                                <td style='background-color:#dff0d8;width:20%;text-align: center;'>Policy no</td>
                                <td style='background-color:#dff0d8;width:10%;text-align: center;'>Insurer</td>
                                <td style='background-color:#dff0d8;width:10%;text-align: center;'>Name</td>
                                <td style='background-color:#dff0d8;width:10%;text-align: center;'>IRD</td>
                                <td style='background-color:#dff0d8;width:15%;text-align: center;'>Adv Exp</td>
                                <td style='background-color:#dff0d8;width:20%;text-align: center;'>Total</td>
                            </tr>";

            $ucontent = $content;
            $ucontent .= "<table style='width:100%;margin-top:10px;'>
                            <tr>
                                <td style='background-color:#dff0d8;width:25%;text-align: center;'>S.no</td>
                                <td style='background-color:#dff0d8;width:25%;text-align: center;'>Policy Type</td>
                                <td style='background-color:#dff0d8;width:25%;text-align: center;'>No of Policy</td>
                                <td style='background-color:#dff0d8;width:30%;text-align: center;'>Total</td>
                            </tr>";
            
            //$result = [];
            if( isset( $agent_vocher ) && !empty( $agent_vocher ) ){
                $a = 0;                        
                $tot_agent_commission = $tot_uagent_commission = 0;
                $total_ird = $utotal_ird = 0;
                $total_additional = 0;
                $tds = 0;
                foreach($agent_vocher as $da) {
                    $a++;

                    $agent_commission = $da->agent_commission_amt + $da->agn_add_com;
                    $irdi_commission = $agent_commission * 15/100; 
                    $additional_commission = $agent_commission - $irdi_commission;
                
                    $total_ird = $irdi_commission + $total_ird;
                    $total_additional = $additional_commission + $total_additional;
                    $tot_agent_commission = $tot_agent_commission + $agent_commission;
                
                 
                    $jcontent .= "<tr>
                                    <td style='padding:3px;text-align: left;'>".$a."</td>
                                    <td style='padding:3px;text-align: left;'>".date_format(date_create($da->policy_issue_date),"d-m-Y")."</td>
                                    <td style='padding:3px;text-align: left;'>".$da->policy_no."</td>
                                    <td style='padding:3px;text-align: left;'>".$da->company_name."</td>
                                    <td style='padding:3px;text-align: left;'>".$da->client_name."</td>
                                    <td style='padding:3px;text-align: right;'>".number_format(floor($irdi_commission),2)."</td>
                                    <td style='padding:3px;text-align: right;'>".number_format(floor($additional_commission),2)."</td>
                                    <td style='padding:3px;text-align: right;'>".number_format(floor($agent_commission),2)."</td>
                                </tr>";

                    
                    if( !isset($result[$da->policy_type] ) ) {
                        $result[$da->policy_type]['noof'] = 0;
                        $result[$da->policy_type]['amount'] = 0;
                    }

                    $uagent_commission = $da->agent_commission;                                                                   
                    $utotal_ird = $uagent_commission + $utotal_ird;
                    $tot_uagent_commission = $tot_uagent_commission + $uagent_commission;
                                                                
                    $result[$da->policy_type]['noof'] += 1; 
                    $result[$da->policy_type]['amount'] += $da->agent_commission; 
                }                
            }
            
            if( isset( $result ) && !empty( $result ) ){
                $policeTypes = array_keys($result);
                $sl = 1;
                $tot_agent_count =0;
                foreach( $policeTypes as $ptype) {
                    $ucontent .= "<tr>
                                    <td style='padding:3px;text-align: left;'>".($sl++)."</td>
                                    <td style='padding:3px;text-align: left;'>".$ptype."</td>
                                    <td style='padding:3px;text-align: left;'>".$result[$ptype]['noof']."</td>
                                    <td style='padding:3px;text-align: right;'>".number_format(floor($result[$ptype]['amount']),2)."</td>
                                </tr>";
                    
                    $tot_agent_count += $result[$ptype]['noof'] ;                    
                }
            }
            
            $tds_data = $this->rm->get_tds_percentage();
            $tds = 0;
            if(isset( $tds_data ) && !empty( $tds_data ) ) {
               $tds = $tds_data->tds_percentage;
            }
                        
                        
            $jcontent .= "<tr>
                            <td style='padding:3px;text-align: left;background-color:#dff0d8;'></td>
                            <td style='padding:3px;text-align: left;background-color:#dff0d8;'></td>
                            <td style='padding:3px;text-align: left;background-color:#dff0d8;'></td>
                            <td style='background-color:#dff0d8;padding:3px;text-align: left;'>SUMMARY</td>
                            <td style='padding:3px;text-align: left;background-color:#dff0d8;'></td>
                            <td style='padding:3px;text-align: right;'><b>".number_format(floor($total_ird),2)."</b></td>
                            <td style='padding:3px;text-align: right;'><b>".number_format(floor($total_additional),2)."</b> </td>
                            <td style='padding:3px;text-align: right;'><b>".number_format(floor($tot_agent_commission),2)."</b></td>
                        </tr></table>";
                                
                                
            $jcontent .= "<table><tr>
                            <td style='padding:5px;text-align: left;width:50%;'>Total Commission</td>
                            <td style='padding:5px;text-align: left;'> : </td>
                            <td style='padding:5px;text-align: right;'>".number_format(floor($tot_agent_commission),2)."</td>
                        </tr>";
                                
            $tds_amount = floor($tot_agent_commission) * $tds/100;
            $net = floor($tot_agent_commission) - ceil($tds_amount);
                                
            $jcontent .= "<tr>
                            <td style='padding:5px;text-align:left;width:50%;'>TDS</td>
                            <td style='padding:5px;text-align: left;'> : </td>
                            <td td style='padding:5px;text-align: right;'>".number_format(ceil($tds_amount),2)."</td>
                        </tr>";
                                
                              
                                
            $jcontent .= "<tr>
                            <td style='padding:5px;text-align: left;width:50%;'>NET Payable</td>
                            <td style='padding:5px;text-align: left;'> : </td>
                            <td td style='padding:5px;text-align: right;'>".number_format(floor($net),2)."</td>
                        </tr></table>";


            $ucontent .= "<tr>
                            <td style='padding:3px;text-align: left;background-color:#dff0d8;'></td>
                            <td style='background-color:#dff0d8;padding:5px;text-align: left;'>Total Policy</td>
                            <td style='padding:3px;text-align: left;background-color:#dff0d8;'>$tot_agent_count</td>
                            <td style='padding:3px;text-align: right;'><b>".number_format(floor($tot_uagent_commission),2)."</b></td>
                        </tr></table>";
                    
                    
            $ucontent .= "<table><tr>
                        <td style='padding:5px;text-align: left;width:50%;'>Total Commission</td>
                        <td style='padding:5px;text-align: left;'> : </td>
                        <td style='padding:5px;text-align: right;'>".number_format(floor($tot_uagent_commission),2)."</td>
                    </tr>";
                                
                        
            $footer = "<br><table style='width:100%;'>
                                <tr>
                                    <td style='width:33%;padding:5px;text-align: left;'><b> Accountant </b></td>
                                    <td style='width:33%;padding:5px;text-align: left;'> <b>Verified By </b></td>
                                    <td style='width:33%;padding:5px;text-align: right;'><b>Passed By</b></td>
                                </tr>
                            </table>";
                        
                   
            $footer .= "</body></html>";

            $jcontent .= $footer;
            $ucontent .= $footer;

            $filename = $_agent_id."-".$voucharno.".pdf";
            
            $jscontent = str_replace("#companyname#", "JAYANTHA INSURANCE", $jcontent);
            if($jcontent)
                $jpdf = $this->pdf_create($jcontent, $filename, 'jan');    
                
            $ucontent = str_replace("#companyname#", "UNICORN INSURANCE", $ucontent);
            if($ucontent)
                $updf = $this->pdf_create($ucontent, "U-".$filename, 'uni');
            
            // var_dump($filename);
            // echo $jcontent;
            // echo '<br>';
            // var_dump("U/".$filename);
            // echo $ucontent;
            // echo '<br>';
            
            
            // $updf = $this->pdf_create($ucontent, "U-".$filename, 'uni');    
            // $jpdf = $this->pdf_create($jcontent, $filename, 'jan');
            
            /*
            $this->load->library('pdf');

            // Jan 
            $filename = $_agent_id."-".$voucharno.".pdf";
            $this->pdf->loadHtml($jcontent);
            $this->pdf->render();
            $output = $this->pdf->output();
            $directory = FCPATH . 'datas/agent_commission_pdf/jan/';
            if(!is_dir($directory)){
                mkdir($directory, 0777, true);
            }
            file_put_contents($directory.$filename, $output);
            
            
            // Uni
            $filename = "U/".$_agent_id."-".$voucharno.".pdf";
            $this->pdf->loadHtml($ucontent);
            $this->pdf->render();
            $output1 = $this->pdf->output();
            $directory = FCPATH . 'datas/agent_commission_pdf/uani/';
            if(!is_dir($directory)){
                mkdir($directory, 0777, true);
            }
            file_put_contents($directory.$filename, $output1);
            */
        }
    }
    
    public function pdf_create($content, $filename, $dir) {
        $this->load->library('pdf');
        //$this->load->library('calendar', NULL, 'my_calendar');
        $this->pdf->loadHtml($content);
        $this->pdf->render();
        $directory = FCPATH . "datas/agent_commission_pdf/{$dir}/";
        
        if(!is_dir($directory)){
            mkdir($directory, 0777, true);
        }
        file_put_contents($directory.$filename, $this->pdf->output());
        unset($this->pdf);
    }
    
    
    // get Current Year Month List
    function getMonthList()
    {
        $today = new DateTime();
        $monthlist  = [];
        //return $monthlist;
        $startdate  = (date("Y")-1)."-01-01";
        $enddate    = $today->format('Y-m-t');//(date("Y"))."-12-31";
        $interval   = "P1M";
        $calendar   = new DatePeriod(
            new DateTime( $startdate ),
            new DateInterval( $interval ),
            new DateTime( $enddate )
        );
        if( $calendar ) {
            foreach( $calendar as $p ) {
                $monthlist[$p->format('Y-m')] = $p->format('F - Y');
            }
            
            unset($calendar);
        }
        
        return $monthlist;
    }
    
    public function getVoucharAgents()
	{
	    if(!$this->session->has_userdata('logged_in')){
	        redirect('login', 'refresh');
	    }
	    $from_date = $this->input->post('fromdate');
	    $to_date = $this->input->post('todate');
	    if( $from_date && $to_date ) {
	        $res = $this->rm->getAgentByVouchar($from_date, $to_date);
	        echo json_encode($res);
	    }
	    
	}
	
    public function agent_vouchar_report() {
        if(!$this->session->has_userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        
        // if(!$this->auth->can_access('Agent Voucher Report')){
        //     redirect('access_denied', 'refresh');
        // }
        $pro_data["project_info"] = $this->mm->fetch_project_info();
        
        $data["monthlist"]        = $this->getMonthList();
        $results                  = $this->rm->getMaxAgentVouchar();
        
        $data['voucharinfo'] = ( isset( $results ) && !empty( $results ) ) ? $results : [];
        $agentlist = [];
        if( isset( $results ) && !empty( $results ) ) {
            $from_date = $results->from_date;
    	    $to_date = $results->to_date;
    	    if( $from_date && $to_date ) {
    	        $agentlist = $this->rm->getAgentByVouchar($from_date, $to_date);
    	        
    	    }
        }
        
        $data["agentvoucharlist"] = $agentlist;
        
        $userslist = $this->rm->getUserList();
    	$data['userslist'] = $userslist;
        
        $this->load->view('header',$pro_data);
        $this->load->view('agent_vouchar_report',$data);
        $this->load->view('footer',$pro_data);
    }
    
    //comments by kgk on 2023-05-09
    public function _fetch_agent_vouchar_report() 
    {
        if(!$this->session->has_userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        
        $org = 1;     
        if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") {
              $org = 1;                             
        } else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn") {
            $org = 2;
        }
        
        $from_date  = $this->input->post('fromdate');
        $to_date    = $this->input->post('todate');
        $agent      = $this->input->post('agents');
        $user       = $this->input->post('user');
        
        $check_excel = $this->rm->fetch_excel_status($from_date,$to_date, $agent, $org);

        
        $code       = "";
        
        if( isset( $agent ) && !empty( $agent ) ){
            $agent_code = $this->rm->get_single_agent_code($agent);
            $code       = (isset($agent_code->agent_pos_code) && !empty($agent_code->agent_pos_code) ) ? $agent_code->agent_pos_code : "";
        }
        
        if($from_date && $to_date) {
            $result = $this->rm->getAgentVouchar($from_date, $to_date, $agent, $user);    
            //echo $this->db->last_query();
        }
        $agentlists = [];
        if( isset( $result ) && !empty( $result ) ){
            foreach( $result as $row ) {
                if( !in_array($row->agent_id, $agentlists) ){
                    $agentlists[] = $row->agent_id;
                }
                $agentdetails[$row->agent_id] = ['name' => $row->agent_name,'vocher_no' => $row->vocher_no, 'vocher_date' => $row->vocher_date];
                $policyinfo[$row->agent_id][] = $row;
            }
        }
        
        $content    = "";
        $txt        = "";//"AGENT : All";
        $agent_td   = $empty_td = '';

        if( $code ){
            $txt        = "AGENT Code : ".$code;
        } else {
            $agent_td   = '<td>Agent Name</td>';
            $empty_td   = "<td></td>";
        }

        // $content .="<table class='table' border='0'>
        //                 <tr>
        //                     <td style='font-size:16px;'>".$txt."</td>
        //                     <td style='font-size:16px;'>Total no policies : ".count($result)."</td>
        //                 </tr>
        //             </table>";
        
        
        
        $total_commission = 0;  
        
        if(empty($check_excel))
        {
        $content .= '<input type="button" class="btn btn-primary pull-right" value="Export Excel" onclick="export_excel(\''.$from_date.'\', \''.$to_date.'\', '.$org.')"/>';
        }
        $content .="<table class='table table-bordered' id='policy_list'>
                        <thead>
                            <tr>
                                <td>#</td>
                                <td>Policy No</td>
                                <td>Insurer</td>
                                <td>Customer Name</td>
                                <td>Commisison</td>                        
                            </tr>
                        </thead>
                        <tbody>";
                        
                        if( isset( $agentlists ) && !empty( $agentlists ) ){
                            foreach( $agentlists as $agent ){
                                $agentname = ((isset($agentdetails[$agent]['name']) && !empty($agentdetails[$agent]['name'])) ? $agentdetails[$agent]['name'] : "");
                                $vochar = ((isset($agentdetails[$agent]['vocher_no']) && !empty($agentdetails[$agent]['vocher_no'])) ? $agentdetails[$agent]['vocher_no'] : "");
                                $vochar_date = ((isset($agentdetails[$agent]['vocher_date']) && !empty($agentdetails[$agent]['vocher_date'])) ? $agentdetails[$agent]['vocher_date'] : "");
                                $content .= '<tr>';
                                $content .= '<td>'.$agentname.'</td>';
                                $content .= '<td>Total no policies : '.count($policyinfo[$agent]).'</td>';
                                $content .= '<td>Vocher No. '.$vochar.'</td>';
                                $content .= '<td>Vocher Date. '.$vochar_date.'</td>';
                                $content .= '<td><input type="button" value="Export PDF" onclick="exportpdf(\''.$vochar.'\', \''.$vochar_date.'\', '.$agent.', '.$org.')"/></td>';
                                $content .= '</tr>';
                                
                                if( isset( $policyinfo[$agent] ) && !empty( $policyinfo[$agent] ) )
                                {
                                    $total_ird = 0;
                                    $total_additional = 0;
                                    $tot_agent_commission = 0;
                                    $agent_debit = 0;
                                    $tot_tds = 0;
                                    $sl = 1;
                                    foreach( $policyinfo[$agent] as $row ) {
                                        if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") {
                                            $agent_commission     = (isset($row->agent_commission_amt) && $row->agent_commission_amt != '') ? $row->agent_commission_amt : 0;
                                            $tot_agent_commission = $tot_agent_commission + $agent_commission;
                                        } else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn") {
                                            if(isset($row->agent_commission) && $row->agent_commission != "")
                                                $agent_commission     = $row->agent_commission;
                                            if(isset($row->additional_commission) && $row->additional_commission != "")
                                                $agent_commission     = $agent_commission + $row->additional_commission;
                                            if(isset($row->agn_add_com) && $row->agn_add_com != "")
                                                $agent_commission     = $agent_commission + $row->agn_add_com;
                                            
                                            $tot_agent_commission = $tot_agent_commission + $agent_commission;
                                        }
                                        
                                        $content .="<tr>
                                                    <td>
                                                        <input type='hidden' class='check_".$agent." fullcheck' value='".$row->id."'>
                                                        ".($sl++)."
                                                    </td>";
                                            
                                        $content .="<td>".$row->policy_no."</td>
                                                    <td>".$row->company_name."</td>
                                                    <td>".$row->client_name."</td>
                                                    <td style='text-align:right'>".number_format(floor($agent_commission),2)."</td>";
                                        $content .= '</tr>';
                                    }
                                }
                                
                                $content .="
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><b>Total</b></td>
                                                <td style='text-align:right'><b>".number_format(floor($tot_agent_commission),2)."</b></td>
                                            </tr>
                                        ";   
                                $total_commission = $total_commission + $tot_agent_commission;
                            }
                        }
                        
        $total_ird = 0;
        $total_additional = 0;
        $tot_agent_commission = 0;
        $agent_debit = 0;
        $tot_tds = 0;

        if( isset( $result1 ) && !empty( $result1 ) ){
            $sl = 1;
            foreach( $result as $row  ){
                if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") {
                    $agent_commission     = (isset($row->agent_commission_amt) && $row->agent_commission_amt != '') ? $row->agent_commission_amt : 0;
                    $tot_agent_commission = $tot_agent_commission + $agent_commission;
                } else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn") {
                    if(isset($row->agent_commission) && $row->agent_commission != "")
                        $agent_commission     = $row->agent_commission;
                    if(isset($row->additional_commission) && $row->additional_commission != "")
                        $agent_commission     = $agent_commission + $row->additional_commission;
                    if(isset($row->agn_add_com) && $row->agn_add_com != "")
                        $agent_commission     = $agent_commission + $row->agn_add_com;
                    
                    $tot_agent_commission = $tot_agent_commission + $agent_commission;
                }
                $content .="<tr>
                            <td>
                                <input type='hidden' class='check' value='".$row->id."'>
                                ".($sl++)."
                            </td>";
                if(empty($code))
                    $content .= "<td>".$row->agent_name."</td>";
                    
                $content .="<td>".$row->policy_no."</td>
                            <td>".$row->company_name."</td>
                            <td>".$row->client_name."</td>
                            <td style='text-align:right'>".number_format(floor($agent_commission),2)."</td>";
                $content .= '</tr>';
            }
            $content .="</tbody>";
            
            $content .="<tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                ".$empty_td."
                                <td><b>Total</b></td>
                                <td style='text-align:right'><b>".number_format(floor($total_commission),2)."</b></td>
                            </tr>
                        </tfoot>";                
        }
       
       $content .="<tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>Grand Total</b></td>
                                <td style='text-align:right'><b>".number_format(floor($total_commission),2)."</b></td>
                            </tr>
                        </tfoot>"; 
        $content .="</table><br>";
        //$content .="<button type='button' class='btn btn-success pull-right' id='vocher_gen_btn' onclick='ExportPDF()'>Export Vocher</button>";

        echo $content;
    }
    
    public function fetch_agent_vouchar_report() {
        if(!$this->session->has_userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        
        $org = 1;     
        if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") {
              $org = 1;                             
        } else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn") {
            $org = 2;
        }
        
        $from_date  = $this->input->post('fromdate');
        $to_date    = $this->input->post('todate');
        $agent      = $this->input->post('agents');
        $user       = $this->input->post('user');
        
        $check_excel = $this->rm->fetch_excel_status($from_date,$to_date, $agent, $org);

        
        $code       = "";
        
        if( isset( $agent ) && !empty( $agent ) ){
            $agent_code = $this->rm->get_single_agent_code($agent);
            $code       = (isset($agent_code->agent_pos_code) && !empty($agent_code->agent_pos_code) ) ? $agent_code->agent_pos_code : "";
        }
        
        if($from_date && $to_date) {
            $result = $this->rm->getAgentVouchar($from_date, $to_date, $agent, $user);    
            //echo $this->db->last_query();
        }
        $agentlists = $agentvouchers = [];
        if( isset( $result ) && !empty( $result ) ){
            foreach( $result as $row ) {
                if( !in_array($row->agent_id, $agentlists) ){
                    $agentlists[] = $row->agent_id;
                }
                
                $agentvouchers[$row->agent_id][$row->vocher_no] = $row->vocher_date;
                
                $agentdetails[$row->agent_id] = ['name' => $row->agent_name,'vocher_no' => $row->vocher_no, 'vocher_date' => $row->vocher_date];
                $policyinfo[$row->agent_id][] = $row;
                $agentpolicyinfo[$row->agent_id][$row->vocher_no][] = $row;
            }
        }
        
        $content    = "";
        $txt        = "";//"AGENT : All";
        $agent_td   = $empty_td = '';

        if( $code ){
            $txt        = "AGENT Code : ".$code;
        } else {
            $agent_td   = '<td>Agent Name</td>';
            $empty_td   = "<td></td>";
        }

        // $content .="<table class='table' border='0'>
        //                 <tr>
        //                     <td style='font-size:16px;'>".$txt."</td>
        //                     <td style='font-size:16px;'>Total no policies : ".count($result)."</td>
        //                 </tr>
        //             </table>";
        
        
        
        $total_commission = 0;  
        
        if(empty($check_excel))
        {
        $content .= '<input type="button" class="btn btn-primary pull-right" value="Export Excel" onclick="export_excel(\''.$from_date.'\', \''.$to_date.'\', '.$org.')"/>';
        }
        $content .= '<style>th{font-weight: bold !important}</style>';
        $content .="<table class='table table-bordered' id='policy_list'>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Policy No</th>
                                <th>Insurer</th>
                                <th>Customer Name</th>
                                <th>Commisison</th>                        
                            </tr>
                        </thead>
                        <tbody>";
                        
                        if( isset( $agentlists ) && !empty( $agentlists ) ){
                            foreach( $agentlists as $agent ){
                                $vochar_txt = $vochar_date_txt = "";
                                $agentname = ((isset($agentdetails[$agent]['name']) && !empty($agentdetails[$agent]['name'])) ? $agentdetails[$agent]['name'] : "");
                                $vochar = ((isset($agentdetails[$agent]['vocher_no']) && !empty($agentdetails[$agent]['vocher_no'])) ? $agentdetails[$agent]['vocher_no'] : "");
                                $vochar_date = ((isset($agentdetails[$agent]['vocher_date']) && !empty($agentdetails[$agent]['vocher_date'])) ? $agentdetails[$agent]['vocher_date'] : "");
                                $content .= '<tr>';
                                $content .= '<th>'.$agentname.'</th>';
                                $content .= '<th>Total no policies : '.count($policyinfo[$agent]).'</th>';
                                if(isset($agentpolicyinfo[$agent]) && !empty($agentpolicyinfo[$agent]) && count($agentpolicyinfo[$agent]) == 1){
                                    $vochar_txt      = 'Vocher No. '.$vochar;
                                    $vochar_date_txt = 'Vocher Date. '.$vochar_date;
                                }
                                
                                $content .= '<th>'.$vochar_txt.'</th>';
                                $content .= '<th>'.$vochar_date_txt.'</th>';
                                
                                $content .= '<th><input type="button" value="Export PDF" onclick="exportpdf(\''.$vochar.'\', \''.$vochar_date.'\', '.$agent.', '.$org.')"/></th>';
                                $content .= '</tr>';
                                
                                if( isset( $agentpolicyinfo[$agent] ) && !empty( $agentpolicyinfo[$agent] ) )
                                {
                                    $total_ird = 0;
                                    $total_additional = 0;
                                    $tot_agent_commission = 0;
                                    $agent_debit = 0;
                                    $tot_tds = 0;
                                    $sl = 1;
                                    foreach( $agentpolicyinfo[$agent] as $agv => $agvrow ) {
                                        if(is_array($agvrow)){
                                            $vochar_date = ((isset($agentvouchers[$agent][$agv]) && !empty($agentvouchers[$agent][$agv])) ? $agentvouchers[$agent][$agv] : "");
                                            if(empty($vochar_txt)) {
                                                $content .="<tr>";
                                                $content .= '<th colspan="2">Vocher No. '.$agv.'</th>';
                                                $content .= '<th colspan="3">Vocher Date. '.$vochar_date.'</th>';
                                                $content .= "</tr>";
                                            }
                                            foreach( $agvrow as $row ) {
                                                if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") {
                                                    $agent_commission     = (isset($row->agent_commission_amt) && $row->agent_commission_amt != '') ? $row->agent_commission_amt : 0;
                                                    $tot_agent_commission = $tot_agent_commission + $agent_commission;
                                                } else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn") {
                                                    if(isset($row->agent_commission) && $row->agent_commission != "")
                                                        $agent_commission     = $row->agent_commission;
                                                    if(isset($row->additional_commission) && $row->additional_commission != "")
                                                        $agent_commission     = $agent_commission + $row->additional_commission;
                                                    if(isset($row->agn_add_com) && $row->agn_add_com != "")
                                                        $agent_commission     = $agent_commission + $row->agn_add_com;
                                                    
                                                    $tot_agent_commission = $tot_agent_commission + $agent_commission;
                                                }
                                                
                                                $content .="<tr>
                                                    <td>
                                                        <input type='hidden' class='check_".$agent." fullcheck' value='".$row->id."'>
                                                        ".($sl++)."
                                                    </td>";
                                            
                                                $content .="<td>".$row->policy_no."</td>
                                                            <td>".$row->company_name."</td>
                                                            <td>".$row->client_name."</td>
                                                            <td style='text-align:right'>".number_format(floor($agent_commission),2)."</td>";
                                                $content .= '</tr>';
                                            }
                                        }
                                    }
                                }
                                
                                $content .="
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><b>Total</b></td>
                                                <td style='text-align:right'><b>".number_format(floor($tot_agent_commission),2)."</b></td>
                                            </tr>
                                        ";   
                                $total_commission = $total_commission + $tot_agent_commission;
                            }
                        }
                        
                        if( isset( $agentlists1 ) && !empty( $agentlists1 ) ){
                            foreach( $agentlists as $agent ){
                                $agentname = ((isset($agentdetails[$agent]['name']) && !empty($agentdetails[$agent]['name'])) ? $agentdetails[$agent]['name'] : "");
                                $vochar = ((isset($agentdetails[$agent]['vocher_no']) && !empty($agentdetails[$agent]['vocher_no'])) ? $agentdetails[$agent]['vocher_no'] : "");
                                $vochar_date = ((isset($agentdetails[$agent]['vocher_date']) && !empty($agentdetails[$agent]['vocher_date'])) ? $agentdetails[$agent]['vocher_date'] : "");
                                $content .= '<tr>';
                                $content .= '<th>'.$agentname.'</th>';
                                $content .= '<th>Total no policies : '.count($policyinfo[$agent]).'</th>';
                                $content .= '<th>Vocher No. '.$vochar.'</th>';
                                $content .= '<th>Vocher Date. '.$vochar_date.'</th>';
                                $content .= '<th><input type="button" value="Export PDF" onclick="exportpdf(\''.$vochar.'\', \''.$vochar_date.'\', '.$agent.', '.$org.')"/></th>';
                                $content .= '</tr>';
                                
                                if( isset( $policyinfo[$agent] ) && !empty( $policyinfo[$agent] ) )
                                {
                                    $total_ird = 0;
                                    $total_additional = 0;
                                    $tot_agent_commission = 0;
                                    $agent_debit = 0;
                                    $tot_tds = 0;
                                    $sl = 1;
                                    foreach( $policyinfo[$agent] as $row ) {
                                        if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") {
                                            $agent_commission     = (isset($row->agent_commission_amt) && $row->agent_commission_amt != '') ? $row->agent_commission_amt : 0;
                                            $tot_agent_commission = $tot_agent_commission + $agent_commission;
                                        } else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn") {
                                            if(isset($row->agent_commission) && $row->agent_commission != "")
                                                $agent_commission     = $row->agent_commission;
                                            if(isset($row->additional_commission) && $row->additional_commission != "")
                                                $agent_commission     = $agent_commission + $row->additional_commission;
                                            if(isset($row->agn_add_com) && $row->agn_add_com != "")
                                                $agent_commission     = $agent_commission + $row->agn_add_com;
                                            
                                            $tot_agent_commission = $tot_agent_commission + $agent_commission;
                                        }
                                        
                                        $content .="<tr>
                                                    <td>
                                                        <input type='hidden' class='check_".$agent." fullcheck' value='".$row->id."'>
                                                        ".($sl++)."
                                                    </td>";
                                            
                                        $content .="<td>".$row->policy_no."</td>
                                                    <td>".$row->company_name."</td>
                                                    <td>".$row->client_name."</td>
                                                    <td style='text-align:right'>".number_format(floor($agent_commission),2)."</td>";
                                        $content .= '</tr>';
                                    }
                                }
                                
                                $content .="
                                            <tr>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                                <td><b>Total</b></td>
                                                <td style='text-align:right'><b>".number_format(floor($tot_agent_commission),2)."</b></td>
                                            </tr>
                                        ";   
                                $total_commission = $total_commission + $tot_agent_commission;
                            }
                        }
                        
        $total_ird = 0;
        $total_additional = 0;
        $tot_agent_commission = 0;
        $agent_debit = 0;
        $tot_tds = 0;

        if( isset( $result1 ) && !empty( $result1 ) ){
            $sl = 1;
            foreach( $result as $row  ){
                if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") {
                    $agent_commission     = (isset($row->agent_commission_amt) && $row->agent_commission_amt != '') ? $row->agent_commission_amt : 0;
                    $tot_agent_commission = $tot_agent_commission + $agent_commission;
                } else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn") {
                    if(isset($row->agent_commission) && $row->agent_commission != "")
                        $agent_commission     = $row->agent_commission;
                    if(isset($row->additional_commission) && $row->additional_commission != "")
                        $agent_commission     = $agent_commission + $row->additional_commission;
                    if(isset($row->agn_add_com) && $row->agn_add_com != "")
                        $agent_commission     = $agent_commission + $row->agn_add_com;
                    
                    $tot_agent_commission = $tot_agent_commission + $agent_commission;
                }
                $content .="<tr>
                            <td>
                                <input type='hidden' class='check' value='".$row->id."'>
                                ".($sl++)."
                            </td>";
                if(empty($code))
                    $content .= "<td>".$row->agent_name."</td>";
                    
                $content .="<td>".$row->policy_no."</td>
                            <td>".$row->company_name."</td>
                            <td>".$row->client_name."</td>
                            <td style='text-align:right'>".number_format(floor($agent_commission),2)."</td>";
                $content .= '</tr>';
            }
            $content .="</tbody>";
            
            $content .="<tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                ".$empty_td."
                                <td><b>Total</b></td>
                                <td style='text-align:right'><b>".number_format(floor($total_commission),2)."</b></td>
                            </tr>
                        </tfoot>";                
        }
       
       $content .="<tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td><b>Grand Total</b></td>
                                <td style='text-align:right'><b>".number_format(floor($total_commission),2)."</b></td>
                            </tr>
                        </tfoot>"; 
        $content .="</table><br>";
        //$content .="<button type='button' class='btn btn-success pull-right' id='vocher_gen_btn' onclick='ExportPDF()'>Export Vocher</button>";

        echo $content;
    }
    
     public function agent_vocher_rand_number()
     {
         if($this->session->has_userdata('logged_in')) 
         { 
                $transaction_no_count ="6";
                $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
                $charactersLength = strlen($characters);
                $randomString = '';
                
                for ($i = 0; $i < $transaction_no_count; $i++) 
                {
                  $randomString .= $characters[rand(0, $charactersLength - 1)];
                }
                
                if($this->rm->randomcheck($randomString) == false)
                {
                  $this->agent_vocher_rand_number();
                }
                else
                {
                   return 'av'.$randomString;
                }
         }
     }
     
     public function agent_vocher_pdf()
     {
         if($this->session->has_userdata('logged_in')) 
         { 
             $this->load->library('pdf');
             $policy_arr = $this->input->get("policy_arr");//explode(",",$this->input->get("policy_arr"));
             $agent = $this->input->get("agents");
             $vocher_no = $this->input->get("vocher_no");
             $v_date = $this->input->get("v_date");
             
             $company_details = $this->rm->get_company_details();
             $agent_details = $this->rm->get_single_agent_code($agent);
             
             /*
             if(empty($policy_arr)) {
                $result = $this->rm->get_policy_by_voucharno($vocher_no);
                if( isset( $result ) && !empty( $result ) ) {
                    foreach( $result as $row ) {
                        $policy_arr[] = $row->id;
                    }
                    unset($row);unset($result);
                }
             }
             */
             //echo '<pre>';print_r($policy_arr);print'</pre>';
            
             if($this->session->userdata('session_company_type') == "unicorn"){
                 $company_details->name = "UNICORN";

             }

                 
                $content = "<!DOCTYPE html>
                            <html>
                            <head>
                                <title>Voucher ID : ".$vocher_no." </title>
                                <style>
                                    *{
                                        padding:1px;
                                        margin:0px;
                                        font-family: 'Courier';
                                        font-size:12px;
                                    }
                                </style>
                            </head>
                            <body>
                                <div style='border:1px solid #aaa;padding:10px;margin:30px;'>
                                <center><p style='font-size:20px;padding-top:0px;'>VOUCHER</p></center>
                                <table style='width:100%'>
                                    <tr>
                                        <td style='padding:15px;'>
                                            <p style='margin-top:5px;font-size:17px;'>".$company_details->name."</p>
                                            <p style='margin-top:5px;'>".$company_details->address."</p>
                                         </td>
                                        <td style='text-align: right;padding:15px;'>
                                            <p style='margin-top:5px;'><img src='./datas/temp/phone-icon.PNG' style='width:12px;'> +91 ".$company_details->phone." </p>
                                            <p style='margin-top:5px;'><img src='./datas/temp/email-icon.PNG' style='width:12px;'> ".$company_details->email." </p>
                                            <br>
                                        </td>
                                    </tr>
                                </table>";
                                
                                
                    $content .= "<table style='width:100%;margin-top:-10px;'>
                                    <tr>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'> Agent Code : ".$agent_details->agent_pos_code." </td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'> Agent Name : ".$agent_details->name." </td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Vocher No  : ".$vocher_no."</td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Date  : ".date_format(date_create($v_date),"d-m-Y")."</td>
                                    </tr>";
                              
                    $content .= "</table>";
                    
                    
                    $content .= "<table style='width:100%;margin-top:0px;'>
                                    <tr>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'> Pan No : ".$agent_details->pan_card_no." </td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'> Acc No : ".$agent_details->bank_acc_no." </td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Bank  : ".$agent_details->bank_name."</td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Branch  : ".$agent_details->branch."</td>
                                    </tr>";
                              
                    $content .= "</table>
                    
                    
                            <table style='width:100%;margin-top:10px;'>
                                    <tr>
                                        <td style='background-color:#dff0d8;width:5%;text-align: center;'> S.no </td>
                                        <td style='background-color:#dff0d8;width:10%;text-align: center;'> P Date</td>
                                        <td style='background-color:#dff0d8;width:20%;text-align: center;'>Policy no</td>
                                        <td style='background-color:#dff0d8;width:10%;text-align: center;'>Insurer</td>
                                        <td style='background-color:#dff0d8;width:10%;text-align: center;'>Name</td>
                                        <td style='background-color:#dff0d8;width:10%;text-align: center;'>IRD</td>
                                        <td style='background-color:#dff0d8;width:20%;text-align: center;'>Total</td>
                                    </tr>";
                        
                        $a = 0;
                        
                        $tot_agent_commission = 0;
                        $total_ird = 0;
                        $total_additional = 0;
                        $tds = 0;
                        
                        for($i=0;$i<count($policy_arr);$i++)
                        {
                         
                             $agent_vocher = $this->rm->fetch_agent_vocher($policy_arr[$i]);  
                             
            
                             
                             foreach($agent_vocher as $da)
                             {
                                 $a++;
                                    $agent_commission = $da->agent_commission_amt + $da->agn_add_com;
                                    $irdi_commission = $agent_commission * 15/100; 
                                    $additional_commission = $agent_commission - $irdi_commission;
                                
                                    $total_ird = $irdi_commission + $total_ird;
                                    $total_additional = $additional_commission + $total_additional;
                                    $tot_agent_commission = $tot_agent_commission + $agent_commission;
                    
                                 
                                    $content .= "<tr>
                                        <td style='padding:3px;text-align: left;'>".$a."  </td>
                                        <td style='padding:3px;text-align: left;'>".date_format(date_create($da->policy_issue_date),"d-m-Y")."  </td>
                                        <td style='padding:3px;text-align: left;'>".$da->policy_no."  </td>
                                        <td style='padding:3px;text-align: left;'>".$da->company_name."  </td>
                                        <td style='padding:3px;text-align: left;'>".$da->client_name."  </td>
                                        <td style='padding:3px;text-align: right;'>".number_format(floor($irdi_commission),2)."  </td>
                                        <td style='padding:3px;text-align: right;'>".number_format(floor($agent_commission),2)."</td>
                                    </tr>";
                             }
                        }
                        
                        
                        $tds_data = $this->rm->get_tds_percentage();
                        
                        if($tds_data != "")
                        {
                           $tds = $tds_data->tds_percentage;
                        }
                        else
                        {
                           $tds = 0;
                        }
                        
                        $content .= "<tr>
                                    <td style='padding:3px;text-align: left;background-color:#dff0d8;'></td>
                                    <td style='padding:3px;text-align: left;background-color:#dff0d8;'></td>
                                    <td style='padding:3px;text-align: left;background-color:#dff0d8;'></td>
                                    <td style='background-color:#dff0d8;padding:3px;text-align: left;'>SUMMARY</td>
                                    <td style='padding:3px;text-align: left;background-color:#dff0d8;'></td>
                                    <td style='padding:3px;text-align: right;'><b>".number_format(floor($total_ird),2)." </b></td>
                                    <td style='padding:3px;text-align: right;'><b>".number_format(floor($total_additional),2)." </b> </td>
                                    <td style='padding:3px;text-align: right;'><b>".number_format(floor($tot_agent_commission),2)."</b></td>
                                </tr></table>";
                                
                                
                                 $content .= "<table><tr>
                                    <td style='padding:5px;text-align: left;width:50%;'>Total Commission</td>
                                    <td style='padding:5px;text-align: left;'> : </td>
                                    <td style='padding:5px;text-align: right;'>".number_format(floor($tot_agent_commission),2)."</td>
                                </tr>";
                                
                                $tds_amount = floor($tot_agent_commission) * $tds/100;
                                $net = floor($tot_agent_commission) - ceil($tds_amount);
                                
                                $content .= "<tr>
                                    <td style='padding:5px;text-align:left;width:50%;'>TDS</td>
                                    <td style='padding:5px;text-align: left;'> : </td>
                                    <td td style='padding:5px;text-align: right;'>".number_format(ceil($tds_amount),2)."</td>
                                </tr>";
                                
                              
                                
                                 $content .= "<tr>
                                    <td style='padding:5px;text-align: left;width:50%;'>NET Payable</td>
                                    <td style='padding:5px;text-align: left;'> : </td>
                                    <td td style='padding:5px;text-align: right;'>".number_format(floor($net),2)."</td>
                                </tr></table>";
                                
                        
                        $content .= "<br><table style='width:100%;'>
                                    <tr>
                                        <td style='width:33%;padding:5px;text-align: left;'><b> Accountant </b></td>
                                        <td style='width:33%;padding:5px;text-align: left;'> <b>Verified By </b></td>
                                        <td style='width:33%;padding:5px;text-align: right;'><b>Passed By</b></td>
                                    </tr>
                                </table>";
                        
                   
                      $content .= "</body>
                                 </html>";
            	
            	//echo $content;
            	
            	$this->load->library('pdf');
                
                $this->pdf->loadHtml($content);
                $this->pdf->render();
                $directory = FCPATH . "datas/agent_commission_pdf/jantha/";
                
                if(!is_dir($directory)){
                    mkdir($directory, 0777, true);
                }
                $filename = $vocher_no.".pdf";
                
                $filename = str_replace("/", "-", $filename);
                
                file_put_contents($directory.$filename, $this->pdf->output());
                
                //$pdfvocher   =	$this->pdf->stream($directory.$filename, array("Attachment" => false));
            /*
        	    $this->load->library('pdf');
            	$this->pdf->loadHtml($content);
            	$this->pdf->render();
            	$output = $this->pdf->output();
            	//echo $output;
            	$filename = "./datas/agent_commission_pdf/$vocher_no.pdf";
        //$pdfvocher   =	$this->pdf->stream("'$filename'".".pdf", array("Attachment" => false));
                file_put_contents("'{$filename}'", $output);
            //$pdfvocher->save('./datas/agent_commission_pdf/'.$vocher_no.'.pdf'); 
            */
            
            if(file_exists($directory.$filename)){
                echo json_encode(['status' => 'true','file' => base_url()."datas/agent_commission_pdf/jantha/".$filename]);
            } else {
                echo json_encode(['status' => 'false','file' => base_url()."datas/agent_commission_pdf/jantha/".$filename]);
            }
                
            }
     }
     
     
      public function agent_vocher_orc_pdf()
     {
         if($this->session->has_userdata('logged_in')) 
         { 
             $this->load->library('pdf');
             $policy_arr = $this->input->get("policy_arr");//explode(",",$this->input->get("policy_arr"));
             $agent = $this->input->get("agents");
             $vocher_no = $this->input->get("vocher_no");
             $v_date = $this->input->get("v_date");
             


             $company_details = $this->rm->get_company_details();
             $agent_details = $this->rm->get_single_agent_code($agent);
             
             if($this->session->userdata('session_company_type') == "unicorn"){
                 $company_details->name = "UNICORN";

             }

                 
                $content = "<!DOCTYPE html>
                            <html>
                            <head>
                                <title>Voucher ID : ".$vocher_no." </title>
                                <style>
                                    *{
                                        padding:1px;
                                        margin:0px;
                                        font-family: 'Courier';
                                        font-size:12px;
                                    }
                                </style>
                            </head>
                            <body>
                                <div style='border:1px solid #aaa;padding:10px;margin:30px;'>
                                <center><p style='font-size:20px;padding-top:0px;'>VOUCHER</p></center>
                                <table style='width:100%'>
                                    <tr>
                                        <td style='padding:15px;'>
                                            <p style='margin-top:5px;font-size:17px;'>".$company_details->name."</p>
                                            <p style='margin-top:5px;'>".$company_details->address."</p>
                                         </td>
                                        <td style='text-align: right;padding:15px;'>
                                            <p style='margin-top:5px;'><img src='./datas/temp/phone-icon.PNG' style='width:12px;'> +91 ".$company_details->phone." </p>
                                            <p style='margin-top:5px;'><img src='./datas/temp/email-icon.PNG' style='width:12px;'> ".$company_details->email." </p>
                                            <br>
                                        </td>
                                    </tr>
                                </table>";
                                
                                
                    $content .= "<table style='width:100%;margin-top:-10px;'>
                                    <tr>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'> Agent Code : ".$agent_details->agent_pos_code." </td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'> Agent Name : ".$agent_details->name." </td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Vocher No  : ".$vocher_no."</td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Date  : ".date_format(date_create($v_date),"d-m-Y")."</td>
                                    </tr>";
                              
                    $content .= "</table>";
                    
                    
                    $content .= "<table style='width:100%;margin-top:0px;'>
                                    <tr>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'> Pan No : ".$agent_details->pan_card_no." </td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'> Acc No : ".$agent_details->bank_acc_no." </td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Bank  : ".$agent_details->bank_name."</td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Branch  : ".$agent_details->branch."</td>
                                    </tr>";
                              
                    $content .= "</table>
                    
                    
                            <table style='width:100%;margin-top:10px;'>
                                    <tr>
                                        <td style='background-color:#dff0d8;width:25%;text-align: center;'> S.no </td>
                                        <td style='background-color:#dff0d8;width:25%;text-align: center;'> Policy Type</td>
                                        <td style='background-color:#dff0d8;width:25%;text-align: center;'>No of Policy </td>
                                        
                                        <td style='background-color:#dff0d8;width:30%;text-align: center;'>Total</td>
                                    </tr>";
                        
                        $a = 0;
                        
                        $tot_agent_commission = 0;
                        $total_ird = 0;
                        $total_additional = 0;
                        $tds = 0;
                        
                        for($i=0;$i<count($policy_arr);$i++)
                        {
                         
                             $agent_vocher = $this->rm->fetch_agent_vocher_orc($policy_arr[$i]);  
                             

                          
                             foreach($agent_vocher as $da)
                             {
                                 $a++;
                                if( !isset( $result[$da->policy_type] ) ) {
                                    $result[$da->policy_type]['noof'] = 0;
                                    $result[$da->policy_type]['amount'] = 0;
                                }
                                    $agent_commission = $da->agent_commission;
                                    
                               
                                    $total_ird = $agent_commission + $total_ird;
                                    $tot_agent_commission = $tot_agent_commission + $agent_commission;
                                    
                                    
                                     
                                      $result[$da->policy_type]['noof'] += 1; 
                                      $result[$da->policy_type]['amount'] += $da->agent_commission; 

                             }
                             
                             
                        }
                        if( isset( $result ) && !empty( $result ) ){
                            $policeTypes = array_keys($result);
                            $sl = 1;
                            $tot_agent_count =0;
                            foreach( $policeTypes as $ptype) {
                             $content .= "<tr>
                                <td style='padding:3px;text-align: left;'>".($sl++)."  </td>
                                <td style='padding:3px;text-align: left;'>".$ptype."  </td>
                                <td style='padding:3px;text-align: left;'>".$result[$ptype]['noof']."  </td>
                                <td style='padding:3px;text-align: right;'>".number_format(floor($result[$ptype]['amount']),2)."</td>
                                </tr>";
                                
                                $tot_agent_count += $result[$ptype]['noof'] ;
                                
                            }
                         }
                        
                       
                        
                        $tds_data = $this->rm->get_tds_percentage();
                        
                        if($tds_data != "")
                        {
                           $tds = $tds_data->tds_percentage;
                        }
                        else
                        {
                           $tds = 0;
                        }
                        
                        $content .= "<tr>
                                    <td style='padding:3px;text-align: left;background-color:#dff0d8;'></td>
                                    <td style='background-color:#dff0d8;padding:5px;text-align: left;'>Total Policy</td>
                                    <td style='padding:3px;text-align: left;background-color:#dff0d8;'>$tot_agent_count</td>
                                    <td style='padding:3px;text-align: right;'><b>".number_format(floor($tot_agent_commission),2)."</b></td>
                                </tr></table>";
                                
                                
                                 $content .= "<table><tr>
                                    <td style='padding:5px;text-align: left;width:50%;'>Total Commission</td>
                                    <td style='padding:5px;text-align: left;'> : </td>
                                    <td style='padding:5px;text-align: right;'>".number_format(floor($tot_agent_commission),2)."</td>
                                </tr>";
                                
                              

                        
                        $content .= "<br><table style='width:100%;'>
                                    <tr>
                                        <td style='width:33%;padding:5px;text-align: left;'><b> Accountant </b></td>
                                        <td style='width:33%;padding:5px;text-align: left;'> <b>Verified By </b></td>
                                        <td style='width:33%;padding:5px;text-align: right;'><b>Passed By</b></td>
                                    </tr>
                                </table>";
                        
                   
                      $content .= "</body>
                                 </html>";
            	
            	//echo $content;
            	
            	
                
                $this->load->library('pdf');
                
                $this->pdf->loadHtml($content);
                $this->pdf->render();
                $directory = FCPATH . "datas/agent_commission_pdf/unicorn/";
                
                if(!is_dir($directory)){
                    mkdir($directory, 0777, true);
                }
                
                $filename = "U-".$vocher_no.".pdf";
                
                $filename = str_replace("/", "-", $filename);
                
                file_put_contents($directory.$filename, $this->pdf->output());
                
                if(file_exists($directory.$filename)){
                    echo json_encode(['status' => 'true','file' => base_url()."datas/agent_commission_pdf/unicorn/".$filename]);
                } else {
                    echo json_encode(['status' => 'false','file' => base_url()."datas/agent_commission_pdf/unicorn/".$filename]);
                }
            /*
        	    $this->load->library('pdf');
            	$this->pdf->loadHtml($content);
            	$this->pdf->render();
            	$filename = "Voucher('".$vocher_no."')";
            	$this->pdf->stream("'$filename'".".pdf", array("Attachment" => false));
            */
            	
         }
     }
     
     
     public function agent_voucher_payment()
     {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        // if(!$this->auth->can_access('Agent Voucher Payment')){
        //     redirect('access_denied', 'refresh');
        // }
        if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        { 
                $pro_data["project_info"] = $this->mm->fetch_project_info();
                $data["bank"] = $this->rm->fetch_bank_list();
                $this->load->view('header',$pro_data);
                $this->load->view('agent_voucher_payment',$data);
                $this->load->view('footer',$pro_data);
            
        }
     }
     
    public function fetch_agent_voucher()
    {
         if($this->session->has_userdata('logged_in')) 
         {
             $agents = $this->input->post("agents");
             $res = $this->rm->fetch_agent_vouchers($agents);
            
            $agent_code_1 = $this->rm->get_single_agent_code($agents);
            
            if($agent_code_1 != NULL || $agent_code_1 !="")
            {
                $code=  $agent_code_1->agent_pos_code;
            }
            else
            {
                $code=  "";
            }
                
            $content = "";
        
            $content .="<table class='table' border='0'>
                            <tr>
                            <td style='font-size:16px;'>AGENT Code : ".$code."</td>
                            </tr>
                        </table>";
            
            $content .="<table class='table table-bordered'>
            <tr>
                  <td><input type='checkbox' class='form-check-input select_all' id='select_all' onclick=select_all()>&nbsp;Select All</td>
                  <td>Voucher no</td>
                  <td>Voucher Date</td>
                  <td>Comm. Amount</td>
                  <td>TDS Amount</td>
                  <td>Paid Amount</td>
            </tr>
            ";
            
            
            $paid_amt = 0;
            $total = 0;
            
            $tot_paid_amount = 0;
        
            foreach($res as $da)
            {
                
                $agent_commission = $da->ac + $da->add_com;
                //$tds = $this->rm->get_tds_amount_by_voucher_no($da->Vocher_no,$agents);
                $total = floor($agent_commission) + $total;
                
               $paid_amount =  floor($agent_commission) - 0;
               
               $tot_paid_amount = floor($paid_amount) + floor($tot_paid_amount);
                
              $content .="<tr>
                        <td onchange='calc()'><input type='checkbox' value=".$da->Vocher_no." class='form-check-input check'></td>
                        <td>".$da->Vocher_no."</td>
                        <td>".date_format(date_create($da->vocher_date),"d-m-Y")."</td>
                        <td style='text-align:right'>".(floor($agent_commission)).".00</td>
                        <td style='text-align:right'>0.00</td>
                        <td style='text-align:right'>".(floor($paid_amount)).".00</td>
                        </tr>";
                    }
            
            
             $content .="<tr>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td style='text-align:right'><b>Total</b></td>
                <td style='text-align:right'><b>".(floor($tot_paid_amount)).".00</b></td>
                </tr>";
           $content .="</table>";
           
          $content .="<div class='row'>
                          <div class='col-md-4'>
                             <div class='row'>
                                  <div class='col-md-4'>
                                     <label><b>Selected Total</b></label>
                                  </div>
                                  <div class='col-md-1'>
                                     <label> : </label>
                                  </div>
                                 <div class='col-md-1'>
                                     <p id='selected_total'> </p>
                                  </div>
                          </div>
                          </div>
                      </div>";
           
           echo $content;
        }
    }
     
    public function get_voucher_total()
    {
        if($this->session->has_userdata('logged_in'))
	    {
	        $voucher_arr = $this->input->post("vocher_arr");
	        $agent_commission_tot = 0;
	        $agent_tds = 0;
	        
	        $res = $this->rm->get_voucher_total_1($voucher_arr);
	     
	       foreach($res as $da)
	       {
    	         $agent_commission_tot = $da->ac + $agent_commission_tot;
	       }
	       
	       $tds_data = 0;

        	//$tds_data = $this->rm->get_tds_percentage();
        	

	       //$agent_commission = $agent_commission+$res->ac;  
	       //$agent_tds = $agent_tds+$res->tc;  
	       
	        //$selected_tot = $agent_commission-$agent_tds;
	        echo floor($agent_commission_tot);
	    }
    }
     
    public function fetch_agent_advance_list()
	{
	    if($this->session->has_userdata('logged_in'))
	    {
	        $res = $this->rm->fetch_agent_advance_list();
	        echo json_encode($res);
	    }
	}
	
	public function fetch_advance_amount_by_agent_id()
	{
	     if($this->session->has_userdata('logged_in'))
	    {
	        $agent_id = $this->input->post("agents");
	        $credit_tot = 0;
	        $debit_tot = 0;
	        
	        $debit_tot = $this->rm->fetch_advance_debit_amount_by_agent_id($agent_id);
	        $credit_tot = $this->rm->fetch_advance_credit_amount_by_agent_id($agent_id);
	        $advance_balance =  $debit_tot->debit_tot - $credit_tot->credit_tot ;
	        echo json_encode(array("adv_balance"=>$advance_balance));
	    }
	}
	
	public function add_agn_payment_entry()
	{
	    if($this->session->has_userdata('logged_in')) 
        {
            $agency = $this->input->post("agent");
            $vocher_arr = $this->input->post("vocher_arr");
            $trans_mode = $this->input->post("trans_mode");
            $bank = $this->input->post("bank_name");
            $account_no = $this->input->post("account_no");
            $ifsc_code = $this->input->post("ifsc_code");
            $bank_branch = $this->input->post("bank_branch");
            $transaction_no = $this->input->post("transaction_no");
            $remarks = $this->input->post("remarks");
            $check_no = $this->input->post("cheque_no");
            $trans_date = $this->input->post("trans_date");
            $adv_type = $this->input->post("adv_type");
            $adv_adjust = $this->input->post("adv_adjust");
            $extra_pay = $this->input->post("extra_pay");
            $paid_amount = $this->input->post("paid_amount");
            $res = $this->rm->get_voucher_total_1($vocher_arr);
            $agent_commission_tot = 0;
            $total_tds = 0;
            
            $date = date("Y-m-d H:i:s");
            $year = date('y');
            $month = date('m');
            
            if($month < 4)
            {
              $year = $year-1;
            }
            
            $x = 0;
            do 
            {
                $x++;
                $new_sr_no = "AC".$x."/".$year;
            } 
            while($this->rm->check_sr_no_already_exits($new_sr_no));
           
            foreach($res as $da)
            {
                 $agent_commission_tot = $agent_commission_tot + $da->ac;
                 $total_tds = $total_tds + $da->total_tds;
            }
            
            $net_amount = floor($agent_commission_tot) - ceil($total_tds); 

            $data = array(
                               "agent_id"=>$agency,
                               "agent_commission"=>floor($agent_commission_tot),
                               "adv_type" =>$adv_type,
                               "adv_adjustment" =>$adv_adjust,
                               "extra_payout" =>$extra_pay,
                               "tds" =>ceil($total_tds),
                               "type" =>$trans_mode,
                               "bank" =>$bank,
                               "account_no" =>$account_no,
                               "check_no" =>$check_no,
                               "ifsc_code" =>$ifsc_code,
                               "bank_branch" =>$bank_branch,
                               "transaction_no" =>$transaction_no,
                               "transaction_date" =>$trans_date,
                               "remarks" =>$remarks,
                               "created_date" =>date('Y-m-d H:i:s'),
                               "created_by" =>$this->session->userdata("session_id")
                               );
            $res = $this->rm->add_agn_payment_entry($data);
            
            for($i=0;$i<count($vocher_arr);$i++)
            {
                $data_1 = array(
                                  "vocher_no" =>$vocher_arr[$i],
                                  "payment_id" =>$res,
                                  "created_date" =>date("Y-m-d H:i:s"),
                                  "created_by" =>$this->session->userdata("session_id"),
                                );
                $vocher_update = $this->rm->add_agent_vocher_payment($data_1);
                $pay_status = array("pay_status" =>"1");
                $update = $this->rm->update_pay_status($pay_status,$vocher_arr[$i]);
            }
            
            if($adv_type == "Extra_payout")
            {
                 $data = array(
                                "agent_id" =>$agency,
                                "payment_id" =>$res,
                                "amount" =>$extra_pay,
                                "type" =>"debit",
                                "date" =>$trans_date,
                                "payment_mode" =>$trans_mode,
                                "transaction_no" =>$transaction_no,
                                "account_no" =>$account_no,
                                "check_no" =>$check_no,
                                "ifsc_code" =>$ifsc_code,
                                "bank_branch" =>$bank_branch,
                                "reason" =>$remarks,
                                "created_by" =>$this->session->userdata("session_id"),
                                "created_date" =>date("Y-m-d H:i:s"),
                               );
                               
                $res = $this->rm->add_advance_amount($data);
            }
            else if($adv_type == "Advance_adjustment")
            {
                $data = array(
                                "agent_id" =>$agency,
                                "payment_id" =>$res,
                                "amount" =>$adv_adjust,
                                "type" =>"credit",
                                "date" =>$trans_date,
                                "payment_mode" =>$trans_mode,
                                "transaction_no" =>$transaction_no,
                                "transaction_no" =>$transaction_no,
                                "account_no" =>$account_no,
                                "check_no" =>$check_no,
                                "ifsc_code" =>$ifsc_code,
                                "bank_branch" =>$bank_branch,
                                "reason" =>$remarks,
                                "created_by" =>$this->session->userdata("session_id"),
                                "created_date" =>date("Y-m-d H:i:s"),
                               );
                               
                $res = $this->rm->add_advance_amount($data);
            }
             
            $agent_code = $this->rm->get_agent_code_by_id($agency);
            $get_ledger = $this->rm->get_ledger_acc($agent_code->agent_pos_code);
            
            $commission_arr = array(
                    "agent_id" =>$agency,
                    "vhcharaccid" =>$get_ledger->account_name,
                    "debit" =>floor($agent_commission_tot),
                    "date" =>date("Y-m-d"),
                    "created_by"=>$this->session->userdata("session_id"),
                    "created_at" =>date("Y-m-d H:i:s"),
            );
            
            $res_1 = $this->rm->add_agent_commission($commission_arr);
            
            $accarr = array(
                    "sr_no" =>$new_sr_no,
                    "parent_id" =>"acc213",
                    "sub_id" =>$agency,
                    "credit" =>floor($net_amount),
                    "lead_id" =>$res,
                    "note" =>"Agent Payment",
                    "datetime" =>date("Y-m-d H:i:s"),
                    "created_by"=>$this->session->userdata("session_id"),
            );
            $res_2 = $this->rm->add_acc_own_commission($accarr);
            
            $this->calc_agent_commission($agency,$get_ledger->account_id);
        }
	}
	
	
	public function active_policy_report()
	{
	    if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        // if(!$this->auth->can_access('Active Policy Report')){
        //     redirect('access_denied', 'refresh');
        // }
       
	    if($this->session->has_userdata('logged_in')) 
        {
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $data["ins_company"] = $this->rm->get_insurance_company_list();
            $data["class"] = $this->rm->get_class_list();
            $data["cover"] = $this->rm->get_policy_cover_type();
    		$this->load->view('header',$pro_data);
    		$this->load->view('active_policy_report',$data);
    		$this->load->view('footer',$pro_data);
        }
    
	}
	
	public function fetch_policy_type_1()
	{
	    if($this->session->has_userdata('logged_in')) 
        {
            $class = $this->input->post("s_class");
            $res = $this->rm->get_policy_type($class);
            
            $content = "<option value='all'>All</option>";
            
            foreach($res as $da)
            {
                $content .="<option value=".$da->id.">".$da->policy_type."</option>"; 
            }
            
            echo $content;
        }
	}
	
	
	public function fetch_active_policy_report()
	{
	    if($this->session->has_userdata('logged_in')) 
        {
            $fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
            
            $ins_company = $this->input->post("ins_company");
            $select_class = $this->input->post("select_class");
            $select_c_type = $this->input->post("select_c_type");
            $from_date = $this->input->post("from_date");
            $to_date = $this->input->post("to_date");
            
             $res = $this->rm->fetch_active_policy_report($ins_company,$select_class,$select_c_type,$from_date,$to_date);
             
            $content = "<div class='table-responsive'>
                          <table class='table table-hover table-bordered'>
                            <thead>
                                    <th>S.No</th>
                                    <th>Customer</th>
                                    <th>Mobile No</th>
                                    <th>Agent id</th>'
                                    <th>Policy Issue Date</th>
                                    <th>Policy No</th>
                                    <th>Insurer</th>
                                    <th>Area Incharge</th>
                                    <th>User</th>
                                    <th>Bussiness Type</th>
                                    <th>Class</th>
                                    <th>Pol Type</th>
                                    <th>OD</th>
                                    <th>TP</th>
                                    <th>Net Premium</th>
                                    <th>GST</th>";
                                if($this->session->userdata('session_role') != "user" && $this->session->userdata('session_role') != "AI") {
                    $content .= "    <th>Jayantha Own Commission</th>
                                    <th>Unicorn Own Commission</th>
                                    <th>Total Own Commission</th>
                                    <th>Jayantha Agent Commission</th>
                                    <th>Unicorn Agent Commission</th>
                                    <th>Agent Commission</th>
                                    <th>Own Com Additional</th>
                                    <th>Agent Com Additional</th>";
                                     }
                     $content .= " 
                                </thead>
                                <tbody>";
                                
            $a = 0;
            
            $gst = 0;
            $agn_com = 0;
            $own_com = 0;
            
            $add_own_com = 0;
            $add_agn_com = 0;
            
            $add_jay_own_com = 0;
            $add_jay_agn_com = 0;
             $add_uni_own_com = 0;
            $add_uni_agn_com = 0;
            
            foreach($res as $da)
            {
                $a++;
                
                $gst = $gst+$da->gst;
                $agn_com = $agn_com + $da->agent_commission_amt + $da->agent_commission;
                $own_com = $own_com + $da->own_commission_amt + $da->own_commission;
                
                $add_jay_own_com = $add_jay_own_com + $da->own_commission_amt;
                $add_jay_agn_com = $add_jay_agn_com + $da->agent_commission_amt;
                
                $add_uni_own_com = $add_uni_own_com + $da->own_commission;
                $add_uni_agn_com = $add_uni_agn_com + $da->agent_commission;
                
                $add_own_com = $add_own_com + $da->com_add_com;
                $add_agn_com = $add_agn_com + $da->agn_add_com;
                
                if($da->com_add_com !='')
                { 
                    
                }
                else
                {
                    
                }
                
                
                $content .="<tr>";
                            $content .="<td>".$a."</td>";
                            $content .="<td>".$da->client_name."</td>";
                            $content .="<td>".$da->mobile_no."</td>";
                            $content .="<td>".$da->agn_name."(".$da->agent_pos_code.")</td>";
                            $content .="<td>".date_format(date_create($da->policy_issue_date),"d-m-Y")."</td>";
                            $content .="<td>".$da->policy_no."</td>";
                            $content .="<td>".$da->company_name."</td>";
                            $content .="<td>".$da->ai_name."</td>";
                            $content .="<td>".$da->assigned_user."</td>";
                            $content .="<td>".$da->business_name."</td>";
                            $content .="<td>".$da->class_name."</td>";
                            $content .="<td>".$da->policy_type."</td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->total_own_damage, "INR")."</td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->tot_liability_premium, "INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->total_premium, "INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->gst, "INR")."</span></td>";
                            if($this->session->userdata('session_role') != "user" && $this->session->userdata('session_role') != "AI") 
                            { 
                                $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->own_commission_amt, "INR")."</span></td>";
                                $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->own_commission, "INR")."</span></td>";
                                $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->own_commission_amt+$da->own_commission, "INR")."</span></td>";
                                $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->agent_commission_amt, "INR")."</span></td>";
                                $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->agent_commission, "INR")."</span></td>";
                                $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->agent_commission_amt+$da->agent_commission, "INR")."</span></td>";
                                $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->com_add_com, "INR")."</span></td>";
                                $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->agn_add_com, "INR")."</span></td>";
                             }
                            $content .="</tr>";
            }
            
            $content .="<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style='text-align:right'><b>Total</b></td>
                            <td style='text-align:right'><b>".$fmt->formatCurrency($gst,"INR")."</b></td>";
                            if($this->session->userdata('session_role') != "user" && $this->session->userdata('session_role') != "AI") 
                            { 
                                $content .="<td style='text-align:right'><b>".$fmt->formatCurrency($add_jay_own_com,"INR")."</b></td>
                                <td style='text-align:right'><b>".$fmt->formatCurrency($add_uni_own_com,"INR")."</b></td>
                                <td style='text-align:right;'><b>".$fmt->formatCurrency($own_com,"INR")."</b></td>
                                <td style='text-align:right'><b>".$fmt->formatCurrency($add_jay_agn_com,"INR")."</b></td>
                                <td style='text-align:right'><b>".$fmt->formatCurrency($add_uni_agn_com,"INR")."</b></td>
                                <td style='text-align:right'><b>".$fmt->formatCurrency($agn_com,"INR")."</b></td>
                                <td style='text-align:right'><b>".$fmt->formatCurrency($add_own_com,"INR")."</b></td>
                                <td style='text-align:right'><b>".$fmt->formatCurrency($add_agn_com,"INR")."</b></td>";
                            }
                     $content .=" <td style='text-align:right'></td>
                        </tr>";
                 $content .="</tbody></table></div>";
                 echo $content;
        }
	}
	
	
	public function fetch_active_policy_report_excel()
	{
	    if($this->session->has_userdata('logged_in')) 
        {
            $ins_company = $this->input->post("ins_company");
            $select_class = $this->input->post("select_class");
            $select_c_type = $this->input->post("select_c_type");
            $from_date = $this->input->post("from_date");
            $to_date = $this->input->post("to_date");
            
            $this->load->library('Excel');
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            
            $rowCount = 4;
            
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
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'JAYANTHA INSURANCE');
            
            $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Active Policy Report');
            
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
        $objPHPExcel->getActiveSheet()->SetCellValue('F3', date_format(date_create($from_date),"d-m-Y"));
        $objPHPExcel->getActiveSheet()->SetCellValue('G3', date_format(date_create($to_date),"d-m-Y"));
        
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
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Customer');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Mobile No');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Agent id');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Policy Issue Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Policy No');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Insurer');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Bussiness Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Class');
        $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Pol Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'OD');
        $objPHPExcel->getActiveSheet()->SetCellValue('L4', 'TP');
        $objPHPExcel->getActiveSheet()->SetCellValue('M4', 'Net Premium');
        $objPHPExcel->getActiveSheet()->SetCellValue('N4', 'GST');
        $objPHPExcel->getActiveSheet()->SetCellValue('O4', 'Jayantha Own Commission');
        $objPHPExcel->getActiveSheet()->SetCellValue('P4', 'Unicorn Own Commission');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q4', 'Total Own Commission');
        $objPHPExcel->getActiveSheet()->SetCellValue('R4', 'Jayantha Agent Commission');
        $objPHPExcel->getActiveSheet()->SetCellValue('S4', 'Unicorn Agent Commission');
        $objPHPExcel->getActiveSheet()->SetCellValue('T4', 'Total Agent Commission');
        $objPHPExcel->getActiveSheet()->SetCellValue('U4', 'Own Add Commission');
        $objPHPExcel->getActiveSheet()->SetCellValue('V4', 'Add Agent Commission');
        
        $row_count = 5;
        $a = 0;
            
        $res = $this->rm->fetch_active_policy_report($ins_company,$select_class,$select_c_type,$from_date,$to_date);
           
                                
            $a = 0;
            
            $gst = 0;
            $agn_com = 0;
            $own_com = 0;
            
            $add_own_com = 0;
            $add_agn_com = 0;
            
            $add_jay_own_com = 0;
            $add_jay_agn_com = 0;
             $add_uni_own_com = 0;
            $add_uni_agn_com = 0;
            
            foreach($res as $da)
            {
                $a++;
                
                $gst = $gst+$da->gst;
               $agn_com = $agn_com + $da->agent_commission_amt + $da->agent_commission;
                $own_com = $own_com + $da->own_commission_amt + $da->own_commission;
                
                $add_jay_own_com = $add_jay_own_com + $da->own_commission_amt;
                $add_jay_agn_com = $add_jay_agn_com + $da->agent_commission_amt;
                
                $add_uni_own_com = $add_uni_own_com + $da->own_commission;
                $add_uni_agn_com = $add_uni_agn_com + $da->agent_commission;
                
                $add_own_com = $add_own_com + $da->com_add_com;
                $add_agn_com = $add_agn_com + $da->agn_add_com;
               
               
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->client_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->mobile_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->agent_pos_code);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , date_format(date_create($da->policy_issue_date),"d-m-Y"));
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $da->policy_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->company_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $da->business_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , $da->class_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row_count , $da->policy_type);
                $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row_count , $da->total_own_damage);
                $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row_count , $da->tot_liability_premium);
                $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row_count , $da->total_premium);
                $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row_count , $da->gst);
                $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row_count , $da->own_commission_amt);
                $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row_count , $da->own_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row_count , $da->own_commission_amt+$da->own_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('R'.$row_count , $da->agent_commission_amt);
                $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row_count , $da->agent_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('T'.$row_count , $da->agent_commission_amt+$da->agent_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('U'.$row_count , $da->com_add_com);
                $objPHPExcel->getActiveSheet()->SetCellValue('V'.$row_count , $da->agn_add_com);
              
                $objPHPExcel->getActiveSheet()->getStyle('F'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('K'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('L'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('M'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('N'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('O'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('O'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('P'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('Q'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('R'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('S'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('T'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('U'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('V'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
               
                
                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
            }
                $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row_count ,"TOTAL");
                $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row_count , $gst);
                $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row_count , $add_jay_own_com);
                $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row_count , $add_uni_own_com);
                $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row_count , $own_com);
                $objPHPExcel->getActiveSheet()->SetCellValue('R'.$row_count , $add_jay_agn_com);
                $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row_count , $add_uni_agn_com);
                $objPHPExcel->getActiveSheet()->SetCellValue('T'.$row_count , $agn_com);
                
                $objPHPExcel->getActiveSheet()->SetCellValue('U'.$row_count , $add_own_com);
                $objPHPExcel->getActiveSheet()->SetCellValue('V'.$row_count , $add_agn_com);
                
                
                $objPHPExcel->getActiveSheet()->getStyle('M'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('N'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('O'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('P'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('Q'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('R'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('S'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('T'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('U'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('V'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                
                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
            
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                $objWriter->save('./datas/reports/active_policy_report.xlsx');
                echo base_url()."/datas/reports/active_policy_report.xlsx";
        }
	}
	
	public function download_leads_excel()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        {
            $order_category = $this->input->post("order_category");
            
            $res = $this->rm->fetch_all_leads($order_category);
         
            $this->load->library('Excel');
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            
            $rowCount = 4;
            
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
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'JAYANTHA INSURANCE');
            
            $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Lead Details Report');
            
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
        // $objPHPExcel->getActiveSheet()->SetCellValue('F3', date_format(date_create($from_date),"d-m-Y"));
        // $objPHPExcel->getActiveSheet()->SetCellValue('G3', date_format(date_create($to_date),"d-m-Y"));
        
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
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Client name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Mobile No');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Class');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Policy Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Business type');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Area');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Agn Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'User');
        $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'AI');
        $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'Due Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('L4', 'Vehicle Regn No');
        $objPHPExcel->getActiveSheet()->SetCellValue('M4', 'Classification');
     
        
        $row_count = 5;
        $a = 0;
        
        $regn_no = "";
       
         foreach($res as $da)
         {
    	        $a++;
    	        
                $date = "No Due Date";
                
                if($da->due_date != "0000-00-00")
                {
                    $date = date_format(date_create($da->due_date),"d-m-Y"); 
                }
                
                if(isset($da->agency_and_pos))
                {
                    if($da->agency_and_pos != "")
                    {
                         $get_agent_name = $this->rm->get_agent_name($da->agency_and_pos);
                         $agn_name = $get_agent_name->agent_pos_code;
                    }
                    else
                    {
                     $agn_name = "";
                    }
                }
                else
                {
                    $agn_name = "";
                }
                
                if($da->assigned_user != "all")
                {
                    if($da->assigned_user != "")
                    {
                     $get_user = $this->rm->get_user_name($da->assigned_user);
                     $usr_name = $get_user->name;
                    }
                    else
                    {
                     $usr_name = "";
                    }
                }
                else
                {
                     $usr_name = "";
                } 
                
                $ai = "";
                
                if($da->area_incharge != "all")
                {
                    if($da->area_incharge != "")
                    {
                     $ai = $this->rm->get_area_incharge($da->area_incharge);
                     
                         if(isset($ai->name))
                         {
                            $ai = $ai->name;
                         }
                    }
                    else
                    {
                      $ai = "";
                    }
                }
                else
                {
                     $ai = "";
                } 
         
             $classification = ""; 
             if($da->policy_status == "0" && $da->lead_type == "0" && $da->classfication == "1")
             {
                 $classification = "HOT";
             }
             else if($da->policy_status == "0" && $da->lead_type == "0" &&  $da->classfication == "2")
             {
                 $classification = "WARM";
             }
             else if($da->policy_status == "0" && $da->lead_type == "0" && $da->classfication == "3")
             {
                 $classification = "COLD";
             }
             else if($da->policy_status == "0" && $da->lead_type == "1")
             {
                  $classification = "PROSPECTS";
             }
            
    	         
    	    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->client_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->mobile_no);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->lclass);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , $da->p_type);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $da->b_type);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->area);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $agn_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , $usr_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row_count , $ai);
            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row_count , $date);
            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row_count , $da->vechi_register_no);
            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row_count , $classification);
            
            $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
            $row_count++;
         }
         
         $res = [];
         
        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save('./datas/reports/lead_report.xlsx');
        echo base_url()."/datas/reports/lead_report.xlsx";
        }
	}
      
       public function get_agent_bank_details()
       {
            if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin")
            {
                $agent = $this->input->post("agents");
                $res = $this->rm->get_agent_bank_details($agent);
                echo json_encode($res);
            }
       }
       
       
       public function agent_payment_details()
       {
            if( !( $this->session->has_userdata('logged_in') ) ){
                redirect('login', 'refresh');
            }
            
            // if(!$this->auth->can_access('Agent Payment Details')){
            //     redirect('access_denied', 'refresh');
            // }
            if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin")
            {
                $pro_data["project_info"] = $this->mm->fetch_project_info();
                $data["agents"] = $this->rm->fetch_agents_list();
                $this->load->view('header',$pro_data);
                $this->load->view('agent_payment_details',$data);
                $this->load->view('footer',$pro_data);
            }
       }
       
       public function fetch_agent_payment_details()
       {
           if($this->session->has_userdata('logged_in'))
           {
                   $draw = intval($this->input->post("draw"));
                   $agent = $this->input->post("agents");
                   $policy_no = $this->input->post("policy_no");
                   $voucher_no = $this->input->post("voucher_no");
                   
                   $res = $this->rm->fetch_agent_payment_details($agent,$policy_no,$voucher_no);
                  
                   // echo $res; 
                   
                   $arr = [];
                   $a = 0 ;
                 
                    foreach($res as $da)
                    {
                    	$a++;
                    	 $view = "<a href='#' onclick=view_data(".$da->id.")>".$da->name."</a>";
                    	 
                        $arr[] = array(
                            $a,
                            $view,
                            $da->agent_pos_code,
                            date_format(date_create($da->transaction_date),"d-m-Y H:i:s"),
                            $da->type,
                            number_format($da->agent_commission,2),
                            number_format($da->tds,2),
                            $da->created_by,
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
       
       public function agent_vocher_payment_details()
       {
           if($this->session->has_userdata('logged_in'))
           {
               $id = $this->input->post("id");
               
               $res = $this->rm->get_agent_vocher_details($id);

                $agent_name = $res->name;
                $agent_code = $res->agent_pos_code;
                $region_id = $res->region;
                $area_incharge = $res->area_incharge;

                $region = $this->rm->get_region($region_id);
               
                $content = "<style> 
                 .wrap-it{
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
                                        <th style='width:25%;word-break:break-word;'>Agent Name</th>
                                        <th style='width:25%;word-break:break-word;'>Agent Code</th>
                                        <th style='width:25%;word-break:break-word;'>Region</th>
                                        <th style='width:25%;word-break:break-word;'>Area Incharge</th>
                                   </tr>";
                                   
                                  $content .="<tr>
                                             <td style='width:25%;word-break:break-word;'>".$agent_name."</td>
                                             <td style='width:25%;word-break:break-word;'>".$agent_code."</td>
                                             <td style='width:25%;word-break:break-word;'>".$region->reigion."</td>
                                             <td style='width:25%;word-break:break-word;'>".$area_incharge."</td>
                                       </tr>";
                                     
        	                       $content .="</table>";
        	                       
        	                    $content .="<h4>Payment Details - Trans Mode : ".$res->type."</h4>";
        	                    
        	                     if($res->type == "BANK")
        	                     {
        	                        $content .="<table class='table table-bordered' style='width:100%'>
            	                       <tr>
            	                            <th style='width:25%;word-break:break-word;'>Bank Name</th>
            	                            <th style='width:25%;word-break:break-word;'>Acc No</th>
            	                            <th style='width:25%;word-break:break-word;'>IFSC Code</th>
            	                            <th style='width:25%;word-break:break-word;'>Transaction No</th>
            	                       </tr>
            	                       <tr>
            	                            <td style='width:25%;word-break:break-word;'>".$res->bank."</td>
            	                            <td style='width:25%;word-break:break-word;'>".$res->account_no."</td>
            	                            <td style='width:25%;word-break:break-word;'>".$res->ifsc_code."</td>
            	                            <td style='width:25%;word-break:break-word;'>".$res->transaction_no."</td>
            	                       </tr>
            	                       </table>";
        	                     }
        	                     else if($res->type == "Check")
        	                     {
        	                         $content .="<table class='table table-bordered' style='width:100%'>
            	                       <tr>
            	                            <td style='width:50%;word-break:break-word;'>Check No</td>
            	                            <td style='width:50%;word-break:break-word;'>Check. Date</td>
            	                       </tr>
            	                       <tr>
            	                            <td style='width:50%;word-break:break-word;'>".$res->check_no."</td>
            	                            <td style='width:50%;word-break:break-word;'>". date_format(date_create($res->transaction_date),"d-m-Y")."</td>
            	                       </tr>
            	                       </table>";
        	                     }
        	                     else 
        	                     {
        	                         $content .="<table class='table table-bordered' style='width:100%'>
            	                       <tr>
            	                            <th style='width:50%;word-break:break-word;'>Trans. Date</th>
            	                            <th style='width:50%;word-break:break-word;'>Trans. Amount</th>
            	                       </tr>
            	                       <tr>
            	                            <td style='width:50%;word-break:break-word;'>".date_format(date_create($res->transaction_date),"d-m-Y")."</td>
            	                            <td style='width:50%;word-break:break-word;'>".floor($res->agent_commission)."</td>
            	                       </tr>
            	                       </table>";
        	                     }
        	                     
        	                     
        	                      $content .="<h4>Voucher Details</h4>";
        	                     
        	                     $vocher_no = $this->rm->get_voucher_no_by_payment_id($id);
        	                     
        	                     $vocher_arr = [];
        	                     
        	                     foreach($vocher_no as $da)
        	                     {
        	                         $vocher_arr[] = $da->vocher_no;
        	                     }

        	                    $data = $this->rm->get_voucher_total_amount($vocher_arr);
        	                    $agent_commission_tot = 0;

                                $content .="<table class='table table-bordered' style='width:100%'>
                                <tr>
                                    <th style='width:50%;word-break:break-word;'>Voucher No</th>
                                    <th style='width:50%;word-break:break-word;text-align:center;'>Agent Commission</th>
                                </tr>";
        	                    
        	                    foreach($data as $da)
        	                    {
                        	         $agent_com =  $da->ac + $da->agn_add_com_amt;
                        	         $agent_commission_tot = $agent_commission_tot+$agent_com;
                        	         
                        	         $view_vocher = "<a href='#' onclick=view_vocher('".$da->vocher_no."')>".$da->vocher_no."</a>";
                        	          
                        	          $content .="<tr>
            	                            <td style='width:50%;word-break:break-word;'>".$view_vocher."</td>
            	                            <td style='width:50%;word-break:break-word;text-align:right;'>".number_format(floor($agent_com),2)."</td>";
            	                      $content .=" </tr>";
        	                    }
        	                   
                            $content .="<tr>
                                <td style='width:50%;word-break:break-word;'><b>Total</b></td>
                                <td style='width:50%;word-break:break-word;text-align:right;'>".number_format(floor($agent_commission_tot),2)."</td>";
                            $content .=" </tr>";
                            
        	                $content .="</table>";
        	                     
        	                     
                          $content .="<table class='table table-bordered' style='width:100%'>
            	                       <tr>
            	                            <th style='width:25%;word-break:break-word;'>Trans. Date</th>
            	                            <th style='width:25%;word-break:break-word;'>Advance Type</th>
            	                            <th style='width:25%;word-break:break-word;'>Amount</th>
            	                            <th style='width:25%;word-break:break-word;'>Trans. Amount</th>
            	                       </tr>
            	                       <tr>
            	                            <td style='width:25%;word-break:break-word;'>".date_format(date_create($res->transaction_date),"d-m-Y")."</td>
            	                            <td style='width:25%;word-break:break-word;'>".$res->adv_type."</td>";
            	                            
            	                            if($res->adv_type == "Extra_payout")
            	                            { 
            	                                $content .="<td style='width:25%;word-break:break-word;'>".$res->extra_payout."</td>";
            	                            }
            	                            else if($res->adv_type == "Advance_adjustment")
            	                            {
            	                                $content .="<td style='width:25%;word-break:break-word;'>".$res->adv_adjustment."</td>";
            	                            }
            	                       $content .="<td style='width:25%;word-break:break-word;'>".floor($res->transfer_amount)."</td></tr>
	                            </table>";
	                            
	                             $content .= "<h4>Summary : </h4>
	                             <table>
    	                             <tr>
                                        <td style='padding:5px;text-align: left;width:50%;'>Voucher Payment</td>
                                        <td style='padding:5px;text-align: left;'> : </td>
                                        <td style='padding:5px;text-align:left;width:50%;text-align: right;'>".number_format(floor($agent_commission_tot),2)."</td>
                                    </tr>";
                                
                               
                                    
                                    if($res->adv_type == "Extra_payout")
                                    { 
                                       $content .= "<tr>
                                        <td style='padding:5px;text-align:left;width:50%;'>".$res->adv_type."</td>
                                        <td style='padding:5px;text-align: left;'> : </td>";
                                        $content .="<td style='padding:5px;text-align:left;width:50%;text-align: right;'>".$res->extra_payout."</td>";
                                         $content .= "</tr>";
                                    }
                                    else if($res->adv_type == "Advance_adjustment")
                                    {
                                         $content .= "<tr>
                                            <td style='padding:5px;text-align:left;width:50%;'>".$res->adv_type."</td>
                                            <td style='padding:5px;text-align: left;'> : </td>";
                                            $content .="<td style='padding:5px;text-align:left;width:50%;text-align: right;'>".$res->adv_adjustment."</td>";
                                        $content .= "</tr>";
                                    }
                                    
                                $content .= "<tr>
                                                    <td style='padding:5px;text-align: left;width:50%;'> TDS</td>
                                                    <td style='padding:5px;text-align: left;'> : </td>
                                                    <td style='padding:5px;text-align:left;width:50%;text-align: right;'>".number_format(ceil($res->tds),2)."</td>
                                                </tr>
                                            ";

                                 $content .= "<tr>
                                                    <td style='padding:5px;text-align: left;width:50%;'>Paid Amount</td>
                                                    <td style='padding:5px;text-align: left;'> : </td>
                                                    <td style='padding:5px;text-align:left;width:50%;text-align: right;'>".number_format(floor($res->transfer_amount),2)."</td>
                                                </tr>
                                            </table>";
            	            echo  $content;        
           }
       }
       
       
     public function agent_vocher_print()
     {
         if($this->session->has_userdata('logged_in')) 
         { 
             $this->load->library('pdf');
             $vocher_no = $this->input->get("vocher_no");
             $company_details = $this->rm->get_company_details();
             $data = $this->rm->get_agent_details_by_vocher_no($vocher_no);
             $agent_id = $data->policy_agency_pos;
             $agent_details = $this->rm->get_single_agent_code($agent_id);
             $agent_vocher = $this->rm->fetch_agent_voucher_details($vocher_no);   
              
                $content = "<!DOCTYPE html>
                            <html>
                            <head>
                                <title>Voucher ID : ".$vocher_no." </title>
                                <style>
                                    *{
                                        padding:1px;
                                        margin:0px;
                                        font-family: 'Courier';
                                        font-size:12px;
                                    }
                                </style>
                            </head>
                            <body>
                                <div style='border:1px solid #aaa;padding:10px;margin:30px;'>
                                <center><p style='font-size:20px;padding-top:0px;'>VOUCHER</p></center>
                                <table style='width:100%'>
                                    <tr>
                                        <td style='padding:15px;'>
                                            <p style='margin-top:5px;font-size:17px;'>".$company_details->name."</p>
                                            <p style='margin-top:5px;'>".$company_details->address."</p>
                                         </td>
                                        <td style='text-align: right;padding:15px;'>
                                            <p style='margin-top:5px;'><img src='./datas/temp/phone-icon.PNG' style='width:12px;'> +91 ".$company_details->phone." </p>
                                            <p style='margin-top:5px;'><img src='./datas/temp/email-icon.PNG' style='width:12px;'> ".$company_details->email." </p>
                                            <br>
                                        </td>
                                    </tr>
                                </table>";
                     $v_date = "2022-12-21";           
                                
                    $content .= "<table style='width:100%;margin-top:-10px;'>
                                    <tr>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'> Agent Code : ".$agent_details->agent_pos_code." </td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'> Agent Name : ".$agent_details->name." </td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Vocher No  : ".$vocher_no."</td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Date  : ".date_format(date_create($v_date),"d-m-Y")."</td>
                                    </tr>";
                              
                    $content .= "</table>";
                    
                    
                    $content .= "<table style='width:100%;margin-top:0px;'>
                                    <tr>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'> Pan No : ".$agent_details->pan_card_no." </td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'> Acc No : ".$agent_details->bank_acc_no." </td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Bank  : ".$agent_details->bank_name."</td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Branch  : ".$agent_details->branch."</td>
                                    </tr>";
                              
                    $content .= "</table>
                    
                    
                                <table style='width:100%;margin-top:10px;'>
                                    <tr>
                                        <td style='background-color:#dff0d8;width:5%;text-align: center;'> S.no </td>
                                        <td style='background-color:#dff0d8;width:10%;text-align: center;'> P Date</td>
                                        <td style='background-color:#dff0d8;width:20%;text-align: center;'>Policy no</td>
                                        <td style='background-color:#dff0d8;width:10%;text-align: center;'>Insurer</td>
                                        <td style='background-color:#dff0d8;width:10%;text-align: center;'>Name</td>
                                        <td style='background-color:#dff0d8;width:10%;text-align: center;'>IRD</td>
                                        <td style='background-color:#dff0d8;width:15%;text-align: center;'>Adv Exp</td>
                                        <td style='background-color:#dff0d8;width:20%;text-align: center;'>Total</td>
                                    </tr>";
                        
                        $a = 0;
                        
                        $tot_agent_commission = 0;
                        $total_ird = 0;
                        $total_additional = 0;
                        $tds = 0;
                        
                        
                         
                         foreach($agent_vocher as $da)
                         {
                             $a++;
                             
                                $agent_commission = $da->agent_commission_amt + $da->agn_add_com;
                                $irdi_commission = $agent_commission * 15/100; 
                                $additional_commission = $agent_commission - $irdi_commission;
                                $tds = "0";
                                
                                $total_ird = $irdi_commission + $total_ird;
                                $total_additional = $additional_commission + $total_additional;
                                $tot_agent_commission = $tot_agent_commission + $agent_commission;
                
                             
                              
                                $content .= "<tr>
                                    <td style='padding:3px;text-align: left;'>".$a."  </td>
                                    <td style='padding:3px;text-align: left;'>".date_format(date_create($da->created_at),"d-m-Y")."  </td>
                                    <td style='padding:3px;text-align: left;'>".$da->policy_no."  </td>
                                    <td style='padding:3px;text-align: left;'>".$da->company_name."  </td>
                                    <td style='padding:3px;text-align: left;'>".$da->client_name."  </td>
                                    <td style='padding:3px;text-align: right;'>".number_format(floor($irdi_commission),2)."  </td>
                                    <td style='padding:3px;text-align: right;'>".number_format(floor($additional_commission),2)."  </td>
                                    <td style='padding:3px;text-align: right;'>".number_format(floor($agent_commission),2)."</td>
                                </tr>";
                         }
                     
                        
                        
                        $content .= "<tr>
                                    <td style='padding:3px;text-align: left;background-color:#dff0d8;'></td>
                                    <td style='padding:3px;text-align: left;background-color:#dff0d8;'></td>
                                     <td style='padding:3px;text-align: left;background-color:#dff0d8;'></td>
                                    <td style='background-color:#dff0d8;padding:3px;text-align: left;'>SUMMARY</td>
                                    <td style='padding:3px;text-align: left;background-color:#dff0d8;'></td>
                                    <td style='padding:3px;text-align: right;'><b>".number_format(floor($total_ird),2)." </b></td>
                                    <td style='padding:3px;text-align: right;'><b>".number_format(floor($total_additional),2)." </b> </td>
                                    <td style='padding:3px;text-align: right;'><b>".number_format(floor($tot_agent_commission),2)."</b></td>
                                </tr></table>";
                                
                             
                                
                                 $content .= "<table><tr>
                                    <td style='padding:5px;text-align: left;width:50%;'>Total Commission</td>
                                    <td style='padding:5px;text-align: left;'> : </td>
                                    <td style='padding:5px;text-align: right;'>".number_format(floor($tot_agent_commission),2)."</td>
                                </tr>";
                                
                                   $tds_amount = $this->rm->get_tds_amount($vocher_no);
                                
                                if($tds_amount != "")
                                {
                                  $tds =  $tds_amount->tds_amount;
                                }
                                else
                                {
                                    $tds = "0";
                                }
                                
                                $net = floor($tot_agent_commission) - ceil($tds);
                                
                                 $content .= "<tr>
                                    <td style='padding:5px;text-align:left;width:50%;'>TDS</td>
                                    <td style='padding:5px;text-align: left;'> : </td>
                                    <td td style='padding:5px;text-align: right;'>".number_format(ceil($tds),2)."</td>
                                </tr>";
                                
                                
                                
                                 $content .= "<tr>
                                                    <td style='padding:5px;text-align: left;width:50%;'>NET Payable</td>
                                                    <td style='padding:5px;text-align: left;'> : </td>
                                                    <td td style='padding:5px;text-align: right;'>".number_format(floor($net),2)."</td>
                                                </tr>
                                            </table>";
                                
                 
                      $content .= "</body>
                                 </html>";
            	
           
            	
        	    $this->load->library('pdf');
            	$this->pdf->loadHtml($content);
            	$this->pdf->render();
            	$filename = "Voucher(".$vocher_no.")";
            	$this->pdf->stream($filename.".pdf", array("Attachment" => false));
         }
     }
     
     
//     public function agent_business_report()
// 	{
// 	    if( !( $this->session->has_userdata('logged_in') ) ){
//             redirect('login', 'refresh');
//         }
        
//         // if(!$this->auth->can_access('Agent Business Report')){
//         //     redirect('access_denied', 'refresh');
//         // }
        
// 	    if($this->session->has_userdata('logged_in')) 
//         {
        
//             $pro_data["project_info"] = $this->mm->fetch_project_info();
//             $data["ins_company"] = $this->rm->get_insurance_company_list();
//             $data["class"] = $this->rm->get_class_list();
//             $data["cover"] = $this->rm->get_policy_cover_type();
//             $data["agents"] = $this->rm->fetch_agents_list();
//             $data["area_incharge"] = $this->rm->fetch_area_incharge_list();
//             $userid = "";
//             if($this->session->userdata('session_role') == "user")
            
//             $userid = $this->session->userdata('session_id');
//             $data["userid"] = $this->session->userdata('session_id');
             
//             $data["users"] = $this->rm->fetch_users_list( $userid );
            
//     		$this->load->view('header',$pro_data);
//     		$this->load->view('agent_business_report',$data);
//     		$this->load->view('footer',$pro_data);
//         }
// 	}
	
	
//     public function fetch_agent_business_report()
// 	{
// 	    if($this->session->has_userdata('logged_in')) 
//         {
//             $fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
//             $ins_company = $this->input->post("ins_company");
//             $select_class = $this->input->post("select_class");
//             $agents = $this->input->post("agent");
//             $from_date = $this->input->post("from_date");
//             $to_date = $this->input->post("to_date");
//             $policy_type = $this->input->post("policy_type");
//             $area_incharge = $this->input->post("area_incharge");
//             $user = $this->input->post("user");
            
//             //var_dump($this->input->post());
//             $res = $this->rm->_fetch_business_complete_report($ins_company,$select_class,$policy_type,$agents,$from_date,$to_date,$area_incharge,$user);
            
//             //var_dump(count($res));
            
//             $data = $this->rm->_fetch_generate_policy_report($ins_company,$select_class,$policy_type,$agents,$from_date,$to_date,$area_incharge,$user);
  
//             //var_dump(count($data));
             
//             $content = "<div class='table-with-scrollbar'>
//                         <table class='table table-hover table-bordered'  style='white-space: nowrap;'>
//                             <thead>
//                                     <th>S.No</th>
//                                     <th>Customer</th>
//                                     <th>Lead Id</th>
//                                     <th>Mobile No</th>
//                                     <th>Agent id</th>
//                                     <th>Policy Issue Date</th>
//                                     <th>Policy Start Date</th>
//                                     <th>Area Incharge</th>
//                                     <th>User</th>
//                                     <th>Policy No</th>
//                                     <th>Insurer</th>
//                                     <th>vehicle cc/gvw/Age</th>
//                                     <th>vehicle No</th>
//                                     <th>Bussiness Type</th>
//                                     <th>Class</th>
//                                     <th>Pol Type</th>
//                                     <th>OD</th>
//                                     <th>TP</th>
//                                     <th>Net Premium</th>
//                                     <th>GST</th>";
//                                 if($this->session->userdata('session_role') != "user" && $this->session->userdata('session_role') != "AI") {
                                    
//                     $content .= "<th>Agent Category</th>
//                                  <th>Commission Type</th>
//                                  <th>Company Percent</th>
//                                  <th>Agent Percent</th>";
                                 
//                     $content .= "   <th>Jayantha Own Commission</th>
//                                     <th>Unicorn Own Commission</th>
//                                     <th>Own Commission</th>
//                                     <th>Jayantha Agent Commission</th>
//                                     <th>Unicorn Agent Commission</th>
//                                     <th>Agent Commission</th>
//                                     <th>Own Com Additional</th>
//                                     <th>Agent Com Additional</th>";
//                                      }
//                      $content .= "   <th>Policy Status</th><th>Agent Status</th><th>Company Status</th>
//                                 </thead>
//                                 <tbody>";
                                
//             $a = 0;
//             $gst_1 = 0;
//             $gst_2  = 0;
            
//             $agn_com = 0;
//             $own_com = 0;
            
//             $od_1 = 0;
//             $od_2 = 0;
            
//             $tp_1 = 0;
//             $tp_2 = 0;
            
//             $net_1 = 0;
//             $net_2 = 0;
            
//             $add_own_com = 0;
//             $add_agn_com = 0;
            
//             $add_jay_own_com = 0;
//             $add_jay_agn_com = 0;
//              $add_uni_own_com = 0;
//             $add_uni_agn_com = 0;
            
//             $today = date("Y-m-d");
//             foreach($res as $da)
//             {
//                 $a++;
                
//                 $gst_1 = $gst_1 + $da->gst;
                
//                 $od_1 = $od_1 + $da->total_own_damage;
//                 $tp_1 = $tp_1 + $da->tot_liability_premium;
//                 $net_1 = $net_1 + $da->total_premium;
                
//               $agn_com = $agn_com + $da->agent_commission_amt+ $da->agent_commission;
//                 $own_com = $own_com + $da->own_commission_amt + $da->own_commission;
                
//                 $add_own_com = $add_own_com + $da->com_add_com;
//                 $add_agn_com = $add_agn_com + $da->agn_add_com;
                
//                 $add_jay_own_com = $add_jay_own_com + $da->own_commission_amt;
//                 $add_jay_agn_com = $add_jay_agn_com + $da->agent_commission_amt;
                
//                 $add_uni_own_com = $add_uni_own_com + $da->own_commission;
//                 $add_uni_agn_com = $add_uni_agn_com + $da->agent_commission;
                
//                 $age = $regndate = "";
//                 $regndate =$da->regn_date;
//                 $psdate = $da->policy_s_date;
//                 $diff = date_diff(date_create($regndate), date_create($psdate));
//                 $age = $diff->format('%y');
                
//                 $user = $this->rm->get_user_name($da->assigned_user);
                
//                 $username = "";
                
//                 if($user != "")
//                 {
//                     $username = $user->name;
//                 }
                
//                 $agent_commission_percent = $da->agent_commission_percent;
//                 if(isset($da->agent_special_commission) && $da->agent_special_commission > 0) {
//                     $agent_commission_percent = $da->agent_special_commission;
//                 }
                
//                 $content .="<tr>";
//                             $content .="<td>".$a."</td>";
//                             $content .="<td>".$da->client_name."</td>";
//                             $content .="<td>".$da->lead_id."</td>";
//                             $content .="<td>".$da->mobile_no."</td>";
//                             $content .="<td>".$da->agn_name."(".$da->agent_pos_code.")</td>";
//                             $content .="<td>".date_format(date_create($da->policy_issue_date),"d-m-Y")."</td>";
//                             $content .="<td>".date_format(date_create($da->policy_s_date),"d-m-Y")."</td>";
//                             $content .="<td>".$da->ai_name."</td>";
//                             $content .="<td>".$username."</td>";
//                             $content .="<td>".$da->policy_no."</td>";
//                             $content .="<td>".$da->company_name."</td>";
//                             $content .="<td>".$da->vechi_cc." / ".$da->vechi_gvw." / ".$da->age."</td>";
//                             $content .="<td>".$da->vechi_register_no."</td>";
//                             $content .="<td>".$da->business_name."</td>";
//                             $content .="<td>".$da->class_name."</td>";
//                             $content .="<td>".$da->policy_type."</td>";
//                             $content .="<td><span class='pull-right'>".number_format($da->total_own_damage,2)."</td>";
//                             $content .="<td><span class='pull-right'>".number_format($da->tot_liability_premium,2)."</span></td>";
//                             $content .="<td><span class='pull-right'>".number_format($da->total_premium,2)."</span></td>";
//                             $content .="<td><span class='pull-right'>".number_format($da->gst,2)."</span></td>";
//                              if($this->session->userdata('session_role') != "user" && $this->session->userdata('session_role') != "AI") {
                            
//                             $content .="<td style='text-align:center' title='".(($da->commissionid) ? ($da->commissionid) : 'Commission Assign Missing')."'>".($da->commission_category)."</td>";
//                             $content .="<td style='text-align:center'>".($da->agn_com_type)."</td>";
//                             $content .="<td><span class='pull-right'>".(($da->company_percent) ? $da->company_percent."%" : "")."</span></td>";
                            
//                             //$content .="<td><span class='pull-right'>".(($da->agent_commission_percent) ? $da->agent_commission_percent."%" : "")."</span></td>";
//                             $content .="<td><span class='pull-right'>".(($agent_commission_percent) ? $agent_commission_percent."%" : "")."</span></td>";
                            
                                 
//                             $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->own_commission_amt, "INR")."</span></td>";
//                             $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->own_commission, "INR")."</span></td>";
//                             $content .="<td><span class='pull-right'>".number_format($da->own_commission_amt + $da->own_commission,2)."</span></td>";
//                             $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->agent_commission_amt, "INR")."</span></td>";
//                             $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->agent_commission, "INR")."</span></td>";
//                             $content .="<td><span class='pull-right'>".number_format($da->agent_commission_amt + $da->agent_commission,2)."</span></td>";
//                             $content .="<td><span class='pull-right'>".number_format($da->com_add_com,2)."</span></td>";
//                             $content .="<td><span class='pull-right'>".number_format($da->agn_add_com,2)."</span></td>";
//                              }
                             
//                             $status = 'Active policy';
//                             $agent_status = 'Active policy';
//                             $company_status = 'Active policy';
                             
//                             if( isset( $da->commission_status ) && $da->commission_status == '1' ){
//                                 $agent_status = 'Commission Fixed';
//                             }
                            
//                             if( isset( $da->cancel_policy_status ) && $da->cancel_policy_status == '1' ){
//                                 $agent_status = 'Hold Policy For Agent Invoice';
//                             }elseif( isset( $da->cancel_policy_status ) && $da->cancel_policy_status == '2' ){
//                                 $agent_status = 'Cancel Policy For Agent Invoice';
//                             }
                            
//                             if( isset( $da->vocher_status ) && $da->vocher_status == '1' ){
//                                 $agent_status = 'Generated Agent Invoice';
                                
//                                 if( isset( $da->voucher_no ) && !empty( $da->voucher_no ) ) {
//                                     $agent_status = 'Agent NFT Paid';
//                                 }
//                             }
                            
//                             if( isset( $da->cancel_policy_status ) && $da->cancel_policy_status == '3' ){
//                                 $company_status = 'Hold Policy For Company Invoice';
//                             }elseif( isset( $da->cancel_policy_status ) && $da->cancel_policy_status == '4' ){
//                                 $company_status = 'Cancel Policy For Company Invoice';
//                             } else {
//                                 if( $da->cancel_policy_status == '0' && isset( $da->invoice_prepared ) && $da->invoice_prepared == 'N' ) {
//                                     $company_status = 'Policy Not Select for Bill.';
//                                 } elseif( $da->cancel_policy_status == '0' && isset( $da->invoice_prepared ) && $da->invoice_prepared == 'Y' ) {
//                                     $company_status = 'Policy Selected for Bill.';
                                    
//                                     if( isset( $da->invoice_status ) && $da->invoice_status == 'D') {
//                                         $company_status = 'Invoice Revisied.';
//                                     } else {
//                                         if( isset( $da->company_vocher_status ) && $da->company_vocher_status == '1' ){
//                                             $company_status = 'Generated Company Invoice';   
                                            
//                                             if( isset( $da->receipt_id ) && !empty( $da->receipt_id ) ) {
//                                                 $company_status = 'Company Payment Received';
//                                             }
//                                         }
//                                     }
//                                 }
//                             }
                            
//                             /*if( isset( $da->vocher_status ) && $da->vocher_status == '1' ){
//                                 $agent_status = 'Generated Agent Invoice';
//                             }
                            
//                             if( isset( $da->company_vocher_status ) && $da->company_vocher_status == '1' ){
//                                 $company_status = 'Generated Company Invoice';
//                             }*/
                                
//                             $content .="<td><span class='pull-right'>{$status}</span></td>";
//                             $content .="<td><span class='pull-right'>{$agent_status}</span></td>";
//                             $content .="<td><span class='pull-right'>{$company_status}</span></td>";
//                             $content .="</tr>";
//             }
           
//             foreach($data as $da)
//             {
//                 $a++;
                
//                 $gst_2 = $gst_2 + $da->gst;
//                 $od_2 = $od_2 + $da->total_own_damage;
//                 $tp_2 = $tp_2 + $da->tot_liability_premium;
//                 $net_2 = $net_2 + $da->total_premium;
                
//                  $agn_com = $agn_com + $da->agent_commission_amt + $da->agent_commission;
//                 $own_com = $own_com + $da->own_commission_amt + $da->own_commission;
                
//                 $add_jay_own_com = $add_jay_own_com + $da->own_commission_amt;
//                 $add_jay_agn_com = $add_jay_agn_com + $da->agent_commission_amt;
                
//                 $add_uni_own_com = $add_uni_own_com + $da->own_commission;
//                 $add_uni_agn_com = $add_uni_agn_com + $da->agent_commission;
                
//                 $add_own_com = $add_own_com + $da->com_add_com;
//                 $add_agn_com = $add_agn_com + $da->agn_add_com;
                
//                 $user = $this->rm->get_user_name($da->assigned_user);
                
//                 $username = "";
                
//                 if($user != "")
//                 {
//                     $username = $user->name;
//                 }
       
//                 $content .="<tr>";
//                             $content .="<td>".$a."</td>";
//                             $content .="<td>".$da->client_name."</td>";
//                             $content .="<td>".$da->lead_id."</td>";
//                             $content .="<td>".$da->mobile_no."</td>";
//                             $content .="<td>".$da->agn_name."(".$da->agent_pos_code.")</td>";
//                             $content .="<td>".date_format(date_create($da->policy_issue_date),"d-m-Y")."</td>";
//                             $content .="<td>".date_format(date_create($da->policy_s_date),"d-m-Y")."</td>";
//                             $content .="<td>".$da->ai_name."</td>";
//                             $content .="<td>".$username."</td>";
//                             $content .="<td>".$da->policy_no."</td>";
//                             $content .="<td>".$da->company_name."</td>";
//                             $content .="<td>".$da->vechi_cc." / ".$da->vechi_gvw." / ".$da->age."</td>";
//                           $content .="<td>".$da->vechi_register_no."</td>";
//                             $content .="<td>".$da->business_name."</td>";
//                             $content .="<td>".$da->class_name."</td>";
//                             $content .="<td>".$da->policy_type."</td>";
//                             $content .="<td><span class='pull-right'>".number_format($da->total_own_damage,2)."</td>";
//                             $content .="<td><span class='pull-right'>".number_format($da->tot_liability_premium,2)."</span></td>";
//                             $content .="<td><span class='pull-right'>".number_format($da->total_premium,2)."</span></td>";
//                             $content .="<td><span class='pull-right'>".number_format($da->gst,2)."</span></td>";
//                          if($this->session->userdata('session_role') != "user" && $this->session->userdata('session_role') != "AI") { 
                             
//                             $content .="<td style='text-align:center' title='".(($da->commissionid) ? ($da->commissionid) : 'Commission Assign Missing')."'>".($da->commission_category)."</td>";
//                             $content .="<td style='text-align:center'>".($da->agn_com_type)."</td>";
//                             $content .="<td><span class='pull-right'>".(($da->company_percent) ? $da->company_percent."%" : "")."</span></td>";
//                             $content .="<td><span class='pull-right'>".(($da->agent_commission_percent) ? $da->agent_commission_percent."%" : "")."</span></td>";
                             
//                              $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->own_commission_amt, "INR")."</span></td>";
//                                 $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->own_commission, "INR")."</span></td>";
								
//                             $content .="<td><span class='pull-right'>".number_format($da->own_commission_amt+$da->own_commission,2)."</span></td>";
//                             $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->agent_commission_amt, "INR")."</span></td>";
//                                 $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->agent_commission, "INR")."</span></td>";
								
//                             $content .="<td><span class='pull-right'>".number_format($da->agent_commission_amt+$da->agent_commission,2)."</span></td>";
//                             $content .="<td><span class='pull-right'>".number_format($da->com_add_com,2)."</span></td>";
//                          }
//                             $content .="<td><span class='pull-right'>".number_format($da->agn_add_com,2)."</span></td>";
//                             $content .="<td><span class='pull-right'>Business Complete</span></td>";
//                             $content .="<td><span class='pull-right'>-</span></td>";
//                             $content .="<td><span class='pull-right'>-</span></td>";
//                             $content .="</tr>";
//             }
            
//             $content .="<tr>
//                             <td></td>
//                             <td></td>
//                             <td></td>
//                             <td></td>
//                             <td></td>
//                             <td></td>
//                             <td></td>
//                             <td></td>
//                             <td></td>
//                             <td></td>
//                             <td></td>
//                             <td></td>
//                             <td></td>
//                             <td></td>
//                             <td></td>
//                             <td></td>
//                             <td><b>".$fmt->formatCurrency($od_1 + $od_2,"INR")."</td>
//                             <td><b>".$fmt->formatCurrency($tp_1 + $tp_2,"INR")."</td>
//                             <td style='text-align:right'><b>".$fmt->formatCurrency($net_1 + $net_2,"INR")."</td>
//                             <td style='text-align:right'><b>".$fmt->formatCurrency($gst_1 + $gst_2,"INR")."</b></td>";
                            
//                   if($this->session->userdata('session_role') != "user" && $this->session->userdata('session_role') != "AI") { 
                       
//                         $content .="<td></td>";
//                         $content .="<td></td>";
//                         $content .="<td></td>";
//                         $content .="<td></td>";
                             
//                     $content .="  <td style='text-align:right'><b>".$fmt->formatCurrency($add_jay_own_com,"INR")."</b></td>
//                                 <td style='text-align:right'><b>".$fmt->formatCurrency($add_uni_own_com,"INR")."</b></td>
								
//                     <td style='text-align:right'><b>".$fmt->formatCurrency($own_com,"INR")."</b></td>
//                     <td style='text-align:right'><b>".$fmt->formatCurrency($add_jay_agn_com,"INR")."</b></td>
//                                 <td style='text-align:right'><b>".$fmt->formatCurrency($add_uni_agn_com,"INR")."</b></td>
								
//                             <td style='text-align:right'><b>".$fmt->formatCurrency($agn_com,"INR")."</b></td>
//                             <td style='text-align:right'><b>".$fmt->formatCurrency($add_own_com,"INR")."</b></td>
//                             <td style='text-align:right'><b>".$fmt->formatCurrency($add_agn_com,"INR")."</b></td>";
//                             }
//                       $content .=" <td style='text-align:right'></td>
//                         </tr>";
//                  $content .="</tbody></table></div><br>";
//                  echo $content;
//         }
// 	}
	
//     public function agent_business_report_excel()
// 	{
	    
// 	    if($this->session->has_userdata('logged_in')) 
//         {
//             $ins_company = $this->input->post("ins_company");
//             $select_class = $this->input->post("select_class");
//             $agent = $this->input->post("agent");
//             $from_date = $this->input->post("from_date");
//             $to_date = $this->input->post("to_date");
//             $policy_type = $this->input->post("policy_type");
//             $area_incharge = $this->input->post("area_incharge");
//             $user = $this->input->post("user");
            
//             $this->load->library('Excel');
//             $objPHPExcel = new PHPExcel();
//             $objPHPExcel->setActiveSheetIndex(0);
            
//             $rowCount = 4;
            
//             $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(35);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(35);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(35);
//             $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
//             $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'JAYANTHA INSURANCE');
            
//             $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Active Policy Report');
            
//             $objPHPExcel->getActiveSheet()->getStyle('D3')->applyFromArray(
//             		array(
//             			'font'  => array(
//             				'bold'  => true,
//             				'color' => array('rgb' => 'e6e600'),
//             				'size'  => 18,
//             			),
//             		)
//             	);
//             	$objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray(
//             		array(
//             			'font'  => array(
//             				'bold'  => true,
//             				'color' => array('rgb' => '00cc66'),
//             				'size'  => 14,
//             			),
//             		)
//             	);
//         $objPHPExcel->getActiveSheet()->SetCellValue('F3', date_format(date_create($from_date),"d-m-Y"));
//         $objPHPExcel->getActiveSheet()->SetCellValue('G3', date_format(date_create($to_date),"d-m-Y"));
        
//         $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
//         $objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Excel Date : ');
//         $objPHPExcel->getActiveSheet()->SetCellValue('G3', date("d-m-Y"));

//         $objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);
//         $objPHPExcel->getActiveSheet()->getStyle('4')->applyFromArray(
//         array(
//         'fill' => array(
//             'type' => PHPExcel_Style_Fill::FILL_SOLID,
//             'color' => array('rgb' => '31406b')
//         ),
//         'alignment' => array(
//             'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
//         ),
//         'font'  => array(
//             'bold'  => true,
//             'color' => array('rgb' => 'FFFFFF'),
//             'size'  => 13,
//         ),
//         )
//         );
        
//         $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'S.No');
//         $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Customer');
//         $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Mobile No');
//         $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Agent Name');
//         $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Policy Issue Date');
//         $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Policy Start Date');
//         $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Area Incharge');
//         $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'User');
//         $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Lead Id');
//         $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Policy No');
//         $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'Insurer');
//         $objPHPExcel->getActiveSheet()->SetCellValue('L4', 'Bussiness Type');
//         $objPHPExcel->getActiveSheet()->SetCellValue('M4', 'Class');
//         $objPHPExcel->getActiveSheet()->SetCellValue('N4', 'Pol Type');
//         $objPHPExcel->getActiveSheet()->SetCellValue('O4', 'OD');
//         $objPHPExcel->getActiveSheet()->SetCellValue('P4', 'TP');
//         $objPHPExcel->getActiveSheet()->SetCellValue('Q4', 'Net Premium	');
//         $objPHPExcel->getActiveSheet()->SetCellValue('R4', 'GST');
        
//         $objPHPExcel->getActiveSheet()->SetCellValue('S4', 'Agent Category');
//         $objPHPExcel->getActiveSheet()->SetCellValue('T4', 'Commission Type');
//         $objPHPExcel->getActiveSheet()->SetCellValue('U4', 'Company Percent');
//         $objPHPExcel->getActiveSheet()->SetCellValue('V4', 'Agent Percent');
        
//         $objPHPExcel->getActiveSheet()->SetCellValue('W4', 'Jayantha Own Commission');
//         $objPHPExcel->getActiveSheet()->SetCellValue('X4', 'Unicorn Own Commission');
//         $objPHPExcel->getActiveSheet()->SetCellValue('Y4', 'Total Own Commission');
//         $objPHPExcel->getActiveSheet()->SetCellValue('Z4', 'Jayantha Agent Commission');
//         $objPHPExcel->getActiveSheet()->SetCellValue('AA4', 'Unicorn Agent Commission');
//         $objPHPExcel->getActiveSheet()->SetCellValue('AB4', 'Total Agent Commission');
//         $objPHPExcel->getActiveSheet()->SetCellValue('AC4', 'Own Add Commission');
//         $objPHPExcel->getActiveSheet()->SetCellValue('AD4', 'Add Agent Commission');
//         $objPHPExcel->getActiveSheet()->SetCellValue('AE4', 'Vechicle No');
//         $objPHPExcel->getActiveSheet()->SetCellValue('AF4', 'Status');
        
//         $row_count = 5;
//         $a = 0;
            
        
//         $res = $this->rm->_fetch_business_complete_report($ins_company,$select_class,$policy_type,$agent,$from_date,$to_date,$area_incharge,$user);
        
//         $data = $this->rm->_fetch_generate_policy_report($ins_company,$select_class,$policy_type,$agent,$from_date,$to_date,$area_incharge,$user);
//         //echo '<pre>';print_r($res);print_r($data);print'</pre>';   
                                
//             $a = 0;
            
//             $gst = 0;
//             $agn_com = 0;
//             $own_com = 0;
            
//             $add_own_com = 0;
//             $add_agn_com = 0;
            
//              $add_jay_own_com = 0;
//             $add_jay_agn_com = 0;
//              $add_uni_own_com = 0;
//             $add_uni_agn_com = 0;
            
//             foreach($res as $da)
//             {
//                 $a++;
                
//                 $gst = $gst+$da->gst;
//               $agn_com = $agn_com + $da->agent_commission_amt + $da->agent_commission;
//                 $own_com = $own_com + $da->own_commission_amt + $da->own_commission;
                
//                 $add_own_com = $add_own_com + $da->com_add_com;
//                 $add_agn_com = $add_agn_com + $da->agn_add_com;
                
//                 $add_jay_own_com = $add_jay_own_com + $da->own_commission_amt;
//                 $add_jay_agn_com = $add_jay_agn_com + $da->agent_commission_amt;
                
//                 $add_uni_own_com = $add_uni_own_com + $da->own_commission;
//                 $add_uni_agn_com = $add_uni_agn_com + $da->agent_commission;
                
//                 $user = $this->rm->get_user_name($da->assigned_user);
//                 $username = "";
                
//                 if($user != "")
//                 {
//                     $username = $user->name;
//                 }
               
               
//                 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->client_name);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->mobile_no);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->agn_name."(".$da->agent_pos_code.")");
//                 $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , date_format(date_create($da->policy_issue_date),"d-m-Y"));
//                 $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , date_format(date_create($da->policy_s_date),"d-m-Y"));
//                 $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->ai_name);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $username);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , $da->lead_id);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row_count , " ".$da->policy_no);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row_count , $da->company_name);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row_count , $da->business_name);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row_count , $da->class_name);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row_count , $da->policy_type);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row_count , $da->total_own_damage);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row_count , $da->tot_liability_premium);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row_count , $da->total_premium);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('R'.$row_count , $da->gst);
                
//                 $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row_count , $da->agn_com_type);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('T'.$row_count , $da->commission_category);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('U'.$row_count , $da->company_percent);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('V'.$row_count , $da->agent_commission_percent);
                
                
                
//                  $objPHPExcel->getActiveSheet()->SetCellValue('W'.$row_count , $da->own_commission_amt);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('X'.$row_count , $da->own_commission);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('Y'.$row_count , $da->own_commission_amt+$da->own_commission);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('Z'.$row_count , $da->agent_commission_amt);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('AA'.$row_count , $da->agent_commission);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('AB'.$row_count , $da->agent_commission_amt+$da->agent_commission);
                
//                 $objPHPExcel->getActiveSheet()->SetCellValue('AC'.$row_count , $da->com_add_com);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('AD'.$row_count , $da->agn_add_com);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('AE'.$row_count , $da->vechi_register_no);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('AF'.$row_count , "Active Policy");
                
                
//                 $objPHPExcel->getActiveSheet()->getStyle('M'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('N'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('O'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('P'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                
//                 $objPHPExcel->getActiveSheet()->getStyle('U'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('V'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('W'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('X'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                
//                 $objPHPExcel->getActiveSheet()->getStyle('Y'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('Z'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('AA'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('AB'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');

                
//                 $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
//                 $row_count++;
//             }
          
          
//             foreach($data as $da)
//             {
//                 $a++;
                
//                 $gst = $gst+$da->gst;
//               $agn_com = $agn_com + $da->agent_commission_amt;
//                 $own_com = $own_com + $da->own_commission_amt;
                
//                 $add_own_com = $add_own_com + $da->com_add_com;
//                 $add_agn_com = $add_agn_com + $da->agn_add_com;
                
//                 $add_jay_own_com = $add_jay_own_com + $da->own_commission_amt;
//                 $add_jay_agn_com = $add_jay_agn_com + $da->agent_commission_amt;
                
//                 $add_uni_own_com = $add_uni_own_com + $da->own_commission;
//                 $add_uni_agn_com = $add_uni_agn_com + $da->agent_commission;
               
//               $user = $this->rm->get_user_name($da->assigned_user);
//                 if($user != "")
//                 {
//                     $username = $user->name;
//                 }
               
               
//                 $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->client_name);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->mobile_no);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->agn_name."(".$da->agent_pos_code.")");
//                 $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , date_format(date_create($da->policy_issue_date),"d-m-Y"));
//                 $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , date_format(date_create($da->policy_s_date),"d-m-Y"));
//                 $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->ai_name);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count ,$username);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , $da->lead_id);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row_count , $da->policy_no);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row_count , $da->company_name);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row_count , $da->business_name);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row_count , $da->class_name);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row_count , $da->policy_type);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row_count , $da->total_own_damage);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row_count , $da->tot_liability_premium);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row_count , $da->total_premium);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('R'.$row_count , $da->gst);
                
//                 $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row_count , $da->agn_com_type);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('T'.$row_count , $da->commission_category);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('U'.$row_count , $da->company_percent);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('V'.$row_count , $da->agent_commission_percent);
                
//                 $objPHPExcel->getActiveSheet()->SetCellValue('W'.$row_count , $da->own_commission_amt);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('X'.$row_count , $da->own_commission);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('Y'.$row_count , $da->own_commission_amt+$da->own_commission);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('Z'.$row_count , $da->agent_commission_amt);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('AA'.$row_count , $da->agent_commission);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('AB'.$row_count , $da->agent_commission_amt+$da->agent_commission);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('AC'.$row_count , $da->com_add_com);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('AD'.$row_count , $da->agn_add_com);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('AE'.$row_count , $da->vechi_register_no);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('AF'.$row_count , "Business Completed");
                
                
//                 $objPHPExcel->getActiveSheet()->getStyle('M'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('N'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('O'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('P'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                
//                 $objPHPExcel->getActiveSheet()->getStyle('U'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('V'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('W'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('X'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                  $objPHPExcel->getActiveSheet()->getStyle('Y'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('Z'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('AA'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
//                 $objPHPExcel->getActiveSheet()->getStyle('AB'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');

                
//                 $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
//                 $row_count++;
//               }
          
//                 $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//                 $objWriter->save('./datas/reports/agent_business_report.xlsx');
                
//                 echo base_url()."/datas/reports/agent_business_report.xlsx";
                
//         }
// 	}



 public function agent_business_report()
	{
	    if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        // if(!$this->auth->can_access('Agent Business Report')){
        //     redirect('access_denied', 'refresh');
        // }
        
	    if($this->session->has_userdata('logged_in')) 
        {
        
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $data["ins_company"] = $this->rm->get_insurance_company_list();
            $data["class"] = $this->rm->get_class_list();
            $data["cover"] = $this->rm->get_policy_cover_type();
            $data["agents"] = $this->rm->fetch_agents_list();
            $data["area_incharge"] = $this->rm->fetch_area_incharge_list();
            $userid = "";
            if($this->session->userdata('session_role') == "user")
             //$data["userid"] =   $userid = $this->session->userdata('session_id');
             $userid = $this->session->userdata('session_id');
            $data["userid"] = $this->session->userdata('session_id'); 
                
            $data["users"] = $this->rm->fetch_users_list( $userid );
            
    		$this->load->view('header',$pro_data);
    		$this->load->view('agent_business_report',$data);
    		$this->load->view('footer',$pro_data);
        }
	}
	
    public function fetch_agent_business_report()
	{
	    if($this->session->has_userdata('logged_in')) 
        {
            $fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
            $ins_company = $this->input->post("ins_company");
            $select_class = $this->input->post("select_class");
            $agents = $this->input->post("agent");
            $from_date = $this->input->post("from_date");
            $to_date = $this->input->post("to_date");
            $policy_type = $this->input->post("policy_type");
            $area_incharge = $this->input->post("area_incharge");
            $user = $this->input->post("user");
            
            //var_dump($this->input->post());
            $res = $this->rm->_fetch_business_complete_report($ins_company,$select_class,$policy_type,$agents,$from_date,$to_date,$area_incharge,$user);
            
            //var_dump(count($res));
            
            $data = $this->rm->_fetch_generate_policy_report($ins_company,$select_class,$policy_type,$agents,$from_date,$to_date,$area_incharge,$user);
  
            //var_dump(count($data));
             
            $content = "<div class='table-with-scrollbar'>
                        <table class='table table-hover table-bordered'  style='white-space: nowrap;'>
                            <thead>
                                    <th>S.No</th>
                                    <th>Customer</th>
                                    <th>Lead Id</th>
                                    <th>Mobile No</th>
                                    <th>Agent id</th>
                                    <th>Policy Issue Date</th>
                                    <th>Policy Start Date</th>
                                    <th>Area Incharge</th>
                                    <th>User</th>
                                    <th>Policy No</th>
                                    <th>Insurer</th>
                                    <th>vehicle cc/gvw/Age</th>
                                    <th>vehicle No</th>
                                    <th>Bussiness Type</th>
                                    <th>Class</th>
                                    <th>Pol Type</th>
                                    <th>OD</th>
                                    <th>TP</th>
                                    <th>Net Premium</th>
                                    <th>GST</th>";
                                if($this->session->userdata('session_role') != "user" && $this->session->userdata('session_role') != "AI") {
                                    
                    $content .= "<th>Agent Category</th>
                                 <th>Commission Type</th>
                                 <th>Company Percent</th>
                                 <th>Agent Percent</th>";
                                 
                    $content .= "   <th>Jayantha Own Commission</th>
                                    <th>Unicorn Own Commission</th>
                                    <th>Own Commission</th>
                                    <th>Jayantha Agent Commission</th>
                                    <th>Unicorn Agent Commission</th>
                                    <th>Agent Commission</th>
                                    <th>Own Com Additional</th>
                                    <th>Agent Com Additional</th>";
                                     }
                     $content .= "   <th>Policy Status</th><th>Agent Status</th><th>Company Status</th>
                                </thead>
                                <tbody>";
                                
            $a = 0;
            $gst_1 = 0;
            $gst_2  = 0;
            
            $agn_com = 0;
            $own_com = 0;
            
            $od_1 = 0;
            $od_2 = 0;
            
            $tp_1 = 0;
            $tp_2 = 0;
            
            $net_1 = 0;
            $net_2 = 0;
            
            $add_own_com = 0;
            $add_agn_com = 0;
            
            $add_jay_own_com = 0;
            $add_jay_agn_com = 0;
             $add_uni_own_com = 0;
            $add_uni_agn_com = 0;
            
            $today = date("Y-m-d");
            foreach($res as $da)
            {
                $a++;
                
                $gst_1 = $gst_1 + $da->gst;
                
                $od_1 = $od_1 + $da->total_own_damage;
                $tp_1 = $tp_1 + $da->tot_liability_premium;
                $net_1 = $net_1 + $da->total_premium;
                
               $agn_com = $agn_com + $da->agent_commission_amt+ $da->agent_commission;
                $own_com = $own_com + $da->own_commission_amt + $da->own_commission;
                
                $add_own_com = $add_own_com + $da->com_add_com;
                $add_agn_com = $add_agn_com + $da->agn_add_com;
                
                $add_jay_own_com = $add_jay_own_com + $da->own_commission_amt;
                $add_jay_agn_com = $add_jay_agn_com + $da->agent_commission_amt;
                
                $add_uni_own_com = $add_uni_own_com + $da->own_commission;
                $add_uni_agn_com = $add_uni_agn_com + $da->agent_commission;
                
                $age = $regndate = "";
                $regndate =$da->regn_date;
                $psdate = $da->policy_s_date;
                $diff = date_diff(
					date_create($regndate ?: date('Y-m-d')),
					date_create($psdate ?: date('Y-m-d'))
				);
                $age = $diff->format('%y');
                
                $user = $this->rm->get_user_name($da->assigned_user);
                
                $username = "";
                
                if($user != "")
                {
                    $username = $user->name;
                }
                
                $agent_commission_percent = $da->agent_commission_percent;
                if(isset($da->agent_special_commission) && $da->agent_special_commission > 0) {
                    $agent_commission_percent = $da->agent_special_commission;
                }
                
                $content .="<tr>";
                            $content .="<td>".$a."</td>";
                            $content .="<td>".$da->client_name."</td>";
                            $content .="<td>".$da->lead_id."</td>";
                            $content .="<td>".$da->mobile_no."</td>";
                            $content .="<td>".$da->agn_name."(".$da->agent_pos_code.")</td>";
                            $content .="<td>".date_format(date_create($da->policy_issue_date ?: date('Y-m-d')), "d-m-Y")."</td>";
                            $content .="<td>".date_format(date_create($da->policy_s_date ?: date('Y-m-d')), "d-m-Y")."</td>";
                            $content .="<td>".$da->ai_name."</td>";
                            $content .="<td>".$username."</td>";
                            $content .="<td>".$da->policy_no."</td>";
                            $content .="<td>".$da->company_name."</td>";
                            $content .="<td>".$da->vechi_cc." / ".$da->vechi_gvw." / ".$da->age."</td>";
                            $content .="<td>".$da->vechi_register_no."</td>";
                            $content .="<td>".$da->business_name."</td>";
                            $content .="<td>".$da->class_name."</td>";
                            $content .="<td>".$da->policy_type."</td>";
                            $content .="<td><span class='pull-right'>".number_format($da->total_own_damage,2)."</td>";
                            $content .="<td><span class='pull-right'>".number_format($da->tot_liability_premium,2)."</span></td>";
                            $content .="<td><span class='pull-right'>".number_format($da->total_premium,2)."</span></td>";
                            $content .="<td><span class='pull-right'>".number_format($da->gst,2)."</span></td>";
                             if($this->session->userdata('session_role') != "user" && $this->session->userdata('session_role') != "AI") {
                            
                            $content .="<td style='text-align:center' title='".(($da->commissionid) ? ($da->commissionid) : 'Commission Assign Missing')."'>".($da->commission_category)."</td>";
                            $content .="<td style='text-align:center'>".($da->agn_com_type)."</td>";
                            $content .="<td><span class='pull-right'>".(($da->company_percent) ? $da->company_percent."%" : "")."</span></td>";
                            
                            //$content .="<td><span class='pull-right'>".(($da->agent_commission_percent) ? $da->agent_commission_percent."%" : "")."</span></td>";
                            $content .="<td><span class='pull-right'>".(($agent_commission_percent) ? $agent_commission_percent."%" : "")."</span></td>";
                            
                                 
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->own_commission_amt, "INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->own_commission, "INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".number_format($da->own_commission_amt + $da->own_commission,2)."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->agent_commission_amt, "INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->agent_commission, "INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".number_format($da->agent_commission_amt + $da->agent_commission,2)."</span></td>";
                            $content .="<td><span class='pull-right'>".number_format($da->com_add_com,2)."</span></td>";
                            $content .="<td><span class='pull-right'>".number_format($da->agn_add_com,2)."</span></td>";
                             }
                             
                            $status = 'Active policy';
                            $agent_status = 'Active policy';
                            $company_status = 'Active policy';
                             
                            if( isset( $da->commission_status ) && $da->commission_status == '1' ){
                                $agent_status = 'Commission Fixed';
                            }
                            
                            if( isset( $da->cancel_policy_status ) && $da->cancel_policy_status == '1' ){
                                $agent_status = 'Hold Policy For Agent Invoice';
                            }elseif( isset( $da->cancel_policy_status ) && $da->cancel_policy_status == '2' ){
                                $agent_status = 'Cancel Policy For Agent Invoice';
                            }
                            
                            if( isset( $da->vocher_status ) && $da->vocher_status == '1' ){
                                $agent_status = 'Generated Agent Invoice';
                                
                                if( isset( $da->voucher_no ) && !empty( $da->voucher_no ) ) {
                                    $agent_status = 'Agent NFT Paid';
                                }
                            }
                            
                            if( isset( $da->cancel_policy_status ) && $da->cancel_policy_status == '3' ){
                                $company_status = 'Hold Policy For Company Invoice';
                            }elseif( isset( $da->cancel_policy_status ) && $da->cancel_policy_status == '4' ){
                                $company_status = 'Cancel Policy For Company Invoice';
                            } else {
                                if( $da->cancel_policy_status == '0' && isset( $da->invoice_prepared ) && $da->invoice_prepared == 'N' ) {
                                    $company_status = 'Policy Not Select for Bill.';
                                } elseif( $da->cancel_policy_status == '0' && isset( $da->invoice_prepared ) && $da->invoice_prepared == 'Y' ) {
                                    $company_status = 'Policy Selected for Bill.';
                                    
                                    if( isset( $da->invoice_status ) && $da->invoice_status == 'D') {
                                        $company_status = 'Invoice Revisied.';
                                    } else {
                                        if( isset( $da->company_vocher_status ) && $da->company_vocher_status == '1' ){
                                            $company_status = 'Generated Company Invoice';   
                                            
                                            if( isset( $da->receipt_id ) && !empty( $da->receipt_id ) ) {
                                                $company_status = 'Company Payment Received';
                                            }
                                        }
                                    }
                                }
                            }
                            
                            /*if( isset( $da->vocher_status ) && $da->vocher_status == '1' ){
                                $agent_status = 'Generated Agent Invoice';
                            }
                            
                            if( isset( $da->company_vocher_status ) && $da->company_vocher_status == '1' ){
                                $company_status = 'Generated Company Invoice';
                            }*/
                                
                            $content .="<td><span class='pull-right'>{$status}</span></td>";
                            $content .="<td><span class='pull-right'>{$agent_status}</span></td>";
                            $content .="<td><span class='pull-right'>{$company_status}</span></td>";
                            $content .="</tr>";
            }
           
            foreach($data as $da)
            {
                $a++;
                
                $gst_2 = $gst_2 + $da->gst;
                $od_2 = $od_2 + $da->total_own_damage;
                $tp_2 = $tp_2 + $da->tot_liability_premium;
                $net_2 = $net_2 + $da->total_premium;
                
                 $agn_com = $agn_com + $da->agent_commission_amt + $da->agent_commission;
                $own_com = $own_com + $da->own_commission_amt + $da->own_commission;
                
                $add_jay_own_com = $add_jay_own_com + $da->own_commission_amt;
                $add_jay_agn_com = $add_jay_agn_com + $da->agent_commission_amt;
                
                $add_uni_own_com = $add_uni_own_com + $da->own_commission;
                $add_uni_agn_com = $add_uni_agn_com + $da->agent_commission;
                
                $add_own_com = $add_own_com + $da->com_add_com;
                $add_agn_com = $add_agn_com + $da->agn_add_com;
                
                $user = $this->rm->get_user_name($da->assigned_user);
                
                $username = "";
                
                if($user != "")
                {
                    $username = $user->name;
                }
       
                $content .="<tr>";
                            $content .="<td>".$a."</td>";
                            $content .="<td>".$da->client_name."</td>";
                            $content .="<td>".$da->lead_id."</td>";
                            $content .="<td>".$da->mobile_no."</td>";
                            $content .="<td>".$da->agn_name."(".$da->agent_pos_code.")</td>";
                            $content .="<td>".date_format(date_create($da->policy_issue_date),"d-m-Y")."</td>";
                            $content .="<td>".date_format(date_create($da->policy_s_date),"d-m-Y")."</td>";
                            $content .="<td>".$da->ai_name."</td>";
                            $content .="<td>".$username."</td>";
                            $content .="<td>".$da->policy_no."</td>";
                            $content .="<td>".$da->company_name."</td>";
                            $content .="<td>".$da->vechi_cc." / ".$da->vechi_gvw." / ".$da->age."</td>";
                           $content .="<td>".$da->vechi_register_no."</td>";
                            $content .="<td>".$da->business_name."</td>";
                            $content .="<td>".$da->class_name."</td>";
                            $content .="<td>".$da->policy_type."</td>";
                            $content .="<td><span class='pull-right'>".number_format($da->total_own_damage,2)."</td>";
                            $content .="<td><span class='pull-right'>".number_format($da->tot_liability_premium,2)."</span></td>";
                            $content .="<td><span class='pull-right'>".number_format($da->total_premium,2)."</span></td>";
                            $content .="<td><span class='pull-right'>".number_format($da->gst,2)."</span></td>";
                         if($this->session->userdata('session_role') != "user" && $this->session->userdata('session_role') != "AI") { 
                             
                            $content .="<td style='text-align:center' title='".(($da->commissionid) ? ($da->commissionid) : 'Commission Assign Missing')."'>".($da->commission_category)."</td>";
                            $content .="<td style='text-align:center'>".($da->agn_com_type)."</td>";
                            $content .="<td><span class='pull-right'>".(($da->company_percent) ? $da->company_percent."%" : "")."</span></td>";
                            $content .="<td><span class='pull-right'>".(($da->agent_commission_percent) ? $da->agent_commission_percent."%" : "")."</span></td>";
                             
                             $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->own_commission_amt, "INR")."</span></td>";
                                $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->own_commission, "INR")."</span></td>";
								
                            $content .="<td><span class='pull-right'>".number_format($da->own_commission_amt+$da->own_commission,2)."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->agent_commission_amt, "INR")."</span></td>";
                                $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->agent_commission, "INR")."</span></td>";
								
                            $content .="<td><span class='pull-right'>".number_format($da->agent_commission_amt+$da->agent_commission,2)."</span></td>";
                            $content .="<td><span class='pull-right'>".number_format($da->com_add_com,2)."</span></td>";
                         }
                            $content .="<td><span class='pull-right'>".number_format($da->agn_add_com,2)."</span></td>";
                            $content .="<td><span class='pull-right'>Business Complete</span></td>";
                            $content .="<td><span class='pull-right'>-</span></td>";
                            $content .="<td><span class='pull-right'>-</span></td>";
                            $content .="</tr>";
            }
            
            $content .="<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td><b>".$fmt->formatCurrency($od_1 + $od_2,"INR")."</td>
                            <td><b>".$fmt->formatCurrency($tp_1 + $tp_2,"INR")."</td>
                            <td style='text-align:right'><b>".$fmt->formatCurrency($net_1 + $net_2,"INR")."</td>
                            <td style='text-align:right'><b>".$fmt->formatCurrency($gst_1 + $gst_2,"INR")."</b></td>";
                            
                   if($this->session->userdata('session_role') != "user" && $this->session->userdata('session_role') != "AI") { 
                       
                        $content .="<td></td>";
                        $content .="<td></td>";
                        $content .="<td></td>";
                        $content .="<td></td>";
                             
                    $content .="  <td style='text-align:right'><b>".$fmt->formatCurrency($add_jay_own_com,"INR")."</b></td>
                                <td style='text-align:right'><b>".$fmt->formatCurrency($add_uni_own_com,"INR")."</b></td>
								
                    <td style='text-align:right'><b>".$fmt->formatCurrency($own_com,"INR")."</b></td>
                    <td style='text-align:right'><b>".$fmt->formatCurrency($add_jay_agn_com,"INR")."</b></td>
                                <td style='text-align:right'><b>".$fmt->formatCurrency($add_uni_agn_com,"INR")."</b></td>
								
                            <td style='text-align:right'><b>".$fmt->formatCurrency($agn_com,"INR")."</b></td>
                            <td style='text-align:right'><b>".$fmt->formatCurrency($add_own_com,"INR")."</b></td>
                            <td style='text-align:right'><b>".$fmt->formatCurrency($add_agn_com,"INR")."</b></td>";
                            }
                       $content .=" <td style='text-align:right'></td>
                        </tr>";
                 $content .="</tbody></table></div><br>";
                 echo $content;
        }
	}
	
    public function agent_business_report_excel()
	{
	    
	    if($this->session->has_userdata('logged_in')) 
        {
            $ins_company = $this->input->post("ins_company");
            $select_class = $this->input->post("select_class");
            $agent = $this->input->post("agent");
            $from_date = $this->input->post("from_date");
            $to_date = $this->input->post("to_date");
            $policy_type = $this->input->post("policy_type");
            $area_incharge = $this->input->post("area_incharge");
            $user = $this->input->post("user");
            
            $this->load->library('Excel');
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            
            $rowCount = 4;
            
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
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'JAYANTHA INSURANCE');
            
            $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Active Policy Report');
            
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
        $objPHPExcel->getActiveSheet()->SetCellValue('F3', date_format(date_create($from_date),"d-m-Y"));
        $objPHPExcel->getActiveSheet()->SetCellValue('G3', date_format(date_create($to_date),"d-m-Y"));
        
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
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Customer');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Mobile No');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Agent Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Policy Issue Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Policy Start Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Area Incharge');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'User');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Lead Id');
        $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Policy No');
        $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'Insurer');
        $objPHPExcel->getActiveSheet()->SetCellValue('L4', 'Bussiness Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('M4', 'Class');
        $objPHPExcel->getActiveSheet()->SetCellValue('N4', 'Pol Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('O4', 'OD');
        $objPHPExcel->getActiveSheet()->SetCellValue('P4', 'TP');
        $objPHPExcel->getActiveSheet()->SetCellValue('Q4', 'Net Premium	');
        $objPHPExcel->getActiveSheet()->SetCellValue('R4', 'GST');
        
        $objPHPExcel->getActiveSheet()->SetCellValue('S4', 'Agent Category');
        $objPHPExcel->getActiveSheet()->SetCellValue('T4', 'Commission Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('U4', 'Company Percent');
        $objPHPExcel->getActiveSheet()->SetCellValue('V4', 'Agent Percent');
        
        $objPHPExcel->getActiveSheet()->SetCellValue('W4', 'Jayantha Own Commission');
        $objPHPExcel->getActiveSheet()->SetCellValue('X4', 'Unicorn Own Commission');
        $objPHPExcel->getActiveSheet()->SetCellValue('Y4', 'Total Own Commission');
        $objPHPExcel->getActiveSheet()->SetCellValue('Z4', 'Jayantha Agent Commission');
        $objPHPExcel->getActiveSheet()->SetCellValue('AA4', 'Unicorn Agent Commission');
        $objPHPExcel->getActiveSheet()->SetCellValue('AB4', 'Total Agent Commission');
        $objPHPExcel->getActiveSheet()->SetCellValue('AC4', 'Own Add Commission');
        $objPHPExcel->getActiveSheet()->SetCellValue('AD4', 'Add Agent Commission');
        $objPHPExcel->getActiveSheet()->SetCellValue('AE4', 'Vechicle No');
        $objPHPExcel->getActiveSheet()->SetCellValue('AF4', 'Status');
        
        $row_count = 5;
        $a = 0;
            
        
        $res = $this->rm->_fetch_business_complete_report($ins_company,$select_class,$policy_type,$agent,$from_date,$to_date,$area_incharge,$user);
        
        $data = $this->rm->_fetch_generate_policy_report($ins_company,$select_class,$policy_type,$agent,$from_date,$to_date,$area_incharge,$user);
        //echo '<pre>';print_r($res);print_r($data);print'</pre>';   
                                
            $a = 0;
            
            $gst = 0;
            $agn_com = 0;
            $own_com = 0;
            
            $add_own_com = 0;
            $add_agn_com = 0;
            
             $add_jay_own_com = 0;
            $add_jay_agn_com = 0;
             $add_uni_own_com = 0;
            $add_uni_agn_com = 0;
            
            foreach($res as $da)
            {
                $a++;
                
                $gst = $gst+$da->gst;
               $agn_com = $agn_com + $da->agent_commission_amt + $da->agent_commission;
                $own_com = $own_com + $da->own_commission_amt + $da->own_commission;
                
                $add_own_com = $add_own_com + $da->com_add_com;
                $add_agn_com = $add_agn_com + $da->agn_add_com;
                
                $add_jay_own_com = $add_jay_own_com + $da->own_commission_amt;
                $add_jay_agn_com = $add_jay_agn_com + $da->agent_commission_amt;
                
                $add_uni_own_com = $add_uni_own_com + $da->own_commission;
                $add_uni_agn_com = $add_uni_agn_com + $da->agent_commission;
                
                $user = $this->rm->get_user_name($da->assigned_user);
                $username = "";
                
                if($user != "")
                {
                    $username = $user->name;
                }
               
               
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->client_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->mobile_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->agn_name."(".$da->agent_pos_code.")");
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , date_format(date_create($da->policy_issue_date),"d-m-Y"));
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , date_format(date_create($da->policy_s_date),"d-m-Y"));
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->ai_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $username);
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , $da->lead_id);
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row_count , " ".$da->policy_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row_count , $da->company_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row_count , $da->business_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row_count , $da->class_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row_count , $da->policy_type);
                $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row_count , $da->total_own_damage);
                $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row_count , $da->tot_liability_premium);
                $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row_count , $da->total_premium);
                $objPHPExcel->getActiveSheet()->SetCellValue('R'.$row_count , $da->gst);
                
                $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row_count , $da->agn_com_type);
                $objPHPExcel->getActiveSheet()->SetCellValue('T'.$row_count , $da->commission_category);
                $objPHPExcel->getActiveSheet()->SetCellValue('U'.$row_count , $da->company_percent);
                $objPHPExcel->getActiveSheet()->SetCellValue('V'.$row_count , $da->agent_commission_percent);
                
                
                
                 $objPHPExcel->getActiveSheet()->SetCellValue('W'.$row_count , $da->own_commission_amt);
                $objPHPExcel->getActiveSheet()->SetCellValue('X'.$row_count , $da->own_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('Y'.$row_count , $da->own_commission_amt+$da->own_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('Z'.$row_count , $da->agent_commission_amt);
                $objPHPExcel->getActiveSheet()->SetCellValue('AA'.$row_count , $da->agent_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('AB'.$row_count , $da->agent_commission_amt+$da->agent_commission);
                
                $objPHPExcel->getActiveSheet()->SetCellValue('AC'.$row_count , $da->com_add_com);
                $objPHPExcel->getActiveSheet()->SetCellValue('AD'.$row_count , $da->agn_add_com);
                $objPHPExcel->getActiveSheet()->SetCellValue('AE'.$row_count , $da->vechi_register_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('AF'.$row_count , "Active Policy");
                
                
                $objPHPExcel->getActiveSheet()->getStyle('M'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('N'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('O'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('P'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                
                $objPHPExcel->getActiveSheet()->getStyle('U'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('V'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('W'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('X'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                
                $objPHPExcel->getActiveSheet()->getStyle('Y'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('Z'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('AA'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('AB'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');

                
                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
            }
          
          
            foreach($data as $da)
            {
                $a++;
                
                $gst = $gst+$da->gst;
               $agn_com = $agn_com + $da->agent_commission_amt;
                $own_com = $own_com + $da->own_commission_amt;
                
                $add_own_com = $add_own_com + $da->com_add_com;
                $add_agn_com = $add_agn_com + $da->agn_add_com;
                
                $add_jay_own_com = $add_jay_own_com + $da->own_commission_amt;
                $add_jay_agn_com = $add_jay_agn_com + $da->agent_commission_amt;
                
                $add_uni_own_com = $add_uni_own_com + $da->own_commission;
                $add_uni_agn_com = $add_uni_agn_com + $da->agent_commission;
               
               $user = $this->rm->get_user_name($da->assigned_user);
                if($user != "")
                {
                    $username = $user->name;
                }
               
               
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->client_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->mobile_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->agn_name."(".$da->agent_pos_code.")");
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , date_format(date_create($da->policy_issue_date),"d-m-Y"));
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , date_format(date_create($da->policy_s_date),"d-m-Y"));
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->ai_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count ,$username);
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , $da->lead_id);
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row_count , $da->policy_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row_count , $da->company_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row_count , $da->business_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row_count , $da->class_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('N'.$row_count , $da->policy_type);
                $objPHPExcel->getActiveSheet()->SetCellValue('O'.$row_count , $da->total_own_damage);
                $objPHPExcel->getActiveSheet()->SetCellValue('P'.$row_count , $da->tot_liability_premium);
                $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$row_count , $da->total_premium);
                $objPHPExcel->getActiveSheet()->SetCellValue('R'.$row_count , $da->gst);
                
                $objPHPExcel->getActiveSheet()->SetCellValue('S'.$row_count , $da->agn_com_type);
                $objPHPExcel->getActiveSheet()->SetCellValue('T'.$row_count , $da->commission_category);
                $objPHPExcel->getActiveSheet()->SetCellValue('U'.$row_count , $da->company_percent);
                $objPHPExcel->getActiveSheet()->SetCellValue('V'.$row_count , $da->agent_commission_percent);
                
                $objPHPExcel->getActiveSheet()->SetCellValue('W'.$row_count , $da->own_commission_amt);
                $objPHPExcel->getActiveSheet()->SetCellValue('X'.$row_count , $da->own_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('Y'.$row_count , $da->own_commission_amt+$da->own_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('Z'.$row_count , $da->agent_commission_amt);
                $objPHPExcel->getActiveSheet()->SetCellValue('AA'.$row_count , $da->agent_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('AB'.$row_count , $da->agent_commission_amt+$da->agent_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('AC'.$row_count , $da->com_add_com);
                $objPHPExcel->getActiveSheet()->SetCellValue('AD'.$row_count , $da->agn_add_com);
                $objPHPExcel->getActiveSheet()->SetCellValue('AE'.$row_count , $da->vechi_register_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('AF'.$row_count , "Business Completed");
                
                
                $objPHPExcel->getActiveSheet()->getStyle('M'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('N'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('O'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('P'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                
                $objPHPExcel->getActiveSheet()->getStyle('U'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('V'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('W'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('X'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                 $objPHPExcel->getActiveSheet()->getStyle('Y'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('Z'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('AA'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('AB'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');

                
                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
               }
          
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                $objWriter->save('./datas/reports/agent_business_report.xlsx');
                
                echo base_url()."/datas/reports/agent_business_report.xlsx";
                
        }
	}


	
	
	
	public function policy_failure_report()
	{
	    if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        // if(!$this->auth->can_access('Policy Failure Report')){
        //     redirect('access_denied', 'refresh');
        // }
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        {    
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $data["ins_company"] = $this->rm->get_insurance_company_list();
            $data["class"] = $this->rm->get_class_list();
            $data["cover"] = $this->rm->get_policy_cover_type();
             $userid = "";
            if($this->session->userdata('session_role') == "user")
                $userid = $this->session->userdata('session_id');
                
            $data["users"] = $this->rm->fetch_users_list( $userid );
    		$this->load->view('header',$pro_data);
    		$this->load->view('policy_failure_report',$data);
    		$this->load->view('footer',$pro_data);
        }
         else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user") 
        {    
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $data["ins_company"] = $this->rm->get_insurance_company_list();
            $data["class"] = $this->rm->get_class_list();
            $data["cover"] = $this->rm->get_policy_cover_type();
            $userid = "";
            if($this->session->userdata('session_role') == "user")
                $userid = $this->session->userdata('session_id');
                
            $data["users"] = $this->rm->fetch_users_list( $userid );
    		$this->load->view('header',$pro_data);
    		$this->load->view('policy_failure_report',$data);
    		$this->load->view('footer',$pro_data);
        }
        
	}
	
	public function fetch_policy_failure_report()
	{
	    if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "admin" || $this->session->userdata('session_role') =="user")) 
        {
            $select_class = $this->input->post("select_class");
            $policy_type = $this->input->post("policy_type");
            $from_date = $this->input->post("from_date");
            $to_date = $this->input->post("to_date");
            $foe = $this->input->post("foe");
            
            $res = $this->rm->fetch_policy_failure_report($select_class,$policy_type,$from_date,$to_date,$foe);
         
               $content = "<div class='table-responsive'><table class='table table-hover table-bordered'>
                            <thead>
                                    <th>S.No</th>
                                    <th>Lead Id</th>
                                    <th>Client name</th>
                                    <th>Mobile No</th>
                                    <th>Class</th>
                                    <th>Policy Type</th>
                                    <th>Business type</th>
                                    <th>Area</th>
                                    <th>Agent id</th>
                                    <th>FOE</th>
                                    <th>Area Incharge</th>
                                    <th>Due Date</th>
                                    <th>Vehicle Regn No</th>
                                    <th>Classification</th>
                                 </thead>";
              
                $content .= "<tbody>";
                $a = 0; 
                
                foreach($res as $da)
                {
                    $a++;
                    
                    $agn_code = $agn_name = "";
                    
                    $date = "No Due Date";
                    
                    if($da->due_date != "0000-00-00")
                    {
                        $date = date_format(date_create($da->due_date),"d-m-Y"); 
                    }
                    
                    if(isset($da->agency_and_pos))
                    {
                        if($da->agency_and_pos != "")
                        {
                             $get_agent_name = $this->rm->get_agent_name($da->agency_and_pos);
                             $agn_name = $get_agent_name->agent_pos_code;
                             $agn_code = $get_agent_name->name;
                        }
                    }
                    else
                    {
                        $agn_name = "";
                    }
                    
                    if($da->assigned_user != "all")
                    {
                        if($da->assigned_user != "")
                        {
                         $get_user = $this->rm->get_user_name($da->assigned_user);
                         $usr_name = $get_user->name;
                        }
                        else
                        {
                         $usr_name = "";
                        }
                    }
                    else
                    {
                         $usr_name = "";
                    } 
                    
                    
                    $classification = ""; 
                     if($da->policy_status == "0" && $da->lead_type == "0" && $da->classfication == "1")
                     {
                         $classification = "HOT";
                     }
                     else if($da->policy_status == "0" && $da->lead_type == "0" &&  $da->classfication == "2")
                     {
                         $classification = "WARM";
                     }
                     else if($da->policy_status == "0" && $da->lead_type == "0" && $da->classfication == "3")
                     {
                         $classification = "COLD";
                     }
                     else if($da->policy_status == "0" && $da->lead_type == "1")
                     {
                          $classification = "PROSPECTS";
                     }
                    
                   
                    
                    $content .= "<tr>
                                <td>".$a."</td>
                                <td>".$da->id."</td>
                                <td>".$da->client_name."</td>
                                <td>".$da->mobile_no."</td>
                                <td>".$da->lclass."</td>
                                <td> ".$da->p_type."</td>
                                <td>".$da->b_type."</td>
                                <td>".$da->area."</td>
                                <td>".$agn_code."($agn_name)</td>
                                <td>".$usr_name."</td>
                                <td>".$da->cname."</td>
                                <td> ".$date."</td>
                                <td>".$da->vechi_register_no."</td> 
                                <td>".$classification."</td> 
                           </tr>";
                }
                $content .= "</tbody>
                </table>";
                echo $content;
        }
	}
	
	
// 	public function fetch_policy_failure_report_excel()
// 	{
// 	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
//         {
//             $from_date = $this->input->post("from_date");
//             $to_date = $this->input->post("to_date");
            
//             $res = $this->rm->fetch_policy_failure_report($from_date,$to_date);
            
            
//             $this->load->library('Excel');
//             $objPHPExcel = new PHPExcel();
//             $objPHPExcel->setActiveSheetIndex(0);
            
//             $rowCount = 4;
            
//             $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(20);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(35);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(15);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(35);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(35);
//             $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(35);
//             $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
//             $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'JAYANTHA INSURANCE');
            
//             $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'Policy Failure Report');
            
//             $objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray(
//             		array(
//             			'font'  => array(
//             				'bold'  => true,
//             				'color' => array('rgb' => 'e6e600'),
//             				'size'  => 18,
//             			),
//             		)
//             	);
//             	$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray(
//             		array(
//             			'font'  => array(
//             				'bold'  => true,
//             				'color' => array('rgb' => '00cc66'),
//             				'size'  => 14,
//             			),
//             		)
//             	);
            	
//         $objPHPExcel->getActiveSheet()->SetCellValue('E3',"FROM DATE");
//         $objPHPExcel->getActiveSheet()->SetCellValue('F3', date_format(date_create($from_date),"d-m-Y"));
//         $objPHPExcel->getActiveSheet()->SetCellValue('G3',"TO DATE");
//         $objPHPExcel->getActiveSheet()->SetCellValue('H3', date_format(date_create($to_date),"d-m-Y"));
        
//         // $objPHPExcel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
//         // $objPHPExcel->getActiveSheet()->SetCellValue('F3', 'Excel Date : ');
//         // $objPHPExcel->getActiveSheet()->SetCellValue('G3', date("d-m-Y"));

//         $objPHPExcel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);
//         $objPHPExcel->getActiveSheet()->getStyle('4')->applyFromArray(
//         array(
//         'fill' => array(
//             'type' => PHPExcel_Style_Fill::FILL_SOLID,
//             'color' => array('rgb' => '31406b')
//         ),
//         'alignment' => array(
//             'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
//         ),
//         'font'  => array(
//             'bold'  => true,
//             'color' => array('rgb' => 'FFFFFF'),
//             'size'  => 13,
//         ),
//         )
//         );
        
//         $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'S.No');
//         $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Client name');
//         $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Mobile No');
//         $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Class');
//         $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Policy Type');
//         $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Business type');
//         $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Area');
//         $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Agn Name');
//         $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'User');
//         $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'AI');
//         $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'Due Date');
//         $objPHPExcel->getActiveSheet()->SetCellValue('L4', 'Vehicle Regn No');
//         $objPHPExcel->getActiveSheet()->SetCellValue('M4', 'Classification');
     
        
//             $row_count = 5;
//             $a = 0;
//             $regn_no = "";
       
//              foreach($res as $da)
//              {
//         	        $a++;
//                     $date = "No Due Date";
                    
//                     if($da->due_date != "0000-00-00")
//                     {
//                         $date = date_format(date_create($da->due_date),"d-m-Y"); 
//                     }
                    
//                     if(isset($da->agency_and_pos))
//                     {
//                         if($da->agency_and_pos != "")
//                         {
//                              $get_agent_name = $this->rm->get_agent_name($da->agency_and_pos);
//                              $agn_name = $get_agent_name->agent_pos_code;
//                         }
//                         else
//                         {
//                          $agn_name = "";
//                         }
//                     }
//                     else
//                     {
//                         $agn_name = "";
//                     }
                    
//                     if($da->assigned_user != "all")
//                     {
//                         if($da->assigned_user != "")
//                         {
//                          $get_user = $this->rm->get_user_name($da->assigned_user);
//                          $usr_name = $get_user->name;
//                         }
//                         else
//                         {
//                          $usr_name = "";
//                         }
//                     }
//                     else
//                     {
//                          $usr_name = "";
//                     } 
                    
//                     $ai = "";
                    
//                     if($da->area_incharge != "all")
//                     {
//                         if($da->area_incharge != "")
//                         {
//                          $ai = $this->rm->get_area_incharge($da->area_incharge);
                         
//                              if(isset($ai->name))
//                              {
//                                 $ai = $ai->name;
//                              }
//                         }
//                         else
//                         {
//                           $ai = "";
//                         }
//                     }
//                     else
//                     {
//                          $ai = "";
//                     } 
             
//                  $classification = ""; 
//                  if($da->policy_status == "0" && $da->lead_type == "0" && $da->classfication == "1")
//                  {
//                      $classification = "HOT";
//                  }
//                  else if($da->policy_status == "0" && $da->lead_type == "0" &&  $da->classfication == "2")
//                  {
//                      $classification = "WARM";
//                  }
//                  else if($da->policy_status == "0" && $da->lead_type == "0" && $da->classfication == "3")
//                  {
//                      $classification = "COLD";
//                  }
//                  else if($da->policy_status == "0" && $da->lead_type == "1")
//                  {
//                       $classification = "PROSPECTS";
//                  }
                
        	         
//         	    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->client_name);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->mobile_no);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->lclass);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , $da->p_type);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $da->b_type);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->area);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $agn_name);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , $usr_name);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row_count , $ai);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row_count , $date);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row_count , $da->vechi_register_no);
//                 $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row_count , $classification);
                
//                 $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
//                 $row_count++;
//              }
             
//              $res = [];
             
//             $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
//             $objWriter->save('./datas/reports/failure_report.xlsx');
//             echo base_url()."/datas/reports/failure_report.xlsx";
//         }
// 	}
	 
	// Renewal Report
	
	public function policy_renewal_report()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        {    
            $pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('policy_renewal_report');
    		$this->load->view('footer',$pro_data);
        }
	}
	
	public function fetch_renewal_report()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        {
            $from_date = $this->input->post("from_date");
            $to_date = $this->input->post("to_date");
            
            $res = $this->rm->fetch_policy_renewal_report($from_date,$to_date);
            
         
               $content = "<div class='table-responsive'><table class='table table-hover table-bordered'>
                            <thead>
                                    <th>S.No</th>
                                    <th>Client name</th>
                                    <th>Mobile No</th>
                                    <th>Class</th>
                                    <th>Policy Type</th>
                                    <th>Business type</th>
                                    <th>Area</th>
                                    <th>Partner Name</th>
                                    <th>FOE</th>
                                    <th>Area Incharge</th>
                                    <th>Due Date</th>
                                    <th>Vehicle Regn No</th>
                                    <th>Classification</th>
                                 </thead>";
              
                $content .= "<tbody>";
                $a = 0; 
                
                foreach($res as $da)
                {
                    $a++;
                    
                    $date = "No Due Date";
                    
                    if($da->due_date != "0000-00-00")
                    {
                        $date = date_format(date_create($da->due_date),"d-m-Y"); 
                    }
                    
                    if(isset($da->agency_and_pos))
                    {
                        if($da->agency_and_pos != "")
                        {
                             $get_agent_name = $this->rm->get_agent_name($da->agency_and_pos);
                             $agn_name = $get_agent_name->agent_pos_code;
                        }
                        else
                        {
                         $agn_name = "";
                        }
                    }
                    else
                    {
                        $agn_name = "";
                    }
                    
                    if($da->assigned_user != "all")
                    {
                        if($da->assigned_user != "")
                        {
                         $get_user = $this->rm->get_user_name($da->assigned_user);
                         $usr_name = $get_user->name;
                        }
                        else
                        {
                         $usr_name = "";
                        }
                    }
                    else
                    {
                         $usr_name = "";
                    } 
                    
                    
                    $classification = ""; 
                     if($da->policy_status == "0" && $da->lead_type == "0" && $da->classfication == "1")
                     {
                         $classification = "HOT";
                     }
                     else if($da->policy_status == "0" && $da->lead_type == "0" &&  $da->classfication == "2")
                     {
                         $classification = "WARM";
                     }
                     else if($da->policy_status == "0" && $da->lead_type == "0" && $da->classfication == "3")
                     {
                         $classification = "COLD";
                     }
                     else if($da->policy_status == "0" && $da->lead_type == "1")
                     {
                          $classification = "PROSPECTS";
                     }
                    
                    $ai = "";
                    
                    $content .= "<tr>
                                <td>".$a."</td>
                                <td>".$da->client_name."</td>
                                <td>".$da->mobile_no."</td>
                                <td>".$da->lclass."</td>
                                <td> ".$da->p_type."</td>
                                <td>".$da->b_type."</td>
                                <td>".$da->area."</td>
                                <td>".$agn_name."</td>
                                <td>".$usr_name."</td>
                                <td>".$ai."</td>
                                <td> ".$date."</td>
                                <td>".$da->vechi_register_no."</td> 
                                <td>".$classification."</td> 
                           </tr>";
                }
                $content .= "</tbody>
                </table>";
                echo $content;
        }
	}
	
	
	public function fetch_policy_failure_report_excel()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        {
            $select_class = $this->input->post("select_class");
            $policy_type = $this->input->post("policy_type");
            $from_date = $this->input->post("from_date");
            $to_date = $this->input->post("to_date");
            $foe = $this->input->post("foe");
            
            
            $res = $this->rm->fetch_policy_failure_report($select_class,$policy_type,$from_date,$to_date,$foe);
            
    
            $this->load->library('Excel');
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            
            $rowCount = 4;
            
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
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'JAYANTHA INSURANCE');
            
            $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'Policy Failure Report');
            
            $objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray(
            		array(
            			'font'  => array(
            				'bold'  => true,
            				'color' => array('rgb' => 'e6e600'),
            				'size'  => 18,
            			),
            		)
            	);
            	$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray(
            		array(
            			'font'  => array(
            				'bold'  => true,
            				'color' => array('rgb' => '00cc66'),
            				'size'  => 14,
            			),
            		)
            	);
            	
        $objPHPExcel->getActiveSheet()->SetCellValue('E3',"FROM DATE");
        $objPHPExcel->getActiveSheet()->SetCellValue('F3', date_format(date_create($from_date),"d-m-Y"));
        $objPHPExcel->getActiveSheet()->SetCellValue('G3',"TO DATE");
        $objPHPExcel->getActiveSheet()->SetCellValue('H3', date_format(date_create($to_date),"d-m-Y"));
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
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Client name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Mobile No');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Class');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Policy Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Business type');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Area');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Agn Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'User');
        $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'AI');
        $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'Due Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('L4', 'Vehicle Regn No');
        $objPHPExcel->getActiveSheet()->SetCellValue('M4', 'Classification');
     
        
            $row_count = 5;
            $a = 0;
            $regn_no = "";
       
             foreach($res as $da)
             {
        	        $a++;
                    $date = "No Due Date";
                    
                    if($da->due_date != "0000-00-00")
                    {
                        $date = date_format(date_create($da->due_date),"d-m-Y"); 
                    }
                    
                    if(isset($da->agency_and_pos))
                    {
                        if($da->agency_and_pos != "")
                        {
                             $get_agent_name = $this->rm->get_agent_name($da->agency_and_pos);
                             $agn_name = $get_agent_name->agent_pos_code;
                        }
                        else
                        {
                         $agn_name = "";
                        }
                    }
                    else
                    {
                        $agn_name = "";
                    }
                    
                    if($da->assigned_user != "all")
                    {
                        if($da->assigned_user != "")
                        {
                         $get_user = $this->rm->get_user_name($da->assigned_user);
                         $usr_name = $get_user->name;
                        }
                        else
                        {
                         $usr_name = "";
                        }
                    }
                    else
                    {
                         $usr_name = "";
                    } 
                    
                    $ai = "";
                    
                    if($da->area_incharge != "all")
                    {
                        if($da->area_incharge != "")
                        {
                         $ai = $this->rm->get_area_incharge($da->area_incharge);
                         
                             if(isset($ai->name))
                             {
                                $ai = $ai->name;
                             }
                        }
                        else
                        {
                          $ai = "";
                        }
                    }
                    else
                    {
                         $ai = "";
                    } 
             
                 $classification = ""; 
                 if($da->policy_status == "0" && $da->lead_type == "0" && $da->classfication == "1")
                 {
                     $classification = "HOT";
                 }
                 else if($da->policy_status == "0" && $da->lead_type == "0" &&  $da->classfication == "2")
                 {
                     $classification = "WARM";
                 }
                 else if($da->policy_status == "0" && $da->lead_type == "0" && $da->classfication == "3")
                 {
                     $classification = "COLD";
                 }
                 else if($da->policy_status == "0" && $da->lead_type == "1")
                 {
                      $classification = "PROSPECTS";
                 }
                
        	         
        	    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->client_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->mobile_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->lclass);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , $da->p_type);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $da->b_type);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->area);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $agn_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , $usr_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row_count , $ai);
                $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row_count , $date);
                $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row_count , $da->vechi_register_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row_count , $classification);
                
                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
             }
             
             $res = [];
             
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter->save('./datas/reports/failure_report.xlsx');
            echo base_url()."/datas/reports/failure_report.xlsx";
        }
	}
	
	
		public function agent_voucher_pending()
     	{
     	    if( !( $this->session->has_userdata('logged_in') ) ){
                redirect('login', 'refresh');
            }
            
            // if(!$this->auth->can_access('Agent Voucher Pending')){
            //     redirect('access_denied', 'refresh');
            // }
    	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
            {
                    $pro_data["project_info"] = $this->mm->fetch_project_info();
                    $data["agents"] = $this->rm->fetch_agents_list();
            		$this->load->view('header',$pro_data);
            		$this->load->view('agent_voucher_pending',$data);
            		$this->load->view('footer',$pro_data);
            }
     	}
     	
     	public function fetch_agent_voucher_pending()
     	{
     	    if($this->session->has_userdata('logged_in')) 
            {
                 $draw = intval($this->input->post("draw"));
                 
                 $agents = $this->input->post("agent");
                 $f_date = $this->input->post("f_date");
                 $to_date = $this->input->post("to_date");
                 $res = $this->rm->fetch_agent_vouchers_list($agents,$f_date,$to_date);
                // echo $res;
                    $tds = 0;
                    $total = 0;
                    $agent_commission = 0;
                    
                    $arr = [];
                    $a = 0 ;
        
                                            
                    foreach($res as $da)
                    {
                        $a++;
                        
                          $agent_commission = $da->ac + $da->add_com;
                        
                           $agent_code_1 = $this->rm->get_single_agent_code($da->policy_agency_pos);
                    
                            if($agent_code_1 != NULL || $agent_code_1 !="")
                            {
                                $code=  $agent_code_1->agent_pos_code;
                            }
                            else
                            {
                                $code=  "";
                            }
                            
                            $tds_amount = $this->rm->get_tds_amount($da->Vocher_no);
                            
                            if($tds_amount != "")
                            {
                              $tds =  $tds_amount->tds_amount;
                            }
                            else
                            {
                               $tds = "0";
                            }
                            
                            $total = $agent_commission - $tds;
                            
                            $voucher_no = "<a href='agent_vocher_print?vocher_no=".$da->Vocher_no."' target='_blank'>".$da->Vocher_no."</a>";
                        
                            $arr[] = array(
                                 $a,
                                 $code,
                                 $voucher_no,
                                 date_format(date_create($da->vocher_date),"d-m-Y h:i:s a"),
                                 floor($agent_commission)."0.00",
                                 ceil($tds)."0.00",
                                 floor($total)."0.00",
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
     	
     	// Foe Report
     	
       public function feo_report()
       {
     	    if($this->session->has_userdata('logged_in')) 
            {
                $this->load->library('pdf');
                $foe_id = "all"; 
                $date = $this->input->get("date");
                $order_by = $this->input->get("order_by");
            
                $res = $this->rm->get_foe_reports($foe_id,$date,$order_by);
                            
                 $content = "<!DOCTYPE html>
                            <html>
                            <head>
                                <title>Foe Report : ".date_format(date_create($date),"d-m-Y")." </title>
                                <style>
                                    *{
                                        padding:1px;
                                        margin:0px;
                                        font-family: 'Courier';
                                        font-size:13px;
                                        font-weight:unset;
                                    }
                                    
                                .table thead th {
                                    vertical-align: bottom !important;
                                    border-bottom: 2px solid #dee2e6 !important;
                                    border-collapse: collapse !important;
}
                                }
                                .table-bordered td, .table-bordered th {
                                    border: 1px solid #dee2e6 !important;
                                }
                                 .table td, .table th {
                                    padding: 0.75rem !important;
                                    vertical-align: top !important;
                                    border-top: 1px solid #dee2e6 !important;
                                }
                                </style>
                            </head>
                            <body>
                                <div style='border:1px solid #aaa;padding:5px;margin:30px;'>
                                <center><p style='font-size:20px;padding-top:0px;'>Foe Report -(".date_format(date_create($date),"d-m-Y").")</p></center><br><br>";
                            
                            
                          $content .= "<table style='width:100%' class='table table-bordered'>
                                    <tr>
                                        <th style='background-color:#dff0d8;width:5%;text-align: center;'>FOE</th>
                                        <th style='background-color:#dff0d8;width:5%;text-align: center;'>Date</th>
                                        <th style='background-color:#dff0d8;width:5%;text-align: center;'>POSP/AI</th>
                                        <th style='background-color:#dff0d8;width:5%;text-align: center;'>Call Type</th>
                                        <th style='background-color:#dff0d8;width:5%;text-align: center;'>Commitment</th>
                                        <th style='background-color:#dff0d8;width:5%;text-align: center;'> M / H Remarks</th>
                                    </tr>
                                    <tbody>";
                                                
                                    foreach($res as $da)
                                    {
                                         $data = $this->rm->get_foe_details($da->created_id);
                                         
                                            $content .= "<tr>
                                                
                                              <td style='padding:5px;'>".$data->name."</td>
                                              <td style='padding:5px;'>".date_format(date_create($da->created_at),"h:i:s a")."</td>";
                                              
                                               if($da->area_incharge_id == "0")
                                                {
                                                    $content .= "<td style='padding:5px;'>".$da->agent_name."   (".$da->agent_pos_code.")</td>";
                                                }
                                                else
                                                {
                                                    $content .= "<td style='padding:3px;'>".$da->ai_name."</td>";
                                                }
                                                      $content .= " <td style='padding:5px;'>".$da->call_answer."</td>
                                                                    <td style='padding:5px;'>M - ".$da->motor_nop." / H-".$da->health_nop."</td>
                                                                    <td style='padding:5px;'>".$da->motor_remarks."  / ".$da->health_remarks."</td>
                                                                </tr>";
                                    }
                                    
                                           $content .= "</tbody>
                                             </table>";
                       	
                	    $this->load->library('pdf');
                    	$this->pdf->loadHtml($content);
                    	$this->pdf->render();
                    	$filename = "foe_report - ".date_format(date_create($date),"d-m-Y")."";
                    	$this->pdf->stream("'$filename'".".pdf", array("Attachment" => false));
            }
       }
       
       
       public function calc_agent_commission($agent_id,$accvcharid)
       {
            if($this->session->has_userdata('logged_in')) 
            {
                $tot_credit = $this->rm->get_total_credit_amount($agent_id);
                $tot_debit = $this->rm->get_total_debit_amount($agent_id);
                $balance = $tot_credit->credit_tot - $tot_debit->debit_tot;
                $data = array("numaccbalance" =>$balance);
                $res = $this->rm->update_ledger($data,$accvcharid);
            }
       }
       
       public function calc_tds_amount($agent_id,$agent_accid)
       {
            if($this->session->has_userdata('logged_in')) 
            {
                // agent tds balance
                $tot_credit = $this->rm->get_agent_tds_credit_amount($agent_id);
                $tot_debit = $this->rm->get_agent_tds_debit_amount($agent_id);
                $balance = $tot_credit->credit_tot - $tot_debit->debit_tot;
                $data = array("numaccbalance" =>$balance);
                $res = $this->rm->update_tds_ledger($data,$agent_accid);
                
                // Main Ledger
                $main_acc_name = "acc0226";
                
                $main_ledger_cr = $this->rm->get_total_tds_credit_amount();
                $main_ledger_dt = $this->rm->get_total_tds_debit_amount();
                
                $balance = $main_ledger_cr->total_credit_amt - $main_ledger_dt->total_debit_amt;
                $data_1 = array("numaccbalance" =>$balance);
                $res_1 = $this->rm->update_tds_ledger($data_1,$main_acc_name);
            }
       }
       
       
       public function monthly_report()
       {
            if($this->session->has_userdata('logged_in'))
        	{
        		$pro_data["project_info"] = $this->mm->fetch_project_info();
                $data["ins_company"] = $this->rm->get_insurance_company_list();
                $data["class"] = $this->rm->get_class_list();
                $data["cover"] = $this->rm->get_policy_cover_type();
                $data["agents"] = $this->rm->fetch_agents_list();
                $data["area_incharge"] = $this->rm->fetch_area_incharge_list();
                $data["users"] = $this->rm->fetch_users_list();
        		$this->load->view('header',$pro_data);
        		$this->load->view('monthly_business_report',$data);
        		$this->load->view('footer',$pro_data);
    	    }
    	    else
    	    {
    	    	redirect("login");
    	    }
       }
       
       public function fetch_monthly_report()
       {
        if($this->session->has_userdata('logged_in')) 
        {
                $fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
                $from_limit = $this->input->post("from_limit");
                $to_limit = $this->input->post("to_limit");
                $report_status = $this->input->post("report_status");
                
                $company = "";
                $area_incharge = "";
    
                if($report_status == "insurer_wise")
                {
                    $count = 0;
                    $content = "<div class='table-responsive'>
                     <table class='table table-hover table-bordered'>
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Insurer company</th>";
                                
                                for($i = $from_limit; $i < $to_limit; $i++) 
                                {
                                    $count++;
                                    $frmdate = date('Y-m-01',strtotime("-$i months"));
                                    $content .="<th>".date_format(date_create($frmdate),"M-Y")."</th>";
                                }
                                
                        $content .="</tr>
                        </thead>
                     <tbody>";
                    $a = 0;
                   $res1 = $this->rm->fetch_all_insurance_companies();
                  
                    foreach($res1 as $da)
                    { 
                        $a++;
                        $content .= "<tr>
                                       <td>".$a."</td>
                                       <td>".$da->company_name."</td>";
                        $j =0;
                        
                        for($i = $from_limit; $i < $to_limit; $i++) 
                        {
                                $j++;
                                $frmdate = date('Y-m-01',strtotime("-$i months"));
                                $todate = date('Y-m-t',strtotime("-$i months"));
                                
                                $res0 = $this->rm->fetch_sum_business_complete_report($frmdate,$todate,$report_status,$da->id);
                                $data0 = $this->rm->fetch_sum_generate_policy_report($frmdate,$todate,$report_status,$da->id);
                                
                                $total_net = $res0->tot_premium + $data0->tot_premium;
                                
                                if($j == "1")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                                else if($j == "2")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                                else if($j == "3")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                                else if($j == "4")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                                else if($j == "5")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                                else if($j == "6")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                            }
                           $content .="</tr>";
                        }
                   }
                else if($report_status == "Area_incharge_wise")
                {
                    $count = 0;
                    $content = "<div class='table-responsive'>
                     <table class='table table-hover table-bordered'>
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Insurer company</th>";
                                
                                for($i = $from_limit; $i < $to_limit; $i++) 
                                {
                                    $count++;
                                    $frmdate = date('Y-m-01',strtotime("-$i months"));
                                    $content .="<th>".date_format(date_create($frmdate),"M-Y")."</th>";
                                }
                                
                        $content .="</tr>
                        </thead>
                     <tbody>";
                    $a = 0;
                    
                   $res1 = $this->rm->fetch_all_area_incharge();
                  
                    foreach($res1 as $da)
                    { 
                        $a++;
                        $content .= "<tr>
                                       <td>".$a."</td>
                                       <td>".$da->name."</td>";
                        $j =0;
                        
                        for($i = $from_limit; $i < $to_limit; $i++) 
                        {
                                $j++;
                                $frmdate = date('Y-m-01',strtotime("-$i months"));
                                $todate = date('Y-m-t',strtotime("-$i months"));
                                $res0 = $this->rm->fetch_sum_business_complete_report($frmdate,$todate,$report_status,$da->id);
                                $data0 = $this->rm->fetch_sum_generate_policy_report($frmdate,$todate,$report_status,$da->id);
                                $total_net = $res0->tot_premium + $data0->tot_premium;
                             
                                if($j == "1")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                                else if($j == "2")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                                else if($j == "3")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                                else if($j == "4")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                                else if($j == "5")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                                else if($j == "6")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                            }
                           $content .="</tr>";
                        }
                }
                else if($report_status == "policy_class_wise")
                {
                    $count = 0;
                    $content = "<div class='table-responsive'>
                     <table class='table table-hover table-bordered'>
                        <thead>
                            <tr>
                                <th>S.No</th>
                                <th>Insurer company</th>";
                                
                                for($i = $from_limit; $i < $to_limit; $i++) 
                                {
                                    $count++;
                                    $frmdate = date('Y-m-01',strtotime("-$i months"));
                                    $content .="<th>".date_format(date_create($frmdate),"M-Y")."</th>";
                                }
                                
                        $content .="</tr>
                        </thead>
                     <tbody>";
                    $a = 0;
                    
                   $res1 = $this->rm->fetch_all_class();
                  
                    foreach($res1 as $da)
                    { 
                        $a++;
                        $content .= "<tr>
                                       <td>".$a."</td>
                                       <td>".$da->class."</td>";
                        $j =0;
                        
                        for($i = $from_limit; $i < $to_limit; $i++) 
                        {
                                $total_net = 0;
                                $j++;
                                $frmdate = date('Y-m-01',strtotime("-$i months"));
                                $todate = date('Y-m-t',strtotime("-$i months"));
                                
                                $res0 = $this->rm->fetch_sum_business_complete_report($frmdate,$todate,$report_status,$da->id);
                                $data0 = $this->rm->fetch_sum_generate_policy_report($frmdate,$todate,$report_status,$da->id);
                                
                                $total_net = $res0->tot_premium + $data0->tot_premium;
                             
                                if($j == "1")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                                else if($j == "2")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                                else if($j == "3")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                                else if($j == "4")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                                else if($j == "5")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                                else if($j == "6")
                                {
                                    $content .="<td style='text-align: right'>".$fmt->formatCurrency($total_net, "INR")."</td>";
                                }
                            }
                           $content .="</tr>";
                        }
                }
                
                 echo $content;
        }
     }
     
    public function  insurance_generate_vocher()
    {
         if($this->session->has_userdata('logged_in')) 
         { 
                $policy_arr = $this->input->post("policy_arr");
                $agent = $this->input->post("agent");
                $date = date("Y-m-d H:i:s");
                $year = date('y');
                $month = date('m');
                if($month < 4)
                {
                    $year = $year-1;
                }
                $agent_code = $this->rm->get_agent_code_by_id($agent);
                
                //$data0 = $this->rm->get_tds_accvarcharid($agent_code->agent_pos_code);
                
                // if($data0 != "")
                // {
                
                    $x = 0;
                    do 
                    {
                      $x++;
                      $new_vocher_no = "av".$x."/".$year;
                    } 
                    while($this->rm->vocher_no_already_exits($new_vocher_no));
                    
                    $data = array("vocher_no" =>$new_vocher_no,"vocher_status" =>"1","vocher_date"=>$date);
                    
                    $total_commission = 0;
                    
                    for($i= 0;$i<count($policy_arr);$i++)
                    {
                         $res = $this->rm->update_vocher_details($data,$policy_arr[$i]);
                         $total_commission = $total_commission + $res->agent_commission_amt + $res->agn_add_com;
                         $agent_id = $res->policy_agency_pos;
                    }
                    
                    $tds_data = $this->rm->get_tds_percentage();
                    
                    // if($tds_data != "")
                    // {
                    //   $tds = $tds_data->tds_percentage;
                    // }
                    // else
                    // {
                    //   $tds = 0;
                    // }
                    
                    //$tds_amount = floor($total_commission) * $tds/100;
                   
                    // $tds_arr = array(
                    //                     "agent_id" =>$agent_id,
                    //                     "vhcharaccid" =>$data0->account_id,
                    //                     "vocher_no" =>$new_vocher_no,
                    //                     "tds_amount" =>ceil($tds_amount),
                    //                     "created_at"=>date("Y-m-d H:i:s"),
                    //                     "created_by"=>$this->session->userdata("session_id")
                    //             );
                    // $tds_log = $this->rm->update_tds_log($tds_arr);
                    
                    $agent_commission = $total_commission;
                    $net = floor($total_commission) - 0;
                    
                    // Voucher Details Table
                    
                    $voucher_data = array(
                                        "agent_id" =>$agent_id,
                                        "voucher_no" =>$new_vocher_no,
                                        "total_commission" =>floor($net),
                                        "created_by"=>$this->session->userdata("session_id"),
                                        "created_at" =>date("Y-m-d H:i:s"),
                                     );
                    
                    $result = $this->rm->add_agent_voucher_details($voucher_data);
                    $main_ledger = $this->rm->get_ledger_acc($agent_id);
                    
                   //Agent commission table IRDA
                   
                    $irda_com = 15/100 * $net;
                    $orc_com = $net - $irda_com;

                    $commission_arr = array(
                                "agent_id" =>$agent_id,
                                "voucher_no" =>$new_vocher_no,
                                "vhcharaccid" =>$main_ledger->vchaccname,
                                "credit" =>floor($irda_com),
                                "date" =>date("Y-m-d"),
                                "tds" =>0,
                                "created_by"=>$this->session->userdata("session_id"),
                                "created_at" =>date("Y-m-d H:i:s"),
                             );
                             
                    $res_1 = $this->rm->add_agent_commission($commission_arr); 
                    
                    
                  //Agent commission table ORC
                  $commission_arr_2 = array(
                                "agent_id" =>$agent_id,
                                "voucher_no" =>$new_vocher_no,
                                "vhcharaccid" =>$main_ledger->vchaccname,
                                "credit" =>floor($orc_com),
                                "date" =>date("Y-m-d"),
                                "tds" =>0,
                                "created_by"=>$this->session->userdata("session_id"),
                                "created_at" =>date("Y-m-d H:i:s"),
                             );
                  $res_2 = $this->rm->add_agent_commission_orc($commission_arr_2); 
                    
                    //Calculations 
                    //$this->calc_agent_commission($agent_id,$main_ledger->account_id);
                   // $this->calc_tds_amount($agent_id,$data0->account_id);
                    echo json_encode(array("status"=>"success","arr" =>$res));
                // }
                // else
                // {
                //     echo json_encode(array("status"=>"Agent Ledger Not Available"));
                // }
               
         }
     }
     
    // comments by kgk on 2023-05-09
    public function _company_invoice_pdf() {
        if(!$this->session->has_userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        
        // if(!$this->auth->can_access('Export Company Invoice Report')){
        //     redirect('access_denied', 'refresh');
        // }
        
        $vocher_no = $this->input->get("voucher_no");
        
        $company_details = $this->rm->get_company_details();
        
        $org = 1; $org_txt = 'jan';
        if($this->session->userdata('session_company_type') == "unicorn"){
        	$company_details->name = "UNICORN";
        	$org = 2;$org_txt = 'uni';
        }
        
        $policy_type = [];

        $invoices = $this->rm->getCompanyinvoice($insurance = '',$from_date='',$to_date='',$policy_class='',$org, $vocher_no);
        
        //echo $this->db->last_query();
        
        $company_name = (isset($invoices[0]->company_name) && !empty($invoices[0]->company_name)) ? trim($invoices[0]->company_name) : "";
        
        $vouchar = (isset($invoices[0]->invvouchar) && !empty($invoices[0]->invvouchar)) ? trim($invoices[0]->invvouchar) : "";
        
        $vouchar_date = (isset($invoices[0]->created_at) && !empty($invoices[0]->created_at)) ? $invoices[0]->created_at : "";
			 
$header = "<!DOCTYPE html>
			<html>
			<head>
			  

				<title>Voucher ID : ".$vocher_no." </title>
				<style>
					*{
						padding:1px;
						margin:0px;
						font-family: 'Courier';
						font-size:12px;
					}
				</style>
			</head>
			<body>
				<div style='border:1px solid #aaa;padding:10px;margin:30px;'>
				<center><p style='font-size:20px;padding-top:0px;'>INVOICE</p></center>
				<table style='width:100%'>
					<tr>
						<td style='padding:15px;'>
							<p style='margin-top:5px;font-size:17px;'>".$company_details->name."</p>
							<p style='margin-top:5px;'>".$company_details->address."</p>
						 </td>
						<td style='text-align: right;padding:15px;'>
							<p style='margin-top:5px;'><img src='./datas/temp/phone-icon.PNG' style='width:12px;'> +91 ".$company_details->phone." </p>
							<p style='margin-top:5px;'><img src='./datas/temp/email-icon.PNG' style='width:12px;'> ".$company_details->email." </p>
							<br>
						</td>
					</tr>
				</table>";
				
$header .= "<table style='width:100%;margin-top:-10px;'>
				<tr>
					<td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'>  Company Name : ".$company_name." </td>
					<td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Vocher No  : ".$vocher_no."</td>
					<td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Date  : ".($vouchar_date)."</td>
				</tr>
			</table>";                              	
								
			$insurance_data = $this->rm->get_insurance_company($insurance);

            $insurance_1 = $this->rm->get_single_insurance_company($insurance);
            
            if($insurance_1 != NULL || $insurance_1 !="")
            {
                $code = $insurance_1->vchaccid;
            }
            else
            {
                $code=  "";
            }
            
            
            $content = $header;
            
            
                       
            $total_amt = $total_cnt = 0;$policylist = [];
            foreach($invoices as $row) {
                $policy_type = trim($row->polic_type);
                if(!isset($policylist[$policy_type])){
                    $policylist[$policy_type] = 0;
                    $policycount[$policy_type] = 1;
                }
                
                $policylist[$policy_type] += (float)$row->own_commission;
                $policycount[$policy_type] += 1;
                $total_amt += (float)$row->own_commission;
                $total_cnt += 1;
            }
            
            $content .= "<table style='width:100%;margin-top:10px;'>
							<tr>
								<td style='background-color:#dff0d8;width:10%;text-align: center;'>Sl.No</td>
								<td style='background-color:#dff0d8;width:10%;text-align: center;'>Policy Type</td>
								<td style='background-color:#dff0d8;width:20%;text-align: center;'>Policy no</td>
								<td style='background-color:#dff0d8;width:10%;text-align: center;'>Commisison</td>
							</tr>";
                        
            if(isset($policylist) && !empty($policylist)){
                $sl = 1;
                foreach($policylist as $policy_name => $policy_amt){
                    $policy_count = (isset($policycount[$policy_name]) && !empty($policycount[$policy_name])) ? $policycount[$policy_name] : 0;
                    $content .= "<tr>";
                        $content .= "<td style='padding:3px;text-align: left;'>".($sl++)."</td>";
                        $content .= "<td style='padding:3px;text-align: left;'>".$policy_name."</td>";
                        $content .= "<td style='padding:3px;text-align: right;'>".$policy_count."</td>";
                        $content .= "<td style='padding:3px;text-align: right;'>".$policy_amt."</td>";
                    $content .= "</tr>";
                }
            }
            
            $content .="<tr>
                            <td colspan='2' style='padding:5px;text-align:right' ><b>Total</b></td>
                            <td style='padding:5px;text-align:right'><b>".number_format(floor($total_cnt))."</b></td>
                            <td style='padding:5px;text-align:right'><b>".number_format(floor($total_amt),2)."</b></td>
                            </tr>";
            $content .="</tbody></table><br>";
            
			$footer = "<table style='width:100%;'>
							<tr>
								<td style='width:33%;padding:5px;text-align: left;'><b> Accountant </b></td>
								<td style='width:33%;padding:5px;text-align: left;'> <b>Verified By </b></td>
								<td style='width:33%;padding:5px;text-align: right;'><b>Passed By</b></td>
							</tr>
						</table>";
							
			$content .= $footer;
			$content .='<p style="page-break-after:always;></p>';
			
			$content .= $header;	
            $content .='<h4>Invoice Breakup List<br/>';
            
            $content .="<table style='width:100%;margin-top:10px;' class='table table-condensed'>
                        <thead>
                            <tr>
                                  <th style='background-color:#dff0d8;width:30%;text-align: center;'>Sl.No.</th>
                                  <th style='background-color:#dff0d8;width:40%;text-align: center;'>Policy Type</th>
                                  <th style='background-color:#dff0d8;width:40%;text-align: center;'>Policy No</th>
                                  <th style='background-color:#dff0d8;width:30%;text-align:right'>Own Commisison</th>
                            </tr>
                        </thead>
                        <tbody>";
            
            if(isset($invoices) && !empty($invoices)) {
                $sl = 1;
                foreach( $invoices as $invoice ) {
                    $content .= "<tr>";
                        $content .= "<td style='text-align:center'>".($sl++)."</td>";
                        $content .= "<td style='text-align:left'>".trim($invoice->polic_type)."</td>";
                        $content .= "<td style='text-align:left'>".trim($invoice->policy_no)."</td>";
                        $content .= "<td style='text-align:right'>".$invoice->own_commission."</td>";
                    $content .= "</tr>";
                }
                $content .="</tbody><tfoot>";
                $content .="<tr>
                            <td></td>
                            <td></td>
                            <td style='text-align:right'><b>Total : </b></td>
                            <td style='text-align:right'><b>".number_format(floor($total_amt),2)."</b></td>
                            </tr>";
                $content .="</tfoot></table><br>";
            }
            
            $content .= $footer;
        
        //echo $content;
        
        
        $date= new DateTime();
        
        $this->load->library('pdf');
                
        $this->pdf->loadHtml($content);
        $this->pdf->render();
        $directory = FCPATH . "datas/company_invoice_pdf/{$org_txt}/";
        
        if(!is_dir($directory)){
            mkdir($directory, 0777, true);
        }
        $filename = $vocher_no.".pdf";
        
        $filename = str_replace("/", "-", $filename);
        
        file_put_contents($directory.$filename, $this->pdf->output());
        
        if(file_exists($directory.$filename)){
            echo json_encode(['status' => 'true','file' => base_url()."datas/company_invoice_pdf/{$org_txt}/".$filename]);
        } else {
            echo json_encode(['status' => 'false','file' => base_url()."datas/company_invoice_pdf/{$org_txt}/".$filename]);
        }
    }
    
    public function company_invoice_pdf() {
        if(!$this->session->has_userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        
        if(!$this->auth->can_access('Export Company Invoice Report')){
            redirect('access_denied', 'refresh');
        }
        
        $vocher_no = $this->input->get("voucher_no");
        
        $company_details = $this->rm->get_company_details();
        
        $org = 1; $org_txt = 'jan';
        if($this->session->userdata('session_company_type') == "unicorn"){
        	$company_details->name = "UNICORN";
        	$org = 2;$org_txt = 'uni';
        }
        
        $policy_type = [];
        
        $this->load->model('invoice_model', 'invoiceModel');
        $this->load->model('invoice_orc_model', 'invoiceorcModel');
        if($org == 1)
            $_invoices = $this->invoiceModel->getInvoiceByVoucher($vocher_no);
        else
            $_invoices = $this->invoiceorcModel->getInvoiceByVoucher($vocher_no);
        
        $invoice_no = $invoice_date = "";
        
        $invoice_no = (isset($_invoices['invno']) && !empty($_invoices['invno'])) ? $_invoices['invno'] : "";
        
        if($invoice_no && (isset($_invoices['revno']) && !empty($_invoices['revno']))) {
            $invoice_no .= "/R{$_invoices['revno']}";
        }
        
        if((isset($_invoices['revdate']) && !empty($_invoices['revdate']))) {
            $date = new DateTime($_invoices['revdate']);
            $invoice_date = $date->format('d.m.Y');
        }

        $invoices = $this->rm->getCompanyinvoice($insurance = '',$from_date='',$to_date='',$policy_class='',$org, $vocher_no, '');
        
        //echo $this->db->last_query();
        
        $company_name = (isset($invoices[0]->company_name) && !empty($invoices[0]->company_name)) ? trim($invoices[0]->company_name) : "";
        
        $insurer_id = (isset($invoices[0]->insurer_id) && !empty($invoices[0]->insurer_id)) ? trim($invoices[0]->insurer_id) : "";
        
        $vouchar = (isset($invoices[0]->invvouchar) && !empty($invoices[0]->invvouchar)) ? trim($invoices[0]->invvouchar) : "";
        
        $vouchar_date = (isset($invoices[0]->created_at) && !empty($invoices[0]->created_at)) ? $invoices[0]->created_at : "";
			 
		
		
/*$header1 = "<!DOCTYPE html>
			<html>
			<head>
			  

				<title>Voucher ID : ".$vocher_no." </title>
				<style>
					*{
						padding:1px;
						margin:0px;
						font-family: 'Courier';
						font-size:12px;
					}
				</style>
			</head>
			<body>
				<div style='border:1px solid #aaa;padding:10px;margin:30px;'>
				<center><p style='font-size:20px;padding-top:0px;'>INVOICE</p></center>
				<table style='width:100%'>
					<tr>
						<td style='padding:15px;'>
							<p style='margin-top:5px;font-size:17px;'>".$company_details->name."</p>
							<p style='margin-top:5px;'>".$company_details->address."</p>
						 </td>
						<td style='text-align: right;padding:15px;'>
							<p style='margin-top:5px;'><img src='./datas/temp/phone-icon.PNG' style='width:12px;'> +91 ".$company_details->phone." </p>
							<p style='margin-top:5px;'><img src='./datas/temp/email-icon.PNG' style='width:12px;'> ".$company_details->email." </p>
							<br>
						</td>
					</tr>
				</table>";*/
				
				$invoiceTable  = "";
				    
				//$invoiceTable .= "<tr><td>1</td></tr>";


				
/*$header .= "<table style='width:100%;margin-top:-10px;'>
				<tr>
					<td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'>  Company Name : ".$company_name." </td>
					<td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Vocher No  : ".$vocher_no."</td>
					<td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Date  : ".($vouchar_date)."</td>
				</tr>
			</table>"; */                             	
								
			$insurance_data = ($insurer_id) ? $this->rm->get_insurance_company($insurer_id) : [];
			
			

            $insurance_1 = $this->rm->get_single_insurance_company($insurance);
            
            if($insurance_1 != NULL || $insurance_1 !="")
            {
                $code = $insurance_1->vchaccid;
            }
            else
            {
                $code=  "";
            }
            
            
            
            
            
                       
            $total_amt = $total_cnt = 0;$policylist = [];
            foreach($invoices as $row) {
                $policy_type = trim($row->polic_type);
                if(!isset($policylist[$policy_type])){
                    $policylist[$policy_type] = 0;
                    $policycount[$policy_type] = 0;
                }
                
                $policylist[$policy_type] += (float)$row->own_commission;
                $policycount[$policy_type] += 1;
                $total_amt += (float)$row->own_commission;
                $total_cnt += 1;
            }
            
            $invoiceTable .= "
							<tr>
								<td colspan='1' style='background-color:#dff0d8;width:10%;text-align: center;'>Sl.No</td>
								<td colspan='6' style='background-color:#dff0d8;width:10%;text-align: center;'>Policy Type</td>
								<td colspan='1' style='background-color:#dff0d8;width:20%;text-align: center;'>Policy Nos</td>
								<td colspan='1' style='background-color:#dff0d8;width:20%;text-align: center;'>Tax</td>
								<td colspan='1' style='background-color:#dff0d8;width:10%;text-align: center;'>Commisison</td>
							</tr>";
                        
            if(isset($policylist) && !empty($policylist)){
                $sl = 1;
                foreach($policylist as $policy_name => $policy_amt){
                    $policy_count = (isset($policycount[$policy_name]) && !empty($policycount[$policy_name])) ? $policycount[$policy_name] : 0;
                    $invoiceTable .= "<tr>";
                        $invoiceTable .= "<td colspan='1' style='padding:3px;text-align: left;'>".($sl++)."</td>";
                        $invoiceTable .= "<td colspan='6' style='padding:3px;text-align: left;'>".$policy_name."</td>";
                        $invoiceTable .= "<td colspan='1' style='padding:3px;text-align: right;'>".$policy_count."</td>";
                        $invoiceTable .= "<td colspan='1' style='padding:3px;text-align: right;'>&nbsp;</td>";
                        $invoiceTable .= "<td colspan='1' style='padding:3px;text-align: right;'>".$policy_amt."</td>";
                    $invoiceTable .= "</tr>";
                }
                
                $invoiceTable .="<tr>
                                    <td colspan='1' style='padding:5px;text-align:right'></td>
                                    <td colspan='6' style='padding:5px;text-align:right'></td>
                                    <td colspan='1' style='padding:5px;text-align:right'><b>".number_format(floor($total_cnt))."</b></td>
                                    <td colspan='1' style='padding:5px;text-align:right'><b>Total</b></td>
                                    <td colspan='1' style='padding:5px;text-align:right'><b>".number_format(floor($total_amt),2)."</b></td>
                                </tr>";
                
                $cgst_percent = $sgst_percent = 9; $igst_percent = 0;
                $cgst_amt = $total_amt * $cgst_percent / 100;
                $sgst_amt = $total_amt * $sgst_percent / 100;
                $igst_amt = $total_amt * $igst_percent / 100;
                
                $taxinfo = [
                    ['tax_name' => 'CGST', 'tax_percent' => $cgst_percent, 'tax_amt' => $cgst_amt],
                    ['tax_name' => 'SGST', 'tax_percent' => $sgst_percent, 'tax_amt' => $sgst_amt],
                    ['tax_name' => 'IGST', 'tax_percent' => $igst_percent, 'tax_amt' => $igst_amt],
                ];
                
                if( isset( $taxinfo ) && !empty( $taxinfo ) ){
                    $tax_total = 0;
                    //$invoiceTable .="<tr style='height: 10px;'><td colspan='10'></td></tr>";
                    foreach( $taxinfo as $_tax ){
                        $invoiceTable .="<tr>
                                            <td colspan='1' style='padding:5px;text-align:right'></td>
                                            <td colspan='6' style='padding:5px;text-align:right'></td>
                                            <td colspan='1' style='padding:5px;text-align:right'><b>".$_tax['tax_name']."</b></td>
                                            <td colspan='1' style='padding:5px;text-align:right'><b>".$_tax['tax_percent']."% </b></td>
                                            <td colspan='1' style='padding:5px;text-align:right'><b>".number_format(floor($_tax['tax_amt']),2)."</b></td>
                                        </tr>";
                        $tax_total += floor($_tax['tax_amt']);
                    }
                    $grand_total = floor($total_amt) + $tax_total;
                    $invoiceTable .="<tr>
                                        <td colspan='1' style='padding:5px;text-align:right'></td>
                                        <td colspan='6' style='padding:5px;text-align:right'></td>
                                        <td colspan='1' style='padding:5px;text-align:right'></td>
                                        <td colspan='1' style='padding:5px;text-align:right'><b> Total </b></td>
                                        <td colspan='1' style='padding:5px;text-align:right'><b>".number_format($grand_total,2)."</b></td>
                                    </tr>";
                }
                
                $this->load->library('numbertowords');
                $invoiceTable .="<tr>
                                    <td colspan='1' style='padding:5px;text-align:right'></td>
                                    <td colspan='9' style='padding:5px;text-align:center'>Amount in Words : ".$this->numbertowords->getIndianCurrency($grand_total)."</td>
                                </tr>";
            }
            
            
            // $invoiceTable .="</tbody></table><br>";
            
            
            
$header = "<!DOCTYPE html>
			<html>
			<head>
				<title>Voucher ID : ".$vocher_no." </title>
				<style>
				    table, td, th {
                      border: 1px solid;
                    }
                    
                    table {
                      width: 100%;
                      border-collapse: collapse;
                    }
					.fontsize{
						padding:1px;
						margin:0px;
						font-family: 'Courier';
						font-size:12px;
					}
					.no-border {
                    border: none !important;
                  }
                  tr {
                      height: 25px;
                  }
				</style>
			</head>
			<body>
			<img src='http://jayanthainsurance.com/datas/icons/jayantha-logo2.png'>";
			
		$invoiceheader ="<table class='fontsize'>
				    <tr>
				    <td colspan='3' style='width:30%;'>Name : </td><td colspan='7' style='width:80%;'>".$company_details->name."</td>
				    </tr>
				    <tr>
				    <td colspan='3' >GST No (if applicable) : </td><td colspan='7'>".$company_details->gst_no."</td>
				    </tr>
				    <tr>
				    <td colspan='3' >PAN : </td><td colspan='7'>".$company_details->pan."</td>
				    </tr>
				    
				    <tr>
				    <td colspan='10'><b>TAX INVOICE</b></td>
				    </tr>
				    
				    <tr>
				    <td colspan='3'>Name of recipient (".$insurance_data->short_name.") :</td>
				    <td colspan='7'>".$insurance_data->company_name."</td>
				    </tr>
				    <tr>
				    <td colspan='3'>Address of the Respective state) :</td>
				    <td colspan='7'>".$insurance_data->states."</td>
				    </tr>
				    <tr>
				    <td colspan='3'>Address 1 :</td>
				    <td colspan='7'>".$insurance_data->address1."</td>
				    </tr>
				    <tr>
				    <td colspan='3'>Address 2 :</td>
				    <td colspan='7'>".$insurance_data->address2."</td>
				    </tr>
				    
				    <tr>
				    <td colspan='3'>City :</td>
				    <td colspan='4'>".$insurance_data->city."</td>
				    <td style='width:15%;'>Invoice No.</td>
				    <td colspan='2'>".$invoice_no."</td>
				    </tr>
				    <tr>
				    <td colspan='3'>Pincode :</td>
				    <td colspan='4'>".$insurance_data->pincode."</td>
				    <td style='width:15%;'>Date</td>
				    <td colspan='2'>".$invoice_date."</td>
				    </tr>
				    <tr>
				    <td colspan='3'>GST No of the recipent (".$insurance_data->short_name."): </td>
				    <td colspan='7'>".$insurance_data->gstno."</td>
				    </tr>
				    {$invoiceTable}
				</table>";
            
			$footer = "<table style='width:100%;'>
							<tr>
								<td style='width:33%;padding:5px;text-align: left;'><b> Accountant </b></td>
								<td style='width:33%;padding:5px;text-align: left;'> <b>Verified By </b></td>
								<td style='width:33%;padding:5px;text-align: right;'><b>Passed By</b></td>
							</tr>
						</table>";
						
			$content = $header;
			
			$content .= $invoiceheader;
							
			
			//$content .= $footer;
			
			
			$content .='<p style="page-break-after:always;></p>';
			
			$content .= $header;	
            $content .='<h4>Invoice Breakup List<br/>';
            
            $content .="<table class='fontsize'>
                        <thead>
                            <tr>
                                  <th colspan='1' style='background-color:#dff0d8;width:30%;text-align: center;'>Sl.No.</th>
                                  <th colspan='4' style='background-color:#dff0d8;width:40%;text-align: center;'>Policy Type</th>
                                  <th colspan='3' style='background-color:#dff0d8;width:40%;text-align: center;'>Policy No</th>
                                  <th colspan='2' style='background-color:#dff0d8;width:30%;text-align:right'>Own Commisison</th>
                            </tr>
                        </thead>
                        <tbody>";
            
            if(isset($invoices) && !empty($invoices)) {
                $sl = 1;
                foreach( $invoices as $invoice ) {
                    $content .= "<tr>";
                        $content .= "<td colspan='1' style='width:5%;text-align:center'>".($sl++)."</td>";
                        $content .= "<td colspan='4' style='text-align:left'>".trim($invoice->polic_type)."</td>";
                        $content .= "<td colspan='3' style='text-align:left'>".trim($invoice->policy_no)."</td>";
                        $content .= "<td colspan='2' style='text-align:right'>".$invoice->own_commission."</td>";
                    $content .= "</tr>";
                }
                $content .="</tbody><tfoot>";
                $content .="<tr>
                            <td colspan='1'></td>
                            <td colspan='4'></td>
                            <td colspan='3' style='text-align:right'><b>Total : </b></td>
                            <td colspan='2' style='text-align:right'><b>".number_format(floor($total_amt),2)."</b></td>
                            </tr>";
                $content .="</tfoot></table><br>";
            }
            
            $content .= $footer;
        
        //echo $content;
        
        
        $date= new DateTime();
        
        $this->load->library('pdf');
                
        $this->pdf->loadHtml($content);
        $this->pdf->render();
        $directory = FCPATH . "datas/company_invoice_pdf/{$org_txt}/";
        
        if(!is_dir($directory)){
            mkdir($directory, 0777, true);
        }
        $filename = $vocher_no.".pdf";
        
        $filename = str_replace("/", "-", $filename);
        
        file_put_contents($directory.$filename, $this->pdf->output());
        
        if(file_exists($directory.$filename)){
            echo json_encode(['status' => 'true','file' => base_url()."datas/company_invoice_pdf/{$org_txt}/".$filename]);
        } else {
            echo json_encode(['status' => 'false','file' => base_url()."datas/company_invoice_pdf/{$org_txt}/".$filename]);
        }
    }
     
     
   public function company_vocher_pdf()
     {
         if($this->session->has_userdata('logged_in')) 
         { 
             $this->load->library('pdf');
             $vocher_no = $this->input->get("voucher_no");
             $date= new DateTime();
             
             $vocher_number = $this->rm->get_voucher_details($vocher_no);
             
             
            
                $policy_type = [];
            $vno = '';
             foreach($vocher_number as $da1)
             {
                 if(!in_array(trim($da1->polic_type),$policy_type))
                 {
                    array_push($policy_type,trim($da1->polic_type)); 
                 }
                 
                 $vno = $da1->insurer_id;
             } 


             $company_details = $this->rm->get_company_details();

             if($this->session->userdata('session_company_type') == "unicorn"){
                 $company_details->name = "UNICORN";

             }

                 
                $content = "<!DOCTYPE html>
                            <html>
                            <head>
                                <title>Voucher ID : ".$vocher_no." </title>
                                <style>
                                    *{
                                        padding:1px;
                                        margin:0px;
                                        font-family: 'Courier';
                                        font-size:12px;
                                    }
                                </style>
                            </head>
                            <body>
                                <div style='border:1px solid #aaa;padding:10px;margin:30px;'>
                                <center><p style='font-size:20px;padding-top:0px;'>INVOICE</p></center>
                                <table style='width:100%'>
                                    <tr>
                                        <td style='padding:15px;'>
                                            <p style='margin-top:5px;font-size:17px;'>".$company_details->name."</p>
                                            <p style='margin-top:5px;'>".$company_details->address."</p>
                                         </td>
                                        <td style='text-align: right;padding:15px;'>
                                            <p style='margin-top:5px;'><img src='./datas/temp/phone-icon.PNG' style='width:12px;'> +91 ".$company_details->phone." </p>
                                            <p style='margin-top:5px;'><img src='./datas/temp/email-icon.PNG' style='width:12px;'> ".$company_details->email." </p>
                                            <br>
                                        </td>
                                    </tr>
                                </table>";
                                
                                
                    $content .= "<table style='width:100%;margin-top:-10px;'>
                                    <tr>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'>  Company Name : ".$vno." </td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Vocher No  : ".$vocher_no."</td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Date  : ".($date->format("d-m-Y"))."</td>
                                    </tr>";
                              
                    $content .= "</table>";
                    
                    
                        $content .= "<table style='width:100%;margin-top:10px;'>
                                    <tr>
                                         <td style='background-color:#dff0d8;width:10%;text-align: center;'>Policy Type</td>
                                        <td style='background-color:#dff0d8;width:20%;text-align: center;'>Policy no</td>
                                        <td style='background-color:#dff0d8;width:10%;text-align: center;'>Commisison</td>
                                    </tr>";
                                    
    $tot_own_commission =0;                                    
                                    
     foreach($policy_type as $pt)
            {
                $own_commission =0;
                $policy_count =0;
                $policynoof =0;
               
                
                  foreach($vocher_number as $da)
                 {

                  if($pt == trim($da->polic_type))
                  {
                      $policy_count++;
                      
                   $own_commission = $own_commission + $da->amount;
                   
                   $policynoof = $policynoof + $da->noof;
                   
                   $tot_own_commission  =$own_commission + $tot_own_commission;
                   
                   
                   }
            
                 }
            
                       $content .= "<tr>
                                        <td style='padding:3px;text-align: left;'>".$pt."  </td>
                                        <td style='padding:3px;text-align: left;'>".$policynoof."  </td>
                                        <td style='padding:3px;text-align: right;'>".number_format(floor($own_commission),2)."</td>
                                    </tr> ";
             }
            
             
                $content .= "<table><tr>
                                    <td style='padding:5px;text-align: left;width:50%;'>Total Commission</td>
                                    <td style='padding:5px;text-align: left;'> : </td>
                                    <td style='padding:5px;text-align: right;'>".number_format(floor($tot_own_commission),2)."</td>
                                </tr>";

            
   
                        $content .= "<br><table style='width:100%;'>
                                    <tr>
                                        <td style='width:33%;padding:5px;text-align: left;'><b> Accountant </b></td>
                                        <td style='width:33%;padding:5px;text-align: left;'> <b>Verified By </b></td>
                                        <td style='width:33%;padding:5px;text-align: right;'><b>Passed By</b></td>
                                    </tr>
                                </table>";
                                
                                
                                
                                
                        
                   
                      $content .= "</body>
                                 </html>";
            	
            	//echo $content;
            	
            	
        	    
            	

        $this->load->library('pdf');
            	$this->pdf->loadHtml($content);
            	$this->pdf->render();
            	$filename = "Voucher('".$vocher_no."')";
            	$this->pdf->stream("'$filename'".".pdf", array("Attachment" => false));
            	

         }
     }
     
    public function company_vocher_orc_pdf()
    {
         if($this->session->has_userdata('logged_in')) 
         { 
             $this->load->library('pdf');
             $vocher_no = $this->input->get("voucher_no");
             $date= new DateTime();
             
             $vocher_number = $this->rm->get_voucher_orc_details($vocher_no);
      

            $policy_type = [];
            $vno = '';
            
            
             foreach($vocher_number as $da1)
             {
                 if(!in_array(trim($da1->polic_type),$policy_type))
                 {
                    array_push($policy_type,trim($da1->polic_type)); 
                 }
                 
                 $vno = $da1->insurer_id;
             } 


             $company_details = $this->rm->get_company_details();

             if($this->session->userdata('session_company_type') == "unicorn"){
                 $company_details->name = "UNICORN";

             }

                 
                $content = "<!DOCTYPE html>
                            <html>
                            <head>
                                <title>Voucher ID : ".$vocher_no." </title>
                                <style>
                                    *{
                                        padding:1px;
                                        margin:0px;
                                        font-family: 'Courier';
                                        font-size:12px;
                                    }
                                </style>
                            </head>
                            <body>
                                <div style='border:1px solid #aaa;padding:10px;margin:30px;'>
                                <center><p style='font-size:20px;padding-top:0px;'>INVOICE</p></center>
                                <table style='width:100%'>
                                    <tr>
                                        <td style='padding:15px;'>
                                            <p style='margin-top:5px;font-size:17px;'>".$company_details->name."</p>
                                            <p style='margin-top:5px;'>".$company_details->address."</p>
                                         </td>
                                        <td style='text-align: right;padding:15px;'>
                                            <p style='margin-top:5px;'><img src='./datas/temp/phone-icon.PNG' style='width:12px;'> +91 ".$company_details->phone." </p>
                                            <p style='margin-top:5px;'><img src='./datas/temp/email-icon.PNG' style='width:12px;'> ".$company_details->email." </p>
                                            <br>
                                        </td>
                                    </tr>
                                </table>";
                                
                                
                    $content .= "<table style='width:100%;margin-top:-10px;'>
                                    <tr>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: left;'>  Company Name : ".$vno." </td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Vocher No  : ".$vocher_no."</td>
                                        <td style='background-color:#dff0d8;width:25%;padding:5px;text-align: right;'>Date  : ".($date->format("d-m-Y"))."</td>
                                    </tr>";
                              
                    $content .= "</table>";
                    
                    
                        $content .= "<table style='width:100%;margin-top:10px;'>
                                    <tr>
                                         <td style='background-color:#dff0d8;width:10%;text-align: center;'>Policy Type</td>
                                        <td style='background-color:#dff0d8;width:20%;text-align: center;'>Policy no</td>
                                        <td style='background-color:#dff0d8;width:10%;text-align: center;'>Commisison</td>
                                    </tr>";
                                    
    $tot_own_commission =0;                                    
                                    
     foreach($policy_type as $pt)
            {
                $own_commission =0;
                $policy_count =0;
                $policynoof =0;
               
                
                  foreach($vocher_number as $da)
                 {

                  if($pt == trim($da->polic_type))
                  {
                      $policy_count++;
                      
                   $own_commission = $own_commission + $da->amount;
                   
                   $policynoof = $policynoof + $da->noof;
                   
                   $tot_own_commission  =$own_commission + $tot_own_commission;
                   
                   
                   }
            
                 }
            
                       $content .= "<tr>
                                        <td style='padding:3px;text-align: left;'>".$pt."  </td>
                                        <td style='padding:3px;text-align: left;'>".$policynoof."  </td>
                                        <td style='padding:3px;text-align: right;'>".number_format(floor($own_commission),2)."</td>
                                    </tr> ";
             }
            
             
                $content .= "<table><tr>
                                    <td style='padding:5px;text-align: left;width:50%;'>Total Commission</td>
                                    <td style='padding:5px;text-align: left;'> : </td>
                                    <td style='padding:5px;text-align: right;'>".number_format(floor($tot_own_commission),2)."</td>
                                </tr>";

            
   
                        $content .= "<br><table style='width:100%;'>
                                    <tr>
                                        <td style='width:33%;padding:5px;text-align: left;'><b> Accountant </b></td>
                                        <td style='width:33%;padding:5px;text-align: left;'> <b>Verified By </b></td>
                                        <td style='width:33%;padding:5px;text-align: right;'><b>Passed By</b></td>
                                    </tr>
                                </table>";
                                
                                
                                
                                
                        
                   
                      $content .= "</body>
                                 </html>";
            	
            	//echo $content;
            	
            	
        	    
            	

        $this->load->library('pdf');
            	$this->pdf->loadHtml($content);
            	$this->pdf->render();
            	$filename = "Voucher('".$vocher_no."')";
            	$this->pdf->stream("'$filename'".".pdf", array("Attachment" => false));
            	

         }
     }
          
     
     
     function download($file)
     {
         // get the file mime type using the file extension
        $this->load->helper('file');

        $mime = get_mime_by_extension($file);
        
        $name="Invoice";

        // Build the headers to push out the file properly.
        header('Pragma: public');     // required
        header('Expires: 0');         // no cache
        header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
        header('Last-Modified: '.gmdate ('D, d M Y H:i:s', filemtime ($file)).' GMT');
        header('Cache-Control: private',false);
        header('Content-Type: '.$mime);  // Add the mime type from Code igniter.
        header('Content-Disposition: attachment; filename="'.basename($name).'"');  // Add the file name
        header('Content-Transfer-Encoding: binary');
        header('Content-Length: '.filesize($file)); // provide file size
        header('Connection: close');
        readfile($file); // push it out
        
        
        
            	
        exit();
     }
     

     
     public function company_vocher_excel()
     {
         $this->load->library('excel');
         $vocher_no = $this->input->get("voucher_no");
         $date= new DateTime();
         
         $orc_vocher_no = $this->rm->get_voucher_details_report($vocher_no);
         
         
            $this->load->library('Excel');
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            
            $rowCount = 4;
            
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
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
            $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'JAYANTHA INSURANCE');
            
            $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'Insurance Invoice Generation');
            
            $objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray(
            		array(
            			'font'  => array(
            				'bold'  => true,
            				'color' => array('rgb' => 'e6e600'),
            				'size'  => 18,
            			),
            		)
            	);
            	$objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray(
            		array(
            			'font'  => array(
            				'bold'  => true,
            				'color' => array('rgb' => '00cc66'),
            				'size'  => 14,
            			),
            		)
            	);
            	
        $objPHPExcel->getActiveSheet()->SetCellValue('E3',"INVOICE DATE");
        $objPHPExcel->getActiveSheet()->SetCellValue('F3', $date->format("d-m-Y"));
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
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Policy NO');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Lead ID');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'vechi register no');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Policy Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'OWN commission');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Vocher Number');

        
            $row_count = 5;
            $a = 0;
            
       
             foreach($orc_vocher_no as $da)
             {
        	        $a++;
                 
                 
        	    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->policy_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->lead_id);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->vechi_register_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , $da->polic_type);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $da->own_commission);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->voucher_no);
                
                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
             }
             
             $res = [];
             
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter->save('./datas/reports/invoice_generation_report.xlsx');
            echo base_url()."/datas/reports/invoice_generation_report.xlsx";
     
        
     }
     
     public function fetch_agent_poilicy_list()
     {
        if($this->session->has_userdata('logged_in')) 
        {
        $from_date  = $this->input->post("from_date");
        $to_date = $this->input->post("to_date");
    
        //$res = $this->rm->fetch_agent_poilicy_list($from_date,$to_date);
        $res = $this->rm->fetch_agentlist($from_date,$to_date);
        //echo $this->db->last_query();
        $content = "<option value = ''>--Select--</option>";
              
              foreach($res as $da)
              {
                  $content .="<option value=".$da->id.">".$da->name .' - '.$da->agent_pos_code."</option>";
              }
              
              echo $content;
       
       
       }
       
     }
     
     
    public function fetch_all_policy_list()
    {
        if($this->session->has_userdata('logged_in')) 
        {
            $from_date  = $this->input->post("from_date");
            $to_date    = $this->input->post("to_date");
            $agent      = $this->input->post('agent');
            $company    = $this->input->post('company');
            $user       = $this->input->post('user');
            $code       = "";
            
            if( isset( $agent ) && !empty( $agent ) ){
                $agent_code = $this->rm->get_single_agent_code($agent);
                $code       = (isset($agent_code->agent_pos_code) && !empty($agent_code->agent_pos_code) ) ? $agent_code->agent_pos_code : "";
            }
        
            // $res = $this->rm->fetch_all_policy_list($from_date,$to_date);
            // $res1 = $this->rm->fetch_all_policy_list_orc($from_date,$to_date);
        
            // $this->fetch_policy_list_table($res,$res1);
            
            if($from_date && $to_date) {
                $result = $this->rm->getAgentCommission($from_date, $to_date, $agent, $company, $user);       
                
                $this->_fetch_policy_list_table($result, $code);
            }
        } else {
            redirect('login', 'refresh');    
        }
    }
    
    public function _fetch_policy_list_table($result, $code = '')
	{
	    if(!$this->session->has_userdata('logged_in')) {
	        redirect('login', 'refresh');
	    }
	    
        $content    = "";
        $txt        = "AGENT : All";
        $agent_td   = $empty_td = '';

        if( $code ){
            $txt        = "AGENT Code : ".$code;
        } else {
            $agent_td   = '<td>Agent Name</td>';
            $empty_td   = "<td></td>";
        }

        $content .="<table class='table' border='0'>
                        <tr>
                            <td style='font-size:16px;'>".$txt."</td>
                            <td style='font-size:16px;'>Total no policies : ".count($result)."</td>
                        </tr>
                    </table>";
            
        $content .="<table class='table table-bordered' id='policy_list'>
                        <thead>
                            <tr>
                                <td>
                                    #
                                </td>
                                ".$agent_td."
                                <td>Policy No</td>
                                <td>Insurer</td>
                                <td>Customer Name</td>
                                <td>Commisison</td>                        
                            </tr>
                        </thead>
                        <tbody>";
        $total_ird = 0;
        $total_additional = 0;
        $tot_agent_commission = 0;
        $agent_debit = 0;
        $tot_tds = 0;

        if( isset( $result ) && !empty( $result ) ){
            $sl = 1;
            foreach( $result as $row  ){
                // 2023-06-10
                $class = "nospl";
                if($row->special_com != "null" && $row->special_com){
                    $class = ($row->applied_splcommission == "N") ? "nospl" : "spl";
                }
                
                if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") {
                    $agent_commission     = (isset($row->agent_commission_amt) && $row->agent_commission_amt != '') ? $row->agent_commission_amt : 0;
                    $tot_agent_commission = $tot_agent_commission + $agent_commission;
                } else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn") {
                    if(isset($row->agent_commission) && $row->agent_commission != "")
                        $agent_commission     = $row->agent_commission;
                    if(isset($row->additional_commission) && $row->additional_commission != "")
                        $agent_commission     = $agent_commission + $row->additional_commission;
                    if(isset($row->agn_add_com) && $row->agn_add_com != "")
                        $agent_commission     = $agent_commission + $row->agn_add_com;
                    
                    $tot_agent_commission = $tot_agent_commission + $agent_commission;
                }
                $content .="<tr>
                            <td class='".$class."'>
                                <input type='hidden' class='check' value='".$row->id."'>
                                ".($sl++)."
                            </td>";
                if(empty($code))
                    $content .= "<td class='".$class."'>".$row->agent_name."</td>";
                    
                $content .="<td class='".$class."'>".$row->policy_no."</td>
                            <td class='".$class."'>".$row->company_name."</td>
                            <td class='".$class."'>".$row->client_name."</td>
                            <td class='".$class."' style='text-align:right'>".number_format(floor($agent_commission),2)."</td>";
                $content .= '</tr>';
            }
            $content .="</tbody>";
            $content .="<tfoot>
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                ".$empty_td."
                                <td><b>Total</b></td>
                                <td style='text-align:right'><b>".number_format(floor($tot_agent_commission),2)."</b></td>
                            </tr>
                        </tfoot>";                
        }
       
        $content .="</table><br>";
        if( isset( $result ) && !empty( $result ) ){
            $content .="<button type='button' class='btn btn-success pull-right' id='vocher_gen_btn' onclick='vocher()'>Generate Vocher</button>";
        }
        echo $content;
	}
     
     
     public function get_policy_data()
     {
         if($this->session->has_userdata('logged_in'))
         {
             $cancel_id = $this->input->post("id");
             $cancel_policy_status = "1";
             
             $date = array("cancel_policy_status" =>$cancel_policy_status);
             
             $this->rm->update_cancel_policy_status($date,$cancel_id);
                     
             
         }
     }
     
     public function update_policy_hold_list()
     {
        if($this->session->has_userdata('logged_in'))
         {
             $hold_id = $this->input->post("id");
             $cancel_policy_status ="2";
             
             $data = array("cancel_policy_status" =>$cancel_policy_status);
             
             $this->rm->update_policy_hold_list($data,$hold_id);
             
         }
     }
     
     public function policy_cancel_report()
     {
        if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        { 
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $this->load->view('header',$pro_data);
            $this->load->view('policy_cancel_report');
            $this->load->view('footer',$pro_data);
        }
    }
     
     
     
     
     public function fetch_policy_cancel_report()
     {
     if($this->session->has_userdata('logged_in')) 
    	{
            $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
            
            if($check_user_i->policy_view == "1")
            { 
            
            $res = $this->rm->fetch_policy_cancel_report();
            
             $fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
            
            
        $content = "";
                
                $content .="
                <table class='table table-hover table-bordered'>
                <thead>
                    <th>S.No</th>
                    <th>Customer</th>
                    <th>Agent id</th>
                    <th>Policy No</th>
                    <th>Insurer</th>
                    <th>OD</th>
                    <th>TP</th>
                    <th>Net Premium</th>
                    <th>Own Com</th>
                    <th>Agent Com</th>
                    <th style='color:red'>Add Com</th>
                    <th style='color:red'>Agn Add Com</th>
                    <th>Bussiness Type</th>
                    <th>Class</th>
                    <th>Pol Type</th>
                    <th>Action</th>
                </thead>
                <tbody>
                </tbody>";
                $a = 0;
                
                
                
                    foreach($res as $da)
                    {
                         	$a++;
                         	$additional_com = 0;
                            $agn_add_com = 0;
                            $agent_commission = 0;
                            $company_com = 0;
                            $agent_commission = 0;
                         	    
                            if($da->class == "1")
                            {
                                if($da->commission_type == "3")
                                {
                                    $total_premium = 0;
                                    
                                    $get_net_id = $this->rm->get_net_premium_id($da->net_premium_id);
                                    
                                    foreach($get_net_id as $re)
                                    {
                                        $get_total_premium = $this->rm->get_total_premium($da->net_premium_id);
                                        
                                        foreach($get_total_premium as $am)
                                        {
                                          $total_premium = $total_premium + $am->total_premium;
                                        }
                                    }
                                    
                                    foreach($get_net_id as $das)
                                    {
                                        $temp_min = $das->min_val;
                                    	$temp_max = $das->max_val;
                                    	
                                    	if($temp_min <= $total_premium && $temp_max >= $total_premium)
                                    	{
                                    		    if($das->on_net != "0")
                                                {
                                                    $company_com = $da->total_premium * ($das->on_net)/100;
                                                }
                                                else if($das->own_od != "0" && $das->own_tp != "0")
                                                {
                                                    $own_od = $da->total_own_damage * ($das->own_od)/100;
                                                    $own_tp = $da->tot_liability_premium * ($das->own_tp)/100;
                                                    $company_com = $own_od+$own_tp;
                                                }
                                                else if($das->own_od != "0")
                                                {
                                                    $company_com = $da->total_own_damage * ($das->own_od)/100;
                                                }
                                                else if($das->own_tp != "0")
                                                {
                                                    $company_com = $da->tot_liability_premium * ($das->own_tp)/100;
                                                }
                                                
                                                $additional_com = $company_com - $da->own_commission_amt - $da->own_commission;
                                                
                                                $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);
                                             
                                                  if($das->agn_com_type == "OD")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->a_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->b_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->c_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->d_od)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->a_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->b_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->c_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->d_tp)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "ON-NET")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->a_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->b_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->c_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->d_net)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "OD_AND_TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->a_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->a_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->b_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->b_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->c_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->c_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->d_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->d_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                 }
                                                 $agn_add_com = $agent_commission - $da->agent_commission_amt - $da->agent_commission;
                                    		}
                                    	}
                                    //comment
                                }
                                else if($da->commission_type == "1")
                                {
                                    $tot_policy = 0;
                                    $get_nop_id = $this->rm->get_no_of_policy_id($da->no_of_policy_id);
                                    
                                    foreach($get_nop_id as $re)
                                    {
                                        $get_total_policy = $this->rm->get_total_policy($re->id);
                                        $tot_policy = $tot_policy + count($get_total_policy) ;
                                    }
                                    
                                    foreach($get_nop_id as $das)
                                    {
                                        $temp_min = $das->no_policy_min;
                                    	$temp_max = $das->no_policy_max;
                                    	
                                    	if($temp_min <= $tot_policy && $temp_max >= $tot_policy)
                                    	{
                                    
                                    		    if($das->on_net != "0")
                                                {
                                                    $company_com = $da->total_premium * ($das->on_net)/100;
                                                }
                                                else if($das->own_od != "0" && $das->own_tp != "0")
                                                {
                                                    $own_od = $da->total_own_damage * ($das->own_od)/100;
                                                    $own_tp = $da->tot_liability_premium * ($das->own_tp)/100;
                                                    $company_com = $own_od+$own_tp;
                                                }
                                                else if($das->own_od != "0")
                                                {
                                                    $company_com = $da->total_own_damage * ($das->own_od)/100;
                                                    $own_od = $company_com;
                                                }
                                                else if($das->own_tp != "0")
                                                {
                                                    $company_com = $da->tot_liability_premium * ($das->own_tp)/100;
                                                    $own_tp = $company_com;
                                                }
                                                
                                                $additional_com = $company_com - $da->own_commission_amt - $da->own_commission;
                                                $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);
                                             
                                                  if($das->agn_com_type == "OD")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->a_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->b_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->c_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->d_od)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->a_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->b_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->c_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->d_tp)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "ON-NET")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->a_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->b_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->c_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->d_net)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "OD_AND_TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->a_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->a_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->b_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->b_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->c_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->c_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->d_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->d_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                 }
                                                 $agn_add_com = $agent_commission - $da->agent_commission_amt - $da->agent_commission;
                                    	}
                                    }	
                                }
                                else
                                {
                                      $da->agent_commission_amt;
                                      $da->own_commission_amt;
                                }
                            }
                            else
                            {
                                 $total_premium = 0;
                                 
                                $get_net_id = $this->rm->get_net_premium_id($da->net_premium_id);
                                
                                foreach($get_net_id as $re)
                                {
                                    $get_total_premium = $this->rm->get_total_premium($re->id);
                                    
                                    foreach($get_total_premium as $am)
                                    {
                                       $total_premium = $total_premium + $am->total_premium;
                                    }
                                }
                                
                                foreach($get_net_id as $das)
                                {
                                    $temp_min = $das->min_val;
                                	$temp_max = $das->max_val;
                                	
                                	if($temp_min <= $total_premium && $temp_max >= $total_premium)
                                	{
                                		    if($das->on_net != "0")
                                            {
                                                $own_od = "";
                                                $own_tp = "";
                                                $company_com = $da->total_premium * ($das->on_net)/100;
                                                $on_net = $company_com;
                                            }
                                         
                                            $additional_com = $company_com - $da->own_commission_amt - $da->own_commission;
                                            $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);
                                            
                                        
                                                  if($agent_status->commission_category == "A")
                                                  {
                                                      $agent_commission = ($da->total_premium * $das->a_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "B")
                                                  {
                                                      $agent_commission = ($da->total_premium * $das->b_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "C")
                                                  {
                                                      $agent_commission = ($da->total_premium * $das->c_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "D")
                                                  {
                                                      $agent_commission = ($da->total_premium * $das->d_net)/100;
                                                  }
                                                  
                                                  //$agn_add_com = $agent_commission - $da->agent_commission_amt - $da->agent_commission;
                                                  $agn_add_com = $agent_commission;
                                		}
                                	}
                            }
                        
                            $content .="<tr>";
                            $content .="<td>".$a."</td>";
                            $content .="<td>".$da->client_name."</td>";
                            $content .="<td>".$da->agent_pos_code."</td>";
                            $content .="<td>".$da->policy_no."</td>";
                            $content .="<td>".$da->company_name."</td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->total_own_damage,"INR")."</td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->tot_liability_premium,"INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->total_premium,"INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->own_commission_amt,"INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->agent_commission_amt,"INR")."</span></td>";
                            $content .="<td style='color:red'><span class='pull-right'>".$fmt->formatCurrency($additional_com,"INR")."</span></td>";
                            $content .="<td style='color:red'><span class='pull-right'>".$fmt->formatCurrency($agn_add_com,"INR")."</span></td>";
                            $content .="<td>".$da->business_name."</td>";
                            $content .="<td>".$da->class_name."</td>";
                            $content .="<td>".$da->policy_type."</td>";
                            $content .=" <td><button type='button' class='btn btn-info pull-right' id='recover_data_btn' onclick=recover_data(".$da->id.")> Recover</button>";
                            $content .="</tr>";
                    }
                     echo $content;
            }
            else
            {
                echo "<script>alert('Permission Dinied');window.location.href='home';</script>";
            }
    	}
     }
     
     
     public function updata_policy_recover()
     {
          if($this->session->has_userdata('logged_in'))
         {
            $id = $this->input->post("id");
            $cancel_policy_status ="0";
            
            $data = array("cancel_policy_status" =>$cancel_policy_status);
            
            $this->rm->updata_policy_recover($data,$id);  
             
         }
         
     }
     
     
     public function fetch_agent_policy_insurance_company()
     {
        if($this->session->has_userdata('logged_in')) 
        {
        $from_date  = $this->input->post("from_date");
        $to_date = $this->input->post("to_date");
    
        $res = $this->rm->fetch_agent_policy_insurance_company($from_date,$to_date);
       
        $content = "<option value = ''>--Select--</option>";
              
              foreach($res as $da)
              {
                  $content .="<option value=".$da->id.">".$da->company_name ."</option>";
              }
              
              echo $content;
       
       
       }
         
     }
     
     
      public function _export_agent_vouchar_excel()
     { 
         if($this->session->has_userdata('logged_in')) 
        {
         $this->load->library('excel');
         $from_date =  $this->input->post("from_date");
         $to_date = $this->input->post("to_date");
         $agents = $this->input->post("select_agents"); 
         
        $date= new DateTime();
         
        
        
         
         
        $org_txt = 'jan'; $table = "agent_voucher_details";
        if($this->session->userdata('session_company_type') == "unicorn"){
        	//$company_details->name = "UNICORN";
        	$org = 2;$org_txt = 'uni';$table = "agent_voucher_details_orc";
        }
         
        $res = $this->rm->get_agent_commission_bank_details($from_date,$to_date,$agents, $table);
         
            $this->load->library('Excel');
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
            
            $rowCount = 4;
            
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
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);

          
        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
     
        
        $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'S.No');
        $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Agent Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C1', ' Pos Code');
        $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Account No');
        $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'IFSC');
        $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Bank Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Branch');
        $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Pan Card');
        $objPHPExcel->getActiveSheet()->SetCellValue('I1', 'Vouchar No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'Jayantha Commission');
        $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'TDS');
        $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Net OP');

        
            $row_count = 2;
            $a = 0;
            $net_op = 0;
            
       
             foreach($res as $da)
             {
        	        $a++;
                 
                   $net_op = $net_op+ $da->tds_amt;
                 
        	    $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , trim($da->name));
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , trim($da->agent_pos_code));
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , " ".trim($da->bank_acc_no));
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , trim($da->ifsc_code));
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , trim($da->bank_name));
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , trim($da->branch));
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , trim($da->pan_card_no));
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , trim($da->voucher_no));
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row_count , trim($da->total_commission));
                $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row_count , trim($da->tds_amt));
                $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row_count , trim($da->netpay));
                
                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
             }
             
             $res = [];
             
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter->save('./datas/reports/bank_agent_commission_amount.xlsx');
            echo base_url()."/datas/reports/bank_agent_commission_amount.xlsx";
            
            $excel_status = "1";
             
             $data = array(
                    "excel_date" =>date("Y-m-d H:i:s"),
                    "from_date" =>$from_date,
                    "to_date" =>$to_date,
                    "excel_report_status" => $excel_status,
                    "creat_datetime" =>date("Y-m-d H:i:s"),
                  );
                  
                 $excel_data = $this->rm->update_excel_status($data); 
 
     }
         
        
            
        }
    
     
############################ KGK ##########

    public function export_agent_vouchar_excel()
    { 
        if($this->session->has_userdata('logged_in')) 
        {
            $from_date = $this->input->post("from_date");
            $to_date   = $this->input->post("to_date");
            $agents    = $this->input->post("select_agents"); 
        
            
            $date = new DateTime();
        
            $org = 1; $org_txt = 'Jayantha'; $table = "agent_voucher_details";
            if($this->session->userdata('session_company_type') == "unicorn"){
                $org = 2;$org_txt = 'Unicorn';$table = "agent_voucher_details_orc";
            }
        
            $res = $this->rm->get_agent_commission_bank_details($from_date,$to_date,$agents, $table);
        
            $this->load->library('Excel');
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
        
            $rowCount = 4;
        
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
            $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(35);
            $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
        
        
            $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(20);
        
        
            $objPHPExcel->getActiveSheet()->SetCellValue('A1', 'S.No');
            $objPHPExcel->getActiveSheet()->SetCellValue('B1', 'Agent Name');
            $objPHPExcel->getActiveSheet()->SetCellValue('C1', 'Pos Code');
            $objPHPExcel->getActiveSheet()->SetCellValue('D1', 'Account No');
            $objPHPExcel->getActiveSheet()->SetCellValue('E1', 'IFSC');
            $objPHPExcel->getActiveSheet()->SetCellValue('F1', 'Bank Name');
            $objPHPExcel->getActiveSheet()->SetCellValue('G1', 'Branch');
            $objPHPExcel->getActiveSheet()->SetCellValue('H1', 'Pan Card');
            $objPHPExcel->getActiveSheet()->SetCellValue('I1', $org_txt.' Commission');
            $objPHPExcel->getActiveSheet()->SetCellValue('J1', 'TDS');
            $objPHPExcel->getActiveSheet()->SetCellValue('K1', 'Net OP');
            $objPHPExcel->getActiveSheet()->SetCellValue('L1', 'Vouchar No.');
            $objPHPExcel->getActiveSheet()->SetCellValue('M1', 'Transaction No.');
            $objPHPExcel->getActiveSheet()->SetCellValue('N1', 'Transaction Date.');
            $objPHPExcel->getActiveSheet()->SetCellValue('O1', 'Source Account No.');
        
        
            $row_count = 2;
            $sl = 1;
            $net_op = 0;
        
        
            foreach($res as $da)
            {
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , ($sl++));
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , trim($da->name));
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , trim($da->agent_pos_code));
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , " ".trim($da->bank_acc_no));
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , trim($da->ifsc_code));
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , trim($da->bank_name));
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , trim($da->branch));
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , trim($da->pan_card_no));
                
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , trim($da->amount));
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row_count , trim($da->tds_amt));
                $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row_count , trim($da->netpay));
                
                $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row_count , trim($da->voucher_no));
                
                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
            }
         
            $res = [];
         
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter->save('./datas/reports/bank_agent_commission_amount.xlsx');
            echo base_url()."/datas/reports/bank_agent_commission_amount.xlsx";
        
            $excel_status = "1";
         
            $data = array(
                "excel_date"            => date("Y-m-d H:i:s"),
                "from_date"             => $from_date,
                "to_date"               => $to_date,
                "excel_report_status"   => $excel_status,
                "creat_datetime"        => date("Y-m-d H:i:s"),
                "org_id"                => $org,
                "agent_id"              => ($agents) ? $agents : 0
            );
              
            $excel_data = $this->rm->update_excel_status($data); 
        }
    }
     
    public function single_insurance_policies()
    {
        if($this->session->has_userdata('logged_in')) 
        { 
            $content = $invoice_id = "";
    	    $insurance = $this->input->post("insurance");
    	    $from_date = $this->input->post("from_date");
    	    $to_date = $this->input->post("to_date");
    	    $policy_class = $this->input->post("policy_class");
    	    $policy_gen_from = $this->input->post("policy_gen_from");
    	    $types = $this->input->post("types");
    	    
    	    $insurance_data = $this->rm->get_insurance_company($insurance);

            $insurance_1 = $this->rm->get_single_insurance_company($insurance);
            
            if($insurance_1 != NULL || $insurance_1 !="")
            {
                $code = $insurance_1->vchaccid;
            }
            else
            {
                $code=  "";
            }
            
            $this->load->model('invoice_model', 'invoiceModel');
            $this->load->model('invoice_revision_model', 'invoicerevModel');
            
            $invdata = [
                'fromdate'              => $from_date,
                'todate'                => $to_date,
                'insurance_company_id'  => $insurance,
                'status'                => 'F',
                //'class_id'              => $policy_class
            ];
            
            if( isset( $policy_class ) && !empty( $policy_class ) ){
                $invdate['class_id'] = $policy_class;
            }
            
            $invoice_id = $this->invoiceModel->getID($invdata);
            /*
            if( isset( $invoice_id ) && !empty( $invoice_id ) ) {
                $res    = $this->invoiceModel->getInvoiceDetails($code,$from_date,$to_date,$policy_class, $policy_gen_from, $invoice_id);    
                $res1   = $this->rm->fetch_single_insurance_company_invoice_acc($code,$from_date,$to_date,$policy_class, $policy_gen_from);
            } else {
                $res    = $this->rm->fetch_single_insurance_company_invoice($code,$from_date,$to_date,$policy_class, $policy_gen_from);    
                $res1   = $this->rm->fetch_single_insurance_company_invoice_acc($code,$from_date,$to_date,$policy_class, $policy_gen_from);
            }
            */
            
            $res    = $this->rm->fetch_single_insurance_company_invoice($code,$from_date,$to_date,$policy_class, $policy_gen_from, $insurance,$types);    
            //echo $this->db->last_query();
            $s = $this->db->last_query();
            echo '<input type="hidden" value="'.$s.'">';
            $res1   = $this->rm->fetch_single_insurance_company_invoice_acc($code,$from_date,$to_date,$policy_class, $policy_gen_from, $insurance,$types);
            //echo $this->db->last_query();
            
            if( $invoice_id ) {
                if( $types == 'R') {
                    $invoice_rev_id = $this->invoicerevModel->getMaxRevisionByInvoice($invoice_id);
                    echo "<h3>Already Generated Invoices</h3>&nbsp;&nbsp;";
                    if($invoice_rev_id)
                        echo '<button type="button" value="Revisied" class="btn btn-primary" onclick="invoice_revisied('.$invoice_rev_id.')">Invoice Revisied</button>';
                        
                    exit;
                } else {
                    
                }
            }
            
            //echo $this->db->last_query();
            
        
            $policy_type = [];
            
             foreach($res as $da)
             {
                 if(!in_array(trim($da->policy_type),$policy_type))
                 {
                    array_push($policy_type,trim($da->policy_type)); 
                 }
             }         
             
             //echo '<pre>';print_r($policy_type);print'</pre>';

            $content .="<table class='table' border='0'>
                            <tr>
                            <td style='font-size:16px;' >Insurance Name : ".$insurance_data->company_name."</td>
                            <td style='font-size:16px;'>Total no policies : ".count($res)."</td>
                            </tr>
                        </table>";
            
            $content .="<table class='table table-bordered'>
            <tr>
                  <td>Policy Type</td>
                  <td style='text-align:center'>Policy Count</td>
                  <td style='text-align:right'>Own Commisison</td>
            </tr>
            <tbody>";
            $total_ird = 0;
            $total_additional = 0;
            $tot_agent_commission = 0;
            $agent_debit = 0;
            $tot_tds = 0;
            $policy_count = 0;
            $policy_total_count =0;
            
            
      if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") 
         {
            
            foreach($policy_type as $pt)
            {
                $own_commission =0;
                $policy_count =0;
                $irdi_commission =0;
                  foreach($res as $da)
                 {

                  if($pt == trim($da->policy_type))
                  {
                      $policy_count++;
                      
                   $own_commission = $own_commission + $da->credit;
                }
            }
             $total_ird = $own_commission+$total_ird;
              $policy_total_count = $policy_count+$policy_total_count;
              
            $content .="<tr>
                    <td>".$pt."</td>
                    <td style='text-align:center'>".$policy_count."</td>
                    <td style='text-align:right'>".number_format(floor($own_commission),2)."</td>
                    </tr>";
            
          }
            
         }
         else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
        { 
            
            $policy_type1 =[];
            
            foreach($res1 as $da)
            {
                 if(!in_array(trim($da->policy_type),$policy_type1))
                 {
                    array_push($policy_type1,trim($da->policy_type)); 
                 }
            }
            
            
            foreach($policy_type1 as $pt)
            {
                $own_commission =0;
                $policy_count =0;
                $irdi_commission =0;
                  foreach($res1 as $da1)
                 {

                  if($pt == trim($da1->policy_type))
                  {
                      $policy_count++;
                      
                   $own_commission =  $da1->credit + $own_commission;


                }
            }
            $total_ird = $own_commission+$total_ird;
            $policy_total_count = $policy_count+$policy_total_count;
            $content .="<tr>
                    <td>".$pt." 
                    <input type='text' class='pt' name='custom_policy_name[".$da1->policy_type."]' value='' data-value = '".$da1->policy_type."'></td>
                    <td style='text-align:right'>".$policy_count."</td>
                    <td style='text-align:right'>".number_format(floor($own_commission),2)."</td>
                    </tr>";
            
          }
         }
            
        if(count($res) > 0 || count($res1) > 0) {
            $content .="<tr>
            <td style='text-align:right'><b>Total</b></td>
            <td style='text-align:center'><b>".number_format(floor($policy_total_count))."</b></td>
            <td style='text-align:right'><b>".number_format(floor($total_ird),2)."</b></td>
            </tr>";
            $content .="</tbody></table><br>";
            
            
            
                $content .="<button type='button' class='btn btn-primary pull-right' id='vocher_gen_btn' onclick=vocher()>Save Invoice</button>";    
        } else {
            $content .= "<tr>
            <td colspan='3' style='text-align:center'><b>No Record(s)</b></td>
            
            </tr>";
        }
             
            echo $content;
	   }
	}     
     
     
    public function save_insurance_policy()
    {
        if($this->session->has_userdata('logged_in')) 
        { 
            $this->load->model('invoice_model', 'invoiceModel');
            $this->load->model('invoice_revision_model', 'invoicerevModel');
            
            $this->load->model('invoice_orc_model', 'invoiceorcModel');
            $this->load->model('invoice_orc_revision_model', 'invoiceorcrevModel');
            
            $today = new DateTime();
    	    $insurance = $this->input->post("insurance");
    	    $from_date = $this->input->post("from_date");
    	    $to_date = $this->input->post("to_date");
    	    $policy_class = $this->input->post("policy_class");
    	    $policy_arr = $this->input->post("policy_arr");
    	    $policy_gen_from = $this->input->post("policy_gen_from");
    	    $types = $this->input->post("types");
    	    
    	    $insur_commission_status = "1";
            $custom_policy_name = [];
            if( isset( $policy_arr ) && !empty($policy_arr)){
                $custom_policy_name = array_values($policy_arr);
            }
            
            //echo '<pre>';print_r($policy_arr);print_r($custom_policy_name);echo '</pre>';
            
            
    	    $insurance_data = $this->rm->get_insurance_company($insurance);
            $date = date("Y-m-d H:i:s");
            $year = date('y');
            $month = date('m');
            if($month < 4)
            {
                $year = $year-1;
            }
             
    	    $i = 0;

            $insurance_1 = $this->rm->get_single_insurance_company($insurance);
            
            if($insurance_1 != NULL || $insurance_1 !="")
            {
                $code = $insurance_1->vchaccid;
            }
            else
            {
                $code=  "";
            }
            
            

            $res = $this->rm->fetch_single_insurance_company_invoice($code,$from_date,$to_date,$policy_class, $policy_gen_from, $insurance, $types);
            
            
        $res1 = $this->rm->fetch_single_insurance_company_invoice_acc($code,$from_date,$to_date,$policy_class, $policy_gen_from, $insurance, $types);
        
            $policy_type = [];
            
             foreach($res as $da)
             {
                 if(!in_array(trim($da->policy_type),$policy_type))
                 {
                    array_push($policy_type,trim($da->policy_type)); 
                 }
             } 
             
              $policy_type_orc = [];
            
             foreach($res1 as $da1)
             {
                 if(!in_array(trim($da1->policy_type),$policy_type_orc))
                 {
                    array_push($policy_type_orc,trim($da1->policy_type)); 
                 }
             } 
             
             
           $data = [];     


            $total_ird = 0;
            $total_additional = 0;
            $tot_agent_commission = 0;
            $agent_debit = 0;
            $tot_tds = 0;
            $policy_count = 0;
            $policy_total_count =0;
            
            
            $x = 0;
                do 
                {
                  $x++;
                  $new_vocher_no = "inv".$x."/".$year;
                } 
                while($this->rm->vocher_number_already_exit($new_vocher_no));
            
            foreach($policy_type as $pt)
            {
                $own_commission =0;
                $policy_count =0;
                $irdi_commission =0;
                  foreach($res as $da)
                 {

                  if($pt == trim($da->policy_type))
                  {
                      $policy_count++;
                      
                   $own_commission = $own_commission + $da->credit;
                    $data[$i]['insurer_id'] = $insurance;//$insurance_data->company_name;
                    $data[$i]['polic_type'] = trim($da->policy_type);
                    $data[$i]['voucher_no'] = $new_vocher_no;
                    $data[$i]['lead_id'] = $da->lead_id;
                    $data[$i]['own_commission'] = $da->credit;
                    $data[$i]['fromdate'] = $from_date; 
                    $data[$i]['todate'] = $to_date;
                    $data[$i]['created_at'] = $today->format('Y-m-d H:i:s');
                    $data[$i]['created_by'] = $this->session->userdata("session_id");
                    //$data[$i]['inv_gen_from'] = $policy_gen_from;
                    $i++;

                }
                
                 //$lead_id = $da->lead_id;
                 
                 $leadIDS[] = $da->lead_id;

                 
            }
             $total_ird = $own_commission+$total_ird;
             $policy_total_count = $policy_count+$policy_total_count;

          }
/*
            if( isset( $data ) && !empty( $data ) ) {
                $_year = $year.'-'.date('Y');
                $invno = $this->invoiceModel->getMaxInvoiceNo($_year);
                if($invno) {
                    $invdata = [
                        'invno'                 => $invno,
                        'invtype'               => $policy_gen_from,
                        'fromdate'              => $from_date, 
                        'todate'                => $to_date,
                        'insurance_company_id'  => $insurance,
                        'createdby'             => 1,
                        'created_date'          => $today->format('Y-m-d H:i:s')
                    ];
                
                    $invoice = $this->invoiceModel->getMaxInvoiceNo($_year);
                    if($invoice){
                        if($this->invoiceModel->addInvoice($invdata)){
                            unset($invdata['created_date']);
                            
                            $invoice_id = $this->invoiceModel->getID($invdata);
                            $invRevno   = $this->invoicerevModel->getMaxInvRevNo($invoice_id);
                            $today      = new DateTime();
                            
                            if( isset( $invoice_id ) && !empty( $invoice_id ) ){
                                $invrevdata = [
                                    'invoice_id'            => $invoice_id,
                                    'revno'                 => $invRevno,
                                    'revdate'               => $today->format('Y-m-d'), 
                                    'createdby'             => 1,
                                    'created_date'          => $today->format('Y-m-d H:i:s')
                                ];
                                
                                if($this->invoicerevModel->addInvoiceRev($invrevdata)){
                                    unset($invrevdata['created_date']);
                                    $invrev_id = $this->invoicerevModel->getID($invrevdata);
                                    
                                    if( isset( $invrev_id ) && !empty( $invrev_id ) ){
                                        $data['revision_id'] = $invrev_id;
                                        $result = $this->rm->add_insurance_voucher_details($data);
                                        
                                        $data_1 = array("insur_commission_status" =>$insur_commission_status);
            
                                        $res_1 = $this->rm->add_insur_commission_status($data_1);
                                        
                                        $lead_update = array("company_vocher_status" =>"1");
                                         
                                        $lead_update = $this->rm->update_company_vocher_status($leadIDS,$lead_update);
                                    }
                                }
                            }
                        }
                    }
                }
            }
*/            
            $request = $this->input->post();
            $this->SaveInvoice($year, $data, $request, $leadIDS);
            
              
              
            $u = 0;
            do
            {
               $u++;
               $unicorn_vocher_no = "uni".$u."/".$year;
            }
            while($this->rm->vocher_unicorn_no_already_exit($unicorn_vocher_no));
               
            $data1= [];
            
            $j = 0;
            
            foreach($policy_type_orc as $pt1)
            {
                $own_commission =0;
                $policy_count =0;
                $irdi_commission =0;
                  foreach($res1 as $da1)
                 {

                  if($pt1 == trim($da1->policy_type))
                  { 
                      $policy_count++;
                    $data1[$j]['insurer_id']  = $insurance;//$insurance_data->company_name;
                    $data1[$j]['polic_type'] = (isset($custom_policy_name[0][$da1->policy_type]) && !empty($custom_policy_name[0][$da1->policy_type])) ?   $custom_policy_name[0][$da1->policy_type] : trim($da1->policy_type);
                    $data1[$j]['voucher_no'] = $unicorn_vocher_no;
                    $data1[$j]['lead_id'] = $da1->lead_id;
                    $data1[$j]['own_commission'] = $da1->credit; 
                    $data1[$j]['fromdate'] = $from_date; 
                    $data1[$j]['todate'] = $to_date;
                    $data1[$j]['created_at'] = $today->format('Y-m-d H:i:s');
                    $data1[$j]['created_by'] = $this->session->userdata("session_id");
                    //$data[$i]['inv_gen_from'] = $policy_gen_from;
                   $j++;

                }
            }
            $total_ird = $own_commission+$total_ird;
            $policy_total_count = $policy_count+$policy_total_count;
    
          }
          
            //$result = $this->rm->add_insurance_voucher_details_orc($data1);
            $this->SaveInvoiceOrc($year, $data1, $request, $leadIDS);
            
            $data_1      = array("insur_commission_status" => 1);
            $res_1       = $this->rm->add_insur_commission_status($data_1);
            $lead_update = array("company_vocher_status" =>"1");
            $lead_update = $this->rm->update_company_vocher_status($leadIDS,$lead_update); 
                
            echo json_encode(array("status"=>"success","arr" =>$new_vocher_no,'uni' => $unicorn_vocher_no));
            
/*            
      if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") 
         {
             
             $x = 0;
                do 
                {
                  $x++;
                  $new_vocher_no = "inv".$x."/".$year;
                } 
                while($this->rm->vocher_number_already_exit($new_vocher_no));
            
            foreach($policy_type as $pt)
            {
                $own_commission =0;
                $policy_count =0;
                $irdi_commission =0;
                  foreach($res as $da)
                 {

                  if($pt == $da->policy_type)
                  {
                      $policy_count++;
                      
                   $own_commission = $own_commission + $da->credit;
                    $data[$i]['insurer_id']  =$insurance_data->company_name;
                    $data[$i]['polic_type'] = $da->policy_type;
                    $data[$i]['voucher_no'] = $new_vocher_no;
                    $data[$i]['lead_id'] = $da->lead_id;
                    $data[$i]['own_commission'] = $da->credit;
                    $i++;

                }
                
                 //$lead_id = $da->lead_id;
                 
                 $leadIDS[] = $da->lead_id;

                 
            }
             $total_ird = $own_commission+$total_ird;
             $policy_total_count = $policy_count+$policy_total_count;

          }
            
            
          
            $result = $this->rm->add_insurance_voucher_details($data);
            
            $data_1 = array("insur_commission_status" =>$insur_commission_status);
            

            $res_1 = $this->rm->add_insur_commission_status($data_1);
            
            
            $lead_update = array("company_vocher_status" =>"1");
             
              $lead_update = $this->rm->update_company_vocher_status($leadIDS,$lead_update);
             echo json_encode(array("status"=>"success","arr" =>$new_vocher_no));
         }
         else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
        { 
            
             $u = 0;
               do
               {
                   $u++;
                   $unicorn_vocher_no = "uni".$u."/".$year;
               }
               while($this->rm->vocher_unicorn_no_already_exit($unicorn_vocher_no));
               
            $data1= [];
            
            $j = 0;
            
            foreach($policy_type_orc as $pt1)
            {
                $own_commission =0;
                $policy_count =0;
                $irdi_commission =0;
                  foreach($res1 as $da1)
                 {

                  if($pt1 == $da1->policy_type)
                  { 
                      $policy_count++;
                    $data1[$j]['insurer_id']  =$insurance_data->company_name;
                    $data1[$j]['polic_type'] = (isset($custom_policy_name[0][$da1->policy_type]) && !empty($custom_policy_name[0][$da1->policy_type])) ?   $custom_policy_name[0][$da1->policy_type] : $da1->policy_type;
                    $data1[$j]['voucher_no'] = $unicorn_vocher_no;
                    $data1[$j]['lead_id'] = $da1->lead_id;
                    $data1[$j]['own_commission'] = $da1->credit; 
                   $j++;

                }
            }
            $total_ird = $own_commission+$total_ird;
            $policy_total_count = $policy_count+$policy_total_count;
    
          }
          
          $result = $this->rm->add_insurance_voucher_details_orc($data1);
           echo json_encode(array("status"=>"success","arr" =>$unicorn_vocher_no));
           
         }
*/       
	   }
	}    
	
	public function SaveInvoice($year, $data, $request, $leadIDS) {
	    if( isset( $data ) && !empty( $data ) ) {
	        $y      = new DateTime($request['from_date']);
	        $year   = $y->format('y');
	        $month  = $y->format('m');
            if($month < 4) $year = $year-1;
            
            $_year  = $year.'-'.($y->format('Y')+1);
            $today  = new DateTime();
            
            $chkdata = [
                'fromdate'              => $request['from_date'], 
                'todate'                => $request['to_date'],
                'insurance_company_id'  => $request['insurance'],
                'class_id'              => $request['policy_class'],
            ];
            $invoice_id = $this->invoiceModel->getID($chkdata);
            if( $invoice_id && $request['types'] == "N") {
                $invoice_id = null;
            }
            // var_dump($invoice_id);
            // var_dump($request);
            // die();
            if( !$invoice_id ){
                $invno  = $this->invoiceModel->getMaxInvoiceNo($_year);
                $invdata = [
                    'invno'                 => "{$_year}/{$invno}",
                    'invtype'               => $request['policy_gen_from'],
                    'fromdate'              => $request['from_date'], 
                    'todate'                => $request['to_date'],
                    'insurance_company_id'  => $request['insurance'],
                    'status'                => 'F',
                    'class_id'              => $request['policy_class'],
                    'createdby'             => 1,
                    'created_date'          => $today->format('Y-m-d H:i:s')
                ];
                if($this->invoiceModel->addInvoice($invdata)){
                    unset($invdata['created_date']);
                    $invoice_id = $this->invoiceModel->getID($invdata);
                }
            } else {
                $_data = ['status' => 'F'];
                $this->invoiceModel->updateInvoice($invoice_id, $_data);   
            }
            
            $invrev_id = $this->invoicerevModel->getID(['invoice_id' => $invoice_id]);
                        
            $invRevno   = (empty($invrev_id)) ? 0 : $this->invoicerevModel->getMaxInvRevNo($invoice_id);
            $today      = new DateTime();
            
            if( isset( $invoice_id ) && !empty( $invoice_id ) ){
                $invrevdata = [
                    'invoice_id'            => $invoice_id,
                    'revno'                 => $invRevno,
                    'revdate'               => $today->format('Y-m-d'), 
                    'createdby'             => 1,
                    'created_date'          => $today->format('Y-m-d H:i:s')
                ];
                
                if($this->invoicerevModel->addInvoiceRev($invrevdata)){
                    unset($invrevdata['created_date']);
                    $invrev_id = $this->invoicerevModel->getID($invrevdata);
                    
                    if( isset( $invrev_id ) && !empty( $invrev_id ) ){
                        foreach( $data as &$_row ) { 
                            $_row['invoice_revision_id'] = $invrev_id;    
                        }
                        
                        $result      = $this->rm->add_insurance_voucher_details($data);
                        // $data_1      = array("insur_commission_status" => 1);
                        // $res_1       = $this->rm->add_insur_commission_status($data_1);
                        // $lead_update = array("company_vocher_status" =>"1");
                        // $lead_update = $this->rm->update_company_vocher_status($leadIDS,$lead_update);
                    }
                }
            }
            /*
            $invno  = $this->invoiceModel->getMaxInvoiceNo($_year);
            $today  = new DateTime();
            if($invno) {
                $invdata = [
                    'invno'                 => "{$_year}/{$invno}",
                    'invtype'               => $request['policy_gen_from'],
                    'fromdate'              => $request['from_date'], 
                    'todate'                => $request['to_date'],
                    'insurance_company_id'  => $request['insurance'],
                    'class_id'              => $request['policy_class'],
                    'createdby'             => 1,
                    'created_date'          => $today->format('Y-m-d H:i:s')
                ];
            
                //$invoice = $this->invoiceModel->getMaxInvoiceNo($_year);
                if($invno){
                    if($this->invoiceModel->addInvoice($invdata)){
                        unset($invdata['created_date']);
                        
                        $invoice_id = $this->invoiceModel->getID($invdata);
                        
                        $invrev_id = $this->invoicerevModel->getID(['invoice_id' => $invoice_id]);
                        
                        $invRevno   = (empty($invrev_id)) ? 0 : $this->invoicerevModel->getMaxInvRevNo($invoice_id);
                        $today      = new DateTime();
                        
                        if( isset( $invoice_id ) && !empty( $invoice_id ) ){
                            $invrevdata = [
                                'invoice_id'            => $invoice_id,
                                'revno'                 => $invRevno,
                                'revdate'               => $today->format('Y-m-d'), 
                                'createdby'             => 1,
                                'created_date'          => $today->format('Y-m-d H:i:s')
                            ];
                            
                            if($this->invoicerevModel->addInvoiceRev($invrevdata)){
                                unset($invrevdata['created_date']);
                                $invrev_id = $this->invoicerevModel->getID($invrevdata);
                                
                                if( isset( $invrev_id ) && !empty( $invrev_id ) ){
                                    foreach( $data as &$_row ) {
                                        $_row['invoice_revision_id'] = $invrev_id;    
                                    }
                                    
                                    $result      = $this->rm->add_insurance_voucher_details($data);
                                    $data_1      = array("insur_commission_status" => 1);
                                    $res_1       = $this->rm->add_insur_commission_status($data_1);
                                    $lead_update = array("company_vocher_status" =>"1");
                                    $lead_update = $this->rm->update_company_vocher_status($leadIDS,$lead_update);
                                }
                            }
                        }
                    }
                }
            }
            */
        }
	}
	
	public function SaveInvoiceOrc($year, $data, $request, $leadIDS) {
	    if( isset( $data ) && !empty( $data ) ) {
	        $y      = new DateTime($request['from_date']);
	        $year   = $y->format('y');
	        $month  = $y->format('m');
            if($month < 4) $year = $year-1;
            
            $_year  = $year.'-'.($y->format('Y')+1);
            $today  = new DateTime();
            
            $chkdata = [
                'fromdate'              => $request['from_date'], 
                'todate'                => $request['to_date'],
                'insurance_company_id'  => $request['insurance'],
                'class_id'              => $request['policy_class'],
            ];
            $invoice_id = $this->invoiceorcModel->getID($chkdata);
            if( !$invoice_id ){
                $invno  = $this->invoiceorcModel->getMaxInvoiceNo($_year);
                $invdata = [
                    'invno'                 => "U/{$_year}/{$invno}",
                    'invtype'               => $request['policy_gen_from'],
                    'fromdate'              => $request['from_date'], 
                    'todate'                => $request['to_date'],
                    'insurance_company_id'  => $request['insurance'],
                    'status'                => 'F',
                    'class_id'              => $request['policy_class'],
                    'createdby'             => 1,
                    'created_date'          => $today->format('Y-m-d H:i:s')
                ];
                if($this->invoiceorcModel->addInvoice($invdata)){
                    unset($invdata['created_date']);
                    $invoice_id = $this->invoiceorcModel->getID($invdata);
                }
            } else {
                $_data = ['status' => 'F'];
                $this->invoiceorcModel->updateInvoice($invoice_id, $_data);   
            }
            
            $invrev_id = $this->invoiceorcrevModel->getID(['invoice_orc_id' => $invoice_id]);
                        
            $invRevno   = (empty($invrev_id)) ? 0 : $this->invoiceorcrevModel->getMaxInvRevNo($invoice_id);
            $today      = new DateTime();
            
            if( isset( $invoice_id ) && !empty( $invoice_id ) ){
                $invrevdata = [
                    'invoice_orc_id'        => $invoice_id,
                    'revno'                 => $invRevno,
                    'revdate'               => $today->format('Y-m-d'), 
                    'createdby'             => 1,
                    'created_date'          => $today->format('Y-m-d H:i:s')
                ];
                
                if($this->invoiceorcrevModel->addInvoiceRev($invrevdata)){
                    unset($invrevdata['created_date']);
                    $invrev_id = $this->invoiceorcrevModel->getID($invrevdata);
                    
                    if( isset( $invrev_id ) && !empty( $invrev_id ) ){
                        foreach( $data as &$_row ) {
                            $_row['invoice_orc_revision_id'] = $invrev_id;    
                        }
                        
                        $result      = $this->rm->add_insurance_voucher_details_orc($data);
                        // $data_1      = array("insur_commission_status" => 1);
                        // $res_1       = $this->rm->add_insur_commission_status($data_1);
                        // $lead_update = array("company_vocher_status" =>"1");
                        // $lead_update = $this->rm->update_company_vocher_status($leadIDS,$lead_update);
                    }
                }
            }
            
        }
	}
       
    public function company_invoice_report() {
        if(!$this->session->has_userdata('logged_in')) {
            redirect('login', 'refresh');
        }
        
        if(!$this->auth->can_access('Company Invoice Report')){
            redirect('access_denied', 'refresh');
        }
        
        $pro_data["project_info"]   = $this->mm->fetch_project_info();
        $data["monthlist"]          = $this->getMonthList();
        $companylist                = $this->rm->getCompanyByInvoice();
        $data['invoiceinfo']        = ( isset( $results ) && !empty( $results ) ) ? $results : [];
        
        $data['companylist']        = $companylist;
        $data["classlist"]          = $this->rm->get_class_list();
        
        $this->load->view('header',$pro_data);
        $this->load->view('company_invoice_report',$data);
        $this->load->view('footer',$pro_data);
    }
    
    public function fetch_company_invoice_report()
    {
        if($this->session->has_userdata('logged_in')) 
        { 
            $content = "";
            
            $org = 1;     
            if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") {
                  $org = 1;                             
            } else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn") {
                $org = 2;
            }
        
    	    $insurance = $this->input->post("insurance");
    	    $from_date = $this->input->post("from_date");
    	    $to_date = $this->input->post("to_date");
    	    $policy_class = $this->input->post("policy_class");
    	    $invoice_rev_id = $this->input->post("invoice_rev_id");
    	    
    	    $insurance_data = $this->rm->get_insurance_company($insurance);

            $insurance_1 = $this->rm->get_single_insurance_company($insurance);
            
            if($insurance_1 != NULL || $insurance_1 !="")
            {
                $code = $insurance_1->vchaccid;
            }
            else
            {
                $code=  "";
            }
            
            $policy_type = [];

            $invoices = $this->rm->getCompanyinvoice($insurance,$from_date,$to_date,$policy_class,$org, '', $invoice_rev_id);
            
            
            //echo $this->db->last_query();
            
            $vouchar = (isset($invoices[0]->invvouchar) && !empty($invoices[0]->invvouchar)) ? trim($invoices[0]->invvouchar) : "";
            
            $vouchar_date = (isset($invoices[0]->created_at) && !empty($invoices[0]->created_at)) ? $invoices[0]->created_at : "";
            
            $fn = "exportpdf('{$vouchar}', '{$org}')";
            
            $content .="<table class='table' border='0'>
                            <tr>
                                <td style='font-size:16px;'>Insurance Name : ".((isset($insurance_data->company_name)) ? $insurance_data->company_name : "")."</td>
                                <td style='font-size:16px;'>Total no policies : ".count($invoices)."</td>
                                
                                <td style='font-size:16px;'>Vouchar No : ".$vouchar."</td>
                                
                                <td style='font-size:16px;'>Vouchar Date : ".$vouchar_date." </td>";
                                if( isset( $invoices ) && !empty( $invoices ) )
                                    $content .= '<td><input type="button" value="Export PDF" onclick="exportpdf(\''.$vouchar.'\', '.$org.')"/></td>';
                                
                                $content .= '<td><input type="button" value="Export Excel" onclick="exportexcel(\''.$vouchar.'\', '.$org.')"/></td>';
                                
                            $content .= "</tr>
                                        </table>";
                        
            $total_amt = $total_cnt = 0;$policylist = [];
            foreach($invoices as $row) {
                $policy_type = trim($row->polic_type);
                if(!isset($policylist[$policy_type])){
                    $policylist[$policy_type] = 0;
                    $policycount[$policy_type] = 0;
                }
                
                $policylist[$policy_type] += (float)$row->own_commission;
                $policycount[$policy_type] += 1;
                $total_amt += (float)$row->own_commission;
                $total_cnt += 1;
            }
            
            $content .="<table class='table table-bordered'>
                            <tr>
                                <td>Sl.No.</td>
                                <td>Policy Type</td>
                                <td style='text-align:right'>Policy Count</td>
                                <td style='text-align:right'>Own Commisison</td>
                            </tr>
                        <tbody>";
                        
            if(isset($policylist) && !empty($policylist)){
                $sl = 1;
                foreach($policylist as $policy_name => $policy_amt){
                    $policy_count = (isset($policycount[$policy_name]) && !empty($policycount[$policy_name])) ? $policycount[$policy_name] : 0;
                    $content .= "<tr>";
                        $content .= "<td>".($sl++)."</td>";
                        $content .= "<td>".$policy_name."</td>";
                        $content .= "<td><span class='pull-right'>".$policy_count."</span></td>";
                        
                        $content .= "<td><span class='pull-right'>".$policy_amt."</span></td>";
                    $content .= "</tr>";
                }
            }
            
            $content .="<tr>
                            <td colspan='2' style='text-align:right' ><b>Total</b></td>
                            <td style='text-align:right'><b>".number_format(floor($total_cnt))."</b></td>
                            <td style='text-align:right'><b>".number_format(floor($total_amt),2)."</b></td>
                            </tr>";
            $content .="</tbody></table><br>";
            
            $content .="<h4>Invoice Breakup List</h4><hr>";
            
            $content .="<table class='table' id='tbl_invoice'>
                        <thead>
                            <tr>
                                  <th>Sl.No.</th>
                                  <th>Policy Type</th>
                                  <th>Policy No</th>
                                  
                                  <th style='text-align:right'>Own Commisison</th>
                            </tr>
                        </thead>
                        <tbody>";
            
            if(isset($invoices) && !empty($invoices)) {
                $sl = 1;
                foreach( $invoices as $invoice ) {
                    $content .= "<tr>";
                        $content .= "<td>".($sl++)."</td>";
                        $content .= "<td>".trim($invoice->polic_type)."</td>";
                        $content .= "<td>".trim($invoice->policy_no)."</td>";
                        $content .= "<td><span class='pull-right'>".$invoice->own_commission."</span></td>";
                    $content .= "</tr>";
                }
                $content .="</tbody><tfoot>";
                $content .="<tr>
                            <td></td>
                            <td></td>
                            <td style='text-align:right'><b>Total : </b></td>
                            <td style='text-align:right'><b>".number_format(floor($total_amt),2)."</b></td>
                            </tr>";
                $content .="</tfoot></table><br>";
            }
        
            echo $content;
	   }
	}
	
	public function generate_vocher()
    {
        
        if($this->session->has_userdata('logged_in')) 
        { 
            $this->db->trans_begin(); #begin transaction
            
            $policy_arr = $this->input->post("policy_arr");
            $from_date = $this->input->post("from_date");
            $to_date = $this->input->post("to_date");
            $agent = $this->input->post("agent");
            $date = date("Y-m-d H:i:s");
            $year = date('y');
            $month = date('m');
            if($month < 4) {
                $year = $year-1;
            }
                
            
                    
            $total_commission = 0;
            $agent_commissions = $agentlists = [];
            for($i= 0;$i<count($policy_arr);$i++)
            {
                $res    = $this->rm->getPolicyByID($policy_arr[$i]);
                
                if( isset( $res ) && !empty( $res ) ){
                  $agent_id   = $res->policy_agency_pos;
                  //$commissions = $this->lm->get_commission_details($res->commission_id);
                    
                  //$irda_od_percentage = (isset($commissions->ird_od_commission) && $commissions->ird_od_commission != '') ? $commissions->ird_od_commission : 15;
        		  //$irda_tp_percentage = (isset($commissions->ird_tp_commission) && $commissions->ird_tp_commission != '') ? $commissions->ird_tp_commission : 2.5;    
                    
                    if( !in_array($agent_id, $agentlists) ){
                        $agents = $this->rm->get_agent_code_by_id($agent_id);
                        $_agent_code = (isset($agents) && !empty($agents) ) ? $agents->agent_pos_code : "";
                        $x = 0;
                        do 
                        {
                          $x++;
                          $new_vocher_no = "av/{$_agent_code}/".$x."/".$year;
                        }
                        while($this->rm->vocher_no_already_exits($new_vocher_no));
                       
                        
            	       
                        $agentlists[]                           = $agent_id;
                        $vouchlist[$agent_id]                   = $new_vocher_no;
                        $agent_commissions[$agent_id]           = 0;
                        $agent_commissions_orc[$agent_id] 	    = 0;
                        $total_agent_commissions[$agent_id]     = 0;
                    }
                    
                    $data   = array("vocher_no" =>$vouchlist[$agent_id],"vocher_status" =>"1","vocher_date"=>$date);
                        
                        $upres    = $this->rm->update_vocher_details($data,$policy_arr[$i]);
                        if( $upres ) {
            	            $this->audit->log('policy_info', 'UPDATE', null, $res, $data);
            	        }
            	        
                    $policyinfo[$agent_id][$res->id] = $vouchlist[$agent_id];
                     
                    
                    $agent_commissions[$agent_id] += $res->agent_commission_amt + $res->agn_add_com;
                    
                    $agent_commissions_orc[$agent_id] += $res->agent_commission;
                    
                    $total_agent_commissions[$agent_id] += $res->agent_commission_amt + $res->agn_add_com + $res->agent_commission;
                    //$agent_commissions_data[$agent_id][]= $res->agent_commission_amt + $res->agn_add_com;                    
                }

            }
            
            
           
            if( isset($agentlists) && !empty($agentlists) ) {
                $options = [
                    'insurer_company'   => $res->company, 
                    //'policy_class'      => $res->pclass, 
                    'fromdate'          => $from_date, 
                    'todate'            => $to_date
                ];
				
                // $tds_data       = $this->rm->getTDSPercentage($options);
                // $jayantha_tds   = (isset($tds_data->jayantha_tds) && $tds_data->jayantha_tds != '') ? $tds_data->jayantha_tds : 0;
                // $unicorn_tds    = (isset($tds_data->unicorn_tds) && $tds_data->unicorn_tds != '') ? $tds_data->unicorn_tds : 0;
                
                $tds_data       = $this->rm->get_tds_percentage();
                $jayantha_tds   = $unicorn_tds = (isset($tds_data->tds_percentage) && $tds_data->tds_percentage != '') ? $tds_data->tds_percentage : 5;
                
                foreach($agentlists as $_agent_id) {
                    $agent_commission   = (isset($agent_commissions[$_agent_id]) && $agent_commissions[$_agent_id] != '') ? $agent_commissions[$_agent_id] : 0;
                    $tds_amt            = floor(($agent_commission * $jayantha_tds/100));
                    $net                = floor(($agent_commission - $tds_amt)) - 0;
                    
                    $voucher_data = array(
                        "agent_id"          => $_agent_id,
                        "voucher_no"        => $vouchlist[$_agent_id],//$new_vocher_no,
                        "total_commission"  => $agent_commission,
                        "tds_amt"           => $tds_amt,
                        "netpay"            => $net,
                        "created_by"        => $this->session->userdata("session_id"),
                        "created_at"        => date("Y-m-d H:i:s"),
                        'from_date'         => $from_date,
                        'to_date'           => $to_date,
                    );
                    
                    $result      = $this->rm->add_agent_voucher_details($voucher_data);
                    
                    $agent_commission_orc   = (isset($agent_commissions_orc[$_agent_id]) && $agent_commissions_orc[$_agent_id] != '') ? $agent_commissions_orc[$_agent_id] : 0;
                    $tds_amt_orc            = floor(($agent_commission_orc * $unicorn_tds/100));
                    $net_orc                = floor(($agent_commission_orc - $tds_amt_orc)) - 0;
                    
                    $voucher_data_orc = array(
                        "agent_id"          => $_agent_id,
                        "voucher_no"        => "uni/".$vouchlist[$_agent_id],//$new_vocher_no,
                        "commission_amt"    => $agent_commission_orc,
                        "tds_amt"           => $tds_amt_orc,
                        "netpay"            => $net_orc,
                        "created_by"        => $this->session->userdata("session_id"),
                        "created_at"        => date("Y-m-d H:i:s"),
                        'from_date'         => $from_date,
                        'to_date'           => $to_date,
                    );
            
                    $result_orc  = $this->rm->add_agent_voucher_details_orc($voucher_data_orc);
                    
                    $net         = (isset($total_agent_commissions[$_agent_id]) && $total_agent_commissions[$_agent_id] != '') ? $total_agent_commissions[$_agent_id] : 0;
                    
                    // $result      = $this->rm->add_agent_voucher_details($voucher_data);
                    $main_ledger = $this->rm->get_ledger_acc($_agent_id);
                    
                    $irda_com    = $agent_commission;//$irda_od_percentage/100 * $net;
                    $orc_com     = $agent_commission_orc;//$net - $irda_com;
                    
                    
                    
                    /*
                    $tds_data    = $this->rm->get_tds_percentage();
                    $tds         = (isset($tds_data->tds_percentage) && $tds_data->tds_percentage; != '') ? $tds_data->tds_percentage : 0;
                    $tds_amount  = floor($total_commission) * $tds/100;
                    */
                    
                    //Agent commission table IRDA
                    if( isset( $main_ledger->vchaccname ) && !empty( $main_ledger->vchaccname ) ) {
                    $commission_arr = array(
                        "agent_id"      => $_agent_id,
                        "voucher_no"    => $vouchlist[$_agent_id],//$new_vocher_no,
                        "vhcharaccid"   => $main_ledger->vchaccname,
                        "credit"        => floor($irda_com),
                        "date"          => date("Y-m-d"),
                        "tds"           => 0,
                        "created_by"    => $this->session->userdata("session_id"),
                        "created_at"    => date("Y-m-d H:i:s"),
                    );
                     
                    
                        $res_1 = $this->rm->add_agent_commission($commission_arr);
                    }
                    if( $res_1 ) {
        	            $this->audit->log('agent_commission', 'INSERT', null, null, $commission_arr);
        	        }
                    
                    if( isset( $main_ledger->vchaccname ) && !empty( $main_ledger->vchaccname ) ) {
                    //Agent commission table ORC
                    $commission_arr_2 = array(
                        "agent_id"      => $_agent_id,
                        "voucher_no"    => "uni/".$vouchlist[$_agent_id],//$new_vocher_no,
                        "vhcharaccid"   => $main_ledger->vchaccname,
                        "credit"        => floor($orc_com),
                        "date"          => date("Y-m-d"),
                        "tds"           => 0,
                        "created_by"    => $this->session->userdata("session_id"),
                        "created_at"    => date("Y-m-d H:i:s"),
                    );
                    
                    
                        $res_2 = $this->rm->add_agent_commission_orc($commission_arr_2);
                    }
                    if( $res_2 ) {
        	            $this->audit->log('agent_commission_orc', 'INSERT', null, null, $commission_arr_2);
        	        }
        	        
                }
            }
            
            //$status = $this->GeneratePDF($policyinfo, $vouchlist);
            
            if($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
            
            echo json_encode(array("status"=>"success","arr" =>$res));
         }
     }
}