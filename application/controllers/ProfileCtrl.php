<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ProfileCtrl extends CI_Controller {
    public $rolepermissionModel;
    public $auth;
    public $pm;
    public $mm;
    public $session;    

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('MasterMod','mm');
		$this->load->model('ProfileMod','pm');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('cookie');
	}
	
	// 	Profile Agent Get_data Start
	
	public function profile_admin()
	{
	     $session_id = $this->session->userdata('session_id');
		if($this->session->has_userdata('logged_in')) 
    	{ 
    	   if($this->session->userdata('session_role') == "user")
    	    {
    	        $session["admin_info"] = $this->pm->fetch_admin_info($session_id);
    	    }
    	    else
    	    {
    	        $session["admin_info"] = $this->pm->fetch_admin_info($session_id);
		   	    $session["company_info"] = $this->pm->fetch_company_info($session_id);
    	    }
    	    
    	   
		   	$pro_data["project_info"] = $this->pm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    // 		$this->load->view('sidebar',$pro_data);
    		$this->load->view('profile_admin',$session);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}
	
// 	Profile Agent Get_data End

// 	Profile Agent  Update Data Start
	  
	public function add_profile_admin()
	{
	    $id = $this->input->post("id");
	    $name = $this->input->post("name");
	    $email = $this->input->post("email_id");
	    $password = $this->input->post("password");
	    $phone = $this->input->post("phoneno");
	    $address = $this->input->post("address");
	    
	    $id = $this->input->post("id");
	    $c_name = $this->input->post("c_name");
	    $c_city = $this->input->post("city");
	    $c_address = $this->input->post("c_address");
	    $c_phone = $this->input->post("phone");
	    $add_phone = $this->input->post("additional_mobile");
	    $c_email = $this->input->post("email");
	    $gst    = $this->input->post("gst_no");
	    $upi = $this->input->post("upi_link");
	    
	 
	    $data =     array("name" =>$name,
            	          "email_id" =>$email,
            	          "password" =>$password,
                          "phoneno" =>$phone,
    	                  "address" =>$address,
                          );
	             
	                  
	     $data1 =   array("c_name" =>$c_name,
                	       "city" =>$c_city,
                	       "c_address" =>$c_address,
                	       "phone" =>$c_phone,
                	       "additional_mobile" =>$add_phone,
                	       "email" =>$c_email,
                	       "gst_no" =>$gst,
                	       "upi_link" =>$upi,
                	                );         
	    
	    
	     $res = $this->pm->add_profile_admin($data,$id);
	     
	     $res1 = $this->pm->add_company_setting($data1,$id);
	     
	}
	
// 	Profile Update Data End

public function smedetails()
	{
	 
	        $pro_data["project_info"] = $this->pm->fetch_project_info();
	         //$data["smepolicy"] = $this->pm->fetch_smepolicy();
	         $data["smepolicy"] = $this->pm->fetch_policy_type_using_class();
    		$this->load->view('header',$pro_data);
    		$this->load->view('smedetails',$data);
    		$this->load->view('footer',$pro_data);
	}
	
	public function add_smedetails()
	{
		if($this->session->has_userdata('logged_in')) 
    	{   
    	    $smepolicy = $this->input->post("sme_details");
    	    $ins_period_from =$this->input->post("ins_period_from");
    		$ins_period_todate = $this->input->post("ins_period_todate");
    		$occupancy =$this->input->post("occupancy");
    		$commodity =$this->input->post("commodity");
    		$transport =$this->input->post("transport");
    		$packing =$this->input->post("packing");
    		$b_valuation_import =$this->input->post("b_valuation_import");
    		$b_valuation_inland =$this->input->post("b_valuation_inland");
    		$voyage_export =$this->input->post("voyage_export");
    		$voyage_import =$this->input->post("voyage_import");
    		$voyage_inland =$this->input->post("voyage_inland");
    		$turnover =$this->input->post("turnover");
    		$initial_sum_insured =$this->input->post("initial_sum_insured");
    		$sales_domestic =$this->input->post("sales_domestic");
    		$purchase_import =$this->input->post("purchase_import");
    		$purchase_domestic =$this->input->post("purchase_domestic");
    		$bottomlimit =$this->input->post("bottomlimit");
    		$locationimport =$this->input->post("locationimport");
    		$bottom_import_limit =$this->input->post("bottom_import_limit");
    		$location_import_limit =$this->input->post("location_import_limit");
    		$current_insurer =$this->input->post("current_insurer");
    		$claim_history =$this->input->post("claim_history");
    		$date =$this->input->post("date");
    		
    		$fire_from_date =$this->input->post("fire_from_date");
    		$fire_to_date =$this->input->post("fire_to_date");
    		$fire_occupancy =$this->input->post("fire_occupancy");
    		$commodity =$this->input->post("commodity");
    		$financial_institution =$this->input->post("financial_institution");
    		$fire_particulars_1 =$this->input->post("fire_particulars_1");
    		$fire_sum_ins_1 =$this->input->post("fire_sum_ins_1");
    		$burglary_sum_ins_1 =$this->input->post("burglary_sum_ins_1");
    		$fire_particulars_2 =$this->input->post("fire_particulars_2");
    		$fire_sum_ins_2 =$this->input->post("fire_sum_ins_2");
    		$burglary_sum_ins_2 =$this->input->post("burglary_sum_ins_2");
    		$fire_particulars_3 =$this->input->post("fire_particulars_3");
    		$fire_sum_ins_3 =$this->input->post("fire_sum_ins_3");
    		$burglary_sum_ins_3 =$this->input->post("burglary_sum_ins_3");
    		$fire_particulars_4 =$this->input->post("fire_particulars_4");
    		$fire_sum_ins_4 =$this->input->post("fire_sum_ins_4");
    		$burglary_sum_ins_4 =$this->input->post("burglary_sum_ins_4");
    		$clause_under_burglary =$this->input->post("clause_under_burglary");
    		$fire_expiry_insurer =$this->input->post("fire_expiry_insurer");
    
        	if($smepolicy == "74"){ 	
        		$data = array(
        		              "ins_period_from"=>$ins_period_from,
        		              "ins_period_todate"=>$ins_period_todate, 
        		              "occupancy" => $occupancy,
        		              "commodity" =>$commodity, 
        		              "transport" =>$transport,
        		              "packing" =>$packing,
        		              "b_valuation_import"=>$b_valuation_import,
        		              "b_valuation_inland"=>$b_valuation_inland,
        		              "transport"=>$transport,
        		              "voyage_export"=>$voyage_export,
        		              "voyage_import"=>$voyage_import,
        		              "voyage_inland"=>$voyage_inland,
        		              "turnover"=>$turnover,
        		              "initial_sum_insured"=>$initial_sum_insured,
        		              "sales_domestic" =>$sales_domestic,
        		              "purchase_import" =>$purchase_import,
        		              "bottomlimit"=>$bottomlimit,
        		              "bottom_import_limit"=>$bottom_import_limit,
        		              "location_import_limit"=>$location_import_limit,
        		              "locationimport" =>$locationimport,
        		              "current_insurer"=>$current_insurer,
        		              "claim_history" => $claim_history,
        		              "date" => $date);
        		              
        	    	$insert_id =$this->pm->add_smedetails($data);
        	    }
        	else if($smepolicy == "78")
        	{ 
        	     $data2 =array(
                		        "sme_id" => $smepolicy,
                		        "fire_from_date" =>$fire_from_date,
                		        "fire_to_date" =>$fire_to_date,
                		        "fire_occupancy" =>$fire_occupancy,
                		        "commodity" =>$commodity,
                		        "financial_institution" =>$financial_institution,
                		        "fire_particulars_1" =>$fire_particulars_1,
                		        "burglary_sum_ins_1" =>$burglary_sum_ins_1,
                		        "fire_particulars_2" =>$fire_particulars_2,
                		        "fire_sum_ins_2" => $fire_sum_ins_2,
                		        "burglary_sum_ins_3" => $burglary_sum_ins_3,
                		        "fire_particulars_3" => $fire_particulars_3,
                		        "fire_sum_ins_3" => $fire_sum_ins_3,
                		        "burglary_sum_ins_3"=>$burglary_sum_ins_3,
                		        "fire_particulars_4" =>$fire_particulars_4,
                		        "fire_sum_ins_4" =>$fire_sum_ins_4,
                		        "burglary_sum_ins_4" =>$burglary_sum_ins_4,
                		        "clause_under_burglary"=>$clause_under_burglary,
                		        "fire_expiry_insurer" =>$fire_expiry_insurer,
                		        "fire_date" =>$fire_date
                		             );
                		      $this->pm->add_smedetails_fire_suminsured($data2);
        	}
	
		echo "success";
	   }
}

   public function smepolicytype()
	{
	 
	        $pro_data["project_info"] = $this->pm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('smepolicytype');
    		$this->load->view('footer',$pro_data);
	}
	
	
	public function fetch_policy()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->pm->fetch_policy();
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Edit</button>
                        <button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> Delete</button>";
            
            $arr[] = array(
                $a,
                $da->smepolicy,
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
	
	public function add_policy()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$smepolicy = $this->input->post("smepolicy");


    		$data = array("smepolicy" => $smepolicy);
    		$this->pm->add_policy($data);

    		echo "Success";
    	}
	}
	
	public function fetch_edit_smepolicy()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->pm->fetch_edit_smepolicy($id);
			echo json_encode($res);
		}
	}
	
	public function edit_sempolicy()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$smepolicy = $this->input->post("smepolicy");
    		$id = $this->input->post("id");

    		$data = array("smepolicy" => $smepolicy);
    		$this->pm->edit_sempolicy($id, $data);

    		echo "Success";
    	}
	}
	
	public function delete_policy()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
			$id = $this->input->post("id");
			$this->pm->delete_policy($id);
    	}
	}


}