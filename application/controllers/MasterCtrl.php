<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MasterCtrl extends CI_Controller {
    public $rolepermissionModel;
    public $auth;
    public $am;
    public $cm;
    public $mm;
    public $lm;
    public $session;
    public $audit;
     public $audit_model;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('MasterMod','mm');
		$this->load->model('LeadMod','lm');
		$this->load->model("AccountsMod","am");
		$this->load->model('Configmod','cm');
		$this->load->library('session');
		$this->load->library('audit');
		$this->load->helper('url');
		$this->load->helper('cookie');
	}
	
	public function brand()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('brand');
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	    	$pro_data["project_info"] = $this->mm->fetch_project_info();
	    	
	    	 $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	    	 
	        if($check_user_i->masters_view == "1")
	        {
        		$this->load->view('header',$pro_data);
        		$this->load->view('brand');
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

	public function fetch_brand()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_brand();
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

	public function add_brand()
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
    		$this->mm->add_brand($data);

    		echo "Success";
    	}
	}

	public function fetch_edit_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_brand($id);
			echo json_encode($res);
		}
	}

	public function edit_brand()
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
                    $old_file_name = $this->mm->fetch_edit_brand($id)->icon_name;
                    unlink("./datas/images/brand_icons/".$old_file_name);
                	$data = array("brand_name" => $name,
    		            "icon" => $file_path,
    		            "icon_name" => $file,
    		            "updated_by" => $this->session->userdata("session_id"),
    		            "updated_at" => date("Y-m-d H:i:s"));
    		        $this->mm->edit_brand($id, $data);
            }
            else
            {
                	$data = array("brand_name" => $name,
    		            "updated_by" => $this->session->userdata("session_id"),
    		            "updated_at" => date("Y-m-d H:i:s"));
    		        $this->mm->edit_brand($id, $data);
            }
    	

    		echo "Success";
    	}
	}

// 	public function delete_brand()
// 	{
// 		if($this->session->has_userdata('logged_in')) 
//     	{
// 			$id = $this->input->post("id");
// 			$this->mm->delete_brand($id);
//     	}
// 	}


//Model

    public function model()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->mm->fetch_brand();
    		$this->load->view('header',$pro_data);
    		$this->load->view('model',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        
	     $pro_data["project_info"] = $this->mm->fetch_project_info();
	     $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	     
	        if($check_user_i->masters_view == "1")
	        {
		   	$data["brand"] = $this->mm->fetch_brand();
    		$this->load->view('header',$pro_data);
    		$this->load->view('model',$data);
    		$this->load->view('footer',$pro_data);
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
	    }
	}

	public function fetch_car_model()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_model();
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;
        	
        	
        	if($da->file == "")
            {
            	$image = "No File";
            }
            else
            {
            	$image = "<a href=".'https://harshainfotech.biz/insurance_crm/admin/models/'.$da->file." target='_blank'><img src=".'https://harshainfotech.biz/insurance_crm/admin/models/'.$da->file." height='45'></a>";
            }
            
            
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
                $image,
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

   
	public function add_model()
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
            		$this->mm->add_model($data);
                    foreach($name1 as $n)
                    {
                        $data = array("model_name" => $n,
            		              "brand_id" => $brand,
            		              "created_by" => $this->session->userdata("session_id"),
            		            "created_at" => date("Y-m-d H:i:s"));
            		$this->mm->add_model($data);
                    }
            		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='model';</script>";
	        }
    	}
	}

	public function fetch_edit_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_model($id);
			echo json_encode($res);
		}
	}

	public function edit_model()
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
        		$this->mm->edit_model($id, $data);
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='model';</script>";
	        }
    	}
	}

	public function delete_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	   if($check_user_i->masters_delete == "1")
	        {
    			$id = $this->input->post("id");
    			$this->mm->delete_model($id);
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
	    echo $this->mm->fetch_edit_brand($brand)->icon;
    	}
	}
	
	//Fuel Type
	
	public function fuel_type()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		//$this->load->view('sidebar',$pro_data);
    		$this->load->view('fuel_type');
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		//$this->load->view('sidebar',$pro_data);
    		$this->load->view('fuel_type');
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}

	public function fetch_fuel_type()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_fuel_type();
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
                $action .= "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Edit</button> ";
    	        }
            		// <button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> Delete</button>";
            
            $arr[] = array(
                $a,
                $da->fuel_type,
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

	public function add_fuel_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	  
    	   if($check_user_i->masters_add == "1")
    	   {
        		$name = $this->input->post("name");
        		$data = array("fuel_type" => $name);
        		$this->mm->add_fuel_type($data);
    		    echo "Success";
    	   }
    	   else
    	   {
    	       echo "<script>alert('Permission Denied');window.location.href='fuel_type';</script>";
    	   }
    	}
	}

	public function fetch_edit_fuel_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_fuel_type($id);
			echo json_encode($res);
		}
	}

	public function edit_fuel_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	  
    	  if($check_user_i->masters_edit == "1")
    	   {
        		$name = $this->input->post("name");
        		$id = $this->input->post("id");
        		$data = array("fuel_type" => $name);
        		$this->mm->edit_fuel_type($id, $data);
        		echo "Success";
    	   }
    	   else
    	   {
    	      echo "<script>alert('Permission Denied');window.location.href='home';</script>"; 
    	   }
    	}
	}

	public function delete_fuel_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	  
    	  if($check_user_i->masters_delete == "1")
    	   {
    			$id = $this->input->post("id");
    			$this->mm->delete_fuel_type($id);
    	   }
    	}
	}
	
	//Varient
	
	public function varient()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->mm->fetch_brand();
		   	$data["fuel"] = $this->mm->fetch_fuel_type();
    		$this->load->view('header',$pro_data);
    		$this->load->view('varient',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        
	    	$pro_data["project_info"] = $this->mm->fetch_project_info();
	    	$check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	    	
	        if($check_user_i->masters_view == "1")
	        {
    		   	$data["brand"] = $this->mm->fetch_brand();
    		   	$data["fuel"] = $this->mm->fetch_fuel_type();
        		$this->load->view('header',$pro_data);
        		$this->load->view('varient',$data);
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

	public function fetch_varient()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_varient();
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
                $da->fuel_type,
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

	public function add_varient()
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
                $fuel_type = $this->input->post("fuel");
        		$data = array("varient_name" => $name,
        		              "brand_id" => $brand,
        		              "model_id" => $model,
        		              "fuel_id" => $fuel_type,
        		              "created_by" => $this->session->userdata("session_id"),
        		              "created_at" => date("Y-m-d H:i:s"));
        		$this->mm->add_varient($data);
            foreach($name1 as $n)
            {
                $data = array("varient_name" => $n,
    		              "brand_id" => $brand,
    		              "model_id" => $model,
    		              "fuel_id" => $fuel_type,
    		              "created_by" => $this->session->userdata("session_id"),
    		            "created_at" => date("Y-m-d H:i:s"));
    		$this->mm->add_varient($data);
            }
    		echo "Success";
    	}
    	else
    	{
    	   echo "<script>alert('Permission Denied');window.location.href='home';</script>"; 
    	}
      }
	}

	public function fetch_edit_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_varient($id);
			$model_option = $this->get_model_list_option($res->brand_id);
			$icon = $this->mm->fetch_edit_brand($res->brand_id)->icon;
			$data = array("res" =>$res, "model_option" => $model_option, "icon" => $icon);
			echo json_encode($data);
		}
	}

	public function edit_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	     $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	     
	        if($check_user_i->masters_edit == "1")
	        {
        		$name = $this->input->post("name");
        		$brand = $this->input->post("brand");
        		$model = $this->input->post("model");
        		$fuel = $this->input->post("fuel");
        		$id = $this->input->post("id");
    
        		$data = array("varient_name" => $name,
        		                "brand_id" => $brand,
        		                "model_id" => $model,
        		              "fuel_id" => $fuel,
        		                "updated_by" => $this->session->userdata("session_id"),
        		                "updated_at" => date("Y-m-d H:i:s"));
        		$this->mm->edit_varient($id, $data);
    
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
	}

	public function delete_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	   $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	     
	        if($check_user_i->masters_edit == "1")
	        {
    			$id = $this->input->post("id");
    			$this->mm->delete_model($id);
	        }
    	}
	}
	
	
	public function get_model_list()
	{
	    $brand = $this->input->post("brand");
	    $res = $this->mm->get_model_list($brand);
	    $data = "<option value=''>Select Model</option>";
	    foreach($res as $r)
	    {
	        $data.= "<option value='".$r->id."'>".$r->model_name."</option>";
	    }
	    echo $data;
	}
	public function get_model_list_option($brand)
	{
	    $res = $this->mm->get_model_list($brand);
	    $data = "<option value=''>Select Model</option>";
	    foreach($res as $r)
	    {
	        $data.= "<option value='".$r->id."'>".$r->model_name."</option>";
	    }
	    return $data;
	}
	
	//gc vehicle
	
	public function gc_brand()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["policy_type"] = $this->mm->fetch_policy_type_gc();
    		$this->load->view('header',$pro_data);
    		$this->load->view('gc_brand',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	         $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    	        $data["policy_type"] = $this->mm->fetch_policy_type_gc();
        		$this->load->view('header',$pro_data);
        		$this->load->view('gc_brand',$data);
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

	public function fetch_gc_brand()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();
		
		$policy_type = $this->input->post("policy_type");

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_gc_brand($policy_type);
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
                $da->p_type,
                $da->brand_name,
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

	public function add_gc_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
           
	        if($check_user_i->masters_add == "1")
	        {
        		$name = $this->input->post("name");
        		$policy_type = explode(",",$this->input->post("policy_type"));

        		for($i=0;$i<count($policy_type);$i++)
        		{
        		    $data = array("brand_name" => $name,
        		              "policy_type" =>$policy_type[$i],
            		            "created_by" => $this->session->userdata("session_id"),
            		            "created_at" => date("Y-m-d H:i:s"));
        		     $this->mm->add_gc_brand($data);
        		}
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='gc_brand';</script>";
	        }
    	}
	}

	public function fetch_edit_gc_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_gc_brand($id);
			echo json_encode($res);
		}
	}

	public function edit_gc_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
           
	        if($check_user_i->masters_edit == "1")
	        {
    		$name = $this->input->post("name");
    		$id = $this->input->post("id");
        	$data = array("brand_name" => $name,
	            "updated_by" => $this->session->userdata("session_id"),
	            "updated_at" => date("Y-m-d H:i:s"));
	        $this->mm->edit_gc_brand($id, $data);
    		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='gc_brand';</script>";
	        }
    	}
	}

//gc Model

    public function gc_model()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->mm->fetch_gc_brand_list();
		   	 $data["policy_type"] = $this->mm->fetch_policy_type_gc();
    		$this->load->view('header',$pro_data);
    		$this->load->view('gc_model',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
	        
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    		   	$data["brand"] = $this->mm->fetch_gc_brand_list();
    		   	 $data["policy_type"] = $this->mm->fetch_policy_type_gc();
        		$this->load->view('header',$pro_data);
        		$this->load->view('gc_model',$data);
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

	public function fetch_gc_model()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();
		
		$policy_type = $this->input->post("policy_type");
		$s_gc_brand = $this->input->post("s_gc_brand");

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_gc_model($policy_type,$s_gc_brand);
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
                $da->p_type,
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

   
	public function add_gc_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	    if($check_user_i->masters_add == "1")
	        {
	            $policy_type = $this->input->post("policy_type");
        		$name = $this->input->post("name");
        		$name1 = $this->input->post("name1");
                $brand = $this->input->post("brand");
                
              
            		$data = array(
            		              "policy_type" => $policy_type,
            		              "model_name" => $name,
            		              "brand_id" => $brand,
            		              "created_by" => $this->session->userdata("session_id"),
            		            "created_at" => date("Y-m-d H:i:s"));
            		$this->mm->add_gc_model($data);
            		
                    foreach($name1 as $n)
                    {
                        $data = array(
                                   "policy_type" => $policy_type,
                                   "model_name" => $n,
            		              "brand_id" => $brand,
            		              "created_by" => $this->session->userdata("session_id"),
            		            "created_at" => date("Y-m-d H:i:s"));
            		   $this->mm->add_gc_model($data);
                    }
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='gc_model';</script>";
	        }
    	}
	}

	public function fetch_edit_gc_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_gc_model($id);
			echo json_encode($res);
		}
	}

	public function edit_gc_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	     $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	    if($check_user_i->master_edit == "1")
            {
        		$name = $this->input->post("name");
        		$brand = $this->input->post("brand");
        		$id = $this->input->post("id");
    
        		$data = array("model_name" => $name,
        		                "brand_id" => $brand,
        		                "updated_by" => $this->session->userdata("session_id"),
        		                "updated_at" => date("Y-m-d H:i:s"));
        		$this->mm->edit_gc_model($id, $data);
    
        		echo "Success";
            }
            else
            {
                echo "<script>alert('Permission Denied');window.location.href='home';</script>";
            }
    	}
	}
	
	
	//Varient
	
	public function gc_varient()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["fuel"] = $this->mm->fetch_fuel_type();
		   	$data["policy_type"] = $this->mm->fetch_policy_type_gc();
    		$this->load->view('header',$pro_data);
    		$this->load->view('gc_varient',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["fuel"] = $this->mm->fetch_fuel_type();
		   	$data["policy_type"] = $this->mm->fetch_policy_type_gc();
    		$this->load->view('header',$pro_data);
    		$this->load->view('gc_varient',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}

	public function fetch_gc_varient()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();
		
		$s_policy_type = $this->input->post("s_policy_type");
		$s_gc_brand = $this->input->post("s_gc_brand");
		$s_gc_model = $this->input->post("s_gc_model");

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_gc_varient($s_policy_type,$s_gc_brand,$s_gc_model);
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;
        	
        	$action = "";
            
            $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
            
	        if($check_user_i->masters_edit== "1")
	        {
                $action .= "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Edit</button>"; 
	        }
            		 //<button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> Delete</button>";
            
            $arr[] = array(
                $a,
                $da->p_type,
                $da->brand_name,
                $da->model_name,
                $da->fuel_type,
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

	public function add_gc_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	    if($check_user_i->masters_add == "1")
            {
                    $policy_type = $this->input->post("policy_type");
            		$name = $this->input->post("name");
            		$name1 = $this->input->post("name1");
                    $brand = $this->input->post("brand");
                    $model = $this->input->post("model");
                    $fuel_type = $this->input->post("fuel");
            		$data = array(
            		              "policy_type" =>$policy_type,
            		              "varient_name" => $name,
            		              "brand_id" => $brand,
            		              "model_id" => $model,
            		              "fuel_id" => $fuel_type,
            		              "created_by" => $this->session->userdata("session_id"),
            		              "created_at" => date("Y-m-d H:i:s"));
            		$this->mm->add_gc_varient($data);
                    foreach($name1 as $n)
                    {
                        $data = array(
                                 "policy_type" =>$policy_type,
                                 "varient_name" => $n,
            		              "brand_id" => $brand,
            		              "model_id" => $model,
            		              "fuel_id" => $fuel_type,
            		              "created_by" => $this->session->userdata("session_id"),
            		            "created_at" => date("Y-m-d H:i:s"));
            		$this->mm->add_gc_varient($data);
                  }
            }
            else
            {
                echo "<script>alert('Permission Denied');window.location.href='gc_varient';</script>";
            }
    		
    		echo "Success";
    	}
	}

	public function fetch_edit_gc_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_gc_varient($id);
			$model_option = $this->get_gc_model_list_option($res->brand_id);
			$data = array("res" =>$res, "model_option" => $model_option);
			echo json_encode($data);
		}
	}

	public function edit_gc_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    if($check_user_i->masters_edit == "1")
	        {
        		$name = $this->input->post("name");
        		$brand = $this->input->post("brand");
        		$model = $this->input->post("model");
        		$fuel = $this->input->post("fuel");
        		$id = $this->input->post("id");
    
        		$data = array("varient_name" => $name,
        		                "brand_id" => $brand,
        		                "model_id" => $model,
        		              "fuel_id" => $fuel,
        		                "updated_by" => $this->session->userdata("session_id"),
        		                "updated_at" => date("Y-m-d H:i:s"));
        		$this->mm->edit_gc_varient($id, $data);
    
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='gc_varient';</script>";
	        }
    	}
	}
	
	public function get_gc_model_list_option($brand)
	{
	    $res = $this->mm->get_gc_model_list_option($brand);
	    $data = "<option value=''>Select Model</option>";
	    foreach($res as $r)
	    {
	        $data.= "<option value='".$r->id."'>".$r->model_name."</option>";
	    }
	    return $data;
	}
	
	public function get_gc_model_list()
	{
	    $brand = $this->input->post("brand");
	    $res = $this->mm->get_gc_model_list($brand);
	    $data = "<option value=''>Select Model</option>";
	    foreach($res as $r)
	    {
	        $data.= "<option value='".$r->id."'>".$r->model_name."</option>";
	    }
	    echo $data;
	}
	
	//misc vehicle
	
	public function misc_brand()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('misc_brand');
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
        		$this->load->view('header',$pro_data);
        		$this->load->view('misc_brand');
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

	public function fetch_misc_brand()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_misc_brand();
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
                $da->brand_name,
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

	public function add_misc_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
           
	        if($check_user_i->masters_edit == "1")
	        {
        		$name = $this->input->post("name");
        		$data = array("brand_name" => $name,
        		            "created_by" => $this->session->userdata("session_id"),
        		            "created_at" => date("Y-m-d H:i:s"));
        		$this->mm->add_misc_brand($data);
    
        		echo "Success";
	        }
	        else
	        {
	           echo "<script>alert('Permission Denied');window.location.href='misc_brand';</script>"; 
	        }
    	}
	}

	public function fetch_edit_misc_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_misc_brand($id);
			echo json_encode($res);
		}
	}

	public function edit_misc_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	     $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
           
	        if($check_user_i->masters_add == "1")
	        {
        		$name = $this->input->post("name");
        		$id = $this->input->post("id");
            	$data = array("brand_name" => $name,
    	            "updated_by" => $this->session->userdata("session_id"),
    	            "updated_at" => date("Y-m-d H:i:s"));
    	        $this->mm->edit_misc_brand($id, $data);
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='misc_brand';</script>";
	        }
    	}
	}
	
	//misc Model

    public function misc_model()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->mm->fetch_misc_brand();
    		$this->load->view('header',$pro_data);
    		$this->load->view('misc_model',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        
	        if($check_user_i->masters_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    		   	$data["brand"] = $this->mm->fetch_misc_brand();
        		$this->load->view('header',$pro_data);
        		$this->load->view('misc_model',$data);
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

	public function fetch_misc_model()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_misc_model();
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

   
	public function add_misc_model()
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
        		$this->mm->add_misc_model($data);
                foreach($name1 as $n)
                {
                    $data = array("model_name" => $n,
        		              "brand_id" => $brand,
        		              "created_by" => $this->session->userdata("session_id"),
        		            "created_at" => date("Y-m-d H:i:s"));
        		$this->mm->add_misc_model($data);
                }
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='misc_model';</script>";
	        }
    	}
	}

	public function fetch_edit_misc_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_misc_model($id);
			echo json_encode($res);
		}
	}

	public function edit_misc_model()
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
        		$this->mm->edit_misc_model($id, $data);
    
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='misc_model';</script>";
	        }
    	}
	}
	//misc Varient
	
	public function misc_varient()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->mm->fetch_misc_brand();
		   	$data["fuel"] = $this->mm->fetch_fuel_type();
    		$this->load->view('header',$pro_data);
    		//$this->load->view('sidebar',$pro_data);
    		$this->load->view('misc_varient',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	         $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    		   	$data["brand"] = $this->mm->fetch_misc_brand();
    		   	$data["fuel"] = $this->mm->fetch_fuel_type();
        		$this->load->view('header',$pro_data);
        		//$this->load->view('sidebar',$pro_data);
        		$this->load->view('misc_varient',$data);
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

	public function fetch_misc_varient()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_misc_varient();
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
                $da->brand_name,
                $da->model_name,
                $da->fuel_type,
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

	public function add_misc_varient()
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
                $fuel_type = $this->input->post("fuel");
        		$data = array("varient_name" => $name,
        		              "brand_id" => $brand,
        		              "model_id" => $model,
        		              "fuel_id" => $fuel_type,
        		              "created_by" => $this->session->userdata("session_id"),
        		              "created_at" => date("Y-m-d H:i:s"));
        		$this->mm->add_misc_varient($data);
                foreach($name1 as $n)
                {
                    $data = array("varient_name" => $n,
        		              "brand_id" => $brand,
        		              "model_id" => $model,
        		              "fuel_id" => $fuel_type,
        		              "created_by" => $this->session->userdata("session_id"),
        		            "created_at" => date("Y-m-d H:i:s"));
        		$this->mm->add_misc_varient($data);
                }
                echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='misc_varient';</script>";
	        }
    	}
	}

	public function fetch_edit_misc_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_misc_varient($id);
			$model_option = $this->get_misc_model_list_option($res->brand_id);
			$data = array("res" =>$res, "model_option" => $model_option);
			echo json_encode($data);
		}
	}

	public function edit_misc_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	   
	        if($check_user_i->masters_edit == "1")
	        {
    		$name = $this->input->post("name");
    		$brand = $this->input->post("brand");
    		$model = $this->input->post("model");
    		$fuel = $this->input->post("fuel");
    		$id = $this->input->post("id");

    		$data = array("varient_name" => $name,
    		                "brand_id" => $brand,
    		                "model_id" => $model,
    		              "fuel_id" => $fuel,
    		                "updated_by" => $this->session->userdata("session_id"),
    		                "updated_at" => date("Y-m-d H:i:s"));
    		$this->mm->edit_misc_varient($id, $data);

    		echo "Success";
	        }
	        else
	        {
	             echo "<script>alert('Permission Denied');window.location.href='misc_varient';</script>";
	        }
    	}
	}
	
	public function get_misc_model_list_option($brand)
	{
	    $res = $this->mm->get_misc_model_list_option($brand);
	    $data = "<option value=''>Select Model</option>";
	    foreach($res as $r)
	    {
	        $data.= "<option value='".$r->id."'>".$r->model_name."</option>";
	    }
	    return $data;
	}
	
	public function get_misc_model_list()
	{
	    $brand = $this->input->post("brand");
	    $res = $this->mm->get_misc_model_list($brand);
	    $data = "<option value=''>Select Model</option>";
	    foreach($res as $r)
	    {
	        $data.= "<option value='".$r->id."'>".$r->model_name."</option>";
	    }
	    echo $data;
	}
	
	//PC
	//pc vehicle
	
	public function pc_brand()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["policy_type"] = $this->mm->fetch_policy_type_pcv();
    		$this->load->view('header',$pro_data);
    		$this->load->view('pc_brand',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	         $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    	        $data["policy_type"] = $this->mm->fetch_policy_type_pcv();
        		$this->load->view('header',$pro_data);
        		$this->load->view('pc_brand',$data);
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

	public function fetch_pc_brand()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();
		
		$policy_type = $this->input->post("policy_type");

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_pc_brand($policy_type);
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
                $da->p_type,
                $da->brand_name,
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

	public function add_pc_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
            $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
  
            if($check_user_i->masters_add == "1")
            {
        		$name = $this->input->post("name");
        		$policy_type = explode(",",$this->input->post("policy_type"));

        		for($i=0;$i<count($policy_type);$i++)
        		{
            		$data = array(
            		             "policy_type" =>$policy_type[$i],
            		             "brand_name" => $name,
            		            "created_by" => $this->session->userdata("session_id"),
            		            "created_at" => date("Y-m-d H:i:s"));
            		$this->mm->add_pc_brand($data);
        		}
        		echo "Success";
            }
            else
            {
                echo "<script>alert('Permission Denied');window.location.href='pc_brand';</script>";
            }
    	}
	}

	public function fetch_edit_pc_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_pc_brand($id);
			echo json_encode($res);
		}
	}

	public function edit_pc_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	     $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
  
            if($check_user_i->masters_edit == "1")
            {
        		$name = $this->input->post("name");
        		$id = $this->input->post("id");
            	$data = array("brand_name" => $name,
    	            "updated_by" => $this->session->userdata("session_id"),
    	            "updated_at" => date("Y-m-d H:i:s"));
    	        $this->mm->edit_pc_brand($id, $data);
        		echo "Success";
            }
            else
            {
                echo "<script>alert('Permission Denied');window.location.href='pc_brand';</script>";
            }
    	}
	}
	
	//pc Model

    public function pc_model()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->mm->fetch_pc_brand_list();
		   	$data["policy_type"] = $this->mm->fetch_policy_type_pcv();
    		$this->load->view('header',$pro_data);
    		$this->load->view('pc_model',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    	       	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		   	$data["brand"] = $this->mm->fetch_pc_brand_list();
    		   	$data["policy_type"] = $this->mm->fetch_policy_type_pcv();
        		$this->load->view('header',$pro_data);
        		$this->load->view('pc_model',$data);
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

	public function fetch_pc_model()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();
		
		$policy_type = $this->input->post("policy_type");
		$s_pc_brand = $this->input->post("s_pc_brand");

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_pc_model($policy_type,$s_pc_brand);
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
                $da->p_type,
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

   
	public function add_pc_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	   $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
        	
	        if($check_user_i->masters_add == "1")
	        {
	        $policy_type = $this->input->post("policy_type");
    		$name = $this->input->post("name");
    		$name1 = $this->input->post("name1");
            $brand = $this->input->post("brand");
    		$data = array(
    		                "policy_type" => $policy_type,
    		               "model_name" => $name,
    		              "brand_id" => $brand,
    		              "created_by" => $this->session->userdata("session_id"),
    		            "created_at" => date("Y-m-d H:i:s"));
    		$this->mm->add_pc_model($data);
            foreach($name1 as $n)
            {
                $data = array(
                          "policy_type" => $policy_type,
                          "model_name" => $n,
    		              "brand_id" => $brand,
    		              "created_by" => $this->session->userdata("session_id"),
    		            "created_at" => date("Y-m-d H:i:s"));
    		$this->mm->add_pc_model($data);
            }
    		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
	}

	public function fetch_edit_pc_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_pc_model($id);
			echo json_encode($res);
		}
	}

	public function edit_pc_model()
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
        		$this->mm->edit_pc_model($id, $data);
    
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='pc_model';</script>";
	        }
    	}
	}
	//pc Varient
	
	public function pc_varient()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->mm->fetch_pc_brand_list();
		   	$data["fuel"] = $this->mm->fetch_fuel_type();
		   	$data["policy_type"] = $this->mm->fetch_policy_type_pcv();
    		$this->load->view('header',$pro_data);
    		$this->load->view('pc_varient',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    		   	$data["brand"] = $this->mm->fetch_pc_brand_list();
    		   	$data["fuel"] = $this->mm->fetch_fuel_type();
    		   	$data["policy_type"] = $this->mm->fetch_policy_type_pcv();
        		$this->load->view('header',$pro_data);
        		$this->load->view('pc_varient',$data);
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

	public function fetch_pc_varient()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();
		
		$policy_type = $this->input->post("s_policy_type");
		$s_pc_brand = $this->input->post("s_pc_brand");
		$s_pc_model = $this->input->post("s_pc_model");

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_pc_varient($policy_type,$s_pc_brand,$s_pc_model);
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
                $da->p_type,
                $da->brand_name,
                $da->model_name,
                $da->fuel_type,
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

	public function add_pc_varient()
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
                $fuel_type = $this->input->post("fuel");
                $policy_type = $this->input->post("policy_type");
                
        		$data = array(
        		              "policy_type" =>$policy_type,
        		              "varient_name" => $name,
        		              "brand_id" => $brand,
        		              "model_id" => $model,
        		              "fuel_id" => $fuel_type,
        		              "created_by" => $this->session->userdata("session_id"),
        		              "created_at" => date("Y-m-d H:i:s"));
        		$this->mm->add_pc_varient($data);
                foreach($name1 as $n)
                {
                    $data = array(
                              "policy_type" =>$policy_type,
                               "varient_name" => $n,
        		              "brand_id" => $brand,
        		              "model_id" => $model,
        		              "fuel_id" => $fuel_type,
        		              "created_by" => $this->session->userdata("session_id"),
        		            "created_at" => date("Y-m-d H:i:s"));
        		$this->mm->add_pc_varient($data);
                }
        		
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='pc_varient';</script>";
	        }
    	}
	}

	public function fetch_edit_pc_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_pc_varient($id);
			$model_option = $this->get_pc_model_list_option($res->brand_id);
			$data = array("res" =>$res, "model_option" => $model_option);
			echo json_encode($data);
		}
	}

	public function edit_pc_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	   $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
            
	        if($check_user_i->masters_edit == "1")
	        {
        		$name = $this->input->post("name");
        		$brand = $this->input->post("brand");
        		$model = $this->input->post("model");
        		$fuel = $this->input->post("fuel");
        		$id = $this->input->post("id");
    
        		$data = array("varient_name" => $name,
        		                "brand_id" => $brand,
        		                "model_id" => $model,
        		              "fuel_id" => $fuel,
        		                "updated_by" => $this->session->userdata("session_id"),
        		                "updated_at" => date("Y-m-d H:i:s"));
        		$this->mm->edit_pc_varient($id, $data);
    
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='pc_varient';</script>";
	        }
    	}
	}
	
	public function get_pc_model_list_option($brand)
	{
	    $res = $this->mm->get_pc_model_list_option($brand);
	    $data = "<option value=''>Select Model</option>";
	    foreach($res as $r)
	    {
	        $data.= "<option value='".$r->id."'>".$r->model_name."</option>";
	    }
	    return $data;
	}
	
	public function get_pc_model_list()
	{
	    $brand = $this->input->post("brand");
	    $res = $this->mm->get_pc_model_list($brand);
	    $data = "<option value=''>Select Model</option>";
	    foreach($res as $r)
	    {
	        $data.= "<option value='".$r->id."'>".$r->model_name."</option>";
	    }
	    echo $data;
	}
	
	//Bike Brand
	public function bike_brand()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('bike_brand');
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    	    	$pro_data["project_info"] = $this->mm->fetch_project_info();
        		$this->load->view('header',$pro_data);
        		$this->load->view('bike_brand');
        		$this->load->view('footer',$pro_data);
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
	    }
	    else
	    {
	        redirect("home");
	    }
	}

	public function fetch_bike_brand()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_bike_brand();
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

	public function add_bike_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	   $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
        	 
	        if($check_user_i->masters_add == "1")
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
            		$this->mm->add_bike_brand($data);
        
            		echo "Success";
            	}
    	}
    	else
    	{
    	   echo "<script>alert('Permission Denied');window.location.href='home';</script>";
    	}
	}

	public function fetch_edit_bike_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_bike_brand($id);
			echo json_encode($res);
		}
	}

	public function edit_bike_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
        	 
	        if($check_user_i->masters_edit == "1")
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
                        $old_file_name = $this->mm->fetch_edit_brand($id)->icon_name;
                        unlink("./datas/images/brand_icons/".$old_file_name);
                    	$data = array("brand_name" => $name,
        		            "icon" => $file_path,
        		            "icon_name" => $file,
        		            "updated_by" => $this->session->userdata("session_id"),
        		            "updated_at" => date("Y-m-d H:i:s"));
        		        $this->mm->edit_bike_brand($id, $data);
                }
                else
                {
                    	$data = array("brand_name" => $name,
        		            "updated_by" => $this->session->userdata("session_id"),
        		            "updated_at" => date("Y-m-d H:i:s"));
        		        $this->mm->edit_bike_brand($id, $data);
                }
        	
    
        		echo "Success";
        	}
    	}
    	else
    	{
      echo "<script>alert('Permission Denied');window.location.href='home';</script>";

    	}
	}
	
	//Bike Model

    public function bike_model()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->mm->fetch_bike_brand();
    		$this->load->view('header',$pro_data);
    		$this->load->view('bike_model',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    		   	$data["brand"] = $this->mm->fetch_bike_brand();
        		$this->load->view('header',$pro_data);
        		$this->load->view('bike_model',$data);
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

	public function fetch_bike_model()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_bike_model();
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
	}

	public function add_bike_model()
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
        		$this->mm->add_bike_model($data);
                foreach($name1 as $n)
                {
                    $data = array("model_name" => $n,
        		              "brand_id" => $brand,
        		              "created_by" => $this->session->userdata("session_id"),
        		            "created_at" => date("Y-m-d H:i:s"));
        		$this->mm->add_bike_model($data);
                }
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
	}

	public function fetch_edit_bike_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_bike_model($id);
			echo json_encode($res);
		}
	}

	public function edit_bike_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	  if($check_user_i->masters_edit == "1")
	        {
        		$name = $this->input->post("name");
        		$brand = $this->input->post("brand");
        		$id = $this->input->post("id");
    
        		$data = array("model_name" => $name,
        		                "brand_id" => $brand,
        		                "updated_by" => $this->session->userdata("session_id"),
        		                "updated_at" => date("Y-m-d H:i:s"));
        		$this->mm->edit_bike_model($id, $data);
    
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
	}

	public function delete_bike_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    if($check_user_i->masters_delete == "1")
	        {
    			$id = $this->input->post("id");
    			$this->mm->delete_bike_model($id);
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
	}
	public function get_bike_brand_logo()
	{
	    $brand = $this->input->post("brand");
	    echo $this->mm->fetch_edit_bike_brand($brand)->icon;
	}
	
	// Bike Varient
	
	public function bike_varient()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->mm->fetch_bike_brand();
    		$this->load->view('header',$pro_data);
    		$this->load->view('bike_varient',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->mm->fetch_bike_brand();
    		$this->load->view('header',$pro_data);
    		$this->load->view('bike_varient',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}

	public function fetch_bike_varient()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_bike_varient();
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

	public function add_bike_varient()
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
        		$this->mm->add_bike_varient($data);
        		if(isset($name1) && !empty($name1)){
                    foreach($name1 as $n)
                    {
                        $data = array("varient_name" => $n,
            		              "brand_id" => $brand,
            		              "model_id" => $model,
            		              "created_by" => $this->session->userdata("session_id"),
            		            "created_at" => date("Y-m-d H:i:s"));
            		$this->mm->add_bike_varient($data);
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

	public function fetch_edit_bike_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_bike_varient($id);
			$model_option = $this->get_bike_model_list_option($res->brand_id);
			$icon = $this->mm->fetch_edit_bike_brand($res->brand_id)->icon;
			$data = array("res" =>$res, "model_option" => $model_option, "icon" => $icon);
			echo json_encode($data);
		}
	}

	public function edit_bike_varient()
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
        		$this->mm->edit_bike_varient($id, $data);
    
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='bike_varient';</script>";
	        }
    	}
	}

	public function delete_bike_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	  if($check_user_i->masters_delete == "1")
	        {
			$id = $this->input->post("id");
			$this->mm->delete_model($id);
	        }
	        else
	        {
	             echo "<script>alert('Permission Denied');window.location.href='bike_varient';</script>";
	        }
    	}
	}
	public function get_bike_model_list()
	{
	    $brand = $this->input->post("brand");
	    $res = $this->mm->get_bike_model_list($brand);
	    $data = "<option value=''>Select Model</option>";
	    foreach($res as $r)
	    {
	        $data.= "<option value='".$r->id."'>".$r->model_name."</option>";
	    }
	    echo $data;
	}
	public function get_bike_model_list_option($brand)
	{
	    $res = $this->mm->get_bike_model_list($brand);
	    $data = "<option value=''>Select Model</option>";
	    foreach($res as $r)
	    {
	        $data.= "<option value = '".$r->id."'>".$r->model_name."</option>";
	    }
	    return $data;
	}
	
	/// test 
	
	
	 public function model1()
	{
		if($this->session->has_userdata('logged_in')) 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->mm->fetch_brand();
    		$this->load->view('header',$pro_data);
    		//$this->load->view('sidebar',$pro_data);
    		$this->load->view('model1',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}
                
                // test	
	
		public function add_model1()
    	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$name = $this->input->post("name");
            $brand = $this->input->post("brand");
            
             if(isset($_FILES))
        		{
        			$config['upload_path'] = './models/';
        			$config['allowed_types'] = 'gif|jpg|png|jpeg';
        			
        			$this->load->library('upload',$config);
        			$this->upload->initialize($config);
        			if(!$this->upload->do_upload('file'))
        			{
        				$file = '';
        				$file_path ='';
        			}
        			else
        			{
        				$file_path = base_url().'models/'.$this->upload->data('file_name');
        				$file = $this->upload->data('file_name');
        			}
        		}
        		
    		$data = array("model_name" => $name,
    		              "brand_id" => $brand,
    	                  "file" =>$file,
    		              "created_by" => $this->session->userdata("session_id"),
    		              "created_at" => date("Y-m-d H:i:s"));
    		$this->mm->add_model1($data);
    		
           
    		echo "Success";
    	}
	}
	
    public function edit_model1()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$name = $this->input->post("name");
    		$brand = $this->input->post("brand");
    		$id = $this->input->post("id");
    		 if(isset($_FILES))
            {
                $config['upload_path'] = './models/';
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                
                $this->load->library('upload',$config);
                $this->upload->initialize($config);
                if(!$this->upload->do_upload('file'))
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
                
                   unlink("./models/".$old_file_name);
                   $data = array("model_name" => $name,
                           "brand_id" => $brand,
                           "file" => $file,
                           "updated_by" => $this->session->userdata("session_id"),
    		               "updated_at" => date("Y-m-d H:i:s"));
    		                $this->mm->edit_model1($id,$data);
            }
            
            else
            {
                $data = array("model_name" => $name,
                              "brand_id" => $brand,
                              "updated_by" => $this->session->userdata("session_id"),
    		                  "updated_at" => date("Y-m-d H:i:s"));
    		                   $this->mm->edit_model1($id,$data);
            }
            
	
    	}
	
	}

    // pets_breed start
    
    public function pet_breed()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('pet_breed');
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
        		$this->load->view('header',$pro_data);
        		$this->load->view('pet_breed');
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
    
    
    
    
    public function fetch_pets_breed()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_pets_breed();
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
                $da->pet_name,
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
    
    
    public function add_pets_breed()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	     $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
          
	        if($check_user_i->masters_add == "1")
	        {
        		$pet_name = $this->input->post("pet_name");
        		$data = array("pet_name" => $pet_name,
        		            "created_by" => $this->session->userdata("session_id"),
        		            "created_at" => date("Y-m-d H:i:s"));
        		$res = $this->mm->add_pets_breed($data);
        		if( $res ) {
    	            $this->audit->log('list_of_pets_breed', 'INSERT', null, null, $data);
    	        }
    
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='pet_breed';</script>";
	        }
    	}
	}

	public function fetch_edit_pets_breed()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_pets_breed($id);
			echo json_encode($res);
		}
	}

	public function edit_pets_breed()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	   $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_edit == "1")
	        {  
        		$pet_name = $this->input->post("pet_name");
        		$id = $this->input->post("id");
            	$data = array("pet_name" => $pet_name,
    	            "updated_by" => $this->session->userdata("session_id"),
    	            "updated_at" => date("Y-m-d H:i:s"));
    	            
    	        $old_data = $this->mm->fetch_edit_pets_breed($id);
    	        $res = $this->mm->edit_pets_breed($id, $data);
    	        if( $res ) {
    	            $this->audit->log('list_of_pets_breed', 'INSERT', null, $old_data, $data);
    	        }
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
	}
    
    
    
    
    // pets_breed end 
    
    // commodity
    public function commodity()
	{
		if($this->session->has_userdata('logged_in')) 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		//$this->load->view('sidebar',$pro_data);
    		$this->load->view('commodity');
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}

	public function fetch_marine_commodity()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_marine_commodity();
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Edit</button>"; 
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

	public function add_marine_commodity()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$name = $this->input->post("name");
    		$data = array("name" => $name,
    		            "created_by" => $this->session->userdata("session_id"),
    		            "created_at" => date("Y-m-d H:i:s"));
    		$this->mm->add_marine_commodity($data);

    		echo "Success";
    	}
	}

	public function fetch_edit_marine_commodity()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_marine_commodity($id);
			echo json_encode($res);
		}
	}

	public function edit_marine_commodity()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$name = $this->input->post("name");
    		$id = $this->input->post("id");
        	$data = array("name" => $name,
	            "updated_by" => $this->session->userdata("session_id"),
	            "updated_at" => date("Y-m-d H:i:s"));
	        $this->mm->edit_marine_commodity($id, $data);
    		echo "Success";
    	}
	}
	
	
	//Sub commodity
	public function sub_commodity()
	{
		if($this->session->has_userdata('logged_in')) 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["commodity"] = $this->mm->fetch_marine_commodity();
    		$this->load->view('header',$pro_data);
    		//$this->load->view('sidebar',$pro_data);
    		$this->load->view('sub_commodity',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}

	public function fetch_marine_sub_commodity()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_marine_sub_commodity();
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Edit</button>"; 
            		 //<button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> Delete</button>";
            
            $arr[] = array(
                $a,
                $da->commodity_name,
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

	public function add_marine_sub_commodity()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$name = $this->input->post("name");
    		$name1 = $this->input->post("name1");
            $brand = $this->input->post("commodity");
    		$data = array("name" => $name,
    		              "commodity_id" => $brand,
    		              "created_by" => $this->session->userdata("session_id"),
    		            "created_at" => date("Y-m-d H:i:s"));
    		$this->mm->add_marine_sub_commodity($data);
            foreach($name1 as $n)
            {
                $data = array("name" => $n,
    		              "commodity_id" => $brand,
    		              "created_by" => $this->session->userdata("session_id"),
    		            "created_at" => date("Y-m-d H:i:s"));
    		$this->mm->add_marine_sub_commodity($data);
            }
    		echo "Success";
    	}
	}

	public function fetch_edit_marine_sub_commodity()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_marine_sub_commodity($id);
			echo json_encode($res);
		}
	}

	public function edit_marine_sub_commodity()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$name = $this->input->post("name");
    		$brand = $this->input->post("commodity");
    		$id = $this->input->post("id");

    		$data = array("name" => $name,
    		                "commodity_id" => $brand,
    		                "updated_by" => $this->session->userdata("session_id"),
    		                "updated_at" => date("Y-m-d H:i:s"));
    		$this->mm->edit_marine_sub_commodity($id, $data);

    		echo "Success";
    	}
	}
	
	
//  add company name start
	
    public function insurance_company()
	{
		 if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('insurance_company');
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	         $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    	    	$pro_data["project_info"] = $this->mm->fetch_project_info();
        		$this->load->view('header',$pro_data);
        		$this->load->view('insurance_company');
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
	
	
	public function fetch_company()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_company();
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
                $da->company_name,
                "<Img src='".$da->icon."' width='100' height='100'>",
                $da->short_name,
                $da->order_no,
                $da->companytype,
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
	
	
	public function add_company_name()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	    
	        if($check_user_i->masters_add == "1")
	        {
    		$company_name = $this->input->post("company_name");
    		$order_no = $this->input->post("order_no");
    		$short_name = $this->input->post("short_name");
    		$companytype= $this->input->post("companytype");
    		$address1   = $this->input->post("address1");
    		$address2   = $this->input->post("address2");
    		$city       = $this->input->post("city");
    		$pincode    = $this->input->post("pincode");
    		$states     = $this->input->post("states");
    		$gstno      = $this->input->post("gstno");
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
                    
                   $this->load->library('image_lib');
    			   $image_data =   $this->upload->data();
    
    			   $configer =  array(
    			  'image_library'   => 'gd2',
    			  'source_image'    =>  $image_data['full_path'],
    			  'maintain_ratio'  =>  FALSE, 
    			   'width'           => 117, 
    			   'height'          => 117,
    			);

    			$this->image_lib->clear();
     			$this->image_lib->initialize($configer);
    			$this->image_lib->resize();
                    
                    
                $file_path = base_url().'datas/images/brand_icons/'.$this->upload->data('file_name');
                $file = $this->upload->data('file_name');
                
                }
            }
    		$data = array("company_name" => $company_name,
    		              "order_no" => $order_no,
    		              "short_name" => $short_name,
    		              "companytype" => $companytype,
    		              "address1" => $address1,
    		              "address2" => $address2,
    		              "city" => $city,
    		              "pincode" => $pincode,
    		              "states" => $states,
    		              "gstno" => $gstno,
        		           "icon" => $file_path,
        		           "icon_name" => $file,
        		           "created_by" => $this->session->userdata("session_id"),
        		           "created_at" => date("Y-m-d H:i:s"));
        		           
    		$res = $this->mm->add_company_name($data);
    		if( $res ) {
	            $this->audit->log('list_of_insurance_company', 'INSERT', null, null, $data);
	        }
    		
            $this->create_insurance_company_ledger($res);
            
    		echo "Success";
    	}
        	else
        	{
        	    echo "<script>alert('Permission Denied');window.location.href='insurance_company';</script>";
        	}
    	}
	}
	
	
	public function fetch_edit_company()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_company($id);
			echo json_encode($res);
		}
	}
	
	
	public function edit_company_name()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	    
            	  if($check_user_i->masters_edit == "1")
        	       {  
            		$company_name = $this->input->post("company_name");
            		$order_no = $this->input->post("order_no");
            		$short_name = $this->input->post("short_name");
            		$companytype= $this->input->post("companytype");
            		$address1   = $this->input->post("address1");
            		$address2   = $this->input->post("address2");
            		$city       = $this->input->post("city");
            		$pincode    = $this->input->post("pincode");
            		$states     = $this->input->post("states");
            		$gstno      = $this->input->post("gstno");
            		
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
                           $this->load->library('image_lib');
            			   $image_data =   $this->upload->data();
            
            			   $configer =  array(
            			  'image_library'   => 'gd2',
            			  'source_image'    =>  $image_data['full_path'],
            			  'maintain_ratio'  =>  TRUE, // if FALSE, it change the shape of image. Try it
            			  'width'           => 117, // if maintain_ratio is TRUE, will consider only which is maximum length
            			  'height'          => 117,
            			);
        
                		   $this->image_lib->clear();
                 		   $this->image_lib->initialize($configer);
                		   $this->image_lib->resize();
                            
        
                           $file_path = base_url().'datas/images/brand_icons/'.$this->upload->data('file_name');
                           $file = $this->upload->data('file_name');
                        
                        }
                    }
                    if($file_path != "")
                    {
                            $old_file_name = $this->mm->fetch_edit_company($id)->icon_name;
                            unlink("./datas/images/brand_icons/".$old_file_name);
                        	$data = array("company_name" => $company_name,
                        	               "order_no" => $order_no,
                        	               "short_name" => $short_name,
                        	               "companytype" => $companytype,
                        	               "address1" => $address1,
                    		               "address2" => $address2,
                    		               "city" => $city,
                    		               "pincode" => $pincode,
                    		               "states" => $states,
                    		               "gstno" => $gstno,
                        		           "icon" => $file_path,
                        		           "icon_name" => $file,
                        		           "updated_by" => $this->session->userdata("session_id"),
                        		           "updated_at" => date("Y-m-d H:i:s"));
            		        $this->mm->edit_company_name($id, $data);
                    }
                    else
                    {
                        	$data = array("company_name" => $company_name,
                        	               "order_no" => $order_no,
                        	               "short_name" => $short_name,
                        	               "companytype" => $companytype,
                        	               "address1" => $address1,
                    		               "address2" => $address2,
                    		               "city" => $city,
                    		               "pincode" => $pincode,
                    		               "states" => $states,
                    		               "gstno" => $gstno,
                        		           "updated_by" => $this->session->userdata("session_id"),
                        		           "updated_at" => date("Y-m-d H:i:s"));
                        		           
                        	$old_data = $this->mm->fetch_edit_company($id);
            		        $res = $this->mm->edit_company_name($id, $data);
            		        if( $res ) {
                	            $this->audit->log('list_of_insurance_company', 'UPDATE', null, $old_data, $data);
                	        }
                    }
            	
        
            		echo "Success";
            	}
            	else
            	{
            	    echo "<script>alert('Permission Denied');window.location.href='insurance_company';</script>";
            	}
    	}
	}
	
	
     public function check_add_permission_1()
       {
            if($this->session->has_userdata('logged_in')) 
        	{
        	    $check_permission = $this->mm->fetch_user_permissions($this->session->userdata("session_id"));
        	    echo json_encode($check_permission);
        	}
       }
	
// 	add company name end



// bank name start

public function bank_name()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('bank_name');
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
        		$this->load->view('header',$pro_data);
        		$this->load->view('bank_name');
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
	
	public function fetch_bank_name()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_bank_name();
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
                $da->bank_name,
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
	
	
	
// 	bank name end



 public function add_bank_name()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	     $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
          
	        if($check_user_i->masters_add == "1")
	        {
        		$bank_name = $this->input->post("bank_name");
        		$data = array("bank_name" => $bank_name,
        		              "created_by" => $this->session->userdata("session_id"),
        		              "created_at" => date("Y-m-d H:i:s"));
        		              
        		$res = $this->mm->add_bank_name($data);
        		if( $res ) {
    	            $this->audit->log('list_of_bank_name', 'INSERT', null, null, $data);
    	        }
    
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='bank_name';</script>";
	        }
    	}
	}


  public function fetch_edit_bank_name()
     {
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_bank_name($id);
			echo json_encode($res);
		}
	}


  public function edit_bank_name()
  {
     if($this->session->has_userdata('logged_in')) 
    	{
    	   $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_edit == "1")
	        {  
        		$bank_name = $this->input->post("bank_name");
        		$id = $this->input->post("id");
            	$data = array("bank_name" => $bank_name,
    	                      "updated_by" => $this->session->userdata("session_id"),
    	                      "updated_at" => date("Y-m-d H:i:s"));
    	                      
                $old_data = $this->mm->fetch_edit_bank_name($id);
    	        $res = $this->mm->edit_bank_name($id, $data);
    	        if( $res ) {
    	            $this->audit->log('list_of_bank_name', 'UPDATE', null, $old_data, $data);
    	        }
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
  }
  
  public function fetch_brand_by_policy_id()
  {
      if($this->session->has_userdata('logged_in')) 
      {
          $policy_type = $this->input->post("policy_type");
          $res = $this->mm->fetch_brand_by_policy_id($policy_type);
          
          $content = "<option value=''>Select Brand</option>";
          
          foreach($res as $da)
          {
              $content .= "<option value='".$da->id."'>".$da->brand_name."</option>";
          }
          
          echo $content;
      }
  }
  
  public function fetch_brand_by_policy_id_pcv()
  {
      if($this->session->has_userdata('logged_in')) 
      {
          $policy_type = $this->input->post("policy_type");
          $res = $this->mm->fetch_brand_by_policy_id_pcv($policy_type);
          
          $content = "<option value=''>Select Brand</option>";
          
          foreach($res as $da)
          {
              $content .= "<option value='".$da->id."'>".$da->brand_name."</option>";
          }
          
          echo $content;
      }
  }
  
  
  public function pcv_seating()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["policy_type"] = $this->mm->fetch_policy_type();
    		$this->load->view('header',$pro_data);
    		$this->load->view('pcv_seating',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        
	        if($check_user_i->masters_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    	        $data["policy_type"] = $this->mm->fetch_policy_type();
        		$this->load->view('header',$pro_data);
        		$this->load->view('pcv_seating',$data);
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

	public function fetch_pcv_seating()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_pcv_seating();
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "";
            
            $arr[] = array(
                $a,
                $da->p_type,
                $da->seating_capacity,
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

	public function add_pcv_seating()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$seating = $this->input->post("seating");
    		$policy_type =  $this->input->post("policy_type");

    		$data = array(
    		               "policy_type" => $policy_type,
    		               "seating_capacity" =>$seating,
    		               );
    		$res = $this->mm->add_pcv_seating($data);
    		if( $res ){
		        $this->audit->log('pcv_seating', 'INSERT', null, null, $data);
		    }
    		
    		echo "Success";
    	}
	}
	
	
	// District
	
	//Commission state
	public function district()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('district');
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user")
	    {
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
        		$this->load->view('header',$pro_data);
        		$this->load->view('district');
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

	public function fetch_district()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_district();
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
                $da->district,
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

	public function add_district()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	  
	        if($check_user_i->masters_add == "1")
	        {
        		$name = $this->input->post("name");
        		$data = array("district" => $name);
        		$res = $this->mm->add_district($data);
                if( $res ) {
    	            $this->audit->log('list_of_districts', 'INSERT', null, null, $data);
    	        }
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
	}

	public function fetch_edit_district()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_district($id);
			echo json_encode($res);
		}
	}

	public function edit_district()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	   $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	   
	        if($check_user_i->masters_add == "1")
	        {
        		$name = $this->input->post("name");
        		$id = $this->input->post("id");
            	$data = array("district" => $name);
            	$old_data = $this->mm->fetch_edit_district($id);
    	        if( $this->mm->edit_district($id, $data) ) {
    	            $this->audit->log('list_of_districts', 'UPDATE', null, $old_data, $data);
    	        }
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
	}
	
	public function careapi()
	{
           $curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => 'https://apiuat.religarehealthinsurance.com/relinterfacerestful/religare/secure/restful/generatePartnerToken',
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => '',
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 0,
              CURLOPT_FOLLOWLOCATION => false,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => 'POST',
              CURLOPT_POSTFIELDS =>'{
              "partnerTokenGeneratorInputIO": {
                "partnerId": "516215",
                "securityKey": "dkpBQ0Q3cGVGb1NXVnNsWW1EaERWb0ErQVFyTGFhSytNZCtrVzdzRGtrOW1DWktaTDdwWHRWdVZoYnpyV1JseA=="
              }
            }',
              CURLOPT_HTTPHEADER => array(
                'appId: 516215',
                'signature: JsnNW921WJDN51CUaadctSNkGDWlXo/28TrIKuKUIhc=',
                'timestamp: 1568801564676',
                'applicationCD: PARTNERAPP',
                'Content-Type: application/json'
              ),
            ));
            
            $response = curl_exec($curl);
            curl_close($curl);
            
            //echo $response;
            
            $data = json_decode($response, true);
            
            
            $arr = [];
            
            $token_arr = [];
            
            foreach($data as $key => $value)
            {
                foreach ($value as $sub_key => $sub_val) 
                {
                        if (is_array($sub_val)) 
                        {
                            foreach ($sub_val as $k => $v) 
                            {
                                foreach ($v as $c => $d) 
                                {
                                    if($c == "tokenValue")
                                    {
                                        $token_arr[] = array($c => $d);
                                    }
                                }
                            }
                        } 
                        else
                        {
                              $arr[] = array($sub_key => $sub_val);
                        }
                }
            }
            

            
           
            
               echo $token_arr[0]["tokenValue"];
            
            

}

//joine call//
public function joinecall()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["class"] = $this->lm->fetch_list_of_class();
		   	$data["client_type"] = $this->lm->fetch_client_type();
		   	$data["business"] = $this->lm->fetch_business_type();
		   	$data["region"] = $this->mm->fetch_region();
		   	$data["name"]=$this->lm->fetch_areaincharge();
		   	$data["dealers"]=$this->mm->fetch_dealers();
		   	$data["users"] = $this->mm->fetch_users_list();
    		$this->load->view('header',$pro_data);
    		$this->load->view('bussiness_joint_call',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user")
	    {
                $pro_data["project_info"] = $this->mm->fetch_project_info();
                $data["class"] = $this->lm->fetch_list_of_class();
                $data["client_type"] = $this->lm->fetch_client_type();
                $data["business"] = $this->lm->fetch_business_type();
                $data["region"] = $this->mm->fetch_region();
                $data["name"]=$this->lm->fetch_areaincharge();
                $data["dealers"]=$this->mm->fetch_dealers();
        		$this->load->view('header',$pro_data);
        		$this->load->view('bussiness_joint_call',$data);
        		$this->load->view('footer',$pro_data);
        		
	        }
	    
	    else 
	    {
	    	redirect("login");
	    }
	}

    public function fetch_bussinesscall()
    {
        if($this->session->has_userdata('logged_in')) 
        {
            $draw = intval($this->input->post("draw"));
            $res = array();
            
            $region = $this->input->post("region");
            $fromdate = $this->input->post("fromdate");
            $todate = $this->input->post("todate");
            $mobile_no = $this->input->post("mobile_no");
            $insurer = $this->input->post("insurer");
            $areaincharge =$this->input->post("areaincharge");
            
            $res = $this->mm->fetch_bussinesscall($region,$fromdate,$todate,$mobile_no,$insurer,$areaincharge);
            
            $arr = [];
            $a = 0 ;
            
            foreach($res as $da)
            {
                 $a++;
                $action = '<div class="btn-group">
                   <button type="button" class="btn btn-success">Action</button>
                   <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li> <a class="dropdown-item" href="#" onclick=edit_data('.$da->id.')>Edit</a></li>
                    <li><a class="dropdown-item" onclick=delete_data('.$da->id.')>Delete</a></li>
                    <li><a class="dropdown-item" onclick=view_data('.$da->id.')>View</a></li>
                    <li><a class="dropdown-item" onclick=report('.$da->areaincharge.')>Report</a></li>
                </ul>
                </div>';
            
                $data = $this->mm->get_created_person_name($da->created_by);
                $date = date_format(date_create($da->entry_date),"d-m-Y H:i:s a");
                
                 if($da->activice == "dealers")
                 {
                   $name = $da->dealer_name." (Dealers)";
                 }
                 else if($da->activice == "Agent")
                 {
                     $name = $da->agn_name." (Agent)";
                 }
                 else 
                 {
                     $name = $da->insurer." (Client)";
                 }
                 
                $arr[] = array(
                    $a,
                    $name,
                    $da->sname,
                    $da->region,
                    $da->address,
                    $da->remark,
                    $date,
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
	
	public function add_bussinesscalldetails()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$clienttype = "";
    		$insurer = $this->input->post("insurer");
    		$region = $this->input->post("region");
    		$areaincharge = $this->input->post("areaincharge");
    // 		$businesslocation =  $this->input->post("businesslocation");
    // 		$location = $this->input->post("location");
    		//$activice =$this->input->post("activice");
    		$address =$this->input->post("address");
    		//$pin =$this->input->post("pin");
    		$policy_type = $this->input->post("policy");
    		$contactperson   = $this->input->post("contactperson");
    		$contactemail = $this->input->post("contactemail");
    		$contactnumber   = $this->input->post("contactnumber");
    		$remark =$this->input->post("remark");
    		//$date =$this->input->post("date");
    		$entry_date = $this->input->post("entry_date");
    		$status =$this->input->post("status");
    		$file_type =$this->input->post("file_type");
    		
    		$v_regn_no_1 =$this->input->post("v_regn_no_1");
    		$v_regn_no_2 =$this->input->post("v_regn_no_2");
    		$v_regn_no_3 =$this->input->post("v_regn_no_3");
    		$v_regn_no_4 =$this->input->post("v_regn_no_4");
    		
    		$regn_no = "";
    		
    		if($v_regn_no_1 != "" && $v_regn_no_2 != "" && $v_regn_no_3 != "" && $v_regn_no_4 != "")
    		{
    		   $regn_no = $v_regn_no_1."-".$v_regn_no_2."-".$v_regn_no_3."-".$v_regn_no_4;
    		}
    	
            $data = array(  
                    "clienttype" => $clienttype,
                    "insurer" =>$insurer,
                    "region"=>$region,
                    "areaincharge" =>$areaincharge,
                    // "businesslocation"=>$businesslocation,
                    // "location"=>$location,
                    //"activice" =>$activice,
                    "address" =>$address,
                    //"pin" =>$pin,
                    "remark"=>$remark,
                    //"date"=>$date,
                    "entry_date" =>$entry_date,
                    "regn_no" =>$regn_no,
                    "created_by" =>$this->session->userdata("session_id"),
                    "created_date" =>date("Y-m-d"),
               );
            	               
            $insert_id = $this->mm->add_bussinesscalldetails($data);
            	
            for($i = 0;$i<count($policy_type);$i++)
            {
                    $data1 =array(
                            "bussiness_id" =>$insert_id,
                            "policy" =>$policy_type[$i],
                            "contactperson" =>$contactperson[$i],
                            "contactemail"=>$contactemail[$i],
                            "contactnumber"=>$contactnumber[$i],
                    );
                    $this->mm->add_bussinesscontactdetails($data1);   
              }
              
            $count = count($_FILES['gallery_image']['name']);
         
            for($i=0;$i<$count;$i++){
            
              if(!empty($_FILES['gallery_image']['name'][$i]))
              {
                    $_FILES['file']['name'] = $_FILES['gallery_image']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['gallery_image']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['gallery_image']['tmp_name'][$i];
                    $_FILES['file']['size'] = $_FILES['gallery_image']['size'][$i];
                    $config['upload_path'] = './datas/business_call_images/'; 
                    $config['allowed_types'] = '*';
                    $config['file_name'] = $_FILES['gallery_image']['name'][$i];
                    
                    $this->load->library('upload',$config); 
                    
                    if($this->upload->do_upload('file'))
                    {
                        $uploadData = $this->upload->data();
                        $filename = $uploadData['file_name'];
                        $data0 = array("business_id" =>$insert_id,"file" =>$filename,"file_type" =>$file_type[$i]);
                        $res0 = $this->mm->add_business_call_images($data0);
                    }
               }
            }
            
    	echo "<script>alert('Business Contact Details Saved Successfully');window.location.href='jointcall'</script>";
    	}
	}
	
    public function delete_joinecall()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
			$id = $this->input->post("id");
			$res_1 = $this->mm->delete_joinecall($id);
			$res_2 =$this->mm->delete_old_log($id);
    	}
	}

	public function fetch_view_joinecall()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$bussiness_id = $this->input->post("id");
			$res = $this->mm->fetch_view_joinecall($bussiness_id);
			$res_1 = $this->mm->fetch_business_client_details($bussiness_id);
			$res2 = $this->mm->fetch_business_images($bussiness_id);
			
			
			 
             if($res_1->activice == "dealers")
             {
               $name = $res_1->dealer_name." (Dealers)";
             }
             else if($res_1->activice == "Agent")
             {
                 $name = $res_1->agn_name." (Agent)";
             }
             else 
             {
                 $name = $res_1->insurer." (Client)";
             }

			$content = "<table class='table table-bordered'>
	
			<tr>
    			<td class='bg-success'>Insurer Name</td> 
    			<td class='bg-success'>".$name." (".$res_1->region.")</td>
			</tr>
			
			<tr>
    			<td class='bg-success'>Address</td> 
    			<td class='bg-success'>".$res_1->address."</td>
			</tr>
			
			<tr>
    			<td class='bg-success'>Regn no</td> 
    			<td class='bg-success'>".$res_1->regn_no."</td>
			</tr>
			
			<tr>
    			<td class='bg-success'>Remark</td> 
    			<td class='bg-success'>".$res_1->remark."</td>
			</tr>
			
			<tr>
    			<td class='bg-success'>Date</td> 
    			<td class='bg-success'>".date_format(date_create($res_1->date),"d-m-Y h:i:s a")."</td>
			</tr>
			</table>";
			
			 
			foreach($res as $da)
			{
			   $p_type = $this->mm->fetch_class($da->policy);
			    
			    if($p_type == "")
			    {
			        $policy_type = "";
			    }
			    else
			    {
			         $policy_type = $p_type->class;
			    }

                $content .= "<table class = 'table table-bordered'>
                    <tr>
                        <td>Policy Type</td>
                        <td>".$policy_type."</td>
                    </tr>
                    <tr>
                        <td>Contact Person</td>
                        <td>".$da->contactperson."</td>
                    </tr>
                    <tr>
                        <td>Position</td>
                        <td>".$da->contactemail."</td>
                    </tr>
                    <tr>
                        <td>Contact Number</td>
                        <td>".$da->contactnumber."</td>
                    </tr>
                </table>";
			}
			
		    $content .= "<div class='row'><h4>&nbsp;Files</h4>";
		    
			foreach($res2 as $da)
			{
                $content .= "<div class='col-md-3'>
                          <a href='./datas/business_call_images/".$da->file."' target='_blank'><i class='fa fa-file fa-3x'></i></a>
                          <span>".$da->file_type."</span>
                 </div>";
			}
			$content .= "</div>";
			echo $content;
		}
	}
	
	public function fetch_edit_joinecall()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_joinecall($id);
			$c_details = $this->mm->fetch_contact_details($id);
			$res2 = $this->mm->fetch_business_images($id);
			
			
			$content = "<div class='row'><h4>&nbsp;&nbsp;Current Files</h4>";
			
			foreach($res2 as $da)
			{
			    $content .= "<div class='col-md-3'>
			                          <a href='./datas/business_call_images/".$da->file."' target='_blank'><i class='fa fa-file fa-3x'></i></a>
			                          <button class='btn btn-danger btn-xs' onclick=delete_file(".$da->id.")>
			                          <i class='fa fa-trash'></i></button> <span>".$da->file_type."</span>
			                 </div>";
			                    
			}
			
			$content .= "</div>";
			
			echo json_encode(array("b_info" =>$res,"c_details"=>$c_details,"files" =>$content));
		}
	}
	
    public function edit_joine_call()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$areaincharge = $this->input->post("edit_areaincharge");
    		$insurer = $this->input->post("edit_insurer");
    		$region = $this->input->post("edit_region");
    		$businesslocation = "0"; //$this->input->post("edit_businesslocation");
    		$location = "0"; //$this->input->post("edit_location");
    		$activice =$this->input->post("edit_activice");
    		$address =$this->input->post("edit_address");
    		$pin =$this->input->post("edit_pin");
    		$policy =$this->input->post("edit_policy");
    		$contactperson =$this->input->post("edit_contactperson");
    		$contactemail =$this->input->post("edit_contactemail");
    		
    		$policy_class = $this->input->post("edit_policy");
    		$contactnumber =$this->input->post("edit_contactnumber");
    		$remark =$this->input->post("edit_remark");
    		$date =$this->input->post("edit_date");
    		
    		$entry_date =$this->input->post("edit_entry_date");
    		$status =$this->input->post("edit_status");
    		$id = $this->input->post("edit_id");
    		
    		$file_type= $this->input->post("edit_file_type");


    		$data = array(
    		               "areaincharge" => $areaincharge,
    		               "insurer" =>$insurer,
    		               "region"=>$region,
    		               "businesslocation"=>$businesslocation,
    		               "location"=>$location,
    		               "activice" =>$activice,
    		               "address" =>$address,
    		               "pin" =>$pin,
    		               "remark"=>$remark,
    		               "date"=>$date,
    		               "entry_date" =>$entry_date,
    		               "status"=>$status
    		               );
    		$res = $this->mm->edit_joine_call($id,$data);
    		
    		$delete = $this->mm->delete_old_log($id);
    		
    		  for($i = 0;$i<count($policy_class);$i++)
              {
                    $data1 =array(
                            "bussiness_id" =>$id,
                            "policy" =>$policy_class[$i],
                            "contactperson" =>$contactperson[$i],
                            "contactemail"=>$contactemail[$i],
                            "contactnumber"=>$contactnumber[$i],
                    );
                    $this->mm->add_bussinesscontactdetails($data1);   
              }

            $count = count($_FILES['edit_gallery_image']['name']);
         
            for($i=0;$i<$count;$i++)
            {
                  if(!empty($_FILES['edit_gallery_image']['name'][$i]))
                  {
                        $_FILES['file']['name'] = $_FILES['edit_gallery_image']['name'][$i];
                        $_FILES['file']['type'] = $_FILES['edit_gallery_image']['type'][$i];
                        $_FILES['file']['tmp_name'] = $_FILES['edit_gallery_image']['tmp_name'][$i];
                        $_FILES['file']['size'] = $_FILES['edit_gallery_image']['size'][$i];
                        $config['upload_path'] = './datas/business_call_images/'; 
                        $config['allowed_types'] = '*';
                        $config['file_name'] = $_FILES['edit_gallery_image']['name'][$i];
                        
                        $this->load->library('upload',$config); 
                        
                        if($this->upload->do_upload('file'))
                        {
                            $uploadData = $this->upload->data();
                            $filename = $uploadData['file_name'];
                            $data0 = array("business_id" =>$id,"file" =>$filename,"file_type" =>$file_type[$i]);
                            $res0 = $this->mm->add_business_call_images($data0);
                        }
                   }
            }
            
    		echo "<script>alert('Business Contact Details Updated Successfully');window.location.href='jointcall'</script>";
    	}
	}
	
	public function _journalvoucher()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
            $data["account_head"] =$this->am->get_account_head_for_general_receipt();
            $data["sub_category"] = $this->am->fetch_sub_category();
            $data["cheque_number"] = $this->am->fetch_cheque_number();
    		$this->load->view('header',$pro_data);
    		$this->load->view('journalvoucher',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user")
	    {
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
                $data["account_head"] =$this->mm->get_account_head_for_general_receipt();
                $data["sub_category"] = $this->mm->fetch_sub_category();
                $data["cheque_number"] = $this->mm->fetch_cheque_number();
        		$this->load->view('header',$pro_data);
        		$this->load->view('journalvoucher',$data);
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
	
	public function _add_journalvoucher()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$acchead = $this->input->post("acchead");
    		$subcategory =$this->input->post("subcategory");
    		$debit =$this->input->post("debit");
    		$credit =$this->input->post("credit");
    		$tdsamount =$this->input->post("tdsamount");
    		$remark =$this->input->post("remark");
    		$advices =$this->input->post("advices");
    		
            $date = date("Y-m-d H:i:s");
            $year = date('y');
            $month = date('m');


    		$data = array("acchead" => $acchead,
    		              "subcategory" =>$subcategory,
    		              "debit"=>$debit,
    		              "credit"=>$credit,
    		              "tds_amount" =>$tdsamount,
    		              "remark"=>$remark,
    		              "advices"=>$advices);
    		$this->mm->add_journalvoucher($data);
    		
    		$acctype = $this->mm->get_paymode_chracctype($subcategory);
    		
    		if($acctype->chracctype == "1")
    	   {	
    		$data2 = array(
                                    "dr_parent_id" =>$acchead,
                                    "debit" =>$amount,
                                    "cr_parent_id" => $another_head,
                                    "note" =>$remark,
                                    "datetime" =>$date);
    	   }
    	   else if($acctype->chracctype == "1")
    	   {
    	       	$data2 = array(
                                    "dr_parent_id" =>$acchead,
                                    "credit" =>$amount,
                                    "cr_parent_id" => $another_head,
                                    "note" =>$remark,
                                    "datetime" =>$date);
    	   }
                                    

    		echo "Success";
    	}
	}
	
	public function bankstatement()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('bankstatement');
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user")
	    {
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
        		$this->load->view('header',$pro_data);
        		$this->load->view('bankstatement');
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
   
   
   // Ai Performance Report
   
   public function ai_performance_report()
   {
       	if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{
    	     $data['permission']=$check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
    	    $pro_data["project_info"] = $this->mm->fetch_project_info();
    	    $data["class"] = $this->mm->fetch_policy_class();
    	    $data["area_incharge"] = $this->mm->fetch_area_incharge();
    		$this->load->view('header',$pro_data);
    		$this->load->view('ai_performace_report',$data);
    		$this->load->view('footer',$pro_data);
    	     
    	}else{
    	    $data['permission']=$check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
	        
	        if($check_user_i->ai_view == "1")
	        {
    	    $pro_data["project_info"] = $this->mm->fetch_project_info();
    	    $data["class"] = $this->mm->fetch_policy_class();
    	    $data["area_incharge"] = $this->mm->fetch_area_incharge();
    		$this->load->view('header',$pro_data);
    		$this->load->view('ai_performace_report',$data);
    		$this->load->view('footer',$pro_data);
	        }
	        else
	        {
	             echo "<script>alert('Permission Denied');window.location.href='home';</script>";
    	          //redirect("home");
	        }
    	}
   }
   
   public function fetch_policy_type_by_class()
   {
       if($this->session->has_userdata('logged_in')) 
       {
           $class = $this->input->post("policy_class");
           
           
           $res = $this->mm->fetch_policy_type_by_class($class);
           
           $content = "<option value = ''>--Select--</option>";
           
           foreach($res as $da)
           {
               $content .= "<option value=".$da->id.">".$da->policy_type."</option>";
           }
           echo $content;
       }
   }
   
   public function fetch_edit_policy_type_by_class()
   {
       if($this->session->has_userdata('logged_in')) 
       {
           $class = $this->input->post("policy_class");
           $policy_type = $this->input->post("policy_type");
           
           $res = $this->mm->fetch_policy_type_by_class($class);
           
           $content = "<option value = ''>--Select--</option>";
           
           foreach($res as $da)
           {
               if($policy_type == $da->id)
               {
                   $content .= "<option value=".$da->id." selected>".$da->policy_type."</option>";
               }
               else
               {
                  $content .= "<option value=".$da->id.">".$da->policy_type."</option>";
               }
           }
           echo $content;
       }
   }
   
   public function fetch_area_incharge_salary()
   {
       if($this->session->has_userdata('logged_in')) 
       {
           $ai = $this->input->post("ai");
           $res = $this->mm->fetch_area_incharge_salary($ai);
           echo json_encode($res);
       }
   }
   
   public function add_ai_performance()
   {
       if($this->session->has_userdata('logged_in')) 
       {
               $ai = $this->input->post("ai");
               $month = $this->input->post("month");
               $policy_class = $this->input->post("policy_class");
               $policy_type = $this->input->post("policy_type");
               $volume_type = $this->input->post("volume_type");
               $ten_days = $this->input->post("ten_days");
               $twenty_days = $this->input->post("twenty_days");
               $thirty_days = $this->input->post("thirty_days");
               $add_id = $this->input->post("add_id");
               $date = $month."-01";
               
               if($add_id != "")
               {
                   $data = array("ai_id" =>$ai,"month" =>$date,"class" =>$policy_class,"policy_type" =>$policy_type,"volume_type" =>$volume_type,"0-10" =>$ten_days,"10-20" =>$twenty_days,"20-30" =>$thirty_days,"created_date" =>date("Y-m-d"),"created_by" =>$this->session->userdata("session_id"));
                   $res = $this->mm->update_ai_performance($data,$add_id);
               }
               else
               {
                   $data = array("ai_id" =>$ai,"month" =>$date,"class" =>$policy_class,"policy_type" =>$policy_type,"volume_type" =>$volume_type,"0-10" =>$ten_days,"10-20" =>$twenty_days,"20-30" =>$thirty_days,"created_date" =>date("Y-m-d"),"created_by" =>$this->session->userdata("session_id"));
                   $res = $this->mm->add_ai_performance($data);
               }
               echo "success";
       }
   }
   
    public function edit_ai_performance()
   {
       if($this->session->has_userdata('logged_in')) 
       {
               $ai = $this->input->post("ai");
               $month = $this->input->post("month");
               $policy_class = $this->input->post("policy_class");
               $policy_type = $this->input->post("policy_type");
               $volume_type = $this->input->post("volume_type");
               $ten_days = $this->input->post("ten_days");
               $twenty_days = $this->input->post("twenty_days");
               $thirty_days = $this->input->post("thirty_days");
               $id = $this->input->post("id");
               $data = array("ai_id" =>$ai,"month" =>$month,"class" =>$policy_class,"policy_type" =>$policy_type,"volume_type" =>$volume_type,"0-10" =>$ten_days,"10-20" =>$twenty_days,"20-30" =>$thirty_days,"created_date" =>date("Y-m-d"),"created_by" =>$this->session->userdata("session_id"));
               $res = $this->mm->update_ai_performance($data,$id);
               echo "success";
       }
   }
   
   public function fetch_ai_performance()
   {
      if($this->session->has_userdata('logged_in')) 
       {
          $draw = intval($this->input->post("draw"));
           	
           $month = $this->input->post("date");
           
           $date = $month."-01";
           
           $res = $this->mm->fetch_ai_performance($date);
           //echo $res;
           
            $arr = [];
            
            $a = 0 ;
            
            foreach($res as $da)
            {
            	$a++;
    
             $action = "<button class='btn btn-warning btn-xs' onclick=view_data(".$da->ai_id.")><i class='fa fa-eye'></i></button>";
                
                $arr[] = array(
                    $a,
                    $da->ai_name,
                    date_format(date_create($da->month),"M-Y"),
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
   
   public function fetch_performance_details()
   {
       if($this->session->has_userdata('logged_in')) 
       {
           $ai_id = $this->input->post("id");
           $date_string = $this->input->post("date");
           $date = $date_string."-01";
           setlocale(LC_MONETARY, 'en_IN');
           
           $ai_details = $this->mm->get_ai_details($ai_id);

           $res = $this->mm->fetch_performance_details($ai_id,$date);
           $res0 = $this->mm->fetch_acheived_active_policy($ai_id,$date);
           $res1 = $this->mm->fetch_acheived_business_complete($ai_id,$date);
           
           $arr_1 = array_merge($res0,$res1);
           $arr_2 = array_merge($arr_1,$res);
           $arr3 = array_unique($arr_2,SORT_REGULAR);
           

           $a = 0;
          
           $content = "";
           
           $content .= "<table class='table table-bordered'>
                            
                            <tr>
                                 <th>Class</th>
                                 <th>Policy_type</th>
                                 <th>Volume_Type</th>
                                 <th>0_10_Days</th>
                                 <th style='color:green;'>0_10_Ac_Policy</th>
                                 <th>11_20_Days</th>
                                 <th style='color:green;'>11_20_Ac_Policy</th>
                                 <th>21_30_Days</th>
                                 <th style='color:green;'>21_30_Ac_Policy</th>
                                 <th style='color:green;'>Total</th>
                                 <th>Action</th>
                            </tr>";
           
           $ai_name = "";
           $phoneno = "";
           
           
           $total_10_amt = 0;
           $total_20_amt = 0;
           $total_30_amt = 0;
           
           $total_10_nop = 0;
           $total_20_nop = 0;
           $total_30_nop = 0;
           
           
           $tendays_target = 0;
           $twentydays_target = 0;
           $thirtydays_target = 0;
           
           foreach($arr3 as $da)
           {
            
                $ai_name = $ai_details->name;
                $phoneno = $ai_details->phoneno;
                
            $data0 = $this->mm->fetch_area_incharge_target($ai_id,$date,$da->policy_type,$da->class);
            
            if($data0 != "")
            {
                if($data0->tendays != "")
                {
                    $tendays_target = $data0->tendays + $tendays_target;
                }
                
                if($data0->twentydays != "")
                {
                    $twentydays_target = $data0->twentydays + $twentydays_target;
                }
                
                if($data0->thirty_days != "")
                {
                    $thirtydays_target = $data0->thirty_days + $thirtydays_target;
                }
            }
     
            //0 -10 days 
            $date_10 = date_format(date_create($date),"Y-m-10");
            $res_1 = $this->mm->fetch_ai_active_policy($ai_id,$date,$date_10,$da->class,$da->policy_type);
            $res_2 = $this->mm->fetch_ai_business_complete($ai_id,$date,$date_10,$da->class,$da->policy_type);
            
            $nop_10 = count($res_1) + count($res_2);
            $total_10_nop  =$nop_10 +$total_10_nop;
            
            $total_1 = 0;
            
            foreach($res_1 as $da1)
            {
              $total_1 =  $da1->total + $total_1;
            }
           
            $total_2 = 0;
            
            foreach($res_2 as $da2)
            {
              $total_2 = $da2->total + $total_2;
            }
            
            $amount_10 =$total_1 + $total_2;
            $total_10_amt = $amount_10 + $total_10_amt;
           
            //0-20 days
            $date_11 = date_format(date_create($date),"Y-m-11");
            $date_20 = date_format(date_create($date),"Y-m-20");
            
            $res_3 = $this->mm->fetch_ai_active_policy($ai_id,$date_11,$date_20,$da->class,$da->policy_type);
            $res_4 = $this->mm->fetch_ai_business_complete($ai_id,$date_11,$date_20,$da->class,$da->policy_type);
            $nop_20 = count($res_3) + count($res_4);
            $total_20_nop  =$nop_20 +$total_20_nop;
            $total_3 = 0;
            
            foreach($res_3 as $da3)
            {
              $total_3 =  $da3->total + $total_3;
            }
           
            $total_4 = 0;
            foreach($res_4 as $da4)
            {
               $total_4 = $da4->total + $total_4;
            }
            $amount_20 = $total_3 + $total_4;
            $total_20_amt = $amount_20 + $total_20_amt;
            
           
           //0-30 days
           $date_21 = date_format(date_create($date),"Y-m-21");
           $end_date = date_format(date_create($date),"Y-m-t");
           $res_5 = $this->mm->fetch_ai_active_policy($ai_id,$date_21,$end_date,$da->class,$da->policy_type);
           $res_6 = $this->mm->fetch_ai_business_complete($ai_id,$date_21,$end_date,$da->class,$da->policy_type);
           $nop_30 = count($res_5) + count($res_6);
           $total_30_nop  =$nop_30 +$total_30_nop;
           
           $total_5 = 0;
           foreach($res_5 as $da5)
           {
             $total_5 =  $da5->total + $total_5;
           }
           
           $total_6 = 0;
           
           foreach($res_6 as $da6)
           {
              $total_6 = $da6->total + $total_6;
           }
           
           $amount_30 = $total_5 + $total_6;
           $total_30_amt = $amount_30 + $total_30_amt;
           
           $class = $this->mm->get_class_name($da->class);
           $p_type = $this->mm->get_policy_type($da->policy_type);
          
                               
               if($data0 != "")
               {
                     $content .= "<tr>
                               <td>".$class->class."</td>
                               <td>".$p_type->policy_type."</td>
                               <td>".$data0->volume_type."</td>";
                    if($data0->volume_type == "Amount")
                    {
                         $content .="<td>".money_format('%!i', $data0->tendays)."</td>
                                    <td style='color:green;'> ".money_format('%!i', $amount_10)."</td>
                                    <td>".money_format('%!i', $data0->twentydays)."</td>
                                    <td style='color:green;'>".money_format('%!i', $amount_20)."</td>
                                    <td>".money_format('%!i', $data0->thirty_days)." </td>
                                    <td style='color:green;'>".money_format('%!i', $amount_30)."</td>";
                             $tot = $amount_10 + $amount_20 + $amount_30;
                             
                             $content .=" <td style='color:green;'>".money_format('%!i', $tot)."</td>";
                             
                              $content .=" <td><button onclick=edit_data(".$data0->id.") class='btn btn-info btn-xs'><i class='fa fa-pencil-square-o'></i></button></td>";
                    }
                    else 
                    {
                          $content .="<td>".$data0->tendays."</td>
                                    <td style='color:green;'>".$nop_10."</td>
                                    <td>".$data0->twentydays." </td>
                                    <td style='color:green;'>".$nop_20."</td>
                                    <td>".$data0->thirty_days."</td>
                                    <td style='color:green;'>".$nop_30."</td>";  
                            $tot = $nop_10 + $nop_20 + $nop_30;
                            $content .=" <td style='color:green;'>".money_format('%!i', $tot)."</td>";
                    }
                    $content .=" </tr>";
               }
               else
               {
                     $content .= "<tr>
                               <td>".$class->class."</td>
                               <td>".$p_type->policy_type."</td>
                               <td></td>";
                               
                    $content .="<td>".money_format('%!i', 0)."</td>
                                    <td style='color:green;'> ".money_format('%!i', $amount_10)."</td>
                                    <td>".money_format('%!i', 0)."</td>
                                    <td style='color:green;'>".money_format('%!i', $amount_20)."</td>
                                    <td>".money_format('%!i', 0)." </td>
                                    <td style='color:green;'>".money_format('%!i', $amount_30)."</td>";
                             $tot = $amount_10 + $amount_20 + $amount_30;
                             $content .=" <td style='color:green;'>".money_format('%!i', $tot)."</td>";
                             $content .=" <td style='color:green;'></td>";
               }
           }
           $content .= "</table>";
           
           $content .= "<table class='table table-bordered'>
                   <tr>
                        <th colspan = '2' class='text-center'>0-10</th>
                        <th colspan = '2' class='text-center'>11-20</th>
                        <th colspan = '2' class='text-center'>21-30</th>
                   </tr>
                   
                    <tr>
                        <th>Target</th>
                        <th>Acheived</th>
                        <th>Target</th>
                        <th>Acheived</th>
                        <th>Target</th>
                        <th>Acheived</th>
                   </tr>
               <tbody>
                    
                 <tr>
                    <td>".money_format('%!i',$tendays_target)."</td>
                    <td>".money_format('%!i',$total_10_amt)."</td>
                    <td>".$twentydays_target."</td>
                    <td>".money_format('%!i',$total_20_amt)."</td>
                    <td>".$thirtydays_target."</td>
                    <td>".money_format('%!i',$total_30_amt)."</td>
                </tr>";
            $content .= " </tbody>";
            $content .= "</table>";
            
            $total = $total_10_amt + $total_20_amt + $total_30_amt;
            $total_nop = $nop_10 + $nop_20 + $nop_30;
            $total_target = $tendays_target + $twentydays_target + $thirtydays_target;
            
            $start_date = date_format(date_create($date),"Y-m-01");
           $end_date = date_format(date_create($date),"Y-m-t");
           
           $result_1 = $this->mm->fetch_ai_active_policy($ai_id,$start_date,$end_date,"","");
           $result_2 = $this->mm->fetch_ai_business_complete($ai_id,$start_date,$end_date,"","");
           
           $total_0 = 0;
           $total_1 = 0;
           
            foreach($result_1 as $da1)
            {
                 $total_0 = $da1->total + $total_0;
            }
            foreach($result_2 as $da2)
            {
                 $total_1 = $da2->total + $total_1;
            }
            
            $tot_amount = $total_0 + $total_1;
      
            $content .= "<p>Total Target : ".$total_target." </p>";
            $content .= "<p>Total Achieved Amount : ".money_format('%!i',$tot_amount)." </p>";
           
            echo json_encode(array("con" =>$content,"date" =>$date_string,"name" =>$ai_name,"phone"=>$phoneno));
       }
   }
   
    public function delete_files()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
			$id = $this->input->post("id");
			$res = $this->mm->get_files($id);
			unlink("./datas/business_call_images/".$res->file);
			$res_1 = $this->mm->delete_business_call_images($id);
    	}
	}
	
	public function export_excel_business_calls()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
            $region = $this->input->post("region");
            $fromdate =$this->input->post("fromdate");
            $todate = $this->input->post("todate");
            $mobile_no = $this->input->post("mobile_no");
            $insurer = $this->input->post("insurer");
            $areaincharge =$this->input->post("areaincharge");
         
    	   
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
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Insurer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Area Incharge');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Region');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'location');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Activity');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Address');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Pin code');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Remarks');
        
        $row_count = 5;
        $a = 0;
            
        $res = $this->mm->get_business_calls_records($region,$fromdate,$todate,$mobile_no,$insurer,$areaincharge);
           
                                
            $a = 0;
            
            $gst = 0;
            $agn_com = 0;
            $own_com = 0;
            
            $add_own_com = 0;
            $add_agn_com = 0;
            
            foreach($res as $da)
            {
                $res0 = $this->mm->get_contact_details($da->id,$mobile_no);
                
                $a++;
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->insurer);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->cname);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->region);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , $da->location);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $da->activice);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->address);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $da->pin);
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , $da->remark);
                
                $x = "J";
                
                $i =0;
                
                foreach($res0 as $das)
                {
                    $i++;
                    $objPHPExcel->getActiveSheet()->SetCellValue($x.'4', 'Policy Class'.$i);
                    $objPHPExcel->getActiveSheet()->SetCellValue($x.$row_count , $das->policy_class);
                    $x++;
                    $objPHPExcel->getActiveSheet()->SetCellValue($x.'4', 'Contact Name / Position'.$i);
                    $objPHPExcel->getActiveSheet()->SetCellValue($x.$row_count , $das->contactperson);
                    $x++;
                    $objPHPExcel->getActiveSheet()->SetCellValue($x.'4', 'Contact Email'.$i);
                    $objPHPExcel->getActiveSheet()->SetCellValue($x.$row_count , $das->contactemail);
                    $x++;
                    $objPHPExcel->getActiveSheet()->SetCellValue($x.'4', 'Mobile No'.$i);
                    $objPHPExcel->getActiveSheet()->SetCellValue($x.$row_count , $das->contactnumber);
                    $x++;
                }
                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
            }
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                $objWriter->save('./datas/reports/business_call_report.xlsx');
                echo base_url()."/datas/reports/business_call_report.xlsx";
    
    	}
	}
	
	public function fetch_performance_records()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $policy_type = $this->input->post("policy_type");
            $class_type = $this->input->post("class_type");
            $area_incharge = $this->input->post("area_incharge");
            $date = $this->input->post("month");
            $date_string = $date."-01";
            $res = $this->mm->fetch_performance_records($policy_type,$class_type,$area_incharge,$date_string);
            echo json_encode($res);
    	}
	}
	
	public function fetch_edit_performance()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $id = $this->input->post("id");
            $res = $this->mm->fetch_edit_performance($id);
            echo json_encode($res);
    	}
	}
	
	
	
	
	public function fetch_insurer_details()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $insurer = $this->input->post("insurer");
    	    
    	    $res = $this->mm->get_insurer_details_business_call($insurer);
    	    
    	    echo json_encode($res);
    	}
	}
	
	
	public function add_leave_permission()
	{
       if($this->session->has_userdata('logged_in')) 
       {
               $leaveai = $this->input->post("leaveai");
               $leavepermission = $this->input->post("leavepermission");
               $leavefrom_date = $this->input->post("leavefrom_date");
               $leaveto_date = $this->input->post("leaveto_date");
               
               
            $data = array("leaveai" => $leaveai,
                         "leavepermission" => $leavepermission,
                         "leavefrom_date"=>$leavefrom_date,
                         "leaveto_date"=>$leaveto_date);
    		$this->mm->add_leave_permission($data);

     	}
     	
	 }
	 
    public function fetch_leavepermission()
    {
        if($this->session->has_userdata('logged_in')) 
        {
            
        $draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_leavepermission();
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;
        	
        	  $action = '<div class="btn-group">
                   <button type="button" class="btn btn-success">Action</button>
                   <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown">
                    <span class="caret"></span>
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
                <ul class="dropdown-menu" role="menu">
                    <li><a class="dropdown-item" onclick=report('.$da->leaveai.')>Report</a></li>
                </ul>
              </div>';
              
            $arr[] = array(
                $a,
                $da->ai_name,
                $da->leavepermission,
                date_format(date_create($da->leavefrom_date),"d-m-Y h:i:s: a"),
                date_format(date_create($da->leaveto_date),"d-m-Y h:i:s: a"),
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
  
  public function fetch_exiting_clients()
  {
       if($this->session->has_userdata('logged_in')) 
       {
           $res = $this->mm->fetch_exiting_clients();
           $option = "<option>--Select--</option>";
           foreach($res as $da)
           {
               $option .= "<option value=".$da->id.">".$da->insurer." - ".$da->businesslocation."</option>";
           }
           echo $option;
       }
  }
  
 
  public function add_ex_business()
  {
      	if($this->session->has_userdata('logged_in')) 
    	{
            $insurer_id = $this->input->post("ex_insurance");
            $res = $this->mm->get_business_details($insurer_id);
            
            $areaincharge = $this->input->post("ex_areaincharge");
            $insurer = $res->insurer;
            $region = $res->region;
            $activice = $res->location;
            $address = $res->address;
            $pin =  $res->pin;
    		
    		$policy_type = $this->input->post("ex_policy");
    		$contactperson   = $this->input->post("ex_contactperson");
    		$contactemail = $this->input->post("ex_contactemail");
    		$contactnumber   = $this->input->post("ex_contactnumber");
    		$remark =$this->input->post("ex_remark");
    		$date =$this->input->post("ex_followup_date");
    		$entry_date = $this->input->post("ex_entry_date");
    		$status =$this->input->post("ex_status");
    		$file_type =$this->input->post("ex_file_type");
    		
            $data = array(  
                    "insurer" =>$insurer,
                    "region"=>$region,
                    "areaincharge" =>$areaincharge,
                    "activice" =>$activice,
                    "address" =>$address,
                    "pin" =>$pin,
                    "remark"=>$remark,
                    "entry_date" =>$entry_date,
                    "created_by" =>$this->session->userdata("session_id"),
                    "created_date" =>date("Y-m-d"),
               );
            	               
            $insert_id = $this->mm->add_bussinesscalldetails($data);
            	
            for($i = 0;$i<count($policy_type);$i++)
            {
                    $data1 =array(
                            "bussiness_id" =>$insert_id,
                            "policy" =>$policy_type[$i],
                            "contactperson" =>$contactperson[$i],
                            "contactemail"=>$contactemail[$i],
                            "contactnumber"=>$contactnumber[$i],
                    );
                    $this->mm->add_bussinesscontactdetails($data1);   
              }
              
            $count = count($_FILES['ex_gallery_image']['name']);
         
            for($i=0;$i<$count;$i++)
            {
              if(!empty($_FILES['ex_gallery_image']['name'][$i]))
              {
                    $_FILES['file']['name'] = $_FILES['ex_gallery_image']['name'][$i];
                    $_FILES['file']['type'] = $_FILES['ex_gallery_image']['type'][$i];
                    $_FILES['file']['tmp_name'] = $_FILES['ex_gallery_image']['tmp_name'][$i];
                    $_FILES['file']['size'] = $_FILES['ex_gallery_image']['size'][$i];
                    $config['upload_path'] = './datas/business_call_images/'; 
                    $config['allowed_types'] = '*';
                    $config['file_name'] = $_FILES['ex_gallery_image']['name'][$i];
                    
                    $this->load->library('upload',$config); 
                    
                    if($this->upload->do_upload('file'))
                    {
                        $uploadData = $this->upload->data();
                        $filename = $uploadData['file_name'];
                        $data0 = array("business_id" =>$insert_id,"file" =>$filename,"file_type" =>$file_type[$i]);
                        $res0 = $this->mm->add_business_call_images($data0);
                    }
               }
            }
            
    		echo "<script>alert('Business Contact Details Saved Successfully');window.location.href='jointcall'</script>";
    	}
  }
  
  public function fetch_ai_daily_report()
  {
      	if($this->session->has_userdata('logged_in')) 
    	{
    	    $ai = $this->input->post("ai");
    	    $start_date = $this->input->post("f_date");
    	    $end_date = $this->input->post("to_date");
    	   
    	  if($start_date == "" && $end_date == "")
    	  {
    	    $start_date = date("Y-m-01");
    	    $end_date = date("Y-m-d");
    	  }
    	    
    	    $content = "<table class='table table-bordered'>
    	                 
    	                 <tr>
    	                       <th>S.no</th>
    	                       <th>Date</th>
    	                       <th>Activity</th>
    	                       <th>Remarks</th>
    	                 <tr>";
    	    
    	    $a = 0;
    	    
            while(strtotime($start_date) <= strtotime($end_date)) 
            {
                $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date,$ai)));
                
                $res = $this->mm->fetch_ai_daily_report($ai,$start_date);
                $res_1 = $this->mm->fetch_ai_leave($ai,$start_date);
                
                foreach($res as $da)
                {
                     $a++;
                    $content .= "<tr>
                                      <td>".$a."</td>
                                      <td>".date_format(date_create($start_date),"d-m-Y")."</td>
                                      <td>".$da->insurer."- ".$da->region."</br>".$da->address."</td>
                                      <td>".$da->remark."</td>
                                 </tr>";
                }
                
                foreach($res_1 as $da)
                {
                     $a++;
                    $content .= "<tr>
                                      <td>".$a."</td>
                                      <td>".date_format(date_create($start_date),"d-m-Y")."</td>
                                      <td>".$da->leavepermission." (".date_format(date_create($da->leavefrom_date),"d-m-Y h:i:s a")." - ".date_format(date_create($da->leaveto_date),"d-m-Y h:i:s a").")</td>
                                      <td>".$da->remarks."</td>
                                 </tr>";
                }
            }
            
            $content .="</table>";
            
            echo $content;
    	}
  }
  
      public function ai_daily_report_excel()
      {
          	if($this->session->has_userdata('logged_in')) 
        	{
                $this->load->library('Excel');
                
                $ai = $this->input->post("ai");
                $start_date = $this->input->post("f_date");
                $end_date = $this->input->post("to_date");
                
                if($start_date == "" && $end_date == "")
                {
                    $start_date = date("Y-m-01");
                    $end_date = date("Y-m-d");
                }
        	    
            	$objPHPExcel = new PHPExcel();
                $objPHPExcel->setActiveSheetIndex(0);
                $rowCount = 4;
                $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
                $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(35);
                $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(35);
                $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(35);
                $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(35);
                $objPHPExcel->getActiveSheet()->getRowDimension('2')->setRowHeight(20);
                $objPHPExcel->getActiveSheet()->SetCellValue('D2', 'Area Incharge Daily Report');
                
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
                $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Date');
                $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Activity');
                $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Remarks');
    
                $row_count = 5;
                $a = 0;
        	    
                while(strtotime($start_date) <= strtotime($end_date)) 
                {
                    $start_date = date ("Y-m-d", strtotime("+1 days", strtotime($start_date,$ai)));
                    
                    $res = $this->mm->fetch_ai_daily_report($ai,$start_date);
                    $res_1 = $this->mm->fetch_ai_leave($ai,$start_date);
                 
                    foreach($res as $da)
                    {
                        $a++;
                        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , date_format(date_create($start_date),"d-m-Y"));
                        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->insurer."- ".$da->region."-".$da->address);
                        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->remark);
                        $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                         $row_count++;
                    }
                    
                    foreach($res_1 as $da)
                    {
                        $a++;
                        $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                        $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , date_format(date_create($start_date),"d-m-Y"));
                        $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->leavepermission."(".date_format(date_create($da->leavefrom_date),"d-m-Y h:i:s a")." - ".date_format(date_create($da->leaveto_date),"d-m-Y h:i:s a").")");
                        $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->remark);
                        $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                        $row_count++;
                    }
                }
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                $objWriter->save('./datas/reports/ai_daily_report.xlsx');
                echo base_url()."/datas/reports/ai_daily_report.xlsx";
          }
      }
      
      public function add_dealer_followup()
      {
          	if($this->session->has_userdata('logged_in')) 
        	{
            	$d_region = $this->input->post("d_region");
                $areaincharge = $this->input->post("d_area_incharge");
                $dealers_date = $this->input->post("dealers_date");
                $dealers_name = $this->input->post("dealers_name");
                $d_remark = $this->input->post("d_remark");
                
                $data = array(    "region" =>$d_region,
                                  "activice" =>"dealers",
                                  "entry_date" =>$dealers_date,
                                  "areaincharge" =>$areaincharge,
                                  "insurer" =>$dealers_name,
                                  "remark" =>$d_remark,
                    );
               
               $res = $this->mm->add_bussinesscalldetails($data);
               
               echo "<script>alert('Business Contact Details Saved Successfully');window.location.href='jointcall';</script>";
           
        	}
      }
      
      public function create_insurance_company_ledger($res)
      {
          	if($this->session->has_userdata('logged_in')) 
        	{
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
                $res = $this->am->add_sub_ledger($data);
                if( $res ) {
    	            $this->audit->log('account_tree', 'INSERT', null, null, $data);
    	        }
                $res0 = $this->am->add_sub_ledger_orc($data);
                if( $res0 ) {
    	            $this->audit->log('account_tree_orc', 'INSERT', null, null, $data);
    	        }
        	}
      }
      
      public function fetch_agents()
      {
          	if($this->session->has_userdata('logged_in')) 
        	{
        	    $ai = $this->input->post("ai");
        	    $res = $this->mm->fetch_agents($ai);
        	    $content = "<option value=''>--Select Agent--</option>";
        	    foreach($res as $da)
        	    {
        	        $content .= "<option value=".$da->id.">".$da->name."</option>";
        	    }
        	    echo $content;
        	}
      }
      
      public function add_agn_business()
      {
          	if($this->session->has_userdata('logged_in')) 
        	{
            	$ag_region = $this->input->post("ag_region");
                $areaincharge = $this->input->post("ag_areaincharge");
                $ag_entry_date = $this->input->post("ag_entry_date");
                $ag_agent = $this->input->post("ag_agent");
                $d_remark = $this->input->post("ex_remark");
                
                $data = array(    "region" =>$ag_region,
                                  "activice" =>"Agent",
                                  "entry_date" =>$ag_entry_date,
                                  "areaincharge" =>$areaincharge,
                                  "insurer" =>$ag_agent,
                                  "remark" =>$d_remark,
                    );
               
               $res = $this->mm->add_bussinesscalldetails($data);
               
               echo "<script>alert('Business Contact Details Saved Successfully');window.location.href='jointcall';</script>";
           
        	}
      }
     
     
     // Ambulance Brand
     
    public function ambulance_brand()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('Ambulance_brand');
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	    	$pro_data["project_info"] = $this->mm->fetch_project_info();
	    	
	    	 $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	    	 
	        if($check_user_i->masters_view == "1")
	        {
        		$this->load->view('header',$pro_data);
        		$this->load->view('Ambulance_brand');
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

	public function fetch_ambulance_brand()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_ambulance_brand();
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

	public function add_ambulance_brand()
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
    		$this->mm->add_ambulance_brand($data);

    		echo "Success";
    	}
	}

	public function fetch_edit_ambulance_brand()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_ambulance_brand($id);
			echo json_encode($res);
		}
	}

	public function edit_ambulance_brand()
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
                    $old_file_name = $this->mm->fetch_edit_ambulance_brand($id)->icon_name;
                    unlink("./datas/images/brand_icons/".$old_file_name);
                	$data = array("brand_name" => $name,
    		            "icon" => $file_path,
    		            "icon_name" => $file,
    		            "updated_by" => $this->session->userdata("session_id"),
    		            "updated_at" => date("Y-m-d H:i:s"));
    		        $this->mm->edit_ambulance_brand($id, $data);
            }
            else
            {
                	$data = array("brand_name" => $name,
    		            "updated_by" => $this->session->userdata("session_id"),
    		            "updated_at" => date("Y-m-d H:i:s"));
    		        $this->mm->edit_ambulance_brand($id, $data);
            }
    	

    		echo "Success";
    	}
	}

	// 	public function delete_ambulance_brand()
// 	{
// 		if($this->session->has_userdata('logged_in')) 
//     	{
// 			$id = $this->input->post("id");
// 			$this->mm->delete_ambulance_brand($id);
//     	}
// 	}



//Ambulance_Model

    public function ambulance_model()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->mm->fetch_ambulance_brand();
		   	$data["model"] = $this->mm->fetch_ambulance_model();
    		$this->load->view('header',$pro_data);
    		$this->load->view('ambulance_model',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        
	     $pro_data["project_info"] = $this->mm->fetch_project_info();
	     $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	     
	        if($check_user_i->masters_view == "1")
	        {
		   	$data["brand"] = $this->mm->fetch_ambulance_brand();
    		$this->load->view('header',$pro_data);
    		$this->load->view('ambulance_model',$data);
    		$this->load->view('footer',$pro_data);
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
	    }
	}

	public function fetch_ambulance_model()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_ambulance_model();
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

   
	public function add_ambulance_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	     
    	   if($check_user_i->masters_add == "1")
	        {
            		$name = $this->input->post("name");
                    $brand = $this->input->post("brand");
            		$data = array("model_name" => $name,
            		              "brand_id" => $brand,
            		              "created_by" => $this->session->userdata("session_id"),
            		            "created_at" => date("Y-m-d H:i:s"));
            		$this->mm->add_ambulance_model($data);
            		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='ambulance_model';</script>";
	        }
    	}
	}

	public function fetch_edit_ambulance_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_ambulance_model($id);
			echo json_encode($res);
		}
	}

	public function edit_ambulance_model()
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
        		$this->mm->edit_ambulance_model($id, $data);
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='ambulance_model';</script>";
	        }
    	}
	}

	public function delete_ambulance_model()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	   if($check_user_i->masters_delete == "1")
	        {
    			$id = $this->input->post("id");
    			$this->mm->delete_ambulance_model($id);
	        }
    	}
    	else
    	{
    	    echo "<script>alert('Permission Denied');window.location.href='home';</script>";
    	}
	}
	
	public function get_ambulance_logo()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
	    $brand = $this->input->post("brand");
	    echo $this->mm->fetch_edit_ambulance_brand($brand)->icon;
    	}
	}
	
	

//Ambulance_Fuel Type
	
	public function ambulance_fuel_type()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		//$this->load->view('sidebar',$pro_data);
    		$this->load->view('ambulance_fuel_type');
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		//$this->load->view('sidebar',$pro_data);
    		$this->load->view('ambulance_fuel_type');
    		$this->load->view('footer',$pro_data);
	    }
	    else
	    {
	    	redirect("login");
	    }
	}

	public function fetch_ambulance_fuel_type()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_ambulance_fuel_type();
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
                $action .= "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Edit</button> ";
    	        }
            		// <button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> Delete</button>";
            
            $arr[] = array(
                $a,
                $da->fuel_type,
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

	public function add_ambulance_fuel_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	  
    	   if($check_user_i->masters_add == "1")
    	   {
        		$name = $this->input->post("name");
        		$data = array("fuel_type" => $name);
        		$this->mm->add_ambulance_fuel_type($data);
    		    echo "Success";
    	   }
    	   else
    	   {
    	       echo "<script>alert('Permission Denied');window.location.href='ambulance_fuel_type';</script>";
    	   }
    	}
	}

	public function fetch_edit_ambulance_fuel_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_ambulance_fuel_type($id);
			echo json_encode($res);
		}
	}

	public function edit_ambulance_fuel_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	  $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	  
    	  if($check_user_i->masters_edit == "1")
    	   {
        		$name = $this->input->post("name");
        		$id = $this->input->post("id");
        		$data = array("fuel_type" => $name);
        		$this->mm->edit_ambulance_fuel_type($id, $data);
        		echo "Success";
    	   }
    	   else
    	   {
    	      echo "<script>alert('Permission Denied');window.location.href='home';</script>"; 
    	   }
    	}
	}

	public function delete_ambulance_fuel_type()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	  
    	  if($check_user_i->masters_delete == "1")
    	   {
    			$id = $this->input->post("id");
    			$this->mm->delete_ambulance_fuel_type($id);
    	   }
    	}
	}



//Ambulance_Varient

	public function ambulance_varient()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["brand"] = $this->mm->fetch_ambulance_brand();
		   	$data["fuel"] = $this->mm->fetch_ambulance_fuel_type();
		   	$data["model"] =$this->mm->fetch_ambulance_model();
    		$this->load->view('header',$pro_data);
    		$this->load->view('ambulance_varient',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        
	    	$pro_data["project_info"] = $this->mm->fetch_project_info();
	    	$check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	    	
	        if($check_user_i->masters_view == "1")
	        {
    		   	$data["brand"] = $this->mm->fetch_ambulance_brand();
    		   	$data["fuel"] = $this->mm->fetch_ambulance_fuel_type();
    		   	$data["model"] =$this->mm->fetch_ambulance_model();
        		$this->load->view('header',$pro_data);
        		$this->load->view('ambulance_varient',$data);
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

	public function fetch_ambulance_varient()
	{
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->mm->fetch_ambulance_varient();
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
                $da->fuel_type,
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

	public function add_ambulance_varient()
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
                $fuel_type = $this->input->post("fuel");
        		$data = array("varient_name" => $name,
        		              "brand_id" => $brand,
        		              "model_id" => $model,
        		              "fuel_id" => $fuel_type,
        		              "created_by" => $this->session->userdata("session_id"),
        		              "created_at" => date("Y-m-d H:i:s"));
        		$this->mm->add_ambulance_varient($data);
            foreach($name1 as $n)
            {
                $data = array("varient_name" => $n,
    		              "brand_id" => $brand,
    		              "model_id" => $model,
    		              "fuel_id" => $fuel_type,
    		              "created_by" => $this->session->userdata("session_id"),
    		            "created_at" => date("Y-m-d H:i:s"));
    		$this->mm->add_ambulance_varient($data);
            }
    		echo "Success";
    	}
    	else
    	{
    	   echo "<script>alert('Permission Denied');window.location.href='home';</script>"; 
    	}
      }
	}

	public function fetch_edit_ambulance_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->mm->fetch_edit_ambulance_varient($id);
			$model_option = $this->get_ambulance_model_list_option($res->brand_id);
			$icon = $this->mm->fetch_edit_ambulance_brand($res->brand_id)->icon;
			$data = array("res" =>$res, "model_option" => $model_option, "icon" => $icon);
			echo json_encode($data);
		}
	}

	public function edit_ambulance_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	     $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	     
	        if($check_user_i->masters_edit == "1")
	        {
        		$name = $this->input->post("name");
        		$brand = $this->input->post("brand");
        		$model = $this->input->post("model");
        		$fuel = $this->input->post("fuel");
        		$id = $this->input->post("id");
    
        		$data = array("varient_name" => $name,
        		                "brand_id" => $brand,
        		                "model_id" => $model,
        		              "fuel_id" => $fuel,
        		                "updated_by" => $this->session->userdata("session_id"),
        		                "updated_at" => date("Y-m-d H:i:s"));
        		$this->mm->edit_ambulance_varient($id,$data);
    
        		echo "Success";
	        }
	        else
	        {
	            echo "<script>alert('Permission Denied');window.location.href='home';</script>";
	        }
    	}
	}

	public function delete_ambulance_varient()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    	    
    	   $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
    	     
	        if($check_user_i->masters_edit == "1")
	        {
    			$id = $this->input->post("id");
    			$this->mm->delete_ambulance_model($id);
	        }
    	}
	}
	
	
	public function get_ambulance_model_list()
	{
	    $brand = $this->input->post("brand");
	    $res = $this->mm->get_ambulance_model_list($brand);
	    $data = "<option value=''>Select Model</option>";
	    foreach($res as $r)
	    {
	        $data.= "<option value='".$r->id."'>".$r->model_name."</option>";
	    }
	    echo $data;
	}
	public function get_ambulance_model_list_option($brand)
	{
	    $res = $this->mm->get_ambulance_model_list($brand);
	    $data = "<option value=''>Select Model</option>";
	    foreach($res as $r)
	    {
	        $data.= "<option value='".$r->id."'>".$r->model_name."</option>";
	    }
	    return $data;
	}
	
	
	  public function existing_insurance_com_ledger()
      {
          	if($this->session->has_userdata('logged_in')) 
        	{
        	    $data = $this->mm->get_all_insurance_company_info();

            	  foreach($data as $da)
            	  {
            	           $acc_id = $this->am->get_last_acc_id();
                            $last_id = $acc_id->accid+1;
                            $vcharid = "acc".$last_id;
                            
                            $res0 = $this->mm->check_insurance_com_ledger_exits($da->id);
                            
                            if($res0 < 1)
                            {
                                $data = array(
                                   "accid" => $acc_id->accid+1,
                                   "vchaccid" =>$vcharid,
                                   "vch" =>"acc",
                                   "vchaccname" =>$da->company_name,
                                   "vchparentid" =>"acc21",
                                   "parentid" => "21",
                                   "chracctype" =>"1",
                                   "insurer_id" =>$da->id,
                                   "cr_dr_status" =>"1",
                                );
                                $res = $this->am->add_sub_ledger($data);
                                $res0 = $this->am->add_sub_ledger_orc($data);
                            }
            	  }
            	  
            	  echo "success";
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
                  
            $res = $this->mm->add_dealer_details($data);
            
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
                  $res1 = $this->mm->add_dealer_contact_info($data1);
            }
            
            $data = array(  
                    "insurer" =>$res,
                    "region"=>$regions,
                    "areaincharge" =>$this->session->userdata("session_id"),
                    "address" =>$address,
                    "remark"=>$remark,
                    "activice" =>"dealers",
                    "entry_date" =>date("Y-m-d H:i:s"),
                    "created_by" =>$this->session->userdata("session_id"),
                    "created_date" =>date("Y-m-d"),
               );
            	               
            $insert_id = $this->mm->add_bussinesscalldetails($data);
            	
            for($i = 0;$i<count($contact_person);$i++)
            {
                    $data1 =array(
                            "bussiness_id" =>$insert_id,
                            "policy" =>$p_type[$i],
                            "contactperson" =>$contact_person[$i],
                            "contactemail"=>$contact_email[$i],
                            "contactnumber"=>$add_contact_no[$i],
                    );
                    $this->mm->add_bussinesscontactdetails($data1);   
              }
            
            echo "success";
    	}
	}
	
	public function fetch_particulars_by_account_head()
    {
       if($this->session->has_userdata('logged_in')) 
            {
            $account_head = $this->input->post("account_head");
            
            $res = $this->am->get_particulars_by_account_head($account_head);
            
            $content = "<option value = ''>--Select--</option>";
                  
                  foreach($res as $da)
                  {
                      $content .="<option value=".$da->vchaccid.">".$da->vchaccname."</option>";
                  }
                  
                  echo $content;
            }
     
    }
    
    
    public function journalvoucher()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
			$options = ["forms like '%JV%'" => null, "parentid !=" => "0", "chracctype" => "2"];
		
            $data["account_head"] =$this->am->get_account_head_for_general_receipt($options);
			
            $data["sub_category"] = $this->am->fetch_sub_category();
            $data["cheque_number"] = $this->am->fetch_cheque_number();
    		$this->load->view('header',$pro_data);
    		$this->load->view('journalvoucher',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "user")
	    {
	        $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
	        if($check_user_i->masters_view == "1")
	        {
    	        $pro_data["project_info"] = $this->mm->fetch_project_info();
                $data["account_head"] =$this->mm->get_account_head_for_general_receipt();
                $data["sub_category"] = $this->mm->fetch_sub_category();
                $data["cheque_number"] = $this->mm->fetch_cheque_number();
        		$this->load->view('header',$pro_data);
        		$this->load->view('journalvoucher',$data);
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
	
	public function check_duplicate_entry_jv()
    {
        if($this->session->has_userdata('logged_in')) 
        {
            $subaccount = $this->input->post('subaccount');
            $date = $this->input->post('date');

            $options = ['sub_category' => $subaccount, 'transaction_date' => $date];

            $status = $this->mm->check_jv($options);

            echo json_encode(['status' => $status]);
        }
    }
	
	public function add_journalvoucher()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
			$response = [
				'status'    => false,				
				'msg'       => 'unable to add jv'
			];

    		$acchead = $this->input->post("acchead");
    		$subcategory =$this->input->post("subcategory");
    		$debit =$this->input->post("debit");
    		$credit =$this->input->post("credit");
    		$tdsamount =$this->input->post("tdsamount");
    		$remark =$this->input->post("remarks");
    		$advices =$this->input->post("advices");

			$data2 = [];
    		if( isset( $subcategory )  && !empty( $subcategory ) ) {
				$date = date("Y-m-d H:i:s");
                $year = date('y');
                $month = date('m');
                
				
            	$sr_no = $this->mm->getMaxSRNo("JV", "journalvoucher", $year );

				foreach( $subcategory as $key => $subhead ){
					$data[$key] = [
						"journal_no"		=> $sr_no,
						"account_id" 		=> $acchead[$key],
						"sub_category" 		=> $subcategory[$key],
						"debit"				=> $debit[$key],
						"credit"			=> $credit[$key],
						"tds_amount" 		=> $tdsamount[$key],
						"narration"			=> $remark,
						"advices"			=> $advices[$key],
						"transaction_date"	=> $date,
					];

					$acctype = $this->mm->get_paymode_chracctype($subhead);
					

					if($acctype->chracctype == "1")
					{											
						$data2[] = [
							"sr_no" 		=> $sr_no,
							"cr_parent_id" 	=> $acchead[$key],
							"credit" 		=> $credit[$key],
							"debit" 		=> $debit[$key],
							"dr_parent_id" 	=> $subhead,
							"note" 			=> $remark,
							"datetime" 		=> $date
						];									
					}
					else if($acctype->chracctype == "3")
					{
						$data2[] = [
							"sr_no" 		=> $sr_no,
							"dr_parent_id" 	=> $acchead[$key],
							"debit" 		=> $debit[$key],
							"credit" 		=> $credit[$key],
							"cr_parent_id" 	=> $subhead,
							"note" 			=> $remark,
							"datetime" 		=> $date
						];
					}
					
                   //$res2 = $this->am->add_acc_commission_ledger($data2);  
                   				       							
				}

				
				if($this->mm->add_journalvoucher_batch($data)){
					if(isset($data2) && !empty($data2)) {						
						$res2 = $this->mm->add_acc_jv_post($data2);  			
						$response = [
							'status'    => true,						
							'msg'       => 'Successfully added JV. No. '.$sr_no
						];
					}
					
				}


			}
            
                                    

    		echo json_encode($response);
    	}
	}
	
	
      
      
      
}