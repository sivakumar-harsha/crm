<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class BundelCtrl extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('BundelMod','bm');
        $this->load->model('MasterMod','mm');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('cookie');
    }
 
 //bundel master log start  
    public function bundel_master()
    {
        if(!($this->session->has_userdata('logged_in'))){
            redirect('login','refresh');
        }
        
        if(!$this->auth->can_access('Create Bundel Master')){
            redirect('access_denied','refresh');
        }
        
        if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin")
        {
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $data["insurance_company"] = $this->bm->fetch_list_of_insurance_company();
            $data["class"] = $this->bm->fetch_list_of_class();
            $data["policy_type"] = $this->bm->fetch_list_of_policy_type();
            $this->load->view('header',$pro_data);
            $this->load->view('bundel_master',$data);
            $this->load->view('footer',$pro_data);
        }
    }
    
    public function fetch_bundel_master()
	{
		$draw = intval($this->input->get("draw"));
        $start = intval($this->input->get("start"));
        $length = intval($this->input->get("length"));
        
        $arr = [];
        $a = 0 ;
        
        $res = $this->bm->fetch_bundel_master();
        
        foreach($res as $da)
        {
            $a++;
            
            $status = (isset($da->status) && ($da->status == "Y")) ? "N" : "Y";
            
            $status_txt = ($status == "Y") ? "Deactive" : "Active";
            $status_btn = ($status == "Y") ? "btn-success" : "btn-danger";
            

            $action = '<button class="btn btn-warning btn-sm" onclick="edit_data('.$da->id.')">Edit</button>
                    <button class="btn '.$status_btn.' btn-sm" onclick="deactive('.$da->id.', \''.$status.'\')">'.$status_txt.'</button>';
            // Assuming $da is an object with properties bundel_name, od_year, and tp_year
            $combine = $da->bundel_name . ' (' . $da->od_year . ' Yr OD + ' . $da->tp_year . ' Yr TP)';
            
            $CompanyName = isset($da->ic_company_name) ? $da->ic_company_name : 'ALL';
            $ClassName = isset($da->cl_class) ? $da->cl_class : 'ALL';
            $policyTypeName = isset($da->pt_policy_type) ? $da->pt_policy_type : 'ALL';
                

            
            $arr[] = array(
                $a,
                $CompanyName,
                $ClassName,
                $policyTypeName,
                $combine,
                $da->od_year,
                $da->tp_year,
                $action,
            );
        }
        $result = array("draw"=> $draw,
        "recordsTotal"=>count($res),
        "recordsFiltered"=> count($res),
        "data"=>$arr);
        echo json_encode($result);
	}
	
	public function add_bundel_master()
	{
	    $insurance_company = $this->input->post("insurance_company_id");
	    $class             = $this->input->post("class_id");
	    $policy            = $this->input->post("policy_type_id");
	    $bundel_name       = $this->input->post("bundel_name");
	    $od_year           = $this->input->post("od_year");
	    $tp_year           = $this->input->post("tp_year");
	    
	    $data = array(
	        'insurance_company_id' =>$insurance_company,
	        'class_id'             =>$class,
	        'policy_type_id'       =>$policy,
	        'bundel_name'          =>$bundel_name,
	        'od_year'              =>$od_year.'year OD',
	        'tp_year'              =>$tp_year,
	        'status'               =>"Y",
	        'create_date'          =>date("Y-m-d H:i:s"),
	        'created_by'           =>$this->session->userdata("session_id"),
	        );
	   $res = $this->bm->add_bundel_master($data);
	   if ($res) {
                    $response = [
                        'success' => true,
                        'status_text' => 'Successfuly insert data.',
                        'status_icon' => 'success',
                        //'redirect_url' => 'index.php'
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'status_text' => 'Something went wrong. Please try again later.',
                        'status_icon' => 'error',
                        //'redirect_url' => 'index.php'
                    ];
                }
	   echo json_encode($response);
	}
	
	public function edit_bundel_master()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	   $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	   
	        if($check_user_i->masters_add == "1")
	        {
        		$id = $this->input->post("id");
                $insurance_company = $this->input->post("insurance_company_id");
        	    $class             = $this->input->post("class_id");
        	    $policy            = $this->input->post("policy_type_id");
        	    $bundel_name       = $this->input->post("bundel_name");
        	    $od_year           = $this->input->post("od_year");
        	    $tp_year           = $this->input->post("tp_year");
	            $od_yr = $od_year."year TP";
                $data = array(
                    'insurance_company_id' =>$insurance_company,
        	        'class_id'             =>$class,
        	        'policy_type_id'       =>$policy,
        	        'bundel_name'          =>$bundel_name,
        	        'od_year'              =>$od_yr,
        	        'tp_year'              =>$tp_year,
        	        'status'               =>"Y",
        	        'update_date'          =>date("Y-m-d H:i:s"),
        	        'updated_by'           =>$this->session->userdata("session_id"),
                    );
                $res = $this->bm->edit_bundel_master($id,$data);
                if ($res) {
                    $response = [
                        'success' => true,
                        'status_text' => 'Successfuly updated data.',
                        'status_icon' => 'success',
                        //'redirect_url' => 'index.php'
                    ];
                } else {
                    $response = [
                        'success' => false,
                        'status_text' => 'Unable to change status',
                        'status_icon' => 'error',
                        //'redirect_url' => 'index.php'
                    ];
                }
                
                echo json_encode($response);
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
	}
	public function fetch_edit_bundel_master()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->bm->fetch_edit_bundel_master($id);
			echo json_encode($res);
		}
	}
	
	public function deactivate_bundel_master()
	{
	    $id = $this->input->post("id");
	    $status = $this->input->post("status");
	    
		$data = array(
            'status' => $status,
        );
        
        $res = $this->bm->update_bundel_master_status($data,$id);
        
        
        $status_txt = ($status == "Y") ? "Active" : "Deactive";
            
        if ($res) {
            $response = [
                'success' => true,
                'status_text' => 'Successfuly '.$status_txt.' status.',
                'status_icon' => 'success',
                //'redirect_url' => 'index.php'
            ];
        } else {
            $response = [
                'success' => false,
                'status_text' => 'Unable to change status',
                'status_icon' => 'error',
                //'redirect_url' => 'index.php'
            ];
        }
                
            echo json_encode($response);
	}
	
	public function getPolicyType()
	{
	    $policytype_id = $this->input->get("policytype_id");
	    $res = $this->bm->getPolicyType($policytype_id);
	    echo json_encode($res);
	}
//bundel master log end

}