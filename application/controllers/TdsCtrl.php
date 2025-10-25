<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class TdsCtrl extends CI_Controller {
     public $pm;
    public $cm;
    public $lm;
    public $tm;
    public $mm;
    public $database;
    public $session;
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
		$this->load->model('Configmod','cm');
		$this->load->model('MasterMod','mm');
		$this->load->model('LeadMod','lm');
		$this->load->model('TdsMod','tm');
		$this->load->library('audit');
		$this->load->library('session');
		$this->load->helper('url');
		
	}
	
	
   	  public function tds_entry()
        {
            if( !( $this->session->has_userdata('logged_in') ) ){
                redirect('login', 'refresh');
            }
            
            if(!$this->auth->can_access('List Payout')){
                redirect('home', 'refresh');
            }
            
            if($this->session->has_userdata('logged_in')) 
            {
                if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
                {    		
                    $pro_data["project_info"] = $this->mm->fetch_project_info();
                    $data["insurer_company"] = $this->cm->get_insurer_company();
                    $data["class"] = $this->cm->get_insurer_class();
                    $data["policy_type"] = $this->pm->fetch_policy_type();
                    $this->load->view('header',$pro_data);
                    $this->load->view('tds_entry',$data);
                    $this->load->view('footer',$pro_data);
                }
                else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user")
                {
                        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
                        if($check_user_i->masters_view == "1")
                        {
                        $pro_data["project_info"] = $this->mm->fetch_project_info();
                        $data["insurer_company"] = $this->cm->get_insurer_company();
                         $data["class"] = $this->cm->get_insurer_class();
                        $this->load->view('header',$pro_data);
                        $this->load->view('tds_entry',$data);
                        $this->load->view('footer',$pro_data);
                }
                else
                {
                    echo "<script>alert('Permission Denied');window.location.href='home';</script>";
                }
             }
            }
        }
        
        
        public function fetch_poilicy_class_list()
        {
        if($this->session->has_userdata('logged_in')) 
        {
            $policy_class = $this->input->post("policy_class");
            
            
          $res = $this->tm->fetch_poilicy_class_list($policy_class);
           echo $this->db->last_query();
        $content = "<option value = ''>--Select--</option>";
              
              foreach($res as $da)
              {
                  $content .="<option value=".$da->id.">".$da->policy_type ."</option>";
              }
              
              echo $content;
       
       
       }
       
    }
    
    
    
    public function add_tds_amount()
    {
      if($this->session->has_userdata('logged_in')) 
        {
            $insurer_company = $this->input->post("insurer_company");
            $policy_class = $this->input->post("policy_class");
            $policy_type = $this->input->post("policy_type");
            $jayantha_tds = $this->input->post("jayantha_tds");
            $unicorn_tds = $this->input->post("unicorn_tds");
            $fromdate = $this->input->post("fromdate");
            $todate = $this->input->post("todate");
            

      
            $data = array(
                         "insurer_company" => $insurer_company,
                         "policy_class" => $policy_class,
                         "policy_type" => $policy_type,
                         "jayantha_tds" => $jayantha_tds,
                         "unicorn_tds" => $unicorn_tds,
                         "fromdate" => $fromdate,
                          "todate" => $todate,
                         "created_by" =>$this->session->userdata("session_id"),
	                      "created_date" =>date("Y-m-d H:i:s"),
                       );
                       
                       
                       
          $res = $this->tm->add_tds_amount($data);               
          echo "Success";
        }
        
    }
    
    
    public function fetch_tds_amount_list()
    {
		$draw = intval($this->input->post("draw"));
		$from_date = $this->input->post("f_date");
		$to_date = $this->input->post("to_date");
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->tm->fetch_tds_amount_list($from_date,$to_date);
		}
		
		$arr = [];
        $a = 0;
        
        foreach($res as $da)
        {
        	$a++;


            $action = "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Edit</button>";
                        
            
            $arr[] = array(
                $a,
                $da->company_name,
                $da->class,
                $da->policy_type,
                $da->jayantha_tds,
                $da->unicorn_tds,
                date("d-m-Y", strtotime($da->fromdate)),
                date("d-m-Y", strtotime($da->todate)),
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

    
    
    
    
    
    public function edit_tds_amount()
    {
        if($this->session->has_userdata('logged_in')) 
        {
            $insurer_company = $this->input->post("insurer_company");
            $policy_class = $this->input->post("policy_class");
            $policy_type = $this->input->post("policy_type");
            $jayantha_tds = $this->input->post("jayantha_tds");
            $unicorn_tds = $this->input->post("unicorn_tds");
            $fromdate = $this->input->post("fromdate");
            $todate = $this->input->post("todate");
            $id = $this->input->post("id");
            
             $updated_date = date("Y-m-d H:i:sa");
            
              $data = array(
                         "insurer_company" => $insurer_company,
                         "policy_class" => $policy_class,
                         "policy_type" => $policy_type,
                         "jayantha_tds" => $jayantha_tds,
                         "unicorn_tds" => $unicorn_tds,
                         "fromdate" => $fromdate,
                         "todate" => $todate,
                         "updated_date" =>$updated_date,
                       );
                       
        $res = $this->tm->edit_tds_amount($data,$id);                   
         echo "Success";   
       }
        
    }
    
    public function fetch_edit_tds_amount()
    {
        
        $id = $this->input->post("id");
        $res = $this->tm->fetch_edit_tds_amount($id);
	    echo json_encode($res);
    }
        

}