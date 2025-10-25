<?php
class Main extends CI_Controller {
    public $pm;
    public $rm;
    public $cm;
    public $mm;
    public $lm;
    public $rolepermissionModel;
    public $auth;
    public $audit;
    public $cookie;
    public $url;
    public $db;
    public $database;
    public $session;
    public $Role_permission_model;
    public $audit_model;
    public $userroleModel ;

    public function __construct()
    {
        parent::__construct();

        // Load session library
        $this->load->library('session');

        // Load database
        $this->load->database();

        // Load models
        $this->load->model('PayoutMod', 'pm');
        $this->load->model('ReportMod', 'rm');
        $this->load->model('Configmod', 'cm');
        $this->load->model('Mainmod', 'mm');
        $this->load->model('LeadMod', 'lm');
        $this->load->model('Role_permission_model', 'rolepermissionModel');

        // Load libraries
        $this->load->library('auth');
        $this->load->library('audit');

        // Load helpers
        $this->load->helper('cookie');
        $this->load->helper('url');
    }

	public function index()
	{
    	if ($this->session->has_userdata('logged_in')) 
    	{
    	    $this->set_user_roles();
    		redirect("home");
	    }
	    else
	    {
	    	$email_id = get_cookie('email_id'); 

			if($email_id != "")
			{
				$res = $this->mm->fetch_single_admin_login($email_id);

				if($res != NULL)
			    {
			    	$this->session->set_userdata('logged_in', TRUE);
			    	$this->session->set_userdata('session_id', $res->id);
					$this->session->set_userdata('session_name', $res->name);
					$this->session->set_userdata('session_email_id', $res->email_id);
					$this->session->set_userdata('session_role', $res->role);
					$this->session->set_userdata('session_company_type', 'jayantha');
					
					$this->set_user_roles();
					redirect("home", $data);
			    }
			    else
			    {
			    	redirect("login");
			    }
			}else
			{
				redirect("login");
			}
	    }
	}
	public function database_cache_clear()
	{
	    if ($this->session->has_userdata('logged_in')) 
    	{
	        $this->mm->database_cache_clear();
    	}
	}
	public function login()
	{
		$email_id = get_cookie('email_id'); 

		if($email_id != "")
		{
			redirect(base_url());
		}
		else
		{
			if($this->session->has_userdata('logged_in')) 
	    	{
				redirect("home");
			}
			else
		    {
		    	$data["project_info"] = $this->mm->fetch_project_info();
				$this->load->view('login',$data);
		    }
		}
	}
	public function login_submit()
	{
		$email_id = $this->input->post("email_id");
		$password = $this->input->post("psw");

		$remember_me = $this->input->post("remember_me");
		$res = $this->mm->fetch_single_admin_login($email_id);

		if($res != NULL)
	    {
	        if($password == $res->password)
	        {
				$this->session->set_userdata('logged_in', TRUE);
				$this->session->set_userdata('session_name', $res->name);
				$this->session->set_userdata('session_id', $res->id);
				$this->session->set_userdata('session_email_id', $res->email_id);
				$this->session->set_userdata('session_role', $res->role);
				$this->session->set_userdata('session_company_type', 'jayantha');

				if($remember_me == "Yes")
				{
					set_cookie('email_id', $res->email_id, '864000'); 
				}
				$this->set_user_roles();
	        	redirect("home");
	        }
	        else if($password == "Unicorn".$res->password&&($res->role == 'admin'|| $res->role == 'user'))
	        {
	            if($res->role == 'user')
	            {
	                $user_permission = $this->cm->fetch_user_permissions($res->id);
	                if($user_permission->unicon_access == 1)
	                {
	                    $this->session->set_userdata('logged_in', TRUE);
        				$this->session->set_userdata('session_name', $res->name);
        				$this->session->set_userdata('session_id', $res->id);
        				$this->session->set_userdata('session_email_id', $res->email_id);
        				$this->session->set_userdata('session_role', $res->role);
        				$this->session->set_userdata('session_company_type', 'unicorn');
        
        				if($remember_me == "Yes")
        				{
        					set_cookie('email_id', $res->email_id, '864000'); 
        				}
        				$this->set_user_roles();
        	        	redirect("home");
	                }
	                else
	                {
	                    $this->session->set_flashdata('error_msg','Password Mismatched');
	    		        redirect("login");
	                }
	            }
	            else
	            {
	                $this->session->set_userdata('logged_in', TRUE);
    				$this->session->set_userdata('session_name', $res->name);
    				$this->session->set_userdata('session_id', $res->id);
    				$this->session->set_userdata('session_email_id', $res->email_id);
    				$this->session->set_userdata('session_role', $res->role);
    				$this->session->set_userdata('session_company_type', 'unicorn');
    
    				if($remember_me == "Yes")
    				{
    					set_cookie('email_id', $res->email_id, '864000'); 
    				}
    				$this->set_user_roles();
    	        	redirect("home");
	            }
	            
	        }
	        else
	        {
	        	$this->session->set_flashdata('error_msg','Password Mismatched');
	    		redirect("login");
	        }
	    }
	    else
	    {
	    	$this->session->set_flashdata('error_msg','Email ID Not found');
	    	redirect("login");
	    }
	}
	
	function set_user_roles()
	{
	    $user_roles = [];
        if ($this->session->has_userdata('logged_in')) {
            $this->load->model('userrole_model', 'userroleModel');
            $opt = ['user_id' => $this->session->userdata('session_id')];//, 'status' => '1'
            $userroles = $this->userroleModel->getAllUserRole($opt);
            
            if( isset( $userroles ) && !empty( $userroles ) ){
                foreach( $userroles as $_role ){
                    $user_roles[] = $_role['role_id'];
                }
            }
        }
        
        $this->session->set_userdata('user_roles', $user_roles);
        
	}
	
	public function forgot_password()
	{
	    if ($this->session->has_userdata('logged_in')) 
    	{
    		redirect("home");
	    }
	    else
	    {	
	        $data["project_info"] = $this->mm->fetch_project_info();
			$this->load->view('forgot_password',$data);
	    }
	}
	public function forgot_password_submit()
	{
	    if ($this->session->has_userdata('logged_in')) 
    	{
    		redirect("home");
	    }
	    else
	    {
	        $email_id = $this->input->post("email_id");
    	    $res = $this->mm->fetch_single_admin_login($email_id);
    
    		if($res != NULL)
    	    {
    	        $res2 = $this->mm->fetch_project_info();
    	        
    	        $randomString = rand("100000","999999");
    	        
    	        $subject = "Forgot Password OTP on ".date("d-M-Y h:i:s A");
	           
	            $message  ="<h2>".$res2->project_name."</h2><h3>OTP : ".$randomString."</h3><h3><b>Note : </b> OTP valid for only five minutes</h3><br>
	                          <p><strong>Regards,<strong><br>
	                          ".$res2->project_name."</p>";

	            $this->load->library('email');
            
            	$this->email->from($res2->email_id, $res2->project_name);
            	$this->email->to($email_id);
            	
            	$this->email->set_mailtype("html");
            	$this->email->subject($subject);
            	$this->email->message($message);
            
            	$this->email->send();
                
                $start_time = date("H:i:s");
                $end_time = date("H:i:s", strtotime('+5 minutes'));
	            $otp_data = array("email_id" => $email_id, "date" => date("Y-m-d"), "otp" => $randomString, "start_time" => $start_time, "end_time" => $end_time);
                $insert = $this->mm->create_opt_log($otp_data);
                
    	        $this->session->set_userdata('session_fp_email', $email_id);
                redirect("forgot_password_otp");
    	    }
    	    else
    	    {
    	        $this->session->set_flashdata('error_msg','Email ID Not found');
    	    	redirect("forgot_password");
    	    }
	    }
	}
	public function forgot_password_otp()
	{
	    if ($this->session->has_userdata('logged_in')) 
    	{
    		redirect("home");
	    }
	    else
	    {
    	    $data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('forgot_password_otp',$data);
	    }
	}
	public function otp_submit()
	{
	    if ($this->session->has_userdata('logged_in')) 
    	{
    		redirect("home");
	    }
	    else
	    {
	        if($this->session->has_userdata('session_fp_email'))
	        {
    	        $otp = $this->input->post("otp");
    	        $fp_email = $this->session->userdata('session_fp_email');
    	        $res = $this->mm->check_otp($otp,$fp_email);
    	        foreach($res as $row)
        	    {
        	        $start_time = $row->start_time;
        	        $end_time = $row->end_time;
        	        
        	        if(($start_time < date("H:i:s"))&&($end_time > date("H:i:s")))
        	        {
        	            $this->session->set_userdata('change_password', TRUE);
        	            redirect("reset_password");
        	        }
        	        else
        	        {
        	           $this->session->set_flashdata('error_msg','OTP Not Matched');
        	           redirect("forgot_password_otp");
        	        }
        	    }
	        }else
	        {
        	    redirect("login");
	        }
	    }
	}
	
	public function reset_password()
	{
	    if ($this->session->has_userdata('change_password') && $this->session->userdata('change_password')) 
    	{
    		$data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('reset_password',$data);
	    }
	    else
	    {
	        redirect("login");
	    }
	}
	public function reset_password_submit()
	{
	    if ($this->session->has_userdata('change_password') && $this->session->userdata('change_password')) 
    	{
    		$new_psw = $this->input->post("new_psw");
    		$confirm_psw = $this->input->post("confirm_psw");
    		
    		if($new_psw == $confirm_psw)
    		{
    	        $fp_email = $this->session->userdata('session_fp_email');
    		    $data = array("password" => $new_psw);
    		    $this->mm->update_password($data,$fp_email);
    		    $this->session->set_flashdata('error_msg','Successfully Password Updated');
    		    redirect("login");
    		}
    		else
    		{
    		    $this->session->set_flashdata('error_msg','Password and Confirm Password  Not Matched');
        	    redirect("reset_password");
    		}
	    }
	    else
	    {
	        redirect("login");
	    }
	}
	public function home()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $user_id = "1";
    	    $pro_data["project_info"] = $this->mm->fetch_project_info();
    	    $ai_id = "";
    	    if($this->session->userdata('session_role') == "user")
    	    {
    	        $user_id = $this->session->userdata('session_id');
    	    }
    	    else if($this->session->userdata('session_role') == "AI")
    	    {
    	        $ai_id = $this->session->userdata('session_id');
    	    }
    	    
    	    //lead summary
		   	$data["followup_dashboard"] = $this->mm->fetch_today_followup_dashboard($user_id);
		   	$from_date = "all";//date("Y-m-d",strtotime("-3 months"));
            $to_date = "all";//date("Y-m-d");
            
            $data["open_lead_count"] = $this->mm->fetch_open_lead_count_dashboard("open",$user_id);
            
            $data["open_new_lead_count"] = $this->mm->fetch_open_new_lead_count_dashboard("open",$user_id);
              
            $data["active_policy_count"] = $this->mm->fetch_active_policy_count_dashboard($user_id);
            $data["open_prospect_count"] = $this->mm->fetch_open_prospect_count_dashboard("open",$user_id);
            $data["open_prospect_renewal_count"] = $this->mm->fetch_open_prospect_renewal_count_dashboard("open",$user_id);
		   	$data["hot_open_count"] = $this->mm->fetch_hot_count_dashboard("open",$from_date,$to_date,$user_id);
		   	$data["hot_followup_count"] = $this->mm->fetch_hot_count_dashboard("followup",$from_date,$to_date,$user_id);
		   	$data["warm_open_count"] = $this->mm->fetch_warm_count_dashboard("open",$from_date,$to_date,$user_id);
		   	$data["warm_followup_count"] = $this->mm->fetch_warm_count_dashboard("followup",$from_date,$to_date,$user_id);
		   	$data["cold_open_count"] = $this->mm->fetch_cold_count_dashboard("open",$from_date,$to_date,$user_id);
		   	$data["prospect_open_count"] = $this->mm->fetch_prospect_count_dashboard("open",$from_date,$to_date,$user_id);
		   	$data["cold_followup_count"] = $this->mm->fetch_cold_count_dashboard("followup",$from_date,$to_date,$user_id);
		   	$data["prospect_followup_count"] = $this->mm->fetch_prospect_count_dashboard("followup",$from_date,$to_date,$user_id);
		   	$completed = $this->mm->fetch_completed_count_dashboard($from_date,$to_date,$user_id);
		   	$business_completed = $this->mm->fetch_business_completed_count($from_date,$to_date,$user_id);
		   	$data["completed"] = $completed + $business_completed;
		   	
		   	
		   	//prospect summary
    	    
    	    $data["prospect_open_renewal_count"] = $this->mm->fetch_prospect_open_count_dashboard("1",$user_id,$from_date,$to_date);
    	    $data["prospect_open_rollover_count"] = $this->mm->fetch_prospect_open_count_dashboard("2",$user_id,$from_date,$to_date);
    	    $data["prospect_open_new_bussiness_count"] = $this->mm->fetch_prospect_open_count_dashboard("3",$user_id,$from_date,$to_date);
    	    $data["prospect_followup_renewal_count"] = $this->mm->fetch_prospect_followup_count_dashboard("1",$user_id,$from_date,$to_date);
    	    $data["prospect_followup_rollover_count"] = $this->mm->fetch_prospect_followup_count_dashboard("2",$user_id,$from_date,$to_date);
    	    $data["prospect_followup_new_bussiness_count"] = $this->mm->fetch_prospect_followup_count_dashboard("3",$user_id,$from_date,$to_date);
    	    
    	    $data["prospect_complete_renewal_count"] = $this->mm->fetch_prospect_complete_count_dashboard("1",$user_id,$from_date,$to_date);
    	    $data["prospect_complete_rollover_count"] = $this->mm->fetch_prospect_complete_count_dashboard("2",$user_id,$from_date,$to_date);
    	    $data["prospect_complete_new_bussiness_count"] = $this->mm->fetch_prospect_complete_count_dashboard("3",$user_id,$from_date,$to_date);
    	    
    	    $data["prospect_lost_renewal_count"] = $this->mm->fetch_prospect_lost_count_dashboard("1",$user_id,$from_date,$to_date);
    	    $data["prospect_lost_rollover_count"] = $this->mm->fetch_prospect_lost_count_dashboard("2",$user_id,$from_date,$to_date);
    	    $data["prospect_lost_new_bussiness_count"] = $this->mm->fetch_prospect_lost_count_dashboard("3",$user_id,$from_date,$to_date);
    	    
    	    $data["quote_policy_renewal_count"] = $this->mm->fetch_policy_quote_count_dashboard("1",$user_id,$from_date,$to_date);
    	    $data["quote_policy_rollover_count"] = $this->mm->fetch_policy_quote_count_dashboard("2",$user_id,$from_date,$to_date);
    	    $data["quote_policy_new_bussiness_count"] = $this->mm->fetch_policy_quote_count_dashboard("3",$user_id,$from_date,$to_date);
    	    
    	    $data["prospect_policy_renewal_count"] = $this->mm->fetch_prospect_policy_count_dashboard("1",$user_id,$from_date,$to_date);
    	    $data["prospect_policy_rollover_count"] = $this->mm->fetch_prospect_policy_count_dashboard("2",$user_id,$from_date,$to_date);
    	    $data["prospect_policy_new_bussiness_count"] = $this->mm->fetch_prospect_policy_count_dashboard("3",$user_id,$from_date,$to_date);
    	    
    	    //Agent
    	    $filter_type = "All";
    	   // $agent_arr = $this->load_agent_pos_table("agent",$user_id,$filter_type,$from_date,$to_date);
    	   // $data["agent_dash"] = $agent_arr["html"];
    	   // $data["is_load_more_available"] = $agent_arr["is_load_more_available"];
    	   // $staff_arr = $this->load_staff_table($user_id,$filter_type,$from_date,$to_date);
    	   // $data["staff_dash"] = $staff_arr["html"];
    	   // $data["is_staff_load_more_available"] = $staff_arr["is_load_more_available"];
    	    
    	   // $ai_arr = $this->load_ai_table($filter_type,$from_date,$to_date,$ai_id);
    	   // $data["ai_dash"] = $ai_arr["html"];
    	   // $data["is_ai_load_more_available"] = $ai_arr["is_load_more_available"];
    	   
    	   
    	    // get current year month list array pass to view by kgk on 2023-01-11
    	    $data['monthlist'] = $this->getMonthList();
    	    
    	    //  lead created person filter list array pass to view by kgk on 2023-01-11
    	    $data['searchbylist'] = ['users' => 'Users', 'ai' => "Area Incharge", 'agents_pos' => 'Agent / POS'];
    	    
    	    //pass current month to view by kgk on 2023-02-11
    	    $data['current_month'] = date('m');
    	    
    		$this->load->view('header',$pro_data);
    		//$this->load->view('sidebar',$pro_data);
    		$this->load->view('home',$data);
            // $maxExecutionTime = ini_get('max_execution_time');
            // echo $maxExecutionTime;
    		$this->load->view('footer',$pro_data);
    	    
	    }
	    else
	    {
	    	redirect("login");
	    }
	}
	public function changepassword()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
			$email_id = $this->session->userdata("session_email_id");
			$password = $this->input->post('current_password');
			$res = $this->mm->fetch_single_admin_login($email_id);

    		if($res != NULL)
    	    {
    	        if($password == $res->password)
    	        {
                    echo "success";
    	        }
    	        else
    	        {
    	            echo "failed";
    	        }
            }
            else
            {
                echo "failed";
            }
		}
		else
		{
			echo "logout";
		}
	}
	public function update_new_password()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $password = $this->input->post('password');
    	    $email_id = $this->session->userdata("session_email_id");
    	    $data = array("password" => $password);
    		$this->mm->update_password($data,$email_id);

    		$this->session->unset_userdata('logged_in');
    		$this->session->unset_userdata('session_id');
			$this->session->unset_userdata('session_name');
			$this->session->unset_userdata('session_email_id');
			$this->session->unset_userdata('session_role');
			$this->session->set_userdata('session_company_type', 'jayantha');
			delete_cookie('email_id');
    		$this->session->set_flashdata('error_msg','Successfully Password Updated');
    	}
    	else
    	{
    	    echo "logout";
    	}
	}
	public function logout()
	{
	    $this->session->unset_userdata('logged_in');
		$this->session->unset_userdata('session_name');
		$this->session->unset_userdata('session_id');
		$this->session->unset_userdata('session_email_id');
		$this->session->unset_userdata('session_role');
		$this->session->unset_userdata('session_company_type');
		delete_cookie('email_id');
        $this->session->set_flashdata('error_msg','Successfully Logout');
        redirect("login");
	}
	
	public function datatable()
	{
		if($this->session->has_userdata('logged_in')) 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('sidebar',$pro_data);
    		$this->load->view('datatable');
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}

	public function fetch_blogs()
	{
	    $arr = [];
        $a = $_GET['start'] ;
        
	    $res = $this->mm->fetch_blogs();
	    
	    foreach($res as $da)
        {
            $action = "<a class='btn btn-xs btn-info' href=./../tutorial/view_blog?language=".$da->language."&topic=".$da->topic."&blog=".$da->id." target='_blank'><i class='fa fa-eye'></i> View</a>
                        <a class='btn btn-xs btn-warning' href=edit_blog?id=".$da->id."><i class='fa fa-edit'></i> Edit</a> 
                        <button class='btn btn-xs btn-danger' onclick=delete_data(".$da->id.")> <i class='fa fa-trash'></i> Delete</button>";
            $a++;
            $btn = "";                            
            $arr[] = array(
                $a,
                $da->title_of_blog,
                $da->lg_name,
                $da->tp_name,
                $action,
            );
        }
        
        $result = array("draw"=> $_GET['draw'],
        "recordsTotal"=> $this->mm->get_all_blogs(),
        "recordsFiltered"=> $this->mm->get_filtered_blogs(),
        "data"=>$arr);
        
        echo json_encode($result);
	}
    
    public function lead_summary_with_date()
    {
        $lead_select = $this->input->post("lead_select");
        $from_date = $this->input->post("from_date");
        $to_date = $this->input->post("to_date");
        
        if($lead_select == "Today")
        {
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d");
        }
        else if($lead_select == "Tommorrow")
        {
             $from_date = date('Y-m-d',strtotime("+1 days"));
             $to_date = date("Y-m-d" ,strtotime("+1 days"));
        }
        else if($lead_select == "Next 7 days")
        {
            $to_date = date('Y-m-d',strtotime("+7 days"));
            $from_date = date('Y-m-d');
        }
        else if($lead_select == "Next 30 days")
        {
            $to_date = date('Y-m-d',strtotime("+30 days"));
            $from_date = date('Y-m-d');
        }
        else if($lead_select == "This month")
        {
             $from_date = date('Y-m-01');
             $to_date = date("Y-m-t");
        }
        // else if($lead_select == "Last month")
        // {
        //     $month_ini = new DateTime("first day of last month");
        //     $month_end = new DateTime("last day of last month");
        //     $from_date = $month_ini->format('Y-m-d');
        //     $to_date = $month_end->format('Y-m-d');
        // }
        else if($lead_select == "Next 3 months")
        {
            $to_date = date("Y-m-d",strtotime("+3 months"));
            $from_date = date("Y-m-d");
        }
        else if($lead_select == "Overdue")
        {
             $from_date = "all";
             $to_date = date("Y-m-d",strtotime("-1 days"));
        }
        else if($lead_select == "Noduedate")
        {
             $from_date = "Noduedate";
             $to_date = "Noduedate";
        }
        else if($lead_select == "All")
        {
            $from_date = "all";
            $to_date = "all";
        }
        
        $user_id = 1;
        
        if($this->session->has_userdata('session_role') == "user")
	    {
	        $user_id = $this->session->userdata('session_id');
	    }
	  
        $hot_open_count = $this->mm->fetch_hot_count_dashboard("open",$from_date,$to_date,$user_id);
        
	   	$hot_followup_count = $this->mm->fetch_hot_count_dashboard("followup",$from_date,$to_date,$user_id);
	   	$warm_open_count = $this->mm->fetch_warm_count_dashboard("open",$from_date,$to_date,$user_id);
	   	$warm_followup_count = $this->mm->fetch_warm_count_dashboard("followup",$from_date,$to_date,$user_id);
	   	$cold_open_count = $this->mm->fetch_cold_count_dashboard("open",$from_date,$to_date,$user_id);
	   	$prospect_open_count = $this->mm->fetch_prospect_count_dashboard("open",$from_date,$to_date,$user_id);
	   	$cold_followup_count = $this->mm->fetch_cold_count_dashboard("followup",$from_date,$to_date,$user_id);
	   	$prospect_followup_count = $this->mm->fetch_prospect_count_dashboard("followup",$from_date,$to_date,$user_id);
	   	$completed = $this->mm->fetch_completed_count_dashboard($from_date,$to_date,$user_id);
	   	$business_completed = $this->mm->fetch_business_completed_count($from_date,$to_date,$user_id);
	   	
	   	
	   	$data = array("hot_open_count" => $hot_open_count,
               "hot_followup_count" => $hot_followup_count,
               "warm_open_count" => $warm_open_count,
               "warm_followup_count" => $warm_followup_count,
               "cold_open_count" => $cold_open_count,
               "cold_followup_count" => $cold_followup_count,
               "prospect_open_count" => $prospect_open_count,
               "prospect_followup_count" => $prospect_followup_count,
               "completed" => $completed + $business_completed,
               );
	    
       echo json_encode(array("data" => $data,"from_date" => date("d-m-Y",strtotime($from_date)),"to_date" => date("d-m-Y",strtotime($to_date))));
    }
    
    public function prospect_summary_with_date()
    {
        $prospect_select = $this->input->post("prospect_select");
        $from_date = $this->input->post("from_date");
        $to_date = $this->input->post("to_date");
        if($prospect_select == "Today")
        {
            $from_date = date("Y-m-d");
            $to_date = "all";//date("Y-m-d");
        }
        else if($prospect_select == "Yesterday")
        {
             $from_date = date('Y-m-d',strtotime("-1 days"));
             $to_date = date("Y-m-d");
        }
        else if($prospect_select == "Last 7 days")
        {
            $from_date = date('Y-m-d',strtotime("-7 days"));
            $to_date = date('Y-m-d');
        }
        else if($prospect_select == "Last 30 days")
        {
            $from_date = date('Y-m-d',strtotime("-30 days"));
            $to_date = date('Y-m-d');
        }
        else if($prospect_select == "This month")
        {
             $from_date = date('Y-m-01');
             $to_date = date("Y-m-d");
        }
        else if($prospect_select == "Last month")
        {
            $month_ini = new DateTime("first day of last month");
            $month_end = new DateTime("last day of last month");
            $from_date = $month_ini->format('Y-m-d');
            $to_date = $month_end->format('Y-m-d');
        }
        else if($prospect_select == "Last 3 months")
        {
            $from_date = date("Y-m-d",strtotime("-3 months"));
            $to_date = date("Y-m-d");
        }
        else if($prospect_select == "All")
        {
            $from_date = "all";
            $to_date = "all";
        }
        $user_id = 1;
        if($this->session->has_userdata('session_role') == "user")
	    {
	        $user_id = $this->session->userdata('session_id');
	    }
	    $data = [];
	    $data["prospect_open_renewal_count"] = $this->mm->fetch_prospect_open_count_dashboard("1",$user_id,$from_date,$to_date);
	    $data["prospect_open_rollover_count"] = $this->mm->fetch_prospect_open_count_dashboard("2",$user_id,$from_date,$to_date);
	    $data["prospect_open_new_bussiness_count"] = $this->mm->fetch_prospect_open_count_dashboard("3",$user_id,$from_date,$to_date);
	    $data["prospect_followup_renewal_count"] = $this->mm->fetch_prospect_followup_count_dashboard("1",$user_id,$from_date,$to_date);
	    $data["prospect_followup_rollover_count"] = $this->mm->fetch_prospect_followup_count_dashboard("2",$user_id,$from_date,$to_date);
	    $data["prospect_followup_new_bussiness_count"] = $this->mm->fetch_prospect_followup_count_dashboard("3",$user_id,$from_date,$to_date);
	    
	    $data["prospect_complete_renewal_count"] = $this->mm->fetch_prospect_complete_count_dashboard("1",$user_id,$from_date,$to_date);
	    $data["prospect_complete_rollover_count"] = $this->mm->fetch_prospect_complete_count_dashboard("2",$user_id,$from_date,$to_date);
	    $data["prospect_complete_new_bussiness_count"] = $this->mm->fetch_prospect_complete_count_dashboard("3",$user_id,$from_date,$to_date);
	    
	    $data["prospect_lost_renewal_count"] = $this->mm->fetch_prospect_lost_count_dashboard("1",$user_id,$from_date,$to_date);
	    $data["prospect_lost_rollover_count"] = $this->mm->fetch_prospect_lost_count_dashboard("2",$user_id,$from_date,$to_date);
	    $data["prospect_lost_new_bussiness_count"] = $this->mm->fetch_prospect_lost_count_dashboard("3",$user_id,$from_date,$to_date);
	    
	    $data["prospect_policy_renewal_count"] = $this->mm->fetch_prospect_policy_count_dashboard("1",$user_id,$from_date,$to_date);
	    $data["prospect_policy_rollover_count"] = $this->mm->fetch_prospect_policy_count_dashboard("2",$user_id,$from_date,$to_date);
	    $data["prospect_policy_new_bussiness_count"] = $this->mm->fetch_prospect_policy_count_dashboard("3",$user_id,$from_date,$to_date);
	   echo json_encode(array("data" => $data,"from_date" => date("d-m-Y",strtotime($from_date)),"to_date" => date("d-m-Y",strtotime($to_date))));
    }
    public function fetch_prospect_dashboard()
    {
        $draw = intval($this->input->post("draw"));
		$prospect_due_date = $this->input->post("prospect_due_date");
		$from_date = "all";
		$to_date = "all";
		if($prospect_due_date == "Overdue")
		{
		     $from_date = "all";
             $to_date = date("Y-m-d",strtotime("-1 days"));
		}
		else if($prospect_due_date == "7 days")
		{
		     $from_date = date("Y-m-d");
             $to_date = date('Y-m-d',strtotime("7 days"));
		}
		else if($prospect_due_date == "8-15 days")
		{
		    $from_date = date('Y-m-d',strtotime("8 days"));
            $to_date = date('Y-m-d',strtotime("15 days"));
		}
		else if($prospect_due_date == "16-30 days")
		{
		    $from_date = date('Y-m-d',strtotime("16 days"));
            $to_date = date('Y-m-d',strtotime("30 days"));
		}
		else if($prospect_due_date == "31-45 days")
		{
		     $from_date = date('Y-m-d',strtotime("31 days"));
             $to_date = date('Y-m-d',strtotime("45 days"));
		}
		$res = array();
		if($this->session->has_userdata('logged_in')) 
    	{
    	     $user_id = 1;
            if($this->session->has_userdata('session_role') == "user")
    	    {
    	        $user_id = $this->session->userdata('session_id');
    	    }
			$res = $this->mm->fetch_prospect_dashboard($user_id,$from_date,$to_date);
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Edit</button>";
            
            $arr[] = array(
                $a,
                $this->mm->fetch_class_name($da->class),
                substr($this->mm->get_client_name($da->id),0,30),
                $this->mm->get_user_name($da->assigned_user),
                date("d-m-Y",strtotime($da->due_date)),
                $da->lead_status,
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
    // change the function name [prefix add "_" ]
    public function _load_agent_pos_table($type,$user_id,$filter_type,$from_date,$to_date)
    {
        $res = $this->mm->load_agent_pos($type,$user_id);
        
        $r_url = "agent_view";
        $r_url1 = "bussiness_followup";
        
        if($filter_type == "Overdue")
        {
             $from_date = "all";
             $to_date = date("Y-m-d",strtotime("-1 days"));
        }
        else if($filter_type == "Today")
        {
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d");
        }
        else if($filter_type == "Tommorrow")
        {
             $from_date = date('Y-m-d');
             $to_date = date("Y-m-d",strtotime("+1 days"));
        }
        else if($filter_type == "Next 7 days")
        {
            $from_date = date('Y-m-d');
            $to_date = date('Y-m-d',strtotime("+7 days"));
        }
        else if($filter_type == "Next 30 days")
        {
            $from_date = date('Y-m-d');
            $to_date = date('Y-m-d',strtotime("+30 days"));
        }
        else if($filter_type == "This month")
        {
             $from_date = date('Y-m-01');
             $to_date = date("Y-m-t");
        }
        else if($filter_type == "Next month")
        {
            $month_ini = new DateTime("first day of next month");
            $month_end = new DateTime("last day of next month");
            $from_date = $month_ini->format('Y-m-d');
            $to_date = $month_end->format('Y-m-d');
        }
        else if($filter_type == "Next 3 months")
        {
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d",strtotime("+3 months"));
        }
        else if($filter_type == "Noduedate")
        {
            $from_date = "Noduedate";
            $to_date = "Noduedate";
        }
        else if($filter_type == "All")
        {
            $from_date = "all";
            $to_date = "all";
        }
        $html = "";
        $res1 = array();
        $rem = array();
        
        $temp_agent_open_count = 0; 
        
        $agent_open_count1 = array();
        $agent_open_count2 = array();
        
        //$_result = $this->mm->agent_status_dashboard($from_date,$to_date);
        //$sql = $this->db->last_query();
        
        //return array("html" => $sql, "is_load_more_available" => $_result);
        foreach($res as $r)
         {
             $agent_count = $this->mm->agent_open_count($r->id,$from_date,$to_date);
             $sql .= $this->db->last_query()."\n";
             if(!in_array($agent_count,$agent_open_count1))
             {
                  $agent_open_count1 [] = $agent_count;
             }
         }
         
        rsort($agent_open_count1);
        //return array("html" => $agent_open_count1, "is_load_more_available" => false);
        $is_load_more_available = false;
        // for($i = 0; $i<5; $i++)
        // {
        //     if($i<count($agent_open_count1))
        //     {
        //         $agent_open_count2[] = $agent_open_count1[$i];
        //     }
        //     else
        //     {
        //         $is_load_more_available = false;
        //     }
        // }
        $row_count = 1;
       //foreach($agent_open_count1 as $ag)
       //{
           foreach($res as $r)
            {
                $agent_open_count = $this->mm->agent_open_count($r->id,$from_date,$to_date); 
                //if($ag == $agent_open_count)
                //{
                    if($row_count <= 10)
                    {
                        $html .= '<tr><td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="'.$r_url1.'?id='.$r->id.'">'.$r->name.'</a></td>';
                        $agent_open_count = $this->mm->agent_open_count($r->id,$from_date,$to_date); 
                        $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$agent_open_count.'</a></td>';
                        $agent_followup_count = $this->mm->agent_followup_count($r->id,$from_date,$to_date); 
                        $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$agent_followup_count.'</a></td>';
                       $agent_completed_count = $this->mm->agent_completed_count($r->id,$from_date,$to_date); 
                       $agent_bussiness_completed_count = $this->mm->agent_business_completed_count($r->id,$from_date,$to_date);   
                       $completed = $agent_completed_count + $agent_bussiness_completed_count;
                        $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$completed.'</a></td>';
                        $agent_lost_count = $this->mm->agent_lost_count($r->id,$from_date,$to_date); 
                        $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$agent_lost_count.'</a></td>';
                        $agent_total_count = $agent_open_count + $agent_followup_count + $completed + $agent_lost_count;
                        $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$agent_total_count.'</a></td></tr>';
                
                    }
                    
                     else
                     {
                         $is_load_more_available = true;
                         return array("html" => $html, "is_load_more_available" => $is_load_more_available);
                     }
                     
                    $row_count++;
                //}
            }
       //}
        return array("html" => $html, "is_load_more_available" => $is_load_more_available);
    }
    
    // kgk on 2023-02-04
    public function load_agent_pos_table($type,$user_id,$filter_type,$from_date,$to_date, $offset = 0, $limit = 10)
    {               
        $r_url = "agent_view";
        $r_url1 = "bussiness_followup";
        
        if($filter_type == "Overdue")
        {
             $from_date = "all";
             $to_date = date("Y-m-d",strtotime("-1 days"));
        }
        else if($filter_type == "Today")
        {
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d");
        }
        else if($filter_type == "Tommorrow")
        {
             $from_date = date('Y-m-d');
             $to_date = date("Y-m-d",strtotime("+1 days"));
        }
        else if($filter_type == "Next 7 days")
        {
            $from_date = date('Y-m-d');
            $to_date = date('Y-m-d',strtotime("+7 days"));
        }
        else if($filter_type == "Next 30 days")
        {
            $from_date = date('Y-m-d');
            $to_date = date('Y-m-d',strtotime("+30 days"));
        }
        else if($filter_type == "This month")
        {
             $from_date = date('Y-m-01');
             $to_date = date("Y-m-t");
        }
        else if($filter_type == "Next month")
        {
            $month_ini = new DateTime("first day of next month");
            $month_end = new DateTime("last day of next month");
            $from_date = $month_ini->format('Y-m-d');
            $to_date = $month_end->format('Y-m-d');
        }
        else if($filter_type == "Next 3 months")
        {
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d",strtotime("+3 months"));
        }
        else if($filter_type == "Noduedate")
        {
            $from_date = "Noduedate";
            $to_date = "Noduedate";
        }
        else if($filter_type == "All")
        {
            $from_date = "all";
            $to_date = "all";
        }
        $html = "";$is_load_more_available = false;
        
        
        $result = $this->mm->agent_status_dashboard($type,$user_id, $from_date,$to_date, $offset, $limit);
        $sql = $this->db->last_query();
		if( isset( $result ) && !empty( $result ) ) {
		    $is_load_more_available = true;
			foreach( $result as $r ) {
				$html .= '<tr><td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="'.$r_url1.'?id='.$r->id.'">'.$r->name.'</a></td>';
                        
				$html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$r->agent_open_count.'</a></td>';
				
				$html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$r->agent_followup_count.'</a></td>';
			   $completed = $r->agent_completed_count + $r->agent_business_completed_count;
				$html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$completed.'</a></td>';
				
				$html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$r->agent_lost_count.'</a></td>';
				$agent_total_count = $r->agent_open_count + $r->agent_followup_count + $completed + $r->agent_lost_count;
				$html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$agent_total_count.'</a></td></tr>';
			}
			unset($r);
		} else {
		    $html .= '<tr><td colspan="6" class = "no_mar_pad">data not found</td></tr>';
		    $is_load_more_available = false;
		}
		
		return array("html" => $html, "is_load_more_available" => $is_load_more_available);			
    }
    
    
    public function load_staff_table($user_id,$filter_type,$from_date,$to_date)
    {
        $res = $this->mm->load_staff($user_id);
        //$r_url = "leads";
        $r_url = "staff_view";
        
        if($filter_type == "Overdue")
		{
		     $from_date = "all";
             $to_date = date("Y-m-d",strtotime("-1 days"));
		}
        if($filter_type == "Today")
        {
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d");
        }
        else if($filter_type == "Tommorrow")
        {
             $from_date = date('Y-m-d',strtotime("+1 days"));
             $to_date = date("Y-m-d",strtotime("+1 days"));
        }
        else if($filter_type == "Next 7 days")
        {
            $to_date = date('Y-m-d',strtotime("+7 days"));
            $from_date = date('Y-m-d');
        }
        else if($filter_type == "Next 30 days")
        {
            $to_date = date('Y-m-d',strtotime("+30 days"));
            $from_date = date('Y-m-d');
        }
        else if($filter_type == "This month")
        {
             $from_date = date('Y-m-01');
             $to_date = date("Y-m-t");
        }
        else if($filter_type == "Next month")
        {
            $month_ini = new DateTime("first day of next month");
            $month_end = new DateTime("last day of next month");
            $from_date = $month_ini->format('Y-m-d');
            $to_date = $month_end->format('Y-m-d');
        }
        else if($filter_type == "Next 3 months")
        {
            $to_date = date("Y-m-d",strtotime("+3 months"));
            $from_date = date("Y-m-d");
        }
        else if($filter_type == "Noduedate")
        {
             $from_date = "Noduedate";
             $to_date = "Noduedate";
        }
        else if($filter_type == "All")
        {
            $from_date = "all";
            $to_date = "all";
        }
        $html = "";
        $res1 = array();
        $rem = array();
        
        $temp_staff_open_count = 0; 
        
        $staff_open_count1 = array();
        
        foreach($res as $r)
         {
             $staff_count = $this->mm->staff_open_count($r->id,$from_date,$to_date);
             if(!in_array($staff_count,$staff_open_count1))
             {
                  $staff_open_count1 [] = $staff_count;
             }
         }
        rsort($staff_open_count1);
        $is_load_more_available = false;
        $row_count = 1;
       foreach($staff_open_count1 as $ag)
       {
           foreach($res as $r)
            {
                $staff_open_count = $this->mm->staff_open_count($r->id,$from_date,$to_date); 
                
                if($ag == $staff_open_count)
                {
                    if($row_count <= 10)
                    {
                        $html .= '<tr><td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="'.$r_url.'?id='.$r->id.'">'.$r->name.'</a></td>';
                        $staff_open_count = $this->mm->staff_open_count($r->id,$from_date,$to_date); 
                        $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$staff_open_count.'</a></td>';
                        $staff_followup_count = $this->mm->staff_followup_count($r->id,$from_date,$to_date); 
                        $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$staff_followup_count.'</a></td>';
                      
                        $staff_completed_count = $this->mm->staff_completed_count($r->id,$from_date,$to_date); 
                        
                        $staff_business_count = $this->mm->staff_business_completed_count($r->id,$from_date,$to_date); 
                        
                        $completed = $staff_completed_count + $staff_business_count;
                        
                        
                        $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$completed.'</a></td>';
                        $staff_lost_count = $this->mm->staff_lost_count($r->id,$from_date,$to_date); 
                        $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$staff_lost_count.'</a></td>';
                        $staff_total_count = $staff_open_count + $staff_followup_count + $completed + $staff_lost_count;
                        $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$staff_total_count.'</a></td></tr>';
                
                    }
                     else
                     {
                         $is_load_more_available = true;
                         return array("html" => $html, "is_load_more_available" => $is_load_more_available);
                     }
                    $row_count++;
                }
            }
       }
        unset($res);
       unset($staff_open_count1);
        return array("html" => $html, "is_load_more_available" => $is_load_more_available);
    }
    
    public function _load_ai_table($filter_type,$from_date,$to_date,$ai_id)
    {
       
        $res = array();
        
        if($this->session->userdata("session_role") == "user")
        {
            $district = $this->mm->get_user_district($this->session->userdata("session_id"));
            
            $district_id = [];
            
            foreach($district as $da)
            {
              $district_id[] = $da->district_id;
            }
            
            $get_district_id = $this->mm->get_region_id_by_district_id($district_id);
            
            $region_id = [];
            
            foreach($get_district_id as $da)
            { 
              $region_id[] = $da->id;
            }
            
            $res = $this->mm->get_area_incharge($region_id);
        }
        else if($this->session->userdata("session_role") == "admin" || $this->session->userdata("session_role") == "AI")
        {
             $res = $this->mm->load_ai($ai_id);
        }
       
        $r_url = "ai_view";
        $r_url1 = "bussiness_followup_ai";
        
        if($filter_type == "Overdue")
        {
             $from_date = "all";
             $to_date = date("Y-m-d",strtotime("-1 days"));
        }
        else if($filter_type == "Today")
        {
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d");
        }
        else if($filter_type == "Tommorrow")
        {
             $from_date = date('Y-m-d',strtotime("+1 days"));
             $to_date = date("Y-m-d",strtotime("+1 days"));
        }
        else if($filter_type == "Next 7 days")
        {
            $from_date = date('Y-m-d');
            $to_date = date('Y-m-d',strtotime("+7 days"));
        }
        else if($filter_type == "Next 30 days")
        {
            $from_date = date('Y-m-d');
            $to_date = date('Y-m-d',strtotime("+30 days"));
        }
        else if($filter_type == "This month")
        {
             $from_date = date('Y-m-01');
             $to_date = date("Y-m-t");
        }
        else if($filter_type == "Next month")
        {
            $month_ini = new DateTime("first day of next month");
            $month_end = new DateTime("last day of next month");
            $from_date = $month_ini->format('Y-m-d');
            $to_date = $month_end->format('Y-m-d');
        }
        else if($filter_type == "Next 3 months")
        {
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d",strtotime("+3 months"));
        }
        else if($filter_type == "Noduedate")
        {
            $from_date = "Noduedate";
            $to_date = "Noduedate";
        }
        else if($filter_type == "All")
        {
            $from_date = "all";
            $to_date = "all";
        }
        $html = "";
        $res1 = array();
        $rem = array();
        
        
        $temp_ai_open_count = 0; 
        
        $ai_open_count1 = array();
        
        foreach($res as $r)
         {
             
             $ai_count = $this->mm->ai_open_count($r->id,$from_date,$to_date);
             if(!in_array($ai_count,$ai_open_count1))
             {
                  $ai_open_count1 [] = $ai_count;
             }
         }
         
        rsort($ai_open_count1);
        $is_load_more_available = false;
        $row_count = 1;
       foreach($ai_open_count1 as $ag)
       {
           foreach($res as $r)
            {
                $ai_open_count = $this->mm->ai_open_count($r->id,$from_date,$to_date); 
                if($ag == $ai_open_count)
                {
                    if($row_count <= 10)
                    {
                        $html .= '<tr><td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="'.$r_url1.'?id='.$r->id.'">'.$r->name.'</a></td>';
                        $ai_open_count = $this->mm->ai_open_count($r->id,$from_date,$to_date); 
                        $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$ai_open_count.'</a></td>';
                        $ai_followup_count = $this->mm->ai_followup_count($r->id,$from_date,$to_date); 
                        $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$ai_followup_count.'</a></td>';
                       
                        $ai_completed_count = $this->mm->ai_completed_count($r->id,$from_date,$to_date); 
                        $ai_business_completed_count = $this->mm->ai_business_completed_count($r->id,$from_date,$to_date); 

                        $completed = $ai_completed_count + $ai_business_completed_count;
                        
                        $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$completed.'</a></td>';
                        $ai_lost_count = $this->mm->ai_lost_count($r->id,$from_date,$to_date); 
                        $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$ai_lost_count.'</a></td>';
                        $ai_total_count = $ai_open_count + $ai_followup_count + $completed + $ai_lost_count;
                        $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$ai_total_count.'</a></td></tr>';
                
                    }
                     else
                     {
                         $is_load_more_available = true;
                         return array("html" => $html, "is_load_more_available" => $is_load_more_available);
                     }
                    $row_count++;
                }
            }
       }
        unset($res);
       unset($staff_open_count1);
        return array("html" => $html, "is_load_more_available" => $is_load_more_available);
    }
    
    public function load_ai_table($filter_type,$from_date,$to_date,$ai_id, $offset, $limit)
    {
        $res = [];
        $html = "";
        $r_url = "ai_view";
        $r_url1 = "bussiness_followup_ai";
        
        if($filter_type == "Overdue")
        {
             $from_date = "all";
             $to_date = date("Y-m-d",strtotime("-1 days"));
        }
        else if($filter_type == "Today")
        {
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d");
        }
        else if($filter_type == "Tommorrow")
        {
             $from_date = date('Y-m-d',strtotime("+1 days"));
             $to_date = date("Y-m-d",strtotime("+1 days"));
        }
        else if($filter_type == "Next 7 days")
        {
            $from_date = date('Y-m-d');
            $to_date = date('Y-m-d',strtotime("+7 days"));
        }
        else if($filter_type == "Next 30 days")
        {
            $from_date = date('Y-m-d');
            $to_date = date('Y-m-d',strtotime("+30 days"));
        }
        else if($filter_type == "This month")
        {
             $from_date = date('Y-m-01');
             $to_date = date("Y-m-t");
        }
        else if($filter_type == "Next month")
        {
            $month_ini = new DateTime("first day of next month");
            $month_end = new DateTime("last day of next month");
            $from_date = $month_ini->format('Y-m-d');
            $to_date = $month_end->format('Y-m-d');
        }
        else if($filter_type == "Next 3 months")
        {
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d",strtotime("+3 months"));
        }
        else if($filter_type == "Noduedate")
        {
            $from_date = "Noduedate";
            $to_date = "Noduedate";
        }
        else if($filter_type == "All")
        {
            $from_date = "all";
            $to_date = "all";
        }
        
        $is_load_more_available = true;
        
        if($this->session->userdata("session_role") == "user")
        {
            $district = $this->mm->get_user_district($this->session->userdata("session_id"));
            
            $district_id = [];
            
            foreach($district as $da)
            {
              $district_id[] = $da->district_id;
            }
            
            $get_district_id = $this->mm->get_region_id_by_district_id($district_id);
            
            $region_id = [];
            
            foreach($get_district_id as $da)
            { 
              $region_id[] = $da->id;
            }
            
            $res = $this->mm->get_area_incharge($region_id);
        }
        else if($this->session->userdata("session_role") == "admin" || $this->session->userdata("session_role") == "AI")
        {
             $res = $this->mm->load_ai($ai_id);
        }
       
        if( isset( $res ) && !empty( $res ) ) {
           $userID = array_map(function($row){
               return $row->id;
           }, $res);
        }
        
        
       
        $result = $this->mm->ai_status_dashboard($userID, $from_date,$to_date, $offset, $limit);
        //echo $this->db->last_query();
        if( isset( $result ) && !empty( $result ) ) {
            unset($row);
            foreach( $result as $row ) {
                $html .= '<tr><td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="'.$r_url1.'?id='.$row->id.'">'.$row->name.'</a></td>';
                
                $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$row->ai_open_count.'</a></td>';
                
                $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$row->ai_followup_count.'</a></td>';
               
                $completed = $row->ai_completed_count + $row->ai_business_completed_count;
                
                $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$completed.'</a></td>';
                
                $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$row->ai_lost_count.'</a></td>';
                $ai_total_count = $row->ai_open_count + $row->ai_followup_count + $completed + $row->ai_lost_count;
                $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$ai_total_count.'</a></td></tr>';
            }
        }
        
        return array("html" => $html, "is_load_more_available" => $is_load_more_available);
    }
    
    public function ai_dashboard()
    {
        if($this->session->has_userdata('logged_in')) 
    	{
    	     $user_id = 1;
    	     $filter_type = $this->input->post("ai_date_filter_select");
    	     $from_date = $this->input->post("ai_from_date");
    	     $to_date = $this->input->post("ai_to_date");
    	     $ai_id = "";
    	     $offset = $this->input->post("offset");
    	     $limit = 10;
    	    
    	     if($this->session->userdata('session_role') == "AI")
    	    {
    	        $ai_id = $this->session->userdata('session_id');
    	    }
    	     $html_arr = $this->load_ai_table($filter_type,$from_date,$to_date,$ai_id, $offset, $limit);
    	     $html = $html_arr["html"];
    	     
    	     $is_load_more_available = $html_arr["is_load_more_available"];
    	     if($from_date != "all")
    	    {
    	        $from_date = date("d-m-Y",strtotime($from_date));
    	    }
    	    if($to_date != "all")
    	    {
    	        $to_date = date("d-m-Y",strtotime($to_date));
    	    }
    	     echo json_encode(array("html" => $html, "from_date" => $from_date, "to_date" => $to_date, "is_load_more_available" => $is_load_more_available, "offset" => ($offset + $limit)));
    	}
    }
    
    public function ai_load_more()
    {
         if($this->session->has_userdata('logged_in')) 
    	 {
    	     $filter_type = $this->input->post("ai_date_filter_select");
    	     $from_date = $this->input->post("ai_from_date");
    	     $to_date = $this->input->post("ai_to_date");
    	     $ai_page_no = $this->input->post("ai_page_no");
    	     if($this->session->userdata("session_role") == "user")
        {
           $district = $this->mm->get_user_district($this->session->userdata("session_id"));
               
               $district_id = [];
               
               foreach($district as $da)
               {
                   $district_id[] = $da->district_id;
               }
               
                $get_district_id = $this->mm->get_region_id_by_district_id($district_id);
                           
                 $region_id = [];
               
               foreach($get_district_id as $da){ 
                   $region_id[] = $da->id;
               }
               
               $res = $this->mm->get_area_incharge($region_id);
               
           
        }
        else if($this->session->userdata("session_role") == "admin" || $this->session->userdata("session_role") == "AI")
        {
             $res = $this->mm->load_ai($ai_id);
        }
            $r_url = "ai_view";
            $r_url1 = "bussiness_followup_ai";
            if($filter_type == "Today")
            {
                $from_date = date("Y-m-d");
                $to_date = "all";//date("Y-m-d");
            }
            else if($filter_type == "Yesterday")
            {
                 $from_date = date('Y-m-d',strtotime("-1 days"));
                 $to_date = date("Y-m-d");
            }
            else if($filter_type == "Last 7 days")
            {
                $from_date = date('Y-m-d',strtotime("-7 days"));
                $to_date = date('Y-m-d');
            }
            else if($filter_type == "Last 30 days")
            {
                $from_date = date('Y-m-d',strtotime("-30 days"));
                $to_date = date('Y-m-d');
            }
            else if($filter_type == "This month")
            {
                 $from_date = date('Y-m-01');
                 $to_date = date("Y-m-d");
            }
            else if($filter_type == "Last month")
            {
                $month_ini = new DateTime("first day of last month");
                $month_end = new DateTime("last day of last month");
                $from_date = $month_ini->format('Y-m-d');
                $to_date = $month_end->format('Y-m-d');
            }
            else if($filter_type == "Last 3 months")
            {
                $from_date = date("Y-m-d",strtotime("-3 months"));
                $to_date = date("Y-m-d");
            }
            else if($filter_type == "All")
            {
                $from_date = "all";
                $to_date = "all";
            }
            $html = "";
            $res1 = array();
            $rem = array();
            
            $temp_staff_open_count = 0; 
            
            $staff_open_count1 = array();
            $staff_open_count2 = array();
            
            foreach($res as $r)
             {
                  $ai_open_count1 [] = $this->mm->ai_open_count($r->id,$from_date,$to_date);
             }
            rsort($ai_open_count1);
            $is_load_more_available = false;
        $row_count = 1;
        $row_start = $ai_page_no * 10;
        $row_start++;
        $row_end = $row_start + 9;
        $temp_array[] = 0;
       foreach($ai_open_count1 as $ag)
       {
           foreach($res as $r)
            {
                if(!in_array($r->id, $temp_array))
                {
                    $ai_open_count = $this->mm->ai_open_count($r->id,$from_date,$to_date); 
                    if($ag == $ai_open_count)
                    {
                        if($row_count < $row_start)
                        {
                            $temp_array[] = $r->id;
                        }
                        else if($row_start <= $row_end)
                        {
                            $temp_array[] = $r->id;
                            $html .= '<tr><td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="'.$r_url1.'?id='.$r->id.'">'.$r->name.'</a></td>';
                            $ai_open_count = $this->mm->ai_open_count($r->id,$from_date,$to_date); 
                            $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$ai_open_count.'</a></td>';
                            $ai_followup_count = $this->mm->ai_followup_count($r->id,$from_date,$to_date); 
                            $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$ai_followup_count.'</a></td>';
                            $ai_completed_count = $this->mm->ai_completed_count($r->id,$from_date,$to_date); 
                            $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$ai_completed_count.'</a></td>';
                            $ai_lost_count = $this->mm->ai_lost_count($r->id,$from_date,$to_date); 
                            $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$ai_lost_count.'</a></td>';
                            $ai_total_count = $ai_open_count + $ai_followup_count + $ai_completed_count + $ai_lost_count;
                            $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$ai_total_count.'</a></td></tr>';
                            $row_start++;
                        }
                         else
                         {
                             $is_load_more_available = true;
                            if($from_date != "all")
                    	    {
                    	        $from_date = date("d-m-Y",strtotime($from_date));
                    	    }
                    	    if($to_date != "all")
                    	    {
                    	        $to_date = date("d-m-Y",strtotime($to_date));
                    	    }
                    	     echo json_encode(array("html" => $html, "from_date" => $from_date, "to_date" => $to_date, "is_load_more_available" => $is_load_more_available));
                         
                             die();
                         }
                        $row_count++;
                    
                    }
                }
            }
       }

            //
    	     if($from_date != "all")
    	    {
    	        $from_date = date("d-m-Y",strtotime($from_date));
    	    }
    	    if($to_date != "all")
    	    {
    	        $to_date = date("d-m-Y",strtotime($to_date));
    	    }
    	     echo json_encode(array("html" => $html, "from_date" => $from_date, "to_date" => $to_date, "is_load_more_available" => $is_load_more_available));
    	}
    }
    
    public function staff_dashboard()
    {
        if($this->session->has_userdata('logged_in')) 
    	{
    	     $user_id = 1;
    	     $filter_type = $this->input->post("staff_date_filter_select");
    	     $from_date = $this->input->post("staff_from_date");
    	     $to_date = $this->input->post("staff_to_date");
            if($this->session->has_userdata('session_role') == "user")
    	    {
    	        $user_id = $this->session->userdata('session_id');
    	    }
    	     $html_arr = $this->load_staff_table($user_id,$filter_type,$from_date,$to_date);
    	     $html = $html_arr["html"];
    	     $is_load_more_available = $html_arr["is_load_more_available"];
    	     if($from_date != "all")
    	    {
    	        $from_date = date("d-m-Y",strtotime($from_date));
    	    }
    	    if($to_date != "all")
    	    {
    	        $to_date = date("d-m-Y",strtotime($to_date));
    	    }
    	     echo json_encode(array("html" => $html, "from_date" => $from_date, "to_date" => $to_date, "is_load_more_available" => $is_load_more_available));
    	}
    }
    
    public function agent_pos_dashboard()
    {
        if($this->session->has_userdata('logged_in')) 
    	{
    	     $user_id = 1;
    	     $type = $this->input->post("agent_pos_select");
    	     $filter_type = $this->input->post("agent_date_filter_select");
    	     $from_date = $this->input->post("agent_from_date");
    	     $to_date = $this->input->post("agent_to_date");
    	     //gkg 2023-02-04
    	     $offset = $this->input->post("offset");
			 $limit = 10;
			 
            if($this->session->has_userdata('session_role') == "user")
    	    {
    	        $user_id = $this->session->userdata('session_id');
    	    }
    	     $html_arr = $this->load_agent_pos_table($type,$user_id,$filter_type,$from_date,$to_date, $offset, $limit);
    	     $html = $html_arr["html"];
    	     $is_load_more_available = $html_arr["is_load_more_available"];
    	     if($from_date != "all")
    	    {
    	        $from_date = date("d-m-Y",strtotime($from_date));
    	    }
    	    if($to_date != "all")
    	    {
    	        $to_date = date("d-m-Y",strtotime($to_date));
    	    }
    	     echo json_encode(array("html" => $html, "from_date" => $from_date, "to_date" => $to_date, "is_load_more_available" => $is_load_more_available, "offset" => ($offset + $limit)));
    	}
    }
    
    // get Current Year Month List by kgk on 2023-02-11
    function getMonthList()
    {
        $monthlist  = [];
        //return $monthlist;
        $startdate  = date("Y")."-01-01";
        $enddate    = date("Y")."-12-31";
        $interval   = "P1M";
        $calendar   = new DatePeriod(
            new DateTime( $startdate ),
            new DateInterval( $interval ),
            new DateTime( $enddate )
        );
        if( $calendar ) {
            foreach( $calendar as $p ) {
                $monthlist[$p->format('m')] = $p->format('F - Y');
            }
            
            unset($calendar);
        }
        
        return $monthlist;
    }
    
    // get user or ai or agent list. based on search types. by kgk on 2023-03-17
    function getsearchby()
    {
        if($this->session->has_userdata('logged_in')) {
            
            $searchby = $this->input->get('searchby');
            $users = [];
            if( $searchby ){
                switch($searchby){
                    case "users":
                        $list = $this->lm->fetch_users();
                        
                        if( isset( $list ) && !empty( $list ) ) {
                            foreach( $list as $row ) {
                                $users[] = ['id' => $row->id, 'name' => $row->username .'(' . $row->email_id .')'];
                            }
                        }
                        break;
                        
                    case "ai":
                        $list = $this->lm->fetch_ai();
                        if( isset( $list ) && !empty( $list ) ) {
                            foreach( $list as $row ) {
                                $users[] = ['id' => $row->id, 'name' => $row->name .'(' . $row->phoneno .')'];
                            }
                        }
                        break;
                        
                    case "agents_pos":
                        $list = $this->lm->fetch_agents_pos();
                        if( isset( $list ) && !empty( $list ) ) {
                            foreach( $list as $row ) {
                                $users[] = ['id' => $row->id, 'name' => $row->name .' - ' . $row->agent_pos_code];
                            }
                        }
                        break;
                }
            }
        	
            echo json_encode($users);
            die();
        }
    }
    
    // display renewals calendar by kgk on 2023-02-11
    function renewals_calendar()
    {
        if($this->session->has_userdata('logged_in')) {
        	
        	$user_id        = ($this->session->has_userdata('session_role') == "user") ? $this->session->userdata('session_id') : 1;
        	
        	$searchCol = $this->input->get('searchCol');
        	$searchVal = $this->input->get('searchVal');
        	
            $today          = new DateTime('now');
            $active_year    = $today->format('Y');
            $active_month   = $this->input->get('month');
            $active_month   = ( $active_month ) ? $active_month : $today->format('m');
            $active_day     = $today->format('d');
            $events         = [];
            
            $date           = new DateTime($active_year."-".$active_month."-01");
            $from_date      = $date->format('Y-m-01');
            $to_date        = $date->format('Y-m-t');
            
    		$results       = $this->mm->getRenewalsCountByDuedate($user_id,$from_date,$to_date, $searchCol, $searchVal);
    	    //echo $this->db->last_query();
    	    
    		if( isset( $results ) && !empty( $results ) ) {
    		    foreach( $results as $row ) {
    		        $color = ( $row->type == 'lost' ) ? 'red' :  ( ( $row->type == 'new' ) ? 'yellow' : 'green');
    		      //  $events[] = [$row->renewals_count, $row->due_date, 1, $color];
    		        if( !isset( $cumulative[$row->date][$row->type] ) ) {
                        $cumulative[$row->date][$row->type] = 0;
                    }
                    $cumulative[$row->date][$row->type] += $row->count;
                    $dates[$row->date] = $row->date;
    		        $events[] = [$row->count.' ('.$row->class.') ', $row->date, 1, $color, $row->type, $row->class];
    		        
    		        
    		        $mevents[] = [$cumulative[$row->date][$row->type], $dates[$row->date], 1];
    		    }
    		}
    		
    		//echo '<pre>';print_r($mevents);print'</pre>';
            
            echo $this->generate_calendar($active_day, $active_month, $active_year, $events);
        }
    }
    
    // generate calendar by kgk on 2023-02-11
    function generate_calendar( $active_day, $active_month, $active_year, $events )
    {
        $num_days = date('t', strtotime($active_day . '-' . $active_month . '-' . $active_year));
        
        $num_days_last_month = date('j', strtotime('last day of previous month', strtotime($active_day . '-' . $active_month . '-' . $active_year)));
        $days = [0 => 'Sun', 1 => 'Mon', 2 => 'Tue', 3 => 'Wed', 4 => 'Thu', 5 => 'Fri', 6 => 'Sat'];
        $first_day_of_week = array_search(date('D', strtotime($active_year . '-' . $active_month . '-1')), $days);
        $html = '<div class="calendar">';
        $html .= '<div class="header">';
        $html .= '<div class="month-year">';
        $html .= date('F Y', strtotime($active_year . '-' . $active_month . '-' . $active_day));
        $html .= '</div>';
        $html .= '</div>';
        $html .= '<div class="days">';
        foreach ($days as $day) {
            $html .= '
                <div class="day_name">
                    ' . $day . '
                </div>
            ';
        }
        for ($i = $first_day_of_week; $i > 0; $i--) {
            $html .= '
                <div class="day_num ignore">
                    ' . ($num_days_last_month-$i+1) . '
                </div>
            ';
        }
        for ($i = 1; $i <= $num_days; $i++) {
            $selected = '';
            if ($i == $active_day) {
                if( date("m") == $active_month )
                    $selected = ' selected';
            }
            $date = $active_year.'-'.$active_month.'-'.$i;
            $url = base_url('Renewalcontrol/getRenewalsDetails/?date='.$date.'&status=t');
            //$fn = "javascript:getRenewalsDetails('".$date."', 'new')";
            $html .= '<div class="day_num' . $selected . '">';
            // $html .= '<a href="renewal_details/'.$active_month.'-'.$i.'"><span>' . $i . '</span>';
            
            $html .= '<span>' . $i . '</span>';
            
            foreach ($events as $event) {
                for ($d = 0; $d <= ($event[2]-1); $d++) {
                    if (date('y-m-d', strtotime($active_year . '-' . $active_month . '-' . $i . ' -' . $d . ' day')) == date('y-m-d', strtotime($event[1]))) {
                        $fn     = "javascript:getRenewalsDetails('".$event[1]."', '".$event[4]."', '".$event[5]."')";
                        $html .= '<a href="'.$fn.'">';
                        $html .= '<div class="event ' . $event[3] . '">';
                        $html .= $event[0];
                        $html .= '</div>';
                        $html .= '</a>';
                    }
                }
            }
            $html .= '</div>';
        }
        for ($i = 1; $i <= (42-$num_days-max($first_day_of_week, 0)); $i++) {
            $html .= '
                <div class="day_num ignore">
                    ' . $i . '
                </div>
            ';
        }
        $html .= '</div>';
        $html .= '</div>';
        return $html;
    }
    
    //kgk
	public function renewals_info_dashboard()
    {
        if($this->session->has_userdata('logged_in')) 
    	{
    	     $user_id = 1;
    	     $type = $this->input->post("filter_role");
    	     $filter_type = $this->input->post("filter_type");
    	     $from_date = $this->input->post("from_date");
    	     $to_date = $this->input->post("to_date");
			 $offset = $this->input->post("offset");
			 $limit = 10;
			 
            if($this->session->has_userdata('session_role') == "user")
    	    {
    	        $user_id = $this->session->userdata('session_id');
    	    }
						    	    
			$html_arr = $this->load_renewals_table($type,$user_id,$filter_type,$from_date,$to_date, $offset, $limit);
			 
    	     $html = $html_arr["html"];
    	     $is_load_more_available = $html_arr["is_load_more_available"];
			 if( isset( $filter_type ) && $filter_type == "Custom" ) {
				 $from_date = date("d-m-Y",strtotime($from_date));
				 $to_date = date("d-m-Y",strtotime($to_date));
			 }
    	     
    	     echo json_encode(array("html" => $html, "from_date" => $from_date, "to_date" => $to_date, "is_load_more_available" => $is_load_more_available));
    	}
    }
	
	//kgk
	public function load_renewals_table($type,$user_id,$filter_type,$from_date,$to_date, $offset = 0, $limit = 10)
    {               
        $r_url = "agent_view";
        $r_url1 = "renewallead";
        
        if($filter_type == "Today")
        {
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d");
        }
        else if($filter_type == "Tommorrow")
        {
             $from_date = date('Y-m-d');
             $to_date = date("Y-m-d",strtotime("+1 days"));
        }
        else if($filter_type == "Next 7 days")
        {
            $from_date = date('Y-m-d');
            $to_date = date('Y-m-d',strtotime("+7 days"));
        }
        else if($filter_type == "Next 30 days")
        {
            $from_date = date('Y-m-d');
            $to_date = date('Y-m-d',strtotime("+30 days"));
        }
        else if($filter_type == "This month")
        {
             $from_date = date('Y-m-01');
             $to_date = date("Y-m-t");
        }
        else if($filter_type == "Next month")
        {
            $month_ini = new DateTime("first day of next month");
            $month_end = new DateTime("last day of next month");
            $from_date = $month_ini->format('Y-m-d');
            $to_date = $month_end->format('Y-m-d');
        }
        else if($filter_type == "Next 3 months")
        {
            $from_date = date("Y-m-d");
            $to_date = date("Y-m-d",strtotime("+3 months"));
        }
        $html = "";$is_load_more_available = true;
        
        
        $result = $this->mm->renewals_status_dashboard($type,$user_id, $from_date,$to_date, $offset, $limit);
        
		if( isset( $result ) && !empty( $result ) ) {
			foreach( $result as $r ) {
				$html .= '<tr><td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="'.$r_url1.'?id='.$r->id.'">'.$r->name.'</a></td>';                        			
				$html .= '<td class = "no_mar_pad" style="text-align: left;"><a href="'.$r_url.'" style="color:black;">'.$r->renewals_count.'</a></td></tr>';
			}
			unset($r);
		} else {
		    $html .= '<tr><td colspan="2" class = "no_mar_pad">data not found</td></tr>';
		    $is_load_more_available = false;
		}
		
		return array("html" => $html, "is_load_more_available" => $is_load_more_available);			
    }
    
    public function agent_pos_load_more()
    {
         if($this->session->has_userdata('logged_in')) 
    	 {
    	     $user_id = 1;
    	     $type = $this->input->post("agent_pos_select");
    	     $filter_type = $this->input->post("agent_date_filter_select");
    	     $from_date = $this->input->post("agent_from_date");
    	     $to_date = $this->input->post("agent_to_date");
    	     $agent_page_no = $this->input->post("agent_page_no");
            if($this->session->has_userdata('session_role') == "user")
    	    {
    	        $user_id = $this->session->userdata('session_id');
    	    }
    	    //
    	      $res = $this->mm->load_agent_pos($type,$user_id);
            $r_url = "agent_view";
             $r_url1 = "bussiness_followup";
            if($filter_type == "Today")
            {
                $from_date = date("Y-m-d");
                $to_date = "all";//date("Y-m-d");
            }
            else if($filter_type == "Yesterday")
            {
                 $from_date = date('Y-m-d',strtotime("-1 days"));
                 $to_date = date("Y-m-d");
            }
            else if($filter_type == "Last 7 days")
            {
                $from_date = date('Y-m-d',strtotime("-7 days"));
                $to_date = date('Y-m-d');
            }
            else if($filter_type == "Last 30 days")
            {
                $from_date = date('Y-m-d',strtotime("-30 days"));
                $to_date = date('Y-m-d');
            }
            else if($filter_type == "This month")
            {
                 $from_date = date('Y-m-01');
                 $to_date = date("Y-m-d");
            }
            else if($filter_type == "Last month")
            {
                $month_ini = new DateTime("first day of last month");
                $month_end = new DateTime("last day of last month");
                $from_date = $month_ini->format('Y-m-d');
                $to_date = $month_end->format('Y-m-d');
            }
            else if($filter_type == "Last 3 months")
            {
                $from_date = date("Y-m-d",strtotime("-3 months"));
                $to_date = date("Y-m-d");
            }
            else if($filter_type == "All")
            {
                $from_date = "all";
                $to_date = "all";
            }
            $html = "";
            $res1 = array();
            $rem = array();
            
            $temp_agent_open_count = 0; 
            
            $agent_open_count1 = array();
            $agent_open_count2 = array();
            
            foreach($res as $r)
             {
                  $agent_open_count1 [] = $this->mm->agent_open_count($r->id,$from_date,$to_date);
             }
            rsort($agent_open_count1);
            $is_load_more_available = false;
        // for($i = 0; $i<5; $i++)
        // {
        //     if($i<count($agent_open_count1))
        //     {
        //         $agent_open_count2[] = $agent_open_count1[$i];
        //     }
        //     else
        //     {
        //         $is_load_more_available = false;
        //     }
        // }
        $row_count = 1;
        $row_start = $agent_page_no * 10;
        $row_start++;
        $row_end = $row_start + 9;
        $temp_array[] = 0;
       foreach($agent_open_count1 as $ag)
       {
           foreach($res as $r)
            {
                if(!in_array($r->id, $temp_array))
                {
                    $agent_open_count = $this->mm->agent_open_count($r->id,$from_date,$to_date); 
                    if($ag == $agent_open_count)
                    {
                        if($row_count < $row_start)
                        {
                            $temp_array[] = $r->id;
                        }
                        else if($row_start <= $row_end)
                        {
                            $temp_array[] = $r->id;
                            $html .= '<tr><td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="'.$r_url1.'?id='.$r->id.'">'.$r->name.'</a></td>';
                            $agent_open_count = $this->mm->agent_open_count($r->id,$from_date,$to_date); 
                            $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$agent_open_count.'</a></td>';
                            $agent_followup_count = $this->mm->agent_followup_count($r->id,$from_date,$to_date); 
                            $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$agent_followup_count.'</a></td>';
                            $agent_completed_count = $this->mm->agent_completed_count($r->id,$from_date,$to_date); 
                            $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$agent_completed_count.'</a></td>';
                            $agent_lost_count = $this->mm->agent_lost_count($r->id,$from_date,$to_date); 
                            $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$agent_lost_count.'</a></td>';
                            $agent_total_count = $agent_open_count + $agent_followup_count + $agent_completed_count + $agent_lost_count;
                            $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$agent_total_count.'</a></td></tr>';
                            $row_start++;
                        }
                         else
                         {
                             $is_load_more_available = true;
                            if($from_date != "all")
                    	    {
                    	        $from_date = date("d-m-Y",strtotime($from_date));
                    	    }
                    	    if($to_date != "all")
                    	    {
                    	        $to_date = date("d-m-Y",strtotime($to_date));
                    	    }
                    	     echo json_encode(array("html" => $html, "from_date" => $from_date, "to_date" => $to_date, "is_load_more_available" => $is_load_more_available));
                         
                             die();
                         }
                        $row_count++;
                    }
                }
                
            }
       }

            //
    	     if($from_date != "all")
    	    {
    	        $from_date = date("d-m-Y",strtotime($from_date));
    	    }
    	    if($to_date != "all")
    	    {
    	        $to_date = date("d-m-Y",strtotime($to_date));
    	    }
    	     echo json_encode(array("html" => $html, "from_date" => $from_date, "to_date" => $to_date, "is_load_more_available" => $is_load_more_available));
    	}
    }
    
    public function staff_load_more()
    {
         if($this->session->has_userdata('logged_in')) 
    	 {
    	     $user_id = 1;
    	     $filter_type = $this->input->post("staff_date_filter_select");
    	     $from_date = $this->input->post("staff_from_date");
    	     $to_date = $this->input->post("staff_to_date");
    	     $staff_page_no = $this->input->post("staff_page_no");
            if($this->session->has_userdata('session_role') == "user")
    	    {
    	        $user_id = $this->session->userdata('session_id');
    	    }
    	    //
    	      $res = $this->mm->load_staff($user_id);
            $r_url = "staff_view";
            if($filter_type == "Today")
            {
                $from_date = date("Y-m-d");
                $to_date = "all";//date("Y-m-d");
            }
            else if($filter_type == "Yesterday")
            {
                 $from_date = date('Y-m-d',strtotime("-1 days"));
                 $to_date = date("Y-m-d");
            }
            else if($filter_type == "Last 7 days")
            {
                $from_date = date('Y-m-d',strtotime("-7 days"));
                $to_date = date('Y-m-d');
            }
            else if($filter_type == "Last 30 days")
            {
                $from_date = date('Y-m-d',strtotime("-30 days"));
                $to_date = date('Y-m-d');
            }
            else if($filter_type == "This month")
            {
                 $from_date = date('Y-m-01');
                 $to_date = date("Y-m-d");
            }
            else if($filter_type == "Last month")
            {
                $month_ini = new DateTime("first day of last month");
                $month_end = new DateTime("last day of last month");
                $from_date = $month_ini->format('Y-m-d');
                $to_date = $month_end->format('Y-m-d');
            }
            else if($filter_type == "Last 3 months")
            {
                $from_date = date("Y-m-d",strtotime("-3 months"));
                $to_date = date("Y-m-d");
            }
            else if($filter_type == "All")
            {
                $from_date = "all";
                $to_date = "all";
            }
            $html = "";
            $res1 = array();
            $rem = array();
            
            $temp_staff_open_count = 0; 
            
            $staff_open_count1 = array();
            $staff_open_count2 = array();
            
            foreach($res as $r)
             {
                  $staff_open_count1 [] = $this->mm->staff_open_count($r->id,$from_date,$to_date);
             }
            rsort($staff_open_count1);
            $is_load_more_available = false;
        $row_count = 1;
        $row_start = $staff_page_no * 10;
        $row_start++;
        $row_end = $row_start + 9;
        $temp_array[] = 0;
       foreach($staff_open_count1 as $ag)
       {
           foreach($res as $r)
            {
                if(!in_array($r->id, $temp_array))
                {
                    $staff_open_count = $this->mm->staff_open_count($r->id,$from_date,$to_date); 
                    if($ag == $staff_open_count)
                    {
                        if($row_count < $row_start)
                        {
                            $temp_array[] = $r->id;
                        }
                        else if($row_start <= $row_end)
                        {
                            $temp_array[] = $r->id;
                            $html .= '<tr><td class = "no_mar_pad"><i style="padding-right:10px;" class="fa fa-star-o" aria-hidden="true"></i><a style="color:black;" href="'.$r_url.'?id='.$r->id.'">'.$r->name.'</a></td>';
                            $staff_open_count = $this->mm->staff_open_count($r->id,$from_date,$to_date); 
                            $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$staff_open_count.'</a></td>';
                            $staff_followup_count = $this->mm->staff_followup_count($r->id,$from_date,$to_date); 
                            $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$staff_followup_count.'</a></td>';
                            $staff_completed_count = $this->mm->staff_completed_count($r->id,$from_date,$to_date); 
                            $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$staff_completed_count.'</a></td>';
                            $staff_lost_count = $this->mm->staff_lost_count($r->id,$from_date,$to_date); 
                            $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$staff_lost_count.'</a></td>';
                            $staff_total_count = $staff_open_count + $staff_followup_count + $staff_completed_count + $staff_lost_count;
                            $html .= '<td class = "no_mar_pad" style="text-align: right;"><a href="'.$r_url.'" style="color:black;">'.$staff_total_count.'</a></td></tr>';
                            $row_start++;
                        }
                         else
                         {
                             $is_load_more_available = true;
                            if($from_date != "all")
                    	    {
                    	        $from_date = date("d-m-Y",strtotime($from_date));
                    	    }
                    	    if($to_date != "all")
                    	    {
                    	        $to_date = date("d-m-Y",strtotime($to_date));
                    	    }
                    	     echo json_encode(array("html" => $html, "from_date" => $from_date, "to_date" => $to_date, "is_load_more_available" => $is_load_more_available));
                         
                             die();
                         }
                        $row_count++;
                    
                    }
                }
            }
       }

            //
    	     if($from_date != "all")
    	    {
    	        $from_date = date("d-m-Y",strtotime($from_date));
    	    }
    	    if($to_date != "all")
    	    {
    	        $to_date = date("d-m-Y",strtotime($to_date));
    	    }
    	     echo json_encode(array("html" => $html, "from_date" => $from_date, "to_date" => $to_date, "is_load_more_available" => $is_load_more_available));
    	}
    }
    
    public function staff_view()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $user_id = 1;
    	    if($this->session->has_userdata('session_role') == "user")
    	    {
    	        $user_id = $this->session->userdata('session_id');
    	    }
    	    $data["staff"] = $this->mm->fetch_staff_list($user_id);
    	    $data["class"] = $this->mm->fetch_class_list();
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		
    		$this->load->view('header',$pro_data);
    		//$this->load->view('sidebar',$pro_data);
    		$this->load->view('staff_view',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}
	
	public function ai_view()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $data["ai"] = $this->mm->fetch_ai_list();
    	    $data["class"] = $this->mm->fetch_class_list();
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		
    		$this->load->view('header',$pro_data);
    		//$this->load->view('sidebar',$pro_data);
    		$this->load->view('ai_view',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}
    
    public function fetch_all_leads_dashboard_ai()
    {
        if($this->session->has_userdata('logged_in'))
    	 {
    	     $draw = intval($this->input->post("draw"));
    	     
    	     $id = $this->input->post("id");
    	     $order_category = $this->input->post("order_category");
    	     $res = $this->mm->fetch_all_leads_dashboard_ai($id,$order_category);
    	     
    	     $arr = [];
    	     
    	     $a = $_POST['start'];
    	     
    	     $res1 = array();
    	     $res2 = array();
    	     $res3 = array();
    	      $res4 = array();
    	     
    	     foreach($res as $da)
    	     {
    	         if($da->due_date >= date("Y-m-d"))
    	         {
    	             $res1[] = $da;
    	         }
    	         else if($da->due_date == "0000-00-00")
    	         {
    	             $res4[] = $da;
    	         }
    	         else
    	         {
    	             $res2[] = $da;
    	         }
    	     }
    	     rsort($res2);
    	     foreach($res1 as $da)
    	     {
    	         $res3[] = $da;
    	     }
    	     foreach($res2 as $da)
    	     {
    	         $res3[] = $da;
    	     }
    	     foreach($res4 as $da)
    	     {
    	         $res3[] = $da;
    	     }
    	     
         foreach($res3 as $da)
         {
    	         $a++;
    	         
    	   $action = "<a target='_blanck' href='create_lead?id=".$da->id."' class='btn btn-warning btn-xs'><i class='fa fa-eye'></i></a>";
    	 
        // 	 if($da->lead_type == '0' && $da->classfication == '1')
        // 	 {
        // 	     $action .= "&nbsp;<button onclick=move_prospect(".$da->id.") class='btn btn-primary btn-xs'><i class='fa fa-diamond'></i> Prospect</button>";
        	     
        // 	     $action .= "&nbsp;<button onclick=move_classfication(".$da->id.") class='btn btn-danger btn-xs'><i class='fa fa-arrows'></i> Move</button>";
        // 	 }
        // 	 else if($da->lead_type == '1' && $da->classfication == '1')
        // 	 {
        // 	     $action .= "&nbsp;<button onclick=move_to_lead(".$da->id.") class='btn btn-danger btn-xs'><i class='fa fa-arrows'></i> Lead</button>";
        // 	 }
        // 	 else
        // 	 {
        // 	     $action .= "&nbsp;<button onclick=move_classfication(".$da->id.") class='btn btn-danger btn-xs'><i class='fa fa-arrows'></i> Move</button>";
        // 	     $action .= "";
        // 	 }
        	 
        	 $lead_type = "";
        	 $usr_name = "";
        	 
        	 if($da->lead_type == 1)
        	 {
        	     $lead_type = "Prospect";
        	 }
        	 else if($da->classfication == 1)
        	 {
        	     $lead_type = "Hot";
        	 }
        	 else if($da->classfication == 2)
        	 {
        	     $lead_type = "Warm";
        	 }
        	 else
        	 {
        	     $lead_type = "Cold";
        	 }
        	 $agent_name = "No Agent";
        	 if($da->agency_and_pos != "")
        	 {
        	     $agent_name = $this->mm->fetch_agent_name($da->agency_and_pos);
        	 }
        	 $date = "No Due Date";
        	 if($da->due_date != "0000-00-00")
        	 {
        	    $date = date_format(date_create($da->due_date),"d-m-Y"); 
        	 }
    	 
            $arr[] =array(
                           $a,
                           $da->client_name,
                           $da->mobile_no,
                           $da->lclass,
                           $da->p_type,
                           $da->b_type,
                           $da->area,
                           $lead_type,
                           $agent_name,
                           "",
                           $date,
                           $action,
                        );
            }
    	        $result = array(
            			"draw"=> $draw,
    				    "recordsTotal"=> $this->mm->get_all_datas_count_ai($id,$order_category),
    				    "recordsFiltered"=> $this->mm->get_filtered_datas_count_ai($id,$order_category),
    				    "data"=>$arr,
    				);
          echo json_encode($result);
    	 }
    }
    
    public function fetch_all_leads_dashboard_staff()
    {
        if($this->session->has_userdata('logged_in'))
    	 {
    	     $draw = intval($this->input->post("draw"));
    	     
    	     $id = $this->input->post("id");
    	     $order_category = $this->input->post("order_category");
    	     $res = $this->mm->fetch_all_leads_dashboard_staff($id,$order_category);
    	     
    	     $arr = [];
    	     
    	     $a = $_POST['start'];
    	     
    	     $res1 = array();
    	     $res2 = array();
    	     $res3 = array();
    	      $res4 = array();
    	     
    	     foreach($res as $da)
    	     {
    	         if($da->due_date >= date("Y-m-d"))
    	         {
    	             $res1[] = $da;
    	         }
    	         else if($da->due_date == "0000-00-00")
    	         {
    	             $res4[] = $da;
    	         }
    	         else
    	         {
    	             $res2[] = $da;
    	         }
    	     }
    	     rsort($res2);
    	     foreach($res1 as $da)
    	     {
    	         $res3[] = $da;
    	     }
    	     foreach($res2 as $da)
    	     {
    	         $res3[] = $da;
    	     }
    	     foreach($res4 as $da)
    	     {
    	         $res3[] = $da;
    	     }
    	     
         foreach($res3 as $da)
         {
    	         $a++;
    	         
    	   $action = "<a target='_blanck' href='create_lead?id=".$da->id."' class='btn btn-warning btn-xs'><i class='fa fa-eye'></i></a>";
    	 
        // 	 if($da->lead_type == '0' && $da->classfication == '1')
        // 	 {
        // 	     $action .= "&nbsp;<button onclick=move_prospect(".$da->id.") class='btn btn-primary btn-xs'><i class='fa fa-diamond'></i> Prospect</button>";
        	     
        // 	     $action .= "&nbsp;<button onclick=move_classfication(".$da->id.") class='btn btn-danger btn-xs'><i class='fa fa-arrows'></i> Move</button>";
        // 	 }
        // 	 else if($da->lead_type == '1' && $da->classfication == '1')
        // 	 {
        // 	     $action .= "&nbsp;<button onclick=move_to_lead(".$da->id.") class='btn btn-danger btn-xs'><i class='fa fa-arrows'></i> Lead</button>";
        // 	 }
        // 	 else
        // 	 {
        // 	     $action .= "&nbsp;<button onclick=move_classfication(".$da->id.") class='btn btn-danger btn-xs'><i class='fa fa-arrows'></i> Move</button>";
        // 	     $action .= "";
        // 	 }
        	 
        	 $lead_type = "";
        	 $usr_name = "";
        	 
        	 if($da->lead_type == 1)
        	 {
        	     $lead_type = "Prospect";
        	 }
        	 else if($da->classfication == 1)
        	 {
        	     $lead_type = "Hot";
        	 }
        	 else if($da->classfication == 2)
        	 {
        	     $lead_type = "Warm";
        	 }
        	 else
        	 {
        	     $lead_type = "Cold";
        	 }
        	 $agent_name = "No Agent";
        	 if($da->agency_and_pos != "")
        	 {
        	     $agent_name = $this->mm->fetch_agent_name($da->agency_and_pos);
        	 }
        	 $date = "No Due Date";
        	 if($da->due_date != "0000-00-00")
        	 {
        	    $date = date_format(date_create($da->due_date),"d-m-Y"); 
        	 }
    	 
            $arr[] =array(
                           $a,
                           $da->client_name,
                           $da->mobile_no,
                           $da->lclass,
                           $da->p_type,
                           $da->b_type,
                           $da->area,
                           $lead_type,
                           $agent_name,
                           "",
                           $date,
                           $action,
                        );
            }
    	        $result = array(
            			"draw"=> $draw,
    				    "recordsTotal"=> $this->mm->get_all_datas_count_staff($id,$order_category),
    				    "recordsFiltered"=> $this->mm->get_filtered_datas_count_staff($id,$order_category),
    				    "data"=>$arr,
    				);
          echo json_encode($result);
    	 }
    }
    
    public function fetch_all_follow_ups_dashboard_staff()
    {
        if($this->session->has_userdata('logged_in'))
       {
           $draw = intval($this->input->post("draw")); 
           
           $id = $this->input->post("id");
           
           $res = $this->mm->fetch_all_follow_ups_dashboard_staff($id);
           
           $arr = [];
           $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<button class='btn btn-info btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-edit'></i></button> 
                      <a class='btn btn-warning btn-xs' onclick=follow_up_log(".$da->lead_id.")><i class='fa fa-eye'></i></a> 
            		 <a target='_blanck' href='create_lead?id=".$da->lead_id."' class='btn btn-primary btn-xs' onclick=follow_up_log(".$da->lead_id.")>View lead</a>";
            
            $arr[] = array(
                $a,
                $da->client_name,
                $da->mobile_no,
                date_format(date_create($da->next_follow_up_date),"d-m-Y"),
                date_format(date_create($da->next_follow_up_time),"h:i:sa"),
                date_format(date_create($da->lead_generated_date),"d-m-Y"),
                $da->reason,
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
    
    public function fetch_all_follow_ups_dashboard_ai()
    {
        if($this->session->has_userdata('logged_in'))
       {
           $draw = intval($this->input->post("draw")); 
           
           $id = $this->input->post("id");
           
           $res = $this->mm->fetch_all_follow_ups_dashboard_ai($id);
           
           $arr = [];
           $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<button class='btn btn-info btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-edit'></i></button> 
                      <a class='btn btn-warning btn-xs' onclick=follow_up_log(".$da->lead_id.")><i class='fa fa-eye'></i></a> 
            		 <a target='_blanck' href='create_lead?id=".$da->lead_id."' class='btn btn-primary btn-xs' onclick=follow_up_log(".$da->lead_id.")>View lead</a>";
            
            $arr[] = array(
                $a,
                $da->client_name,
                $da->mobile_no,
                date_format(date_create($da->next_follow_up_date),"d-m-Y"),
                date_format(date_create($da->next_follow_up_time),"h:i:sa"),
                date_format(date_create($da->lead_generated_date),"d-m-Y"),
                $da->reason,
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
    
    public function get_staff_full_details()
	{
	    $id = $this->input->post("id");
	    $chart_year = $this->input->post("chart_year");
	    $class = $this->input->post("class_select");
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $user_id = 1;
    	    if($this->session->userdata('session_role') == "user")
    	    {
    	        $user_id = $this->session->userdata('session_id');
    	    }
    	        //complete data
    	        
    	        $from_date = $chart_year."-01-01";
    	        $to_date = $chart_year."-01-31";
    	        $jan = $this->mm->staff_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-02-01";
    	        $to_date = $chart_year."-02-31";
    	        $feb = $this->mm->staff_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-03-01";
    	        $to_date = $chart_year."-03-31";
    	        $mar = $this->mm->staff_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-04-01";
    	        $to_date = $chart_year."-04-31";
    	        $apr = $this->mm->staff_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-05-01";
    	        $to_date = $chart_year."-05-31";
    	        $may = $this->mm->staff_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-06-01";
    	        $to_date = $chart_year."-06-31";
    	        $jun = $this->mm->staff_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-07-01";
    	        $to_date = $chart_year."-07-31";
    	        $jul = $this->mm->staff_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-08-01";
    	        $to_date = $chart_year."-08-31";
    	        $aug = $this->mm->staff_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-09-01";
    	        $to_date = $chart_year."-09-31";
    	        $sep = $this->mm->staff_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-10-01";
    	        $to_date = $chart_year."-10-31";
    	        $oct = $this->mm->staff_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-11-01";
    	        $to_date = $chart_year."-11-31";
    	        $nov = $this->mm->staff_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-12-01";
    	        $to_date = $chart_year."-12-31";
    	        $dec = $this->mm->staff_completed_with_class_count($id,$from_date,$to_date,$class);
    	       // $from_date = $chart_year."-01-01";
    	       // $to_date = $chart_year."-12-31";
    	       // $class_data = array();
    	       // if($class != all)
    	       // {
    	       //     $class_arr = $this->mm->fetch_class_list();
    	       //     foreach($class_arr as $ca)
    	       //     {
    	       //         $completed_class_data = array("","count"=>$this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$ca->id));
    	       //     }
    	       // }
    	       if($chart_year == date("Y"))
    	       {
    	           if(date("m") == "01")
        	        {
        	            $completed_chart_data = array("jan"=>$jan);
        	        }
        	        else if(date("m") == "02")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb);
        	        }
        	        else if(date("m") == "03")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar);
        	        }
        	        else if(date("m") == "04")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr);
        	        }
        	        else if(date("m") == "05")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may);
        	        }
        	        else if(date("m") == "06")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun);
        	        }
        	        else if(date("m") == "07")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,);
        	        }
        	        else if(date("m") == "08")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,);
        	        }
        	        else if(date("m") == "09")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep);
        	        }
        	        else if(date("m") == "10")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct);
        	        }
        	        else if(date("m") == "11")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov);
        	        }
        	        else
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec);
        	        }
    	       }
    	       else
    	       {
    	           $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec);
    	       }
    	        
    	        //lead data
    	 
    	        $from_date = $chart_year."-01-01";
    	        $to_date = $chart_year."-01-31";
    	        $jan = $this->mm->staff_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-02-01";
    	        $to_date = $chart_year."-02-31";
    	        $feb = $this->mm->staff_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-03-01";
    	        $to_date = $chart_year."-03-31";
    	        $mar = $this->mm->staff_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-04-01";
    	        $to_date = $chart_year."-04-31";
    	        $apr = $this->mm->staff_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-05-01";
    	        $to_date = $chart_year."-05-31";
    	        $may = $this->mm->staff_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-06-01";
    	        $to_date = $chart_year."-06-31";
    	        $jun = $this->mm->staff_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-07-01";
    	        $to_date = $chart_year."-07-31";
    	        $jul = $this->mm->staff_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-08-01";
    	        $to_date = $chart_year."-08-31";
    	        $aug = $this->mm->staff_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-09-01";
    	        $to_date = $chart_year."-09-31";
    	        $sep = $this->mm->staff_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-10-01";
    	        $to_date = $chart_year."-10-31";
    	        $oct = $this->mm->staff_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-11-01";
    	        $to_date = $chart_year."-11-31";
    	        $nov = $this->mm->staff_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-12-01";
    	        $to_date = $chart_year."-12-31";
    	        $dec = $this->mm->staff_lead_with_class_count($id,$from_date,$to_date,$class);
    	       // $from_date = $chart_year."-01-01";
    	       // $to_date = $chart_year."-12-31";
    	       // $class_data = array();
    	       // if($class != all)
    	       // {
    	       //     $class_arr = $this->mm->fetch_class_list();
    	       //     foreach($class_arr as $ca)
    	       //     {
    	       //         $completed_class_data = array("","count"=>$this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$ca->id));
    	       //     }
    	       // }
    	       if($chart_year == date("Y"))
    	       {
    	           if(date("m") == "01")
        	        {
        	            $lead_chart_data = array("jan"=>$jan);
        	        }
        	        else if(date("m") == "02")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb);
        	        }
        	        else if(date("m") == "03")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar);
        	        }
        	        else if(date("m") == "04")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr);
        	        }
        	        else if(date("m") == "05")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may);
        	        }
        	        else if(date("m") == "06")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun);
        	        }
        	        else if(date("m") == "07")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,);
        	        }
        	        else if(date("m") == "08")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,);
        	        }
        	        else if(date("m") == "09")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep);
        	        }
        	        else if(date("m") == "10")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct);
        	        }
        	        else if(date("m") == "11")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov);
        	        }
        	        else
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec);
        	        }
    	       }
    	       else
    	       {
    	           $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec);
    	       }
    	       
    	       //lost data
    	 
    	        $from_date = $chart_year."-01-01";
    	        $to_date = $chart_year."-01-31";
    	        $jan = $this->mm->staff_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-02-01";
    	        $to_date = $chart_year."-02-31";
    	        $feb = $this->mm->staff_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-03-01";
    	        $to_date = $chart_year."-03-31";
    	        $mar = $this->mm->staff_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-04-01";
    	        $to_date = $chart_year."-04-31";
    	        $apr = $this->mm->staff_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-05-01";
    	        $to_date = $chart_year."-05-31";
    	        $may = $this->mm->staff_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-06-01";
    	        $to_date = $chart_year."-06-31";
    	        $jun = $this->mm->staff_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-07-01";
    	        $to_date = $chart_year."-07-31";
    	        $jul = $this->mm->staff_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-08-01";
    	        $to_date = $chart_year."-08-31";
    	        $aug = $this->mm->staff_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-09-01";
    	        $to_date = $chart_year."-09-31";
    	        $sep = $this->mm->staff_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-10-01";
    	        $to_date = $chart_year."-10-31";
    	        $oct = $this->mm->staff_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-11-01";
    	        $to_date = $chart_year."-11-31";
    	        $nov = $this->mm->staff_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-12-01";
    	        $to_date = $chart_year."-12-31";
    	        $dec = $this->mm->staff_lost_with_class_count($id,$from_date,$to_date,$class);
    	       // $from_date = $chart_year."-01-01";
    	       // $to_date = $chart_year."-12-31";
    	       // $class_data = array();
    	       // if($class != all)
    	       // {
    	       //     $class_arr = $this->mm->fetch_class_list();
    	       //     foreach($class_arr as $ca)
    	       //     {
    	       //         $completed_class_data = array("","count"=>$this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$ca->id));
    	       //     }
    	       // }
    	       if($chart_year == date("Y"))
    	       {
    	           if(date("m") == "01")
        	        {
        	            $lost_chart_data = array("jan"=>$jan);
        	        }
        	        else if(date("m") == "02")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb);
        	        }
        	        else if(date("m") == "03")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar);
        	        }
        	        else if(date("m") == "04")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr);
        	        }
        	        else if(date("m") == "05")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may);
        	        }
        	        else if(date("m") == "06")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun);
        	        }
        	        else if(date("m") == "07")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,);
        	        }
        	        else if(date("m") == "08")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,);
        	        }
        	        else if(date("m") == "09")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep);
        	        }
        	        else if(date("m") == "10")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct);
        	        }
        	        else if(date("m") == "11")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov);
        	        }
        	        else
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec);
        	        }
    	       }
    	       else
    	       {
    	           $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec);
    	       }
    	       //class data
    	       
    	        $staff_name = $this->mm->fetch_staff_name($id);
    	       $mot_count = $this->mm->staff_completed_with_class_count($id,"all","all",1);
    	       $health_count = $this->mm->staff_completed_with_class_count($id,"all","all",2);
    	       $travel_count = $this->mm->staff_completed_with_class_count($id,"all","all",3);
    	       if($mot_count == 0 && $health_count == 0 && $travel_count == 0)
    	       {
    	           $title = $staff_name." did not add any Policy";
    	       }
    	       else
    	       {
    	            $title = $staff_name." Policy Details";
    	       }
                $completed_class_data = array("mot_count"=>$mot_count,"health_count"=>$health_count,"travel_count"=>$travel_count,"title"=>$title);
                $ag_val = $this->mm->fetch_staff_tot_policy($id);
                if($ag_val == 0)
                {
                    $title1 = $staff_name."did not add any Policy";
                }
                else
                {
                    $title1 = $staff_name." Policy Compare to Others";
                }
                $compare_data = array("name"=>$staff_name,"ag_val"=>$ag_val,"ot_val"=>$this->mm->fetch_other_staff_tot_policy($id),"title"=>$title1);
    	        $data = array("complete_data"=>$completed_chart_data,"lead_data"=>$lead_chart_data,"lost_data"=>$lost_chart_data,"class_data"=>$completed_class_data,"compare_data"=>$compare_data);
    	        echo json_encode($data);
    	    
    	}
	}
    
	public function agent_view()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $user_id = 1;
    	    if($this->session->has_userdata('session_role') == "user")
    	    {
    	        $user_id = $this->session->userdata('session_id');
    	    }
    	    $data["agent"] = $this->mm->fetch_agent_list($user_id);
    	    $data["class"] = $this->mm->fetch_class_list();
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		
    		$this->load->view('header',$pro_data);
    		//$this->load->view('sidebar',$pro_data);
    		$this->load->view('agent_view',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}
	public function get_agent_full_details()
	{
	    $id = $this->input->post("id");
	    $chart_year = $this->input->post("chart_year");
	    $class = $this->input->post("class_select");
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $user_id = 1;
    	    if($this->session->userdata('session_role') == "user")
    	    {
    	        $user_id = $this->session->userdata('session_id');
    	    }
    	    
    	        //complete data
    	        $from_date = $chart_year."-01-01";
    	        $to_date = $chart_year."-01-31";
    	        $jan = $this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-02-01";
    	        $to_date = $chart_year."-02-31";
    	        $feb = $this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-03-01";
    	        $to_date = $chart_year."-03-31";
    	        $mar = $this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-04-01";
    	        $to_date = $chart_year."-04-31";
    	        $apr = $this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-05-01";
    	        $to_date = $chart_year."-05-31";
    	        $may = $this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-06-01";
    	        $to_date = $chart_year."-06-31";
    	        $jun = $this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-07-01";
    	        $to_date = $chart_year."-07-31";
    	        $jul = $this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-08-01";
    	        $to_date = $chart_year."-08-31";
    	        $aug = $this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-09-01";
    	        $to_date = $chart_year."-09-31";
    	        $sep = $this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-10-01";
    	        $to_date = $chart_year."-10-31";
    	        $oct = $this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-11-01";
    	        $to_date = $chart_year."-11-31";
    	        $nov = $this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-12-01";
    	        $to_date = $chart_year."-12-31";
    	        $dec = $this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$class);
    	       // $from_date = $chart_year."-01-01";
    	       // $to_date = $chart_year."-12-31";
    	       // $class_data = array();
    	       // if($class != all)
    	       // {
    	       //     $class_arr = $this->mm->fetch_class_list();
    	       //     foreach($class_arr as $ca)
    	       //     {
    	       //         $completed_class_data = array("","count"=>$this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$ca->id));
    	       //     }
    	       // }
    	       if($chart_year == date("Y"))
    	       {
    	           if(date("m") == "01")
        	        {
        	            $completed_chart_data = array("jan"=>$jan);
        	        }
        	        else if(date("m") == "02")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb);
        	        }
        	        else if(date("m") == "03")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar);
        	        }
        	        else if(date("m") == "04")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr);
        	        }
        	        else if(date("m") == "05")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may);
        	        }
        	        else if(date("m") == "06")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun);
        	        }
        	        else if(date("m") == "07")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,);
        	        }
        	        else if(date("m") == "08")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,);
        	        }
        	        else if(date("m") == "09")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep);
        	        }
        	        else if(date("m") == "10")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct);
        	        }
        	        else if(date("m") == "11")
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov);
        	        }
        	        else
        	        {
        	            $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec);
        	        }
    	       }
    	       else
    	       {
    	           $completed_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec);
    	       }
    	        
    	        //lead data
    	 
    	        $from_date = $chart_year."-01-01";
    	        $to_date = $chart_year."-01-31";
    	        $jan = $this->mm->agent_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-02-01";
    	        $to_date = $chart_year."-02-31";
    	        $feb = $this->mm->agent_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-03-01";
    	        $to_date = $chart_year."-03-31";
    	        $mar = $this->mm->agent_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-04-01";
    	        $to_date = $chart_year."-04-31";
    	        $apr = $this->mm->agent_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-05-01";
    	        $to_date = $chart_year."-05-31";
    	        $may = $this->mm->agent_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-06-01";
    	        $to_date = $chart_year."-06-31";
    	        $jun = $this->mm->agent_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-07-01";
    	        $to_date = $chart_year."-07-31";
    	        $jul = $this->mm->agent_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-08-01";
    	        $to_date = $chart_year."-08-31";
    	        $aug = $this->mm->agent_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-09-01";
    	        $to_date = $chart_year."-09-31";
    	        $sep = $this->mm->agent_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-10-01";
    	        $to_date = $chart_year."-10-31";
    	        $oct = $this->mm->agent_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-11-01";
    	        $to_date = $chart_year."-11-31";
    	        $nov = $this->mm->agent_lead_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-12-01";
    	        $to_date = $chart_year."-12-31";
    	        $dec = $this->mm->agent_lead_with_class_count($id,$from_date,$to_date,$class);
    	       // $from_date = $chart_year."-01-01";
    	       // $to_date = $chart_year."-12-31";
    	       // $class_data = array();
    	       // if($class != all)
    	       // {
    	       //     $class_arr = $this->mm->fetch_class_list();
    	       //     foreach($class_arr as $ca)
    	       //     {
    	       //         $completed_class_data = array("","count"=>$this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$ca->id));
    	       //     }
    	       // }
    	       if($chart_year == date("Y"))
    	       {
    	           if(date("m") == "01")
        	        {
        	            $lead_chart_data = array("jan"=>$jan);
        	        }
        	        else if(date("m") == "02")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb);
        	        }
        	        else if(date("m") == "03")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar);
        	        }
        	        else if(date("m") == "04")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr);
        	        }
        	        else if(date("m") == "05")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may);
        	        }
        	        else if(date("m") == "06")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun);
        	        }
        	        else if(date("m") == "07")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,);
        	        }
        	        else if(date("m") == "08")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,);
        	        }
        	        else if(date("m") == "09")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep);
        	        }
        	        else if(date("m") == "10")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct);
        	        }
        	        else if(date("m") == "11")
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov);
        	        }
        	        else
        	        {
        	            $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec);
        	        }
    	       }
    	       else
    	       {
    	           $lead_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec);
    	       }
    	       
    	       //lost data
    	 
    	        $from_date = $chart_year."-01-01";
    	        $to_date = $chart_year."-01-31";
    	        $jan = $this->mm->agent_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-02-01";
    	        $to_date = $chart_year."-02-31";
    	        $feb = $this->mm->agent_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-03-01";
    	        $to_date = $chart_year."-03-31";
    	        $mar = $this->mm->agent_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-04-01";
    	        $to_date = $chart_year."-04-31";
    	        $apr = $this->mm->agent_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-05-01";
    	        $to_date = $chart_year."-05-31";
    	        $may = $this->mm->agent_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-06-01";
    	        $to_date = $chart_year."-06-31";
    	        $jun = $this->mm->agent_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-07-01";
    	        $to_date = $chart_year."-07-31";
    	        $jul = $this->mm->agent_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-08-01";
    	        $to_date = $chart_year."-08-31";
    	        $aug = $this->mm->agent_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-09-01";
    	        $to_date = $chart_year."-09-31";
    	        $sep = $this->mm->agent_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-10-01";
    	        $to_date = $chart_year."-10-31";
    	        $oct = $this->mm->agent_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-11-01";
    	        $to_date = $chart_year."-11-31";
    	        $nov = $this->mm->agent_lost_with_class_count($id,$from_date,$to_date,$class);
    	        $from_date = $chart_year."-12-01";
    	        $to_date = $chart_year."-12-31";
    	        $dec = $this->mm->agent_lost_with_class_count($id,$from_date,$to_date,$class);
    	       // $from_date = $chart_year."-01-01";
    	       // $to_date = $chart_year."-12-31";
    	       // $class_data = array();
    	       // if($class != all)
    	       // {
    	       //     $class_arr = $this->mm->fetch_class_list();
    	       //     foreach($class_arr as $ca)
    	       //     {
    	       //         $completed_class_data = array("","count"=>$this->mm->agent_completed_with_class_count($id,$from_date,$to_date,$ca->id));
    	       //     }
    	       // }
    	       if($chart_year == date("Y"))
    	       {
    	           if(date("m") == "01")
        	        {
        	            $lost_chart_data = array("jan"=>$jan);
        	        }
        	        else if(date("m") == "02")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb);
        	        }
        	        else if(date("m") == "03")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar);
        	        }
        	        else if(date("m") == "04")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr);
        	        }
        	        else if(date("m") == "05")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may);
        	        }
        	        else if(date("m") == "06")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun);
        	        }
        	        else if(date("m") == "07")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,);
        	        }
        	        else if(date("m") == "08")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,);
        	        }
        	        else if(date("m") == "09")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep);
        	        }
        	        else if(date("m") == "10")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct);
        	        }
        	        else if(date("m") == "11")
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov);
        	        }
        	        else
        	        {
        	            $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec);
        	        }
    	       }
    	       else
    	       {
    	           $lost_chart_data = array("jan"=>$jan,"feb"=>$feb,"mar"=>$mar,"apr"=>$apr,"may"=>$may,"jun"=>$jun,"jul"=>$jul,"aug"=>$aug,"sep"=>$sep,"oct"=>$oct,"nov"=>$nov,"dec"=>$dec);
    	       }
    	       //class data
    	       $agent_name = $this->mm->fetch_agent_name($id);
    	       $mot_count = $this->mm->agent_completed_with_class_count($id,"all","all",1);
    	       $health_count = $this->mm->agent_completed_with_class_count($id,"all","all",2);
    	       $travel_count = $this->mm->agent_completed_with_class_count($id,"all","all",3);
    	       if($mot_count == 0 && $health_count == 0 && $travel_count == 0)
    	       {
    	           $title = $agent_name." did not add any Policy";
    	       }
    	       else
    	       {
    	            $title = $agent_name." Policy Details";
    	       }
                $completed_class_data = array("mot_count"=>$mot_count,"health_count"=>$health_count,"travel_count"=>$travel_count,"title"=>$title);
                $ag_val = $this->mm->fetch_agent_tot_policy($id);
                if($ag_val == 0)
                {
                    $title1 = $agent_name."did not add any Policy";
                }
                else
                {
                    $title1 = $agent_name." Policy Compare to Others";
                }
                $compare_data = array("name"=>$agent_name,"ag_val"=>$ag_val,"ot_val"=>$this->mm->fetch_other_agent_tot_policy($id),"title"=>$title1);
    	        $data = array("complete_data"=>$completed_chart_data,"lead_data"=>$lead_chart_data,"lost_data"=>$lost_chart_data,"class_data"=>$completed_class_data,"compare_data"=>$compare_data);
    	        echo json_encode($data);
    	 
    	        
    	    
    	}
	}
	//pct
	public function premium_cover_type()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		//$this->load->view('sidebar',$pro_data);
    		$this->load->view('premium_cover_type');
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user")
	    {
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
        		$this->load->view('header',$pro_data);
        		$this->load->view('premium_cover_type');
        		$this->load->view('footer',$pro_data);
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
	    }
	    else
	    {
	    	redirect("login");
	    }
	}

	public function fetch_premium_cover_type()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_premium_cover_type();
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;
        	
        	$action = "";

          $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
          
	        if($check_user_i->masters_edit == "1")
	        {
                $action .= "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Edit</button>"; 
	        }
             		
            $arr[] = array(
                $a,
                $da->name,
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

	public function add_premium_cover_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	   
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
          
	        if($check_user_i->masters_add == "1")
	        {
        		$name = $this->input->post("name");
        		$data = array("name" => $name,
        		            "created_by" => $this->session->userdata("session_id"),
        		            "created_at" => date("Y-m-d H:i:s"));
        		$res = $this->mm->add_premium_cover_type($data);
        		if( $res ) {
    	            $this->audit->log('list_of_premium_cover_type', 'INSERT', null, null, $data);
    	        }
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
	}

	public function fetch_edit_premium_cover_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_premium_cover_type($id);
			echo json_encode($res);
		}
	}

	public function edit_premium_cover_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	   $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
          
	        if($check_user_i->masters_add == "1")
	        {
        		$name = $this->input->post("name");
        		$id = $this->input->post("id");
            	$data = array("name" => $name,
    	            "updated_by" => $this->session->userdata("session_id"),
    	            "updated_at" => date("Y-m-d H:i:s"));
    	            
    	        $old_data = $this->mm->fetch_edit_premium_cover_type($id);
    	        $res = $this->mm->edit_premium_cover_type($id, $data);
    	        if( $res ) {
    	            $this->audit->log('list_of_premium_cover_type', 'UPDATE', null, $old_data, $data);
    	        }
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
	}
	
	//Commission state
	public function commission_state()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('commission_state');
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user")
	    {
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
        		$this->load->view('header',$pro_data);
        		$this->load->view('commission_state');
        		$this->load->view('footer',$pro_data);
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
	    }
	    else 
	    {
	    	redirect("login");
	    }
	}

	public function fetch_commission_state()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_commission_state();
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;
        	
           
           $action = "";
           
            $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_edit == "1")
	        {
            $action .= "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Edit</button>"; 
	        }
             		 //<button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> Delete</button>";
            
            $arr[] = array(
                $a,
                $da->name,
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

	public function add_commission_state()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_add == "1")
	        {
        		$name = $this->input->post("name");
        		$data = array("name" => $name,
        		            "created_by" => $this->session->userdata("session_id"),
        		            "created_at" => date("Y-m-d H:i:s"));
        		$res = $this->mm->add_commission_state($data);
                if( $res ) {
    	            $this->audit->log('list_of_commision_state', 'INSERT', null, null, $data);
    	        }
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
	}

	public function fetch_edit_commission_state()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_commission_state($id);
			echo json_encode($res);
		}
	}

	public function edit_commission_state()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	   $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	   
	        if($check_user_i->masters_add == "1")
	        {
        		$name = $this->input->post("name");
        		$id = $this->input->post("id");
            	$data = array("name" => $name,
    	            "updated_by" => $this->session->userdata("session_id"),
    	            "updated_at" => date("Y-m-d H:i:s"));
    	            
    	        $old_data = $this->mm->fetch_edit_commission_state($id);
    	        $res = $this->mm->edit_commission_state($id, $data);
    	        if( $res ) {
    	            $this->audit->log('list_of_commision_state', 'UPDATE', null, $old_data, $data);
    	        }
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
	}
	
	 public function payout_entry1()
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
                $data["fuel_type"] = $this->pm->get_fuel_type();
                $this->load->view('header',$pro_data);
                $this->load->view('payout_entry_new',$data);
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
                $this->load->view('payout_entry_new',$data);
                $this->load->view('footer',$pro_data);
                }
                else
                {
                    echo "<script>alert('Permission Denied');window.location.href='home';</script>";
                }
        }
        }
    }
    public function edit_commission_entry()
    {
        if($this->session->has_userdata('logged_in')) 
        { 
            $id = $this->input->post("id");
            $res = $this->mm->edit_commission_entry($id);
            if($res -> class == 1)
            {
                $select_make_arr = $this->mm->fetch_commission_make_log($res->id,$res->policy_type);
                $select_make = array();
                foreach($select_make_arr as $sma)
                {
                    $select_make[] = $sma->make;
                }
                $select_model_arr = $this->mm->fetch_commission_model_log($res->id,$res->policy_type);
                $select_model = array();
                foreach($select_model_arr as $sma)
                {
                    $select_model[] = $sma->model_id;
                }
                $select_varient_arr = $this->mm->fetch_commission_varient_log($res->id,$res->policy_type);
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
            else if($vechile_type == "7")
            {
                    $make_list = $this->pm->fetch_make_pc();
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
            else if($vechile_type == "7")
            {
                    $model_list = $this->pm->fetch_pc_model($vechi_make);
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
            
            if($vechile_type == "7")
            {
                $varient_list = $this->pm->fetch_pc_varient($vechi_make,$vechi_model);
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
            
            }
             $classification_arr = $this->pm->fetch_classification($res->policy_type);
    	        
	        $classification_content = "<option value=''>--select--</option>";
	        
	        foreach($classification_arr as $da)
	        {
	            $classification_content .="<option value='".$da->id."'>".$da->from_gvw_cc.$da->classification." - ".$da->to_gvw_cc.$da->classification."</option>";
	        }
	        
	        $select_rto_arr = $this->mm->fetch_select_rto_using_commission_id($res->id);
	        $select_rto = array();
	        foreach($select_rto_arr as $sra)
	        {
	            $select_rto[] = $sra->rto;
	        }
	        
            $data = array("res" => $res, "make_list" => $make_list, "model_list" => $model_list, "varient_list" => $varient_list, "select_make" => $select_make, "select_model" => $select_model, "select_varient" => $select_varient, "classification_content" => $classification_content, "select_rto" => $select_rto);
            echo json_encode($data);
        }
    }
    
     public function edit_check_vechi_age_already_exits()
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
                 $v_type = $this->input->post("v_type");
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
                $condition = $this->input->post("condition");
                $no_policy = $this->input->post("no_policy");
                
                // target amount
                $min_amount = $this->input->post("min_amount");
                $max_amount = $this->input->post("max_amount");
                
                
                 $commission_id = [];
                 
                 $status = "0";
                 $make_status = "0";
                 $model_status = "0";
                 $varient_status = "0";
                 $rto_status = "0";
                 
                 $com_policy_id = "";
                 
                 if($insurer_class == "1" && $commission_type == "2")
                 {
                    $check = $this->mm->edit_check_vechi_age_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$fuel_type,$ins_classification,$id);
    	            
                	    foreach($check as $da)
                		{
                    		    $temp_min = $da->vehicle_age_min;
                    		    $temp_max = $da->vehicle_age_max;
                    		    
                    		    $commission_id[] = $da->id;
                    		    
                    		    if($temp_min <= $vehicle_age_min && $temp_max >= $vehicle_age_min)
                				{
                					$status = "1";
                				}
                				if($temp_min <= $vehicle_age_max && $temp_max >= $vehicle_age_max)
                				{
                					$status = "1";
                				}
                				if($temp_min > $vehicle_age_min && $temp_max < $vehicle_age_max)
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
                            $check_make = $this->pm->check_make_all_already_exits($commission_id,$policy_type);
                            
                                if($check_make > 0)
                                {
                                    $status = "1";
                                    $make_status = "1";
                                }
                                else
                                {
                                     $check_make_1 = $this->pm->check_make_already_exits($commission_id,$policy_type,$make);
                                        
                                        if($check_make_1 > 0)
                                        {
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
                                
                                if($check_model > 0)
                                {
                                     $status = "1";
                                     $model_status = "1";
                                }
                                else
                                {
                                    $check_model_1 = $this->pm->check_model_already_exits($commission_id,$policy_type,$make,$model);
                                    
                                    if($check_model_1 > 0)
                                    {
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
                                if($check_varient > 0)
                                {
                                     $status = "1";
                        	         $varient_status = "1";
                                }
                                else 
                                {
                                  $check_varient_1 = $this->pm->check_varient_already_exits($commission_id,$policy_type,$make,$model,$varient);
                    	            if($check_varient_1 > 0)
                    	            {
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
                                 
                            if($status == "1" && $fuel_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                            {
                                
                                  if(in_array("chennai",$ins_rto))
                                   {
                                       $chennai_rto = $this->pm->get_chennai_rto();
                                       foreach($chennai_rto as $da)
                                       {
                                           $ins_rto_1 = $da->rto_no;
                                       }
                                      $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                      
                                       if($check_rto > 0)
                                        {
                                            $rto_status == "1";
                                            echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                        }
                                   }
                                   else if(in_array("Coimbatore",$ins_rto))
                                   {
                                       $coimbatore_rto = $this->pm->get_coimbatore_rto();
                                       
                                       foreach($coimbatore_rto as $da)
                                       {
                                          $ins_rto_1 = $da->rto_no;
                                       }
                                       
                                       $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                       if($check_rto > 0)
                                        {
                                            $rto_status == "1";
                                            echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                        }
                                   }
                                   else if(in_array("madurai",$ins_rto))
                                   {
                                       $madurai_rto = $this->pm->get_madurai_rto();
                                       
                                       foreach($madurai_rto as $da)
                                       {
                                         $ins_rto_1 = $da->rto_no;
                                       }
                                       $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                       
                                        if($check_rto > 0)
                                        {
                                            $rto_status == "1";
                                            echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                        }
                                   }
                                   else if(in_array("ROTN",$ins_rto))
                                   {
                                       $get_rotn_rto = $this->pm->get_rotn_rto();
                                       
                                       foreach($get_rotn_rto as $da)
                                       {
                                            $ins_rto_1 = $da->rto_no;
                                       }
                                       
                                       $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                       
                                        if($check_rto > 0)
                                        {
                                            $rto_status == "1";
                                            echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                        }
                                   }
                                   else if(in_array("All TN",$ins_rto))
                                   {
                                        $get_all_tn_rto = $this->pm->get_all_tn_rto_list();
                                           foreach($get_all_tn_rto as $da)
                                           {
                                                $ins_rto_1 = $da->rto_no;
                                           }
                                        $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                        if($check_rto > 0)
                                        {
                                            $rto_status == "1";
                                            echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                        }
                                   }
                                   else if(in_array("All RTO",$ins_rto))
                                   {
                                       $get_all_rto = $this->pm->get_all_rto_list();
                                       
                                       foreach($get_all_rto as $da)
                                       {
                                              $ins_rto_1 = $da->rto_no;
                                       }
                                       
                                        $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto_1);
                                        
                                        if($check_rto > 0)
                                        {
                                            $rto_status == "1";
                                            echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                        }
                                   }
                                   else
                                   {
                                        $check_rto = $this->pm->check_rto_already_exits($commission_id,$ins_rto);
                                        if($check_rto > 0)
                                        {
                                            $rto_status == "1";
                                            echo json_encode(array("status"=>"This Commission Slab Already Exits"));
                                        }
                                        else
                                        {
                                           echo json_encode(array("status"=>"success"));
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
                 else if($insurer_class == "1" && $commission_type == "1")
                 {
                     $check = $this->pm->check_this_com_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$fuel_type);
                     
                     $no_of_policy = $this->pm->check_this_com_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$fuel_type,$condition,$no_policy);
                    
                     $res ="";
                    
                     if(count($no_of_policy) > 0)
                     {
                        foreach($check as $da)
                        {
                           $commission_id[] = $da->id;
                        }
                        $res = $this->check_make_model_rto($commission_id,$policy_type,$make,$model,$varient,$ins_rto);
                     } 
                 
                 if($res == "success")
                 {
                     if(count($check) == "0")
                     {
                        $last_policy_id = $this->pm->get_last_policy_id();
                        
                        if($last_policy_id == "")
                        {
                                $com_policy_id = "1";
                                $arr = array("policy_id" => $com_policy_id);
                                $insert = $this->cm->add_policy_id($arr);
                        }
                        else
                        {
                            $max_policy_id = $last_policy_id->policy_id;
                            $com_policy_id = $max_policy_id+1;
                            $arr = array("policy_id" => $com_policy_id);
                            $insert = $this->pm->add_policy_id($arr);
                        }
                        echo json_encode(array("status" =>"success","no_policy_id" =>$com_policy_id));
                     }
                     else if(count($check) > 0 || count($no_of_policy) > 0 || $res != "success")
                     {
                           foreach($no_of_policy as $da)
            	            {
            	                $policy_id = $da->no_of_policy_id;
            	            }
                         	$check_policy_id = $this->pm->check_policy_id_already_exits($policy_id);
                    		
            	            if($check_policy_id != "" || $check_policy_id != null)
            	            {
            	                $com_policy_id = $check_policy_id->policy_id;
            	            }
            	            echo json_encode(array("status" =>"success","no_policy_id" =>$com_policy_id));
                     }
                     else if(count($check) > 0 || count($no_of_policy) >= 1 || $res != "success")
                     {
                            foreach($no_policy as $da)
            	            {
            	                $no_policy_id = $da->no_of_policy_id;
            	            }
                            $check_policy_id = $this->pm->check_policy_id_already_exits($no_policy_id);
                    		
            	            if($check_policy_id != "" || $check_policy_id != null)
            	            {
            	                $com_policy_id = $check_policy_id->policy_id;
            	            }
            	            else
            	            {
                                $last_policy_id = $this->pm->get_last_policy_id();
                                $max_policy_id = $last_policy_id->policy_id;
                                $com_policy_id = $max_policy_id+1;
                                $arr = array("policy_id" => $com_policy_id);
                                $insert = $this->pm->add_policy_id($arr);
            	            }
            	            echo json_encode(array("status" =>"success","no_policy_id" =>$com_policy_id));
                     }
                 }
                 else if(count($check) == "0")
                 {
                     $last_policy_id = $this->pm->get_last_policy_id();
                        if($last_policy_id == "")
                        {
                                $com_policy_id = "1";
                                $arr = array("policy_id" => $com_policy_id);
                                $insert = $this->cm->add_policy_id($arr);
                        }
                        else
                        {
                            $max_policy_id = $last_policy_id->policy_id;
                            $com_policy_id = $max_policy_id+1;
                            $arr = array("policy_id" => $com_policy_id);
                            $insert = $this->pm->add_policy_id($arr);
                        }
                        echo json_encode(array("status" =>"success","no_policy_id" =>$com_policy_id));
                 }
                 else
                 {
                     echo json_encode(array("status" =>$res,"no_policy_id" =>$com_policy_id));
                 }
                }
                 else if($insurer_class == "1" && $commission_type == "3")
                 {
                     $check = $this->pm->check_target_amount_already_exits($insurer_company,$premium_c_type,$insurer_class,$business_type,$policy_type,$ins_state,$fuel_type,$ins_classification);
    	            
                	    foreach($check as $da)
                		{
                    		    $temp_min = $da->min_val;
                    		    $temp_max = $da->max_val;
                    		    
                    		    $commission_id[] = $da->id;
                    		    
                    		    if($temp_min <= $min_amount && $temp_max >= $min_amount)
                				{
                					$status = "1";
                				}
                				if($temp_min <= $max_amount && $temp_max >= $max_amount)
                				{
                					$status = "1";
                				}
                				if($temp_min > $min_amount && $temp_max < $max_amount)
                				{
                					$status = "1";
                				}
                		 }
                		 
                		 if($status = "1")
                		 {
                		     $res = $this->check_make_model_rto($commission_id,$policy_type,$make,$model,$varient,$ins_rto);
                		     echo $res;
                		 }
                		 else
                		 {
                		     echo "success";
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
                 $premium_c_type = $this->input->post("premium_c_type");
                 $policy_type = $this->input->post("policy_type");
                 $commission_type = $this->input->post("commission_type");
                 $add_type = $this->input->post("add_type");
                 $v_type = $this->input->post("v_type");
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
                $condition = $this->input->post("condition");
                $no_policy = $this->input->post("no_policy");
                 
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
                 
                  $data = array(
                                 "insurer_company" =>$insurer_company,
                                 "policy_premium_type" =>$premium_c_type,
                                 "class" =>$insurer_class,
                                 "business_type" =>$business_type,
                                 "commission_type" =>$commission_type,
                                 "vehicle_type" =>$v_type,
                                 "policy_type" =>$policy_type,
                                 "state"=>$ins_state,
                                 "fuel_type" =>$fuel_type,
                                 "classification" =>$ins_classification,
                                 "vehicle_age_min"=>$vehicle_age_min,
                                 "vehicle_age_max"=>$vehicle_age_max,
                                 "v_make" =>$v_make,
                                 "v_model" =>$v_model,
                                 "v_varient" =>$v_varient,
                                 "condition_type" =>$condition,
                                 "no_of_policy" =>$no_policy,
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
                              );
                              
                  $res = $id;
                  $this->mm->edit_payout_commission($data,$id);
                  
                  $date = date("Y-m-d H:i:s");    
                
                   
                     if(!in_array("all",$make))
                     {
                         $this->mm->delete_company_commission_make_list($id);
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
                          }
                     }
                     
                    if(!in_array("all",$model))
                    {
                        $this->mm->delete_company_commission_model_list($id);
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
                            }
                      }
                    }

                    if(!in_array("all",$varient))
                    {
                        $this->mm->delete_company_commission_varient_list($id);
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
                            }
                        }
                    }
                   $this->mm->delete_company_rto_log($id);
                   if(in_array("chennai",$ins_rto))
                   {
                       $chennai_rto = $this->pm->get_chennai_rto();
                       
                       foreach($chennai_rto as $da)
                       {
                            $rto_arr = array(
                                "commission_id" =>$res,
                                "rto" =>$da->rto_no,
                                "created_time" =>date("Y-m-d H:i:s"),
                                );
                                
                            $add_rto = $this->pm->add_rto_log($rto_arr);
                       }
                       
                   }
                   else if(in_array("Coimbatore",$ins_rto))
                   {
                       $coimbatore_rto = $this->pm->get_coimbatore_rto();
                       
                       foreach($coimbatore_rto as $da)
                       {
                            $rto_arr = array(
                                "commission_id" =>$res,
                                "rto" =>$da->rto_no,
                                "created_time" =>date("Y-m-d H:i:s"),
                                );
                            $add_rto = $this->pm->add_rto_log($rto_arr);
                       }
                   }
                   
                   else if(in_array("madurai",$ins_rto))
                   {
                       $madurai_rto = $this->pm->get_madurai_rto();
                       
                       foreach($madurai_rto as $da)
                       {
                            $rto_arr = array(
                                "commission_id" =>$res,
                                "rto" =>$da->rto_no,
                                "created_time" =>date("Y-m-d H:i:s"),
                                );
                                
                            $add_rto = $this->pm->add_rto_log($rto_arr);
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
                    }
                   }
                 echo "success";
    	    }
	    }
	    
    public function manual_generate_policy_new()
  {
        if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["users"] = $this->lm->fetch_users();
		   	$data["client_type"] = $this->lm->fetch_client_type();
		   	$data["fuel_type"] = $this->lm->fetch_fuel_type();
		   	$data["business"] = $this->lm->fetch_business_type();
		   	$data["class"] = $this->lm->fetch_list_of_policy_type();
		   	$data["agents_pos"] = $this->lm->fetch_agents_pos();
		   	$data["policy_type"] = $this->lm->fetch_list_of_policy_type_motor();
		   	$data["email_templates"] = $this->lm->fetch_email_templates();
		   	$data["company"] = $this->lm->fetch_company();
		   	$data["state"] = $this->lm->fetch_state();
		   	$data["premium_cover_type"] = $this->lm->fetch_premium_cover_type();
	   		$data["rto"] = $this->lm->fetch_rto();
    		$this->load->view('header',$pro_data);
    		$this->load->view('manual_generate_ploicy_new',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user")
	    {
	         $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	         
	        if($check_user_i->policy_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    	        $data["users"] = $this->lm->fetch_users();
    	        $data["client_type"] = $this->lm->fetch_client_type();
    	        $data["business"] = $this->lm->fetch_business_type();
    	        $data["class"] = $this->lm->fetch_list_of_policy_type();
    	        $data["agents_pos"] = $this->lm->fetch_agents_pos();
    		   	$data["policy_type"] = $this->lm->fetch_list_of_policy_type_motor();
    		   	$data["email_templates"] = $this->lm->fetch_email_templates();
    		   	$data["company"] = $this->lm->fetch_company();
    		   	$data["state"] = $this->lm->fetch_state();
    		   	$data["fuel_type"] = $this->lm->fetch_fuel_type();
    		   	$data["premium_cover_type"] = $this->lm->fetch_premium_cover_type();
    		   	$data["rto"] = $this->lm->fetch_rto();
        		$this->load->view('header',$pro_data);
        		$this->load->view('manual_generate_ploicy_new',$data);
        		$this->load->view('footer',$pro_data);
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
	    }
	    else
	    {
	    	redirect("login");
	    }
    }
	    
    public function check_commission_status_new()
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
                   $bussiness_type = $this->input->post("bussiness_type");
                   $policy_premium = $this->input->post("policy_premium");
                   $policy_class = $this->input->post("policy_class");
                   $policy_type = $this->input->post("policy_type");
                   $policy_agency_pos = $this->input->post("policy_agency_pos");
                   $lead_created_by = $this->session->userdata('session_name');
                   $state = $this->input->post("state");
                   $company = $this->input->post("company");
                   $rto = $this->input->post("rto");
                   $age = $this->input->post("age");
                   //$category = $this->session->userdata('category');
                   //$vehicle_classification = $this->input->post("vehicle_classification");
                   $lead_id = $this->input->post("lead_id");
                   $nominee_name = $this->input->post("nominee_name");
                   $adharcard_no = $this->input->post("adharcard_no");
                   $n_mobile_no = $this->input->post("n_mobile_no");
                   $n_adhar_card_upload = $this->input->post("n_adhar_card_upload");
                   $make = $this->input->post("vechi_make");
                   $model = $this->input->post("vechi_model");
                   $Varient = $this->input->post("vechi_varient");
                 
                   $register_no = $this->input->post("vechi_register_no");
                   $year_of_manu = $this->input->post("vechi_manu_year");
                   $engine_num = $this->input->post("vechi_engine_num");
                   $fuel_type = $this->input->post("fuel_type");
                   $cc  = $this->input->post("vechi_cc");
                   $v_gvw = $this->input->post("v_gvw");
                   
                 
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
                        
                            if($check_make > 0)
                            {
                                $status = "1";
                                $make_status = "1";
                            }
                            else
                            {
                                  $check_make_1 = $this->lm->check_make_already_exits($commission_id,$policy_type,$make);
                    		        if($check_make_1 > 0)
                    		        {
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
            		            $check_model = $this->lm->check_model_all_already_exits($commission_id,$policy_type);
                                
                                if($check_model > 0)
                                {
                                     $status = "1";
                                     $model_status = "1";
                                }
                                else
                                {
                		            $check_model_1 = $this->lm->check_model_already_exits($commission_id,$policy_type,$make,$model);
                		            
                		            if($check_model_1 > 0)
                		            {
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
            		            $check_varient = $this->lm->check_varient_all_already_exits($commission_id,$policy_type);
            		            
                                if($check_varient > 0)
                                {
                                     $status = "1";
                        	         $varient_status = "1";
                                }
                                else 
                                {
            		                 $check_varient_1 = $this->lm->check_varient_already_exits($commission_id,$policy_type,$make,$model,$Varient);
                    		            
                    		            if($check_varient_1 > 0)
                    		            {
                    		                 $status = "1";
                    		                 $varient_status = "1";
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
                                          //echo json_encode($data_arr);
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
                          //echo json_encode($data_arr);
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
                    		        $check_make = $this->lm->check_make_already_exits($commission_id,$policy_type,$make);
                    		        
                    		        if($check_make > 0)
                    		        {
                    		            $status = "1";
                    		            $make_status = "1";
                    		        }
                    		        else
                    		        {
                    		            $make_status = "0";
                    		        }
                    		        
                    		        if($make_status == "1")
                    		        {
                    		            $check_model = $this->lm->check_model_already_exits($commission_id,$policy_type,$make,$model);
                    		            
                    		            if($check_model > 0)
                    		            {
                    		                 $status = "1";
                    		                 $model_status = "1";
                    		            }
                    		            else
                    		            {
                    		                $model_status = "0";
                    		            }
                    		        }
                    		        
                    		        if($make_status == "1" && $model_status == "1")
                    		        {
                    		            $check_varient = $this->lm->check_varient_already_exits($commission_id,$policy_type,$make,$model,$Varient);
                    		            
                            		            if($check_varient > 0)
                            		            {
                            		                 $status = "1";
                            		                 $varient_status = "1";
                            		            }
                            		            else
                            		            {
                            		                 $varient_status = "0";
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
                                                  //echo json_encode($data_arr);
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
                                //echo json_encode($data_arr);
                            }
                            }
                            else
                            {
                                $data_arr = array("status"=>"no");
                                //echo json_encode($data_arr);
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
       public function save_manual_generated_policy_new()
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
                   $bussiness_type = $this->input->post("bussiness_type");
                   $policy_class = $this->input->post("policy_class");
                   $policy_type = $this->input->post("policy_type");
                   $policy_agency_pos = $this->input->post("policy_agency_pos");
                   $lead_created_by = $this->session->userdata('session_name');
                   
                   $state = $this->input->post("state");
                   $company = $this->input->post("company");
                   $rto = $this->input->post("rto");
                   $commission_type = $this->input->post("commission_type");
                   $age = $this->input->post("age");
                   $category = $this->session->userdata('category');
                   $vehicle_classification = $this->input->post("vehicle_classification");
                   $lead_id = $this->input->post("lead_id");
                   $nominee_name = $this->input->post("nominee_name");
                   $adharcard_no = $this->input->post("adharcard_no");
                   $n_mobile_no = $this->input->post("n_mobile_no");
                   $n_adhar_card_upload = $this->input->post("n_adhar_card_upload");
                   
                   $make = $this->input->post("vechi_make");
                   $model = $this->input->post("vechi_model");
                   $Varient = $this->input->post("vechi_varient");
                   $cc  = $this->input->post("vechi_cc");
                   $v_gvw = $this->input->post("v_gvw");
                   $register_no = $this->input->post("vechi_register_no");
                   $year_of_manu = $this->input->post("vechi_manu_year");
                   $engine_num = $this->input->post("vechi_engine_num");
                   $commission_id = $this->input->post("commission_id");
                   $fuel_type = $this->input->post("fuel_type");
                   $ncb = $this->input->post("ncb"); 
                   $total_premium = $this->input->post("total_premium");
                   
                   $agent_commission = 0;
                   $company_com = 0;
                   
                   if($commission_id != "")
                   {
                       if($policy_class == 1)
                        {
                            $res = $this->lm->fetch_policy_info($commission_id);
                            
                            if($res != null && $res->commission_type == "2")
                            {
                                if($res->commission_type == "2" && $res->type == "Excluding")
                                {
                                    if($res->is_ncb == "Yes" && $this->input->post("no_claim_bonus") == "Yes")
                                    {
                                        $company_com = $total_premium * ($res->ncb_percentage)/100;
                                        
                                         $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                         
                                               if($agent_status->commission_category == "A")
                                               {
                                                   $agent_commission = ($company_com * $res->a_ncb)/100;
                                               }
                                               else if($agent_status->commission_category == "B")
                                               {
                                                    $agent_commission = ($company_com * $res->a_ncb)/100;
                                               }
                                               else if($agent_status->commission_category == "C")
                                               {
                                                    $agent_commission = ($company_com * $res->a_ncb)/100;
                                               }
                                               else if($agent_status->commission_category == "D")
                                               {
                                                    $agent_commission = ($company_com * $res->a_ncb)/100;
                                               }
                                    }
                                    else if($res->is_ncb == "Yes" && $this->input->post("no_claim_bonus") == "No" || $this->input->post("no_claim_bonus") == "")
                                    {
                                        $irda_od = $total_premium * ($res->irda_od)/100;
                                        $irda_tp = $total_premium * ($res->irda_tp)/100;
                                        $company_com = $irda_od + $irda_tp;
                                        $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                        
                                       if($res->agn_com_type == "OD")
                                       {
                                           if($agent_status->commission_category == "A")
                                           {
                                               $agent_commission = ($irda_od * $res->a_od)/100;
                                           }
                                           else if($agent_status->commission_category == "B")
                                           {
                                               $agent_commission = ($irda_od * $res->b_od)/100;
                                           }
                                           else if($agent_status->commission_category == "C")
                                           {
                                               $agent_commission = ($irda_od * $res->c_od)/100;
                                           }
                                           else if($agent_status->commission_category == "D")
                                           {
                                               $agent_commission = ($irda_od * $res->d_od)/100;
                                           }
                                       }
                                       else if($res->agn_com_type == "TP")
                                       {
                                           if($agent_status->commission_category == "A")
                                           {
                                               $agent_commission = ($irda_tp * $res->a_tp)/100;
                                           }
                                           else if($agent_status->commission_category == "B")
                                           {
                                               $agent_commission = ($irda_tp * $res->b_tp)/100;
                                           }
                                           else if($agent_status->commission_category == "C")
                                           {
                                               $agent_commission = ($irda_tp * $res->c_tp)/100;
                                           }
                                           else if($agent_status->commission_category == "D")
                                           {
                                               $agent_commission = ($irda_tp * $res->d_tp)/100;
                                           }
                                       }
                              }
                         }
                                else if($res->commission_type == "2" && $res->type == "including")
                                {
                                        if($res->on_net != "")
                                        {
                                            $own_od = "";
                                            $own_tp = "";
                                            $company_com = $total_premium * ($res->on_net)/100;
                                            $on_net = $company_com;
                                        }
                                        else if($res->own_od != "" && $res->own_tp != "")
                                        {
                                            $own_od = $total_premium * ($res->own_od)/100;
                                            $own_tp = $total_premium * ($res->own_tp)/100;
                                            $company_com = $own_od+$own_tp;
                                            $on_net = "";
                                        }
                                        else if($res->own_od != "")
                                        {
                                            $on_net = ""; 
                                            $own_tp = "";
                                            $company_com = $total_premium * ($res->own_od)/100;
                                            $own_od = $company_com;
                                        }
                                        else if($res->own_tp != "")
                                        {
                                            $own_od = ""; 
                                            $on_net = "";
                                            $company_com = $total_premium * ($res->own_tp)/100;
                                            $own_tp = $company_com;
                                        }
                                        
                                        $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                   
                                   if($res->agn_com_type == "OD")
                                   {
                                       if($agent_status->commission_category == "A")
                                       {
                                           $agent_commission = ($own_od * $res->a_od)/100;
                                       }
                                       else if($agent_status->commission_category == "B")
                                       {
                                           $agent_commission = ($own_od * $res->b_od)/100;
                                       }
                                       else if($agent_status->commission_category == "C")
                                       {
                                           $agent_commission = ($own_od * $res->c_od)/100;
                                       }
                                       else if($agent_status->commission_category == "D")
                                       {
                                           $agent_commission = ($own_od * $res->d_od)/100;
                                       }
                                   }
                                   else if($res->agn_com_type == "TP")
                                   {
                                       if($agent_status->commission_category == "A")
                                       {
                                           $agent_commission = ($own_tp * $res->a_tp)/100;
                                       }
                                       else if($agent_status->commission_category == "B")
                                       {
                                           $agent_commission = ($own_tp * $res->b_tp)/100;
                                       }
                                       else if($agent_status->commission_category == "C")
                                       {
                                           $agent_commission = ($own_tp * $res->c_tp)/100;
                                       }
                                       else if($agent_status->commission_category == "D")
                                       {
                                           $agent_commission = ($own_tp * $res->d_tp)/100;
                                       }
                                   }
                                       
                                   else if($res->agn_com_type == "ON-NET")
                                   {
                                       if($agent_status->commission_category == "A")
                                       {
                                           $agent_commission = ($on_net * $res->a_net)/100;
                                       }
                                       else if($agent_status->commission_category == "B")
                                       {
                                           $agent_commission = ($on_net * $res->b_net)/100;
                                       }
                                       else if($agent_status->commission_category == "C")
                                       {
                                           $agent_commission = ($on_net * $res->c_net)/100;
                                       }
                                       else if($agent_status->commission_category == "D")
                                       {
                                           $agent_commission = ($on_net * $res->d_net)/100;
                                       }
                                   }
                                       
                                   else if($res->agn_com_type == "OD_AND_TP")
                                   {
                                       if($agent_status->commission_category == "A")
                                       {
                                           $agent_od = ($own_od * $res->a_od)/100;
                                           $agent_tp = ($own_tp * $res->a_tp)/100;
                                           $agent_commission = $agent_od+$agent_tp;
                                       }
                                       else if($agent_status->commission_category == "B")
                                       {
                                           $agent_od = ($own_od * $res->b_od)/100;
                                           $agent_tp = ($own_tp * $res->a_tp)/100;
                                           $agent_commission = $agent_od+$agent_tp;
                                       }
                                       else if($agent_status->commission_category == "C")
                                       {
                                           $agent_od = ($own_od * $res->c_od)/100;
                                           $agent_tp = ($own_tp * $res->a_tp)/100;
                                           $agent_commission = $agent_od+$agent_tp;
                                       }
                                       else if($agent_status->commission_category == "D")
                                       {
                                           $agent_od = ($own_od * $res->d_od)/100;
                                           $agent_tp = ($own_tp * $res->a_tp)/100;
                                           $agent_commission = $agent_od+$agent_tp;
                                       }
                                 }
                              }
                           }
                           else
                           {
                               $res = $this->lm->fetch_policy_info($commission_id);
                            
                            if($res != null)
                            {
                                if($res->commission_type == "1" && $res->type == "Excluding")
                                {
                                    if($res->is_ncb == "Yes" && $this->input->post("no_claim_bonus") == "Yes")
                                    {
                                        $company_com = $total_premium * ($res->ncb_percentage)/100;
                                        
                                         $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                         
                                               if($agent_status->commission_category == "A")
                                               {
                                                   $agent_commission = ($company_com * $res->a_ncb)/100;
                                               }
                                               else if($agent_status->commission_category == "B")
                                               {
                                                    $agent_commission = ($company_com * $res->a_ncb)/100;
                                               }
                                               else if($agent_status->commission_category == "C")
                                               {
                                                    $agent_commission = ($company_com * $res->a_ncb)/100;
                                               }
                                               else if($agent_status->commission_category == "D")
                                               {
                                                    $agent_commission = ($company_com * $res->a_ncb)/100;
                                               }
                                    }
                                    else if($res->is_ncb == "Yes" && $this->input->post("no_claim_bonus") == "No" || $this->input->post("no_claim_bonus") == "")
                                    {
                                        $irda_od = $total_premium * ($res->irda_od)/100;
                                        $irda_tp = $total_premium * ($res->irda_tp)/100;
                                        $company_com = $irda_od + $irda_tp;
                                        $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                        
                                       if($res->agn_com_type == "OD")
                                       {
                                           if($agent_status->commission_category == "A")
                                           {
                                               $agent_commission = ($irda_od * $res->a_od)/100;
                                           }
                                           else if($agent_status->commission_category == "B")
                                           {
                                               $agent_commission = ($irda_od * $res->b_od)/100;
                                           }
                                           else if($agent_status->commission_category == "C")
                                           {
                                               $agent_commission = ($irda_od * $res->c_od)/100;
                                           }
                                           else if($agent_status->commission_category == "D")
                                           {
                                               $agent_commission = ($irda_od * $res->d_od)/100;
                                           }
                                       }
                                       else if($res->agn_com_type == "TP")
                                       {
                                           if($agent_status->commission_category == "A")
                                           {
                                               $agent_commission = ($irda_tp * $res->a_tp)/100;
                                           }
                                           else if($agent_status->commission_category == "B")
                                           {
                                               $agent_commission = ($irda_tp * $res->b_tp)/100;
                                           }
                                           else if($agent_status->commission_category == "C")
                                           {
                                               $agent_commission = ($irda_tp * $res->c_tp)/100;
                                           }
                                           else if($agent_status->commission_category == "D")
                                           {
                                               $agent_commission = ($irda_tp * $res->d_tp)/100;
                                           }
                                       }
                              }
                         }
                        else if($res->commission_type == "1" && $res->type == "including")
                        {
                                if($res->on_net != "")
                                {
                                    $own_od = "";
                                    $own_tp = "";
                                    $company_com = $total_premium * ($res->on_net)/100;
                                    $on_net = $company_com;
                                }
                                else if($res->own_od != "" && $res->own_tp != "")
                                {
                                    $own_od = $total_premium * ($res->own_od)/100;
                                    $own_tp = $total_premium * ($res->own_tp)/100;
                                    $company_com = $own_od+$own_tp;
                                    $on_net = "";
                                }
                                else if($res->own_od != "")
                                {
                                    $on_net = ""; 
                                    $own_tp = "";
                                    $company_com = $total_premium * ($res->own_od)/100;
                                    $own_od = $company_com;
                                }
                                else if($res->own_tp != "")
                                {
                                    $own_od = ""; 
                                    $on_net = "";
                                    $company_com = $total_premium * ($res->own_tp)/100;
                                    $own_tp = $company_com;
                                }
                                
                                $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                           
                           if($res->agn_com_type == "OD")
                           {
                               if($agent_status->commission_category == "A")
                               {
                                   $agent_commission = ($own_od * $res->a_od)/100;
                               }
                               else if($agent_status->commission_category == "B")
                               {
                                   $agent_commission = ($own_od * $res->b_od)/100;
                               }
                               else if($agent_status->commission_category == "C")
                               {
                                   $agent_commission = ($own_od * $res->c_od)/100;
                               }
                               else if($agent_status->commission_category == "D")
                               {
                                   $agent_commission = ($own_od * $res->d_od)/100;
                               }
                           }
                           else if($res->agn_com_type == "TP")
                           {
                               if($agent_status->commission_category == "A")
                               {
                                   $agent_commission = ($own_tp * $res->a_tp)/100;
                               }
                               else if($agent_status->commission_category == "B")
                               {
                                   $agent_commission = ($own_tp * $res->b_tp)/100;
                               }
                               else if($agent_status->commission_category == "C")
                               {
                                   $agent_commission = ($own_tp * $res->c_tp)/100;
                               }
                               else if($agent_status->commission_category == "D")
                               {
                                   $agent_commission = ($own_tp * $res->d_tp)/100;
                               }
                           }
                               
                           else if($res->agn_com_type == "ON-NET")
                           {
                               if($agent_status->commission_category == "A")
                               {
                                   $agent_commission = ($on_net * $res->a_net)/100;
                               }
                               else if($agent_status->commission_category == "B")
                               {
                                   $agent_commission = ($on_net * $res->b_net)/100;
                               }
                               else if($agent_status->commission_category == "C")
                               {
                                   $agent_commission = ($on_net * $res->c_net)/100;
                               }
                               else if($agent_status->commission_category == "D")
                               {
                                   $agent_commission = ($on_net * $res->d_net)/100;
                               }
                           }
                               
                           else if($res->agn_com_type == "OD_AND_TP")
                           {
                               if($agent_status->commission_category == "A")
                               {
                                   $agent_od = ($own_od * $res->a_od)/100;
                                   $agent_tp = ($own_tp * $res->a_tp)/100;
                                   $agent_commission = $agent_od+$agent_tp;
                               }
                               else if($agent_status->commission_category == "B")
                               {
                                   $agent_od = ($own_od * $res->b_od)/100;
                                   $agent_tp = ($own_tp * $res->a_tp)/100;
                                   $agent_commission = $agent_od+$agent_tp;
                               }
                               else if($agent_status->commission_category == "C")
                               {
                                   $agent_od = ($own_od * $res->c_od)/100;
                                   $agent_tp = ($own_tp * $res->a_tp)/100;
                                   $agent_commission = $agent_od+$agent_tp;
                               }
                               else if($agent_status->commission_category == "D")
                               {
                                   $agent_od = ($own_od * $res->d_od)/100;
                                   $agent_tp = ($own_tp * $res->a_tp)/100;
                                   $agent_commission = $agent_od+$agent_tp;
                               }
                         }
                      }
                   }
                   }
                }
                   }
                   
                    $data = array( 
    	             "client_type_id" =>$client_type,
    	             "client_name" =>$client_name,
    	             "mobile_no" =>$mobile_no,
    	             "pin_code" => $pin,
    	             );
    	             $res = $this->lm->add_client_details($data);
    	             if($res != "")
    	             {
        	             $arr = array( 
        	             "client_id" =>$res,
        	             "business_type" =>$bussiness_type,
        	             "class"=>$policy_class,
        	             "policy_type" => $policy_type,
        	             "lead_generated_date" => date("Y-m-d"),
        	             "source"=>$policy_source,
        	             "lead_status"=>"completed",
        	             "agency_and_pos" => $policy_agency_pos,
        	             "lead_created_by" =>$lead_created_by,
        	             "created_date"=>date("Y-m-d"),
        	             "updated_date"=>date("Y-m-d"));
        	             
        	             if($lead_id == "")
        	             {
        	                 $lead_id = $this->lm->add_lead_details($arr);
        	             }
        	             else
        	             {
        	                 $this->lm->update_follow_up_details($arr,$lead_id);
        	             }
        	             
    	             }
    	             
                     $activity_log = array("lead_id"=>$lead_id,"action"=>"Created <b>New Lead</b>","action_type"=>"new_lead_creation","created_by"=>$lead_created_by,"time"=>date("Y-m-d"));
                     
                     $add_activity = $this->lm->add_activity_log($activity_log);
                         

                    //  add vechicle details start             
                 
                     $vechi_info = array( 
                                          "lead_id" =>$lead_id,
                                          "vechile_type" =>"1",
                                          "policy_type" => $policy_type,
                                          "vechi_make" => $make,
                                          "vechi_model" => $model,
                                          "vechi_varient" => $Varient,
                                          "vechi_cc" => $cc,
                                          "vechi_gvw" =>$v_gvw,
                                          "vechi_register_no" => $register_no,
                                          "vechi_manu_year" => $year_of_manu,
                                          "vechi_engine_num" => $engine_num,
                                          "vechi_fuel_type"=>$fuel_type,
                                          "rto" =>$rto,
                                          "state" =>$state,
                                        );
                                           
                                $res = $this->lm->add_vechicle_detail($vechi_info);  
                                
                             //  add vechicle details start 
                                       
                 
            	  $data = array(
            	        "lead_id" =>$lead_id,
            	        "policy_client_ref_no"=> $this->input->post("policy_client_ref_no"),
                        "policy_cover_note_no"=> $this->input->post("policy_cover_note_no"),
                        "policy_no"=> $this->input->post("policy_no"),
                        "policy_s_date"=> $this->input->post("policy_s_date"),
                        "policy_ex_date"=> $this->input->post("policy_ex_date"),
                        "policy_premium"=> $this->input->post("policy_premium"),
                        "policy_terms"=> $this->input->post("policy_terms"),
                        "payment_frequency"=> $this->input->post("payment_frequency"),
                        "next_due_date"=> $this->input->post("next_due_date"),
                        "renewable_flag"=> $this->input->post("renewable_flag"),
                        "add_ons_opted"=> $this->input->post("add_ons_opted"),
                        "add_ons_not_opt" =>$this->input->post("add_ons_not_opt"),
                        "lead_type" =>"2",
                        "agent_commission_amt" => $agent_commission,
                        "own_commission_amt" => $company_com,
                        "sum_insured"=> $this->input->post("sum_insured"),
                        "discount_percent"=> $this->input->post("discount_percent"),
                        "no_claim_bonus"=> $this->input->post("no_claim_bonus"),
                        "total_own_damage"=> $this->input->post("total_own_damage"),
                        "tot_add_on_premium"=> $this->input->post("tot_add_on_premium"),
                        "commisson_base_premium"=> $this->input->post("commisson_base_premium"),
                        "basic_tp"=> $this->input->post("basic_tp"),
                        "owner_driver_pa"=> $this->input->post("owner_driver_pa"),
                        "owner_diver_amt"=> $this->input->post("owner_diver_amt"),
                        "no_of_year_own_drv"=> $this->input->post("no_of_year_own_drv"),
                        "fuel_kit"=> $this->input->post("fuel_kit"),
                        "fuel_kit_amt"=> $this->input->post("fuel_kit_amt"),
                        "geograpical"=> $this->input->post("geograpical"),
                        "geograpical_amt"=> $this->input->post("geograpical_amt"),
                        "un_named_passenger_pa"=> $this->input->post("un_named_passenger_pa"),
                        "un_named_passenger_amt"=> $this->input->post("un_named_passenger_amt"),
                        "no_seats_per_person"=> $this->input->post("no_seats_per_person"),
                        "no_seats_per_person_amt"=> $this->input->post("no_seats_per_person_amt"),
                        "LL_paid "=> $this->input->post("llp"),
                        "LL_paid_amt"=> $this->input->post("llp_amt"),
                        "no_drv_emp"=> $this->input->post("no_drv_emp"),
                        "pa_paid_drv"=> $this->input->post("pa_paid_drv"),
                        "pa_paid_drv_amt"=> $this->input->post("pa_paid_drv_amt"),
                        "no_seats_per_person1"=> $this->input->post("no_seats_per_person1"),
                        "no_seats_per_person_amt1"=> $this->input->post("no_seats_per_person_amt1"),
                        "tot_liability_premium"=> $this->input->post("tot_liability_premium"),
                        "total_premium"=> $this->input->post("total_premium"),
                        "gst"=> $this->input->post("gst"),
                        "premium_gst"=> $this->input->post("premium_gst"),
                        "policy_issue_date"=> $this->input->post("policy_issue_date"),
                        "policy_agency_pos"=> $this->input->post("policy_agency_pos"),
                        "policy_source"=> $this->input->post("policy_source"),
                        "policy_user"=> $this->input->post("policy_user"),
                        "policy_location"=> $this->input->post("policy_location"),
                        "previous_policy_no"=> $this->input->post("previous_policy_no"),
                        "previous_insurer"=> $this->input->post("previous_insurer"),
                        "previous_insurance_plan"=> $this->input->post("previous_insurance_plan"),
                        "previous_agency_pos"=> $this->input->post("previous_agency_pos"),
                        "previous_source"=> $this->input->post("previous_source"),
                        "dectable_details"=> $this->input->post("dectable_details"),
                        "policy_additional_info"=> $this->input->post("policy_additional_info"),
                        "reference_no"=> $this->input->post("reference_no"),
                        "other_reference_no"=> $this->input->post("other_reference_no"),
                        "policy_received"=> $this->input->post("policy_received"),
                        "policy_verified"=> $this->input->post("policy_verified"),
                        "policy_verified_info"=> $this->input->post("policy_verified_info"),
                        "policy_cancelled"=> $this->input->post("policy_cancelled"),
                        "policy_cancelled_info"=> $this->input->post("policy_cancelled_info"),
                        "commisson_generation"=> $this->input->post("commisson_generation"),
                        "payment_type"=> $this->input->post("payment_type"),
                        "pay_ref_no"=> $this->input->post("pay_ref_no"),
                        "bank_name"=> $this->input->post("bank_name"),
                        "payment_check_date"=> $this->input->post("payment_check_date"),
                        "payment_and_check_no"=> $this->input->post("payment_and_check_no"),
                        "state"=> $this->input->post("state"),
                        "commission_id" =>$commission_id,
                        "company"=> $this->input->post("company"),
                        "rto"=> $this->input->post("rto"),
                        "commission_type"=> $this->input->post("commission_type"),
                        "age"=> $this->input->post("age"),
                        "no_claim_bonus" =>$ncb,
                        "remarks"=> $this->input->post("remarks"),
                        "created_by"=> $this->session->userdata('session_id'),
                        "created_at"=> date("Y-m-d H:i:s"),
                        //"payment_collected_date"=> $this->input->post("payment_collected_date")
                        );
                        
                        $res = $this->lm->save_generated_policy($data);
                        
                        if($res)
                        {
                            $id = $lead_id;
                            $arr = array("lead_type" =>"2");
                            $data_1 = $this->lm->update_lead_type_status($arr,$id);
                        }
                     
                    $activity_log = array("lead_id"=>$id,"action"=>"New Policy Generated","action_type"=>"generate_policy","created_by"=>$this->session->userdata('session_name'),"time"=>date("Y-m-d H:i:s"));
                    
                    
              $countfiles = count($_FILES['files']['name']);
              for($i=0;$i<$countfiles;$i++)
              {
                    if(!empty($_FILES['files']['name'][$i])){
                      $_FILES['file']['name'] = $_FILES['files']['name'][$i];
                      $_FILES['file']['type'] = $_FILES['files']['type'][$i];
                      $_FILES['file']['tmp_name'] = $_FILES['files']['tmp_name'][$i];
                      $_FILES['file']['error'] = $_FILES['files']['error'][$i];
                      $_FILES['file']['size'] = $_FILES['files']['size'][$i];
             
                      $config['upload_path'] = './datas/spot_photos/'; 
                      $config['allowed_types'] = '*';
                      $config['file_name'] = $_FILES['files']['name'][$i];
              
                      $this->load->library('upload',$config); 
                      $arr = array('msg' => 'something went wrong', 'success' => false);
                      
                      if($this->upload->do_upload('file'))
                      {
                       $data = $this->upload->data(); 
                       $data = array("lead_id"=>$id,"document_type"=>"Policy","document"=>$data['file_name'],"uploaded_date"=>date("Y-m-d H:i:s"));
                       $res = $this->lm->add_policy_documents($data);
                      }
                    }
                  }
                     
                    if(isset($_FILES))
            		{
            			$config['upload_path'] = './datas/nominee_documents/';
            			$config['allowed_types'] = '*';
            			
            			$this->load->library('upload',$config);
            			$this->upload->initialize($config);
            			if(!$this->upload->do_upload('n_adhar_card_upload'))
            			{
            				$file = '';
            			}
            			else
            			{
            				$file = $this->upload->data('file_name');
            			}
            		}
    	
                    $nominee_details = array("lead_id"=>$id,"name" =>$nominee_name,"adharcard_no"=>$adharcard_no,"mobile_no"=>$n_mobile_no,"file"=>$file,"created_by"=>$this->session->userdata('session_id'),"created_date"=>date("Y-m-d H:i:s"));
                    $add_nominee_details = $this->lm->add_nominee_details($nominee_details);
                    $add_activity = $this->lm->add_activity_log($activity_log);
                    echo "success";
    	        }
    	        else
    	        {
    	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
    	        }
        }
    }
    public function fetch_all_leads_dashboard()
    {
         if($this->session->has_userdata('logged_in'))
    	 {
    	     $draw = intval($this->input->post("draw"));
    	     
    	     $id = $this->input->post("id");
    	     $order_category = $this->input->post("order_category");
    	     $res = $this->mm->fetch_all_leads_dashboard($id,$order_category);
    	     
    	     $arr = [];
    	     
    	     $a = $_POST['start'];
    	     
    	     $res1 = array();
    	     $res2 = array();
    	     $res3 = array();
    	      $res4 = array();
    	     
    	     foreach($res as $da)
    	     {
    	         if($da->due_date >= date("Y-m-d"))
    	         {
    	             $res1[] = $da;
    	         }
    	         else if($da->due_date == "0000-00-00")
    	         {
    	             $res4[] = $da;
    	         }
    	         else
    	         {
    	             $res2[] = $da;
    	         }
    	     }
    	     rsort($res2);
    	     foreach($res1 as $da)
    	     {
    	         $res3[] = $da;
    	     }
    	     foreach($res2 as $da)
    	     {
    	         $res3[] = $da;
    	     }
    	     foreach($res4 as $da)
    	     {
    	         $res3[] = $da;
    	     }
    	     
         foreach($res3 as $da)
         {
    	         $a++;
    	         
    	   $action = "<a target='_blanck' href='create_lead?id=".$da->id."' class='btn btn-warning btn-xs'><i class='fa fa-eye'></i></a>";
    	 
        // 	 if($da->lead_type == '0' && $da->classfication == '1')
        // 	 {
        // 	     $action .= "&nbsp;<button onclick=move_prospect(".$da->id.") class='btn btn-primary btn-xs'><i class='fa fa-diamond'></i> Prospect</button>";
        	     
        // 	     $action .= "&nbsp;<button onclick=move_classfication(".$da->id.") class='btn btn-danger btn-xs'><i class='fa fa-arrows'></i> Move</button>";
        // 	 }
        // 	 else if($da->lead_type == '1' && $da->classfication == '1')
        // 	 {
        // 	     $action .= "&nbsp;<button onclick=move_to_lead(".$da->id.") class='btn btn-danger btn-xs'><i class='fa fa-arrows'></i> Lead</button>";
        // 	 }
        // 	 else
        // 	 {
        // 	     $action .= "&nbsp;<button onclick=move_classfication(".$da->id.") class='btn btn-danger btn-xs'><i class='fa fa-arrows'></i> Move</button>";
        // 	     $action .= "";
        // 	 }
        	 
        	 $lead_type = "";
        	 $usr_name = "";
        	 
        	 if($da->lead_type == 1)
        	 {
        	     $lead_type = "Prospect";
        	 }
        	 else if($da->classfication == 1)
        	 {
        	     $lead_type = "Hot";
        	 }
        	 else if($da->classfication == 2)
        	 {
        	     $lead_type = "Warm";
        	 }
        	 else
        	 {
        	     $lead_type = "Cold";
        	 }
        	 
        	 if($da->assigned_user != "all")
        	 {
        	     if($da->assigned_user != "")
        	     {
            	     $get_user = $this->lm->get_user_name($da->assigned_user);
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
        	 $date = "No Due Date";
        	 if($da->due_date != "0000-00-00")
        	 {
        	    $date = date_format(date_create($da->due_date),"d-m-Y"); 
        	 }
    	 
            $arr[] =array(
                           $a,
                           $da->client_name,
                           $da->mobile_no,
                           $da->lclass,
                           $da->p_type,
                           $da->b_type,
                           $da->area,
                           $lead_type,
                           $usr_name,
                           "",
                           $date,
                           $action,
                        );
            }
    	        $result = array(
            			"draw"=> $draw,
    				    "recordsTotal"=> $this->mm->get_all_datas_count($id,$order_category),
    				    "recordsFiltered"=> $this->mm->get_filtered_datas_count($id,$order_category),
    				    "data"=>$arr,
    				);
          echo json_encode($result);
    	 }

    }
    public function fetch_all_follow_ups_dashboard()
    {
        if($this->session->has_userdata('logged_in'))
       {
           $draw = intval($this->input->post("draw")); 
           
           $id = $this->input->post("id");
           
           $res = $this->mm->fetch_all_follow_ups_dashboard($id);
           
           $arr = [];
           $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<button class='btn btn-info btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-edit'></i></button> 
                      <a class='btn btn-warning btn-xs' onclick=follow_up_log(".$da->lead_id.")><i class='fa fa-eye'></i></a> 
            		 <a target='_blanck' href='create_lead?id=".$da->lead_id."' class='btn btn-primary btn-xs' onclick=follow_up_log(".$da->lead_id.")>View lead</a>";
            
            $arr[] = array(
                $a,
                $da->client_name,
                $da->mobile_no,
                date_format(date_create($da->next_follow_up_date),"d-m-Y"),
                date_format(date_create($da->next_follow_up_time),"h:i:sa"),
                date_format(date_create($da->lead_generated_date),"d-m-Y"),
                $da->reason,
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
    public function bussiness_followup()
    {
        if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    
    	    $user_id = 1;
		   	$pro_data["project_info"] = $this->mm->fetch_project_info($user_id);
		   	$data["agents"] = $this->mm->fetch_agents($user_id);
		   	$data["pos"] = $this->mm->fetch_pos($user_id);
		   	$data["area_incharge"] = $this->mm->fetch_area_incharge("admin");
    		$this->load->view('header',$pro_data);
    		$this->load->view('bussiness_followup',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user")
	    {
	        $user_id = $this->session->userdata('session_id');
	        $pro_data["project_info"] = $this->mm->fetch_project_info($user_id);
	        $data["agents"] = $this->mm->fetch_agents($user_id);
		   	$data["pos"] = $this->mm->fetch_pos($user_id);
		   	$region = $this->mm->fetch_region_using_user_id($user_id);
		   	$data["area_incharge"] = $this->mm->fetch_area_incharge($region);
    		$this->load->view('header',$pro_data);
    		$this->load->view('bussiness_followup',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
    }
    public function fetch_agent_bussiness_follow_data()
    {
        if($this->session->has_userdata('logged_in'))
       {
           $agent = $this->input->post("agent");
           $agent_data = $this->mm->fetch_agents_row($agent);
           $user = $this->mm->fetch_agents_user_name($agent_data->user_id);
           $ai_data = $this->mm->fetch_agents_ai_row($agent_data->area_incharge);
           $region = $this->mm->fetch_region_with_id($agent_data->region);
           $ai_name = "";
           $ai_phone = "";
           if($ai_data != null)
           {
               $ai_name = $ai_data->name;
               $ai_phone = $ai_data->phoneno;
           }
           
           $c_month = date('m');
           if($c_month == "01")
           {
               $c_month = "11";
           }
           else if($c_month == "02")
           {
               $c_month = "12";
           }
           else
           {
                $c_month--;
                $c_month--;
           }
           $c_month = str_pad($c_month, 2, '0', STR_PAD_LEFT);
           $t_month = date('m');
		   $year = date('Y');
		   if($t_month == "01" || $t_month == "02")
		   {
		       $year--;
		   }
		   
           $html = "<table class='table table-bordered'>";
           $html .= "<thead>";
           $html .= "<td>MONTH</td><td>MOTOR NO OF POLICY</td><td>HEALTH NO OF POLICY</td><td>SME NO OF POLICY</td><td>TOTAL PREMIUM COLLECTED </td>";
           $html .= "</thead>";
           $html .= "<tbody>";
           for($i=0; $i<3; $i++)
		   	{
    	    	    if($c_month == "13")
    	    	    {
    	    	        $c_month = "01";
    	    	        $year++;
    	    	    }
	    	        $from_date = $year."-".$c_month."-01";
	    	        $end_date = date("t", strtotime($from_date));
	    	        $to_date = $year."-".$c_month."-".$end_date;
    	    	    
    	    	    $class_id = 1;
                    $mot_policy = $this->mm->fetch_total_policy($class_id,$from_date,$to_date,$agent);
                    $mot_premium = 0;
        		   	foreach($mot_policy as $mp)
        		   	{
        		   	    $mot_premium = $mot_premium + $mp->total_premium;
        		   	}
        		   	$class_id = 2;
                    $health_policy = $this->mm->fetch_total_policy($class_id,$from_date,$to_date,$agent);
        		   	$health_premium = 0;
        		   	foreach($health_policy as $mp)
        		   	{
        		   	    $health_premium = $health_premium + $mp->total_premium;
        		   	}
                    $tot_premium = $mot_premium + $health_premium;
    	    	   
    	    	        $month_text = "";
    	    	        if($c_month == "01")
    	    	        {
    	    	            $month_text = "January";
    	    	        }
    	    	        else if($c_month == "02")
    	    	        {
    	    	            $month_text = "February";
    	    	        }
    	    	        else if($c_month == "03")
    	    	        {
    	    	            $month_text = "March";
    	    	        }
    	    	        else if($c_month == "04")
    	    	        {
    	    	            $month_text = "April";
    	    	        }
    	    	        else if($c_month == "05")
    	    	        {
    	    	            $month_text = "May";
    	    	        }
    	    	        else if($c_month == "06")
    	    	        {
    	    	            $month_text = "June";
    	    	        }
    	    	        else if($c_month == "07")
    	    	        {
    	    	            $month_text = "July";
    	    	        }
    	    	        else if($c_month == "08")
    	    	        {
    	    	            $month_text = "August";
    	    	        }
    	    	        else if($c_month == "09")
    	    	        {
    	    	            $month_text = "September";
    	    	        }
    	    	        else if($c_month == "10")
    	    	        {
    	    	            $month_text = "October";
    	    	        }
    	    	        else if($c_month == "11")
    	    	        {
    	    	            $month_text = "November";
    	    	        }
    	    	        else if($c_month == "12")
    	    	        {
    	    	            $month_text = "December";
    	    	        }
    	    	                  
                $html .= "<tr>";
                $html .= "<td>".$month_text."</td><td>".count($mot_policy)."</td><td>".count($health_policy)."</td><td>0</td><td>".$tot_premium."</td>";
                	$html .= "</tr>";
    	    	    
    		   	    
                $c_month++;
                $c_month = str_pad($c_month, 2, '0', STR_PAD_LEFT);
		   	}
           $html .= "</tbody>";
           $html .= "</table>";
           $old_chat_data = $this->mm->fetch_agent_old_chat_data($agent);
           $login_by = $this->session->userdata('session_role');
           $login_id = $this->session->userdata('session_id');
           $user_name =  $this->mm->fetch_agents_user_name($login_id);
           $user_name .= " ( ".$login_by." )";
           $old_chat = "";
           foreach($old_chat_data as $ocd)
           {
               if($ocd->created_by == $login_by && $ocd->created_id == $login_id)
               {
                   $message = "";
                   if($ocd->call_answer != "")
                   {
                       $message .= $ocd->call_answer."<br>";
                   }
                   if($ocd->remarks != "")
                   {
                       $message .= $ocd->remarks."<br>";
                   }
                   if($ocd->motor_nop != 0 || $ocd->health_nop != 0 || $ocd->sme_nop != 0)
                   {
                       $message .= "Commitment : <br>";
                       $message .= "M-".$ocd->motor_nop;
                       if($ocd->motor_remarks != "")
                       {
                           $message .= ", Remarks : ".$ocd->motor_remarks."<br>";
                       }
                       else
                       {
                           $message .= "<br>";
                       }
                       $message .= "H-".$ocd->health_nop;
                       if($ocd->health_remarks != "")
                       {
                           $message .= ", Remarks : ".$ocd->health_remarks."<br>";
                       }
                       else
                       {
                           $message .= "<br>";
                       }
                       $message .= "S-".$ocd->sme_nop;
                       if($ocd->sme_remarks != "")
                       {
                           $message .= ", Remarks : ".$ocd->sme_remarks."<br>";
                       }
                       else
                       {
                           $message .= "<br>";
                       }
                   }
                   $c_date_time = date("d-m-Y h:i:a",strtotime($ocd->created_at));
                   $old_chat .= '<div class="direct-chat-msg">
                                <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-left">'.$user_name.'</span>
                                <span class="direct-chat-timestamp pull-right">'.$c_date_time.'</span>
                                </div>
                                <!--<img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">-->
                                <div class="direct-chat-text">'.$message.'</div>
                                </div>';
               }
               else
               {
                   $chat_name = $this->mm->fetch_agents_user_name($ocd->created_id);
                   $chat_name .= " ( ".$ocd->created_by." )";
                   $message = "";
                   if($ocd->call_answer != "")
                   {
                       $message .= $ocd->call_answer."<br>";
                   }
                   
                   if($ocd->remarks != "")
                   {
                       $message .= $ocd->remarks."<br>";
                   }
                   if($ocd->motor_nop != 0 || $ocd->health_nop != 0 || $ocd->sme_nop != 0)
                   {
                       $message .= "Commitment : <br>";
                       $message .= "M-".$ocd->motor_nop;
                       if($ocd->motor_remarks != "")
                       {
                           $message .= ", Remarks : ".$ocd->motor_remarks."<br>";
                       }
                       else
                       {
                           $message .= "<br>";
                       }
                       $message .= "H-".$ocd->health_nop;
                       if($ocd->health_remarks != "")
                       {
                           $message .= ", Remarks : ".$ocd->health_remarks."<br>";
                       }
                       else
                       {
                           $message .= "<br>";
                       }
                       $message .= "S-".$ocd->sme_nop;
                       if($ocd->sme_remarks != "")
                       {
                           $message .= ", Remarks : ".$ocd->sme_remarks."<br>";
                       }
                       else
                       {
                           $message .= "<br>";
                       }
                   }
                   $c_date_time = date("d-m-Y h:i:a",strtotime($ocd->created_at));
                   $old_chat .= '
                                <div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-right">'.$chat_name.'</span>
                                <span class="direct-chat-timestamp pull-left">'.$c_date_time.'</span>
                                </div>
                                
                                <!--<img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">-->
                                
                                <div class="direct-chat-text">'.$message.'</div>
                                
                                </div>';
               }
           }
           echo json_encode(array("html" => $html, "user_name" => $user,"region" => $region, "ai_name" => $ai_name, "ai_phone" => $ai_phone, "agent_data" => $agent_data, "old_chat" => $old_chat));
       }
    }
    public function add_agent_Business_followup()
    {
        if($this->session->has_userdata('logged_in'))
        {
            $call_answer = $this->input->post("call_answer");
            $agent_r_date = $this->input->post("agent_r_date");
            $agent_r_time = $this->input->post("agent_r_time");
            $agent_remarks = $this->input->post("agent_remarks");
            $motor_agent_nop = $this->input->post("motor_agent_nop");
            $motor_agent_remarks = $this->input->post("motor_agent_remarks");
            $health_agent_nop = $this->input->post("health_agent_nop");
            $health_agent_remarks = $this->input->post("health_agent_remarks");
            $sme_agent_nop = $this->input->post("sme_agent_nop");
            $sme_agent_remarks = $this->input->post("sme_agent_remarks");
            $agent = $this->input->post("agent");
            $pos = $this->input->post("pos");
            $area_incharge = $this->input->post("area_incharge");
            $agent_ptc = $this->input->post("agent_ptc");
            $session_role = $this->session->userdata('session_role');
            $session_id = $this->session->userdata('session_id');
            $data = array(
                            "call_answer" => $call_answer,
                            "agent_id" => $agent,
                            "area_incharge_id" => 0,
                            "pos_id" => 0,
                            "remarks" => $agent_remarks,
                            "motor_nop" => $motor_agent_nop,
                            "motor_remarks" => $motor_agent_remarks,
                            "health_nop" => $health_agent_nop,
                            "health_remarks" => $health_agent_remarks,
                            "sme_nop" => $sme_agent_nop,
                            "sme_remarks" => $sme_agent_remarks,
                            "reshedule_date" => $agent_r_date,
                            "reshedule_time" => $agent_r_time,
                            "created_by" => $session_role,
                            "created_id" => $session_id,
                            "created_at" => date("Y-m-d H:i:s"),
                        );
            $this->mm->add_bussiness_followup($data);
            if($agent_ptc !="" && $agent_ptc != null)
            {
                $data1 = array("preferred_time_to_call" => $agent_ptc);
                $this->mm->agent_pos_update($agent,$data1);
            }
        }
    }
    public function fetch_agent_lead_dashboard_followup()
    {
        $draw = intval($this->input->post("draw"));
		$prospect_due_date = $this->input->post("prospect_due_date");
		$agent = $this->input->post("agent");
		$from_date = "all";
		$to_date = "all";
		if($prospect_due_date == "Overdue")
		{
		     $from_date = "all";
             $to_date = date("Y-m-d",strtotime("-1 days"));
		}
		else if($prospect_due_date == "7 days")
		{
		     $from_date = date("Y-m-d");
             $to_date = date('Y-m-d',strtotime("7 days"));
		}
		else if($prospect_due_date == "8-15 days")
		{
		    $from_date = date('Y-m-d',strtotime("8 days"));
            $to_date = date('Y-m-d',strtotime("15 days"));
		}
		else if($prospect_due_date == "16-30 days")
		{
		    $from_date = date('Y-m-d',strtotime("16 days"));
            $to_date = date('Y-m-d',strtotime("30 days"));
		}
		else if($prospect_due_date == "31-45 days")
		{
		     $from_date = date('Y-m-d',strtotime("31 days"));
             $to_date = date('Y-m-d',strtotime("45 days"));
		}
		$res = array();
		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_agent_lead_dashboard_followup($from_date,$to_date,$agent);
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Edit</button>";
            $date = date("d-m-Y",strtotime($da->due_date));
            if($da->due_date == "0000-00-00")
            {
                $date = "NO Due Date";
            }
            $arr[] = array(
                $a,
                $this->mm->fetch_class_name($da->class),
                $this->mm->get_client_name($da->id),
                $this->mm->get_client_phone($da->id),
                $date,
                $da->lead_status,
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
    public function fetch_customer_with_agent()
    {
         if($this->session->has_userdata('logged_in'))
    	 {
    	     $draw = intval($this->input->post("draw"));
    	     $agent = $this->input->post("agent");
    	     $a = $_POST['start'];
    	     $res = $this->mm->fetch_customer_with_agent($agent);
    	     $arr = [];
             foreach($res as $da)
             {
    	         $a++;
        	         
        	 $action = "<a href='create_lead?id=".$da->id."' class='btn btn-warning btn-xs'><i class='fa fa-eye'></i></a>";
        	 
        	 
        	 $client_name = "<a href='#' onclick=view_data(".$da->id.")>".$da->client_name."</a>";
        	 
                $arr[] =array(
                               $a,
                               $client_name,
                               $da->mobile_no,
                               $da->lclass,
                               $da->p_type,
                               $da->policy_no,
                               $da->pre_name,
                               date_format(date_create($da->policy_ex_date),"d-m-Y"),
                               $action,
                            );
                }
        	        $result = array(
                			"draw"=> $draw,
        				    "recordsTotal"=> $this->mm->get_all_customer_datas_count($agent),
        				    "recordsFiltered"=> $this->mm->get_customer_filtered_datas_count($agent),
        				    "data"=>$arr,
        				);
              echo json_encode($result);
        	 }
    }
    
     public function fetch_all_completed_policy()
    {
       $draw = intval($this->input->post("draw"));
	 
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	    
    	    $from_date = "all";
    	    $to_date = "2023-01-10";
    	    
    	    $ai = $this->input->post("ai");
    	    
        	$res = $this->mm->fetch_generate_policy($from_date,$to_date,$ai);
        	
    		$own_od = "";
    		$own_tp = "";
    		$on_net = "";
	
    		$arr = [];
            $a = $_POST['start'];
        
            foreach($res as $da)
            {
            	$a++;
            	
            	$client_name = "<a href='#' onclick=view_data(".$da->c_lead_id.")>".$da->client_name."</a>";
            
                $arr[] = array(
                    $a,
                    $client_name,
                    $da->mobile_no,
                    $da->agent_pos_code,
                    $da->policy_no,
                    $da->company_name,
                    "<span class='pull-right'>".number_format($da->total_own_damage,2)."</span>",
                    "<span class='pull-right'>".number_format($da->tot_liability_premium,2)."</span>",
                    "<span class='pull-right'>".number_format($da->total_premium,2)."</span>",
                    "<span class='pull-right'>".number_format($da->gst,2)."</span>",
                    "<span class='pull-right'>".number_format($da->own_commission_amt,2)."</span>",
                    "<span class='pull-right'>".number_format($da->agent_commission_amt,2)."</span>",
                    $da->business_name,
                    $da->class_name,
                    $da->policy_type,
                    date("d-m-Y",strtotime($da->policy_s_date)),
                    date("d-m-Y",strtotime($da->policy_ex_date)),
                    $da->policy_premium_name,
                );
            }
    
            $result = array(
            			"draw"=> $draw,
    				    "recordsTotal"=> $this->mm->get_all_generate_policy_count($from_date,$to_date,$ai),
    				    "recordsFiltered"=> $this->mm->get_filtered_generate_policy_count($from_date,$to_date,$ai),
    				    "data"=>$arr,
    				);
            echo json_encode($result);
        }
    }
    
    //AI
    public function bussiness_followup_ai()
    {
        if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    
    	    $user_id = 1;
		   	$pro_data["project_info"] = $this->mm->fetch_project_info($user_id);
		   	$data["agents"] = $this->mm->fetch_agents($user_id);
		   	$data["pos"] = $this->mm->fetch_pos($user_id);
		   	$data["area_incharge"] = $this->mm->fetch_area_incharge("admin");
    		$this->load->view('header',$pro_data);
    		$this->load->view('bussiness_followup_ai',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user")
	    {
	        //
	        $district = $this->mm->get_user_district($this->session->userdata("session_id"));
               
               $district_id = [];
               
               foreach($district as $da)
               {
                   $district_id[] = $da->district_id;
               }
               
                $get_district_id = $this->mm->get_region_id_by_district_id($district_id);
                           
                 $region_id = [];
               
               foreach($get_district_id as $da){ 
                   $region_id[] = $da->id;
               }
               
               $res123 = $this->mm->get_area_incharge($region_id);
	        //
	        $user_id = $this->session->userdata('session_id');
	        $pro_data["project_info"] = $this->mm->fetch_project_info($user_id);
	        $data["agents"] = $this->mm->fetch_agents($user_id);
		   	$data["pos"] = $this->mm->fetch_pos($user_id);
		   	$region = $this->mm->fetch_region_using_user_id($user_id);
		   	$data["area_incharge"] = $res123;//$this->mm->fetch_area_incharge($region);
    		$this->load->view('header',$pro_data);
    		$this->load->view('bussiness_followup_ai',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "AI")
	    {
	        $user_id = $this->session->userdata('session_id');
	        $pro_data["project_info"] = $this->mm->fetch_project_info($user_id);
	        $data["agents"] = $this->mm->fetch_agents($user_id);
		   	$data["pos"] = $this->mm->fetch_pos($user_id);
		   	$region = $this->mm->fetch_region_using_user_id($user_id);
		   	$data["area_incharge"] = $this->mm->fetch_area_incharge_ai($user_id);
    		$this->load->view('header',$pro_data);
    		$this->load->view('bussiness_followup_ai',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	        echo $this->session->userdata('session_role') == "AI";
	    	//redirect("login");
	    }
    }
    
   
    public function fetch_area_incharge_bussiness_follow_data()
    {
       if($this->session->has_userdata('logged_in'))
       {
           $area_incharge = $this->input->post("area_incharge");
           $area_incharge_data = $this->mm->fetch_area_incharge_row($area_incharge);
           $region_arr = $this->mm->get_ai_regions($area_incharge);
           
           $region = "";
           
           $r = 0;
           
           $reg = array();
           
           
           foreach($region_arr as $ra)
           {
               $reg [] = $ra->region_id;
               
               $r++;
               
               if($r == 1)
               {
                   $region .= $this->mm->fetch_region_with_id($ra->region_id);
               }
               else
               {
                    $region .= ", ".$this->mm->fetch_region_with_id($ra->region_id);
               }
           }
           
           
           $region .= "";
           
           $foe = "";
           
           $district_arr = $this->mm->get_district_with_regions($reg);
           
           $dis = array();
           
           foreach($district_arr as $da)
           {
                $dis [] = $da->district_id;
           }
           
           $foe_arr = $this->mm->get_foe_with_regions($dis);
           
           $f = 0;
           
           foreach($foe_arr as $fa)
           {
               $f++;
                if($f == 1)
               {
                   $foe .= $this->mm->get_user_name($fa->user_id);
               }
               else
               {
                    $foe .= ", ".$this->mm->get_user_name($fa->user_id);
               }
           }
           
           $agent = "<table class='table table-bordered'>
                      <tr>
                     ";
           
            $agent_arr = $this->mm->get_agent_with_ai($area_incharge);
            $a = 0;
            $temp_agent_open_count = 0; 
            $agent_open_count1 = array();
            $agent_open_count2 = array();

            foreach($agent_arr as $r)
            {                                                                                                                                                                                                                                                                                                                                                                                                                                                                                   
                $count_1 = $this->mm->agent_active_policy_count($r->id);
                $count_2 = $this->mm->agent_business_completed_count_1($r->id);
                $agent_count = $count_1 + $count_2;
                 
                 if(!in_array($agent_count,$agent_open_count1))
                 {
                      $agent_open_count1 [] = $agent_count;
                 }
             }
         
           rsort($agent_open_count1);
           
           $a = 0;

           foreach($agent_open_count1 as $ag)
           {
               foreach($agent_arr as $r)
                {
                    $count_1 = $this->mm->agent_active_policy_count($r->id);
                    $count_2 = $this->mm->agent_business_completed_count_1($r->id);
                    $agent_open_count = $count_1 + $count_2;
                
                    if($ag == $agent_open_count)
                    {
                        
                      $a++;
                     
                       $agent .= "<td>
                       <a style='padding:4px;' href='#' onclick=agent_business(".$r->id.")>".$r->name."(".$agent_open_count.")</a> </td>"; 
                       
                          if($a % 3 == 0)
                          {
                               $agent .="</tr></tr>";
                          }
                    }
                }
           }
           
           $agent .="</table>";
           
           $c_month = date('m');
           
           if($c_month == "01")
           {
               $c_month = "11";
           }
           else if($c_month == "02")
           {
               $c_month = "12";
           }
           else
           {
                $c_month--;
                $c_month--;
           }
           
           $c_month = str_pad($c_month, 2, '0', STR_PAD_LEFT);
           $t_month = date('m');
		   $year = date('Y');
		   if($t_month == "01" || $t_month == "02")
		   {
		       $year--;
		   }
           $html = "<table class='table table-bordered'>";
           $html .= "<thead>";
           $html .= "<td>MONTH</td><td>MOTOR NO OF POLICY</td><td>HEALTH NO OF POLICY</td><td>SME NO OF POLICY</td><td>TOTAL PREMIUM COLLECTED </td>";
           $html .= "</thead>";
           $html .= "<tbody>";
           for($i=0; $i<3; $i++)
		   	{
    	    	    if($c_month == "13")
    	    	    {
    	    	        $c_month = "01";
    	    	        $year++;
    	    	    }
	    	        $from_date = $year."-".$c_month."-01";
	    	        $end_date = date("t", strtotime($from_date));
	    	        $to_date = $year."-".$c_month."-".$end_date;
    	    	    
    	    	    $class_id = 1;
                    $mot_policy = $this->mm->fetch_total_policy_ai($class_id,$from_date,$to_date,$area_incharge);
                    $business_com = $this->mm->fetch_total_business_complete_ai($class_id,$from_date,$to_date,$area_incharge);
                    $mot_premium = 0;
                    $mot_business_premium = 0;
                    
        		   	foreach($mot_policy as $mp)
        		   	{
        		   	    $mot_premium = $mot_premium + $mp->total_premium;
        		   	}
        		   	
        		   	foreach($business_com as $mp)
        		   	{
        		   	    $mot_business_premium = $mot_business_premium + $mp->total_premium;
        		   	}
        		   	
        		   	$total_motor_premium =  $mot_premium + $mot_business_premium;
        		  
        		   	$class_id = 2;
        		   	
                    $health_policy = $this->mm->fetch_total_policy_ai($class_id,$from_date,$to_date,$area_incharge);
                    $health_business_com = $this->mm->fetch_total_business_complete_ai($class_id,$from_date,$to_date,$area_incharge);
                    
        		   	$health_premium = 0;
        		   	$health_busi_premium = 0;
        		   	
        		   	foreach($health_policy as $mp)
        		   	{
        		   	    $health_premium = $health_premium + $mp->total_premium;
        		   	}
        		   	
        		   	foreach($health_business_com as $mp)
        		   	{
        		   	    $health_busi_premium = $health_busi_premium + $mp->total_premium;
        		   	}
        		   	
        		   	$total_health_premium = $health_busi_premium + $health_premium;
        		   	
                    $tot_premium = $total_motor_premium + $total_health_premium;
    	    	    
    	    	        $month_text = "";
    	    	        
    	    	        if($c_month == "01")
    	    	        {
    	    	            $month_text = "January";
    	    	        }
    	    	        else if($c_month == "02")
    	    	        {
    	    	            $month_text = "February";
    	    	        }
    	    	        else if($c_month == "03")
    	    	        {
    	    	            $month_text = "March";
    	    	        }
    	    	        else if($c_month == "04")
    	    	        {
    	    	            $month_text = "April";
    	    	        }
    	    	        else if($c_month == "05")
    	    	        {
    	    	            $month_text = "May";
    	    	        }
    	    	        else if($c_month == "06")
    	    	        {
    	    	            $month_text = "June";
    	    	        }
    	    	        else if($c_month == "07")
    	    	        {
    	    	            $month_text = "July";
    	    	        }
    	    	        else if($c_month == "08")
    	    	        {
    	    	            $month_text = "August";
    	    	        }
    	    	        else if($c_month == "09")
    	    	        {
    	    	            $month_text = "September";
    	    	        }
    	    	        else if($c_month == "10")
    	    	        {
    	    	            $month_text = "October";
    	    	        }
    	    	        else if($c_month == "11")
    	    	        {
    	    	            $month_text = "November";
    	    	        }
    	    	        else if($c_month == "12")
    	    	        {
    	    	            $month_text = "December";
    	    	        }
    	    	        
    	    	      $tot_motor_count =  count($mot_policy) + count($business_com);
    	    	      $tot_health_count = count($health_policy) + count($health_business_com);
    	    	                  
                $html .= "<tr>";
                $html .= "<td>".$month_text."</td><td>".$tot_motor_count."</td><td>".$tot_health_count."</td><td>0</td><td>".$tot_premium."</td>";
                	$html .= "</tr>";
    	    	    
    		   	    
                $c_month++;
                $c_month = str_pad($c_month, 2, '0', STR_PAD_LEFT);
		   	}
           $html .= "</tbody>";
           $html .= "</table>";
           $old_chat_data = $this->mm->fetch_ai_old_chat_data($area_incharge);
           $login_by = $this->session->userdata('session_role');
           $login_id = $this->session->userdata('session_id');
           $user_name =  $this->mm->fetch_login_name($login_id);
           $user_name .= " ( ".$login_by." )";
           $old_chat = "";
           foreach($old_chat_data as $ocd)
           {
               if($ocd->created_by == $login_by && $ocd->created_id == $login_id)
               {
                   $message = "";
                   if($ocd->call_answer == "ReShedule")
                   {
                       $message .= $ocd->call_answer;
                       if($ocd->reshedule_date != "0000-00-00")
                       {
                            $date = date("d-m-Y",strtotime($ocd->reshedule_date));
                            $time = "";
                            if($ocd->reshedule_time != "00:00:00")
                            {
                                $time = date("h:i:a",strtotime($ocd->reshedule_time));
                                $message .= " at ".$date." - ".$time."<br>";
                            }
                            else
                            {
                                $message .= " at ".$date."<br>";
                            }
                       }
                       else
                       {
                           $message .= "<br>";
                       }
                   }
                   else if($ocd->call_answer != "")
                   {
                       $message .= $ocd->call_answer."<br>";
                   }
                   if($ocd->remarks != "")
                   {
                       $message .= $ocd->remarks."<br>";
                   }
                   if($ocd->motor_nop != 0 || $ocd->health_nop != 0 || $ocd->sme_nop != 0)
                   {
                       $message .= "Commitment : <br>";
                       $message .= "M-".$ocd->motor_nop;
                       if($ocd->motor_remarks != "")
                       {
                           $message .= ", Remarks : ".$ocd->motor_remarks."<br>";
                       }
                       else
                       {
                           $message .= "<br>";
                       }
                       $message .= "H-".$ocd->health_nop;
                       if($ocd->health_remarks != "")
                       {
                           $message .= ", Remarks : ".$ocd->health_remarks."<br>";
                       }
                       else
                       {
                           $message .= "<br>";
                       }
                       $message .= "S-".$ocd->sme_nop;
                       if($ocd->sme_remarks != "")
                       {
                           $message .= ", Remarks : ".$ocd->sme_remarks."<br>";
                       }
                       else
                       {
                           $message .= "<br>";
                       }
                   }
                   $c_date_time = date("d-m-Y h:i:a",strtotime($ocd->created_at));
                   $old_chat .= '<div class="direct-chat-msg">
                                <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-left">'.$user_name.'</span>
                                <span class="direct-chat-timestamp pull-right">'.$c_date_time.'</span>
                                </div>
                                <!--<img class="direct-chat-img" src="dist/img/user1-128x128.jpg" alt="message user image">-->
                                <div class="direct-chat-text">'.$message.'</div>
                                </div>';
               }
               else
               {
                   $chat_name = $this->mm->fetch_agents_user_name($ocd->created_id);
                   $chat_name .= " ( ".$ocd->created_by." )";
                   $message = "";
                   if($ocd->call_answer != "")
                   {
                       $message .= $ocd->call_answer."<br>";
                   }
                   
                   if($ocd->remarks != "")
                   {
                       $message .= $ocd->remarks."<br>";
                   }
                   if($ocd->motor_nop != 0 || $ocd->health_nop != 0 || $ocd->sme_nop != 0)
                   {
                       $message .= "Commitment : <br>";
                       $message .= "M-".$ocd->motor_nop;
                       if($ocd->motor_remarks != "")
                       {
                           $message .= ", Remarks : ".$ocd->motor_remarks."<br>";
                       }
                       else
                       {
                           $message .= "<br>";
                       }
                       $message .= "H-".$ocd->health_nop;
                       if($ocd->health_remarks != "")
                       {
                           $message .= ", Remarks : ".$ocd->health_remarks."<br>";
                       }
                       else
                       {
                           $message .= "<br>";
                       }
                       $message .= "S-".$ocd->sme_nop;
                       if($ocd->sme_remarks != "")
                       {
                           $message .= ", Remarks : ".$ocd->sme_remarks."<br>";
                       }
                       else
                       {
                           $message .= "<br>";
                       }

                   }
                   $c_date_time = date("d-m-Y h:i:a",strtotime($ocd->created_at));
                   $old_chat .= '
                                <div class="direct-chat-msg right">
                                <div class="direct-chat-info clearfix">
                                <span class="direct-chat-name pull-right">'.$chat_name.'</span>
                                <span class="direct-chat-timestamp pull-left">'.$c_date_time.'</span>
                                </div>
                                
                                <!--<img class="direct-chat-img" src="dist/img/user3-128x128.jpg" alt="message user image">-->
                                
                                <div class="direct-chat-text">'.$message.'</div>
                                
                                </div>';
               }
           }
           echo json_encode(array("html" => $html, "foe" => $foe, "agent" => $agent, "region" => $region, "area_incharge_data" => $area_incharge_data, "old_chat" => $old_chat));
       }
    }
    public function add_area_incharge_Business_followup()
    {
        if($this->session->has_userdata('logged_in'))
        {
            $call_answer = $this->input->post("call_answer");
            $area_incharge_r_date = $this->input->post("area_incharge_r_date");
            $area_incharge_r_time = $this->input->post("area_incharge_r_time");
            $area_incharge_remarks = $this->input->post("area_incharge_remarks");
            $motor_area_incharge_nop = $this->input->post("motor_area_incharge_nop");
            $motor_area_incharge_remarks = $this->input->post("motor_area_incharge_remarks");
            $health_area_incharge_nop = $this->input->post("health_area_incharge_nop");
            $health_area_incharge_remarks = $this->input->post("health_area_incharge_remarks");
            $sme_area_incharge_nop = $this->input->post("sme_area_incharge_nop");
            $sme_area_incharge_remarks = $this->input->post("sme_area_incharge_remarks");
            $area_incharge = $this->input->post("area_incharge");
            $area_incharge_ptc = $this->input->post("area_incharge_ptc");
            $session_role = $this->session->userdata('session_role');
            $session_id = $this->session->userdata('session_id');
            
        if(isset($_FILES))
		{
			$config['upload_path'] = './datas/docs/';
			$config['allowed_types'] = '*';
			
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('file'))
			{
				$file = '';
				$file_path = "";
			}
			else
			{
				$file_path = base_url().'datas/docs/'.$this->upload->data('file_name');
				$file = $this->upload->data('file_name');
			}
		}
     
            $data = array(
                            "call_answer" => $call_answer,
                            "area_incharge_id" => $area_incharge,
                            "agent_id" => 0,
                            "pos_id" => 0,
                            "remarks" => $area_incharge_remarks,
                            "motor_nop" => $motor_area_incharge_nop,
                            "motor_remarks" => $motor_area_incharge_remarks,
                            "health_nop" => $health_area_incharge_nop,
                            "health_remarks" => $health_area_incharge_remarks,
                            "sme_nop" => $sme_area_incharge_nop,
                            "sme_remarks" => $sme_area_incharge_remarks,
                            "reshedule_date" => $area_incharge_r_date,
                            "reshedule_time" => $area_incharge_r_time,
                            "created_by" => $session_role,
                            "created_id" => $session_id,
                            "upload" => $file,
                            "created_at" => date("Y-m-d H:i:s"),
                        );
            $this->mm->add_bussiness_followup($data);
            if($area_incharge_ptc !="" && $area_incharge_ptc != null)
            {
                $data1 = array("preferred_time_to_call" => $area_incharge_ptc);
                $this->mm->ai_update($area_incharge,$data1);
            }
        }
    }
    public function fetch_area_incharge_lead_dashboard_followup()
    {
        $draw = intval($this->input->post("draw"));
		$prospect_due_date = $this->input->post("prospect_due_date");
		$area_incharge = $this->input->post("area_incharge");
		$from_date = "all";
		$to_date = "all";
		if($prospect_due_date == "Overdue")
		{
		     $from_date = "all";
             $to_date = date("Y-m-d",strtotime("-1 days"));
		}
		else if($prospect_due_date == "7 days")
		{
		     $from_date = date("Y-m-d");
             $to_date = date('Y-m-d',strtotime("7 days"));
		}
		else if($prospect_due_date == "8-15 days")
		{
		    $from_date = date('Y-m-d',strtotime("8 days"));
            $to_date = date('Y-m-d',strtotime("15 days"));
		}
		else if($prospect_due_date == "16-30 days")
		{
		    $from_date = date('Y-m-d',strtotime("16 days"));
            $to_date = date('Y-m-d',strtotime("30 days"));
		}
		else if($prospect_due_date == "31-45 days")
		{
		     $from_date = date('Y-m-d',strtotime("31 days"));
             $to_date = date('Y-m-d',strtotime("45 days"));
		}
		$res = array();
		
		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_area_incharge_lead_dashboard_followup($from_date,$to_date,$area_incharge);
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Edit</button>";
            
            $date = date("d-m-Y",strtotime($da->due_date));
           
            if($da->due_date == "0000-00-00")
            {
                $date = "NO Due Date";
            }
            $arr[] = array(
                $a,
                $this->mm->fetch_class_name($da->class),
                $this->mm->get_client_name($da->id),
                $this->mm->get_client_phone($da->id),
                $date,
                $da->lead_status,
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
    
    public function fetch_customer_with_area_incharge()
    {
         if($this->session->has_userdata('logged_in'))
    	 {
    	     $draw = intval($this->input->post("draw"));
    	     $area_incharge = $this->input->post("area_incharge");
    	     $a = $_POST['start'];
    	     $res = $this->mm->fetch_customer_with_area_incharge($area_incharge);
    	     $arr = [];
             foreach($res as $da)
             {
    	         $a++;
        	         
        	 $action = "<a href='create_lead?id=".$da->id."' class='btn btn-warning btn-xs'><i class='fa fa-eye'></i></a>";
        	 
        	 
        	 $client_name = "<a href='#' onclick=view_data(".$da->id.")>".$da->client_name."</a>";
        	 
                $arr[] =array(
                               $a,
                               $client_name,
                               $da->mobile_no,
                               $da->lclass,
                               $da->p_type,
                               $da->policy_no,
                               $da->pre_name,
                               date_format(date_create($da->policy_ex_date),"d-m-Y"),
                               $action,
                            );
                }
        	        $result = array(
                			"draw"=> $draw,
        				    "recordsTotal"=> $this->mm->get_all_customer_datas_count_ai($area_incharge),
        				    "recordsFiltered"=> $this->mm->get_customer_filtered_datas_count_ai($area_incharge),
        				    "data"=>$arr,
        				);
              echo json_encode($result);
        	 }
    }
    
    //business complete
    
    public function fetch_bc_with_area_incharge()
    {
         if($this->session->has_userdata('logged_in'))
    	 {
    	     $draw = intval($this->input->post("draw"));
    	     $area_incharge = $this->input->post("area_incharge");
    	     $a = $_POST['start'];
    	     $res = $this->mm->fetch_bc_with_area_incharge($area_incharge);
    	     $arr = [];
             foreach($res as $da)
             {
    	         $a++;
        	         
        	 $action = "<a href='create_lead?id=".$da->id."' class='btn btn-warning btn-xs'><i class='fa fa-eye'></i></a>";
        	 
        	 
        	 $client_name = "<a href='#' onclick=view_data(".$da->id.")>".$da->client_name."</a>";
        	 
                $arr[] =array(
                               $a,
                               $client_name,
                               $da->mobile_no,
                               $da->lclass,
                               $da->p_type,
                               $da->policy_no,
                               $da->pre_name,
                               date_format(date_create($da->policy_ex_date),"d-m-Y"),
                               $action,
                            );
                }
        	        $result = array(
                			"draw"=> $draw,
        				    "recordsTotal"=> $this->mm->get_all_bc_datas_count_ai($area_incharge),
        				    "recordsFiltered"=> $this->mm->get_bc_filtered_datas_count_ai($area_incharge),
        				    "data"=>$arr,
        				);
              echo json_encode($result);
        	 }
    }
    
    // Renewals
    
    public function fetch_renewals_with_area_incharge()
    {
         if($this->session->has_userdata('logged_in'))
    	 {
    	     $draw = intval($this->input->post("draw"));
    	     $area_incharge = $this->input->post("area_incharge");
    	     $a = $_POST['start'];
    	     $res = $this->mm->fetch_renewals_with_area_incharge($area_incharge);
    	     $arr = [];
             foreach($res as $da)
             {
    	         $a++;
        	         
        	 $action = "<a href='create_lead?id=".$da->id."' class='btn btn-warning btn-xs'><i class='fa fa-eye'></i></a>";
        	 
        	 
        	 $client_name = "<a href='#' onclick=view_data(".$da->id.")>".$da->client_name."</a>";
        	 
                $arr[] =array(
                               $a,
                               $client_name,
                               $da->mobile_no,
                               $da->lclass,
                               $da->p_type,
                               $da->policy_no,
                               $da->pre_name,
                               date_format(date_create($da->policy_ex_date),"d-m-Y"),
                               $action,
                            );
                }
        	        $result = array(
                			"draw"=> $draw,
        				    "recordsTotal"=> $this->mm->get_all_renewals_datas_count_ai($area_incharge),
        				    "recordsFiltered"=> $this->mm->get_renewals_filtered_datas_count_ai($area_incharge),
        				    "data"=>$arr,
        				);
              echo json_encode($result);
        	 }
    }
    
    public function fetch_agent_business_details()
    {
       if($this->session->has_userdata('logged_in'))
       {
           
            $id = $this->input->post("id");
            $AgnDetails = $this->mm->get_agent_details($id);
            
            $last_month = date("Y")."-".date('m',strtotime('last month'))."-01";
            $last_month_end = date("Y")."-".date('m',strtotime('last month'))."-".date("t");
            $last_sec_month = date("Y-m-01", strtotime('-2 months'));
            $last_sec_month_end = date("Y-m-t", strtotime('-2 months'));
            $current_month = date("Y-m-01");
            $month_end = date("Y-m-t");
            
            $content = "";
           
           $content .= "<table class='table table-bordered'>
                         <thead>
                                 <tr>
                                    <th>Month</th>
                                    <th>Motor</th>
                                    <th>Health </th>
                                    <th>SME</th>
                                    <th>Total Premium</th>
                                 </tr>
                            </thead>";
           
           $content .="<tbody>";
           
        
        $LastsecMonth = $this->mm->get_bc_tot_no_policy($id,$last_sec_month,$last_sec_month_end,'1') + $this->mm->get_active_tot_no_policy($id,$last_month,$last_month_end,'1');
        $Lastsechealth = $this->mm->get_bc_tot_no_policy($id,$last_sec_month,$last_sec_month_end,'2') + $this->mm->get_active_tot_no_policy($id,$last_month,$last_month_end,'2');
        $LastsecSum = $this->mm->get_bc_tot_policy_sum($id,$last_sec_month,$last_sec_month_end,'2') + $this->mm->get_active_tot_sum_policy($id,$last_month,$last_month_end,'2');
        
        $LastMonthMotor = $this->mm->get_bc_tot_no_policy($id,$last_month,$last_month_end,'1') + $this->mm->get_active_tot_no_policy($id,$last_month,$last_month_end,'1');
        $LastMonhealth = $this->mm->get_bc_tot_no_policy($id,$last_month,$last_month_end,'2') + $this->mm->get_active_tot_no_policy($id,$last_month,$last_month_end,'2');
        $LastMonSum = $this->mm->get_bc_tot_policy_sum($id,$last_month,$last_month_end,'2') + $this->mm->get_active_tot_sum_policy($id,$last_month,$last_month_end,'2');
          
         $CurMonMotor = $this->mm->get_bc_tot_no_policy($id,$current_month,$month_end,'1') + $this->mm->get_active_tot_no_policy($id,$current_month,$month_end,'1');
         $CurMonHealth = $this->mm->get_bc_tot_no_policy($id,$current_month,$month_end,'2') + $this->mm->get_active_tot_no_policy($id,$current_month,$month_end,'2');
         $CurMonSum = $this->mm->get_bc_tot_policy_sum($id,$current_month,$month_end) + $this->mm->get_active_tot_sum_policy($id,$current_month,$month_end);
         
         
          $content .= "<tr>
                                <td>".date('M',strtotime('-2 months'))."</td>
                                <td>".$LastsecMonth."</td>
                                <td>".$Lastsechealth."</td>
                                <td>0</td>
                                <td>".$LastsecSum."</td>
                       </tr>";
                       
           $content .= "<tr>
                                <td>".date('M',strtotime('last month'))."</td>
                                <td>".$LastMonthMotor."</td>
                                <td>".$LastMonhealth."</td>
                                <td>0</td>
                                <td>".$LastMonSum."</td>
                       </tr>";
                       
                       $content .= "<tr>
                                <td>".date('M')."</td>
                                <td>".$CurMonMotor."</td>
                                <td>".$CurMonHealth."</td>
                                <td>0</td>
                                <td>".$CurMonSum."</td>
                       </tr>
                       </tbody>
                     </table>";
                       
                       
                  echo json_encode(array("content" =>$content,"AgnDetails" =>$AgnDetails));
                  //echo $content;     
           
       }
    }
    
   public function forgot_password_mailtest()
    {
        $this->load->library('email');
        $email_id = "harshamvc11@gmail.com";
        $mid = "6705";
        $password = "12345";
        $subject = "Your login information from kalyanaa.com";
        $msg ="";
		$msg .="<html><head>";
		$msg .="<meta http-equiv='Content-Type' content='text/html; charset=windows-1252'>";
		$msg .="</head><body>";
		$msg .="<table border='0' cellpadding='0' cellspacing='0' width='496'>";
		$msg .="<tr>";
		$msg .="<td valign='top' align='left' width='496' style='margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: arial, sans-serif; padding-left: 8px; padding-top: 8px; '>";
		$msg .="<img border='0' src='https://kalyanaa.com/img/b/home0.jpg' width='400'>";
		$msg .="</td>";
		$msg .=" </tr>";
		$msg .="<tr>";
		$msg .="<td valign='top' width='496' style='margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: arial, sans-serif; font: normal normal normal 22px/normal Georgia, 'times new roman'; color: rgb(255, 142, 51); padding-top: 20px; padding-left: 8px; '>";
		$msg .=" Your Password Details</td>";
		$msg .="</tr>";
		$msg .="<tr>";
		$msg .="<td valign='top' align='center' width='496' style='margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: arial, sans-serif; padding-top: 5px; '>";
		$msg .="<hr></td>";
		$msg .="</tr>";
		$msg .="<tr>";
		$msg .="<td valign='top' width='496' style='margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: arial, sans-serif; font: normal normal normal 12px/normal arial; color: rgb(51, 51, 51); text-align: justify; padding-top: 30px; padding-left: 10px; padding-right: 10px; '>";
		$msg .="Dear ".$mid.",<br>";
		$msg .="<br>";
		$msg .="Thank you for your interest in kalyanaa.com. We are delighted to assist ";
		$msg .="you in all your requirements. As per your request for password, the ";
		$msg .="following are your login details.</td>";
		$msg .="</tr><tr>";
		$msg .="<td valign='top' width='496' style='margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: arial, sans-serif; padding-top: 30px; padding-left: 100px; font: normal normal bold 12px/normal arial; color: rgb(51, 51, 51); padding-bottom: 5px; '>";
		$msg .="Your login details</td>";
		$msg .="</tr>";
		$msg .="<tr>";
		$msg .="<td valign='top' align='center' width='496' style='margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: arial, sans-serif; '>";
		$msg .="<table border='0' cellpadding='0' cellspacing='0' width='295' height='51' style='border-top-width: 1px; border-right-width: 1px; border-bottom-width: 1px; border-left-width: 1px; border-top-style: solid; border-right-style: solid; border-bottom-style: solid; border-left-style: solid; border-top-color: rgb(219, 219, 219); border-right-color: rgb(219, 219, 219); border-bottom-color: rgb(219, 219, 219); border-left-color: rgb(219, 219, 219); font: normal normal normal 12px/normal arial; color: rgb(51, 51, 51); '>";
		$msg .=" <tr>";
		$msg .="<td width='145' height='25' align='center' style='margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: arial, sans-serif; border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(219, 219, 219); font: normal normal normal 12px/normal arial; color: rgb(51, 51, 51); '>";
		$msg .="Your MatrimonyID</td>";
		$msg .="<td width='147' height='25' align='center' style='margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: arial, sans-serif; border-left-width: 1px; border-left-style: solid; border-left-color: rgb(219, 219, 219); border-bottom-width: 1px; border-bottom-style: solid; border-bottom-color: rgb(219, 219, 219); font: normal normal bold 12px/normal arial; color: rgb(51, 51, 51); '>";
  		$msg .= $mid."</td>";
		$msg .="</tr>";
		$msg .="<tr>";
		$msg .="<td style='margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: arial, sans-serif; font: normal normal normal 12px/normal arial; color: rgb(51, 51, 51); padding-left: 25px; '>";
		$msg .="Password</td>";
		$msg .="<td align='center' style='margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: arial, sans-serif; border-left-width: 1px; border-left-style: solid; border-left-color: rgb(219, 219, 219); font: normal normal bold 12px/normal arial; color: rgb(51, 51, 51); '>";
		$msg .= $password."</td>";
		$msg .="</tr>";
		$msg .="</table>";
		$msg .="</td>";
		$msg .="</tr>";
		$msg .="<tr>";
		$msg .="<td valign='top' align='center' width='496' style='margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: arial, sans-serif; padding-top: 10px; '>";
		$msg .=" <a href='https://kalyanaa.com/usr/login.php' target='_blank' style='color: rgb(17, 85, 204); '>Login now";
		$msg .="</a></td>";
		$msg .="</tr>";
		$msg .="<tr>";
		$msg .="<td valign='top' align='center' width='496' style='margin-top: 0px; margin-right: 0px; margin-bottom: 0px; margin-left: 0px; font-family: arial, sans-serif; font: normal normal normal 12px/normal arial; color: rgb(51, 51, 51); text-align: justify; padding-top: 30px; padding-left: 10px; padding-right: 10px; '>";
		$msg .="Kindly make a note of your login information or save this e-mail for future ";
		$msg .="reference.<br>";
		$msg .="<br>";
		$msg .="If you need further assistance please feel free to contact our 24x7 Live ";
		$msg .="Help or e-mail kalyanaa.com@gmail.com<br>";
		$msg .=" <br>";
		$msg .="<br>";
		$msg .=" Our warmest wishes,<br>";
		$msg .=" <b>Kalyanaa.com Team</b></td>";
		$msg .="</tr>";
		$msg .="</table>";
		$msg .="</body></html>";
		$from = "support@kalyanaa.in";
		
    	$this->email->from($from, 'KALYANAA');
    	$this->email->to($email_id);
        $to = $email_id;
        $this->email->set_mailtype("html"); 
        $this->email->subject($subject);
        $this->email->message($msg);
        $this->email->send();

    }
    
    function debuginfo() {
        $role = $this->session->userdata();
        echo '<pre>';print_r($role);print'</pre>';
    }
}
