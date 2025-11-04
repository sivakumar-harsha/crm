<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Upload $upload
 * @property CI_Session $session
 * @property Audit $audit
 * @property CI_Email $email
 */

class ConfigCtrl extends CI_Controller {
    public $cm;
    public $am;
    public $lm;
    public $mm;
    public $pm;
    public $rolepermissionModel ;
    public $audit;
    public $audit_model;
    public $auth;
    public $cookie;
    public $url;
    public $db;
    public $database;
    public $session;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('Configmod','cm');
		$this->load->model('MasterMod','mm');
		$this->load->model("AccountsMod","am");
		$this->load->model('LeadMod','lm');
		$this->load->model('PayoutMod','pm');
		$this->load->library('session');
		$this->load->library('audit');
		$this->load->helper('url');
		$this->load->helper('cookie');
	}
	
	public function reigion()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["district"] = $this->cm->fetch_district();
    		$this->load->view('header',$pro_data);
    		$this->load->view('reigion',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
	        $data["district"] = $this->cm->fetch_district();
    		$this->load->view('header',$pro_data);
    		$this->load->view('reigion',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}
	
	public function add_reigion()
	{
	    if($this->session->has_userdata('logged_in'))
	    {
	        $reigion = $this->input->post("reigion");
	        $district = $this->input->post("district");
	        $data = array('reigion'=>$reigion,"district_id" =>$district);
	        $res = $this->cm->add_reigion($data);
	        if( $res ) {
	            $this->audit->log('list_of_reigion', 'INSERT', null, null, $data);
	        }
	        echo "success";
	    }
	}
	
	public function fetch_reigion()
	{
	    $draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->cm->fetch_reigion();
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<button class='btn btn-info btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i></button>";
            
            $arr[] = array(
                $a,
                $da->district,
                $da->reigion,
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
	
	public function fetch_edit_data()
	{
	    $id = $this->input->post("id");
	    $res = $this->cm->fetch_edit_data($id);
	    echo json_encode($res);
	}
	
	public function edit_reigion()
	{
	    $id = $this->input->post("id");
	    $reigion = $this->input->post("reigion");
	      $district = $this->input->post("district");
	    $data = array('reigion'=>$reigion,"district_id" =>$district); 
	    
	    $old_data = $this->cm->fetch_edit_data($id);
	    $res = $this->cm->edit_reigion($data,$id);
	    
	    if( $res ) {
	        echo '<script>alert(1)</script>';
            $this->audit->log('list_of_reigion', 'UPDATE', null, $old_data, $data);
        }
	}
	
	// scooter
	
	public function scooter_brand()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('scooter_brand');
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	    	$pro_data["project_info"] = $this->mm->fetch_project_info();
	    	 $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
        		$this->load->view('header',$pro_data);
        		$this->load->view('scooter_brand');
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

	public function fetch_scooter_brand()
	{
		$draw = intval($this->input->post("draw"));
		$res = array();
		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->cm->fetch_scooter_brand();
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
                $da->brand_name,
                "<Img src='".$da->icon."' width='100' height='100'>",
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

	public function add_scooter_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$name = $this->input->post("name");
            if(isset($_FILES))
            {
                $config['upload_path'] = './datas/images/brand_icons/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('icon'))
                {
                    $file = '';
                    $file_path = "";
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error);
                }
                else
                {
                    $file_path = base_url().'datas/images/brand_icons/'.$this->upload->data('file_name');
                    $file = $this->upload->data('file_name');
                }
            }
    		$data = array("brand_name" => $name,
    		            "icon" => $file_path,
    		            "icon_name" => $file,
    		            "created_by" => $this->session->userdata("session_id"),
    		            "created_at" => date("Y-m-d H:i:s"));
    		            
    		            
    		$res = $this->cm->add_scooter_brand($data);
            if( $res ) {
                 $this->audit->log('list_of_scooter_brand', 'INSERT', null, null, $data);
            }
    		echo "Success";
    	}
	}

	public function fetch_edit_scooter_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->cm->fetch_edit_scooter_brand($id);
			echo json_encode($res);
		}
	}

	public function edit_scooter_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$name = $this->input->post("name");
    		$id = $this->input->post("id");
    		 if(isset($_FILES))
            {
                $config['upload_path'] = './datas/images/brand_icons/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('icon'))
                {
                    $file = '';
                    $file_path = "";
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error);
                }
                else
                {
                    $file_path = base_url().'datas/images/brand_icons/'.$this->upload->data('file_name');
                    $file = $this->upload->data('file_name');
                }
            }
            if($file_path != "")
            {
                    $old_file_name = $this->cm->fetch_edit_scooter_brand($id)->icon_name;
                    unlink("./datas/images/brand_icons/".$old_file_name);
                	$data = array("brand_name" => $name,
    		            "icon" => $file_path,
    		            "icon_name" => $file,
    		            "updated_by" => $this->session->userdata("session_id"),
    		            "updated_at" => date("Y-m-d H:i:s"));
    		            
    		        $old_data = $this->cm->fetch_edit_scooter_brand($id);
    		        $res = $this->cm->edit_scooter_brand($id, $data);
    		        if( $res ) {
                        $this->audit->log('list_of_scooter_brand', 'UPDATE', null, $old_data, $data);
                    }
            }
            else
            {
                	$data = array("brand_name" => $name,
    		            "updated_by" => $this->session->userdata("session_id"),
    		            "updated_at" => date("Y-m-d H:i:s"));
    		            
    		        $old_data = $this->cm->fetch_edit_scooter_brand($id);
    		        $res = $this->cm->edit_scooter_brand($id, $data);
    		        if( $res ) {
                        $this->audit->log('list_of_scooter_brand', 'UPDATE', null, $old_data, $data);
                    }
            }
    	

    		echo "Success";
    	}
	}
	
	// model 
	
	//Scooter Model
  	
  	public function scooter_model()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->cm->fetch_brand();
    		$this->load->view('header',$pro_data);
    		$this->load->view('scooter_model',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        
	     $pro_data["project_info"] = $this->mm->fetch_project_info();
	     $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	     
	        if($check_user_i->masters_view == "1")
	        {
		   	$data["brand"] = $this->cm->fetch_brand();
    		$this->load->view('header',$pro_data);
    		$this->load->view('scooter_model',$data);
    		$this->load->view('footer',$pro_data);
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
	    }
	}

	public function fetch_scooter_model()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->cm->fetch_scooter_model();
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;
        
            $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
            
            $action = "";
	     
	        if($check_user_i->masters_edit == "1")
	        {

            $action .= "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Edit</button>"; 
	        }
            		 //<button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> Delete</button>";
            
            $arr[] = array(
                $a,
                $da->brand_name,
                $da->model_name,
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
        //echo count($res);
	}

	public function add_scooter_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	     
    	   if($check_user_i->masters_add == "1")
	        {
            		$name = $this->input->post("name");
            		$name1 = $this->input->post("name1");
                    $brand = $this->input->post("brand");
            		$data = array("model_name" => $name,
            		              "brand_id" => $brand,
            		              "created_by" => $this->session->userdata("session_id"),
            		            "created_at" => date("Y-m-d H:i:s"));
            		$res = $this->cm->add_scooter_model($data);
            		if( $res ){
            		    $this->audit->log('list_of_scooter_model', 'INSERT', null, null, $data);
            		}
                    foreach($name1 as $n)
                    {
                        $data = array("model_name" => $n,
            		              "brand_id" => $brand,
            		              "created_by" => $this->session->userdata("session_id"),
            		            "created_at" => date("Y-m-d H:i:s"));
                		$res = $this->cm->add_scooter_model($data);
                		if( $res ){
                		    $this->audit->log('list_of_scooter_model', 'INSERT', null, null, $data);
                		}
                    }
            		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='scooter_model';</script>";
	        }
    	}
	}

	public function fetch_edit_scooter_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->cm->fetch_edit_scooter_model($id);
			echo json_encode($res);
		}
	}

	public function edit_scooter_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	     
    	   if($check_user_i->masters_edit == "1")
	        {
        		$name = $this->input->post("name");
        		$brand = $this->input->post("brand");
        		$id = $this->input->post("id");
    
        		$data = array("model_name" => $name,
        		                "brand_id" => $brand,
        		                "updated_by" => $this->session->userdata("session_id"),
        		                "updated_at" => date("Y-m-d H:i:s"));
        		                
        		$old_data = $this->cm->fetch_edit_scooter_model($id);
        		$res = $this->cm->edit_scooter_model($id, $data);
        		if( $res ) {
        		    $this->audit->log('list_of_scooter_model', 'UPDATE', null, $old_data, $data);
        		}
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='scooter_model';</script>";
	        }
    	}
	}

	public function delete_scooter_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	   if($check_user_i->masters_delete == "1")
	        {
    			$id = $this->input->post("id");
    			$old_data = $this->cm->fetch_edit_scooter_model($id);
    			$res = $this->mm->delete_scooter_model($id);
    			if( $res ) {
        		    $this->audit->log('list_of_scooter_model', 'DELETE', null, $old_data, null);
        		}
	        }
    	}
    	else
    	{
    	    echo "<script>alert('Permission Denied');window.location.href='home';</script>";
    	}
	}
	
	public function get_brand_logo()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
	    $brand = $this->input->post("brand");
	    echo $this->cm->fetch_edit_scooter_brand($brand)->icon;
    	}
	}
	
    public function get_scooter_brand_logo()
	{
	    $brand = $this->input->post("brand");
	    echo $this->cm->fetch_edit_scooter_brand($brand)->icon;
	}
	
	
	// varient
	
    public function scooter_varient()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->cm->fetch_brand();
    		$this->load->view('header',$pro_data);
    		$this->load->view('scooter_varient',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->cm->fetch_brand();
    		$this->load->view('header',$pro_data);
    		$this->load->view('scooter_varient',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}

	public function fetch_scooter_varient()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->cm->fetch_scooter_varient();
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
            		 //<button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> Delete</button>";
	        }
            
            $arr[] = array(
                $a,
                $da->brand_name,
                $da->model_name,
                $da->varient_name,
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

	public function add_scooter_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	  if($check_user_i->masters_add == "1")
	        {
        		$name = $this->input->post("name");
        		$name1 = $this->input->post("name1");
                $brand = $this->input->post("brand");
                $model = $this->input->post("model");
        		$data = array("varient_name" => $name,
        		              "brand_id" => $brand,
        		              "model_id" => $model,
        		              "created_by" => $this->session->userdata("session_id"),
        		            "created_at" => date("Y-m-d H:i:s"));
        		            
        		$res = $this->cm->add_scooter_varient($data);
        		if( $res ){
        		    $this->audit->log('list_of_scooter_varient', 'INSERT', null, null, $data);
        		}
        		if(isset($name1) && !empty($name1)){
                    foreach($name1 as $n)
                    {
                        $data = array("varient_name" => $n,
            		              "brand_id" => $brand,
            		              "model_id" => $model,
            		              "created_by" => $this->session->userdata("session_id"),
            		            "created_at" => date("Y-m-d H:i:s"));
                		$res = $this->cm->add_scooter_varient($data);
                		if( $res ){
                		    $this->audit->log('list_of_scooter_varient', 'INSERT', null, null, $data);
                		}
                    }        		    
        		}
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
	}

	public function fetch_edit_scooter_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->cm->fetch_edit_scooter_varient($id);
			$model_option = $this->get_scooter_model_list_option($res->brand_id);
			$icon = $this->cm->fetch_edit_scooter_brand($res->brand_id)->icon;
			$data = array("res" =>$res, "model_option" => $model_option, "icon" => $icon);
			echo json_encode($data);
		}
	}

	public function edit_scooter_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	$check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	
    	  if($check_user_i->masters_edit == "1")
	        {
        		$name = $this->input->post("name");
        		$brand = $this->input->post("brand");
        		$model = $this->input->post("model");
        		$id = $this->input->post("id");
    
        		$data = array("varient_name" => $name,
        		                "brand_id" => $brand,
        		                "model_id" => $model,
        		                "updated_by" => $this->session->userdata("session_id"),
        		                "updated_at" => date("Y-m-d H:i:s"));
        		                
        		$old_data = $this->cm->fetch_edit_scooter_varient($id);
        		$res = $this->cm->edit_scooter_varient($id, $data);
                if( $res ){
        		    $this->audit->log('list_of_scooter_varient', 'UPDATE', null, $old_data, $data);
        		}
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='scooter_varient';</script>";
	        }
    	}
	}

	public function delete_scooter_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	  if($check_user_i->masters_delete == "1")
	        {
			$id = $this->input->post("id");
			$old_data = $this->cm->fetch_edit_scooter_varient($id);
			$this->mm->delete_model($id);
			$this->audit->log('list_of_scooter_varient', 'DELETE', null, $old_data, null);
	        }
	        else
	        {
	             echo "<script>alert('Permission Denied');window.location.href='scooter_varient';</script>";
	        }
    	}
	}
	public function get_scooter_model_list()
	{
	    $brand = $this->input->post("brand");
	    $res = $this->cm->get_scooter_model_list($brand);
	    $data = "<option value=''>Select Model</option>";
	    foreach($res as $r)
	    {
	        $data.= "<option value='".$r->id."'>".$r->model_name."</option>";
	    }
	    echo $data;
	}
	public function get_scooter_model_list_option($brand)
	{
	    $res = $this->cm->get_scooter_model_list($brand);
	    $data = "<option value=''>Select Model</option>";
	    foreach($res as $r)
	    {
	        $data.= "<option value = '".$r->id."'>".$r->model_name."</option>";
	    }
	    return $data;
	}
	
	// Electric two wheeler
	
	public function electric_two_wheeler_brand()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('electric_two_wheeler_brand');
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	    	$pro_data["project_info"] = $this->mm->fetch_project_info();
	    	 $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
        		$this->load->view('header',$pro_data);
        		$this->load->view('electric_two_wheeler_brand');
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

	public function fetch_electric_two_wheeler_brand()
	{
		$draw = intval($this->input->post("draw"));
		$res = array();
		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->cm->fetch_electric_two_wheeler_brand();
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
                $da->brand_name,
                "<Img src='".$da->icon."' width='100' height='100'>",
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

	public function add_electric_two_wheeler_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$name = $this->input->post("name");
            if(isset($_FILES))
            {
                $config['upload_path'] = './datas/images/brand_icons/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('icon'))
                {
                    $file = '';
                    $file_path = "";
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error);
                }
                else
                {
                    $file_path = base_url().'datas/images/brand_icons/'.$this->upload->data('file_name');
                    $file = $this->upload->data('file_name');
                }
            }
    		$data = array("brand_name" => $name,
    		            "icon" => $file_path,
    		            "icon_name" => $file,
    		            "created_by" => $this->session->userdata("session_id"),
    		            "created_at" => date("Y-m-d H:i:s"));
    		            
    		$res = $this->cm->add_electric_two_wheeler_brand($data);
            if( $res ){
                $this->audit->log('list_of_e_two_wheeler_brand', 'INSERT', null, null, $data);
            }
            
    		echo "Success";
    	}
	}

	public function fetch_edit_electric_two_wheeler_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->cm->fetch_edit_electric_two_wheeler_brand($id);
			echo json_encode($res);
		}
	}

	public function edit_electric_two_wheeler_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$name = $this->input->post("name");
    		$id = $this->input->post("id");
    		 if(isset($_FILES))
            {
                $config['upload_path'] = './datas/images/brand_icons/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('icon'))
                {
                    $file = '';
                    $file_path = "";
                    $error = array('error' => $this->upload->display_errors());
                    var_dump($error);
                }
                else
                {
                    $file_path = base_url().'datas/images/brand_icons/'.$this->upload->data('file_name');
                    $file = $this->upload->data('file_name');
                }
            }
            if($file_path != "")
            {
                    $old_file_name = $this->cm->fetch_edit_electric_two_wheeler_brand($id)->icon_name;
                    unlink("./datas/images/brand_icons/".$old_file_name);
                	$data = array("brand_name" => $name,
    		            "icon" => $file_path,
    		            "icon_name" => $file,
    		            "updated_by" => $this->session->userdata("session_id"),
    		            "updated_at" => date("Y-m-d H:i:s"));
    		            
    		        $old_data = $this->cm->fetch_edit_electric_two_wheeler_brand($id);
    		        $res = $this->cm->edit_electric_two_wheeler_brand($id, $data);
    		        if( $res ){
                        $this->audit->log('list_of_e_two_wheeler_brand', 'UPDATE', null, $old_data, $data);
                    }
            }
            else
            {
                	$data = array("brand_name" => $name,
    		            "updated_by" => $this->session->userdata("session_id"),
    		            "updated_at" => date("Y-m-d H:i:s"));
    		            
    		        $old_data = $this->cm->fetch_edit_electric_two_wheeler_brand($id);
    		        $res = $this->cm->edit_electric_two_wheeler_brand($id, $data);
    		        if( $res ){
                        $this->audit->log('list_of_e_two_wheeler_brand', 'UPDATE', null, $old_data, $data);
                    }
            }
    	

    		echo "Success";
    	}
	}
	
	// model 
	
	//Scooter Model
  	
  	public function electric_two_wheeler_model()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->cm->fetch_e_two_wheeler_brand();
    		$this->load->view('header',$pro_data);
    		$this->load->view('electric_two_wheeler_model',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        
	     $pro_data["project_info"] = $this->mm->fetch_project_info();
	     $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	     
	        if($check_user_i->masters_view == "1")
	        {
		   	$data["brand"] = $this->cm->fetch_e_two_wheeler_brand();
    		$this->load->view('header',$pro_data);
    		$this->load->view('electric_two_wheeler_model',$data);
    		$this->load->view('footer',$pro_data);
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
	    }
	}

	public function fetch_electric_two_wheeler_model()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->cm->fetch_electric_two_wheeler_model();
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;
        
            $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
            
            $action = "";
	     
	        if($check_user_i->masters_edit == "1")
	        {

            $action .= "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Edit</button>"; 
	        }
            		 //<button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> Delete</button>";
            
            $arr[] = array(
                $a,
                $da->brand_name,
                $da->model_name,
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
        //echo count($res);
	}

	public function add_electric_two_wheeler_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	     
    	   if($check_user_i->masters_add == "1")
	        {
            		$name = $this->input->post("name");
            		$name1 = $this->input->post("name1");
                    $brand = $this->input->post("brand");
            		$data = array("model_name" => $name,
            		              "brand_id" => $brand,
            		              "created_by" => $this->session->userdata("session_id"),
            		            "created_at" => date("Y-m-d H:i:s"));
            		            
            		$res = $this->cm->add_electric_two_wheeler_model($data);
            		if( $res ) {
            		    $this->audit->log('list_of_e_two_wheeler_model', 'INSERT', null, null, $data);
            		}
                    foreach($name1 as $n)
                    {
                        $data = array("model_name" => $n,
            		              "brand_id" => $brand,
            		              "created_by" => $this->session->userdata("session_id"),
            		            "created_at" => date("Y-m-d H:i:s"));
            		            
            		    $res = $this->cm->add_electric_two_wheeler_model($data);
            		    if( $res ) {
            		        $this->audit->log('list_of_e_two_wheeler_model', 'INSERT', null, null, $data);
            		    }
                    }
            		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='electric_two_wheeler_model';</script>";
	        }
    	}
	}

	public function fetch_edit_electric_two_wheeler_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->cm->fetch_edit_electric_two_wheeler_model($id);
			echo json_encode($res);
		}
	}

	public function edit_electric_two_wheeler_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	     
    	   if($check_user_i->masters_edit == "1")
	        {
        		$name = $this->input->post("name");
        		$brand = $this->input->post("brand");
        		$id = $this->input->post("id");
    
        		$data = array(  "model_name" => $name,
        		                "brand_id" => $brand,
        		                "updated_by" => $this->session->userdata("session_id"),
        		                "updated_at" => date("Y-m-d H:i:s"));
                
                $old_data = $this->cm->fetch_edit_electric_two_wheeler_model($id);
                
        		$res = $this->cm->edit_electric_two_wheeler_model($id, $data);
        		if( $res ) {
    		        $this->audit->log('list_of_e_two_wheeler_model', 'UPDATE', null, $old_data, $data);
    		    }
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='electric_two_wheeler_model';</script>";
	        }
    	}
	}

	public function delete_electric_two_wheeler_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	   if($check_user_i->masters_delete == "1")
	        {
    			$id = $this->input->post("id");
    			$old_data = $this->cm->fetch_edit_electric_two_wheeler_model($id);
                
        		$res = $this->mm->delete_electric_two_wheeler_model($id);
        		if( $res ) {
    		        $this->audit->log('list_of_e_two_wheeler_model', 'DELETE', null, $old_data, null);
    		    }
    			
	        }
    	}
    	else
    	{
    	    echo "<script>alert('Permission Denied');window.location.href='home';</script>";
    	}
	}
	
	public function get_e_two_wheeler_brand_logo()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
	    $brand = $this->input->post("brand");
	    echo $this->cm->get_e_two_wheeler_brand_logo($brand)->icon;
    	}
	}
	
    public function get_electric_two_wheeler_brand_logo()
	{
	    $brand = $this->input->post("brand");
	    echo $this->cm->fetch_edit_electric_two_wheeler_brand($brand)->icon;
	}
	
	
	// varient
	
     public function electric_two_wheeler_varient()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->cm->fetch_e_two_wheeler_brand();
    		$this->load->view('header',$pro_data);
    		$this->load->view('electric_two_wheeler_varient',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->cm->fetch_e_two_wheeler_brand();
    		$this->load->view('header',$pro_data);
    		$this->load->view('electric_two_wheeler_varient',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}

	public function fetch_electric_two_wheeler_varient()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->cm->fetch_electric_two_wheeler_varient();
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
            		 //<button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> Delete</button>";
	        }
            
            $arr[] = array(
                $a,
                $da->brand_name,
                $da->model_name,
                $da->varient_name,
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

	public function add_electric_two_wheeler_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	  if($check_user_i->masters_add == "1")
	        {
        		$name = $this->input->post("name");
        		$name1 = $this->input->post("name1");
                $brand = $this->input->post("brand");
                $model = $this->input->post("model");
        		$data = array("varient_name" => $name,
        		              "brand_id" => $brand,
        		              "model_id" => $model,
        		              "created_by" => $this->session->userdata("session_id"),
        		            "created_at" => date("Y-m-d H:i:s"));
            		$res = $this->cm->add_electric_two_wheeler_varient($data);
            		if( $res ) {
            		    $this->audit->log('list_of_e_two_wheeler_varient', 'INSERT', null, null, $data);
            		}
                foreach($name1 as $n)
                {
                    $data = array("varient_name" => $n,
        		              "brand_id" => $brand,
        		              "model_id" => $model,
        		              "created_by" => $this->session->userdata("session_id"),
        		            "created_at" => date("Y-m-d H:i:s"));
            		$res = $this->cm->add_electric_two_wheeler_varient($data);
            		if( $res ) {
            		    $this->audit->log('list_of_e_two_wheeler_varient', 'INSERT', null, null, $data);
            		}
                }
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
	}

	public function fetch_edit_electric_two_wheeler_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->cm->fetch_edit_electric_two_wheeler_varient($id);
			$model_option = $this->get_electric_two_wheeler_model_list_option($res->brand_id);
			$icon = $this->cm->fetch_edit_electric_two_wheeler_brand($res->brand_id)->icon;
			$data = array("res" =>$res, "model_option" => $model_option, "icon" => $icon);
			echo json_encode($data);
		}
	}

	public function edit_electric_two_wheeler_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	$check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	
    	  if($check_user_i->masters_edit == "1")
	        {
        		$name = $this->input->post("name");
        		$brand = $this->input->post("brand");
        		$model = $this->input->post("model");
        		$id = $this->input->post("id");
    
        		$data = array("varient_name" => $name,
        		                "brand_id" => $brand,
        		                "model_id" => $model,
        		                "updated_by" => $this->session->userdata("session_id"),
        		                "updated_at" => date("Y-m-d H:i:s"));
        		                
        		$old_data = $this->cm->fetch_edit_electric_two_wheeler_varient($id);
        		$res = $this->cm->edit_electric_two_wheeler_varient($id, $data);
                if( $res ) {
        		    $this->audit->log('list_of_e_two_wheeler_varient', 'UPDATE', null, $old_data, $data);
        		}
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='electric_two_wheeler_varient';</script>";
	        }
    	}
	}

	public function delete_electric_two_wheeler_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	  if($check_user_i->masters_delete == "1")
	        {
    			$id = $this->input->post("id");
    			$old_data = $this->cm->fetch_edit_electric_two_wheeler_varient($id);
        		$res = $this->mm->delete_model($id);
                if( $res ) {
        		    $this->audit->log('list_of_e_two_wheeler_varient', 'DELETE', null, $old_data, null);
        		}
			
	        }
	        else
	        {
	             echo "<script>alert('Permission Denied');window.location.href='electric_two_wheeler_varient';</script>";
	        }
    	}
	}
	public function get_electric_two_wheeler_model_list()
	{
	    $brand = $this->input->post("brand");
	    $res = $this->cm->get_electric_two_wheeler_model_list($brand);
	    $data = "<option value=''>Select Model</option>";
	    foreach($res as $r)
	    {
	        $data.= "<option value='".$r->id."'>".$r->model_name."</option>";
	    }
	    echo $data;
	}
	public function get_electric_two_wheeler_model_list_option($brand)
	{
	    $res = $this->cm->get_electric_two_wheeler_model_list($brand);
	    $data = "<option value=''>Select Model</option>";
	    foreach($res as $r)
	    {
	        $data.= "<option value = '".$r->id."'>".$r->model_name."</option>";
	    }
	    return $data;
	}
	
	// User creation //
	
	public function create_users()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["reigions"] = $this->cm->fetch_reigion();
		   	$data["district"] = $this->cm->fetch_district();
    		$this->load->view('header',$pro_data);
    		$this->load->view('users',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        
	        $data["users"] = $this->cm->fetch_user_by_session_id($this->session->userdata('session_id'));
	        $check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
	        
	        
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
	        $data["reigions"] = $this->cm->fetch_reigion();
		   	$data["district"] = $this->cm->fetch_district();
    		$this->load->view('header',$pro_data);
    		$this->load->view('users',$data);
    		$this->load->view('footer',$pro_data);
	        
	    }
	    else
	    {
	    	redirect("login");
	    }
	}
	
	public function add_users()
	{
	     $email = $this->input->post("email");
	     
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    if(!$this->cm->check_email_already_exits($email))
    	    {
        	    $reigion = $this->input->post("region");
        	    $district = $this->input->post("district");
        	    $position = $this->input->post("position");
        	    $user_name = $this->input->post("username");
        	    $password = $this->input->post("password");
        	    $mobile = $this->input->post("mobile");
        	    $address = $this->input->post("address");
    	    
        	    $data = 
        	    array(
        	        "name" =>$user_name,
        	        "username"=>$user_name,
        	        "password"=>$password,
        	        "role" =>$position,
        	        "email_id"=>$email,
        	        "phoneno"=>$mobile,
        	        "address"=>$address
        	        );
        	    $res = $this->cm->add_users($data);
        	    
        	    if( $res ) {
        	        $this->audit->log('admin_login', 'INSERT', null, null, $data);
        	    }
        	    
        	    if($position == "user")
        	    {
        	        $data_user = 
                	    array(
                	        "user_id" =>$res,
                	        "role_id"=>3,
                	        "status"=>1,
                	        );
                	    $user_role = $this->cm->add_user_role($data_user);
        	        if( in_array("All", $district ) ) {
                        $districts = $this->cm->fetch_district();
                        if( isset( $districts ) && !empty( $districts ) ) {
                            foreach( $districts as $_dis ) {
                                $district[] = $_dis->id;
                            }
                        }
                    }
        	        for($i=0;$i<count($district);$i++)
        	        {
        	            $district_arr = array(
            	                                 "user_id" =>$res,
            	                                 "district_id"=>$district[$i]
        	                                 );
        	                                 
        	           $res_1 = $this->cm->add_user_district($district_arr);
        	           if( $res_1 ) {
                	    $this->audit->log('user_district', 'INSERT', null, null, $district_arr);
                	   }
        	        }
        	    }
        	    else if($position == "AI")
        	    {
        	        for($i=0;$i<count($reigion);$i++)
        	        {
        	            $region_arr = array(
            	                                  "ai_id" =>$res,
            	                                 "region_id"=>$reigion[$i]
        	                                 );
        	                                 
        	           $res_2 = $this->cm->add_ai_regions($region_arr);
        	           if( $res_2 ) {
                	    $this->audit->log('ai_regions', 'INSERT', null, null, $region_arr);
                	   }
        	        }
        	    }
    
        	     $data_1 = array(
        	                             "user_id" =>$res,
                                         "pos_add" =>"0",
                                         "pos_edit" =>"0",
                                         "pos_view" =>"0",
                                         "agent_add" =>"0",
                                         "agent_edit" =>"0",
                                         "agent_view" =>"0",
                                         "masters_add" =>"0",
                                         "masters_edit" =>"0",
                                         "masters_view" =>"0",
                                         "email_add" =>"0",
                                         "email_edit" =>"0",
                                         "email_view" =>"0",
                                         "policy_add" =>"0",
                                         "policy_view" =>"0",
                                         "renewals_view" =>"0",
                                         "created_by" => $this->session->userdata("session_id"),
                                         "created_date" =>date("Y-m-d H:i:s"),
                                      );
            
            $arr = $this->cm->add_user_permissions($data_1);  
            if( $arr ) {
                $this->audit->log('user_privileges', 'INSERT', null, null, $data_1);
            }
            
            $log = array("lead_id" =>$res,"action" => "New User Created - ".$user_name."","action_type" =>"User Creation","created_by" =>$this->session->userdata("session_id"),"time" =>date("Y-m-d H:i:s"));
            
            $notifiy = $this->cm->add_log($log); 
            if( $notifiy ) {
                $this->audit->log('notification_log', 'INSERT', null, null, $log);
            }
            
            
    	    }
    	    else
    	    {
    	        echo "Exits";
    	    }
    	}
	}
	
	public function fetch_users()
	{
	  if($this->session->has_userdata('logged_in')) 
    	{
    	    $draw = intval($this->input->post("draw"));
		    $res = array();
		
		
		$role = $this->input->post("role");
		
		$res = $this->cm->fetch_users_ai($role);
	
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<button class='btn btn-info btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i>
            </button>&nbsp;"; 
            
            
         if($da->role == "user")
         {
             if($da->change_status == "1")
             {
                 $action .= "<button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i></button>&nbsp;";
             }
             else 
             {
                 $action .= "<button class='btn btn-success btn-xs' onclick=change_data(".$da->id.")><i class='fa fa-toggle-on'></i></button>&nbsp;";
             }
         }
         else
         {
             if($da->change_status == "1")
             {
                 $action .= "<button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i></button>&nbsp;";
             }
             else 
             {
                 $action .= "<button class='btn btn-warning btn-xs' onclick=swap_data(".$da->id.")><i class='fa fa-exchange' title='Swap Data'></i></button>&nbsp;";
                 
                 $action .= "<button class='btn btn-success btn-xs' onclick=change_ai_data(".$da->id.")><i class='fa fa-toggle-on'></i></button>&nbsp;";
             }
         }
         
         
         
            		 
          $action .= "<button class='btn btn-primary btn-xs' onclick=permission(".$da->id.")><i class='fa fa-lock'></i> &nbsp;</button>"; 
          $action .= "<button class='btn btn-warning btn-xs' onclick=field_permission(".$da->id.")><i class='fa fa-key'></i></button>";
            

            if($da->reigion !="")
            {
                $reigion = $da->reigion;
            }
            else
            {
                $reigion = "all";
            }
            
           
            
            $d_name = "";
            
            $i =0;
          
          if($role == "user") 
          {
             $data = $this->cm->fetch_edit_users_district($da->id);
               
            foreach($data as $das)
            {
                $district = $this->cm->get_district_name($das->district_id);
                
                if($i < 3)
                {
                  if($district != null || $district != "")
                  {
                       if($i == 2)
                       {
                           $d_name .= $district->district."...";
                       }
                       else
                       {
                            $d_name .= $district->district.",";
                       }
                  }
                }
                 $i++;
            }
          }
          else if($role == "AI")
          {
             $data = $this->cm->fetch_edit_ai_regions($da->id);
              
            foreach($data as $das)
            {
                $region = $this->cm->get_region_name($das->region_id);
                
                if($i < 3)
                {
                 
                 if($region != null || $region != "")
                 {
                   if($i == 2)
                   {
                       $d_name .= $region->reigion."...";
                   }
                   else
                   {
                        $d_name .= $region->reigion.",";
                   }
                 }
                }
                 $i++;
            }
          }
            
            
            $arr[] = array(
                $a,
                $d_name,
                $da->username,
                $da->password,
                $da->email_id,
                $da->phoneno,
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
	
	public function fetch_edit_users_data()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $id = $this->input->post("id");
    	    $res = $this->cm->fetch_edit_users_data($id);
    	    
    	    if($res->role == "user")
    	    {
    	        $data = $this->cm->fetch_edit_users_district($id);
    	        
    	        $data_1 = [];
    	        $data_3 = [];
    	        
    	        foreach($data as $da)
    	        {
    	            $data_1[] = $da->district_id;
    	        }
    	        
    	        $data_2 = $this->cm->fetch_edit_users_secondary_district($id); 
    	        
    	        foreach($data_2 as $da)
    	        {
    	            $data_3[] = $da->district_id;
    	        }
    	        
    	    }
    	    else if($res->role == "AI")
    	    {
    	       $data = $this->cm->fetch_edit_ai_regions($id); 
    	       
    	        $data_1 = [];
    	        
    	        $data_3 = [];
    	        
    	        foreach($data as $da)
    	        {
    	            $data_1[] = $da->region_id;
    	        }
    	    }
    	   
    	    echo json_encode(array("u_data" =>$res,"data" =>$data_1,"s_district"=>$data_3));
    	}
	}
	
	public function edit_users()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	   $id = $this->input->post("id"); 
    	   $email = $this->input->post("email");
    	   
    	    if(!$this->cm->check_edit_email_already_exits($email,$id))
    	    {
        	    $reigion = $this->input->post("region");
        	    $district = $this->input->post("district");
        	    $user_name = $this->input->post("username");
        	    $role = $this->input->post("role");
        	    $password = $this->input->post("password");
        	    $mobile = $this->input->post("mobile");
        	    $address = $this->input->post("address");
        	    
        	    $s_district = $this->input->post("s_district");
    	    
    	       $data = array("name" =>$user_name,"username"=>$user_name,"password"=>$password,"role" =>$role,"email_id"=>$email,"phoneno"=>$mobile,"address"=>$address);
    	    
    	       $old_data = $this->cm->fetch_edit_users_data($id);
    	       $res = $this->cm->edit_users($data,$id);
    	       
    	        if( $res ) {
    	            $this->audit->log('admin_login', 'UPDATE', null, $old_data, $data);
    	        }
    	       
    	        if($role == "user")
        	    {
        	        $old_udata = $this->cm->fetch_edit_users_district($id);
        	        $remove_old = $this->cm->remove_old_user_districts($id);
        	        
        	        if( $remove_old ) {
        	            $this->audit->log('user_district', 'DELETE', 'recreate', $old_udata, null);
        	        }
        	        
        	        if( in_array("All", $district ) ) {
                        $district = [];
                        $districts = $this->cm->fetch_district();
                        echo '<pre>';print_r($districts);echo'</pre>';
                        if( isset( $districts ) && !empty( $districts ) ) {
                            foreach( $districts as $_dis ) {
                                $district[] = $_dis->id;
                            }
                        }
                    }
                    
        	        for($i=0;$i<count($district);$i++)
        	        {
        	            $district_arr = array(
            	                                 "user_id" =>$id,
            	                                 "district_id"=>$district[$i]
        	                                 );
        	                                 
        	           $res_1 = $this->cm->add_user_district($district_arr);
        	           if( $res_1 ) {
            	        $this->audit->log('user_district', 'INSERT', null, null, $district_arr);
            	       }
        	        }
        	    }
        	    
        	    if($role == "user")
        	    {
        	        $old_usdata = $this->cm->fetch_edit_users_secondary_district($id);
        	        $remove_old = $this->cm->remove_old_user_secondary_districts($id);
        	        if( $remove_old ) {
        	            $this->audit->log('user_secondary_district', 'DELETE', 'recreate', $old_usdata, null);
        	        }
        	        for($i=0;$i<count($s_district);$i++)
        	        {
        	            $district_arr_1 = array(
            	                                 "user_id" =>$id,
            	                                 "district_id"=>$s_district[$i]
        	                                 );
        	                                 
        	           $res_3 = $this->cm->add_user_secondary_district($district_arr_1);
        	           if( $res_3 ) {
            	        $this->audit->log('user_secondary_district', 'INSERT', null, null, $district_arr_1);
            	       }
        	        }
        	    }
        	    else if($role == "AI")
        	    {
        	        $old_adata = $this->cm->fetch_edit_ai_regions($id);
        	        $remove_old = $this->cm->remove_old_ai_regions($id);
        	        if( $remove_old ) {
        	            $this->audit->log('ai_regions', 'DELETE', 'recreate', $old_adata, null);
        	        }
        	        for($i=0;$i<count($reigion);$i++)
        	        {
        	            $region_arr = array(
            	                                  "ai_id" =>$id,
            	                                 "region_id"=>$reigion[$i]
        	                                 );
        	                                 
        	           $res_2 = $this->cm->add_ai_regions($region_arr);
        	           if( $res_2 ) {
        	            $this->audit->log('ai_regions', 'INSERT', null, null, $region_arr);
        	           }
        	        }
        	    }
    	    }
    	    else
    	    {
    	        echo "Exits";
    	    }
    	}
	}
	
	public function delete_users()
	{
	    $id= $this->input->post("id");
	    $data = array("status" => "de-active");
	    $old_data = $this->cm->fetch_edit_users_data($id);
	    $res = $this->cm->delete_users($id, $data);
	    if( $res ) {
	        $this->audit->log('admin_login', 'UPDATE', 'Deactive', $old_data, $data);
	    }
	}
	
	// pos creation //
	
	public function create_pos()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["users"]=$this->cm->fetch_users();
		   	$data["regions"]=$this->cm->fetch_regions();
		   	$data["pos"] = $this->cm->fetch_all_pos_list();
    		$this->load->view('header',$pro_data);
    		$this->load->view('pos',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $data["users"] = $this->cm->fetch_user_by_session_id($this->session->userdata('session_id'));
	        $check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
	        
	        if($check_user_i->pos_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    	        $data["pos"] = $this->cm->fetch_all_pos_list();
    	        $data["regions"]=$this->cm->fetch_regions();
        		$this->load->view('header',$pro_data);
        		$this->load->view('pos',$data);
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
	
	public function add_pos()
	{
	    $email = $this->input->post("email");
	     
	    if($this->session->has_userdata('logged_in')) 
    	{
    	  $check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
    	  
    	  if($check_user_i->pos_add == "1")
          {
    	    if(!$this->cm->check_pos_email_already_exits($email))
    	    {
        	    if($this->session->userdata('session_role') == "user")
        	    {
        	        $user_id = $this->session->userdata('session_id');
        	    }
        	    else
        	    {
        	        $user_id = $this->input->post("user_id");
        	    }
        	    
        	    
        	
        	    $add_pos_or_sub_pos = $this->input->post("add_pos_or_sub_pos");
        	    
        	    if($add_pos_or_sub_pos == "sub_pos")
        	    {
        	        $add_pos_or_sub_pos = "1";
        	    }
        	    else
        	    {
        	        $add_pos_or_sub_pos = "0";
        	    }
        	     
        	     $add_pos_code = "";
        	    
        	     $add_pos_code = $this->input->post("add_pos_code");
        	 
        	    if($add_pos_code == "")
        	    {
        	        $add_pos_code = "";
        	    }
        	    else
        	    {
        	        $add_pos_code = $this->input->post("add_pos_code");
        	    }
        	    
                $user_id = $this->input->post("user_id");
                $user_name = $this->input->post("username");
                
                $usr_code = strtoupper(substr($user_name,0,3));
                
                if($this->cm->check_pos_code_already_exits($usr_code))
                {
                    $last_pos_code = $this->cm->get_agent_pos_code($usr_code);
                    $get_numeric_val =substr($last_pos_code->agent_pos_code,3,7);
                    
                    $new_numeric_code = $get_numeric_val + 1;
                    $value = sprintf("%04d",$new_numeric_code);
                    $pos_code = $usr_code.$value;
                }
                else
                {
                    $pos_code = $usr_code."0001";
                }
                
                $region = $this->input->post("region");
                $ai = $this->input->post("ai");
               
                $password = $this->input->post("password");
                $email = $this->input->post("email");
                $mobile = $this->input->post("mobile");
                $address=$this->input->post("address");
                $aadhar_card_no=$this->input->post("aadhar_card_no");
                $dob=$this->input->post("dob");
                $office_address=$this->input->post("office_address");
                $bank_ac_no=$this->input->post("bank_ac_no");
                $bank_ifsc=$this->input->post("bank_ifsc");
                $pan_no = $this->input->post("pan_no");
                $bank_name = $this->input->post("bank_name");
                $bank_branch = $this->input->post("bank_branch");
                
                $c_category = $this->input->post("c_category");
                
        if(isset($_FILES))
		{
			$config['upload_path'] = './datas/agent_pos_documents/';
			$config['allowed_types'] = '*';
			
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			
			if(!$this->upload->do_upload('adhar_card'))
			{
				$adhar_file = '';
				$adhar_file_path = "";
			}
			else
			{
				$adhar_file_path = base_url().'datas/agent_pos_documents/'.$this->upload->data('file_name');
				$adhar_file = $this->upload->data('file_name');
			}
		}
		
		if(isset($_FILES))
		{
			$config['upload_path'] = './datas/agent_pos_documents/';
			$config['allowed_types'] = '*';
			
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('bank_cheque'))
			{
				$bank_cheque_file = '';
				$bank_cheque_file_path = "";
			}
			else
			{
				$bank_cheque_file_path = base_url().'datas/agent_pos_documents/'.$this->upload->data('file_name');
				$bank_cheque_file = $this->upload->data('file_name');
			}
		}
		
		if(isset($_FILES))
		{
			$config['upload_path'] = './datas/agent_pos_documents/';
			$config['allowed_types'] = '*';
			
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			if(!$this->upload->do_upload('pan_card'))
			{
				$pan_card_file = '';
				$pan_card_file_path = "";
			}
			else
			{
				$pan_card_file_path = base_url().'datas/agent_pos_documents/'.$this->upload->data('file_name');
				$pan_card_file = $this->upload->data('file_name');
			}
		}
        	    
        	    $data = array(
        	    "pos_status" => $add_pos_or_sub_pos,
        	    "sub_pos_by" => $add_pos_code,
        	    "name" =>$user_name,
        	    "agent_pos_code" =>$pos_code,
        	    "password"=>$password,
        	    "role" =>"pos",
        	    "email_id"=>$email,
        	    "user_id"=>$user_id,
        	    "region" =>$region,
            	"area_incharge" =>$ai,
        	    "phoneno"=>$mobile,
        	    "dob"=>$dob,
        	    "address"=>$address,
        	    "office_address" =>$office_address,
        	    "bank_acc_no" => $bank_ac_no,
        	     "bank_name"=>$bank_name,
        	    "ifsc_code"=>$bank_ifsc,
        	    "adhar_card_no"=>$aadhar_card_no,
        	    "pan_card_no"=>$pan_no,
        	    "branch"=>$bank_branch,
        	    "pan_card_file"=>$pan_card_file,
        	    "check_leaf"=>$bank_cheque_file,
        	    "adhar_file"=>$adhar_file,
        	    "commission_category" =>$c_category,
        	    "created_by"=>$this->session->userdata('session_id'),
        	    "created_date" => date("Y-m-d H:i:s"),
        	    "status"=>"active"
        	    );
        	    $res = $this->cm->add_pos($data);
        	    
        	    if( $res ) {
        	        $this->audit->log('list_of_pos_and_agents', 'INSERT', null, null, $data);
        	    }
    	    }
    	    else
    	    {
    	        echo "Exits";
    	    }
          }
              else
              {
                  echo "<script>alert('Permission Denied');window.location.href='create_pos';</script>";
              }
          }
    }

    public function fetch_pos()
	{
	  if($this->session->has_userdata('logged_in')) 
    	{
    	    $draw = intval($this->input->post("draw"));
		    $res = array();
		
		 $pos_status = $this->input->post("pos_status");
		 $pos = $this->input->post("pos");
		 
		$res = $this->cm->fetch_pos($pos_status,$pos);
	
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
          $a++;
          
          $action = "";
          
          $check_user_i = $this->cm->fetch_user_permissions($this->session->userdata("session_id"));
          
          if($check_user_i->pos_edit == "1")
          {
               $action .= "<button class='btn btn-info btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i></button>&nbsp";
          }
          else
          {
              $action .= "";
          }
          
          if($check_user_i->pos_delete == "1")
          {
              $action .= "<button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i></button>";
          }
          else
          {
              $action .= "";
          }
          
            if($da->user_name !="")
            {
                $username = $da->user_name;
            }
            else
            {
                $username = "all";
            }
            
            $arr[] = array(
                $a,
                $da->name,
                $da->agent_pos_code,
                $da->phoneno,
                $da->branch,
                date_format(date_create($da->created_date),"Y-m-d H:i:s"),
                $username,
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
	
	public function fetch_edit_pos_data()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $id = $this->input->post("id");
    	    $res = $this->cm->fetch_edit_pos_data($id);
    	    echo json_encode($res);
    	}
	}
	
	public function edit_pos()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	  $check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
    	  
    	  if($check_user_i->pos_edit == "1")
          {
        	   $id = $this->input->post("id"); 
        	   $email = $this->input->post("email");
        	   
        	    if(!$this->cm->check_edit_pos_email_already_exits($email,$id))
        	    {
        	        $pos_code = $this->input->post("pos_code");
                    $user_id = $this->input->post("user_id");
                    $user_name = $this->input->post("username");
                    $password = $this->input->post("password");
                    $email = $this->input->post("email");
                    $mobile = $this->input->post("mobile");
                    $address=$this->input->post("address");
                    $aadhar_card_no=$this->input->post("aadhar_card_no");
                    $dob=$this->input->post("dob");
                    $office_address=$this->input->post("office_address");
                    $bank_ac_no=$this->input->post("bank_ac_no");
                    $bank_ifsc=$this->input->post("bank_ifsc");
                    $pan_no = $this->input->post("pan_no");
                    $bank_name = $this->input->post("bank_name");
                    $bank_branch = $this->input->post("bank_branch");
                    
                    $c_category = $this->input->post("c_category");
                    
            if(isset($_FILES))
    		{
    			$config['upload_path'] = './datas/agent_pos_documents/';
    			$config['allowed_types'] = '*';
    			
    			$this->load->library('upload',$config);
    			$this->upload->initialize($config);
    			if(!$this->upload->do_upload('adhar_card'))
    			{
    			   $res = $this->cm->get_old_file_path($id);
    			   
    				$adhar_file = $res->adhar_file;
    				$adhar_file_path = "";
    			}
    			else
    			{
    			  $res = $this->cm->get_old_file_path($id);  
    			   $old_file = $res->adhar_file;
                   unlink("./datas/agent_pos_documents/".$old_file);
                   
    				$adhar_file_path = base_url().'datas/agent_pos_documents/'.$this->upload->data('file_name');
    				$adhar_file = $this->upload->data('file_name');
    			}
    		}
    		
    		if(isset($_FILES))
    		{
    			$config['upload_path'] = './datas/agent_pos_documents/';
    			$config['allowed_types'] = '*';
    			
    			$this->load->library('upload',$config);
    			$this->upload->initialize($config);
    			if(!$this->upload->do_upload('bank_cheque'))
    			{
    			   $res = $this->cm->get_old_file_path($id);
    				$bank_cheque_file = $res->check_leaf;
    				$bank_cheque_file_path = "";
    			}
    			else
    			{
    			    $res = $this->cm->get_old_file_path($id);
    			  $old_file = $res->check_leaf;
    			  unlink("./datas/agent_pos_documents/".$old_file);
    			  
    			   if(file_exists($old_file)) 
    			   {
    			         unlink($old_file);
    
                   }   
    				$bank_cheque_file_path = base_url().'datas/agent_pos_documents/'.$this->upload->data('file_name');
    				$bank_cheque_file = $this->upload->data('file_name');
    			}
    		}
    		
    		if(isset($_FILES))
    		{
    			$config['upload_path'] = './datas/agent_pos_documents/';
    			$config['allowed_types'] = '*';
    			
    			$this->load->library('upload',$config);
    			$this->upload->initialize($config);
    			if(!$this->upload->do_upload('pan_card'))
    			{
    			   $res = $this->cm->get_old_file_path($id);
    				$pan_card_file = $res->pan_card_file;
    				$pan_card_file_path = "";
    			}
    			else
    			{
    			    $res = $this->cm->get_old_file_path($id);
    			    $old_file = $res->pan_card_file;
    			    
    			    unlink("./datas/agent_pos_documents/".$old_file);
    
    				$pan_card_file_path = base_url().'datas/agent_pos_documents/'.$this->upload->data('file_name');
    				$pan_card_file = $this->upload->data('file_name');
    			}
    		}
            	    
            	$region = $this->input->post("region");
                $ai = $this->input->post("ai");
            	    
            	    
            	    $data = array(
            	    "name" =>$user_name,
            	    "password"=>$password,
            	    "email_id"=>$email,
            	    "user_id"=>$user_id,
            	    "region" =>$region,
            	    "area_incharge" =>$ai,
            	    "phoneno"=>$mobile,
            	    "dob"=>$dob,
            	    "address"=>$address,
            	    "office_address" =>$office_address,
            	    "bank_acc_no" => $bank_ac_no,
            	     "bank_name"=>$bank_name,
            	    "ifsc_code"=>$bank_ifsc,
            	    "adhar_card_no"=>$aadhar_card_no,
            	    "pan_card_no"=>$pan_no,
            	    "branch"=>$bank_branch,
            	    "pan_card_file"=>$pan_card_file,
            	    "check_leaf"=>$bank_cheque_file,
            	    "adhar_file"=>$adhar_file,
            	    "sub_pos_by" => $pos_code,
            	     "commission_category" =>$c_category,
            	    "updated_date"=>date("Y-m-d H:i:s"),
            	    "updated_by"=>$this->session->userdata('session_id'),
            	    "status"=>"active"
            	    );
            	    
                	$old_data = $this->cm->fetch_edit_pos_data($id);
                	
            	    $res = $this->cm->edit_pos($data,$id);
            	    if( $res ) {
            	        $this->audit->log('list_of_pos_and_agents', 'UPDATE', null, $old_data, $data);
            	    }
        	    }
        	    else
        	    {
        	        echo "Exits";
        	    }
          }
          else
          {
              echo "<script>alert('Permission Denied');window.location.href='create_pos';</script>";
          }
       }
	}
	
	public function delete_pos()
	{
	    
	    if($this->session->has_userdata('logged_in')) 
    	{
    	  $check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
    	  
        	  if($check_user_i->pos_delete == "1")
              {
            	    $id= $this->input->post("id");
            	    $old_data = $this->cm->fetch_edit_pos_data($id);
                	$res = $this->cm->delete_pos($id);
            	    if( $res ) {
            	        $this->audit->log('list_of_pos_and_agents', 'DELETE', null, $old_data, null);
            	    }
              }
    	}
	}
	
	// Agent creation //

	public function create_agent()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{   
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["users"]=$this->cm->fetch_users();
		   	$data["regions"]=$this->cm->fetch_regions();
    		$this->load->view('header',$pro_data);
    		$this->load->view('agents',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	         $check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
	        
	        if($check_user_i->agent_view == "1")
	        {
	           
	           if($this->session->userdata("session_role") == "user")
	           {
    	          $data["users"] = $this->cm->fetch_user_by_session_id($this->session->userdata('session_id'));
	           }
	           else 
	           {
	                $regions = $this->cm->fetch_user_id_using_region($this->session->userdata('session_id'));
	                
	                $region_arr = [];
	                
	                foreach($regions as $da)
	                {
	                    $region_arr[] = $da->region_id;
	                }
	                
	                $districts = $this->cm->fetch_user_id_using_region_id($region_arr);
	                
	                $districts_arr = [];
	                
	                foreach($districts as $da)
	                {
	                    $districts_arr[] = $da->district_id;
	                }
	                $users = $this->cm->get_user_id_by_district($districts_arr);
	                
	                $users_arr = [];
	                
	                foreach($users as $da)
	                {
	                    $users_arr[] = $da->user_id;
	                }
	                
	                $data["users"] = $this->cm->get_user_id($users_arr);
	           }
    	        $data["regions"]=$this->cm->fetch_regions();
    	        $data["regions_user"]=$this->cm->fetch_user_regions($this->session->userdata('session_id'));
    	        $data["regions_ai"]=$this->cm->fetch_ai_regions($this->session->userdata('session_id'));
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
        		$this->load->view('header',$pro_data);
        		$this->load->view('agents',$data);
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
	
	
	public function add_agent()
	{
	    $email = $this->input->post("email");
	     
	    if($this->session->has_userdata('logged_in')) 
    	{
    	  $check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
	        
	        if($check_user_i->agent_add == "1")
	        {
        	    if(!$this->cm->check_pos_email_already_exits($email))
        	    {
            	    if($this->session->userdata('session_role') == "user")
            	    {
            	        $user_id = $this->session->userdata('session_id');
            	    }
            	    else
            	    {
            	        $user_id = $this->input->post("user_id");
            	    }
            	    
                    $user_id = $this->input->post("user_id");
                    $user_name = $this->input->post("username");
                    
                    $usr_code = strtoupper(substr($user_name,0,3));
                    
                    if($this->cm->check_pos_code_already_exits($usr_code))
                    {
                        $last_pos_code = $this->cm->get_agent_pos_code($usr_code);
                        $get_numeric_val =substr($last_pos_code->agent_pos_code,3,7);
                        $new_numeric_code = $get_numeric_val + 1;
                        $value = sprintf("%04d",$new_numeric_code);
                        $pos_code = $usr_code.$value;
                    }
                    else
                    {
                        $pos_code = $usr_code."0001";
                    }
                    
                    $user_name = $this->input->post("username");
                    $region = $this->input->post("region");
                    $ai = $this->input->post("ai");
                    $password = $this->input->post("password");
                    $email = $this->input->post("email");
                    $mobile = $this->input->post("mobile");
                    $address=$this->input->post("address");
                    $aadhar_card_no=$this->input->post("aadhar_card_no");
                    $dob=$this->input->post("dob");
                    $office_address=$this->input->post("office_address");
                    $bank_ac_no=$this->input->post("bank_ac_no");
                    $bank_ifsc=$this->input->post("bank_ifsc");
                    $pan_no = $this->input->post("pan_no");
                    $bank_name = $this->input->post("bank_name");
                    $bank_branch = $this->input->post("bank_branch");
                    $c_category = $this->input->post("c_category");
                    
                    // Bank 2
                    
                    $bank_name2 = $this->input->post("bank_name2");
                    $bank_branch2 = $this->input->post("bank_branch2");
                    $bank_ac_no2 = $this->input->post("bank_ac_no2");
                    $bank_ifsc2 = $this->input->post("bank_ifsc2");
                    $add_from_date = $this->input->post("add_from_date");
                    $add_to_date = $this->input->post("add_to_date");
                    
                    
                    if(isset($_FILES))
            		{
            			$config['upload_path'] = './datas/agent_pos_documents/';
            			$config['allowed_types'] = '*';
            			
            			$this->load->library('upload',$config);
            			$this->upload->initialize($config);
            			if(!$this->upload->do_upload('adhar_card'))
            			{
            				$adhar_file = '';
            				$adhar_file_path = "";
            			}
            			else
            			{
            				$adhar_file_path = base_url().'datas/agent_pos_documents/'.$this->upload->data('file_name');
            				$adhar_file = $this->upload->data('file_name');
            			}
            		}
            		
            		// 	Aadhar card back start
            
            		if(isset($_FILES))
            		{
            			$config['upload_path'] = './datas/agent_pos_documents/';
            			$config['allowed_types'] = '*';
            			
            			$this->load->library('upload',$config);
            			$this->upload->initialize($config);
            			if(!$this->upload->do_upload('aadhar_card_back'))
            			{
            				$aadhar_card_back = '';
            				$adhar_file_path = "";
            			}
            			else
            			{
            				$adhar_file_path = base_url().'datas/agent_pos_documents/'.$this->upload->data('file_name');
            				$aadhar_card_back = $this->upload->data('file_name');
            			}
            		}
            		
            		
                    // Aadhar card back end
            	
            		if(isset($_FILES))
            		{
            			$config['upload_path'] = './datas/agent_pos_documents/';
            			$config['allowed_types'] = '*';
            			
            			$this->load->library('upload',$config);
            			$this->upload->initialize($config);
            			if(!$this->upload->do_upload('bank_cheque'))
            			{
            				$bank_cheque_file = '';
            				$bank_cheque_file_path = "";
            			}
            			else
            			{
            				$bank_cheque_file_path = base_url().'datas/agent_pos_documents/'.$this->upload->data('file_name');
            				$bank_cheque_file = $this->upload->data('file_name');
            			}
            		}
            		
            		if(isset($_FILES))
            		{
            			$config['upload_path'] = './datas/agent_pos_documents/';
            			$config['allowed_types'] = '*';
            			
            			$this->load->library('upload',$config);
            			$this->upload->initialize($config);
            			if(!$this->upload->do_upload('pan_card'))
            			{
            				$pan_card_file = '';
            				$pan_card_file_path = "";
            			}
            			else
            			{
            				$pan_card_file_path = base_url().'datas/agent_pos_documents/'.$this->upload->data('file_name');
            				$pan_card_file = $this->upload->data('file_name');
            			}
            		}
            		
            		
            		if(isset($_FILES))
            		{
            			$config['upload_path'] = './datas/agent_photo/';
            			$config['allowed_types'] = '*';
            			
            			$this->load->library('upload',$config);
            			$this->upload->initialize($config);
            			if(!$this->upload->do_upload('upload_agent_photo'))
            			{
            				$agent_photo = '';
            				$agent_photo_path = "";
            			}
            			else
            			{
            			    $agent_photo_path = base_url().'datas/office_photo/'.$this->upload->data('file_name');
            				$agent_photo = $this->upload->data('file_name');
            				
            			
            			}
            		}
            		
            		if(isset($_FILES))
            		{
            			$config['upload_path'] = './datas/office_photo/';
            			$config['allowed_types'] = '*';
            			
            			$this->load->library('upload',$config);
            			$this->upload->initialize($config);
            			if(!$this->upload->do_upload('upload_office_photo'))
            			{
            				$office_photo = '';
            				$office_photo_path = "";
            			}
            			else
            			{
            				$office_photo_path = base_url().'datas/agent_photo/'.$this->upload->data('file_name');
            				$office_photo = $this->upload->data('file_name');
            			}
            		}
            	    
            	    $data = array(
                                "name" =>$user_name,
                                "password"=>$password,
                                "agent_pos_code" => $pos_code,
                                "role" =>"agent",
                                "email_id"=>$email,
                                "user_id"=>$user_id,
                                "region" =>$region,
                                "area_incharge" =>$ai,
                                "phoneno"=>$mobile,
                                "dob"=>$dob,
                                "address"=>$address,
                                "office_address" =>$office_address,
                                "bank_acc_no" => $bank_ac_no,
                                "bank_name"=>$bank_name,
                                "ifsc_code"=>$bank_ifsc,
                                "adhar_card_no"=>$aadhar_card_no,
                                "pan_card_no"=>$pan_no,
                                "branch"=>$bank_branch,
                                "pan_card_file"=>$pan_card_file,
                                "check_leaf"=>$bank_cheque_file,
                                "adhar_file"=>$adhar_file,
                                "commission_category" =>$c_category,
                                "aadhar_card_back" => $aadhar_card_back,
                                "bank_name2" => $bank_name2,
                                "bank_branch2" => $bank_branch2,
                                "bank_ac_no2" => $bank_ac_no2,
                                "bank_ifsc2" => $bank_ifsc2,
                                "agent_photo" => $agent_photo,
                                "office_photo" => $office_photo,
                                "created_date" =>date("Y-m-d H:i:s"),
                                "created_by"=>$this->session->userdata('session_id'),
                                "status"=>"active"
            	    );
            	    
                	$res = $this->cm->add_pos($data);
                	if( $res ) {
        	            $this->audit->log('list_of_pos_and_agents', 'INSERT', null, null, $data);
        	        }
            	    
                    $acc_id = $this->am->get_last_acc_id();
                    $last_id = $acc_id->accid+1;
                    $vcharid = "acc".$last_id;
                    
                    //Agent commission Ledger id acc42
                    
                    $data = array(
                                "accid" => $acc_id->accid+1,
                                "vchaccid" =>$vcharid,
                                "vch" =>"acc",
                                "vchaccname" =>$pos_code,
                                "vchparentid" =>"acc42",
                                "parentid" => "42",
                                "chracctype" =>"1",
                                "cr_dr_status" =>"3",
                                "agent_id" =>$res,
                        );
                        
                    $res0 = $this->am->add_sub_ledger($data);
                    if( $res0 ) {
        	            $this->audit->log('account_tree', 'INSERT', null, null, $data);
        	        }
                    $res1 = $this->am->add_sub_ledger_orc($data);
                    if( $res1 ) {
        	            $this->audit->log('account_tree_orc', 'INSERT', null, null, $data);
        	        }
        	    }
        	    else
        	    {
        	        echo "Exits";
        	    }
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='create_agent';</script>";
	        }
    	}
	}
	
    public function fetch_agent()
	{
	  if($this->session->has_userdata('logged_in')) 
    	{
    	    $draw = intval($this->input->post("draw"));
		    $res = array();
		    
		 $res = $this->cm->fetch_agent();
	
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;
        	
        	$check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
        	
        	$action = "";
	        
             if($check_user_i->agent_edit == "1")
             {
                 $action .= "<button class='btn btn-info btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i></button>&nbsp";
             }
             else
             {
                 $action .= " ";
             }
             
             
             if($check_user_i->agent_delete == "1")
             {
                   $action .= "<button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i></button>";
             }
             else
             {
                 $action .= " ";
             }
            
           
            if($da->user_name !="")
            {
                $username = $da->user_name;
            }
            else
            {
                $username = "all";
            }
            
            $area_incharge = $this->cm->fetch_area_incharge($da->area_incharge);
            
            if($area_incharge != null)
            {
                $ai_name = $area_incharge->name;
            }
            else 
            {
                $ai_name  = "";
            }
            
            $arr[] = array(
                $a,
                $da->name,
                $da->agent_pos_code,
                $da->phoneno,
                $da->region_name,
                $ai_name,
                date_format(date_create($da->created_date),"d-m-Y"),
                $username,
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
	
	public function fetch_edit_agent_data()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $id = $this->input->post("id");
    	    $res = $this->cm->fetch_edit_agent_data($id);
    	    echo json_encode($res);
    	}
	}
	
	public function edit_agent()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	   $id = $this->input->post("id"); 
    	   $email = $this->input->post("email");
    	   
    	   	
        	$check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
        	
             if($check_user_i->agent_edit == "1")
             {
        	    if(!$this->cm->check_edit_pos_email_already_exits($email,$id))
        	    {
                    $user_id = $this->input->post("user_id");
                    $user_name = $this->input->post("username");
                    $password = $this->input->post("password");
                    $email = $this->input->post("email");
                    $mobile = $this->input->post("mobile");
                    $address=$this->input->post("address");
                    $aadhar_card_no=$this->input->post("aadhar_card_no");
                    $dob=$this->input->post("dob");
                    $office_address=$this->input->post("office_address");
                    $bank_ac_no=$this->input->post("bank_ac_no");
                    $bank_ifsc=$this->input->post("bank_ifsc");
                    $pan_no = $this->input->post("pan_no");
                    $bank_name = $this->input->post("bank_name");
                    $bank_branch = $this->input->post("bank_branch");
                    
                    $region = $this->input->post("region");
                    $ai = $this->input->post("ai");
                    
                     // Bank 2
                    
                    $bank_name2 = $this->input->post("bank_name2");
                    $bank_branch2 = $this->input->post("bank_branch2");
                    $bank_ac_no2 = $this->input->post("bank_ac_no2");
                    $bank_ifsc2 = $this->input->post("bank_ifsc2");
                    
                    $c_category = $this->input->post("c_category");
                    $from_date = $this->input->post("edit_from_date");
                    $to_date = $this->input->post("edit_to_date");
                    
                   
                    
            if(isset($_FILES))
    		{
    			$config['upload_path'] = './datas/agent_pos_documents/';
    			$config['allowed_types'] = '*';
    			
    			$this->load->library('upload',$config);
    			$this->upload->initialize($config);
    			if(!$this->upload->do_upload('adhar_card'))
    			{
    			   $res = $this->cm->get_old_file_path($id);
    			   
    				$adhar_file = $res->adhar_file;
    				$adhar_file_path = "";
    			}
    			else
    			{
    			  $res = $this->cm->get_old_file_path($id);  
    			   $old_file = $res->adhar_file;
                   //unlink("./datas/agent_pos_documents/".$old_file);
                    if (file_exists("./datas/agent_pos_documents/".$old_file)) {
                        unlink("./datas/agent_pos_documents/".$old_file);
                    }
                   
    				$adhar_file_path = base_url().'datas/agent_pos_documents/'.$this->upload->data('file_name');
    				$adhar_file = $this->upload->data('file_name');
    			}
    		}
    		
    		    //   edit Aadhar back start
                   		
    		if(isset($_FILES))
    		{
    			$config['upload_path'] = './datas/agent_pos_documents/';
    			$config['allowed_types'] = '*';
    			
    			$this->load->library('upload',$config);
    			$this->upload->initialize($config);
    			if(!$this->upload->do_upload('aadhar_card_back'))
    			{
    			   $res = $this->cm->get_old_file_path($id);
    			   
    				$aadhar_card_back = $res->aadhar_card_back;
    				$adhar_file_path = "";
    			}
    			else
    			{
    			  $res = $this->cm->get_old_file_path($id);  
    			   $old_file = $res->aadhar_card_back;
                   //unlink("./datas/agent_pos_documents/".$old_file);
                    if (file_exists("./datas/agent_pos_documents/".$old_file)) {
                        unlink("./datas/agent_pos_documents/".$old_file);
                    }
    				$adhar_file_path = base_url().'datas/agent_pos_documents/'.$this->upload->data('file_name');
    				$aadhar_card_back = $this->upload->data('file_name');
    			}
    		}
  		
    		
    		if(isset($_FILES))
    		{
    			$config['upload_path'] = './datas/agent_pos_documents/';
    			$config['allowed_types'] = '*';
    			
    			$this->load->library('upload',$config);
    			$this->upload->initialize($config);
    			if(!$this->upload->do_upload('bank_cheque'))
    			{
    			   $res = $this->cm->get_old_file_path($id);
    				$bank_cheque_file = $res->check_leaf;
    				$bank_cheque_file_path = "";
    			}
    			else
    			{
    			    $res = $this->cm->get_old_file_path($id);
    			  $old_file = $res->check_leaf;
    			  //unlink("./datas/agent_pos_documents/".$old_file);
                    if (file_exists("./datas/agent_pos_documents/".$old_file)) {
                        unlink("./datas/agent_pos_documents/".$old_file);
                    }
    			   if(file_exists($old_file)) 
    			   {
    			         unlink($old_file);
    
                   }   
    				$bank_cheque_file_path = base_url().'datas/agent_pos_documents/'.$this->upload->data('file_name');
    				$bank_cheque_file = $this->upload->data('file_name');
    			}
    		}
    		
    		if(isset($_FILES))
    		{
    			$config['upload_path'] = './datas/agent_pos_documents/';
    			$config['allowed_types'] = '*';
    			
    			$this->load->library('upload',$config);
    			$this->upload->initialize($config);
    			if(!$this->upload->do_upload('pan_card'))
    			{
    			   $res = $this->cm->get_old_file_path($id);
    				$pan_card_file = $res->pan_card_file;
    				$pan_card_file_path = "";
    			}
    			else
    			{
    			    $res = $this->cm->get_old_file_path($id);
    			    $old_file = $res->pan_card_file;
    			    
    			    //unlink("./datas/agent_pos_documents/".$old_file);
                    if (file_exists("./datas/agent_pos_documents/".$old_file)) {
                        unlink("./datas/agent_pos_documents/".$old_file);
                    }
    
    				$pan_card_file_path = base_url().'datas/agent_pos_documents/'.$this->upload->data('file_name');
    				$pan_card_file = $this->upload->data('file_name');
    			}
    		}
            	 
            	 
            	 	if(isset($_FILES))
            		{
            			$config['upload_path'] = './datas/agent_photo/';
            			$config['allowed_types'] = '*';
            			
            			$this->load->library('upload',$config);
            			$this->upload->initialize($config);
            			if(!$this->upload->do_upload('upload_agent_photo'))
            			{
            				$agent_photo = '';
            				$agent_photo_path = "";
            			}
            			else
            			{
            			    $agent_photo_path = base_url().'datas/office_photo/'.$this->upload->data('file_name');
            				$agent_photo = $this->upload->data('file_name');
            				
            			
            			}
            		}
            		
            		if(isset($_FILES))
            		{
            			$config['upload_path'] = './datas/office_photo/';
            			$config['allowed_types'] = '*';
            			
            			$this->load->library('upload',$config);
            			$this->upload->initialize($config);
            			if(!$this->upload->do_upload('upload_office_photo'))
            			{
            				$office_photo = '';
            				$office_photo_path = "";
            			}
            			else
            			{
            				$office_photo_path = base_url().'datas/agent_photo/'.$this->upload->data('file_name');
            				$office_photo = $this->upload->data('file_name');
            			}
            		}
            		
            	    $data = array(
            	    "name" =>$user_name,
            	    "password"=>$password,
            	    "email_id"=>$email,
            	    "user_id"=>$user_id,
            	    "region"=>$region,
            	    "area_incharge" =>$ai,
            	    "phoneno"=>$mobile,
            	    "dob"=>$dob,
            	    "address"=>$address,
            	    "office_address" =>$office_address,
            	    "bank_acc_no" => $bank_ac_no,
            	     "bank_name"=>$bank_name,
            	    "ifsc_code"=>$bank_ifsc,
            	    "adhar_card_no"=>$aadhar_card_no,
            	    "pan_card_no"=>$pan_no,
            	    "branch"=>$bank_branch,
            	    "pan_card_file"=>$pan_card_file,
            	    "check_leaf"=>$bank_cheque_file,
            	    "adhar_file"=>$adhar_file,
            	    "aadhar_card_back" => $aadhar_card_back,
            	    "commission_category" =>$c_category,
                    "bank_name2" => $bank_name2,
                    "bank_branch2" => $bank_branch2,
                    "bank_ac_no2" => $bank_ac_no2,
                    "bank_ifsc2" => $bank_ifsc2,
                    "agent_photo" => $agent_photo,
                    "office_photo" => $office_photo,
            	    "updated_date" =>date("Y-m-d H:i:s"),
            	    "updated_by"=>$this->session->userdata('session_id'),
            	    "status"=>"active",
            	    );
            	    
            	$old_data = $this->cm->fetch_edit_agent_data($id);
        	    $res = $this->cm->edit_pos($data,$id);
        	    if( $res ) {
    	            $this->audit->log('list_of_pos_and_agents', 'UPDATE', null, $old_data, $data);
    	        }
        	    
        	    }
        	    else
        	    {
        	        echo "Exits";
        	    }
             }
             else
             {
                 echo "<script>alert('Permission Denied');window.location.href='create_agent';</script>";
             }
    	}
	}
	

	public function delete_agent()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	 //   echo "<pre>"; print_r($check_user_i); exit;
    	     if($check_user_i->agent_delete == "1")
             {
               //  print_r("hi"); exit;
        	    $id= $this->input->post("id");
        	    $old_data = $this->cm->fetch_edit_agent_data($id);
        	    $res = $this->cm->delete_agent($id);
        	    if( $res ) {
    	            $this->audit->log('list_of_pos_and_agents', 'DELETE', null, $old_data, null);
    	        }
             }
    	}
	}
	
	// client type //
	
   public function client_type()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["users"]=$this->cm->fetch_users();
    		$this->load->view('header',$pro_data);
    		$this->load->view('client_type',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $data["users"] = $this->cm->fetch_user_by_session_id($this->session->userdata('session_id'));
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('client_type',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}
	
	public function fetch_client_type()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->cm->fetch_client_type();
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<button class='btn btn-info btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i></button> ";
            
            $arr[] = array(
                $a,
                $da->client_type,
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

	public function add_client_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$client_type = $this->input->post("client_type");

    		$data = array("client_type" => $client_type);
    		$this->cm->add_client_type($data);

    		echo "Success";
    	}
	}

	public function fetch_edit_client_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->cm->fetch_edit_client_type($id);
			echo json_encode($res);
		}
	}

	public function edit_client_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$client_type = $this->input->post("client_type");
    		$id = $this->input->post("id");

    		$data = array("client_type" => $client_type);
    		$this->cm->edit_client_type($id, $data);

    		echo "Success";
    	}
	}

	public function delete_client_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
			$id = $this->input->post("id");
			$this->cm->delete_client_type($id);
    	}
	}
	
	// Bussiness Type //
	
	public function bussiness_type()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["users"]=$this->cm->fetch_users();
    		$this->load->view('header',$pro_data);
    		$this->load->view('bussiness_type',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $data["users"] = $this->cm->fetch_user_by_session_id($this->session->userdata('session_id'));
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('bussiness_type',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}
	
	public function fetch_bussiness_type()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->cm->fetch_bussiness_type();
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<button class='btn btn-info btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i></button> ";
            
            $arr[] = array(
                $a,
                $da->bussiness_type,
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

	public function add_bussiness_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$bussiness_type = $this->input->post("bussiness_type");

    		$data = array("bussiness_type" => $bussiness_type);
    		$this->cm->add_bussiness_type($data);

    		echo "Success";
    	}
	}

	public function fetch_edit_bussiness_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->cm->fetch_edit_bussiness_type($id);
			echo json_encode($res);
		}
	}

	public function edit_bussiness_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$bussiness_type = $this->input->post("bussiness_type");
    		$id = $this->input->post("id");

    		$data = array("bussiness_type" => $bussiness_type);
    		$this->cm->edit_bussiness_type($id, $data);

    		echo "Success";
    	}
	}

	public function delete_bussiness_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
			$id = $this->input->post("id");
			$this->cm->delete_bussiness_type($id);
    	}
	}
	
	
		// Policy Type //
		
	public function policy_type()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	
		   	$data["class"] = $this->cm->fetch_policy_class();
		   	$data["users"]=$this->cm->fetch_users();
            $data["fuel_types"] = $this->cm->fetch_fuel_types();

    		$this->load->view('header',$pro_data);
    		$this->load->view('policy_type',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $data["users"] = $this->cm->fetch_user_by_session_id($this->session->userdata('session_id'));
	        
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();

            $data["fuel_types"] = $this->cm->fetch_fuel_types();
            
    		$this->load->view('header',$pro_data);
    		$this->load->view('policy_type',$data);
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

    public function fetch_car_fuel_types()
    {
        if ($this->session->has_userdata('logged_in')) {
            $this->db->select('id, fuel_type');
            $this->db->from('list_of_car_fuel_type');
            $this->db->order_by('fuel_type', 'ASC');
            $query = $this->db->get();

            echo json_encode($query->result());
        }
    }

	
	public function fetch_policy_type()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    		$draw = intval($this->input->post("draw"));
    		$res = array();
		    $res = $this->cm->fetch_policy_type();
		
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;
        	
        	$check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
        	
           $action = "";
        	
        	if($check_user_i->masters_edit == "1")
	        {
            $action .= "<button class='btn btn-info btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i></button>";
	        }
            
            $arr[] = array(
                $a,
                $da->class,
                $da->policy_type,
                ($da->fuel_type_name != "" ? $da->fuel_type_name : "-"),
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

	public function add_policy_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	    
	        if($check_user_i->masters_add == "1")
	        {
        		$policy_type = $this->input->post("policy_type");
                $policy_class = $this->input->post("policy_class");
                $fuel_type = $this->input->post("fuel_type");
                
        		$data = array("policy_class" =>$policy_class,"policy_type" => $policy_type,"fuel_type_id" => $fuel_type);
        		$res = $this->cm->add_policy_type($data);
        		if( $res ) {
    	            $this->audit->log('list_of_policy_type', 'INSERT', null, null, $data);
    	        }
        		 echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='policy_type';</script>";
	        }
    	}
	}

	public function fetch_edit_policy_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->cm->fetch_edit_policy_type($id);
			echo json_encode($res);
		}
	}

	public function edit_policy_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	    
    	    if($check_user_i->masters_edit == "1")
	        {
            		$policy_type = $this->input->post("policy_type");
            		$policy_class = $this->input->post("policy_class");
                    $fuel_type    = $this->input->post("fuel_type");
            		$id = $this->input->post("id");
        
            		$data = array("policy_class"=>$policy_class,"policy_type" => $policy_type, "fuel_type_id" => $fuel_type);
            		$old_data = $this->cm->fetch_edit_policy_type($id);
            		$res = $this->cm->edit_policy_type($id, $data);
            		if( $res ) {
        	            $this->audit->log('list_of_policy_type', 'UPDATE', null, $old_data, $data);
        	        }
        
            		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='policy_type';</script>";
	        }
    	}
	}

	public function delete_policy_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
			$id = $this->input->post("id");
			$this->cm->delete_policy_type($id);
    	}
	}
	
	// Email 
	
	public function email_template()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        	{    		
    		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		   	
    		   	$data["class"] = $this->cm->fetch_policy_class();
    		   	
    		   	$data["users"]=$this->cm->fetch_users();
        		$this->load->view('header',$pro_data);
        		$this->load->view('email_template',$data);
        		$this->load->view('footer',$pro_data);
    	    }
    	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
    	    {
    	        $data["users"] = $this->cm->fetch_user_by_session_id($this->session->userdata('session_id'));
    	        
        	   $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
        	   
    	        if($check_user_i->email_view == "1")
    	        {
        	        $pro_data["project_info"] = $this->mm->fetch_project_info();
            		$this->load->view('header',$pro_data);
            		$this->load->view('email_template',$data);
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
	}
	
	public function add_email_template()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	  
	        if($check_user_i->email_add == "1")
	        {  
        		$title = $this->input->post("title");
        		$subject = $this->input->post("subject");
        		$message = $this->input->post("message");
                
        		$data = array("template_name" => $title,"subject"=>$subject,"Message"=>$message);
        		$res = $this->cm->add_email_template($data);
        		if( $res ) {
    	            $this->audit->log('email_templates', 'INSERT', null, null, $data);
    	        }
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='email_template';</script>";
	        }
    	}
	}
	
	public function fetch_email_templates()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
            	$draw = intval($this->input->post("draw"));

        		$res = $this->cm->fetch_email_templates();
        	
        		$arr = [];
                $a = 0 ;
                
                foreach($res as $da)
                {
                	$a++;
                	
                	
                	$check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
                	
                	$action = "";
                	
                    if($check_user_i->email_edit == "1")
        	        {
        	             $action .= "<button class='btn btn-info btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i></button> &nbsp;";
        	             
        	             $action .= "<button class='btn btn-success btn-xs' onclick=send_email(".$da->id.")><i class='fa fa-paper-plane'></i> </button>";
        	        }
        	        
        	        if($check_user_i->email_delete == "1")
        	        {
        	            $action .= "<button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> </button>";
        	        }

                    $arr[] = array(
                        $a,
                        $da->template_name,
                        $da->subject,
                        $da->Message,
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
	
	public function fetch_edit_email_templates()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->cm->fetch_edit_email_templates($id);
			echo json_encode($res);
		}
	}
	
	public function edit_email_template()
	{
		if($this->session->has_userdata('logged_in')) 
    	{

        	    $id = $this->input->post("id");
        		$title = $this->input->post("title");
        		$subject = $this->input->post("subject");
        		$message = $this->input->post("message");
                
        		$data = array("template_name" => $title,"subject"=>$subject,"Message"=>$message);
        		$old_data = $this->cm->fetch_edit_email_templates($id);
        		$res = $this->cm->edit_email_template($data,$id);
        		if( $res ) {
    	            $this->audit->log('email_templates', 'UPDATE', null, $old_data, $data);
    	        }
        		echo "Success";
             
    	}
	}
	
	public function delete_email_template()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	   // echo "<pre>"; print_r($check_user_i); exit;
    	     if($check_user_i->email_delete == "1")
             {
    			$id = $this->input->post("id");
    			$old_data = $this->cm->fetch_edit_email_templates($id);
    			$res = $this->cm->delete_email_template($id);
    			if( $res ) {
    	            $this->audit->log('email_templates', 'DELETE', null, $old_data, null);
    	        }
             }
             else
             {
                 echo "<script>alert('Permission Denied');window.location.href='email_template';</script>";
             }
    	}
	}
	
	
	public function send_mail_to_all_customers()
	{
	    if($this->session->has_userdata('logged_in'))
        {
            $this->load->library('email');
             
            $id = $this->input->post("id");
            $res = $this->cm->fetch_email_template($id);
            $data = $this->cm->fetch_customer_details();
            $this->email->from($this->session->userdata('session_email_id'),$this->session->userdata('session_name'));
            
            foreach($data as $da)
            {
                $this->email->to($da->email);
            	$this->email->set_mailtype("html");
            	$this->email->subject($res->subject);
            	$this->email->message($res->Message);
            	$this->email->send();
            }
        }
	}
	
	public function motor_category()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        	{    		
    		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		   	$data["class"] = $this->cm->fetch_policy_class();
    		   	$data["users"]=$this->cm->fetch_users();
        		$this->load->view('header',$pro_data);
        		$this->load->view('motor_category',$data);
        		$this->load->view('footer',$pro_data);
    	    }
    	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
    	    {
        	   $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	   
    	        if($check_user_i->masters_view == "1")
    	        {
        	        $data["users"] = $this->cm->fetch_user_by_session_id($this->session->userdata('session_id'));
        	        $pro_data["project_info"] = $this->mm->fetch_project_info();
            		$this->load->view('header',$pro_data);
            		$this->load->view('motor_category',$data);
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
	}
	
	public function add_motor_category()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	   
    	        if($check_user_i->masters_add == "1")
    	        {
            	    $motor_category = $this->input->post("motor_category");
        
            		$data = array("motor_category"=>$motor_category);
            		
            		$this->cm->add_motor_category($data);
        
            		echo "Success";
    	        }
    	        else
    	        {
    	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
    	        }
    	}
	}
	
	public function fetch_motor_category()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
		$draw = intval($this->input->post("draw"));
		$res = array();
	    $res = $this->cm->fetch_motor_category();

		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;
        	
        	$action = "";
          
              $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	   
    	        if($check_user_i->masters_edit == "1")
    	        {
                    $action .= "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i></button>";
    	        }
    	        
            $arr[] = array(
                $a,
                $da->motor_category,
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
      
    public function fetch_edit_motor_category()
    {
        if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->cm->fetch_edit_motor_category($id);
			echo json_encode($res);
		}
    }
    
    public function edit_motor_category()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	   
    	        if($check_user_i->masters_edit == "1")
    	        {
            		$motor_category = $this->input->post("motor_category");
            		$id = $this->input->post("id");
        
            		$data = array("motor_category" => $motor_category);
            		$this->cm->edit_motor_category($id, $data);
            		echo "Success";
    	        }
    	        else
    	        {
    	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
    	        }
    	}
	}
	
	// gvw
	
    public function motor_gvw()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        	{    		
    		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		   	$data["class"] = $this->cm->fetch_policy_class();
    		   	$data["users"]=$this->cm->fetch_users();
    		   	$data["policy_type"] = $this->cm->fetch_policy_type_1();
        		$this->load->view('header',$pro_data);
        		$this->load->view('motor_gvw',$data);
        		$this->load->view('footer',$pro_data);
    	    }
    	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
    	    {
    	        
    	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	   
    	        if($check_user_i->masters_view == "1")
    	        {
        	        $data["users"] = $this->cm->fetch_user_by_session_id($this->session->userdata('session_id'));
        	        $data["policy_type"] = $this->cm->fetch_policy_type_1();
        	        $pro_data["project_info"] = $this->mm->fetch_project_info();
            		$this->load->view('header',$pro_data);
            		$this->load->view('motor_gvw',$data);
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
	}
	
	public function add_motor_gvw()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	    
    	        if($check_user_i->masters_add == "1")
    	        {
            	    $motor_category = $this->input->post("motor_category");
                    $add_fr_gvw = $this->input->post("add_fr_gvw");
                    $add_to_gvw = $this->input->post("add_to_gvw");
                    $classification = $this->input->post("classification");
                    
                    for($i=0;$i<count($motor_category);$i++)
                    {
                        	$data = array("motor_category_id"=>$motor_category[$i],"from_gvw_cc"=>$add_fr_gvw,"to_gvw_cc"=>$add_to_gvw,"classification"=>$classification);
            		        $res = $this->cm->add_motor_gvw($data);
            		        if( $res ) {
                	            $this->audit->log('commission_motor_gvw', 'INSERT', null, null, $data);
                	        }
                    }
            		echo "Success";
    	        }
    	        else
    	        {
    	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
    	        }
    	}
	}
	
	public function fetch_motor_gvw()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
		$draw = intval($this->input->post("draw"));
		$res = array();
	    $res = $this->cm->fetch_motor_gvw();

		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;
        	
        	$action = "";
        	
        	 $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	    
    	        if($check_user_i->masters_edit == "1")
    	        {
                      $action .= "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i></button>
                      <button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i></button>";
    	        }
            
            $arr[] = array(
                $a,
                $da->policy_type,
                $da->from_gvw_cc.$da->classification."-".$da->to_gvw_cc.$da->classification,
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
	
	public function fetch_edit_motor_gvw()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->cm->fetch_edit_motor_gvw($id);
			echo json_encode($res);
		}
	}
	
	
	public function edit_motor_gvw()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	    
    	        if($check_user_i->masters_edit == "1")
    	        {
        		$motor_category = $this->input->post("motor_category");
        		$edit_fr_gvw = $this->input->post("edit_fr_gvw");
        		$edit_to_gvw = $this->input->post("edit_to_gvw");
        		$edit_classification = $this->input->post("edit_classification");
            		
            		$id = $this->input->post("id");
        
            		$data = array(
                    		    "motor_category_id" => $motor_category,
                    		    "from_gvw_cc"=>$edit_fr_gvw,
                    		    "to_gvw_cc" => $edit_to_gvw,
                    		    "classification" =>$edit_classification);
                    $old_data = $this->cm->fetch_edit_motor_gvw($id);
                    
            		$res = $this->cm->edit_motor_gvw($id, $data);
            		if( $res ) {
        	            $this->audit->log('commission_motor_gvw', 'UPDATE', null, $old_data, $data);
        	        }
            		echo "Success";
    	        }
    	        else
    	        {
    	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
    	        }
    	}
	}
	
	public function delete_motor_sub_category()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
			$id = $this->input->post("id");
			$old_data = $this->cm->fetch_edit_motor_gvw($id);
			$res = $this->cm->delete_motor_sub_category($id);
			if( $res ) {
	            $this->audit->log('commission_motor_gvw', 'DELETE', null, $old_data, null);
	        }
    	}
	}
	
	// Commission category List
	
	public function commission_category()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        	{    		
    		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
        		$this->load->view('header',$pro_data);
        		$this->load->view('commision_category');
        		$this->load->view('footer',$pro_data);
    	    }
    	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
    	    {
    	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	        
    	        if($check_user_i->masters_view == "1")
    	        {
        	        $pro_data["project_info"] = $this->mm->fetch_project_info();
            		$this->load->view('header',$pro_data);
            		$this->load->view('commision_category');
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
	}
	
	
	public function fetch_commission_category()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
        		$draw = intval($this->input->post("draw"));
        		
        		$res = array();
        
        		if($this->session->has_userdata('logged_in')) 
            	{
        			$res = $this->cm->fetch_commission_category();
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
                    $action .= "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i></button> ";
    	        }
            	        
                    $arr[] = array(
                        $a,
                        $da->category,
                        $da->from_amt,
                        $da->to_amt,
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

	public function fetch_commission_edit_category()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->cm->fetch_commission_edit_category($id);
			echo json_encode($res);
		}
	}

	public function edit_commission_category()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	   $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	        
    	        if($check_user_i->masters_edit == "1")
    	        {
            		$category_name = $this->input->post("category_name");
            		$min_value = $this->input->post("min_amt");
            		$max_value = $this->input->post("max_amt");
            		$id = $this->input->post("id");
            		
            		$status = "0";
            		
            		$res = $this->cm->fetch_commission_list($id);
            		
            		foreach($res as $da)
            		{
            		    $temp_min = $da->from_amt;
            		    $temp_max = $da->to_amt;
            		    
            		    if($temp_min <= $min_value && $temp_max >= $min_value)
        				{
        					$status = "1";
        					break;
        				}
        				if($temp_min <= $max_value && $temp_max >= $max_value)
        				{
        					$status = "1";
        					break;
        				}
        				if($temp_min > $min_value && $temp_max < $max_value)
        				{
        					$status = "1";
        					break;
        				}
            		}
            		
            		if($status == "0")
            		{
            		    $data = array("category" => $category_name,"from_amt"=>$min_value,"to_amt"=>$max_value,"updated_by"=>$this->session->userdata("session_id"),"updated_date"=>date("Y-m-d H:i:s"));
            		    $old_data = $this->cm->fetch_commission_edit_category($id);
            		    $res = $this->cm->edit_commission_category($id, $data);
            		    if( $res ){
            		        $this->audit->log('commission_paid_category', 'UPDATE', null, $old_data, $data);
            		    }
            		    echo "Success";
            		}
            		else 
            		{
            		    echo "Matched";
            		}
            	}
            	else
            	{
            	    echo "<script>alert('Permission Denied');window.location.href='home';</script>";
            	}
    	}
	}
	
	// payout commssion
	
	public function payout_commission()
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
        		$this->load->view('header',$pro_data);
        		$this->load->view('payout_commission',$data);
        		$this->load->view('footer',$pro_data);
    	    }
    	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
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
            		$this->load->view('header',$pro_data);
            		$this->load->view('payout_commission',$data);
            		$this->load->view('footer',$pro_data);
    	        }
    	        else
    	        {
    	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
    	        }
    	    }
    	}
	}
	
	public function fetch_load_sub_category()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $commission_category = $this->input->post("ins_category");
    	    $res =$this->cm->fetch_load_sub_category($commission_category);
    	    echo json_encode($res);
    	}
	}
	
	public function add_payout_commission()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	    
	        if($check_user_i->masters_add == "1")
	        {
    	    $insurer_company =  $this->input->post("insurer_company");
    	    $policy_premium_type = $this->input->post("policy_premium_type");
    	    $class = $this->input->post("insurer_class");
    	    $business_type = $this->input->post("business_type");
    	    $commission_type = $this->input->post("commission_type");
    	    $ins_rto = $this->input->post("ins_rto");
    	    $category = $this->input->post("category");
    	    $product = $this->input->post("product");
    	    $state = $this->input->post("state");
    	    $vehicle_age_min = $this->input->post("vehicle_age_min");
    	    $vehicle_age_max = $this->input->post("vehicle_age_max");
    	    $discount = $this->input->post("discount");
    	    $own_od = $this->input->post("own_od");
    	    $own_tp = $this->input->post("own_tp");
    	    $on_net = $this->input->post("on_net");
    	    $gold_category = $this->input->post("gold_category");
    	    $silver_category = $this->input->post("silver_category");
    	    $bronze_category = $this->input->post("bronze_category");
    	    // 
    	    $min_val = $this->input->post("min_val");
    	    $max_val = $this->input->post("max_val");
    	    $no_of_policy = $this->input->post("no_of_policy");
    	    
    	    $old_rto = $this->input->post("old_rto");
    	    
    	    $irdi_commission = 0;
    	    
    	    $com_policy_id = "";
    	    
    	    $com_net_premium_id = "";

    	    $status = 0;
    	    
    	    if($class == "1"  && $commission_type == "1")
    	    {
    	        $rto_status = 0;
    	        $no_policy = $this->cm->check_no_policy($insurer_company,$policy_premium_type,$class,$business_type,$commission_type,$category,$product,$state);
    	        $check = $this->cm->check_no_of_policy_already_exits($insurer_company,$policy_premium_type,$class,$business_type,$commission_type,$category,$product,$state,$no_of_policy);
    	        
    	            if(count($check) > 0)
    	            {
    	                $status = "1";
    	            }
    	            
    	            if($status == "1")
                    {
                        $status = 0 ;
                        
                        for($i = 0;$i<count($ins_rto);$i++)
                        {
                            foreach($no_policy as $da)
                            {
                                    $check_all_rto = $this->cm->check_all_rto($da->id);
                                    
                                    $check_tn = $this->cm->check_all_tn($da->id);
                                    
                                        if($check_all_rto == true)
                                        {
                                            $status = "1";
                                            $rto_status = "1";
                                            break;
                                        }
                                        else if($check_tn == true)
                                        {
                                            $status = "1";
                                            $rto_status = "1";
                                            break;
                                        }
                                        else
                                        {
                                            $check_rto = $this->cm->check_rto_by_payout_commission_id($da->id,$ins_rto[$i]);
                                            
                                            if($check_rto)
                                            {
                                                $status = "1";
                                                $rto_status = "1";
                                                break ;
                                            }
                                        }
                             }
                        }
                        
                        $irdi_commission = "15";
                    }
               
                    if(count($no_policy) > 0 && $rto_status != "1" && count($check) > 0)
                     {
                            $last_policy_id = $this->cm->get_last_policy_id();
                                    
                            if($last_policy_id->policy_id == "")
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
                                $insert = $this->cm->add_policy_id($arr);
                            }
                     }
                    else if(count($check) == 0 && $rto_status =="0" && count($no_policy) > 0)
                    {
                            foreach($no_policy as $da)
            	            {
            	                $no_policy_id = $da->no_of_policy_id;
            	            }
                    		
                    		$check_policy_id = $this->cm->check_policy_id_already_exits($no_policy_id);
            	            
            	            if($check_policy_id != "" || $check_policy_id != null)
            	            {
            	                $com_policy_id = $check_policy_id->policy_id;
            	            }
                    }
                    else if(count($no_policy) == 0 && count($check) == 0)
                    {
                        $last_policy_id = $this->cm->get_last_policy_id();
                            
                        if($last_policy_id->policy_id == "")
                        {
                            $max_policy_id = 1; // ✅ initialize variable
                            $com_policy_id = $max_policy_id;
                            $arr = array("policy_id" => $max_policy_id);
                            $insert = $this->cm->add_policy_id($arr);
                        }
                        else
                        {
                            $max_policy_id = $last_policy_id->policy_id;
                            $com_policy_id = $max_policy_id+1;
                            $arr = array("policy_id" => $com_policy_id);
                            $insert = $this->cm->add_policy_id($arr);
                        }
                    }
                    
                     $irdi_commission = "15";
    	    }
    	    
    	    else if($class == "1"  && $commission_type == "2")
    	    {
    	          $check = $this->cm->check_vechi_age_already_exits($insurer_company,$policy_premium_type,$class,$business_type,$commission_type,$category,$product,$state);
    	         
            	    foreach($check as $da)
            		{
            		    $temp_min = $da->vehicle_age_min;
            		    $temp_max = $da->vehicle_age_max;
            		    	$commission_id = $da->id;
            		    if($temp_min <= $vehicle_age_min && $temp_max >= $vehicle_age_min)
        				{
        					$status = "1";
        					break;
        				}
        				if($temp_min <= $vehicle_age_max && $temp_max >= $vehicle_age_max)
        				{
        					$status = "1";
        					break;
        				}
        				if($temp_min > $vehicle_age_min && $temp_max < $vehicle_age_max)
        				{
        					$status = "1";
        					break;
        				}
        				
        			
            		}
            	 
                if(in_array("Rest_of_tamilnadu", $ins_rto))
                {
                    $old_rto = $this->cm->get_rto_list_not_in_old_rto_commission_id($commission_id);
                    
                   
                    $old_rto_1[] = "";
                    
                    foreach($old_rto as $da)
                    {
                        $old_rto_1[] =$da->rto;
                    }
                    $rto_list = $this->cm->get_rto_list_not_in_old_rto($old_rto_1);
                    $ins_rto = $rto_list;
                }
                else
                {
                        if($status == "1")
                        {
                        $status = 0 ;
                        
                        for($i = 0;$i<count($ins_rto);$i++)
                        {
                        foreach($check as $da)
                        {
                        $check_all_rto = $this->cm->check_all_rto($da->id);
                        
                         $check_tn = $this->cm->check_all_tn($da->id);
                        
                            if($check_all_rto == true)
                            {
                                $status = "1";
                                $rto_status = "1";
                                break;
                            }
                            else if($check_tn == true)
                            {
                                $status = "1";
                                $rto_status = "1";
                                break;
                            }
                            else
                            {
                                $check_rto = $this->cm->check_rto_by_payout_commission_id($da->id,$ins_rto[$i]);
                                
                                if($check_rto)
                                {
                                    $status = "1";
                                    $rto_status = "1";
                                    break ;
                                }
                            }
                        }
                        }
                        }
                }
            	        
                    $irdi_commission = "15";
    	    }
    	    
    	    else if($class == "1"  && $commission_type == "3")
    	    {
    	          $check = $this->cm->check_min_max_val_already_exits($insurer_company,$policy_premium_type,$class,$business_type,$commission_type,$category,$product,$state);
    	          
    	          $rto_status = 0;
    	          $temp_status = 0;
    	          
            	    foreach($check as $da)
            		{
            		    $temp_min = $da->min_val;
            		    $temp_max = $da->max_val;
            		    
            		    if($temp_min <= $min_val && $temp_max >= $min_val)
        				{
        				    $temp_status = "1";
        					$status = "1";
        					break;
        				}
        				if($temp_min <= $max_val && $temp_max >= $max_val)
        				{
        				    $temp_status = "1";
        					$status = "1";
        					break;
        				}
        				if($temp_min > $min_val && $temp_max < $max_val)
        				{
        				    $temp_status = "1";
        					$status = "1";
        					break;
        				}
            		}

            		
                    if($status == "1")
                    {
                        $status = 0 ;
                        
                        for($i = 0;$i<count($ins_rto);$i++)
                        {
                            foreach($check as $da)
                            {
                                     $check_all_rto = $this->cm->check_all_rto($da->id);
                                     
                                     $check_tn = $this->cm->check_all_tn($da->id);
                                    
                                        if($check_all_rto == true)
                                        {
                                            $status = "1";
                                            $rto_status = "1";
                                            break;
                                        }
                                        else if($check_tn == true)
                                        {
                                            $status = "1";
                                            $rto_status = "1";
                                            break;
                                        }
                                        else
                                        {
                                            $check_rto = $this->cm->check_rto_by_payout_commission_id($da->id,$ins_rto[$i]);
                                            
                                            if($check_rto)
                                            {
                                                $status = "1";
                                                $rto_status = "1";
                                                break ;
                                            }
                                        }
                             }
                        }
                    }
                   
                    if(count($check) > 0 && $rto_status != "1" && $temp_status == "1")
                    {
                           $last_net_id = $this->cm->get_last_net_premium_id();
                            
                            if($last_net_id->net_premium_id == "")
                            {
                                $com_net_premium_id = "1";
                                $arr = array("net_premium_id" => $com_net_premium_id);
                                $insert = $this->cm->add_net_premium_id($arr);
                            }
                            else
                            {
                                $max_net_premium_id = $last_net_id->net_premium_id;
                                $com_net_premium_id = $max_net_premium_id+1;
                                $arr = array("net_premium_id" => $com_net_premium_id);
                                $insert = $this->cm->add_net_premium_id($arr);
                            }
                    }
                    else if($temp_status == "0" && $rto_status =="0" && count($check) > 0)
                    {
                        foreach($check as $da)
                    	{
                    	     $check_net_premium_id = $this->cm->check_net_premium_id_already_exits($da->net_premium_id);
                    	}
                        
                        if($check_net_premium_id != "")
                        {
                            $com_net_premium_id = $check_net_premium_id->net_premium_id;
                        }
                    }
                    
                    else if(count($check) == 0 && $temp_status == 0)
                    {
                        $last_net_id = $this->cm->get_last_net_premium_id();
                                
                        if($last_net_id->net_premium_id == "")
                        {
                            $com_net_premium_id = "1";
                            $arr = array("net_premium_id" => $com_net_premium_id);
                            $insert = $this->cm->add_net_premium_id($arr);
                        }
                        else
                        {
                            $max_net_premium_id = $last_net_id->net_premium_id;
                            $com_net_premium_id = $max_net_premium_id+1;
                            $arr = array("net_premium_id" => $com_net_premium_id);
                            $insert = $this->cm->add_net_premium_id($arr);
                        }
                    }
             }

    	    else if($class == "2"  && $commission_type == "1")
    	    {
            	   $no_policy = $this->cm->check_no_policy($insurer_company,$policy_premium_type,$class,$business_type,$commission_type);
            	   $check = $this->cm->check_no_of_policy_health_already_exits($insurer_company,$policy_premium_type,$class,$business_type,$commission_type,$no_of_policy);
                    
                    if(count($check) > 0)
                    {
                        $status = "1";
                    }
                    else
                    {
                        $no_policy_id = "";
                        
            	            foreach($no_policy as $da)
            	            {
            	                $no_policy_id = $da->no_of_policy_id;
            	            }
        
            	            $check_policy_id = $this->cm->check_policy_id_already_exits($no_policy_id);
            	            
            	            if($check_policy_id != "" || $check_policy_id != null)
            	            {
            	                $com_policy_id = $check_policy_id->policy_id;
            	            }
            	            else
            	            {
            	                $last_policy_id = $this->cm->get_last_policy_id();
            	                
            	                if($last_policy_id->policy_id == "")
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
            	                    $insert = $this->cm->add_policy_id($arr);
            	                }
            	            }
            	        }
            }

    	    else if($class == "2"  && $commission_type == "3")
    	    {
    	          $check = $this->cm->check_health_min_max_val_already_exits($insurer_company,$policy_premium_type,$class,$business_type,$commission_type);
    	         
            	    foreach($check as $da)
            		{
            		    $temp_min = $da->min_val;
            		    $temp_max = $da->max_val;
            		    
            		    $net_premium_id = $da->net_premium_id;
            		    
            		    if($temp_min <= $min_val && $temp_max >= $min_val)
        				{
        					$status = "1";
        					break;
        				}
        				if($temp_min <= $max_val && $temp_max >= $max_val)
        				{
        					$status = "1";
        					break;
        				}
        				if($temp_min > $min_val && $temp_max < $max_val)
        				{
        					$status = "1";
        					break;
        				}
            		}
            	
            		$check_net_premium_id = "";
            		
            		foreach($check as $da)
            		{
            		     $check_net_premium_id = $this->cm->check_net_premium_id_already_exits($da->net_premium_id);
            		}
            	            
            	            if($check_net_premium_id != "")
            	            {
            	                $com_net_premium_id = $check_net_premium_id->net_premium_id;
            	            }
            	            else
            	            {
            	                $last_net_id = $this->cm->get_last_net_premium_id();
            	                
            	                if($last_net_id->net_premium_id == "")
            	                {
            	                    $com_net_premium_id = "1";
            	                    $arr = array("net_premium_id" => $com_net_premium_id);
            	                    $insert = $this->cm->add_net_premium_id($arr);
            	                }
            	                else
            	                {
            	                    $max_net_premium_id = $last_net_id->net_premium_id;
            	                    $com_net_premium_id = $max_net_premium_id+1;
            	                    $arr = array("net_premium_id" => $com_net_premium_id);
            	                    $insert = $this->cm->add_net_premium_id($arr);
            	                }
            	            }
    	      }
    	   
        	  if($status != "1")
        	  {
            	  $data = array(
            	    "insurer_company" =>$insurer_company,
            	    "policy_premium_type" =>$policy_premium_type,
            	    "class" =>$class,
            	    "business_type" =>$business_type,
            	    "commission_type"=>$commission_type,
            	    "vehicle_age_min" =>$vehicle_age_min,
            	    "discount"=>$discount,
            	    "category"=>$category,
            	    "product"=>$product,
            	    "state"=>$state,
            	    "vehicle_age_max" => $vehicle_age_max,
            	    "own_od" =>$own_od,
            	    "own_tp" =>$own_tp,
            	    "on_net"=>$on_net,
            	    "irdi_commission" => $irdi_commission,
            	    "gold_category" => $gold_category,
            	    "silver_category" =>$silver_category,
            	    "bronze_category"=>$bronze_category,
            	    "min_val" =>$min_val,
            	    "max_val" =>$max_val,
            	    "no_of_policy"=>$no_of_policy,
            	    "no_of_policy_id" => $com_policy_id,
            	    "net_premium_id" => $com_net_premium_id,
            	    "created_by" =>$this->session->userdata("session_id"),
            	    "created_time" =>date("Y-m-d H:i:s"),
        	    ); 
        	   
        	    $res = $this->cm->add_payout_commission($data);
        	    
        	   if($ins_rto != null || $ins_rto !="")
        	   {
            	        if(in_array("Rest_of_tamilnadu", $ins_rto))
            	        {
                	           $get_rto_list = $this->cm->get_rto_list_not_in_old_rto($old_rto);
                	           
                	           foreach($get_rto_list as $da)
                	           {
                	               $arr = array(
                    	                        "commission_id" =>$res,
                    	                        "rto" =>$da->rto_no,
                    	                        "created_time" => date("Y-m-d H:i:s"),
                        	                   );
                        	      $add_rto = $this->cm->add_rto_list($arr);    
                	           }
            	        }
            	        else
            	        {
                            for($i =0;$i<count($ins_rto);$i++)
                            {
                                   $arr = array(
                                                "commission_id" =>$res,
                                                "rto" =>$ins_rto[$i],
                                                "created_time" => date("Y-m-d H:i:s"),
                                               );
                                  $add_rto = $this->cm->add_rto_list($arr);             
                            }
            	       }
                }

                $data_log = array(
                                    "payout_id" =>$res,
                                    "action" =>"Add New Payout",
                                    "ins_company"=>$insurer_company,
                                    "created_by"=>$this->session->userdata("session_id"),
                                    "created_date"=>date("Y-m-d H:i:s"),
                                    );
                 
                 $log = $this->cm->add_payout_log($data_log);
                 
                
                   if($class == "1")
                   {
                        $get_info = $this->cm->get_commission_info($res);
                        echo json_encode($get_info);
                   }
                   else
                   {
                        $get_info = $this->cm->get_commission_info_health($res);
                        echo json_encode($get_info);
                   }
        	  }
        	  else
        	  {
        	      echo "exits";
        	  }
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
	}
	
	
	public function fetch_payout_commission()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    
        	$draw = intval($this->input->post("draw"));
        	
			$res = $this->cm->fetch_payout_commission();
	
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

            $arr[] = array(
                $a,
                $view,
                $da->premium_name,
                $da->m_gvw,
                $da->commission_state,
                $da->own_od,
                $da->own_tp,
                $da->on_net,
                $da->gold_category,
                $da->silver_category,
                $da->bronze_category,
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
       
   // search 
   
        public function fetch_payout_commission_search()
        {
                if($this->session->has_userdata('logged_in')) 
                {
                $draw = intval($this->input->post("draw"));
                $insurer = $this->input->post('insurer');
                $premium_type = $this->input->post('premium_type');
                $business_type = $this->input->post('business_type');
                $commission_type = $this->input->post('commission_type');
                
                $res = $this->cm->fetch_payout_commission_search($insurer,$premium_type,$business_type,$commission_type);
                
                $arr = [];
                $a = 0 ;
                
                foreach($res as $da)
                {
                $a++;
                
                $action = "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> </button> 
                	 <button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> </button>";
                
                $arr[] = array(
                $a,
                $da->company_name,
                $da->premium_name,
                $da->m_gvw,
                $da->commission_state,
                $da->own_od,
                $da->own_tp,
                $da->on_net,
                $da->gold_category,
                $da->silver_category,
                $da->bronze_category,
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
   
       public function fetch_all_pos()
       {
           if($this->session->has_userdata('logged_in')) 
        	{
        	    $res = $this->cm->fetch_all_pos();
        	    echo json_encode($res);
        	}
       }
       
      
        public function fetch_payout_commission_health()
    	{
    	    if($this->session->has_userdata('logged_in')) 
        	{
            	$draw = intval($this->input->post("draw"));
            	
    			$res = $this->cm->fetch_payout_commission_health();
    	
    		$arr = [];
            $a = 0 ;
            
            foreach($res as $da)
            {
            	$a++;
            	
            	if($da->min_val != "")
            	{
            	    $min_val = number_format($da->min_val,2);
            	}
            	else
            	{
            	    $min_val = "";
            	}
            	
            	if($da->max_val != "")
            	{
            	    $max_val = number_format($da->max_val,2);
            	}
            	else
            	{
            	    $max_val = "";
            	}
            	
            	if($da->no_of_policy != "")
            	{
            	    $no_of_policy = $da->no_of_policy;
            	}
            	else
            	{
            	    $no_of_policy = "";
            	}
            
            
            $action = "";
            
            $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
           
	        if($check_user_i->masters_edit == "1")
	        {
	            $action .= "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> </button>";
	        }
	        
	        if($check_user_i->masters_delete == "1")
	        {
	            $action .= "<button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> </button>";
	        }
    
                $view = "<a href='#' onclick='view_data(".$da->id.")'> ".$da->company_name."</a>";
                
                $arr[] = array(
                    $a,
                    $view,
                    $da->premium_name,
                    $da->c_type,
                    $min_val,
                    $max_val,
                    $no_of_policy,
                    $da->on_net,
                    $da->gold_category,
                    $da->silver_category,
                    $da->bronze_category,
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
   
   
       public function fetch_commission_details()
       {
           if($this->session->has_userdata('logged_in')) 
        	{
        	    $id = $this->input->post("id");
        	    
        	    $info = $this->cm->get_policy_class($id);
        	    
        	    if($info->class == "1")
        	    {
        	        $res = $this->cm->fetch_commission_details_motor($id);
        	        
        	        $rto_details = $this->cm->fech_rto_details($id);
        	    }
        	    else if($info->class == "2")
        	    {
        	        $res = $this->cm->fetch_commission_details_health($id);
        	    }
        	    
        	    $content = "<style>.wrap-it{
                                            word-wrap: break-word;
                                            }</style>";
        	    
        	    $content .="<div class='row'>";
        	       $content .="<div class='col-md-6'>";
        	       
        	          $content .="<div class='form-group'>
        	                         <div class='row'>
        	                           <div class='col-md-4'>
        	                               <label>Insurer</label>
        	                           </div>
        	                           
        	                           <div class='col-md-8'>
        	                               <p>".$res->company_name."</p>
        	                           </div>
        	                       </div>
        	                   </div>";
        	                   
    	                   $content .="<div class='form-group'>
    	                         <div class='row'>
    	                           <div class='col-md-4'>
    	                               <label>Premium Type</label>
    	                           </div>
    	                           
    	                           <div class='col-md-8'>
    	                               <p>".$res->premium_name."</p>
    	                           </div>
    	                       </div>
    	                   </div>";
    	             
    	           if($res->class == "1")
                   {      
    	                   $content .="<div class='form-group'>
    	                         <div class='row'>
    	                           <div class='col-md-4'>
    	                               <label>Motor Category</label>
    	                           </div>
    	                           
    	                           <div class='col-md-8'>
    	                               <p>".$res->mcategory."</p>
    	                           </div>
    	                       </div>
    	                   </div>";
    	                  
    	                   $content .="<div class='form-group'>
    	                         <div class='row'>
    	                           <div class='col-md-4'>
    	                               <label>Motor Classification</label>
    	                           </div>
    	                           
    	                           <div class='col-md-8'>
    	                               <p>".$res->m_gvw."</p>
    	                           </div>
    	                       </div>
    	                   </div>";
                   }      
    	                   $content .="<div class='form-group'>
    	                         <div class='row'>
    	                           <div class='col-md-4'>
    	                               <label>Commission Type</label>
    	                           </div>
    	                           
    	                           <div class='col-md-8'>
    	                               <p>".$res->c_type."</p>
    	                           </div>
    	                       </div>
    	                   </div>";
    	                   
    	                   
    	                   if($res->commission_type == "1")
    	                   {
    	                   $content .="<div class='form-group'>
    	                         <div class='row'>
    	                           <div class='col-md-4'>
    	                               <label>No of Policy</label>
    	                           </div>
    	                           
    	                           <div class='col-md-8'>
    	                               <p>".$res->no_of_policy."</p>
    	                           </div>
    	                       </div>
    	                   </div>";
    	                   
    	                   }
    	                   else if($res->commission_type == "2")
    	                   {
    	                       $content .="<div class='form-group'>
    	                         <div class='row'>
    	                           <div class='col-md-4'>
    	                               <label>Vechicle Age (Min - Max)</label>
    	                           </div>
    	                           
    	                           <div class='col-md-8'>
    	                               <p>".$res->vehicle_age_min." - ".$res->vehicle_age_max."</p>
    	                           </div>
    	                       </div>
    	                   </div>";
    	                   }
    	                   else if($res->commission_type == "3")
    	                   {
    	                        $content .="<div class='form-group'>
    	                         <div class='row'>
    	                           <div class='col-md-4'>
    	                               <label>Target Amount (Min - Max)</label>
    	                           </div>
    	                           
    	                           <div class='col-md-8'>
    	                               <p>".number_format($res->min_val,2)." - ".number_format($res->max_val,2)."</p>
    	                           </div>
    	                       </div>
    	                   </div>";
    	                   }
    	                   
    	                   
    	           
        	         $content .="</div>
        	                       <div class='col-md-6'>";
        	                       
        	                if($res->class == "1")
        	                {
                	               $content .="<div class='form-group'>
            	                         <div class='row'>
            	                           <div class='col-md-4'>
            	                               <label>State</label>
            	                           </div>
            	                           
            	                           <div class='col-md-8'>
            	                               <p>".$res->commission_state."</p>
            	                           </div>
            	                       </div>
            	                   </div>";
            	                   
            	                   
            	                    $content .="<div class='form-group'>
                    	                         <div class='row'>
                    	                           <div class='col-md-4'>
                    	                               <label>RTO</label>
                    	                           </div>
                    	                           <div class='col-md-8'>
                    	                            <p class='wrap-it'>";
            	                   
                            	                   foreach($rto_details as $da)
                            	                   {
                                    	                  
                                    	               $content .= $da->rto.",";           
                            	                   }
            	                   
            	                    $content .="</p>
                    	                           </div>
                    	                       </div>
                    	                   </div>";
        	                }
        	                
        	                 $content .="<div class='form-group'>
                    	                         <div class='row'>
                    	                           <div class='col-md-4'>
                    	                               <label>OD (%)</label>
                    	                           </div>
                    	                           
                    	                           <div class='col-md-8'>
                    	                               <p>".$res->own_od."</p>
                    	                           </div>
                    	                       </div>
                    	                   </div>";
                    	                   
                    	        $content .="<div class='form-group'>
                    	                         <div class='row'>
                    	                           <div class='col-md-4'>
                    	                               <label>TP(%)</label>
                    	                           </div>
                    	                           
                    	                           <div class='col-md-8'>
                    	                               <p>".$res->own_tp."</p>
                    	                           </div>
                    	                       </div>
                    	                   </div>";
            	                   $content .="<div class='form-group'>
                    	                         <div class='row'>
                    	                           <div class='col-md-4'>
                    	                               <label>ON NET</label>
                    	                           </div>
                    	                           
                    	                           <div class='col-md-8'>
                    	                               <p>".$res->on_net."</p>
                    	                           </div>
                    	                       </div>
                    	                   </div>";
                    	                   
            	                   $content .="<div class='form-group'>
            	                         <div class='row'>
            	                           <div class='col-md-4'>
            	                               <label>Gold category</label>
            	                           </div>
            	                           
            	                           <div class='col-md-8'>
            	                               <p>".$res->gold_category."</p>
            	                           </div>
            	                       </div>
            	                   </div>";
            	                   
            	                   $content .="<div class='form-group'>
            	                         <div class='row'>
            	                           <div class='col-md-4'>
            	                               <label>Silver Category</label>
            	                           </div>
            	                           
            	                           <div class='col-md-8'>
            	                               <p>".$res->silver_category."</p>
            	                           </div>
            	                       </div>
            	                   </div>";
            	                   
            	                   $content .="<div class='form-group'>
            	                         <div class='row'>
            	                           <div class='col-md-4'>
            	                               <label>Bronze Category</label>
            	                           </div>
            	                           
            	                           <div class='col-md-8'>
            	                               <p>".$res->bronze_category."</p>
            	                           </div>
            	                       </div>
            	                   </div>";
        	         $content .="</div></div>";   
        	         
        	         echo $content;

        	}
       }
       
       public function fetch_edit_commission_details()
       {
           if($this->session->has_userdata('logged_in')) 
        	{
        	       $id = $this->input->post("id");
        	       
            	    $info = $this->cm->get_policy_class($id);
            	    
            	    if($info->class == "1")
            	    {
            	        $res = $this->cm->fetch_commission_details_motor($id);
            	        $rto_details = $this->cm->fech_rto_details($id);
            	    }
            	    else if($info->class == "2")
            	    {
            	        $res = $this->cm->fetch_commission_details_health($id);
            	         $rto_details = [];
            	    }
            	   echo json_encode(array("c_details" =>$res,"rto"=>$rto_details));
            }
       }
       
       
       public function fetch_sub_category_list()
       {
           if($this->session->has_userdata('logged_in')) 
        	{
        	    $id = $this->input->post("id");
        	    $res = $this->cm->fetch_load_sub_category($id);
        	    echo json_encode($res);
        	}
       }
       
       
       public function edit_payout_commission()
       {
            if($this->session->has_userdata('logged_in')) 
        	{  
        	    
        	$check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
           
	        if($check_user_i->masters_edit == "1")
	        {
        	    $id = $this->input->post("id");
        	    $insurer_company =  $this->input->post("insurer_company");
        	    $policy_premium_type = $this->input->post("policy_premium_type");
        	    $class = $this->input->post("insurer_class");
        	    $business_type = $this->input->post("business_type");
        	    $commission_type = $this->input->post("commission_type");
        	    $ins_rto = $this->input->post("ins_rto");
        	    $category = $this->input->post("category");
        	    $product = $this->input->post("product");
        	    $state = $this->input->post("state");
        	    $vehicle_age_min = $this->input->post("vehicle_age_min");
        	    $vehicle_age_max = $this->input->post("vehicle_age_max");
        	    $discount = $this->input->post("discount");
        	    $own_od = $this->input->post("own_od");
    	        $own_tp = $this->input->post("own_tp");
        	    $on_net = $this->input->post("on_net");
        	    $gold_category = $this->input->post("gold_category");
        	    $silver_category = $this->input->post("silver_category");
        	    $bronze_category = $this->input->post("bronze_category");
        	    // 
        	    $min_val = $this->input->post("min_val");
        	    $max_val = $this->input->post("max_val");
        	    $no_of_policy = $this->input->post("no_of_policy");
        	    
        	    $com_policy_id = "";
        	    
        	    $com_net_premium_id = "";
    
        	    $status = 0;
        	    
        	    if($class == "1"  && $commission_type == "1")
        	    {
        	        $rto_status = 0;
        	        $no_policy = $this->cm->check_no_policy($insurer_company,$policy_premium_type,$class,$business_type,$commission_type,$category,$product,$state);
        	        $check = $this->cm->check_no_of_policy_already_exits($insurer_company,$policy_premium_type,$class,$business_type,$commission_type,$category,$product,$state,$no_of_policy);
        	        
        	            if(count($check) > 0)
        	            {
        	                $status = "1";
        	            }
        	            
        	            if($status == "1")
                        {
                            $status = 0 ;
                            
                            for($i = 0;$i<count($ins_rto);$i++)
                            {
                                foreach($no_policy as $da)
                                {
                                        $check_rto = $this->cm->check_rto_by_payout_commission_id($da->id,$ins_rto[$i]);
                                        
                                        if($check_rto)
                                        {
                                            $status = "1";
                                            $rto_status = "1";
                                            break ;
                                        }
                                 }
                            }
                        }
                   
                        if(count($no_policy) > 0 && $rto_status != "1" && count($check) > 0)
                         {
                                $last_policy_id = $this->cm->get_last_policy_id();
                                        
                                if($last_policy_id->policy_id == "")
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
                                    $insert = $this->cm->add_policy_id($arr);
                                }
                         }
                        else if(count($check) == 0 && $rto_status =="0" && count($no_policy) > 0)
                        {
                                foreach($no_policy as $da)
                	            {
                	                $no_policy_id = $da->no_of_policy_id;
                	            }
                        		
                        		$check_policy_id = $this->cm->check_policy_id_already_exits($no_policy_id);
                	            
                	            if($check_policy_id != "" || $check_policy_id != null)
                	            {
                	                $com_policy_id = $check_policy_id->policy_id;
                	            }
                        }
                        else if(count($no_policy) == 0 && count($check) == 0)
                        {
                            $last_policy_id = $this->cm->get_last_policy_id();
                                
                            if($last_policy_id->policy_id == "")
                            {
                                $max_policy_id = 1; // ✅ initialize variable
                                $com_policy_id = $max_policy_id;
                                $arr = array("policy_id" => $max_policy_id);
                                $insert = $this->cm->add_policy_id($arr);
                            }
                            else
                            {
                                $max_policy_id = $last_policy_id->policy_id;
                                $com_policy_id = $max_policy_id+1;
                                $arr = array("policy_id" => $com_policy_id);
                                $insert = $this->cm->add_policy_id($arr);
                            }
                        }
        	    }
        	    
        	    else if($class == "1"  && $commission_type == "2")
        	    {
        	          $check = $this->cm->check_vechi_age_already_exits($insurer_company,$policy_premium_type,$class,$business_type,$commission_type,$category,$product,$state);
        	         
                	    foreach($check as $da)
                		{
                		    $temp_min = $da->vehicle_age_min;
                		    $temp_max = $da->vehicle_age_max;
                		    
                		    if($temp_min <= $vehicle_age_min && $temp_max >= $vehicle_age_min)
            				{
            					$status = "1";
            					break;
            				}
            				if($temp_min <= $vehicle_age_max && $temp_max >= $vehicle_age_max)
            				{
            					$status = "1";
            					break;
            				}
            				if($temp_min > $vehicle_age_min && $temp_max < $vehicle_age_max)
            				{
            					$status = "1";
            					break;
            				}
                		}
                		
                	
        	            if($status == "1")
                        {
                            $status = 0 ;
                            
                            for($i = 0;$i<count($ins_rto);$i++)
                            {
                                foreach($check as $da)
                                {
                                        $check_rto = $this->cm->check_rto_by_payout_commission_id($da->id,$ins_rto[$i]);
                                        
                                        if($check_rto)
                                        {
                                            $status = "1";
                                            $rto_status = "1";
                                            break ;
                                        }
                                 }
                            }
                        }
        	    }
        	    
        	    else if($class == "1"  && $commission_type == "3")
        	    {
        	          $check = $this->cm->check_min_max_val_already_exits($insurer_company,$policy_premium_type,$class,$business_type,$commission_type,$category,$product,$state);
        	          
        	          $rto_status = 0;
        	          $temp_status = 0;
        	          
                	    foreach($check as $da)
                		{
                		    $temp_min = $da->min_val;
                		    $temp_max = $da->max_val;
                		    
                		    if($temp_min <= $min_val && $temp_max >= $min_val)
            				{
            				    $temp_status = "1";
            					$status = "1";
            					break;
            				}
            				if($temp_min <= $max_val && $temp_max >= $max_val)
            				{
            				    $temp_status = "1";
            					$status = "1";
            					break;
            				}
            				if($temp_min > $min_val && $temp_max < $max_val)
            				{
            				    $temp_status = "1";
            					$status = "1";
            					break;
            				}
                		}
    
                		
                        if($status == "1")
                        {
                            $status = 0 ;
                            
                            for($i = 0;$i<count($ins_rto);$i++)
                            {
                                foreach($check as $da)
                                {
                                        $check_rto = $this->cm->check_rto_by_payout_commission_id($da->id,$ins_rto[$i]);
                                        
                                        if($check_rto)
                                        {
                                            $status = "1";
                                            $rto_status = "1";
                                            break ;
                                        }
                                 }
                            }
                        }
                       
                        if(count($check) > 0 && $rto_status != "1" && $temp_status == "1")
                        {
                               $last_net_id = $this->cm->get_last_net_premium_id();
                                
                                if($last_net_id->net_premium_id == "")
                                {
                                    $com_net_premium_id = "1";
                                    $arr = array("net_premium_id" => $com_net_premium_id);
                                    $insert = $this->cm->add_net_premium_id($arr);
                                }
                                else
                                {
                                    $max_net_premium_id = $last_net_id->net_premium_id;
                                    $com_net_premium_id = $max_net_premium_id+1;
                                    $arr = array("net_premium_id" => $com_net_premium_id);
                                    $insert = $this->cm->add_net_premium_id($arr);
                                }
                        }
                        else if($temp_status == "0" && $rto_status =="0" && count($check) > 0)
                        {
                            foreach($check as $da)
                        	{
                        	     $check_net_premium_id = $this->cm->check_net_premium_id_already_exits($da->net_premium_id);
                        	}
                            
                            if($check_net_premium_id != "")
                            {
                                $com_net_premium_id = $check_net_premium_id->net_premium_id;
                            }
                        }
                        
                        else if(count($check) == 0 && $temp_status == 0)
                        {
                            $last_net_id = $this->cm->get_last_net_premium_id();
                                    
                            if($last_net_id->net_premium_id == "")
                            {
                                $com_net_premium_id = "1";
                                $arr = array("net_premium_id" => $com_net_premium_id);
                                $insert = $this->cm->add_net_premium_id($arr);
                            }
                            else
                            {
                                $max_net_premium_id = $last_net_id->net_premium_id;
                                $com_net_premium_id = $max_net_premium_id+1;
                                $arr = array("net_premium_id" => $com_net_premium_id);
                                $insert = $this->cm->add_net_premium_id($arr);
                            }
                        }
                 }
    
        	    else if($class == "2"  && $commission_type == "1")
        	    {
                	   $no_policy = $this->cm->check_no_policy($insurer_company,$policy_premium_type,$class,$business_type,$commission_type);
                	   $check = $this->cm->check_no_of_policy_health_already_exits($insurer_company,$policy_premium_type,$class,$business_type,$commission_type,$no_of_policy);
                        
                        if(count($check) > 0)
                        {
                            $status = "1";
                        }
                        else
                        {
                            $no_policy_id = "";
                            
                	            foreach($no_policy as $da)
                	            {
                	                $no_policy_id = $da->no_of_policy_id;
                	            }
            
                	            $check_policy_id = $this->cm->check_policy_id_already_exits($no_policy_id);
                	            
                	            if($check_policy_id != "" || $check_policy_id != null)
                	            {
                	                $com_policy_id = $check_policy_id->policy_id;
                	            }
                	            else
                	            {
                	                $last_policy_id = $this->cm->get_last_policy_id();
                	                
                	                if($last_policy_id->policy_id == "")
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
                	                    $insert = $this->cm->add_policy_id($arr);
                	                }
                	            }
                	        }
                }
    
        	    else if($class == "2"  && $commission_type == "3")
        	    {
        	          $check = $this->cm->check_health_min_max_val_already_exits($insurer_company,$policy_premium_type,$class,$business_type,$commission_type);
        	         
                	    foreach($check as $da)
                		{
                		    $temp_min = $da->min_val;
                		    $temp_max = $da->max_val;
                		    
                		    $net_premium_id = $da->net_premium_id;
                		    
                		    if($temp_min <= $min_val && $temp_max >= $min_val)
            				{
            					$status = "1";
            					break;
            				}
            				if($temp_min <= $max_val && $temp_max >= $max_val)
            				{
            					$status = "1";
            					break;
            				}
            				if($temp_min > $min_val && $temp_max < $max_val)
            				{
            					$status = "1";
            					break;
            				}
                		}
                		
                		
                		$check_net_premium_id = "";
                		
                		foreach($check as $da)
                		{
                		     $check_net_premium_id = $this->cm->check_net_premium_id_already_exits($da->net_premium_id);
                		}
                	            
                	            if($check_net_premium_id != "")
                	            {
                	                $com_net_premium_id = $check_net_premium_id->net_premium_id;
                	            }
                	            else
                	            {
                	                $last_net_id = $this->cm->get_last_net_premium_id();
                	                
                	                if($last_net_id->net_premium_id == "")
                	                {
                	                    $com_net_premium_id = "1";
                	                    $arr = array("net_premium_id" => $com_net_premium_id);
                	                    $insert = $this->cm->add_net_premium_id($arr);
                	                }
                	                else
                	                {
                	                    $max_net_premium_id = $last_net_id->net_premium_id;
                	                    $com_net_premium_id = $max_net_premium_id+1;
                	                    $arr = array("net_premium_id" => $com_net_premium_id);
                	                    $insert = $this->cm->add_net_premium_id($arr);
                	                }
                	            }
        	      }
        	   
            	  if($status != "1")
            	  {
                	  $data = array(
                	    "insurer_company" =>$insurer_company,
                	    "policy_premium_type" =>$policy_premium_type,
                	    "class" =>$class,
                	    "business_type" =>$business_type,
                	    "commission_type"=>$commission_type,
                	    "vehicle_age_min" =>$vehicle_age_min,
                	    "discount"=>$discount,
                	    "category"=>$category,
                	    "product"=>$product,
                	    "state"=>$state,
                	    "vehicle_age_max" => $vehicle_age_max,
                	    "own_od" =>$own_od,
                	    "own_tp" =>$own_tp,
                	    "on_net"=>$on_net,
                	    "gold_category" => $gold_category,
                	    "silver_category" =>$silver_category,
                	    "bronze_category"=>$bronze_category,
                	    "min_val" =>$min_val,
                	    "max_val" =>$max_val,
                	    "no_of_policy"=>$no_of_policy,
                	    "no_of_policy_id" => $com_policy_id,
                	    "net_premium_id" => $com_net_premium_id,
                	    "created_by" =>$this->session->userdata("session_id"),
                	    "updated_time" =>date("Y-m-d H:i:s"),
            	    ); 
            	   
            	    $res = $this->cm->update_payout_commission($data,$id);
            	    
            	   if($ins_rto != null || $ins_rto !="")
            	   {
                	    for($i =0;$i<count($ins_rto);$i++)
                	    {
                	       $arr = array(
            	                        "commission_id" =>$id,
            	                        "rto" =>$ins_rto[$i],
            	                        "created_time" => date("Y-m-d H:i:s"),
                	                   );
                	        $add_rto = $this->cm->update_rto_list($arr,$id);
                	    }
                    }
                    
                     $data_log = array(
                                    "payout_id" =>$id,
                                    "action" =>"Update Payout Commission",
                                    "ins_company"=>$insurer_company,
                                    "updated_by"=>$this->session->userdata("session_id"),
                                    "updated_date"=>date("Y-m-d H:i:s"),
                                    );
                 
                        $log = $this->cm->add_payout_log($data_log);
                 
            	  }
            	  else
            	  {
            	      echo "exits";
            	  }
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
        	}
       }
       
       public function fetch_rto_list()
       {
           if($this->session->has_userdata('logged_in')) 
        	{
        	    $id = $this->input->post("id");
        	    $res = $this->cm->fetch_rto_list($id);
        	    $data = [];
        	    foreach($res as $r)
        	    {
        	        $data[] =  $r->rto;
        	    }
        	    echo json_encode($data);
        	}
       }
       
       
       public function delete_commission_list()
       {
           if($this->session->has_userdata('logged_in')) 
        	{
        	    $id = $this->input->post("id");
        	    $res = $this->cm->delete_rto_list($id);
        	    $info = $this->cm->delete_commission_list($id);
        	    
        	    $data_log = array(
                                    "payout_id" =>$id,
                                    "action" =>"Delete Payout Commission",
                                    "ins_company"=>"",
                                    "updated_by"=>$this->session->userdata("session_id"),
                                    "updated_date"=>date("Y-m-d H:i:s"),
                                    );
                 
                $log = $this->cm->add_payout_log($data_log);
        	    echo "success";
        	}
       }
       
       
       // user permissions 
     
       public function add_user_permissions()
       {
            if($this->session->has_userdata('logged_in')) 
        	{
        	        $user_id = $this->input->post("user_id");
                    $pos_add = $this->input->post("pos_add");
                    $pos_edit = $this->input->post("pos_edit");
                    $pos_view = $this->input->post("pos_view");
                    $agent_add = $this->input->post("agent_add");
                    $agent_edit = $this->input->post("agent_edit");
                    $agent_view = $this->input->post("agent_view");
                    $masters_add = $this->input->post("masters_add");
                    $masters_edit = $this->input->post("masters_edit");
                    $masters_view = $this->input->post("masters_view");
                    $email_add = $this->input->post("email_add");
                    $email_edit = $this->input->post("email_edit");
                    $email_view = $this->input->post("email_view");
                    $policy_add = $this->input->post("policy_add");
                    $policy_view = $this->input->post("policy_view");
                    $unicon_access = $this->input->post("unicon_access");
                    $renewals_view = $this->input->post("renewals_view");
                    
                    $lead_renewals_view = $this->input->post("lead_renewals_view");
                    $lead_renewals_action = $this->input->post("lead_renewals_action");
                    $follow_add = $this->input->post("follow_add");
                    $follow_edit = $this->input->post("follow_edit");
                    $follow_view = $this->input->post("follow_view");
                    $cust_add = $this->input->post("cust_add");
                    $cust_edit = $this->input->post("cust_edit");
                    $cust_view = $this->input->post("cust_view");
                    $business_add = $this->input->post("business_add");
                    $business_edit = $this->input->post("business_edit");
                    $business_view = $this->input->post("business_view");
                    $ai_add = $this->input->post("ai_add");
                    $ai_edit = $this->input->post("ai_edit");
                    $ai_view = $this->input->post("ai_view");
                    $claim_add = $this->input->post("claim_add");
                    $claim_edit = $this->input->post("claim_edit");
                    $claim_view = $this->input->post("claim_view");
                    $fail_view = $this->input->post("fail_view");
                    
                    
                    $data = array(
                                     "lead_renewals_view" =>$lead_renewals_view,
                                     "lead_renewals_action" =>$lead_renewals_action,
                                     "follow_add" =>$follow_add,
                                     "follow_edit" =>$follow_edit,
                                     "follow_view" =>$follow_view,
                                     "cust_add" =>$cust_add,
                                     "cust_edit" =>$cust_edit,
                                     "cust_view" =>$cust_view,
                                     "business_add" =>$business_add,
                                     "business_edit" =>$business_edit,
                                     "business_view" =>$business_view,
                                     "ai_add" =>$ai_add,
                                     "ai_edit" =>$ai_edit,
                                     "ai_view" =>$ai_view,
                                     "claim_add" =>$claim_add,
                                     "claim_edit" =>$claim_edit,
                                     "claim_view" => $claim_view,
                                     "fail_view" => $fail_view,
                                     
                                     "pos_add" =>$pos_add,
                                     "pos_edit" =>$pos_edit,
                                     "pos_view" =>$pos_view,
                                     "agent_add" =>$agent_add,
                                     "agent_edit" =>$agent_edit,
                                     "agent_view" =>$agent_view,
                                     "masters_add" =>$masters_add,
                                     "masters_edit" =>$masters_edit,
                                     "masters_view" =>$masters_view,
                                     "email_add" =>$email_add,
                                     "email_edit" =>$email_edit,
                                     "email_view" =>$email_view,
                                     "policy_add" =>$policy_add,
                                     "policy_view" =>$policy_view,
                                     "renewals_view" =>$renewals_view,
                                     "unicon_access" =>$unicon_access,
                                     "updated_by" => $this->session->userdata("session_id"),
                                     "updated_date" =>date("Y-m-d H:i:s"),
                                  );
                                  
                             $res = $this->cm->update_user_permissions($data,$user_id);    
        	   }
       }

        public function get_form_fields()
        {
            $form = $this->input->post('form_name');
            $user_id = $this->input->post('user_id');
            $section_index = (int)$this->input->post('section_index');
            $mode = $this->input->post('mode');

            $file_path = FCPATH . "application/views/" . $form . ".php";
            if (!file_exists($file_path)) {
                echo json_encode(['error' => "Form not found"]);
                return;
            }

            $html = file_get_contents($file_path);
            $html = preg_replace('/<\?(?:php)?[\s\S]*?\?>/i', '', $html);

            libxml_use_internal_errors(true);
            $dom = new DOMDocument();
            @$dom->loadHTML(mb_convert_encoding($html, 'HTML-ENTITIES', 'UTF-8'));
            $xpath = new DOMXPath($dom);

            // ✅ find all main .box divs
            $boxes = $xpath->query('//div[contains(concat(" ", normalize-space(@class), " "), " box ")]');

            // ✅ extract all titles (<h3 class="box-title">)
            $titles = [];
            foreach ($xpath->query('//h3[contains(@class,"box-title")]') as $node) {
                $titles[] = trim(preg_replace('/\s+/', ' ', $node->textContent));
            }

            // MODE 1: just send section list
            if ($mode === 'sections') {
                $section_list = [];
                foreach ($titles as $i => $t) {
                    if ($i >= 2) break;
                    $section_list[] = ['index' => $i, 'name' => $t];
                }
                echo json_encode($section_list);
                return;
            }

            // MODE 2: extract fields inside the selected .box
            if (!isset($boxes[$section_index])) {
                echo json_encode([]);
                return;
            }

            /** @var DOMElement $box */
            $box = $boxes->item($section_index);
            $inputs = $xpath->query('.//input|.//select|.//textarea', $box);

            $field_list = [];

            foreach ($inputs as $f) {
                if (!($f instanceof DOMElement)) continue;

                $name = $f->getAttribute('name');
                if (!$name || in_array($name, ['csrf_token', 'submit', 'action', 'lead_id', 'files', 'file_name'])) continue;

                // find nearest label text
                $labelNode = $xpath->query('preceding::label[1]', $f);
                $label_text = '';
                if ($labelNode->length > 0) {
                    $label_text = trim(preg_replace('/\s+/', ' ', $labelNode->item(0)->textContent));
                }
                if ($label_text === '') {
                    $label_text = ucfirst(str_replace('_', ' ', $name));
                }

                // fetch permissions
                $perm = $this->db->get_where('field_permissions', [
                    'user_id' => $user_id,
                    'form_name' => $form,
                    'field_name' => $name
                ])->row();

                $field_list[] = [
                    'field_name' => $name,
                    'display_name' => $label_text,
                    'can_view' => $perm ? (int)$perm->can_view : 1,
                    'can_edit' => $perm ? (int)$perm->can_edit : 1,
                    'required' => strpos($label_text, '*') !== false ? 1 : 0
                ];
            }

            echo json_encode(array_values($field_list));
        }

        public function save_field_permissions()
        {
            $user_id = $this->input->post('user_id');
            $form_name = $this->input->post('form_name');
            $fields = json_decode($this->input->post('fields'), true);

            foreach ($fields as $f) {
                $exists = $this->db->get_where('field_permissions', [
                    'user_id' => $user_id,
                    'form_name' => $form_name,
                    'field_name' => $f['field_name']
                ])->row();

                $data = [
                    'can_view' => $f['can_view'],
                    'can_edit' => $f['can_edit'],
                    'updated_at' => date('Y-m-d H:i:s')
                ];

                if ($exists) {
                    $this->db->where('id', $exists->id)->update('field_permissions', $data);
                } else {
                    $data['user_id'] = $user_id;
                    $data['form_name'] = $form_name;
                    $data['field_name'] = $f['field_name'];
                    $this->db->insert('field_permissions', $data);
                }
            }

            echo json_encode(['status' => 'success']);
        }

       
       // permissions
       
       public function fetch_user_permissions()
       {
           if($this->session->has_userdata('logged_in')) 
        	{
        	    $id = $this->input->post("id");
        	    $res = $this->cm->fetch_user_permissions($id);
        	    echo json_encode($res);
        	}
       }
       
       public function check_add_permission()
       {
            if($this->session->has_userdata('logged_in')) 
        	{
        	    $check_permission = $this->cm->fetch_user_permissions($this->session->userdata("session_id"));
        	    echo json_encode($check_permission);
        	}
       }
       
       
       public function fetch_rto_list_new()
       {
            if($this->session->has_userdata('logged_in')) 
        	{
        	    $res = $this->cm->get_rto_list();
        	    $html = "<option value='Rest_of_tamilnadu'>Rest of TamilNadu</option>";
        	    
        	    foreach($res as $da)
        	    {
        	        $html .= "<option value='".$da->rto_no."'>".$da->rto_no." (".$da->city.")</option>";
        	    }
        	    
        	    echo $html;
        	}
       }
       
      public function export_payout_commission()
      {
            if($this->session->has_userdata('logged_in')) 
        	{
            	$check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
            	
        	        if($check_user_i->masters_add == "1")
        	        {
                    	$res = $this->cm->fetch_payout_commission();
                    	
                            	$this->load->library('Excel');
                        	    $from_date = $this->input->post("from_date");
                        	    $to_date = $this->input->post("to_date");
                        	    $agent_list = $this->input->post("agents");
                        	    
                        	    
                        	    
                            	$objPHPExcel = new PHPExcel();
                                $objPHPExcel->setActiveSheetIndex(0);
                                
                                $rowCount = 4;
                                
                                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
                                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
                                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
                                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
                                $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15);
                                $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
                                $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
                                $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);
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
                    $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Premium Type');
                    $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Vechicle Category');
                    $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Vechicle Classification');
                    $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'State');
                    $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'RTO');
                    $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'OD(%)');
                    $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'TP(%)');
                    $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'ON NET(%)');
                    $objPHPExcel->getActiveSheet()->SetCellValue('K4', 'Gold(%)');
                    $objPHPExcel->getActiveSheet()->SetCellValue('L4', 'Silver(%)');
                    $objPHPExcel->getActiveSheet()->SetCellValue('M4', 'Bronze(%)');
                
                    $row_count = 5;
                    $a = 0;
                    foreach($res as $da)
                    {
                            
                            $rto_list = $this->cm->fetch_rto_list($da->id);
                            
                            $a++;
                            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->company_name);
                            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->premium_name);
                            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->mcategory);
                            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , $da->m_gvw);
                            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $da->commission_state);
                            foreach($rto_list as $r)
                            {
                                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $r->rto.",");
                            }
                            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $da->own_od);
                            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , $da->own_tp);
                            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row_count , $da->on_net);
                            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$row_count , $da->gold_category);
                            $objPHPExcel->getActiveSheet()->SetCellValue('L'.$row_count , $da->silver_category);
                            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$row_count , $da->bronze_category);
                            
                             $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                            $row_count++;
        	}
                           
                            
                            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                            $objWriter->save('./datas/reports/payout_commission_report.xlsx');
                            echo base_url()."/datas/reports/payout_commission_report.xlsx";
      }
            }
          
       }
       
       public function fetch_area_incharge()
       {
           if($this->session->has_userdata('logged_in')) 
           {
               $region = $this->input->post("region");
               $res = $this->cm->fetch_area_incharge_2($region);
               $option = "<option value=''>--Select--</option>";
               
               foreach($res as $da)
               {
                    $option .= "<option value=".$da->id.">".$da->name."  -( ".$da->phoneno." )</option>";
               }
               echo $option;
           }
       }
       
       public function edit_area_incharge()
       {
            if($this->session->has_userdata('logged_in')) 
           {
               $region = $this->input->post("region");
               $res = $this->cm->fetch_area_incharge_1($region);
               echo json_encode($res);
           }
       }
       
       public function assign_area_incharge()
       {
           if($this->session->has_userdata('logged_in')) 
           {
               $res = $this->cm->get_all_agent_assign_leads();
               
               foreach($res as $da)
               {
                   $agency_and_pos = $da->agency_and_pos;
                   
                   $area_incharge = $this->cm->get_area_incharge($agency_and_pos);
                   
                   $data = array("area_incharge" =>$area_incharge->area_incharge);
                   
                   $update = $this->cm->update_area_incharge($data,$da->id);
               }
               
               echo "success";
           }
       }
       
       public function fetch_users_by_region()
       {
           if($this->session->has_userdata('logged_in')) 
           {
               $region =[];
               
                   $region[] = $this->input->post("region");
               
                   $districts = $this->cm->fetch_user_id_using_region_id($region);
	                
	                $districts_arr = [];
	                
	                foreach($districts as $da)
	                {
	                    $districts_arr[] = $da->district_id;
	                }
	                $users = $this->cm->get_user_id_by_district($districts_arr);
	                
	                $users_arr = [];
	                
	                foreach($users as $da)
	                {
	                    $users_arr[] = $da->user_id;
	                }
	                
	                $users = $this->cm->get_user_id($users_arr);
	                
	                $html = "";
	                
	                foreach($users as $da)
	                {
	                    $html .= "<option value='".$da->id."'>".$da->name."(".$da->email_id.")"."</option>";
	                }
	                echo $html;
           }
       }
       
       
       public function assign_area_users()
       {
           if($this->session->has_userdata('logged_in')) 
           {
               $res = $this->cm->list_of_pos_and_agents();
               
               foreach($res as $da)
               {
                       $agency_and_pos = $da->id;
                       
                       $get_region = $this->cm->get_agent_region($agency_and_pos);
                      
                      if($get_region != null || $get_region != "") 
                      {
                          $region_id = $get_region->region;
                          
                          $districts = $this->cm->fetch_user_id_using_region_id_test($region_id);
                          
                                if($districts != null || $districts != "") 
                                {
                                    $users = $this->cm->get_user_id_by_district_test($districts->district_id);
                                }
                                if($users != "" || $users != null)
                                {
                                    $data = array("user_id" =>$users->user_id);
                                    $res = $this->cm->update_agents_user_id($data,$agency_and_pos);
                                }
                      }
               }
               
               echo "success";
           }
       }
       
       
       public function get_foe()
       {
           if($this->session->has_userdata('logged_in')) 
           {
               $id = $this->input->post("id");
               $res = $this->cm->get_foe($id);
               $content = "<option value = ''>--Select--</option>";
               
               foreach($res as $da)
               {
                   $content .="<option value='".$da->id."'>".$da->username."</option>";
               }
               echo $content;
           }
       }
       
       public function get_ai_data()
       {
           if($this->session->has_userdata('logged_in')) 
           {
               $id = $this->input->post("id");
               $res = $this->cm->get_ai_data($id);
               $content = "<option value = ''>--Select--</option>";
               
               foreach($res as $da)
               {
                   $content .="<option value='".$da->id."'>".$da->username."</option>";
               }
               echo $content;
           }
       }
       
       
       public function change_foe_active_records()
       {
           if($this->session->has_userdata('logged_in')) 
           {
               $foe_id = $this->input->post("current_foe_id");
               $new_foe = $this->input->post("select_foe");
               
               
               $res = $this->cm->get_foe_districts($foe_id);
               
               foreach($res as $da)
               {
                   $data = array("user_id" => $new_foe,"district_id" =>$da->district_id);
                   
                  if(!$this->cm->check_this_district_already_exits($da->district_id,$new_foe))
                   {
                       $update = $this->cm->update_foe_districts($data);
                   }
               }
               
               $leads = $this->cm->get_all_active_leads($foe_id);
               
               foreach($leads as $da)
               {
                   $arr = array("assigned_user" =>$new_foe,"old_user" =>$foe_id);
                   $result = $this->cm->update_leads_records($arr,$foe_id);
               }
              $status = array("change_status" => "1");
              $change_status = $this->cm->update_change_status($status,$foe_id);
               echo "Success";
               
           }
       }
       
       public function change_ai_active_records()
       {
           if($this->session->has_userdata('logged_in')) 
           {
               $ai_id = $this->input->post("current_ai_id");
               $new_ai = $this->input->post("select_ai");
            
               $data0 = $this->cm->get_agents_pos_datas($ai_id);
               
               foreach($data0 as $da)
               {
                   $arr= array("area_incharge" =>$new_ai);
                   $res_1 = $this->cm->update_agents_pos_datas($arr,$da->id);
               }
               
               $res = $this->cm->get_ai_regions_id($ai_id);
               
               foreach($res as $da)
               {
                   $data = array("ai_id" => $new_ai,"region_id" =>$da->region_id);
                   
                  if(!$this->cm->check_this_region_ai_already_exits($da->region_id,$new_ai))
                   {
                       $update = $this->cm->update_ai_regions($data);
                   }
               }
               $leads = $this->cm->get_all_active_leads_ai($ai_id);
               
               foreach($leads as $da)
               {
                   $arr = array("area_incharge" =>$new_ai,"old_ai" =>$ai_id);
                   $result = $this->cm->update_leads_records_ai($arr,$ai_id);
               }
              $status = array("change_status" => "1");
              $change_status = $this->cm->update_change_status_ai($status,$ai_id);
               echo "Success";
               
           }
       }
       
       
       // Load Commissions 
           
           
           
           public function trigger_commissions()
           {
                if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
                {    		
                    $pro_data["project_info"] = $this->mm->fetch_project_info();
                    $data["agent"] = $this->cm->fetch_agent_info();
                    $data["insurance"] = $this->cm->fetch_insurance_info();
                    $this->load->view('header',$pro_data);
                    $this->load->view('trigger_commissions',$data);
                    $this->load->view('footer',$pro_data);
                }
           }
           
           
           public function trigger_commission_amounts()
           {
               if($this->session->has_userdata('logged_in')) 
               {
                    $from_date = $this->input->post("from_date");
                    $to_date = $this->input->post("to_date");
                    
                    $from_date_1 = date("Y-m-01", strtotime($from_date));
                    $to_date_1 = date("Y-m-t", strtotime($from_date));
                    
                    $result = $this->cm->get_all_business_complete_policies_1($from_date,$to_date);
                    
                    $a = 0;

                      foreach($result as $re)
                      {
                               if($re->class == "1")
                               {
                                       $get_lead_info = $this->lm->get_lead_info($re->lead_id);
                                       $company = $re->company;
                                       $policy_premium = $re->policy_premium;
                                       $policy_issue_date = $re->policy_issue_date;
                                       $bussiness_type = $get_lead_info->business_type;
                                       $policy_class = $get_lead_info->class;
                                       $policy_type =  $get_lead_info->policy_type;
                                       $state = $get_lead_info->state;
                                       $rto = $get_lead_info->rto;
                                       $regndate =$get_lead_info->regn_date;
                                       $today = date("Y-m-d");
                                       $diff = date_diff(date_create($regndate), date_create($today));
                                       $age = $diff->format('%y');
                                       $fuel_type = $get_lead_info->vechi_fuel_type;
                                       $cc  = $get_lead_info->vechi_cc;
                                       $v_gvw = $get_lead_info->vechi_gvw;
                                       $v_seating = $get_lead_info->passenger_carrying;
                                       $ins_classification = $get_lead_info->vechi_classfication;
                                       $make = $get_lead_info->vechi_make;
                                       $model = $get_lead_info->vechi_model;
                                       $Varient = $get_lead_info->vechi_varient;
                                       $total_premium = $re->total_premium;
                                       
                                       $check = $this->cm->check_commission($company,$policy_premium,$policy_class,$bussiness_type,$policy_type,$state,$from_date_1,$to_date_1);
                                      
                                        $commission_id = [];
                                        $status = "0";
                                        $make_status = "0";
                                        $model_status = "0";
                                        $varient_status = "0";
                                        $rto_status = "0";
                                        $gvw_status = "0";
                                        $fuel_status = "0";
                                        $state_status = "0";
                                        $fuel_type_status = "0";
                                 
                                        foreach($check as $da)
                                        {
                                            if($da->commission_type == "2")
                                            {
                                                foreach($check as $da)
                                            	{
                                                        $temp_min = $da->vehicle_age_min;
                                                        $temp_max = $da->vehicle_age_max;
                                                        $g_status = "0";
                                                        $fuel_status = "0";
                                        		    
                                                	    if($temp_min <= $age && $temp_max >= $age)
                                                		{
                                                			$g_status = "1";
                                                		}
                                                		
                                                        if($fuel_type == "1")
                                                        {
                                                        	if($da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "6")
                                                        	{
                                                        	    $fuel_status = "1";
                                                        	}
                                                        }
                                                        if($fuel_type == "2")
                                                        {
                                                            if($da->fuel_type == "5" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                                        	{
                                                        	    $fuel_status = "1";
                                                        	}
                                                        }
                                                        if($fuel_type == "5")
                                                        {
                                                            if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "6")
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
                                                            if($da->fuel_type == "7" || $da->fuel_type == "6")
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
                                                    $check_state = $this->cm->check_state_by_commission_id(array_unique($commission_id));
                                                    
                                                    $commission_id = [];
                                                   
                                                    foreach($check_state as $da)
                                                    {
                                                        if($da->state == $state)
                                                        {
                                                             $commission_id[] = $da->id;
                                                             $state_status = "1";
                                                        }
                                                        else if($da->state == "All")
                                                        {
                                                            $commission_id[] = $da->id;
                                                            $state_status = "1";
                                                        }
                                                    }
                                                    
                                                    if($state_status == "1")
                                                    {
                                                        $classification = $this->cm->check_classification_by_commission_id(array_unique($commission_id));
                                                        $temp_commission_id = [];
                                                        $temp_commission_id = $commission_id;
                                                        $commission_id = [];
                                                    
                                                        foreach($classification as $cl)
                                                        {
                                                            if($policy_type == "7" || $policy_type == "12" || $policy_type == "13" || $policy_type == "14" || $policy_type == "59" || $policy_type == "60" || $policy_type == "65" || $policy_type == "66" || $policy_type == "67" || $policy_type == "68" || $policy_type == "69" || $policy_type == "70")
                                                            {
                                                                if($cl->classification != "")
                                                                {
                                                                   $classification = $this->cm->check_seating($v_seating,$policy_type,$temp_commission_id);
                                                                   
                                                                    if(count($classification) > 0)
                                                                    {
                                                                        $gvw_status = "1";
                                                                        foreach($classification as $da)
                                                                        {
                                                                            $commission_id[] = $cl->id;
                                                                            $gvw_status = "1";
                                                                        }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    $commission_id = $temp_commission_id;
                                                                    $gvw_status = "1";
                                                                }
                                                            }
                                                            else if($policy_type == "1" || $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
                                                            {
                                                                if($cl->classification != "")
                                                                {
                                                                    $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                                 
                                                                    if($classification != null || $classification != "")
                                                                    {
                                                                         $temp_min = $classification->from_gvw_cc;
                                                                         $temp_max = $classification->to_gvw_cc;
            
                                                                         if(($cc >= $temp_min && $cc <= $temp_max))
                                                                         {
                                                                             $commission_id[] = $cl->id;
                                                                             $gvw_status = "1";
                                                                         }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    $gvw_status = "1";
                                                                    $commission_id = $temp_commission_id;
                                                                }
                                                            }
                                                            else
                                                            {
                                                                if($cl->classification != "")
                                                                {
                                                                    $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                                  
                                                                    if($classification != null)
                                                                    {
                                                                        $temp_min = $classification->from_gvw_cc;
                                                                        $temp_max = $classification->to_gvw_cc;
                                                                        
                                                                        if($v_gvw >= $temp_min && $v_gvw <= $temp_max)
                                                                        {
                                                                            $gvw_status = "1";
                                                                            $commission_id[] = $cl->id;
                                                                        }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    $gvw_status = "1";
                                                                    $commission_id = $temp_commission_id;
                                                                }
                                                            }
                                                        }
                                                   
            
                                                       $check_make_1 = $this->cm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                                        
                                                        if(count($check_make_1) > 0)
                                                        {
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
                                                        else
                                                        {
                                                            $check_make = $this->lm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                                            
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
                                                        }
            
                                                        $check_model_1 = $this->lm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                                         
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
                                                        }
                                                        
                                                        if($make_status == "1" && $model_status == "1")
                                                        {
                                                            $check_varient_1 = $this->cm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$Varient);
                                                           
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
                                                            }
                                                        }
                                                        
                                                 
                                                        if($status == "1" && $state_status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                                        {
                                                             $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
                                                             
                                                                if(count($check_rto) > 0)
                                                                {
                                                                    foreach($check_rto as $rt)
                                                                    {
                                                                        $com_id = $rt->commission_id;
                                                                    }
                                                                  
                                                                    if(!$this->cm->check_policy_already_exits($re->lead_id))
                                                                    {
                                                                       if(!$this->cm->check_policy_no_already_exits($re->policy_no))
                                                                        {
                                                                            $data1 = array("commission_id"=>$com_id,"com_trigger_status" => "1","com_trigger_date" =>date("Y-m-d"));
                                                                            $update = $this->cm->update_commission($re->id,$data1);
                                                                            $arr = $this->cm->save_policy_data($re->id);
                                                                            $data2 = array("lead_type" => "2","lead_status" =>"completed");
                                                                            $lead_status = $this->cm->update_lead_status($data2,$re->lead_id);
                                                                        }
                                                                    }
                                                                }
                                                         }
                                                     }
                                                 }
                                             }
                                            else if($da->commission_type == "1")
                                            {
                                                $g_status = "0";
                                                $fuel_status = "0";
                                    
                                                foreach($check as $da)
                                            	{
                                                    $temp_min = $da->no_policy_min;
                                                    $temp_max = $da->no_policy_max;
                                                    
            
                                                    if($temp_min <= 1 && $temp_max >= 1)
                                                    {
                                                         $g_status = "1";
                                                         $commission_id[] = $da->id;
                                                    }
                                                    
                                                    if($fuel_type == "1")
                                                    {
                                                    	if($da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "6")
                                                    	{
                                                    	    $fuel_status = "1";
                                                    	}
                                                    }
                                                    
                                                    if($fuel_type == "2")
                                                    {
                                                        if($da->fuel_type == "5" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                                    	{
                                                    	    $fuel_status = "1";
                                                    	}
                                                    }
                                                    
                                                    if($fuel_type == "5")
                                                    {
                                                        if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "6")
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
                                                        if($da->fuel_type == "7" || $da->fuel_type == "6")
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
                                                    $check_state = $this->cm->check_state_by_commission_id(array_unique($commission_id));
                                                    
                                                    $commission_id = [];
                                                    
                                                    foreach($check_state as $da)
                                                    {
                                                        if($da->state == $state)
                                                        {
                                                             $commission_id[] = $da->id;
                                                             $state_status = "1";
                                                        }
                                                        else if($da->state == "All")
                                                        {
                                                            $commission_id[] = $da->id;
                                                            $state_status = "1";
                                                        }
                                                    }
                                                    
                                                    if($state_status == "1")
                                                    {
                                                        $classification = $this->cm->check_classification_by_commission_id(array_unique($commission_id));
                                                        $temp_commission_id = [];
                                                        $temp_commission_id = $commission_id;
                                                        $commission_id = [];
                                                        
                                                        foreach($classification as $cl)
                                                        {
                                                            if($policy_type == "7" || $policy_type == "12" || $policy_type == "13" || $policy_type == "14" || $policy_type == "59" || $policy_type == "60" || $policy_type == "65" || $policy_type == "66" || $policy_type == "67" || $policy_type == "68" || $policy_type == "69" || $policy_type == "70")
                                                            {
                                                                if($cl->classification != "")
                                                                {
                                                                   $classification = $this->cm->check_seating($v_seating,$policy_type,$temp_commission_id);
                                                                   
                                                                    if(count($classification) > 0)
                                                                    {
                                                                        $gvw_status = "1";
                                                                        
                                                                        foreach($classification as $da)
                                                                        {
                                                                            $commission_id[] = $cl->id;
                                                                            $gvw_status = "1";
                                                                        }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    $commission_id = $temp_commission_id;
                                                                    $gvw_status = "1";
                                                                }
                                                            }
                                                            else if($policy_type == "1" || $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
                                                            {
                                                                if($cl->classification != "")
                                                                {
                                                                    $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                                 
                                                                    if($classification != null)
                                                                    {
                                                                         $temp_min = $classification->from_gvw_cc;
                                                                         $temp_max = $classification->to_gvw_cc;
                                                                         
                                                                         if(($cc >= $temp_min && $cc <= $temp_max))
                                                                         {
                                                                             $commission_id[] = $cl->id;
                                                                             $gvw_status = "1";
                                                                         }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    $gvw_status = "1";
                                                                    $commission_id = $temp_commission_id;
                                                                }
                                                            }
                                                            else
                                                            {
                                                                if($cl->classification != "")
                                                                {
                                                                    $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                                  
                                                                    if($classification != null)
                                                                    {
                                                                        $temp_min = $classification->from_gvw_cc;
                                                                        $temp_max = $classification->to_gvw_cc;
                                                                        
                                                                        if($v_gvw >= $temp_min && $v_gvw <= $temp_max)
                                                                        {
                                                                            $gvw_status = "1";
                                                                            $commission_id[] = $cl->id;
                                                                        }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    $gvw_status = "1";
                                                                    $commission_id = $temp_commission_id;
                                                                }
                                                            }
                                                        }
                                                        
                                                        $check_make_1 = $this->cm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                                        
                                                        if(count($check_make_1) > 0)
                                                        {
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
                                                        else
                                                        {
                                                            $check_make = $this->lm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                                            
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
                                                        }
                                                        
                                                        $check_model_1 = $this->lm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                                         
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
                                                        }
                                                        
                                                        if($make_status == "1" && $model_status == "1")
                                                        {
                                                            $check_varient_1 = $this->cm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$Varient);
                                                           
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
                                                            }
                                                        }
                                                        
                                                        if($status == "1" && $state_status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                                        {
                                                             $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
                                                             
                                                                if(count($check_rto) > 0)
                                                                {
                                                                    foreach($check_rto as $rt)
                                                                    {
                                                                        $com_id = $rt->commission_id;
                                                                    }
                                                               
                                                                    if(!$this->cm->check_policy_already_exits($re->lead_id))
                                                                    {
                                                                       if(!$this->cm->check_policy_no_already_exits($re->policy_no))
                                                                        {
                                                                            $data1 = array("commission_id"=>$com_id,"com_trigger_status" => "1","com_trigger_date" =>date("Y-m-d"));
                                                                            $update = $this->cm->update_commission($re->id,$data1);
                                                                            $arr = $this->cm->save_policy_data($re->id);
                                                                            $data2 = array("lead_type" => "2","lead_status" =>"completed");
                                                                            $lead_status = $this->cm->update_lead_status($data2,$re->lead_id);
                                                                        }
                                                                    }
                                                                }
                                                         }
                                                        }
                                                 }
                                            }
                                            else if($da->commission_type == "3")
                                            {
                                                        $classification = $this->cm->check_classification_by_commission_id(array_unique($commission_id));
                                                        $temp_commission_id = [];
                                                        $temp_commission_id = $commission_id;
                                                    
                                                         $commission_id = [];
                                                    
                                                        foreach($classification as $cl)
                                                        {
                                                            if($policy_type == "7" || $policy_type == "12" || $policy_type == "13" || $policy_type == "14" || $policy_type == "59" || $policy_type == "60" || $policy_type == "65" || $policy_type == "66" || $policy_type == "67" || $policy_type == "68" || $policy_type == "69" || $policy_type == "70")
                                                            {
                                                                if($cl->classification != "")
                                                                {
                                                                   $classification = $this->cm->check_seating($v_seating,$policy_type,$temp_commission_id);
                                                                   
                                                                    if(count($classification) > 0)
                                                                    {
                                                                        $gvw_status = "1";
                                                                        
                                                                        foreach($classification as $da)
                                                                        {
                                                                            $commission_id[] = $cl->id;
                                                                            $gvw_status = "1";
                                                                        }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    $commission_id = $temp_commission_id;
                                                                    $gvw_status = "1";
                                                                }
                                                            }
                                                            else if($policy_type == "1" || $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
                                                            {
                                                                if($cl->classification != "")
                                                                {
                                                                    $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                                 
                                                                    if($classification != null)
                                                                    {
                                                                         $temp_min = $classification->from_gvw_cc;
                                                                         $temp_max = $classification->to_gvw_cc;
                                                                         
                                                                         if(($cc >= $temp_min && $cc <= $temp_max))
                                                                         {
                                                                             $commission_id[] = $cl->id;
                                                                             $gvw_status = "1";
                                                                         }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    $gvw_status = "1";
                                                                    $commission_id = $temp_commission_id;
                                                                }
                                                            }
                                                            else
                                                            {
                                                                if($cl->classification != "")
                                                                {
                                                                    $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                                  
                                                                    if($classification != null)
                                                                    {
                                                                        $temp_min = $classification->from_gvw_cc;
                                                                        $temp_max = $classification->to_gvw_cc;
                                                                        
                                                                        if($v_gvw >= $temp_min && $v_gvw <= $temp_max)
                                                                        {
                                                                            $gvw_status = "1";
                                                                            $commission_id[] = $cl->id;
                                                                        }
                                                                    }
                                                                }
                                                                else
                                                                {
                                                                    $gvw_status = "1";
                                                                    $commission_id = $temp_commission_id;
                                                                }
                                                            }
                                                        }
                                                    
                                                        $check_make_1 = $this->cm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                                        
                                                        if(count($check_make_1) > 0)
                                                        {
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
                                                        else
                                                        {
                                                            $check_make = $this->lm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                                            
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
                                                        }
            
                                                        $check_model_1 = $this->lm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                                         
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
                                                        }
                                                        
                                                        if($make_status == "1" && $model_status == "1")
                                                        {
                                                            $check_varient_1 = $this->cm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$Varient);
                                                           
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
                                                            }
                                                        }
                                                                
                                                        if($status == "1" && $state_status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                                        {
                                                             $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
                                                             
                                                                if(count($check_rto) > 0)
                                                                {
                                                                    foreach($check_rto as $rt)
                                                                    {
                                                                        $com_id = $rt->commission_id;
                                                                    }
                                                                  
                                                                    if(!$this->cm->check_policy_already_exits($re->lead_id))
                                                                    {
                                                                        if(!$this->cm->check_policy_no_already_exits($re->policy_no))
                                                                        {
                                                                            $data1 = array("commission_id"=>$com_id,"com_trigger_status" => "1","com_trigger_date" =>date("Y-m-d"));
                                                                            $update = $this->cm->update_commission($re->id,$data1);
                                                                            $arr = $this->cm->save_policy_data($re->id);
                                                                            $data2 = array("lead_type" => "2","lead_status" =>"completed");
                                                                            $lead_status = $this->cm->update_lead_status($data2,$re->lead_id);
                                                                        }
                                                                    }
                                                                }
                                                         }
                                                    }
                                        }
                               }
                               else
                               {
                                   $get_lead_info = $this->cm->get_health_lead_info($re->lead_id);
                                   $company = $re->company;
                                   $policy_premium = $re->policy_premium;
                                   $policy_issue_date = $re->policy_issue_date;
                                   $bussiness_type = $get_lead_info->business_type;
                                   $policy_class = $get_lead_info->class;
                                   $policy_type =  $get_lead_info->policy_type;
                                   $state = "All";
                                   $total_premium = $re->total_premium;
                                   $check = $this->cm->check_health_commission($company,$policy_premium,$policy_class,$bussiness_type,$policy_type,$state,$from_date_1,$to_date_1);
                                   
                                    $commission_id = [];
                                    $status = "0";
                                    $make_status = "0";
                                    $model_status = "0";
                                    $varient_status = "0";
                                    $rto_status = "0";
                                    $gvw_status = "0";
                                    $fuel_status = "0";
                                    $state_status = "0";
                                   
                                    foreach($check as $da)
                                    {
                                        if($da->commission_type == "1")
                                        {
                                            foreach($check as $da)
                                        	{
                                                $temp_min = $da->no_policy_min;
                                                $temp_max = $da->no_policy_max;
                                                
                                                if($temp_min <= 1 && $temp_max >= 1)
                                                {
                                                     $status = "1";
                                                     $commission_id[] = $da->id;
                                                }
                                        	}
                                        	
                                        	if($status == "1")
                                        	{
                                        	     if($da->state != "All")
                                        	     {
                                        	         $res = $this->cm->check_health_state($commission_id);
                                        	         $commission_id = [];
                                        	         
                                            	     foreach($res as $da)
                                            	     {
                                            	           $commission_id[] = $da->id;
                                            	           $c_id = $da->id;
                                            	     }
                                        	     }
                                        	}
                                        	
                                        	$data1 = array("commission_id"=>$c_id,"com_trigger_status" => "1","com_trigger_date" =>date("Y-m-d"));
                                            $update = $this->cm->update_commission($re->id,$data1);
                                            $arr = $this->cm->save_policy_data($re->id);
                                            $data2 = array("lead_type" => "2","lead_status" =>"completed");
                                            $lead_status = $this->cm->update_lead_status($data2,$re->lead_id);
                                        }
                                        else if($da->commission_type == "3")
                                        {
                                            foreach($check as $da)
                                        	{
                                                $temp_min = $da->min_val;
                                                $temp_max = $da->max_val;
                                                
                                                if($temp_min <= $total_premium && $temp_max >= $total_premium)
                                                {
                                                     $status = "1";
                                                     $commission_id[] = $da->id;
                                                }
                                        	}
                                        	
                                        	if($status == "1")
                                        	{
                                        	     if($da->state != "All")
                                        	     {
                                        	         $res = $this->cm->check_health_state($commission_id);
                                        	         $commission_id = [];
                                        	         
                                            	     foreach($res as $da)
                                            	     {
                                            	           $commission_id[] = $da->id;
                                            	           $c_id = $da->id;
                                            	     }
                                        	     }
                                        	}
                                        	
                                        	$data1 = array("commission_id"=>$c_id,"com_trigger_status" => "1","com_trigger_date" =>date("Y-m-d"));
                                            
                                            echo $re->lead_id."<br>";
    
                                            $update = $this->cm->update_commission($re->id,$data1);
                                            $arr = $this->cm->save_policy_data($re->id);
                                            $data2 = array("lead_type" => "2","lead_status" =>"completed");
                                            $lead_status = $this->cm->update_lead_status($data2,$re->lead_id);
                                        }
                                    }
                               }
                      }
                        
                      echo "success";
              }
         }
           
        //   public function trigger_commission_amounts()
        //   {
        //       if($this->session->has_userdata('logged_in')) 
        //       {
        //             $from_date = $this->input->post("from_date");
        //             $to_date = $this->input->post("to_date");
        //             $lead_id = $this->input->post("lead_id");
        //             $agent_id = $this->input->post("agent_id");
        //             $insurance_id = $this->input->post("insurance_id");
                    
        //             $result = $this->cm->get_active_policy_details_fortc($from_date,$to_date,$lead_id,$agent_id,$insurance_id);
                    
        //             $a = 0;

        //               foreach($result as $re)
        //               {
        //                       $lead_id = $re->lead_id;
                              
        //                   $total_premium = $re->total_premium;
        //                   $no_claim_bonus = $re->no_claim_bonus;
        //                   $policy_agency_pos = $re->policy_agency_pos;
        //                   $own_damage = $re->total_own_damage;
        //                   $tp = $re->tot_liability_premium;
        //                   $policy_class = $re->class;
        //                   $status = "0";
        //                   if($re->class == "1")
        //                   {
                               
        //                       $get_lead_info = $this->lm->get_lead_info($re->lead_id);
        //                       $company = $re->company;
        //                       $policy_premium = $re->policy_premium;
        //                       $policy_issue_date = $re->policy_issue_date;
        //                       $bussiness_type = $get_lead_info->business_type;
        //                       $policy_class = $get_lead_info->class;
        //                       $policy_type =  $get_lead_info->policy_type;
        //                       $state = $get_lead_info->state;
        //                       $rto = $get_lead_info->rto;
        //                       $regndate =$get_lead_info->regn_date;
        //                       $today = date("Y-m-d");
        //                       $diff = date_diff(date_create($regndate), date_create($today));
        //                       $age = $diff->format('%y');
        //                       $fuel_type = $get_lead_info->vechi_fuel_type;
        //                       $cc  = $get_lead_info->vechi_cc;
        //                       $v_gvw = $get_lead_info->vechi_gvw;
        //                       $v_seating = $get_lead_info->passenger_carrying;
        //                       $ins_classification = $get_lead_info->vechi_classfication;
        //                       $make = $get_lead_info->vechi_make;
        //                       $model = $get_lead_info->vechi_model;
        //                       $Varient = $get_lead_info->vechi_varient;
        //                       $total_premium = $re->total_premium;
        //                       $from_date = $re->policy_issue_date;
        //                       $check = $this->cm->check_commission($company,$policy_premium,$policy_class,$bussiness_type,$policy_type,$state,$from_date,$to_date);
                              
                             
        //                         $commission_id = [];
        //                         $status = "0";
        //                         $make_status = "0";
        //                         $model_status = "0";
        //                         $varient_status = "0";
        //                         $rto_status = "0";
        //                         $gvw_status = "0";
        //                         $fuel_status = "0";
        //                         $state_status = "0";
        //                         $fuel_type_status = "0";
        //                         foreach($check as $ck){
        //                                     $commission_id[] = $ck->id;
        //                                 }
        //                                 $commission_id_backup = $commission_id;
        //                         foreach($check as $da)
        //                         {
        //                             if($da->commission_type == "2")
        //                             {
        //                                 $commission_id = $commission_id_backup;
        //                                 foreach($check as $da)
        //                             	{
        //                                         $temp_min = $da->vehicle_age_min;
        //                                         $temp_max = $da->vehicle_age_max;
        //                                         $g_status = "0";
        //                                         $fuel_status = "0";
                                		    
        //                                 	    if($temp_min <= $age && $temp_max >= $age)
        //                                 		{
        //                                 			$g_status = "1";
        //                                 		}
                                        		
        //                                         if($fuel_type == "1")
        //                                         {
        //                                         	if($da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "6")
        //                                         	{
        //                                         	    $fuel_status = "1";
        //                                         	}
        //                                         }
        //                                         if($fuel_type == "2")
        //                                         {
        //                                             if($da->fuel_type == "5" || $da->fuel_type == "2" || $da->fuel_type == "6")
        //                                         	{
        //                                         	    $fuel_status = "1";
        //                                         	}
        //                                         }
        //                                         if($fuel_type == "5")
        //                                         {
        //                                             if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "6")
        //                                         	{
        //                                         	    $fuel_status = "1";
        //                                         	}
        //                                         }
        //                                         if($fuel_type == "6")
        //                                         {
        //                                             if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
        //                                         	{
        //                                         	    $fuel_status = "1";
        //                                         	}
        //                                         }
        //                                         if($fuel_type == "7")
        //                                         {
        //                                             if($da->fuel_type == "7" || $da->fuel_type == "6")
        //                                         	{
        //                                         	    $fuel_status = "1";
        //                                         	}
        //                                         }
                                    		   
        //                             			if($g_status == "1" && $fuel_status == "1")
        //                             			{
        //                             			    $commission_id[] = $da->id;
        //                             			    $status = "1";
        //                                             $fuel_type_status = "1";
        //                             			}
                                	      
                                    	    
        //                             	}
                                	      
        //                                 if($status == "1")
        //                                 {
        //                                     $check_state = $this->cm->check_state_by_commission_id(array_unique($commission_id));
                                            
        //                                     $commission_id = [];
                                           
        //                                     foreach($check_state as $da)
        //                                     {
        //                                         if($da->state == $state)
        //                                         {
        //                                              $commission_id[] = $da->id;
        //                                              $state_status = "1";
        //                                         }
        //                                         else if($da->state == "All")
        //                                         {
        //                                             $commission_id[] = $da->id;
        //                                             $state_status = "1";
        //                                         }
        //                                     }
                                            
        //                                     if($state_status == "1")
        //                                     {
        //                                         $classification = $this->cm->check_classification_by_commission_id(array_unique($commission_id));
        //                                         $temp_commission_id = [];
        //                                         $temp_commission_id = $commission_id;
        //                                         $commission_id = [];
                                            
        //                                         foreach($classification as $cl)
        //                                         {
        //                                             if($policy_type == "7" || $policy_type == "12" || $policy_type == "13" || $policy_type == "14" || $policy_type == "59" || $policy_type == "60" || $policy_type == "65" || $policy_type == "66" || $policy_type == "67" || $policy_type == "68" || $policy_type == "69" || $policy_type == "70")
        //                                             {
        //                                                 if($cl->classification != "")
        //                                                 {
        //                                                   $classification = $this->cm->check_seating($v_seating,$policy_type,$temp_commission_id);
                                                           
        //                                                     if(count($classification) > 0)
        //                                                     {
        //                                                         $gvw_status = "1";
        //                                                         foreach($classification as $da)
        //                                                         {
        //                                                             $commission_id[] = $cl->id;
        //                                                             $gvw_status = "1";
        //                                                         }
        //                                                     }
        //                                                 }
        //                                                 else
        //                                                 {
        //                                                     $commission_id = $temp_commission_id;
        //                                                     $gvw_status = "1";
        //                                                 }
        //                                             }
        //                                             else if($policy_type == "1" || $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
        //                                             {
        //                                                 if($cl->classification != "")
        //                                                 {
        //                                                     $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                         
        //                                                     if($classification != null || $classification != "")
        //                                                     {
        //                                                          $temp_min = $classification->from_gvw_cc;
        //                                                          $temp_max = $classification->to_gvw_cc;
    
        //                                                          if(($cc >= $temp_min && $cc <= $temp_max))
        //                                                          {
        //                                                              $commission_id[] = $cl->id;
        //                                                              $gvw_status = "1";
        //                                                          }
        //                                                     }
        //                                                 }
        //                                                 else
        //                                                 {
        //                                                     $gvw_status = "1";
        //                                                     $commission_id = $temp_commission_id;
        //                                                 }
        //                                             }
        //                                             else
        //                                             {
        //                                                 if($cl->classification != "")
        //                                                 {
        //                                                     $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                          
        //                                                     if($classification != null)
        //                                                     {
        //                                                         $temp_min = $classification->from_gvw_cc;
        //                                                         $temp_max = $classification->to_gvw_cc;
                                                                
        //                                                         if($v_gvw >= $temp_min && $v_gvw <= $temp_max)
        //                                                         {
        //                                                             $gvw_status = "1";
        //                                                             $commission_id[] = $cl->id;
        //                                                         }
        //                                                     }
        //                                                 }
        //                                                 else
        //                                                 {
        //                                                     $gvw_status = "1";
        //                                                     $commission_id = $temp_commission_id;
        //                                                 }
        //                                             }
        //                                         }
                                           
    
        //                                       $check_make_1 = $this->cm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                                
        //                                         if(count($check_make_1) > 0)
        //                                         {
        //                                                 if(count($check_make_1) > 0)
        //                                                 {
        //                                                     $commission_id = [];
                                                            
        //                                                     foreach($check_make_1 as $da)
        //                                                     {
        //                                                          $commission_id[] = $da->commission_id;
        //                                                     }
        //                                                     $status = "1";
        //                                                     $make_status = "1";
        //                                                 }
        //                                                 else
        //                                                 {
        //                                                     $make_status = "0";
        //                                                 }
        //                                         }
        //                                         else
        //                                         {
        //                                             $check_make = $this->lm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                                    
        //                                             if(count($check_make) > 0)
        //                                             {
        //                                                 $commission_id = [];
                                                        
        //                                                 foreach($check_make as $da)
        //                                                 {
        //                                                   $commission_id[] = $da->id;
        //                                                 }
                                                        
        //                                                 $status = "1";
        //                                                 $make_status = "1";
        //                                             }
        //                                         }
    
        //                                         $check_model_1 = $this->lm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                                 
        //                                         if(count($check_model_1) > 0)
        //                                         {
        //                                             $commission_id = [];
                                                    
        //                                             foreach($check_model_1 as $da)
        //                                             {
        //                                               $commission_id[] = $da->commission_id;
        //                                             }
                                                    
        //                                             $status = "1";
        //                                             $model_status = "1";
        //                                         }
        //                                         else
        //                                         {
        //                                             $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
        //                                             if(count($check_model) > 0)
        //                                             {
        //                                                     $commission_id = [];
        //                                                     foreach($check_model as $da)
        //                                                     {
        //                                                          $commission_id[] = $da->id;
        //                                                     }
        //                                                  $status = "1";
        //                                                  $model_status = "1";
        //                                             }
        //                                         }
                                                
        //                                         if($make_status == "1" && $model_status == "1")
        //                                         {
        //                                             $check_varient_1 = $this->cm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$Varient);
                                                   
        //                                             if(count($check_varient_1) > 0) 
        //                                             {
        //                                                 $commission_id = [];
        //                                                 foreach($check_varient_1 as $da)
        //                                                 {
        //                                                   $commission_id[] = $da->commission_id;
        //                                                 }
        //                                                 $status = "1";
        //                                                 $varient_status = "1";
        //                                             }
        //                                             else
        //                                             {
        //                                                 $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
        //                                                 if(count($check_varient) > 0)
        //                                                 {
        //                                                     $commission_id = [];
                                                            
        //                                                     foreach($check_varient as $da)
        //                                                     {
        //                                                          $commission_id[] = $da->id;
        //                                                     }
        //                                                      $status = "1";
        //                                         	         $varient_status = "1";
        //                                                 }
        //                                             }
        //                                         }
                                                
        //                                         $state_status = 1;
        //                                         $fuel_type_status = 1;
        //                                         if($status == "1" && $state_status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
        //                                         {
        //                                              $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
                                                     
        //                                                 if(count($check_rto) > 0)
        //                                                 {
        //                                                     foreach($check_rto as $rt)
        //                                                     {
        //                                                         $com_id = $rt->commission_id;
        //                                                     }
        //                                                     $data1 = array("commission_id"=>$com_id,"com_trigger_status" => "1","com_trigger_date" =>date("Y-m-d"));
        //                                                     $update = $this->cm->update_commissions($data1,$re->id);
        //                                                     $commission_id = $com_id;
        //                                                     $own_damage = $re->total_own_damage;
        //                                                     $tp = $re->basic_tp;
        //                                                     $res123 = $this->lm->fetch_policy_info($commission_id);
        //                                                     $agn_commission_type = $res123->agn_com_type ;
        //                                                     if($agn_commission_type != "TP")
        //                                                     {
        //                                                         $jayantha_commission = ($own_damage * 15)/100;
        //                                                         $jayantha_agent_commission = ($own_damage * 15)/100;
        //                                                     }
        //                                                     if($agn_commission_type != "OD")
        //                                                     {
        //                                                         $jayantha_commission = $jayantha_commission + (($tp * 2.5)/100);   
        //                                                     }
    
                                                            
        //                                                     $res = $this->lm->fetch_policy_info($commission_id);
        //                                                     $commission_type = $res->commission_type;
                                                            
        //                                                     $spl_com = $this->lm->check_spl_commission_for_agent($commission_id,$policy_agency_pos); 
                                                     
        //                                                     if($res != null && $res->commission_type == "2" || $res->commission_type == "3" || $res->commission_type == "1")
        //                                                     {
        //                                                             if($res->is_ncb == "Yes" && $no_claim_bonus == "Yes")
        //                                                             {
        //                                                                 $status = "1";
        //                                                                 $company_com = $total_premium * ($res->ncb_percentage)/100;
        //                                                                 $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                                                     
        //                                                                   if($spl_com != null || $spl_com != "")
        //                                                                   {
        //                                                                           if($res->agn_com_type == "OD")
        //                                                                           {
        //                                                                               $agent_commission = ($own_damage * $spl_com->special_com)/100;
        //                                                                           }
        //                                                                           else if($res->agn_com_type == "TP")
        //                                                                           {
        //                                                                               $agent_commission = ($tp * $spl_com->special_com)/100;
        //                                                                           }
        //                                                                           else if($res->agn_com_type == "ON-NET")
        //                                                                           {
        //                                                                               $agent_commission = ($total_premium * $spl_com->special_com)/100;
        //                                                                           }
        //                                                                           else if($res->agn_com_type == "OD_AND_TP")
        //                                                                           {
        //                                                                               $agent_commission = ($total_premium * $spl_com->special_com)/100;
        //                                                                           }
        //                                                                   }
        //                                                                   else
        //                                                                   {
        //                                                                       if($agent_status->commission_category == "A")
        //                                                                       {
        //                                                                           $agent_commission = ($total_premium * $res->a_ncb)/100;
        //                                                                       }
        //                                                                       else if($agent_status->commission_category == "B")
        //                                                                       {
        //                                                                             $agent_commission = ($total_premium * $res->b_ncb)/100;
        //                                                                       }
        //                                                                       else if($agent_status->commission_category == "C")
        //                                                                       {
        //                                                                             $agent_commission = ($total_premium * $res->c_ncb)/100;
        //                                                                       }
        //                                                                       else if($agent_status->commission_category == "D")
        //                                                                       {
        //                                                                             $agent_commission = ($total_premium * $res->d_ncb)/100;
        //                                                                       }
        //                                                                   }
        //                                                             }
        //                                                             else
        //                                                             {
        //                                                                 if($res->on_net != "0")
        //                                                                 {
        //                                                                     $own_od = "";
        //                                                                     $own_tp = "";
        //                                                                     $company_com = $total_premium * ($res->on_net)/100;
        //                                                                     $on_net = $company_com;
        //                                                                 }
        //                                                                 else if($res->own_od != "0" && $res->own_tp != "0")
        //                                                                 {
        //                                                                     $own_od = $own_damage * ($res->own_od)/100;
        //                                                                     $own_tp = $tp * ($res->own_tp)/100;
        //                                                                     $company_com = $own_od+$own_tp;
        //                                                                     $on_net = "";
        //                                                                 }
        //                                                                 else if($res->own_od != "0")
        //                                                                 {
        //                                                                     $on_net = ""; 
        //                                                                     $own_tp = "";
        //                                                                     $company_com = $own_damage * ($res->own_od)/100;
        //                                                                     $own_od = $company_com;
        //                                                                 }
        //                                                                 else if($res->own_tp != "0")
        //                                                                 {
        //                                                                     $own_od = ""; 
        //                                                                     $on_net = "";
        //                                                                     $company_com = $tp * ($res->own_tp)/100;
        //                                                                     $own_tp = $company_com;
        //                                                                 }
                                                                    
        //                                                               if($spl_com != null || $spl_com != "")
        //                                                               {
        //                                                                       if($res->agn_com_type == "OD")
        //                                                                       {
        //                                                                           $agent_commission = ($own_damage * $spl_com->special_com)/100;
        //                                                                       }
        //                                                                       else if($res->agn_com_type == "TP")
        //                                                                       {
        //                                                                           $agent_commission = ($tp * $spl_com->special_com)/100;
        //                                                                       }
        //                                                                       else if($res->agn_com_type == "ON-NET")
        //                                                                       {
        //                                                                           $agent_commission = ($total_premium * $spl_com->special_com)/100;
        //                                                                       }
        //                                                                       else if($res->agn_com_type == "OD_AND_TP")
        //                                                                       {
        //                                                                           $agent_commission = ($total_premium * $spl_com->special_com)/100;
        //                                                                       }
        //                                                               }
        //                                                               else
        //                                                               {
        //                                                                       $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                                                              
        //                                                                       if($res->agn_com_type == "OD")
        //                                                                       {
        //                                                                           if($agent_status->commission_category == "A")
        //                                                                           {
        //                                                                               $agent_commission = ($own_damage * $res->a_od)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "B")
        //                                                                           {
        //                                                                               $agent_commission = ($own_damage * $res->b_od)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "C")
        //                                                                           {
        //                                                                               $agent_commission = ($own_damage * $res->c_od)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "D")
        //                                                                           {
        //                                                                               $agent_commission = ($own_damage * $res->d_od)/100;
        //                                                                           }
        //                                                                       }
        //                                                                       else if($res->agn_com_type == "TP")
        //                                                                       {
        //                                                                           if($agent_status->commission_category == "A")
        //                                                                           {
        //                                                                               $agent_commission = ($tp * $res->a_tp)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "B")
        //                                                                           {
        //                                                                               $agent_commission = ($tp * $res->b_tp)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "C")
        //                                                                           {
        //                                                                               $agent_commission = ($tp * $res->c_tp)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "D")
        //                                                                           {
        //                                                                               $agent_commission = ($tp * $res->d_tp)/100;
        //                                                                           }
        //                                                                       }
        //                                                                       else if($res->agn_com_type == "ON-NET")
        //                                                                       {
        //                                                                           if($agent_status->commission_category == "A")
        //                                                                           {
        //                                                                               $agent_commission = ($total_premium * $res->a_net)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "B")
        //                                                                           {
        //                                                                               $agent_commission = ($total_premium * $res->b_net)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "C")
        //                                                                           {
        //                                                                               $agent_commission = ($total_premium * $res->c_net)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "D")
        //                                                                           {
        //                                                                               $agent_commission = ($total_premium * $res->d_net)/100;
        //                                                                           }
        //                                                                       }
        //                                                                       else if($res->agn_com_type == "OD_AND_TP")
        //                                                                       {
        //                                                                           if($agent_status->commission_category == "A")
        //                                                                           {
        //                                                                               $agent_od = ($own_damage * $res->a_od)/100;
        //                                                                               $agent_tp = ($tp * $res->a_tp)/100;
        //                                                                               $agent_commission = $agent_od+$agent_tp;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "B")
        //                                                                           {
        //                                                                               $agent_od = ($own_damage * $res->b_od)/100;
        //                                                                               $agent_tp = ($tp * $res->b_tp)/100;
        //                                                                               $agent_commission = $agent_od+$agent_tp;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "C")
        //                                                                           {
        //                                                                               $agent_od = ($own_damage * $res->c_od)/100;
        //                                                                               $agent_tp = ($tp * $res->c_tp)/100;
        //                                                                               $agent_commission = $agent_od+$agent_tp;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "D")
        //                                                                           {
        //                                                                               $agent_od = ($own_damage * $res->d_od)/100;
        //                                                                               $agent_tp = ($tp * $res->d_tp)/100;
        //                                                                               $agent_commission = $agent_od+$agent_tp;
        //                                                                           }
        //                                                                      }
        //                                                               }
        //                                                          }
                                                                
        //                                                           if($company_com <= $jayantha_commission)
        //                                                             {
        //                                                                 $jayantha_commission = $company_com;
        //                                                                 $company_com = 0;
        //                                                             }
        //                                                             else
        //                                                             {
        //                                                                  $company_com = $company_com - $jayantha_commission;
        //                                                             }
        //                                                           if($agent_commission <= $jayantha_agent_commission)
        //                                                             {
        //                                                                   $jayantha_agent_commission = $agent_commission;
        //                                                                   $agent_commission = 0;
        //                                                                     $jayantha_agent_commission;
        //                                                             }
        //                                                             else
        //                                                             {
        //                                                                 $agent_commission = $agent_commission - $jayantha_agent_commission;
        //                                                             }
        //                                                              $data = array("agent_commission"=> $agent_commission,
        //                                                                             "agent_commission_amt"=> $jayantha_agent_commission,
        //                                                                             "own_commission_amt"=> $jayantha_commission,
        //                                                                             "own_commission"=> $company_com,
        //                                                                             "calc_com_status" =>"1");
        //                                                             $update = $this->cm->update_commissions_by_lead_id($data,$lead_id);
        //                                                             $agc_credit = array(
        //                                                                 'credit'=>$jayantha_agent_commission,
        //                                                                 );
        //                                                              $agc_debit = array(
        //                                                                 'debit'=>$jayantha_agent_commission,
        //                                                                 );
        //                                                             $com_credit = array(
        //                                                                 'credit'=>$jayantha_commission,
        //                                                                 );
        //                                                             $this->cm->accouts_update($agc_credit,'jayantha',$re->lead_id,'Agent commission Credit');
        //                                                             $this->cm->accouts_update($agc_debit,'jayantha',$re->lead_id,'Own commission Debit');
        //                                                             $this->cm->accouts_update($com_credit,'jayantha',$re->lead_id,'Own commission Credit');
                                                                    
        //                                                             $agc_credit = array(
        //                                                                 'credit'=>$agent_commission,
        //                                                                 );
        //                                                              $agc_debit = array(
        //                                                                 'debit'=>$agent_commission,
        //                                                                 );
        //                                                             $com_credit = array(
        //                                                                 'credit'=>$company_com,
        //                                                                 );
                                                                    
        //                                                              $this->cm->accouts_update($agc_credit,'unicorn',$re->lead_id,'Agent commission Credit');
        //                                                             $this->cm->accouts_update($agc_debit,'unicorn',$re->lead_id,'Own commission Debit');
        //                                                             $this->cm->accouts_update($com_credit,'unicorn',$re->lead_id,'Own commission Credit');
        //                                                     }
                                                                
                                                            
        //                                                 }
        //                                          }
        //                                      }
        //                                  }
        //                              }
        //                             else if($da->commission_type == "1")
        //                             {
        //                                 $commission_id = $commission_id_backup;
        //                                 $g_status = "0";
        //                                 $fuel_status = "0";
                            
        //                                 foreach($check as $da)
        //                             	{
        //                                     $temp_min = $da->no_policy_min;
        //                                     $temp_max = $da->no_policy_max;
                                            
    
        //                                     if($temp_min <= 1 && $temp_max >= 1)
        //                                     {
        //                                          $g_status = "1";
        //                                          $commission_id[] = $da->id;
        //                                     }
                                            
        //                                     if($fuel_type == "1")
        //                                     {
        //                                     	if($da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "6")
        //                                     	{
        //                                     	    $fuel_status = "1";
        //                                     	}
        //                                     }
                                            
        //                                     if($fuel_type == "2")
        //                                     {
        //                                         if($da->fuel_type == "5" || $da->fuel_type == "2" || $da->fuel_type == "6")
        //                                     	{
        //                                     	    $fuel_status = "1";
        //                                     	}
        //                                     }
                                            
        //                                     if($fuel_type == "5")
        //                                     {
        //                                         if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "6")
        //                                     	{
        //                                     	    $fuel_status = "1";
        //                                     	}
        //                                     }
                                            
        //                                     if($fuel_type == "6")
        //                                     {
        //                                         if($da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "3" || $da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "6")
        //                                     	{
        //                                     	    $fuel_status = "1";
        //                                     	}
        //                                     }
                                            
        //                                     if($fuel_type == "7")
        //                                     {
        //                                         if($da->fuel_type == "7" || $da->fuel_type == "6")
        //                                     	{
        //                                     	    $fuel_status = "1";
        //                                     	}
        //                                     }
                                		   
        //                         			if($g_status == "1" && $fuel_status == "1")
        //                         			{
        //                         			    $commission_id[] = $da->id;
        //                         			    $status = "1";
        //                                         $fuel_type_status = "1";
        //                         			}
        //                             	}
                                    	
        //                                 if($status == "1")
        //                                 {
        //                                     $check_state = $this->cm->check_state_by_commission_id(array_unique($commission_id));
                                            
        //                                     $commission_id = [];
                                            
        //                                     foreach($check_state as $da)
        //                                     {
        //                                         if($da->state == $state)
        //                                         {
        //                                              $commission_id[] = $da->id;
        //                                              $state_status = "1";
        //                                         }
        //                                         else if($da->state == "All")
        //                                         {
        //                                             $commission_id[] = $da->id;
        //                                             $state_status = "1";
        //                                         }
        //                                     }
                                            
        //                                     if($state_status == "1")
        //                                     {
        //                                         $classification = $this->cm->check_classification_by_commission_id(array_unique($commission_id));
        //                                         $temp_commission_id = [];
        //                                         $temp_commission_id = $commission_id;
        //                                         $commission_id = [];
                                                
        //                                         foreach($classification as $cl)
        //                                         {
        //                                             if($policy_type == "7" || $policy_type == "12" || $policy_type == "13" || $policy_type == "14" || $policy_type == "59" || $policy_type == "60" || $policy_type == "65" || $policy_type == "66" || $policy_type == "67" || $policy_type == "68" || $policy_type == "69" || $policy_type == "70")
        //                                             {
        //                                                 if($cl->classification != "")
        //                                                 {
        //                                                   $classification = $this->cm->check_seating($v_seating,$policy_type,$temp_commission_id);
                                                           
        //                                                     if(count($classification) > 0)
        //                                                     {
        //                                                         $gvw_status = "1";
                                                                
        //                                                         foreach($classification as $da)
        //                                                         {
        //                                                             $commission_id[] = $cl->id;
        //                                                             $gvw_status = "1";
        //                                                         }
        //                                                     }
        //                                                 }
        //                                                 else
        //                                                 {
        //                                                     $commission_id = $temp_commission_id;
        //                                                     $gvw_status = "1";
        //                                                 }
        //                                             }
        //                                             else if($policy_type == "1" || $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
        //                                             {
        //                                                 if($cl->classification != "")
        //                                                 {
        //                                                     $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                         
        //                                                     if($classification != null)
        //                                                     {
        //                                                          $temp_min = $classification->from_gvw_cc;
        //                                                          $temp_max = $classification->to_gvw_cc;
                                                                 
        //                                                          if(($cc >= $temp_min && $cc <= $temp_max))
        //                                                          {
        //                                                              $commission_id[] = $cl->id;
        //                                                              $gvw_status = "1";
        //                                                          }
        //                                                     }
        //                                                 }
        //                                                 else
        //                                                 {
        //                                                     $gvw_status = "1";
        //                                                     $commission_id = $temp_commission_id;
        //                                                 }
        //                                             }
        //                                             else
        //                                             {
        //                                                 if($cl->classification != "")
        //                                                 {
        //                                                     $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                          
        //                                                     if($classification != null)
        //                                                     {
        //                                                         $temp_min = $classification->from_gvw_cc;
        //                                                         $temp_max = $classification->to_gvw_cc;
                                                                
        //                                                         if($v_gvw >= $temp_min && $v_gvw <= $temp_max)
        //                                                         {
        //                                                             $gvw_status = "1";
        //                                                             $commission_id[] = $cl->id;
        //                                                         }
        //                                                     }
        //                                                 }
        //                                                 else
        //                                                 {
        //                                                     $gvw_status = "1";
        //                                                     $commission_id = $temp_commission_id;
        //                                                 }
        //                                             }
        //                                         }
                                                
        //                                         $check_make_1 = $this->cm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                                
        //                                         if(count($check_make_1) > 0)
        //                                         {
        //                                                 if(count($check_make_1) > 0)
        //                                                 {
        //                                                     $commission_id = [];
                                                            
        //                                                     foreach($check_make_1 as $da)
        //                                                     {
        //                                                          $commission_id[] = $da->commission_id;
        //                                                     }
        //                                                     $status = "1";
        //                                                     $make_status = "1";
        //                                                 }
        //                                                 else
        //                                                 {
        //                                                     $make_status = "0";
        //                                                 }
        //                                         }
        //                                         else
        //                                         {
        //                                             $check_make = $this->lm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                                    
        //                                             if(count($check_make) > 0)
        //                                             {
        //                                                 $commission_id = [];
                                                        
        //                                                 foreach($check_make as $da)
        //                                                 {
        //                                                   $commission_id[] = $da->id;
        //                                                 }
                                                        
        //                                                 $status = "1";
        //                                                 $make_status = "1";
        //                                             }
        //                                         }
                                                
        //                                         $check_model_1 = $this->lm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                                 
        //                                         if(count($check_model_1) > 0)
        //                                         {
        //                                             $commission_id = [];
                                                    
        //                                             foreach($check_model_1 as $da)
        //                                             {
        //                                               $commission_id[] = $da->commission_id;
        //                                             }
                                                    
        //                                             $status = "1";
        //                                             $model_status = "1";
        //                                         }
        //                                         else
        //                                         {
        //                                             $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
        //                                             if(count($check_model) > 0)
        //                                             {
        //                                                     $commission_id = [];
        //                                                     foreach($check_model as $da)
        //                                                     {
        //                                                          $commission_id[] = $da->id;
        //                                                     }
        //                                                  $status = "1";
        //                                                  $model_status = "1";
        //                                             }
        //                                         }
                                                
        //                                         if($make_status == "1" && $model_status == "1")
        //                                         {
        //                                             $check_varient_1 = $this->cm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$Varient);
                                                   
        //                                             if(count($check_varient_1) > 0) 
        //                                             {
        //                                                 $commission_id = [];
        //                                                 foreach($check_varient_1 as $da)
        //                                                 {
        //                                                   $commission_id[] = $da->commission_id;
        //                                                 }
        //                                                 $status = "1";
        //                                                 $varient_status = "1";
        //                                             }
        //                                             else
        //                                             {
        //                                                 $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
        //                                                 if(count($check_varient) > 0)
        //                                                 {
        //                                                     $commission_id = [];
                                                            
        //                                                     foreach($check_varient as $da)
        //                                                     {
        //                                                          $commission_id[] = $da->id;
        //                                                     }
        //                                                      $status = "1";
        //                                         	         $varient_status = "1";
        //                                                 }
        //                                             }
        //                                         }
        //                                         $state_status = 1;
        //                                         $fuel_type_status = 1;
                                                
        //                                         if($status == "1" && $state_status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
        //                                         {
        //                                              $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
                                                     
        //                                                 if(count($check_rto) > 0)
        //                                                 {
        //                                                     foreach($check_rto as $rt)
        //                                                     {
        //                                                         $com_id = $rt->commission_id;
        //                                                     }
                                                       
        //                                                     $data1 = array("commission_id"=>$com_id,"com_trigger_status" => "1","com_trigger_date" =>date("Y-m-d"));
        //                                                     $update = $this->cm->update_commission($re->id,$data1);
        //                                                     $commission_id = $com_id;
        //                                                     $own_damage = $re->total_own_damage;
        //                                                     $tp = $re->basic_tp;
        //                                                     $res123 = $this->lm->fetch_policy_info($commission_id);
        //                                                     $agn_commission_type = $res123->agn_com_type ;
        //                                                     if($agn_commission_type != "TP")
        //                                                     {
        //                                                         $jayantha_commission = ($own_damage * 15)/100;
        //                                                         $jayantha_agent_commission = ($own_damage * 15)/100;
        //                                                     }
        //                                                     if($agn_commission_type != "OD")
        //                                                     {
        //                                                         $jayantha_commission = $jayantha_commission + (($tp * 2.5)/100);   
        //                                                     }
                                                            
        //                                                     $res = $this->lm->fetch_policy_info($commission_id);
        //                                                     $commission_type = $res->commission_type;
                                                            
        //                                                     $spl_com = $this->lm->check_spl_commission_for_agent($commission_id,$policy_agency_pos); 
                                                            
        //                                                     if($res != null && $res->commission_type == "2" || $res->commission_type == "3" || $res->commission_type == "1")
        //                                                     {
        //                                                                     if($res->is_ncb == "Yes" && $no_claim_bonus == "Yes")
        //                                                                     {
        //                                                                         $status = "1";
        //                                                                         $company_com = $total_premium * ($res->ncb_percentage)/100;
        //                                                                         $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                                                             
        //                                                                           if($spl_com != null || $spl_com != "")
        //                                                                           {
        //                                                                                   if($res->agn_com_type == "OD")
        //                                                                                   {
        //                                                                                       $agent_commission = ($own_damage * $spl_com->special_com)/100;
        //                                                                                   }
        //                                                                                   else if($res->agn_com_type == "TP")
        //                                                                                   {
        //                                                                                       $agent_commission = ($tp * $spl_com->special_com)/100;
        //                                                                                   }
        //                                                                                   else if($res->agn_com_type == "ON-NET")
        //                                                                                   {
        //                                                                                       $agent_commission = ($total_premium * $spl_com->special_com)/100;
        //                                                                                   }
        //                                                                                   else if($res->agn_com_type == "OD_AND_TP")
        //                                                                                   {
        //                                                                                       $agent_commission = ($total_premium * $spl_com->special_com)/100;
        //                                                                                   }
        //                                                                           }
        //                                                                           else
        //                                                                           {
        //                                                                               if($agent_status->commission_category == "A")
        //                                                                               {
        //                                                                                   $agent_commission = ($total_premium * $res->a_ncb)/100;
        //                                                                               }
        //                                                                               else if($agent_status->commission_category == "B")
        //                                                                               {
        //                                                                                     $agent_commission = ($total_premium * $res->b_ncb)/100;
        //                                                                               }
        //                                                                               else if($agent_status->commission_category == "C")
        //                                                                               {
        //                                                                                     $agent_commission = ($total_premium * $res->c_ncb)/100;
        //                                                                               }
        //                                                                               else if($agent_status->commission_category == "D")
        //                                                                               {
        //                                                                                     $agent_commission = ($total_premium * $res->d_ncb)/100;
        //                                                                               }
        //                                                                           }
        //                                                                     }
        //                                                                     else
        //                                                                     {
        //                                                                         if($res->on_net != "0")
        //                                                                         {
        //                                                                             $own_od = "";
        //                                                                             $own_tp = "";
        //                                                                             $company_com = $total_premium * ($res->on_net)/100;
        //                                                                             $on_net = $company_com;
        //                                                                         }
        //                                                                         else if($res->own_od != "0" && $res->own_tp != "0")
        //                                                                         {
        //                                                                             $own_od = $own_damage * ($res->own_od)/100;
        //                                                                             $own_tp = $tp * ($res->own_tp)/100;
        //                                                                             $company_com = $own_od+$own_tp;
        //                                                                             $on_net = "";
        //                                                                         }
        //                                                                         else if($res->own_od != "0")
        //                                                                         {
        //                                                                             $on_net = ""; 
        //                                                                             $own_tp = "";
        //                                                                             $company_com = $own_damage * ($res->own_od)/100;
        //                                                                             $own_od = $company_com;
        //                                                                         }
        //                                                                         else if($res->own_tp != "0")
        //                                                                         {
        //                                                                             $own_od = ""; 
        //                                                                             $on_net = "";
        //                                                                             $company_com = $tp * ($res->own_tp)/100;
        //                                                                             $own_tp = $company_com;
        //                                                                         }
                                                                            
        //                                                                       if($spl_com != null || $spl_com != "")
        //                                                                       {
        //                                                                               if($res->agn_com_type == "OD")
        //                                                                               {
        //                                                                                   $agent_commission = ($own_damage * $spl_com->special_com)/100;
        //                                                                               }
        //                                                                               else if($res->agn_com_type == "TP")
        //                                                                               {
        //                                                                                   $agent_commission = ($tp * $spl_com->special_com)/100;
        //                                                                               }
        //                                                                               else if($res->agn_com_type == "ON-NET")
        //                                                                               {
        //                                                                                   $agent_commission = ($total_premium * $spl_com->special_com)/100;
        //                                                                               }
        //                                                                               else if($res->agn_com_type == "OD_AND_TP")
        //                                                                               {
        //                                                                                   $agent_commission = ($total_premium * $spl_com->special_com)/100;
        //                                                                               }
        //                                                                       }
        //                                                                       else
        //                                                                       {
        //                                                                               $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                                                                      
        //                                                                               if($res->agn_com_type == "OD")
        //                                                                               {
        //                                                                                   if($agent_status->commission_category == "A")
        //                                                                                   {
        //                                                                                       $agent_commission = ($own_damage * $res->a_od)/100;
        //                                                                                   }
        //                                                                                   else if($agent_status->commission_category == "B")
        //                                                                                   {
        //                                                                                       $agent_commission = ($own_damage * $res->b_od)/100;
        //                                                                                   }
        //                                                                                   else if($agent_status->commission_category == "C")
        //                                                                                   {
        //                                                                                       $agent_commission = ($own_damage * $res->c_od)/100;
        //                                                                                   }
        //                                                                                   else if($agent_status->commission_category == "D")
        //                                                                                   {
        //                                                                                       $agent_commission = ($own_damage * $res->d_od)/100;
        //                                                                                   }
        //                                                                               }
        //                                                                               else if($res->agn_com_type == "TP")
        //                                                                               {
        //                                                                                   if($agent_status->commission_category == "A")
        //                                                                                   {
        //                                                                                       $agent_commission = ($tp * $res->a_tp)/100;
        //                                                                                   }
        //                                                                                   else if($agent_status->commission_category == "B")
        //                                                                                   {
        //                                                                                       $agent_commission = ($tp * $res->b_tp)/100;
        //                                                                                   }
        //                                                                                   else if($agent_status->commission_category == "C")
        //                                                                                   {
        //                                                                                       $agent_commission = ($tp * $res->c_tp)/100;
        //                                                                                   }
        //                                                                                   else if($agent_status->commission_category == "D")
        //                                                                                   {
        //                                                                                       $agent_commission = ($tp * $res->d_tp)/100;
        //                                                                                   }
        //                                                                               }
        //                                                                               else if($res->agn_com_type == "ON-NET")
        //                                                                               {
        //                                                                                   if($agent_status->commission_category == "A")
        //                                                                                   {
        //                                                                                       $agent_commission = ($total_premium * $res->a_net)/100;
        //                                                                                   }
        //                                                                                   else if($agent_status->commission_category == "B")
        //                                                                                   {
        //                                                                                       $agent_commission = ($total_premium * $res->b_net)/100;
        //                                                                                   }
        //                                                                                   else if($agent_status->commission_category == "C")
        //                                                                                   {
        //                                                                                       $agent_commission = ($total_premium * $res->c_net)/100;
        //                                                                                   }
        //                                                                                   else if($agent_status->commission_category == "D")
        //                                                                                   {
        //                                                                                       $agent_commission = ($total_premium * $res->d_net)/100;
        //                                                                                   }
        //                                                                               }
        //                                                                               else if($res->agn_com_type == "OD_AND_TP")
        //                                                                               {
        //                                                                                   if($agent_status->commission_category == "A")
        //                                                                                   {
        //                                                                                       $agent_od = ($own_damage * $res->a_od)/100;
        //                                                                                       $agent_tp = ($tp * $res->a_tp)/100;
        //                                                                                       $agent_commission = $agent_od+$agent_tp;
        //                                                                                   }
        //                                                                                   else if($agent_status->commission_category == "B")
        //                                                                                   {
        //                                                                                       $agent_od = ($own_damage * $res->b_od)/100;
        //                                                                                       $agent_tp = ($tp * $res->b_tp)/100;
        //                                                                                       $agent_commission = $agent_od+$agent_tp;
        //                                                                                   }
        //                                                                                   else if($agent_status->commission_category == "C")
        //                                                                                   {
        //                                                                                       $agent_od = ($own_damage * $res->c_od)/100;
        //                                                                                       $agent_tp = ($tp * $res->c_tp)/100;
        //                                                                                       $agent_commission = $agent_od+$agent_tp;
        //                                                                                   }
        //                                                                                   else if($agent_status->commission_category == "D")
        //                                                                                   {
        //                                                                                       $agent_od = ($own_damage * $res->d_od)/100;
        //                                                                                       $agent_tp = ($tp * $res->d_tp)/100;
        //                                                                                       $agent_commission = $agent_od+$agent_tp;
        //                                                                                   }
        //                                                                              }
        //                                                                       }
        //                                                                  }
        //                                                                   if($company_com <= $jayantha_commission)
        //                                                                     {
        //                                                                         $jayantha_commission = $company_com;
        //                                                                         $company_com = 0;
        //                                                                     }
        //                                                                     else
        //                                                                     {
        //                                                                          $company_com = $company_com - $jayantha_commission;
        //                                                                     }
        //                                                                   if($agent_commission <= $jayantha_agent_commission)
        //                                                                     {
        //                                                                           $jayantha_agent_commission = $agent_commission;
        //                                                                           $agent_commission = 0;
        //                                                                             $jayantha_agent_commission;
        //                                                                     }
        //                                                                     else
        //                                                                     {
        //                                                                         $agent_commission = $agent_commission - $jayantha_agent_commission;
        //                                                                     }
        //                                                                      $data = array("agent_commission"=> $agent_commission,
        //                                                                             "agent_commission_amt"=> $jayantha_agent_commission,
        //                                                                             "own_commission_amt"=> $jayantha_commission,
        //                                                                             "own_commission"=> $company_com,
        //                                                                             "calc_com_status" =>"1");
        //                                                                     $update = $this->cm->update_commissions_by_lead_id($data,$lead_id);
                                                                            
        //                                                                     $agc_credit = array(
        //                                                                         'credit'=>$jayantha_agent_commission,
        //                                                                         );
        //                                                                      $agc_debit = array(
        //                                                                         'debit'=>$jayantha_agent_commission,
        //                                                                         );
        //                                                                     $com_credit = array(
        //                                                                         'credit'=>$jayantha_commission,
        //                                                                         );
        //                                                                     $this->cm->accouts_update($agc_credit,'jayantha',$re->lead_id,'Agent commission Credit');
        //                                                                     $this->cm->accouts_update($agc_debit,'jayantha',$re->lead_id,'Own commission Debit');
        //                                                                     $this->cm->accouts_update($com_credit,'jayantha',$re->lead_id,'Own commission Credit');
                                                                            
        //                                                                     $agc_credit = array(
        //                                                                         'credit'=>$agent_commission,
        //                                                                         );
        //                                                                      $agc_debit = array(
        //                                                                         'debit'=>$agent_commission,
        //                                                                         );
        //                                                                     $com_credit = array(
        //                                                                         'credit'=>$company_com,
        //                                                                         );
                                                                            
        //                                                                      $this->cm->accouts_update($agc_credit,'unicorn',$re->lead_id,'Agent commission Credit');
        //                                                                     $this->cm->accouts_update($agc_debit,'unicorn',$re->lead_id,'Own commission Debit');
        //                                                                     $this->cm->accouts_update($com_credit,'unicorn',$re->lead_id,'Own commission Credit');
        //                                                             }
                                                                
                                                                
                                                            
        //                                                 }
        //                                          }
        //                                         }
        //                                  }
        //                             }
        //                             else if($da->commission_type == "3")
        //                             {
        //                                 $commission_id = $commission_id_backup;
        //                                 $classification = $this->cm->check_classification_by_commission_id(array_unique($commission_id));
        //                                 $temp_commission_id = [];
        //                                 $temp_commission_id = $commission_id;
                                    
        //                                  //$commission_id = [];
                                    
        //                                 foreach($classification as $cl)
        //                                 {
                                            
        //                                     if($policy_type == "7" || $policy_type == "12" || $policy_type == "13" || $policy_type == "14" || $policy_type == "59" || $policy_type == "60" || $policy_type == "65" || $policy_type == "66" || $policy_type == "67" || $policy_type == "68" || $policy_type == "69" || $policy_type == "70")
        //                                     {
        //                                         if($cl->classification != "")
        //                                         {
        //                                           $classification = $this->cm->check_seating($v_seating,$policy_type,$temp_commission_id);
                                                   
        //                                             if(count($classification) > 0)
        //                                             {
        //                                                 $gvw_status = "1";
                                                        
        //                                                 foreach($classification as $da)
        //                                                 {
        //                                                     $commission_id[] = $cl->id;
        //                                                     $gvw_status = "1";
        //                                                 }
        //                                             }
        //                                         }
        //                                         else
        //                                         {
        //                                             $commission_id = $temp_commission_id;
        //                                             $gvw_status = "1";
        //                                         }
        //                                     }
        //                                     else if($policy_type == "1" || $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
        //                                     {
        //                                         if($cl->classification != "")
        //                                         {
        //                                             $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                 
        //                                             if($classification != null)
        //                                             {
        //                                                  $temp_min = $classification->from_gvw_cc;
        //                                                  $temp_max = $classification->to_gvw_cc;
                                                         
        //                                                  if(($cc >= $temp_min && $cc <= $temp_max))
        //                                                  {
        //                                                      $commission_id[] = $cl->id;
        //                                                      $gvw_status = "1";
        //                                                  }
        //                                             }
        //                                         }
        //                                         else
        //                                         {
        //                                             $gvw_status = "1";
        //                                             $commission_id = $temp_commission_id;
        //                                         }
        //                                     }
        //                                     else
        //                                     {
        //                                         if($cl->classification != "")
        //                                         {
        //                                             $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                  
        //                                             if($classification != null)
        //                                             {
        //                                                 $temp_min = $classification->from_gvw_cc;
        //                                                 $temp_max = $classification->to_gvw_cc;
                                                        
        //                                                 if($v_gvw >= $temp_min && $v_gvw <= $temp_max)
        //                                                 {
        //                                                     $gvw_status = "1";
        //                                                     $commission_id[] = $cl->id;
        //                                                 }
        //                                             }
        //                                         }
        //                                         else
        //                                         {
        //                                             $gvw_status = "1";
        //                                             $commission_id = $temp_commission_id;
        //                                         }
        //                                     }
        //                                 }
                                    
        //                                 $check_make_1 = $this->cm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                        
        //                                 if(count($check_make_1) > 0)
        //                                 {
        //                                         if(count($check_make_1) > 0)
        //                                         {
        //                                             $commission_id = [];
                                                    
        //                                             foreach($check_make_1 as $da)
        //                                             {
        //                                                  $commission_id[] = $da->commission_id;
        //                                             }
        //                                             $status = "1";
        //                                             $make_status = "1";
        //                                         }
        //                                         else
        //                                         {
        //                                             $make_status = "0";
        //                                         }
        //                                 }
        //                                 else
        //                                 {
        //                                     $check_make = $this->lm->check_make_all_already_exits(array_unique($commission_id),$policy_type);
                                            
        //                                     if(count($check_make) > 0)
        //                                     {
        //                                         $commission_id = [];
                                                
        //                                         foreach($check_make as $da)
        //                                         {
        //                                           $commission_id[] = $da->id;
        //                                         }
                                                
        //                                         $status = "1";
        //                                         $make_status = "1";
        //                                     }
        //                                 }

        //                                 $check_model_1 = $this->lm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                         
        //                                 if(count($check_model_1) > 0)
        //                                 {
        //                                     $commission_id = [];
                                            
        //                                     foreach($check_model_1 as $da)
        //                                     {
        //                                       $commission_id[] = $da->commission_id;
        //                                     }
                                            
        //                                     $status = "1";
        //                                     $model_status = "1";
        //                                 }
        //                                 else
        //                                 {
        //                                     $check_model = $this->pm->check_model_all_already_exits(array_unique($commission_id),$policy_type);
        //                                     if(count($check_model) > 0)
        //                                     {
        //                                             $commission_id = [];
        //                                             foreach($check_model as $da)
        //                                             {
        //                                                  $commission_id[] = $da->id;
        //                                             }
        //                                          $status = "1";
        //                                          $model_status = "1";
        //                                     }
        //                                 }
                                        
        //                                 if($make_status == "1" && $model_status == "1")
        //                                 {
        //                                     $check_varient_1 = $this->cm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$Varient);
                                           
        //                                     if(count($check_varient_1) > 0) 
        //                                     {
        //                                         $commission_id = [];
        //                                         foreach($check_varient_1 as $da)
        //                                         {
        //                                           $commission_id[] = $da->commission_id;
        //                                         }
        //                                         $status = "1";
        //                                         $varient_status = "1";
        //                                     }
        //                                     else
        //                                     {
        //                                         $check_varient = $this->pm->check_varient_all_already_exits(array_unique($commission_id),$policy_type);
        //                                         if(count($check_varient) > 0)
        //                                         {
        //                                             $commission_id = [];
                                                    
        //                                             foreach($check_varient as $da)
        //                                             {
        //                                                  $commission_id[] = $da->id;
        //                                             }
        //                                              $status = "1";
        //                                 	         $varient_status = "1";
        //                                         }
        //                                     }
        //                                 }
        //                                 $state_status = 1;
        //                                 $fuel_type_status = 1;
        //                                 if($status == "1" && $state_status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
        //                                 {
        //                                      $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
                                             
        //                                         if(count($check_rto) > 0)
        //                                         {
        //                                             foreach($check_rto as $rt)
        //                                             {
        //                                                 $com_id = $rt->commission_id;
        //                                             }
                                                    
        //                                             $data1 = array("commission_id"=>$com_id,"com_trigger_status" => "1","com_trigger_date" =>date("Y-m-d"));
        //                                             $update = $this->cm->update_commission($re->id,$data1);
        //                                             $commission_id = $com_id;
        //                                             $own_damage = $re->total_own_damage;
        //                                             $tp = $re->basic_tp;
        //                                             $res123 = $this->lm->fetch_policy_info($commission_id);
        //                                             $agn_commission_type = $res123->agn_com_type ;
        //                                             if($agn_commission_type != "TP")
        //                                             {
        //                                                 $jayantha_commission = ($own_damage * 15)/100;
        //                                                 $jayantha_agent_commission = ($own_damage * 15)/100;
        //                                             }
        //                                             if($agn_commission_type != "OD")
        //                                             {
        //                                                 $jayantha_commission = $jayantha_commission + (($tp * 2.5)/100);   
        //                                             }
                                                    
        //                                             $res = $this->lm->fetch_policy_info($commission_id);
        //                                             $commission_type = $res->commission_type;
                                                    
        //                                             $spl_com = $this->lm->check_spl_commission_for_agent($commission_id,$policy_agency_pos); 
        //                                             if($res != null && $res->commission_type == "2" || $res->commission_type == "3" || $res->commission_type == "1")
        //                                             {
        //                                                             if($res->is_ncb == "Yes" && $no_claim_bonus == "Yes")
        //                                                             {
        //                                                                 $status = "1";
        //                                                                 $company_com = $total_premium * ($res->ncb_percentage)/100;
        //                                                                 $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                                                     
        //                                                                   if($spl_com != null || $spl_com != "")
        //                                                                   {
        //                                                                           if($res->agn_com_type == "OD")
        //                                                                           {
        //                                                                               $agent_commission = ($own_damage * $spl_com->special_com)/100;
        //                                                                           }
        //                                                                           else if($res->agn_com_type == "TP")
        //                                                                           {
        //                                                                               $agent_commission = ($tp * $spl_com->special_com)/100;
        //                                                                           }
        //                                                                           else if($res->agn_com_type == "ON-NET")
        //                                                                           {
        //                                                                               $agent_commission = ($total_premium * $spl_com->special_com)/100;
        //                                                                           }
        //                                                                           else if($res->agn_com_type == "OD_AND_TP")
        //                                                                           {
        //                                                                               $agent_commission = ($total_premium * $spl_com->special_com)/100;
        //                                                                           }
        //                                                                   }
        //                                                                   else
        //                                                                   {
        //                                                                       if($agent_status->commission_category == "A")
        //                                                                       {
        //                                                                           $agent_commission = ($total_premium * $res->a_ncb)/100;
        //                                                                       }
        //                                                                       else if($agent_status->commission_category == "B")
        //                                                                       {
        //                                                                             $agent_commission = ($total_premium * $res->b_ncb)/100;
        //                                                                       }
        //                                                                       else if($agent_status->commission_category == "C")
        //                                                                       {
        //                                                                             $agent_commission = ($total_premium * $res->c_ncb)/100;
        //                                                                       }
        //                                                                       else if($agent_status->commission_category == "D")
        //                                                                       {
        //                                                                             $agent_commission = ($total_premium * $res->d_ncb)/100;
        //                                                                       }
        //                                                                   }
        //                                                             }
        //                                                             else
        //                                                             {
        //                                                                 if($res->on_net != "0")
        //                                                                 {
        //                                                                     $own_od = "";
        //                                                                     $own_tp = "";
        //                                                                     $company_com = $total_premium * ($res->on_net)/100;
        //                                                                     $on_net = $company_com;
        //                                                                 }
        //                                                                 else if($res->own_od != "0" && $res->own_tp != "0")
        //                                                                 {
                                                                            
        //                                                                     $own_od = $own_damage * ($res->own_od)/100;
                                                                            
        //                                                                     $own_tp = $tp * ($res->own_tp)/100;
        //                                                                     $company_com = $own_od+$own_tp;
        //                                                                     $on_net = "";
        //                                                                 }
        //                                                                 else if($res->own_od != "0")
        //                                                                 {
        //                                                                     $on_net = ""; 
        //                                                                     $own_tp = "";
        //                                                                     $company_com = $own_damage * ($res->own_od)/100;
        //                                                                     $own_od = $company_com;
        //                                                                 }
        //                                                                 else if($res->own_tp != "0")
        //                                                                 {
        //                                                                     $own_od = ""; 
        //                                                                     $on_net = "";
        //                                                                     $company_com = $tp * ($res->own_tp)/100;
        //                                                                     $own_tp = $company_com;
        //                                                                 }
                                                                    
        //                                                               if($spl_com != null || $spl_com != "")
        //                                                               {
        //                                                                       if($res->agn_com_type == "OD")
        //                                                                       {
        //                                                                           $agent_commission = ($own_damage * $spl_com->special_com)/100;
        //                                                                       }
        //                                                                       else if($res->agn_com_type == "TP")
        //                                                                       {
        //                                                                           $agent_commission = ($tp * $spl_com->special_com)/100;
        //                                                                       }
        //                                                                       else if($res->agn_com_type == "ON-NET")
        //                                                                       {
        //                                                                           $agent_commission = ($total_premium * $spl_com->special_com)/100;
        //                                                                       }
        //                                                                       else if($res->agn_com_type == "OD_AND_TP")
        //                                                                       {
        //                                                                           $agent_commission = ($total_premium * $spl_com->special_com)/100;
        //                                                                       }
        //                                                               }
        //                                                               else
        //                                                               {
        //                                                                       $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                                                              
        //                                                                       if($res->agn_com_type == "OD")
        //                                                                       {
        //                                                                           if($agent_status->commission_category == "A")
        //                                                                           {
        //                                                                               $agent_commission = ($own_damage * $res->a_od)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "B")
        //                                                                           {
        //                                                                               $agent_commission = ($own_damage * $res->b_od)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "C")
        //                                                                           {
        //                                                                               $agent_commission = ($own_damage * $res->c_od)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "D")
        //                                                                           {
        //                                                                               $agent_commission = ($own_damage * $res->d_od)/100;
        //                                                                           }
        //                                                                       }
        //                                                                       else if($res->agn_com_type == "TP")
        //                                                                       {
        //                                                                           if($agent_status->commission_category == "A")
        //                                                                           {
        //                                                                               $agent_commission = ($tp * $res->a_tp)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "B")
        //                                                                           {
        //                                                                               $agent_commission = ($tp * $res->b_tp)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "C")
        //                                                                           {
        //                                                                               $agent_commission = ($tp * $res->c_tp)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "D")
        //                                                                           {
        //                                                                               $agent_commission = ($tp * $res->d_tp)/100;
        //                                                                           }
        //                                                                       }
        //                                                                       else if($res->agn_com_type == "ON-NET")
        //                                                                       {
        //                                                                           if($agent_status->commission_category == "A")
        //                                                                           {
        //                                                                               $agent_commission = ($total_premium * $res->a_net)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "B")
        //                                                                           {
        //                                                                               $agent_commission = ($total_premium * $res->b_net)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "C")
        //                                                                           {
        //                                                                               $agent_commission = ($total_premium * $res->c_net)/100;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "D")
        //                                                                           {
        //                                                                               $agent_commission = ($total_premium * $res->d_net)/100;
        //                                                                           }
        //                                                                       }
        //                                                                       else if($res->agn_com_type == "OD_AND_TP")
        //                                                                       {
        //                                                                           if($agent_status->commission_category == "A")
        //                                                                           {
        //                                                                               $agent_od = ($own_damage * $res->a_od)/100;
        //                                                                               $agent_tp = ($tp * $res->a_tp)/100;
        //                                                                               $agent_commission = $agent_od+$agent_tp;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "B")
        //                                                                           {
        //                                                                               $agent_od = ($own_damage * $res->b_od)/100;
        //                                                                               $agent_tp = ($tp * $res->b_tp)/100;
        //                                                                               $agent_commission = $agent_od+$agent_tp;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "C")
        //                                                                           {
        //                                                                               $agent_od = ($own_damage * $res->c_od)/100;
        //                                                                               $agent_tp = ($tp * $res->c_tp)/100;
        //                                                                               $agent_commission = $agent_od+$agent_tp;
        //                                                                           }
        //                                                                           else if($agent_status->commission_category == "D")
        //                                                                           {
        //                                                                               $agent_od = ($own_damage * $res->d_od)/100;
        //                                                                               $agent_tp = ($tp * $res->d_tp)/100;
        //                                                                               $agent_commission = $agent_od+$agent_tp;
        //                                                                           }
        //                                                                      }
        //                                                               }
        //                                                          }
                                                                 
        //                                                           if($company_com <= $jayantha_commission)
        //                                                             {
        //                                                                 $jayantha_commission = $company_com;
        //                                                                 $company_com = 0;
        //                                                             }
        //                                                             else
        //                                                             {
        //                                                                  $company_com = $company_com - $jayantha_commission;
        //                                                             }
        //                                                           if($agent_commission <= $jayantha_agent_commission)
        //                                                             {
        //                                                                   $jayantha_agent_commission = $agent_commission;
        //                                                                   $agent_commission = 0;
        //                                                                     $jayantha_agent_commission;
        //                                                             }
        //                                                             else
        //                                                             {
        //                                                                 $agent_commission = $agent_commission - $jayantha_agent_commission;
        //                                                             }
                                                                    
        //                                                               $data = array("agent_commission"=> $agent_commission,
        //                                                                             "agent_commission_amt"=> $jayantha_agent_commission,
        //                                                                             "own_commission_amt"=> $jayantha_commission,
        //                                                                             "own_commission"=> $company_com,
        //                                                                             "calc_com_status" =>"1");
        //                                                                             //echo $lead_id;//json_encode($data);
        //                                                             $update = $this->cm->update_commissions_by_lead_id($data,$lead_id);
        //                                                             $agc_credit = array(
        //                                                                 'credit'=>$jayantha_agent_commission,
        //                                                                 );
        //                                                              $agc_debit = array(
        //                                                                 'debit'=>$jayantha_agent_commission,
        //                                                                 );
        //                                                             $com_credit = array(
        //                                                                 'credit'=>$jayantha_commission,
        //                                                                 );
        //                                                             $this->cm->accouts_update($agc_credit,'jayantha',$re->lead_id,'Agent commission Credit');
        //                                                             $this->cm->accouts_update($agc_debit,'jayantha',$re->lead_id,'Own commission Debit');
        //                                                             $this->cm->accouts_update($com_credit,'jayantha',$re->lead_id,'Own commission Credit');
                                                                    
        //                                                             $agc_credit = array(
        //                                                                 'credit'=>$agent_commission,
        //                                                                 );
        //                                                              $agc_debit = array(
        //                                                                 'debit'=>$agent_commission,
        //                                                                 );
        //                                                             $com_credit = array(
        //                                                                 'credit'=>$company_com,
        //                                                                 );
                                                                    
        //                                                              $this->cm->accouts_update($agc_credit,'unicorn',$re->lead_id,'Agent commission Credit');
        //                                                             $this->cm->accouts_update($agc_debit,'unicorn',$re->lead_id,'Own commission Debit');
        //                                                             $this->cm->accouts_update($com_credit,'unicorn',$re->lead_id,'Own commission Credit');
        //                                                     }
                                                        
                                                        
                                                    
        //                                         }
        //                                  }
        //                             }
        //                         }
        //                   }
        //                   else
        //                   {
        //                       $get_lead_info = $this->cm->get_health_lead_info($re->lead_id);
        //                       $company = $re->company;
        //                       $policy_premium = $re->policy_premium;
        //                       $policy_issue_date = $re->policy_issue_date;
        //                       $bussiness_type = $get_lead_info->business_type;
        //                       $policy_class = $get_lead_info->class;
        //                       $policy_type =  $get_lead_info->policy_type;
        //                       $state = "All";
        //                       $total_premium = $re->total_premium;
        //                       $check = $this->cm->check_health_commission($company,$policy_premium,$policy_class,$bussiness_type,$policy_type,$state,$from_date_1,$to_date_1);
                               
        //                         $commission_id = [];
        //                         $status = "0";
        //                         $make_status = "0";
        //                         $model_status = "0";
        //                         $varient_status = "0";
        //                         $rto_status = "0";
        //                         $gvw_status = "0";
        //                         $fuel_status = "0";
        //                         $state_status = "0";
                               
        //                         foreach($check as $da)
        //                         {
        //                             if($da->commission_type == "1")
        //                             {
        //                                 foreach($check as $da)
        //                             	{
        //                                     $temp_min = $da->no_policy_min;
        //                                     $temp_max = $da->no_policy_max;
                                            
        //                                     if($temp_min <= 1 && $temp_max >= 1)
        //                                     {
        //                                          $status = "1";
        //                                          $commission_id[] = $da->id;
        //                                     }
        //                             	}
                                    	
        //                             	if($status == "1")
        //                             	{
        //                             	     if($da->state != "All")
        //                             	     {
        //                             	         $res = $this->cm->check_health_state($commission_id);
        //                             	         $commission_id = [];
                                    	         
        //                                 	     foreach($res as $da)
        //                                 	     {
        //                                 	           $commission_id[] = $da->id;
        //                                 	           $c_id = $da->id;
        //                                 	     }
        //                             	     }
        //                             	}
                                    	
        //                             	$data1 = array("commission_id"=>$c_id,"com_trigger_status" => "1","com_trigger_date" =>date("Y-m-d"));
        //                                 $update = $this->cm->update_commission($re->id,$data1);
        //                                 $arr = $this->cm->save_policy_data($re->id);
        //                                 $data2 = array("lead_type" => "2","lead_status" =>"completed");
        //                                 $lead_status = $this->cm->update_lead_status($data2,$re->lead_id);
        //                             }
        //                             else if($da->commission_type == "3")
        //                             {
        //                                 foreach($check as $da)
        //                             	{
        //                                     $temp_min = $da->min_val;
        //                                     $temp_max = $da->max_val;
                                            
        //                                     if($temp_min <= $total_premium && $temp_max >= $total_premium)
        //                                     {
        //                                          $status = "1";
        //                                          $commission_id[] = $da->id;
        //                                     }
        //                             	}
                                    	
        //                             	if($status == "1")
        //                             	{
        //                             	     if($da->state != "All")
        //                             	     {
        //                             	         $res = $this->cm->check_health_state($commission_id);
        //                             	         $commission_id = [];
                                    	         
        //                                 	     foreach($res as $da)
        //                                 	     {
        //                                 	           $commission_id[] = $da->id;
        //                                 	           $c_id = $da->id;
        //                                 	     }
        //                             	     }
        //                             	}
                                    	
        //                             	$data1 = array("commission_id"=>$c_id,"com_trigger_status" => "1","com_trigger_date" =>date("Y-m-d"));
                                        
        //                                 echo $re->lead_id."<br>";

        //                                 $update = $this->cm->update_commission($re->id,$data1);
        //                                 $arr = $this->cm->save_policy_data($re->id);
        //                                 $data2 = array("lead_type" => "2","lead_status" =>"completed");
        //                                 $lead_status = $this->cm->update_lead_status($data2,$re->lead_id);
        //                             }
        //                         }
        //                   }
        //               }
                        
        //               echo "success";
        //       }
        //  }
         
           public function calculate_commissions()
           {
                 if($this->session->has_userdata("logged_in"))
                 {
                    $commission_type = "";
                    $agent_commission = 0;
                    $company_com = 0;
                    $status = "0";
                    $arr = $this->cm->get_all_triggred_policies();
                    

                     foreach($arr as $ar)
                     {
                           $commission_id = $ar->commission_id;
                           $total_premium = $ar->total_premium;
                           $no_claim_bonus = $ar->no_claim_bonus;
                           $policy_agency_pos = $ar->policy_agency_pos;
                           $own_damage = $ar->total_own_damage;
                           $tp = $ar->tot_liability_premium;
                           $policy_class = $ar->class;
                           
                           $status = "0";
    
                           if($policy_class == "1")
                           {
                                $res = $this->lm->fetch_policy_info($commission_id);
                                $commission_type = $res->commission_type;
                              
                                $spl_com = $this->lm->check_spl_commission_for_agent($commission_id,$policy_agency_pos); 
                                
                                if($res != null && $res->commission_type == "2" || $res->commission_type == "3" || $res->commission_type == "1")
                                {
                                        if($res->is_ncb == "Yes" && $no_claim_bonus == "Yes")
                                        {
                                            $status = "1";
                                            $company_com = $total_premium * ($res->ncb_percentage)/100;
                                            $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                         
                                               if($spl_com != null || $spl_com != "")
                                               {
                                                      if($res->agn_com_type == "OD")
                                                      {
                                                          $agent_commission = ($own_damage * $spl_com->special_com)/100;
                                                      }
                                                      else if($res->agn_com_type == "TP")
                                                      {
                                                           $agent_commission = ($tp * $spl_com->special_com)/100;
                                                      }
                                                      else if($res->agn_com_type == "ON-NET")
                                                      {
                                                          $agent_commission = ($total_premium * $spl_com->special_com)/100;
                                                      }
                                                      else if($res->agn_com_type == "OD_AND_TP")
                                                      {
                                                          $agent_commission = ($total_premium * $spl_com->special_com)/100;
                                                      }
                                               }
                                               else
                                               {
                                                  if($agent_status->commission_category == "A")
                                                  {
                                                      $agent_commission = ($total_premium * $res->a_ncb)/100;
                                                  }
                                                  else if($agent_status->commission_category == "B")
                                                  {
                                                        $agent_commission = ($total_premium * $res->b_ncb)/100;
                                                  }
                                                  else if($agent_status->commission_category == "C")
                                                  {
                                                        $agent_commission = ($total_premium * $res->c_ncb)/100;
                                                  }
                                                  else if($agent_status->commission_category == "D")
                                                  {
                                                        $agent_commission = ($total_premium * $res->d_ncb)/100;
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
                                        
                                           if($spl_com != null || $spl_com != "")
                                           {
                                                  if($res->agn_com_type == "OD")
                                                  {
                                                      $agent_commission = ($own_damage * $spl_com->special_com)/100;
                                                  }
                                                  else if($res->agn_com_type == "TP")
                                                  {
                                                       $agent_commission = ($tp * $spl_com->special_com)/100;
                                                  }
                                                  else if($res->agn_com_type == "ON-NET")
                                                  {
                                                      $agent_commission = ($total_premium * $spl_com->special_com)/100;
                                                  }
                                                  else if($res->agn_com_type == "OD_AND_TP")
                                                  {
                                                      $agent_commission = ($total_premium * $spl_com->special_com)/100;
                                                  }
                                           }
                                           else
                                           {
                                                  $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                                  
                                                  if($res->agn_com_type == "OD")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($own_damage * $res->a_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($own_damage * $res->b_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($own_damage * $res->c_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($own_damage * $res->d_od)/100;
                                                      }
                                                  }
                                                  else if($res->agn_com_type == "TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($tp * $res->a_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($tp * $res->b_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($tp * $res->c_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($tp * $res->d_tp)/100;
                                                      }
                                                  }
                                                  else if($res->agn_com_type == "ON-NET")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($total_premium * $res->a_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($total_premium * $res->b_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($total_premium * $res->c_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($total_premium * $res->d_net)/100;
                                                      }
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
                                        
                                         $data = array("agent_commission_amt"=> $agent_commission,
                                               "own_commission_amt"=> $company_com,"calc_com_status" =>"1");
                                        $update = $this->cm->update_commissions($data,$ar->id);
                                }
                           }
                           else
                           {
                                $res = $this->lm->fetch_policy_info($commission_id);
                                $commission_type = $res->commission_type;
                                
                                $spl_com = $this->lm->check_spl_commission_for_agent($commission_id,$policy_agency_pos); 

                                if($res != null && $res->commission_type == "3" || $res->commission_type == "1")
                                {
                                        if($res->is_ncb == "Yes" && $no_claim_bonus == "Yes")
                                        {
                                             $company_com = $total_premium * ($res->ncb_percentage)/100;
                                              $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                              
                                               if($spl_com != null || $spl_com != "")
                                               {
                                                 $agent_commission = ($total_premium * $spl_com->special_com)/100;
                                               }
                                               else
                                               {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($total_premium * $res->a_ncb)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                            $agent_commission = ($total_premium * $res->b_ncb)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                            $agent_commission = ($total_premium * $res->c_ncb)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                            $agent_commission = ($total_premium * $res->d_ncb)/100;
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
                                            
                                            $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                            
                                            if($spl_com != null || $spl_com != "")
                                            {
                                                 $agent_commission = ($total_premium * $spl_com->special_com)/100;
                                            }
                                            else
                                            {
                                                  if($agent_status->commission_category == "A")
                                                  {
                                                      $agent_commission = ($total_premium * $res->a_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "B")
                                                  {
                                                      $agent_commission = ($total_premium * $res->b_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "C")
                                                  {
                                                      $agent_commission = ($total_premium * $res->c_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "D")
                                                  {
                                                      $agent_commission = ($total_premium * $res->d_net)/100;
                                                  }
                                            }
                                        }
                                }
                           
                               $data = array("agent_commission_amt"=> $agent_commission,
                                                   "own_commission_amt"=> $company_com,"calc_com_status" =>"1");
                                
                                $update = $this->cm->update_commissions($data,$ar->id);
                                               
                        }
                    }
                    echo "success";
                }
           }
           
             //
             
             public function mismatching_list()
             {
                    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
                	{    		
            		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
                		$this->load->view('header',$pro_data);
                		$this->load->view('commission_mismatching');
                		$this->load->view('footer',$pro_data);
            	    }
             }
             
             
            public function fetch_mismatch_list()
            {
               if($this->session->has_userdata('logged_in')) 
               {
                   $draw = intval($this->input->post("draw"));
                   
                   $from_date = $this->input->post("from_date");
                   $to_date = $this->input->post("to_date");
            	   $arr = [];
            	   $a = $_POST['start'];
                   
                   $result = $this->cm->get_all_business_complete_policies($from_date,$to_date);
                  
                   $a = 0;
                   
                      foreach($result as $re)
                      {
                              $get_lead_info = $this->lm->get_lead_info($re->lead_id);
                              $company = $re->company;
                              $policy_premium = $re->policy_premium;
                              $policy_issue_date = $re->policy_issue_date;
                              $bussiness_type = $get_lead_info->business_type;
                              $policy_class = $get_lead_info->class;
                              $policy_type =  $get_lead_info->policy_type;
                              $state = $get_lead_info->state;
                              $rto = $get_lead_info->rto;
                              $regndate =$get_lead_info->regn_date;
                              $today = date("Y-m-d");
                              $diff = date_diff(date_create($regndate), date_create($today));
                              $age = $diff->format('%y');
                              $fuel_type = $get_lead_info->vechi_fuel_type;
                              $cc  = $get_lead_info->vechi_cc;
                              $v_gvw = $get_lead_info->vechi_gvw;
                              $v_seating = $get_lead_info->passenger_carrying;
                              $ins_classification = $get_lead_info->vechi_classfication;
                              $make = $get_lead_info->vechi_make;
                              $model = $get_lead_info->vechi_model;
                              $Varient = $get_lead_info->vechi_varient;
                              $premium_name = $this->cm->get_policy_premium_name($policy_premium);
                              
                              $check = $this->cm->check_commission($company,$policy_premium,$policy_class,$bussiness_type,$policy_type,$state,$from_date,$to_date);
                              
                                $commission_id = [];
                                $status = "0";
                                $make_status = "0";
                                $model_status = "0";
                                $varient_status = "0";
                                $rto_status = "0";
                                $gvw_status = "0";
                                $fuel_status = "0";
                                $state_status = "0";
                                $age_status = "0";
                                
                                if($premium_name != "" || $premium_name != null)
                                {
                                  $premium_c_name = $premium_name->name;
                                }
                                else
                                {
                                    $premium_name = "";
                                }
                                
                                foreach($check as $da)
                                {
                                    if($da->commission_type == "2")
                                    {
                                        $temp_min = $da->vehicle_age_min;
                                        $temp_max = $da->vehicle_age_max;
                                        
                                        $g_status = "0";
                                        $fuel_status = "0";

                                        if($temp_min <= $age && $temp_max >= $age)
                                        {
                                        	$g_status = "1";
                                        }
                                        
                                        if($fuel_type == "1")
                                        {
                                        	if($da->fuel_type == "4" || $da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "6")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                                        if($fuel_type == "2")
                                        {
                                            if($da->fuel_type == "5" || $da->fuel_type == "2" || $da->fuel_type == "6")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                                        if($fuel_type == "5")
                                        {
                                            if($da->fuel_type == "5" || $da->fuel_type == "1" || $da->fuel_type == "2" || $da->fuel_type == "6")
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
                                            if($da->fuel_type == "7" || $da->fuel_type == "6")
                                        	{
                                        	    $fuel_status = "1";
                                        	}
                                        }
                                        

                                        if($g_status == "1" && $fuel_status == "1")
                                        {
                                            $commission_id[] = $da->id;
                                            $status = "1";
                                            $age_status = "1";
                                            $fuel_type_status = "1";
                                        }
                                    }
                                }


                                 if($status == "1" && $age_status == "1" && $fuel_type_status == "1")
                                 {
                                    $check_state = $this->cm->check_state_by_commission_id(array_unique($commission_id));
                                    
                                    $commission_id = [];
                                    
                                    foreach($check_state as $da)
                                    {
                                        if($da->state == $state)
                                        {
                                             $commission_id[] = $da->id;
                                             $state_status = "1";
                                        }
                                        else if($da->state == "All")
                                        {
                                            $commission_id[] = $da->id;
                                            $state_status = "1";
                                        }
                                    }
                                    

                                    if($state_status == "1")
                                    {
                                        $classification = $this->cm->check_classification_by_commission_id(array_unique($commission_id));
                                        $temp_commission_id = [];
                                        $temp_commission_id = $commission_id;
                                        $commission_id = [];
                                        
                                        foreach($classification as $cl)
                                        {
                                            if($policy_type == "7" || $policy_type == "12" || $policy_type == "13" || $policy_type == "14" || $policy_type == "59" || $policy_type == "60" || $policy_type == "65" || $policy_type == "66" || $policy_type == "67" || $policy_type == "68" || $policy_type == "69" || $policy_type == "70")
                                            {
                                                if($cl->classification != "")
                                                {
                                                  $classification = $this->cm->check_seating($v_seating,$policy_type,$commission_id);
                                                   
                                                    if(count($classification) > 0)
                                                    {
                                                        $gvw_status = "1";
                                                        
                                                        foreach($classification as $da)
                                                        {
                                                            $commission_id[] = $cl->id;
                                                            $gvw_status = "1";
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    $commission_id = $temp_commission_id;
                                                    $gvw_status = "1";
                                                }
                                            }
                                            else if($policy_type == "1" || $policy_type == "2" || $policy_type == "3" || $policy_type == "4" || $policy_type == "55")
                                            {
                                                if($cl->classification != "")
                                                {
                                                    $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                 
                                                    if($classification != null)
                                                    {
                                                         $temp_min = $classification->from_gvw_cc;
                                                         $temp_max = $classification->to_gvw_cc;
                                                         
                                                         if(($cc >= $temp_min && $cc <= $temp_max))
                                                         {
                                                             $commission_id[] = $cl->id;
                                                             $gvw_status = "1";
                                                         }
                                                    }
                                                }
                                                else
                                                {
                                                    $gvw_status = "1";
                                                    $commission_id = $temp_commission_id;
                                                }
                                            }
                                            else
                                            {
                                                if($cl->classification != "")
                                                {
                                                    $classification = $this->lm->get_classification($cl->classification,$policy_type);
                                                  
                                                    if($classification != null)
                                                    {
                                                        $temp_min = $classification->from_gvw_cc;
                                                        $temp_max = $classification->to_gvw_cc;
                                                        
                                                        if($v_gvw >= $temp_min && $v_gvw <= $temp_max)
                                                        {
                                                            $gvw_status = "1";
                                                            $commission_id[] = $cl->id;
                                                        }
                                                    }
                                                }
                                                else
                                                {
                                                    $gvw_status = "1";
                                                    $commission_id = $temp_commission_id;
                                                }
                                            }
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
                                         $check_make_1 = $this->cm->check_make_already_exits(array_unique($commission_id),$policy_type,$make);
                                            
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
                                                $check_model_1 = $this->cm->check_model_already_exits(array_unique($commission_id),$policy_type,$make,$model);
                                                
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
                                              $check_varient_1 = $this->cm->check_varient_already_exits(array_unique($commission_id),$policy_type,$make,$model,$Varient);
                                               
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
                                    }
                                    
                                    if($status == "0")
                                    {
                                       $a++;
                                        $arr[] = array(
                                                   $a,
                                                   "INSURANCE COMPANY OR DATE OR SLAB MISMATCHED",
                                                    $re->lead_id,
                                                    $re->company_name,
                                                    $re->policy_type."/".$premium_c_name,
                                                    $rto." / ".$cc." /".$v_gvw,
                                           );
                                    }
                                    else if($state_status == "0")
                                    {
                                    $a++;
                                        $arr[] = array(
                                                   $a,
                                                   "State Mismatched",
                                                    $re->lead_id,
                                                    $re->company_name,
                                                    $re->policy_type."/".$premium_c_name,
                                                    $rto." / ".$cc." /".$v_gvw,
                                           );
                                    }
                                    else if($fuel_type_status == "0")
                                    {
                                       $a++;
                                        $arr[] = array(
                                            $a,
                                            "FUEL TYPE MISMATCHED",
                                            $re->lead_id,
                                            $re->company_name,
                                            $re->policy_type."/".$premium_c_name,
                                            $rto." / ".$cc." /".$v_gvw,
                                        );
                                    }
                                    else if($gvw_status == "0")
                                    {
                                        $a++;
                                        
                                        $arr[] = array(
                                                $a,
                                                "Classification Mismatched",
                                                $re->lead_id,
                                                $re->company_name,
                                                $re->policy_type."/".$premium_c_name,
                                                $rto." / ".$cc." /".$v_gvw,
                                            );
                                    }
                                    else if($make_status == "0")
                                    {
                                       $a++;
                                        $arr[] = array(
                                                    $a,
                                                    "MAKE MISMACTHED",
                                                     $re->lead_id,
                                                    $re->company_name,
                                                    $re->policy_type."/".$premium_c_name,
                                                    $rto." / ".$cc." /".$v_gvw,
                                                );
                                    }
                                    else if($model_status == "0")
                                    {
                                            $a++;
                                            $arr[] = array(
                                                $a,
                                                "MODEL MISMACTHED",
                                                $re->lead_id,
                                                $re->company_name,
                                                $re->policy_type."/".$premium_c_name,
                                                $rto." / ".$cc." /".$v_gvw,
                                            );
                                    }
                                    else if($varient_status == "0")
                                    {
                                       $a++;
                                       $arr[] = array(
                                                    $a,
                                                    "VARIENT MISMACTHED",
                                                    $re->lead_id,
                                                    $re->company_name,
                                                    $re->policy_type."/".$premium_c_name,
                                                    $rto." / ".$cc." /".$v_gvw,
                                                );
                                    }
                                    
                                    if($status == "1" && $state_status == "1" && $fuel_type_status == "1" && $gvw_status == "1" && $make_status == "1" && $model_status == "1" && $varient_status == "1")
                                    {
                                          $check_rto = $this->cm->check_rto_already_exits_2(array_unique($commission_id),$rto);
                                           
                                            if(count($check_rto) < 0)
                                            {
                                                $a++;
                                                $arr[] = array(
                                                    $a,
                                                    "RTO MISMATCTHED",
                                                    $re->lead_id,
                                                    $re->company_name,
                                                    $re->policy_type."/".$premium_c_name,
                                                    $rto." / ".$cc." /".$v_gvw,
                                                );
                                            }
                                    }
                             }
                                 else 
                                 {
                                     $a++;
                                        $arr[] = array(
                                                   $a,
                                                   "INSURANCE COMPANY OR DATE OR Age Mismatched",
                                                    $re->lead_id,
                                                    $re->company_name,
                                                    $re->policy_type."/".$premium_c_name,
                                                    $age ."/".$rto." / ".$cc." /".$v_gvw,
                                           );
                                 }
                      }
                
                    $result = array(
                    "draw"=> $draw,
                    "recordsTotal"=> $this->cm->get_filtered_business_complete_count($from_date,$to_date),
                    "recordsFiltered"=> $this->cm->get_all_business_complete_count($from_date,$to_date),
                    "data"=>$arr,
                    );
                    echo json_encode($result);
              }
         }
         
             public function updaterto()
             {
                  $res = $this->cm->get_all_pondi_rto();
                  
                  foreach($res as $da)
                  {
                      $data = array("state" =>"5");
                      $update = $this->cm->update_state($data,$da->commission_id);
                  }
                  echo "success";
             }
         
             public function update_lead_status()
             {
                 $res = $this->cm->get_all_policy_data();
                 
                 foreach($res as $da)
                 {
                     $data = array("lead_type" => "2","lead_status" => "completed");
                     $update = $this->cm->update_leads($data,$da->lead_id);
                 }
                 echo "success";
             }
             
             
         public function get_swap_ai_data()
         {
               if($this->session->has_userdata('logged_in')) 
               {
                   $id = $this->input->post("id");
                   
                   $data = $this->cm->get_current_ai($id);
                   
                   $res = $this->cm->get_ai_data($id);

                   $content = "<option value = ''>--Select--</option>";
                   
                   foreach($res as $da)
                   {
                       $content .="<option value='".$da->id."'>".$da->username."</option>";
                   }
                   
                   $content_1 = "<option value = ".$data->id.">".$data->username."</option>";
                   
                   echo json_encode(array("current_ai" =>$content_1,"other_ai"=>$content));
               }
           }
           
         public function swap_ai_data()
         {
              if($this->session->has_userdata('logged_in')) 
              {
                $swap_ai_1 = $this->input->post("swap_ai_1");
                $swap_ai_2 = $this->input->post("swap_ai_2");
             
               $agent0 = $this->cm->get_agents_pos_datas($swap_ai_1);
               $agent1 = $this->cm->get_agents_pos_datas($swap_ai_2);
               
               foreach($agent0 as $da)
               {
                   $array0 = array("area_incharge" =>$swap_ai_2);
                   $res_1 = $this->cm->update_agents_pos_datas($array0,$da->id);
               }
               
               foreach($agent1 as $da)
               {
                   $array1 = array("area_incharge" =>$swap_ai_1);
                   $res_2 = $this->cm->update_agents_pos_datas($array1,$da->id);
               }
                
                   
                $ai_1_regions = $this->cm->get_ai_regions_id($swap_ai_1);
                $ai_2_regions = $this->cm->get_ai_regions_id($swap_ai_2);
                
                
                $delete0 = $this->cm->delete_ai_regions($swap_ai_1);
                $delete1 = $this->cm->delete_ai_regions($swap_ai_2);
                
               foreach($ai_1_regions as $da)
               {
                   $data0 = array("ai_id" => $swap_ai_2,"region_id" =>$da->region_id);
                  
                  if(!$this->cm->check_this_region_ai_already_exits($da->region_id,$swap_ai_2))
                  {
                      $update = $this->cm->swap_ai_regions($data0);
                  }
               }
      
               foreach($ai_2_regions as $da)
               {
                   $data1 = array("ai_id" => $swap_ai_1,"region_id" =>$da->region_id);
                   
                  if(!$this->cm->check_this_region_ai_already_exits($da->region_id,$swap_ai_1))
                  {
                      $update = $this->cm->swap_ai_regions($data1);
                  }
               }
               
               $ai_1_leads = $this->cm->get_all_active_leads_ai($swap_ai_1);
               $ai_2_leads = $this->cm->get_all_active_leads_ai($swap_ai_2);
               
             
               
               foreach($ai_1_leads as $da)
               {
                   $arr0 = array("area_incharge" =>$swap_ai_2,"old_ai" =>$swap_ai_1);
                   $result = $this->cm->update_leads_records_ai($arr0,$da->id);
               }
               
               foreach($ai_2_leads as $da)
               {
                   $arr1 = array("area_incharge" =>$swap_ai_1,"old_ai" =>$swap_ai_2);
                   $result = $this->cm->update_leads_records_ai($arr1,$da->id);
               }
               
               echo "Success";
       
              }
         }
         
         public function create_tds_ledger($pos_code)
         {
              if($this->session->has_userdata('logged_in')) 
              {
                    $max_acc_id = $this->cm->get_last_acc_id();
                    $new_acc_id = $max_acc_id->accid+1;
                    $new_vcharaccid =  "acc".$new_acc_id;
                    
                    $data_1 = array(
                          "accid" => $new_acc_id,
                          "account_id" =>$new_vcharaccid,
                          "type" =>"acc",
                          "account_name" =>$pos_code,
                          "accvarcharid" =>"acc0226",
                          "parentid" => "0226",
                          "mainchracctype" =>"2",
                      );
                      
                     $res_1 = $this->am->add_sub_ledger($data_1);
              }
         }
         
          public function extra_commission_calc()
          {
                 if($this->session->has_userdata("logged_in"))
                 {
                     
                    $date = "2022-10-01";
                    $to_date = "2022-10-31";
                    $res = $this->cm->get_extra_com_agents($date);
                  
                    foreach($res as $da)
                    {
                        $total_od = 0;
                        $total_tp = 0;
                        $total_net = 0;
                        $total_nop = 0;
                        
                        $data0 = $this->cm->get_policy_types($da->id);
                        $data1 = $this->cm->get_policy_cover_types($da->id);
                        $arr = $this->cm->get_total_policy_records_by_agent($da->insurer,$data0->policy_type,$data1->policy_cover,$da->agent_id,$date,$to_date);
                        $tot_premium = $this->cm->get_total_policy_amounts_by_agent($da->insurer,$data0->policy_type,$data1->policy_cover,$da->agent_id,$date,$to_date);
                        
                        $agn_details = $this->cm->get_agent_details($da->agent_id);
                        $total_nop =  count($arr) + $total_nop;
                      
                        foreach($arr as $ar)
                        {
                            if($da->target == "NOP")
                            {
                                if($da->target_val >= $total_nop)
                                {
                                    $extra_com = $da->extra_com;
                                    $get_com = $this->cm->get_orginal_payout_commission($ar->commission_id);
                                    $agn_category = $agn_details->commission_category;
                                    
                                    if($get_com->agn_com_type == "ON-NET")
                                    {
                                        $extra_amt = $ar->total_premium * $extra_com/100;
                                    }
                                    else if($get_com->agn_com_type == "TP")
                                    {
                                        $extra_amt = $ar->tp * $extra_com/100;
                                    }
                                    else if($get_com->agn_com_type == "OD")
                                    {
                                         $extra_amt = $ar->od * $extra_com/100;
                                    }
                                    
                                    $data_1 = array("extra_com" =>$extra_amt);
                                    $update = $this->cm->update_extra_com($data_1,$ar->id);
                                }
                            }
                            else if($da->target == "Amount")
                            {
                                if($tot_premium->tot_premium >= $da->target_val)
                                {
                                    $extra_com = $da->extra_com;
                                    $get_com = $this->cm->get_orginal_payout_commission($ar->commission_id);
                                    $agn_category = $agn_details->commission_category;
                                    
                                    if($get_com->agn_com_type == "ON-NET")
                                    {
                                        $extra_amt = $ar->total_premium * $extra_com/100;
                                    }
                                    else if($get_com->agn_com_type == "TP")
                                    {
                                        $extra_amt = $ar->tp * $extra_com/100;
                                    }
                                    else if($get_com->agn_com_type == "OD")
                                    {
                                         $extra_amt = $ar->od * $extra_com/100;
                                    }
                                    $data_1 = array("extra_com" =>$extra_amt);
                                    $update = $this->cm->update_extra_com($data_1,$ar->id);
                                }
                            }
                        }
                    }
                    echo "success";
                }
           }
           
           
           public function upload_temp_data()
           {
                $pro_data["project_info"] = $this->mm->fetch_project_info();
                $this->load->view('header',$pro_data);
                $this->load->view("upload_temp_data");
                $this->load->view('footer',$pro_data);
           }
           
           public function upload_data()
           {
                $this->load->library('excel');
            	$file = $this->input->post("excel_file");
            	$path = $_FILES["excel_file"]["tmp_name"];
            	$object = PHPExcel_IOFactory::load($path);
            
            	foreach($object->getWorksheetIterator() as $worksheet)
            	{
            		$highestRow    = $worksheet->getHighestRow();
            		$highestColumn = $worksheet->getHighestColumn();
            
            		for($row=2; $row<= $highestRow ; $row++)
            		{
                		$lead_id = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                		$data = array("lead_type" =>"1","lead_status" =>"open");
                		$update = $this->cm->update_lead_status($data,$lead_id);
                		$res = $this->cm->check_this_lead_id_already_exits($lead_id);
                		if($lead_id < 1)
                		{
                		    	$arr = $this->cm->save_temp_data($lead_id);
                		}
                		$data0 = $this->cm->delete_policy_data($lead_id);
                	}
                } 
                
                echo "success";
           }
           
           
    public function dealers()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["region"] = $this->cm->fetch_regions();
		   	$data["class"] = $this->cm->fetch_policy_class();
    		$this->load->view('header',$pro_data);
    		$this->load->view('dealers',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
	        $data["region"] = $this->cm->fetch_regions();
	        $data["class"] = $this->cm->fetch_policy_class();
    		$this->load->view('header',$pro_data);
    		$this->load->view('dealers',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}
	
	
	public function add_dealer_details()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{ 
        	  $regions= $this->input->post("regions");
              $dealer_name= $this->input->post("dealer_name");
              $dealer_mobile_no= $this->input->post("dealer_mobile_no");
              $email= $this->input->post("email");
              $address= $this->input->post("address");
              $remark= $this->input->post("remark");
              $p_type = $this->input->post("p_type");
              $p_class = $this->input->post("p_class");
              $brand = $this->input->post("brand");
              $contact_person = $this->input->post("contact_person");
              $contact_email = $this->input->post("contact_email");
              $add_contact_no = $this->input->post("contact_no");
              
              $code = strtoupper(substr($dealer_name,0,3));
              
              $res = $this->cm->check_dealer_code($code);
              
                $dealer_code =$code.(str_pad(($res->count+1),3,"0",STR_PAD_LEFT));
          
              
            $data = array(
                  "region" =>$regions,
                  "p_class" =>$p_class,
                  "p_type" =>$p_type,
                  "brand" =>$brand,
                  "dealer_name" =>$dealer_name,
                  "dealer_code" =>$dealer_code,
                  "mobile"=>$dealer_mobile_no,
                  "email"=>$email,
                  "address"=>$address,
                  "remark" =>$remark,
                  "created_by" =>$this->session->userdata("session_id"),
                   "date" =>date("Y-m-d H:i:s"),
                  );
                  
            $res = $this->cm->add_dealer_details($data);
            if( $res ){
		        $this->audit->log('list_of_dealers', 'INSERT', null, null, $data);
		    }
            for($i = 0;$i<count($contact_person);$i++)
            {
                  $data1 = array(
                          "dealer_id" =>$res,
                          "contact_person" =>$contact_person[$i],
                          "contact_no" =>$add_contact_no[$i],
                          "c_email" =>$contact_email[$i],
                          "created_by" =>$this->session->userdata("session_id"),
                          "date" =>date("Y-m-d H:i:s"),
                        );
                $res1 = $this->cm->add_dealer_contact_info($data1);
                if( $res1 ){
    		        $this->audit->log('dealers_contact_info', 'INSERT', null, null, $data1);
    		    }
            }
            
            echo "success";
    	}
	}
	
	public function fetch_dealers()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $draw = intval($this->input->post("draw"));
            $region= $this->input->post("region");
            $brand =$this->input->post("brand");
            $policy_type = $this->input->post("policy_type");
            $mobile_no= $this->input->post("mobile_no");
            $dealer_name= $this->input->post("dealer_name");
    
    		$res = $this->cm->fetch_dealers($region,$brand,$policy_type,$mobile_no,$dealer_name);
    
    		$arr = [];
            $a = 0 ;
            
            foreach($res as $da)
            {
            	$a++;
    
                $action = "<button class='btn btn-info btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i></button>&nbsp;<button class='btn btn-danger btn-xs' onclick=view_data(".$da->id.")><i class='fa fa-eye'></i></button>";
                
                $arr[] = array(
                    $a, 
                    $da->region,
                    $da->dealer_name,
                    $da->mobile,
                    $da->brand,
                    $da->p_class,
                    $da->p_type,
                    $da->address,
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
	
	public function fetch_dealers_contact_info()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
            $id = $this->input->post("id");
            $res = $this->cm->fetch_dealers_details($id);
            $res_1 = $this->cm->fetch_dealers_contact_info($id);

        $content = "<table class='table'>
                <tr>
                    <td>Dealer Name</td> 
                    <td>".$res->dealer_name."</td>
                </tr>
                
                <tr>
                    <td>Region</td> 
                    <td>".$res->region."</td>
                </tr>
                
                <tr>
                    <td>Mobile</td> 
                    <td>".$res->mobile."</td>
                </tr>
                
                <tr>
                    <td>Email</td> 
                    <td>".$res->email."</td>
                </tr>
                
                 <tr>
                    <td>Brand</td> 
                    <td>".$res->brand."</td>
                </tr>
                
                 <tr>
                    <td>Policy Class</td> 
                    <td>".$res->p_class."</td>
                </tr>
                
                 <tr>
                    <td>Policy Type</td> 
                    <td>".$res->p_type."</td>
                </tr>
            
                <tr>
                    <td>Address</td> 
                    <td>".$res->address."</td>
                </tr>
            </table>";
            
            foreach($res_1 as $da)
            {
                $content .= "
                            <table class = 'table table-bordered'>
                                <tr>
                                       <td>Contact Person</td>
                                       <td>".$da->contact_person."</td>
                                </tr>
                                
                                 <tr>
                                       <td>Contact no</td>
                                       <td>".$da->contact_no."</td>
                                </tr>
                                
                                <tr>
                                       <td>Email</td>
                                       <td>".$da->c_email."</td>
                                </tr>
                        </table>";
            }
            echo $content;
    	}
	}
	
	public function export_dealers()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $region= $this->input->post("region");
            $fromdate =$this->input->post("fromdate");
            $todate = $this->input->post("todate");
            $mobile_no= $this->input->post("mobile_no");
            $dealer_name= $this->input->post("dealer_name");
    
    		$res = $this->cm->fetch_dealers($region,$fromdate,$todate,$mobile_no,$dealer_name);
         
    	   
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
            
            $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Dealers Report');
            
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
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Dealer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Region');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Policy type');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Policy Class');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Mobile No');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Email Id');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Remarks');
        $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Brand');
        $row_count = 5;
        $a = 0;
     
        foreach($res as $da)
        {
            $res0 = $this->cm->fetch_dealers_contact_info($da->id);
            
            $a++;
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->dealer_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->region);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->p_class);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , $da->p_type);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $da->mobile);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $da->address);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , $da->remark);
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row_count , $da->brand);
            $x = "J";
            $i =0;
            
            foreach($res0 as $das)
            {
                $i++;
                $x++;
                $objPHPExcel->getActiveSheet()->SetCellValue($x.'4', 'Contact Person'.$i);
                $objPHPExcel->getActiveSheet()->SetCellValue($x.$row_count , $das->contact_person);
                $x++;
                $objPHPExcel->getActiveSheet()->SetCellValue($x.'4', 'Contact No'.$i);
                $objPHPExcel->getActiveSheet()->SetCellValue($x.$row_count , $das->contact_no);
                $x++;
                $objPHPExcel->getActiveSheet()->SetCellValue($x.'4', 'Email'.$i);
                $objPHPExcel->getActiveSheet()->SetCellValue($x.$row_count , $das->c_email);
                $x++;
            }
            
            $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
            $row_count++;
        }
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter->save('./datas/reports/dealers_report.xlsx');
            echo base_url()."/datas/reports/dealers_report.xlsx";
    	}
	}

      public function fetch_edit_dealers()
      {
            if($this->session->has_userdata('logged_in')) 
        	{
        	    $id = $this->input->post("id");
                $res = $this->cm->fetch_dealers_details($id);
                $res0 = $this->cm->fetch_dealers_contact_info($id);
                echo json_encode(array("basic"=>$res,"contact_info"=>$res0));
        	}
      }
   
       public function edit_dealer_details()
       {
           if($this->session->has_userdata('logged_in')) 
        	{
        	  $id = $this->input->post("id");
        	  $regions= $this->input->post("regions");
              $dealer_name= $this->input->post("dealer_name");
              $dealer_mobile_no= $this->input->post("dealer_mobile_no");
              $email= $this->input->post("email");
              $address= $this->input->post("address");
              $remark= $this->input->post("remark");
              $p_type = $this->input->post("p_type");
              $p_class = $this->input->post("p_class");
              $brand = $this->input->post("brand");
              $contact_person = $this->input->post("contact_person");
              $contact_email = $this->input->post("contact_email");
              $add_contact_no = $this->input->post("contact_no");
               
                
                $data = array(
                  "region" =>$regions,
                  "p_class" =>$p_class,
                  "p_type" =>$p_type,
                  "brand" =>$brand,
                  "dealer_name" =>$dealer_name,
                  "mobile"=>$dealer_mobile_no,
                  "email"=>$email,
                  "address"=>$address,
                  "remark" =>$remark,
                  "created_by" =>$this->session->userdata("session_id"),
                   "date" =>date("Y-m-d H:i:s"),
                  );
                  
                $old_data = $this->cm->fetch_dealers_details($id);
                $res = $this->cm->edit_dealer_details($data,$id);
                if( $res ){
    		        $this->audit->log('list_of_dealers', 'UPDATE', null, $old_data, $data);
    		    }
    		    
    		    $old_data = $this->cm->fetch_dealers_contact_info($id);
                $data0 = $this->cm->remove_contact_details($id);
                
                if( $data0 ){
                    $this->audit->log('dealers_contact_info', 'DELETE', null, $old_data, null);
                }
            
                for($i = 0;$i<count($contact_person);$i++)
                {
                      $data1 = array(
                              "dealer_id" =>$id,
                              "contact_person" =>$contact_person[$i],
                              "contact_no" =>$add_contact_no[$i],
                              "c_email" =>$contact_email[$i],
                              "created_by" =>$this->session->userdata("session_id"),
                              "date" =>date("Y-m-d H:i:s"),
                            );
                    $res1 = $this->cm->add_dealer_contact_info($data1);
                    if( $res1 ){
                        $this->audit->log('dealers_contact_info', 'INSERT', null, null, $data1);
                    }
                }
        	}
       }
       
          public function update_active_policy_com()
          {
                    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
                	{    		
            		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
                		$this->load->view('header',$pro_data);
                		$this->load->view('update_commissions');
                		$this->load->view('footer',$pro_data);
            	    }
          }
          
           public function update_commissions()
           {
                 if($this->session->has_userdata("logged_in"))
                 {
                    $commission_type = "";
                    $agent_commission = 0;
                    $company_com = 0;
                    $status = "0";
                    
                    $s_date = $this->input->post("f_date");
                    $end_date = $this->input->post("to_date");
                    

                    $arr = $this->cm->get_active_policy_details($s_date,$end_date);
                    
                    
                     foreach($arr as $ar)
                     {
                           $commission_id = $ar->commission_id;
                           $total_premium = $ar->total_premium;
                           $no_claim_bonus = $ar->no_claim_bonus;
                           $policy_agency_pos = $ar->policy_agency_pos;
                           $own_damage = $ar->total_own_damage;
                           $tp = $ar->tot_liability_premium;
                           $policy_class = $ar->class;
                           $status = "0";
                           

                           if($policy_class == "1")
                           {
                                $res = $this->lm->fetch_policy_info($commission_id);
                                $commission_type = $res->commission_type;
                                

                                

                                $spl_com = $this->lm->check_spl_commission_for_agent($commission_id,$policy_agency_pos); 
                         
                                
                                if($res != null && $res->commission_type == "2" || $res->commission_type == "3" || $res->commission_type == "1")
                                {
                                        if($res->is_ncb == "Yes" && $no_claim_bonus == "Yes")
                                        {
                                            $status = "1";
                                            $company_com = $total_premium * ($res->ncb_percentage)/100;
                                            $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                         
                                               if($spl_com != null || $spl_com != "")
                                               {
                                                      if($res->agn_com_type == "OD")
                                                      {
                                                          $agent_commission = ($own_damage * $spl_com->special_com)/100;
                                                      }
                                                      else if($res->agn_com_type == "TP")
                                                      {
                                                           $agent_commission = ($tp * $spl_com->special_com)/100;
                                                      }
                                                      else if($res->agn_com_type == "ON-NET")
                                                      {
                                                          $agent_commission = ($total_premium * $spl_com->special_com)/100;
                                                      }
                                                      else if($res->agn_com_type == "OD_AND_TP")
                                                      {
                                                          $agent_commission = ($total_premium * $spl_com->special_com)/100;
                                                      }
                                               }
                                               else
                                               {
                                                  if($agent_status->commission_category == "A")
                                                  {
                                                      $agent_commission = ($total_premium * $res->a_ncb)/100;
                                                  }
                                                  else if($agent_status->commission_category == "B")
                                                  {
                                                        $agent_commission = ($total_premium * $res->b_ncb)/100;
                                                  }
                                                  else if($agent_status->commission_category == "C")
                                                  {
                                                        $agent_commission = ($total_premium * $res->c_ncb)/100;
                                                  }
                                                  else if($agent_status->commission_category == "D")
                                                  {
                                                        $agent_commission = ($total_premium * $res->d_ncb)/100;
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
                                        
                                           if($spl_com != null || $spl_com != "")
                                           {
                                                  if($res->agn_com_type == "OD")
                                                  {
                                                      $agent_commission = ($own_damage * $spl_com->special_com)/100;
                                                  }
                                                  else if($res->agn_com_type == "TP")
                                                  {
                                                       $agent_commission = ($tp * $spl_com->special_com)/100;
                                                  }
                                                  else if($res->agn_com_type == "ON-NET")
                                                  {
                                                      $agent_commission = ($total_premium * $spl_com->special_com)/100;
                                                  }
                                                  else if($res->agn_com_type == "OD_AND_TP")
                                                  {
                                                      $agent_commission = ($total_premium * $spl_com->special_com)/100;
                                                  }
                                           }
                                           else
                                           {
                                                  $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                                  
                                                  if($res->agn_com_type == "OD")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($own_damage * $res->a_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($own_damage * $res->b_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($own_damage * $res->c_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($own_damage * $res->d_od)/100;
                                                      }
                                                  }
                                                  else if($res->agn_com_type == "TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($tp * $res->a_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($tp * $res->b_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($tp * $res->c_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($tp * $res->d_tp)/100;
                                                      }
                                                  }
                                                  else if($res->agn_com_type == "ON-NET")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($total_premium * $res->a_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($total_premium * $res->b_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($total_premium * $res->c_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($total_premium * $res->d_net)/100;
                                                      }
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
                                     

                                         $data = array("agent_commission_amt"=> $agent_commission,
                                               "own_commission_amt"=> $company_com,"calc_com_status" =>"1");
                                        $update = $this->cm->update_commissions($data,$ar->id);
                                }
                           }
                           else
                           {
                                $res = $this->lm->fetch_policy_info($commission_id);
                                $commission_type = $res->commission_type;
                                
                                $spl_com = $this->lm->check_spl_commission_for_agent($commission_id,$policy_agency_pos); 

                                if($res != null && $res->commission_type == "3" || $res->commission_type == "1")
                                {
                                        if($res->is_ncb == "Yes" && $no_claim_bonus == "Yes")
                                        {
                                              $company_com = $total_premium * ($res->ncb_percentage)/100;
                                              $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                              

                                             if($spl_com != null || $spl_com != "")
                                             {
                                               $agent_commission = ($own_damage * $spl_com->special_com)/100;
                                            }
                                              else
                                             {
                                             if($agent_status->commission_category == "A")
                                              {
                                                  $agent_commission = ($total_premium * $res->a_ncb)/100;
                                              }
                                              else if($agent_status->commission_category == "B")
                                              {
                                                    $agent_commission = ($total_premium * $res->b_ncb)/100;
                                              }
                                              else if($agent_status->commission_category == "C")
                                              {
                                                    $agent_commission = ($total_premium * $res->c_ncb)/100;
                                              }
                                              else if($agent_status->commission_category == "D")
                                              {
                                                    $agent_commission = ($total_premium * $res->d_ncb)/100;
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
                                            
                                            $agent_status = $this->lm->fetch_agent_category($policy_agency_pos);
                                            
                                            if($spl_com != null || $spl_com != "")
                                            {
                                                 $agent_commission = ($own_damage * $spl_com->special_com)/100;
                                            }
                                            else
                                            {
                                                  if($agent_status->commission_category == "A")
                                                  {
                                                      $agent_commission = ($total_premium * $res->a_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "B")
                                                  {
                                                      $agent_commission = ($total_premium * $res->b_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "C")
                                                  {
                                                      $agent_commission = ($total_premium * $res->c_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "D")
                                                  {
                                                      $agent_commission = ($total_premium * $res->d_net)/100;
                                                  }
                                            }
                                        }
                                }
                           
                               $data = array("agent_commission_amt"=> $agent_commission,
                                                   "own_commission_amt"=> $company_com,"calc_com_status" =>"1");
                                
                                $update = $this->cm->update_commissions($data,$ar->id);
                                               
                        }
                    }
                    
                    echo "success";
                }
           }
           
           public function create_agent_ledger()
           {
                if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
                {
                     $res = $this->cm->get_all_agents_list();
                     
                     foreach($res as $da)
                     {
                         $data0 = $this->cm->check_agents_already_exits($da->id);
                         
                         if($data0 > 1)
                         {
                                $acc_id = $this->am->get_last_acc_id();
                                $last_id = $acc_id->accid+1;
                                $vcharid = "acc".$last_id;

                                $data = array(
                                        "accid" => $acc_id->accid+1,
                                        "vchaccid" =>$vcharid,
                                        "vch" =>"acc",
                                        "vchaccname" =>$da->agent_pos_code,
                                        "vchparentid" =>"acc42",
                                        "parentid" => "42",
                                        "chracctype" =>"1",
                                        "cr_dr_status" =>"3",
                                        "agent_id" =>$da->id,
                                );
                                
                                $res0 = $this->am->add_sub_ledger($data);
                                $res1 = $this->am->add_sub_ledger_orc($data);
                         }
                     }
                     echo "success";    
                }
           }
           
  public function schools()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["region"] = $this->cm->fetch_regions('reigion', 'asc');
		   	$data["class"] = $this->cm->fetch_policy_class();
    		$this->load->view('header',$pro_data);
    		$this->load->view('schools',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
	        $data["region"] = $this->cm->fetch_regions('reigion', 'asc');
		   	$data["class"] = $this->cm->fetch_policy_class();
    		$this->load->view('header',$pro_data);
    		$this->load->view('schools',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}           
           
           
           
           
           
           
    public function add_school_details()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{ 
        	  $regions= $this->input->post("regions");
              $school_name= $this->input->post("school_name");
              $school_mobile_no = $this->input->post("school_mobile_no");
              $email= $this->input->post("email");
              $address= $this->input->post("address");
              $remark= $this->input->post("remark");
            //   $p_type = $this->input->post("p_type");
            //   $p_class = $this->input->post("p_class");
              $brand = $this->input->post("brand");
              $contact_person = $this->input->post("contact_person");
              $contact_email = $this->input->post("contact_email");
              $add_contact_no = $this->input->post("contact_no");
              $imgcount = $this->input->post("imgcount");
              
              
              
              
            $data = array(
                  "region" =>$regions,
                //   "p_class" =>$p_class,
                //   "p_type" =>$p_type,
                  "brand" =>$brand,
                  "school_name" =>$school_name,
                  "mobile"=>$school_mobile_no,
                  "email"=>$email,
                  "address"=>$address,
                  "remark" =>$remark,
                  "created_by" =>$this->session->userdata("session_id"),
                   "date" =>date("Y-m-d H:i:s"),
                  );
                  
            $res = $this->cm->add_school_details($data);
            if( $res ){
		        $this->audit->log('list_of_school', 'INSERT', null, null, $data);
		    }
            
            for($i = 0;$i<count($contact_person);$i++)
            {
                $data1 = array(
                          "school_id" =>$res,
                          "contact_person" =>$contact_person[$i],
                          "contact_no" =>$add_contact_no[$i],
                          "c_email" =>$contact_email[$i],
                          "created_by" =>$this->session->userdata("session_id"),
                          "date" =>date("Y-m-d H:i:s"),
                        );
                $res1 = $this->cm->add_school_contact_info($data1);
                if( $res1 ){
    		        $this->audit->log('schools_contact_info', 'INSERT', null, null, $data1);
    		    }
            }
            
        $data1 = [];
        if( isset( $_FILES ) && !empty( $_FILES ) )
		{
			$config['upload_path'] = './datas/schools/';
			$config['allowed_types'] = '*';
			
			$this->load->library('upload',$config);
			$this->upload->initialize($config);
			if( isset( $imgcount ) && !empty( $imgcount ) )
            {
                for( $i = 0; $i < $imgcount; $i++ ){
                    $file = $_FILES["files_{$i}"];
                    $title = $this->input->post("ftitle_{$i}");
                    
                    if(!$this->upload->do_upload("files_{$i}"))
        			{
        				$file = '';
        				$file_path = "";
        			}
        			else
        			{
        				$file_path = base_url().'datas/schools/'.$this->upload->data('file_name');
        				$file = $this->upload->data("file_name");
        				
        				$data1[] = ['school_id' => $res, 'upload_file' => $file, 'file_type' => $title, 'created_by' =>$this->session->userdata("session_id"), 'date' =>date("Y-m-d H:i:s")];
        			}
                }
            }
            
            if( isset( $data1 ) && !empty( $data1 ) ) {
                $res = $this->cm->add_school_documents_batch($data1);
                if( $res ){
    		        $this->audit->log('schools_contact_info', 'INSERT', null, null, $data1);
    		    }
            }
		}
            echo "success";
    	}
	}
	
	
	public function fetch_schools()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $draw = intval($this->input->post("draw"));
            $region= $this->input->post("region");
            $brand =$this->input->post("brand");
            $policy_type = $this->input->post("policy_type");
            $mobile_no= $this->input->post("mobile_no");
            $school_name= $this->input->post("school_name");
    
    		$res = $this->cm->fetch_schools($region,$brand,$policy_type,$mobile_no,$school_name);
    
    		$arr = [];
            $a = 0 ;
            
            foreach($res as $da)
            {
            	$a++;
    
                $action = "<button class='btn btn-info btn-xs' title='Edit School Data' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i></button>&nbsp;<button class='btn btn-danger btn-xs' title = 'View School Data' onclick=view_data(".$da->id.")><i class='fa fa-eye'></i></button>";
                
                $arr[] = array(
                    $a,
                    $da->region,
                    $da->school_name,
                    $da->mobile,
                    $da->brand,
                    //$da->p_class,
                    //$da->p_type,
                    $da->address,
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
	
	  public function edit_school_details()
       {
           if($this->session->has_userdata('logged_in')) 
        	{
        	  $id = $this->input->post("id");
        	  $regions= $this->input->post("regions");
              $school_name= $this->input->post("school_name");
              $school_mobile_no = $this->input->post("school_mobile_no");
              $email= $this->input->post("email");
              $address= $this->input->post("address");
              $remark= $this->input->post("remark");
              $p_type = $this->input->post("p_type");
              $p_class = $this->input->post("p_class");
              $brand = $this->input->post("brand");
              $contact_person = $this->input->post("contact_person");
              $contact_email = $this->input->post("contact_email");
              $add_contact_no = $this->input->post("contact_no");
              $imgcount = $this->input->post("imgcount");
                
                $data = array(
                  "region" =>$regions,
                  "p_class" =>$p_class,
                  "p_type" =>$p_type,
                  "brand" =>$brand,
                  "school_name" =>$school_name,
                  "mobile"=>$school_mobile_no,
                  "email"=>$email,
                  "address"=>$address,
                  "remark" =>$remark,
                  "created_by" =>$this->session->userdata("session_id"),
                   "date" =>date("Y-m-d H:i:s"),
                  );
                  
                $old_data   = $this->cm->fetch_school_details($id);
                $res        = $this->cm->edit_school_details($data,$id);
                if( $res ){
    		        $this->audit->log('list_of_school', 'UPDATE', null, $old_data, $data);
    		    }
    		    $old_data = $this->cm->fetch_school_contact_info($id);
                $data0 = $this->cm->remove_school_contact_details($id);
                if( $data0 ){
    		        $this->audit->log('school_contact_info', 'DELETE', null, $old_data, null);
    		    }
                if( isset( $contact_person ) && !empty( $contact_person ) ) {
                    for($i = 0;$i<count($contact_person);$i++)
                    {
                        $data1 = array(
                                  "school_id" =>$id,
                                  "contact_person" =>$contact_person[$i],
                                  "contact_no" =>$add_contact_no[$i],
                                  "c_email" =>$contact_email[$i],
                                  "created_by" =>$this->session->userdata("session_id"),
                                  "date" =>date("Y-m-d H:i:s"),
                                );
                        $res1 = $this->cm->add_school_contact_info($data1);
                        if( $res1 ){
            		        $this->audit->log('school_contact_info', 'INSERT', null, null, $data1);
            		    }
                    }
                }
                
                
                $data1 = [];
                if( isset( $_FILES ) && !empty( $_FILES ) )
        		{
        			$config['upload_path'] = './datas/schools/';
        			$config['allowed_types'] = '*';
        			
        			$this->load->library('upload',$config);
        			$this->upload->initialize($config);
        			if( isset( $imgcount ) && !empty( $imgcount ) )
                    {
                        for( $i = 0; $i < $imgcount; $i++ ){
                            $file = $_FILES["files_{$i}"];
                            $title = $this->input->post("ftitle_{$i}");
                            
                            if(!$this->upload->do_upload("files_{$i}"))
                			{
                				$file = '';
                				$file_path = "";
                			}
                			else
                			{
                				$file_path = base_url().'datas/schools/'.$this->upload->data('file_name');
                				$file = $this->upload->data("file_name");
                				
                				$data1[] = ['school_id' => $id, 'upload_file' => $file, 'file_type' => $title, 'created_by' =>$this->session->userdata("session_id"), 'date' =>date("Y-m-d H:i:s")];
                			}
                        }
                    }
                    
                    if( isset( $data1 ) && !empty( $data1 ) ) {
                        $res = $this->cm->add_school_documents_batch($data1);
                        if( $res ){
            		        $this->audit->log('school_documents', 'INSERT', null, null, $data1);
            		    }
                    }
        		}
                
        	}
       }
       
       
    public function fetch_school_contact_info()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
            $id = $this->input->post("id");
            $res = $this->cm->fetch_school_details($id);
            $res_1 = $this->cm->fetch_school_contact_info($id);
            
            $documents = $this->cm->fetch_school_documents_info($id);

          $content = "<table class='table'>
                <tr>
                    <td>Institution Name</td> 
                    <td>".$res->school_name."</td>
                </tr>
                
                <tr>
                    <td>Region</td> 
                    <td>".$res->region."</td>
                </tr>
                
                <tr>
                    <td>Mobile</td> 
                    <td>".$res->mobile."</td>
                </tr>
                
                <tr>
                    <td>Email</td> 
                    <td>".$res->email."</td>
                </tr>
                
                 <tr>
                    <td>Brand</td> 
                    <td>".$res->brand."</td>
                </tr>
                
                 
            
                <tr>
                    <td>Address</td> 
                    <td>".$res->address."</td>
                </tr>
            </table>";
            
            foreach($res_1 as $da)
            {
                $content .= "
                            <table class = 'table table-bordered'>
                                <tr>
                                       <td>Contact Person</td>
                                       <td>".$da->contact_person."</td>
                                </tr>
                                
                                 <tr>
                                       <td>Contact no</td>
                                       <td>".$da->contact_no."</td>
                                </tr>
                                
                                <tr>
                                       <td>Email</td>
                                       <td>".$da->c_email."</td>
                                </tr>
                        </table>";
            }
            
            if( isset( $documents ) && !empty( $documents ) )
            {
                $content .= "<ul>";
                foreach( $documents as $doc ) {
                    $file = base_url().'datas/schools/'.$doc->upload_file;
                    $content .= "<li><a href='school_document_download/".$doc->id."'>".$doc->file_type."</a></li>";
                    
                }
            }
            
            echo $content;
    	}
	}
	
    public function fetch_edit_school()
    {
        if($this->session->has_userdata('logged_in')) 
    	{
    	    $id         = $this->input->post("id");
            $res        = $this->cm->fetch_school_details($id);
            $res0       = $this->cm->fetch_dealers_contact_info($id);
            $documents  = $this->cm->fetch_school_documents_info($id);
            echo json_encode(array("basic"=>$res,"contact_info"=>$res0, "documents" => $documents));
    	}
    }

    
    public function school_documents_remove()
    {
        $data = ['status' => 'false'];
        if($this->session->has_userdata('logged_in')) 
    	{
    	    $id         = $this->input->post("id");
    	    $documents  = $this->cm->getSchoolDoc($id);
            
            if( $documents )
            {
                $file = 'datas/schools/'.$documents->upload_file;
                if(file_exists($file)){
                    if(unlink($file)){
                        $old_data = $this->cm->fetch_school_documents_info($id);
                        $res    = $this->cm->remove_school_document($id);
                        if( $res ) {
            	            $this->audit->log('school_documents', 'DELETE', null, $old_data, null);
            	        }
                        $data   = ['status' => 'true'];        
                    }
                }
            }
    	}
    	echo json_encode($data);
    }
    
    function download($document_id)
    {
        $this->load->helper('download');
        if( $document_id ) {
            $documents  = $this->cm->getSchoolDoc($document_id);
            if( $documents )
            {
                $file = 'datas/schools/'.$documents->upload_file;
                if(file_exists($file)){
                    force_download($file, NULL);
                }
            }
        }
        die();
    }
    
    
    
 	public function export_schools()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $region= $this->input->post("region");
            $fromdate =$this->input->post("fromdate");
            $todate = $this->input->post("todate");
            $mobile_no= $this->input->post("mobile_no");
            $school_name= $this->input->post("school_name");
    
    		$res = $this->cm->fetch_schools($region,$fromdate,$todate,$mobile_no,$school_name);
         
    	   
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
            
            $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Institution Report');
            
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
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Institution Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Region');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Policy type');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Policy Class');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Mobile No');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Email Id');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Remarks');
        $row_count = 5;
        $a = 0;
     
        foreach($res as $da)
        {
            $res0 = $this->cm->fetch_dealers_contact_info($da->id);
            
            $a++;
            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
            $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->school_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->region);
            $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->p_class);
            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , $da->p_type);
            $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $da->mobile);
            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->email);
            $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $da->address);
            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , $da->remark);
            $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row_count , $da->brand);
            $x = "J";
            $i =0;
            
            foreach($res0 as $das)
            {
                $i++;
                $x++;
                $objPHPExcel->getActiveSheet()->SetCellValue($x.'4', 'Contact Person'.$i);
                $objPHPExcel->getActiveSheet()->SetCellValue($x.$row_count , $das->contact_person);
                $x++;
                $objPHPExcel->getActiveSheet()->SetCellValue($x.'4', 'Contact No'.$i);
                $objPHPExcel->getActiveSheet()->SetCellValue($x.$row_count , $das->contact_no);
                $x++;
                $objPHPExcel->getActiveSheet()->SetCellValue($x.'4', 'Email'.$i);
                $objPHPExcel->getActiveSheet()->SetCellValue($x.$row_count , $das->c_email);
                $x++;
            }
            
            $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
            $row_count++;
        }
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter->save('./datas/reports/schools_report.xlsx');
            echo base_url()."/datas/reports/schools_report.xlsx";
    	}
	}
	
	// as on 2023-04-13 by kgk
		 public function acc_commission_leger_tiger()
          {
                    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
                	{    		
            		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
                		$this->load->view('header',$pro_data);
                		$this->load->view('acc_commission_leger_tiger');
                		$this->load->view('footer',$pro_data);
            	    }
          }
	
	
	
	public function get_active_policy_commission_leg()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	    $from_date = $this->input->post("from_date");
    	    $to_date = $this->input->post("to_date");
    	    
    	    $res = $this->cm->get_active_policy_commission_leg($from_date,$to_date);
    	    
    	    
    	    if( isset( $res ) && !empty( $res ) ){
    	        var_dump(count($res));
    	        
    	        $this->db->trans_begin(); #begin transaction
    	        $sl = 1;
    	        $year = '2023';
    	        foreach( $res as $row ) {
    	            $class_type = $this->lm->get_class_type($row->lead_id);
    	            if( $row->lead_id ) { //&& $class_type->class == "1"
    	            
    	                echo $row->lead_id."<br/>";
    	                if(in_array($class_type->class, ['1', '2'])){
    	                    $data = $this->getCommission($row, $class_type->class);
    	                } else {
    	                    $data = array("agent_commission"    => 0,
                    				"jayantha_agent_commission" => $row->agent_commission_amt,
                    				"jayantha_commission"       => $row->own_commission_amt,
                    				"company_com"               => 0,
                    				"policy_agency_pos"         => $row->policy_agency_pos,
                    				"policy_no"                 => $row->policy_no,
                    				"company"                   => $row->company
                    		);
    	                }
    	                //$data = $this->getCommission($row);
    	                
    	                var_dump($data);
    	                if( isset( $data ) && !empty( $data ) ){
    	                    
    	                    $today = new DateTime();
    	                    
    	                    $updata = array("agent_commission"=> $data['agent_commission'],
        								"agent_commission_amt"=> $data['jayantha_agent_commission'],
        								"own_commission_amt"=> $data['jayantha_commission'],
        								"own_commission"=> $data['company_com'],
        								"calc_com_status" =>"1",
        								"updated_at" => $today->format('Y-m-d H:i:s'));
        		        
        		        						
        				echo '<pre>';print_r($data);print'</pre>';
        				
        				$update = $this->cm->update_commissions_by_lead_id($updata,$row->lead_id);
        				echo '<pre>';print_r($this->db->last_query());print'</pre>';
        				
        				
        				
    	                    // echo $row->lead_id."<br/>";
        	               echo '#################### Start ('.$sl.')###################################';
        	               echo '<pre>';print_r($row->lead_id);echo '</pre>';
        	                $this->_acc_own_commission_ledg($row->lead_id, $data, "OC/{$sl}/{$year}");
        	               // var_dump($this->db->last_query());
        	                echo '<br/>';
        	                $this->_acc_agn_commission_ledg($row->lead_id, $data, "AC/{$sl}/{$year}");
        	                //var_dump($this->db->last_query());
        	                //echo '<br/>';
        	                echo '################### End ('.$sl.') #####################################';
        	           
        	                $sl = $sl + 1;
    	                }
    	            }
    	        }
    	        
    	        if($this->db->trans_status() === FALSE) {
                    $this->db->trans_rollback();
                } else {
                    $this->db->trans_rollback();
                    //$this->db->trans_commit();
                }
    	    }
    	    
    	    //echo json_encode($res);
	    }
	    
	}
	
	
	public function getCommission($policy) {
	    
	    $agent_commission = $jayantha_agent_commission = $jayantha_commission = $company_com = 0;
	    
	    if( $policy ) {
	        $total_premium = $policy->total_premium;
            $own_damage = $policy->total_own_damage;
            $no_claim_bonus = $policy->no_claim_bonus;
            $tp = $policy->tot_liability_premium;
            $res123 = $this->lm->fetch_policy_info($policy->commission_id);
            
            if( isset( $res123->agn_com_type ) && !empty( $res123->agn_com_type ) ){
        
                $agn_commission_type = $res123->agn_com_type ;
                
                $ird_od_commission = (isset($res123->ird_od_commission) && ($res123->ird_od_commission > 0)) ? $res123->ird_od_commission : 0;
        		$ird_tp_commission = (isset($res123->ird_tp_commission) && ($res123->ird_tp_commission > 0)) ? $res123->ird_tp_commission : 0;
            
                $jayantha_commission = $jayantha_agent_commission = 0;
                if($agn_commission_type != "TP")
                {
                    $jayantha_commission = ($own_damage * $ird_od_commission)/100;
                    $jayantha_agent_commission = ($own_damage * $ird_od_commission)/100;
                }
                if($agn_commission_type != "OD")
                {
                    $jayantha_commission = (float)$jayantha_commission + (($tp * $ird_tp_commission)/100);   
                }
                
                $res = $this->lm->fetch_policy_info($policy->commission_id);
                $commission_type = $res->commission_type;
                
                if( isset( $class_type ) && !empty( $class_type ) && $class_type == "2" ) {
        		    if( isset( $agn_commission_type ) && $agn_commission_type == '' ) {
        		        $res->agn_com_type = $agn_commission_type = "ON-NET";
        		    }
        		}
        		
                $spl_com = $this->lm->check_spl_commission_for_agent($policy->commission_id,$policy->policy_agency_pos); 
                
                if( isset( $res ) && !empty($res) && (in_array($res->commission_type, ['1','2','3'])) )
                {
                    $comtypes = [
                        'OD'        => $own_damage,
                        'TP'        => $tp,
                        'ON-NET'    => $total_premium
                    ];
                    $ncategories = [
                        'A' => $res->a_ncb,
                        'B' => $res->b_ncb,
                        'C' => $res->c_ncb,
                        'D' => $res->d_ncb
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
                        ]
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
                    
                    if( isset( $class_type ) && !empty( $class_type ) && $class_type == "1" ) {
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
                    } elseif( isset( $class_type ) && !empty( $class_type ) && $class_type == "2" ) {
                        $jayantha_commission = $company_com;
    					$jayantha_agent_commission = $agent_commission;
					    $agent_commission = $company_com = 0;
                    } 
        	    }
            }
            
	    }
	    
	    
	    
	    $data = array("agent_commission"    => $agent_commission,
				"jayantha_agent_commission" => $jayantha_agent_commission,
				"jayantha_commission"       => $jayantha_commission,
				"company_com"               => $company_com,
				"policy_agency_pos"         => $policy->policy_agency_pos,
				"policy_no"                 => $policy->policy_no,
				"company"                   => $policy->company
		);
		
		return $data;
    }
    
    
    public function _acc_own_commission_ledg( $lead_id, $commission, $new_sr_no ) {
        
        if(isset($commission) && !empty($commission))
        {
            $own_com_id = "acc21";
           $check = $this->lm->check_ac_policy_no_already_exits($commission['policy_no']);
        //   echo '<pre>';print_r($this->db->last_query());echo '</pre>';
           $check0 = $this->lm->check_ac_policy_no_already_exits_orc($commission['policy_no']);
        //   echo '<pre>';print_r($this->db->last_query());echo '</pre>';
        //   var_dump("ins_leder = ". $res->company);echo '<br/>';
           
           $ins_ledger = $this->lm->fetch_insurance_company_ledger_main($commission['company']);
           
           $ins_ledger_orc = $this->lm->fetch_insurance_company_ledger_orc($commission['company']);
           
           if( empty( $ins_ledger->vchaccid ) || empty( $ins_ledger_orc->vchaccid )) {
               $ledger_ids = $this->create_insurance_company_ledger($commission['company']);
               
               $ins_ledger_id       = $ledger_ids[0];
               $ins_ledger_orc_id   = $ledger_ids[1];
           } else {
               $ins_ledger_id       = $ins_ledger->vchaccid;
               $ins_ledger_orc_id   = $ins_ledger_orc->vchaccid;
           }
           
           //$ins_ledger->free_result();
           //$ins_ledger_orc->free_result();
           
               if($check < 1)
               {
                    $data_irda = array(
                        "sr_no" =>$new_sr_no,
                        "credit"=>$commission['jayantha_commission'],//floor($total_irda),
                        "cr_parent_id" =>$own_com_id,
                        "dr_parent_id" => $ins_ledger_id,//$ins_ledger->vchaccid,
                        "tds" =>0,
                        "lead_id"=>$lead_id,
                        "sub_id" =>$commission['policy_no'],
                        "insurer_id" =>$commission['company'],
                        "note" =>"Own commission Credit",
                        "datetime" =>date("Y-m-d H:i:s")
                        );
                    $this->lm->add_acc_own_commission($data_irda);
                     echo '<pre>';print_r($this->db->last_query());echo '</pre>';
               }  
               
               if($check0 < 1)
               {
                    $data_orc = array(
                            "sr_no" =>$new_sr_no,
                            "credit"=>$commission['company_com'],//floor($total_orc),
                            "cr_parent_id" =>$own_com_id,
                            "dr_parent_id" => $ins_ledger_orc_id,//$ins_ledger_orc->vchaccid,
                            "tds" =>0,
                            "lead_id"=>$lead_id,
                            "sub_id" =>$commission['policy_no'],
                            "insurer_id" =>$commission['company'],
                            "note" =>"Own commission Credit",
                            "datetime" =>date("Y-m-d H:i:s")
                            );
                    $this->lm->add_acc_own_commission_orc($data_orc);
                    echo '<pre>';print_r($this->db->last_query());echo '</pre>';
               }
        }
    }
	
	
	public function _acc_agn_commission_ledg($lead_id, $commission, $new_sr_no) {
	    
	    if( isset( $commission ) && !empty( $commission ) ){
	        
	        $own_com_id = "acc21";
            $agn_com_id = "acc42";
            $tds = 0;
            
            $data_irda1 =   array(
                "sr_no" =>$new_sr_no,
                "debit"=>$commission['jayantha_agent_commission'], //$total_irda,
                "cr_parent_id" =>$agn_com_id,
                "dr_parent_id" =>$own_com_id,
                "tds" =>$tds,
                "sub_id" =>$commission['policy_agency_pos'],
                "lead_id"=>$lead_id,
                "note" =>"Own commission Debit",
                "datetime" =>date("Y-m-d H:i:s")
            );
                
            $res0 = $this->lm->add_acc_own_commission($data_irda1);
            echo '<pre>';print_r($this->db->last_query());echo '</pre>';    
            $data_irda2 =   array(
                "sr_no" =>$new_sr_no,
                "credit"=>$commission['jayantha_agent_commission'], //$total_irda,
                "cr_parent_id" =>$agn_com_id,
                "dr_parent_id" =>$own_com_id,
                "tds" =>$tds,
                "sub_id" =>$commission['policy_agency_pos'],
                "lead_id"=>$lead_id,
                "note" =>"Agent commission Credit",
                "datetime" =>date("Y-m-d H:i:s")
            );
                        
            $res1 = $this->lm->add_acc_own_commission($data_irda2);
            echo '<pre>';print_r($this->db->last_query());echo '</pre>';
            
            $data_orc1 =   array(
                "sr_no" =>$new_sr_no,
                "debit"=>$commission['agent_commission'],//$total_orc,
                "cr_parent_id" =>$agn_com_id,
                "dr_parent_id" =>$own_com_id,
                "tds" =>$tds,
                "sub_id" =>$commission['policy_agency_pos'],
                "lead_id"=>$lead_id,
                "note" =>"Own commission Debit",
                "datetime" =>date("Y-m-d H:i:s")
            );
            $res0 = $this->lm->add_acc_own_commission_orc($data_orc1);
            echo '<pre>';print_r($this->db->last_query());echo '</pre>';
            $data_orc2 =   array(
                "sr_no" =>$new_sr_no,
                "credit"=>$commission['agent_commission'],//$total_orc,
                "cr_parent_id" =>$agn_com_id,
                "dr_parent_id" =>$own_com_id,
                "tds" =>$tds,
                "sub_id" =>$commission['policy_agency_pos'],
                "lead_id"=>$lead_id,
                "note" =>"Agent commission Credit",
                "datetime" =>date("Y-m-d H:i:s")
            );
            $res1 = $this->lm->add_acc_own_commission_orc($data_orc2);
            echo '<pre>';print_r($this->db->last_query());echo '</pre>';
                
            
	    }
	}
	
	
	public function create_insurance_company_ledger($res)
    {
      	if($this->session->has_userdata('logged_in')) 
    	{
    	    $main_leder_id = $sub_ledger_id = '';
    	    
    	    $data = $this->mm->get_insurance_company_info($res);
            $acc_id = $this->am->get_last_acc_id();
            $last_id = $acc_id->accid+1;
            $vcharid = "acc".$last_id;
            
            //Own commission Ledger id acc21
            
            $data = array(
               "accid" => $acc_id->accid+1,
               "vchaccid" =>$vcharid,
               "vch" =>"acc",
               "vchaccname" =>$data->company_name,
               "vchparentid" =>"acc21",
               "parentid" => "21",
               "chracctype" =>"1",
               "insurer_id" =>$data->id,
               "cr_dr_status" =>"1",
            );
            $main_ledger_id = $this->am->getID($data, 'account_tree');
            if(empty($main_ledger_id)) {
                $res = $this->am->add_sub_ledger($data);
                echo '<pre>';print_r($this->db->last_query());echo '</pre>';
                if( $res ) {
                    $main_ledger_id = $this->am->getID($data, 'account_tree');
    	            $this->audit->log('account_tree', 'INSERT', null, null, $data);
    	        }
            }
            
            $sub_ledger_id = $this->am->getID($data, 'account_tree_orc');
            if(empty($sub_ledger_id)) {
                $res0 = $this->am->add_sub_ledger_orc($data);
                echo '<pre>';print_r($this->db->last_query());echo '</pre>';
                if( $res0 ) {
                    $sub_ledger_id = $this->am->getID($data, 'account_tree_orc');
    	            $this->audit->log('account_tree_orc', 'INSERT', null, null, $data);
    	        }
            }
            
	        return [$main_leder_id, $sub_ledger_id];
    	}
    	
    	return;
    }
    
    // import excel start
    function import_excel()
	{
	    $this->load->library('excel');
	    $tbody = '';
		if(isset($_FILES["file"]["name"]) && !empty($_FILES["file"]["name"]))
		{
			$path = $_FILES["file"]["tmp_name"];
			$object = PHPExcel_IOFactory::load($path);
			   
                //var_dump($object);
                
			//foreach($object->getWorksheetIterator() as $worksheet)
			//{
			    $worksheet = $object->getSheet(0);
				$highestRow = $worksheet->getHighestRow();
				$highestColumn = $worksheet->getHighestColumn();
				$sl = 0;
				for($row=2; $row<=$highestRow; $row++)
				{
					$region = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
					$brand = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
					$school_name = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
					$mobileno = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
					$email = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
					$remark = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
					
					$today = new DateTime();
                
                    $data_exists = $this->cm->checkDataExists(trim($region), trim($school_name));
                
                    if(!$data_exists) {

    					$data = array(
    						'region'        =>  trim($region),
                            'brand'         =>  trim($brand),
                            'school_name'   =>  trim($school_name),
                            'mobile'        =>  trim($mobileno),
                            'email'         =>  trim($email),
                            'remark'        =>  trim($remark),
                            'date'          => $today->format('Y-m-d H:i:s')
    					);
					
					    $res = $this->cm->insert_import($data);
					    $msg = (($res) ? "Success" : "Failure");
                    } else {
                        $msg = "Already exist Data";
                    }
					
					$tbody .= '<tr>';
    				$tbody .= "<td>".$sl."</td>";
    				$tbody .= "<td>".$region."</td>";
    				$tbody .= "<td>".$brand."</td>";
    				$tbody .= "<td>".$school_name."</td>";
    				$tbody .= "<td>".$mobileno."</td>";
    				$tbody .= "<td>".$email."</td>";
    				$tbody .= "<td>".$remark."</td>";
    				$tbody .= "<td>".($msg)."</td>";
    				$tbody .= "</tr>";
    				
    				$sl++;
				}
				
				echo "<table class='table table-bordered table-striped table-responsive table-hover' id='tbl_schools'>";
				echo "<thead>";
				echo "<tr>";
				echo '<th>#</th>';
				echo '<th>Region</th>';
				echo "<th>Brand</th>";
				echo "<th>School Name</th>";
				echo "<th>Mobile No.</th>";
				echo "<th>Email</th>";
				echo "<th>Remark</th>";
				echo "<th>Status</th>";
				echo "</tr>";
				echo "</thead>";
				echo "<tbody>";
				echo $tbody;
				echo "</tbody>";
				echo "</table>";
				        
				//echo '<pre>';print_r($data);print'</pre>';die();
			//}
			
			
			echo 'Data Imported successfully';
		} /*else {
		    $data = $this->input->post('data');
		    echo '<pre>';print_r($data);print'</pre>';
		    $res = $this->cm->insert_import($data);
		    echo 'Data Imported successfully';
		    
		}*/
		
		
	}
// import excel end

 }

?>