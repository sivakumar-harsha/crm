<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Main_bk extends CI_Controller {
    
     public $_ci_ob_level;
	public $form_validation;
	public $upload;
	public $session;
	public $hooks;
	public $config;
	public $log;
	public $utf8;
	public $uri;
	public $router;
	public $output;
	public $security;
	public $input;
	public $lang;
	public $load;
	public $db;


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
	   // print_r("hi"); exit;
		$email_id = get_cookie('email_id'); 
      // print_r("hi"); exit;
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
	
}
