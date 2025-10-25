<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ClaimCtrl extends CI_Controller {
    
    public $rolepermissionModel;
    public $auth;
    public $mm;
    public $clm;
    public $session;
    public $lm;
    public $cm;
    public $upload;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Configmod','cm');
		$this->load->model('MasterMod','mm');
		$this->load->model('ClaimMod','clm');
		$this->load->model('LeadMod','lm');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('cookie');
	}
 
     public function claim()
     {
         if($this->session->has_userdata('logged_in')) 
        	{   
        	    $id = $this->input->get("id");
        	     
        	    
        	    $res=[];
        	    
        	    if($id)
        	    {
        	        $res = $this->clm->fetch_edit_claim_data($id);
        	    }
        	    
        	    
        	    $data['claimdata'] = $res;
        	    
        	}
          if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        	{    		
    		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		   	$data["users"]=$this->cm->fetch_users();
    		   	$data["agents_pos"] = $this->clm->list_of_pos_and_agents();
    		   	$data["customers"] = $this->clm->fetch_all_customers();
    		   	$data["name"]=$this->clm->fetch_areaincharge();
        		$this->load->view('header',$pro_data);
        		$this->load->view('claim',$data);
        		$this->load->view('footer',$pro_data);
    	    }
    	    else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user")
    	    {
    	        //user_logged_in
    	        $data["users"] = $this->cm->fetch_user_by_session_id($this->session->has_userdata('session_id'));
    	        $check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
	        
    	        if($check_user_i->claim_add == "1")
    	        {
        	        $pro_data["project_info"] = $this->mm->fetch_project_info();
        	        $data["agents_pos"] = $this->clm->list_of_pos_and_agents();
        	        $data["customers"] = $this->clm->fetch_all_customers();
            		$this->load->view('header',$pro_data);
            		$this->load->view('claim',$data);
            		$this->load->view('footer',$pro_data);
    	        }
    	        else
    	        {
    	             echo "<script>alert('Permission Denied');window.location.href='home';</script>";
        	          //redirect("home");
    	        }
    	    }
    	    else
    	    {   
    	    	redirect("login");
    	    }
     }
 
 
     public function fetch_policy_no()
     {
          if($this->session->has_userdata('logged_in'))
          {
              $lead_id = $this->input->post("lead_id");
              $res = $this->clm->fetch_policy_no($lead_id);
              echo json_encode($res);
          }
     }
     
     public function fetch_client_details_by_policy_no()
     {
         if($this->session->has_userdata('logged_in'))
          {
              $policy_no = $this->input->post("policy_no");
              
              $data =[];
              
              $res = $this->clm->fetch_client_details_by_policy_no($policy_no);
              
               if($res != "")
    	        {
    	            $policy_type = $res->policy_type;
    	            $lead_id = $res->lead_id;
    	            
    	            if($policy_type == "1")
    	            {
    	                  $data = $this->lm->get_car_details($lead_id);  
    	            }
    	            else if($policy_type == "2")
    	            {
    	                  $data = $this->lm->get_bike_details($lead_id); 
    	            }
    	            else if($policy_type == "3")
    	            {
    	                  $data = $this->lm->get_car_details($lead_id);  
    	            }
    	            else if($policy_type == "4")
    	            {
    	                  $data = $this->lm->get_bike_details($lead_id); 
    	            }
    	        }
    	        echo json_encode(array("basic_details"=>$res,"vechi_details"=>$data));
              
          }
     }
     
     
     public function fetch_client_details_by_regn_no()
     {
         if($this->session->has_userdata('logged_in'))
          {
              $v_regn_no_1 = $this->input->post("v_regn_no_1");
              $v_regn_no_2 = $this->input->post("v_regn_no_2");
              $v_regn_no_3 = $this->input->post("v_regn_no_3");
              $v_regn_no_4 = $this->input->post("v_regn_no_4");
              
              $v_regn_number= $v_regn_no_1.'-'.$v_regn_no_2.'-'.$v_regn_no_3.'-'.$v_regn_no_4;
              
               $res = $this->clm->fetch_client_details_by_regn_no($v_regn_number);
               
                 if($res != "")
    	        {
    	            $policy_type = $res->policy_type;
    	            $lead_id = $res->lead_id;
    	            
    	            if($policy_type == "1")
    	            {
    	                  $data = $this->lm->get_car_details($lead_id);  
    	            }
    	            else if($policy_type == "2")
    	            {
    	                  $data = $this->lm->get_bike_details($lead_id); 
    	            }
    	            else if($policy_type == "3")
    	            {
    	                  $data = $this->lm->get_car_details($lead_id);  
    	            }
    	            else if($policy_type == "4")
    	            {
    	                  $data = $this->lm->get_bike_details($lead_id); 
    	            }
    	        }
    	        echo json_encode(array("basic_details"=>$res,"vechi_details"=>$data));
               
               
          }
         
     }
     
     public function add_claim_details()
     {
         if($this->session->has_userdata('logged_in'))
          {
            $lead_id = $this->input->post("lead_id");
            $client_id = $this->input->post("client_id");
            $client_name = $this->input->post("client_name");
            $policy_no = $this->input->post("policy_no");
            $re_date = $this->input->post("re_date");
            $estimated_loss = $this->input->post("estimated_loss");
            $date_of_loss = $this->input->post("date_of_loss");
            $agency_pos = $this->input->post("agency_pos");
            $claim_report = $this->input->post("claim_report");
            $fir_copy =$this->input->post("fir_copy");
            $surveyor_report = $this->input->post("surveyor_report");
            $reference_no = $this->input->post("reference_no");
            $ai_id = $this->input->post("select_areaincharge");
            $user_id = $this->input->post("assign_to_user");
            $v_regn_no = $this->input->post("v_regn_no");
            $aadher_number = $this->input->post("aadher_number");
            $gst_number = $this->input->post("gst_number");
            $mobile_no = $this->input->post("mobile_no");
            $address = $this->input->post("add_address");
            $make_model = $this->input->post("make_model");
            $claim_id = $this->input->post("claim_id");
            $remarks = $this->input->post("remarks");
           
             if(isset($_FILES))
        		{
        			$config['upload_path'] = './datas/documents/';
        			$config['allowed_types'] = '*';
        			
        			$this->load->library('upload',$config);
        			$this->upload->initialize($config);
        			if(!$this->upload->do_upload('rc_book'))
        			{
        				$rc_book = '';
        			}
        			else
        			{
        				$rc_book = $this->upload->data('file_name');
        			}
        		}
             if(isset($_FILES))
        		{
        			$config['upload_path'] = './datas/documents/';
        			$config['allowed_types'] = '*';
        			
        			$this->load->library('upload',$config);
        			$this->upload->initialize($config);
        			if(!$this->upload->do_upload('driving_license'))
        			{
        				$driving_licence = '';
        			}
        			else
        			{
        				$driving_licence = $this->upload->data('file_name');
        			}
        		}
             if(isset($_FILES))
        		{
        			$config['upload_path'] = './datas/spot_videos/';
        			$config['allowed_types'] = '*';
        			
        			$this->load->library('upload',$config);
        			$this->upload->initialize($config);
        			if(!$this->upload->do_upload('spot_video'))
        			{
        				$spot_videos = "";
        			}
        			else
        			{
        				$spot_videos = $this->upload->data('file_name');
        			}
        		}
            $datas = array(
                         "client_id" => $client_id,
                         "lead_id" =>$lead_id,
                         "ai_id" =>$ai_id,
                         "user_id" =>$user_id,
                         "client_name" => $client_name,
                         "claim_ref_no"=>$reference_no,
                         "policy_no" => $policy_no,
                         "address" =>$address,
                         "phone_number" =>$mobile_no,
                         "make_model" =>$make_model,
                         "claim_receipt_date" => $re_date,
                         "estimated_loss" =>$estimated_loss,
                         "date_of_loss" => $date_of_loss,
                         "vechi_register_no" => $v_regn_no,
                         "aadher_number"=>$aadher_number,
                         "gst_number"=>$gst_number,
                         "rc_book_file" =>$rc_book,
                         "driving_license" => $driving_licence,
                         "spot_video" => $spot_videos,
                         "agent_pos" => $agency_pos,
                         "remarks" =>$remarks,
                         "claim_report" =>$claim_report,
                         "fir_copy" => $fir_copy,
                         "surveyor_report" =>$surveyor_report,
                         "created_by" => $this->session->userdata('session_id'),
                         "created_at" => date("Y-m-d H:i:s"),
                         );
                         
            if( isset( $claim_id ) && !empty( $claim_id ) ) {
                $qry = $this->clm->update_claim_details($datas, $claim_id);
            } 
            else 
            {
                $qry = $this->clm->add_claim_details($datas);   
            }
             
             if(isset($_FILES['files']))
             {
                 
             
             
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
                      
                      if($this->upload->do_upload('file')){
                          
                       $data = $this->upload->data(); 
                       $data = array("client_id"=>$client_id,"lead_id"=>$lead_id,"policy_no"=>$policy_no,"file_path"=>$data['file_name']);
                       $res = $this->clm->insert_spot_photos($data);
                      }
                    }
               
                  }
             }
                
          }
     }
     
     public function fetch_claims()
     {
          if($this->session->has_userdata('logged_in'))
          {
                 
            $draw = intval($this->input->post("draw"));
            $status = $this->input->post("status"); 
            
			$res = $this->clm->fetch_claims($status);
			
        		$arr = [];
                $a = 0 ;
                
                foreach($res as $da)
                {
                	$a++;
        
                     $action = "
                <button id='cliam_plus' class='btn btn-danger btn-xs' onclick='claim_data({$da->client_id})'><i class='fa fa-plus'></i></button>
                <button id='cliam_com' class='btn btn-info btn-xs' onclick='complete_data({$da->id})'><i class='fa fa-exchange'></i> Completed</button>
                <button id='cliam_info' class='btn btn-success btn-xs' onclick='policy_info_data({$da->id}, \"{$da->lead_id}\")'><i class='fa fa-file-pdf-o'></i> Policy Info</button>
                <a id='cliam_edit' class='btn btn-warning btn-xs' href='claim?id={$da->id}'><i class='fa fa-exchange'></i> Edit</a>";
                    		 
                    $client_name = "<a href='#' onclick=view_data(".$da->client_id.",'".$da->lead_id."')>".$da->client_name."</a>";		 
                    		 
                    
                    $arr[] = array(
                        $a,
                        $client_name,
                        $da->policy_no,
                        $da->claim_ref_no,
                        date_format(date_create($da->claim_receipt_date),"d-m-Y"),
                        $da->estimated_loss,
                        date_format(date_create($da->date_of_loss),"d-m-Y"),
                        "Y",
                        $da->user_name,
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
     
     public function add_claim_report()
     {
          if($this->session->has_userdata('logged_in'))
          {
            $contact_person = $this->input->post("contact_person");
            $contact_details = $this->input->post("contact_details");
            $mobile_no = $this->input->post("mobile_no");
            $remarks = $this->input->post("remarks");
            $date = $this->input->post("date");
            $id = $this->input->post("id");
            
             $data_2= array(
                             "client_id"=>$id,
                             "remarks" => $remarks,
                             "contact_person" =>$contact_person,
                             "contact_details" =>$contact_details,
                             "mobile_no" => $mobile_no,
                                 );
                                 
              $data_1 = $this->clm->add_claim_report($data_2);
            
          }   
     }
     
     
     public function claim_view()
      {
          if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        	{    		
    		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
        		$this->load->view('header',$pro_data);
        		$this->load->view('claim_view');
        		$this->load->view('footer',$pro_data);
    	    }
    	    else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user")
    	    {
    	        $data["users"] = $this->cm->fetch_user_by_session_id($this->session->has_userdata('session_id'));
    	        $check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
	        
    	        if($check_user_i->claim_view == "1")
    	        {
        	        $pro_data["project_info"] = $this->mm->fetch_project_info();
            		$this->load->view('header',$pro_data);
            		$this->load->view('claim_view');
            		$this->load->view('footer',$pro_data);
    	        }
    	        else
    	        {
    	             echo "<script>alert('Permission Denied');window.location.href='home';</script>";
        	          //redirect("home");
    	        }
    	    }
    	    else
    	    {
    	    	redirect("login");
    	    }
     }
     
     
     
       public function claim_follow_up()
      {
          if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        	{    		
    		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
        		$this->load->view('header',$pro_data);
        		$this->load->view('claim_follow_up');
        		$this->load->view('footer',$pro_data);
    	    }
    	    else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user")
    	    {
    	        $data["users"] = $this->cm->fetch_user_by_session_id($this->session->has_userdata('session_id'));
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
        		$this->load->view('header',$pro_data);
        		$this->load->view('claim_follow_up');
        		$this->load->view('footer',$pro_data);
    	    }
    	    else
    	    {
    	    	redirect("login");
    	    }
     }
     
     
      public function fetch_claim_dateils()
     {
          if($this->session->has_userdata('logged_in'))
          {
              
            $draw = intval($this->input->post("draw"));
			$res = $this->clm->fetch_claim_dateils();
			
        		$arr = [];
                $a = 0 ;
                
                foreach($res as $da)
                {
                	$a++;
                    
                    
                    
                    $arr[] = array(
                        $a,
                        $da->sname,
                        $da->contact_person,
                        $da->contact_details,
                        $da->mobile_no,
                        $da->remarks,
                        date_format(date_create($da->date),"d-m-Y"),
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
     
     
     
     public function fetch_claim_contact_details()
        {
      	if($this->session->has_userdata('logged_in')) 
      	
      	 $client_id =$this->input->post("id");
      	 $lead_id =$this->input->post("lead_id");
      	 

      	  $content = "<table class='table table-bordered'>
    	                 
                 <tr>
                       <th>Name</th>
                       <th>Mobile No</th>
                       <th>Address</th>
                 <tr>";
                 
           $res1 = $this->clm->fetch_claims_details($client_id);
        
            $content .= "<tr>
                  <td>".$res1->sname."</td>
                  <td>".$res1->cmobile."</td>
                  <td>".$res1->naddress."</td>
             </tr>";
             
            $content .="</table>";
      	 
          
            
      	 $content .= "<table class='table table-bordered'>
    	                 
                 <tr>
                       <th>S.no</th>
                       <th>Date</th>
                       <th>Contact Person</th>
                       <th>Contact Designation</th>
                       <th>Mobile No</th>
                       <th>Remarks</th>
                 <tr>";
    
    	       $a = 0;
    	       
    	       	$res = $this->clm->fetch_claim_dateils($client_id);
    	        
    	       
    	        foreach($res as $da)
                {
                     $a++;
                    $content .= "<tr>
                                      <td>".$a."</td>
                                      <td>".date_format(date_create($da->date),"d-m-Y")."</td>
                                      <td>".$da->contact_person."</td>
                                      <td>".$da->contact_details."</td>
                                      <td>".$da->mobile_no."</td>
                                      <td>".$da->remarks."</td>
                                 </tr>";
                }
                
                
                $content .="</table>";
                
                
                
          $content .= "<div class='row'><h4>&nbsp;Files</h4>";
          
          $a = 0;
          
          $res1 = $this->clm->fetch_claim_documents($lead_id);
          
          foreach($res1 as $da1)
                {
                   $a++;
                $content .= "<div class='col-md-3'>
                        <a href='./datas/documents/".$da1->document."' target='_blank'><i class='fa fa-file fa-3x'></i></a>
                          <span>".$da1->document_type."</span>
                 </div>";
                 
                }
                 
                 

            
            echo $content;
    	}
    	
    	
    	
    	
    public function advanced_search()
      {
          if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        	{    		
    		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
        		$this->load->view('header',$pro_data);
        		$this->load->view('advanced_search');
        		$this->load->view('footer',$pro_data);
    	    }
    	    else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user")
    	    {
    	        $data["users"] = $this->cm->fetch_user_by_session_id($this->session->has_userdata('session_id'));
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
        		$this->load->view('header',$pro_data);
        		$this->load->view('advanced_search');
        		$this->load->view('footer',$pro_data);
    	    }
    	    else
    	    {
    	    	redirect("login");
    	    }
     }
     
     
     public function search_report()
     {
         
         $search = $this->input->post("search_type");
         $client_name = $this->input->post("search_client_name");
         $policy_no = $this->input->post("search_policy");
         $vechicle_no = $this->input->post("search_vehicle");
         $agent_name = $this->input->post("search_agent_name");
         $agent_code = $this->input->post("search_agent_id");
         $agent_mobile =$this->input->post("search_agent_number");
         $ai_name = $this->input->post("search_incharge");
         $ai_mobile_no =$this->input->post("search_incharge_number");
         $ai_email = $this->input->post("search_incharge_email");
         
    
         
         $content = "";
         
         if($search == "search_by_client")
         {
            $res = $this->clm->fetch_client_details_search($client_name,$policy_no,$vechicle_no);
            
          
            foreach($res as $da)
            {
                    $res1 = $this->lm->get_policy_documents($da->lead_id);
                    

                    $content .='<div class="row">';
                    $content .='<div class="col-md-6">';
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Client Name</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$da->client_name.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Mobile No</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$da->mobile_no.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    $content .='<div class="col-md-6">';
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Address</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$da->address.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Area</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$da->area.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                     
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Vechicle no</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$da->vechi_register_no.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>RTO</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$da->rto.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Insurer</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$da->company_name.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                   foreach($res1 as $das)
                   {
                        $content .='<div class="form-group">';
                        $content .='<div class="row">';
                        $content .='<div class="col-md-4">';
                        $content .='<label>Policy Document</label>';
                        $content .='</div>';
                        $content .='<div class="col-md-8">';
                        $content .="<a href='./datas/documents/".$das->document."' target='_blank'><i class='fa fa-file-pdf-o' style='font-size:48px;color:red'></i>Policy Document</a>";
                        $content .='</div>';
                        $content .='</div>';
                        $content .='</div>';
                        $content .='</div>';
                        $content .='</div>';
                   }
            }
         }
         else if($search == "search_by_agent")
         {
             $res1 = $this->clm->fetch_agent_details($agent_name,$agent_code,$agent_mobile);
             
            foreach($res1 as $daa)
            {
    
                    $content .='<div class="row">';
                    $content .='<div class="col-md-6">';
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Agnet Name</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$daa->name.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Agent Code</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$daa->agent_pos_code.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    $content .='<div class="col-md-6">';
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Phone Number</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$daa->phoneno.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Address</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$daa->address.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                     
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label> Bank Account number</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$daa->bank_acc_no.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Bank Name</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$daa->bank_name.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label> IFSC</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$daa->ifsc_code.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label> branch</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$daa->branch.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label> Pan Card No</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$daa->pan_card_no.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Adhar Card NO</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$daa->adhar_card_no.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
               
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Agent Document</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .="<a href='./datas/agent_pos_documents/".$daa->adhar_file."' target='_blank'><i class='fa fa-file-pdf-o' style='font-size:48px;color:red'></i> Adhar </a>";
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
            }
             
             
         }
         else if($search == "search_by_areaincharge")
         {
             $res2 = $this->clm->fetch_ai_details($ai_name,$ai_mobile_no,$ai_email);
             
             
             
              foreach($res2 as $da1)
            {
    
                    $content .='<div class="row">';
                    $content .='<div class="col-md-6">';
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label> Area Incharge Name</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$da1->username.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>EMAIL ID</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$da1->email_id.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    $content .='<div class="col-md-6">';
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Phone Number</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$da1->phoneno.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Address</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$da1->address.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
            
            }
         }
         
         
         echo $content;
         
         
         
     }
     
     
     
    public function add_complete_claim()
    {
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
            $status = "1";
    		$data = array("status" => $status);
    		$res = $this->clm->add_complete_claim($id,$data);

    		echo "Success";
    	}
    }
    
     public function fetch_complete_claim()
     {
          if($this->session->has_userdata('logged_in'))
          {
              
            $draw = intval($this->input->post("draw"));
            $status = $this->input->post("status");  
            

			$res = $this->clm->fetch_complete_claim($status);
			
        		$arr = [];
                $a = 0 ;
                
                foreach($res as $da)
                {
                	$a++;
        
                    		 
                    $client_name = "<a href='#' onclick=view_data(".$da->client_id.", '')>".$da->client_name."</a>";		 
                if($da->status == "1")   
                {
                    $completed = "completed";
                }
                else
                {
                    $completed = "processing";
                }
                    
                    $arr[] = array(
                        $a,
                        $client_name,
                        $da->policy_no,
                        $da->claim_ref_no,
                        date_format(date_create($da->claim_receipt_date),"d-m-Y"),
                        $da->estimated_loss,
                        date_format(date_create($da->date_of_loss),"d-m-Y"),
                        $da->user_name,
                        $completed
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
     
     
      public function upload_claim_document_files()
      {
          if($this->session->has_userdata('logged_in'))
        	    {
            	   $id = $this->input->post("id");
            	   $document_type = $this->input->post("document_type");
            	   
            	    if(isset($_FILES))
            		{
            			$config['upload_path'] = './datas/documents/';
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
            				$file_path = base_url().'datas/documents/'.$this->upload->data('file_name');
            				$file = $this->upload->data('file_name');
            			}
            		}
            		
            		$data = array("lead_id" =>$id,"document_type"=>$document_type,"document" =>$file);
            		
            		$res = $this->clm->upload_claim_document_files($data);
            		
            		$html = "";
            		$html .="<tr>
            		           <td><a href='./datas/documents/".$res->document."'><i class='fa fa-file'></i></a></td>
            		           <td>".$res->document."</td>
            		           <td>".$res->document_type."</td>
            		           <td><i class='fa fa-edit' onclick=edit_data(".$res->id.")></i></td>
            		           <td><i class='fa fa-trash' onclick=delete_data(".$res->id.")></i></td>
            		         </tr>";
            		 echo $html;
        	    }	 
        	    
      }
      
      public function fetch_policy_info_details()
      {
        if($this->session->has_userdata('logged_in'))
    	    {
                    $client_id =$this->input->post("id");
                    $lead_id =$this->input->post("lead_id");
                    

            
           $content = "";    
                
                
                $res1 = $this->clm->fetch_policy_info($lead_id);
                
          
                    $content .='<div class="row">';
                    $content .='<div class="col-md-6">';
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Client Name</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$res1->client_name.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Mobile No</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$res1->mobile_no.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    $content .='<div class="col-md-6">';
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Address</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$res1->address.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Area</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$res1->area.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    
                    
                    $content .='<div class="row">';
                    $content .='<div class="col-md-6">';
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Policy Start</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$res1->policy_s_date.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Policy End</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$res1->policy_ex_date.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                     
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Vechicle no</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$res1->vechi_register_no.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>RTO</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$res1->rto.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
                    $content .='<div class="form-group">';
                    $content .='<div class="row">';
                    $content .='<div class="col-md-4">';
                    $content .='<label>Insurer</label>';
                    $content .='</div>';
                    $content .='<div class="col-md-8">';
                    $content .='<p>'.$res1->company_name.'</p>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    $content .='</div>';
                    
        

           		$res1 = $this->clm->fetch_policy_details_info($lead_id);

			$doc = $res1?->document ?? ''; // PHP 8+ safe; use isset() version if needed

			$content .='<div class="form-group">';
			$content .='<div class="row">';
			$content .='<div class="col-md-4">';
			$content .='<label>Policy Document</label>';
			$content .='</div>';
			$content .='<div class="col-md-8">';
			if (!empty($doc)) {
				$content .="<a href='./datas/documents/{$doc}' target='_blank'>
					<i class='fa fa-file-pdf-o' style='font-size:48px;color:red'></i>Policy Document</a>";
			} else {
				$content .="<p style='color:red'>No policy document uploaded.</p>";
			}
			$content .='</div>';
			$content .='</div>';
			$content .='</div>';
			$content .='</div>';
			$content .='</div>';

             

                   echo $content;
        	        
            }
          
      }
      
      
    
  
              
}