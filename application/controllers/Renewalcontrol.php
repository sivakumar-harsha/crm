<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Renewalcontrol extends CI_Controller {
    public $cm;
    public $lmd;
    public $lm;
    public $mm;
    public $pm;
    public $rolepermissionModel;
    public $auth;
    public $audit_model ;
    public $form;
    public $cookie;
    public $audit;
    public $url;
    public $db;
    public $database;
    public $session;

	public function __construct(){
		parent::__construct();
		$this->load->database();
		$this->load->model('Configmod','cm');
		$this->load->model('LeadMod','lmd');
        $this->load->model('Leadmodel','lm');
		$this->load->model('MasterMod','mm');
		$this->load->model('PayoutMod','pm');
		$this->load->library('session');
		$this->load->library('audit');
		$this->load->helper('url');
		$this->load->helper('cookie');
	}

	/* Category */
	
	public function getRenewalsDetails()
	{
	    $date       = $this->input->get('date');
	    $type       = $this->input->get('type');
	    $policy     = $this->input->get('policy');
	    $searchCol  = $this->input->get('searchCol');
        $searchVal  = $this->input->get('searchVal');
	    $data   = [];
	    
	    if( $date ) {
	        $d = new DateTime($date);
	        $user_id = ($this->session->has_userdata('session_role') == "user") ? $this->session->userdata('session_id') : 1;
	        $this->load->model('Mainmod','mm');
	        $fromdate = $todate = $date;
	        $data['results'] = $this->mm->getRenewalsDetailsByDuedate($user_id,$fromdate,$todate, $type, $policy, $searchCol, $searchVal);
	        
	        $data['fromdate']   = $d->format('d/M/Y');
	        $data['type']       = $type;
	        $data['policy']     = $policy;
	        $this->load->view('renewals-details', $data);
	    }
	}

	public function renewallead()
	{
		    		
		   	$pro_data["project_info"] = $this->lm->fetch_project_info();
		   	$data['monthlist'] = $this->getMonthList();

            $res = $this->cm->get_foe(0);
            $userslist = [];
            
            foreach($res as $da)
            {
                $userslist[$da->id] = $da->username;
            }
            $data['userslist'] = $userslist;
            $swap = false;
            if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin")  {
                $swap = true;
                $data['swap'] = $swap;
        		$this->load->view('header',$pro_data);
        	//	$this->load->view('sidebar',$pro_data);
        		$this->load->view('renewal_lead', $data);
        		$this->load->view('footer',$pro_data);
            }
            
            else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	        {
	        $data["permission"] =$check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
	     //   Print_r($check_user_i); exit;
	        
    	        if($check_user_i->lead_renewals_view == "1")
    	        {
                    $data['swap'] = $swap;
            		$this->load->view('header',$pro_data);
            	//	$this->load->view('sidebar',$pro_data);
            		$this->load->view('renewal_lead', $data);
            		$this->load->view('footer',$pro_data);
    	        }
    	        else
    	        {
    	             echo "<script>alert('Permission Denied');window.location.href='home';</script>";
        	          //redirect("home");
    	        }
	        }
	    }
	   

	public function fetch_renewallead()
	{
		$draw = intval($this->input->post("draw"));
		$month = $this->input->get("month");
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->lm->fetch_renewallead($month);
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<a href='renewalpolicy?lid=".$da->lead_id."' class='btn btn-warning btn-xs' title='Renewal Leads'><i class='fa fa-eye'></i></a>";
            $assign = '<span id="elead_'.$da->lead_id.'"></span><input type="checkbox" class="checkbox" required id="lead_'.$da->lead_id.'" name="leads[]" data-parsley-mincheck="1" data-parsley-errors-container="#elead_'.$da->lead_id.'" value="'.$da->lead_id.'">';
            if($da->new_lead_id) {
                //$action = "<a href='create_lead?id=".$da->new_lead_id."' class='btn btn-success btn-xs'>New Lead Created</a>";
                if($da->lead_status == "lost"){
                    $action = $da->remarks;//"<strong><p title='".$da->remarks."'>".$da->lead_status."</strong></p>";
                    $action .= "&nbsp;&nbsp;<a href='create_lead?id=".$da->new_lead_id."' class='btn btn-secondary btn-xs'>view Lead</a>";
                } else {
                    $action = "<a href='create_lead?id=".$da->new_lead_id."' class='btn btn-success btn-xs'>New Lead Created</a>";
                }
                
                $assign = "";
            }
            
            $arr[] = array(
                //'<span id="elead_'.$da->lead_id.'"></span><input type="checkbox" class="checkbox" required id="lead_'.$da->lead_id.'" name="leads[]" data-parsley-mincheck="1" data-parsley-errors-container="#elead_'.$da->lead_id.'" value="'.$da->lead_id.'">',
                $assign,
                $a,
                "<a href='#' onclick=view_data(".$da->lead_id.")>".$da->client_name."</a>",
                $da->lead_id,
                $da->mobile_no,
                $da->bussiness_type,
                $da->policy_type,
                $da->area,
                ($da->new_lead_id) ? $da->nassigned_user : $da->assigned_user,
                date("d-m-Y", strtotime($da->policy_ex_date)),
                date("d-m-Y", strtotime($da->policy_s_date)),
                date("d-m-Y", strtotime($da->policy_issue_date)),
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
	
	public function store() {
        if($this->session->has_userdata('logged_in')) 
        {
            $response = [
                'status'    => false,
                'msg'       => 'unable to save'
            ];
            $leads = $this->input->post('leads');
            $user_id = $this->input->post('user_id');
            $today = new DateTime();
            
            if(isset($leads) && !empty($leads) && $user_id) {
                $leadinfo = $this->lm->getLeads($leads);
                if(isset($leadinfo) && !empty($leadinfo)) {
                    foreach($leadinfo as $row)
                    {
                        $res = $this->cm->get_foe_districts($row->assigned_user);
                        if(isset($res) && !empty($res)) {
                            foreach($res as $da)
                            {
                                $data = array("user_id" => $user_id,"district_id" =>$da->district_id);
                                
                                if(!$this->cm->check_this_district_already_exits($da->district_id,$user_id))
                                {
                                    $update = $this->cm->update_foe_districts($data);
                                    //echo $this->db->last_query();echo '<br />';
                                }
                            }
                        }
                        $arr = array("assigned_user" =>$user_id,"old_user" =>$row->assigned_user, 'updated_date' => $today->format('Y-m-d'));
                        $old_data = $this->lmd->get_lead_details($row->lead_id);
                        $result = $this->lm->update_leads_records($arr,$row->lead_id);
                        //echo $this->db->last_query();echo '<br />';

                        $this->audit->log('list_of_leads', 'UPDATE', null, $old_data, $arr);
                    }
                }

                $response = [
                    'status'    => true,
                    'msg'       => 'Successfully Assigned',
                    'redirect_url' => base_url('renewallead')
                ];
                
            }

            echo json_encode($response);
            die();
        }

        redirect('login', 'refresh');

    }
    
    
    function getMonthList()
    {
        $monthlist  = [];
        //return $monthlist;
        $currentMM = date("m");
        if ($currentMM == "01") {
            $startdate = (date("Y") - 1) . "-12-01";
        } else {
            $startdate = date("Y") . "-01-01";
        }
        
        $enddate    = date("Y")."-12-31";
        $interval   = "P1M";
        $calendar   = new DatePeriod(
            new DateTime( $startdate ),
            new DateInterval( $interval ),
            new DateTime( $enddate )
        );
        if( $calendar ) {
            foreach( $calendar as $p ) {
                $monthlist["'".$p->format('Y-m-01')."' and '". $p->format('Y-m-t')."'"] = $p->format('F - Y');
            }
            
            unset($calendar);
        }
        
        return $monthlist;
    }
    
    
	public function failurelead()
	{
    	     if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        	{ 
                $pro_data["project_info"] = $this->lm->fetch_project_info();
        		$this->load->view('header',$pro_data);
         	//	$this->load->view('sidebar',$pro_data);
        		$this->load->view('failurelead');
        		$this->load->view('footer',$pro_data);
        	}
        	else{
        	    $check_user_i = $this->cm->fetch_user_permissions($this->session->userdata('session_id'));
    	       // echo "<pre>"; print_r($check_user_i); exit;
    	        if($check_user_i->fail_view == "1")
    	        {		
    		   	$pro_data["project_info"] = $this->lm->fetch_project_info();
        		$this->load->view('header',$pro_data);
         	//	$this->load->view('sidebar',$pro_data);
        		$this->load->view('failurelead');
        		$this->load->view('footer',$pro_data);
        		}else
    	        {
    	             echo "<script>alert('Permission Denied');window.location.href='home';</script>";
        	          //redirect("home");
    	        }
        	}
		 
	    }
	     public function fetch_failurelead() 
	 {
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->lm->fetch_failurelead();
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

          
            
            $arr[] = array(
                $a,
                $da->client_name,
                $da->mobile_no,
                $da->bussiness_type,
                $da->class,
                $da->policy_type,
                date("d-m-Y", strtotime($da->due_date)),
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
	public function fetch_renewal_export_excel()
	{
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
            
            $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Renewal Lead Report');
            
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
            	
        //$objPHPExcel->getActiveSheet()->SetCellValue('F3', date_format(date_create($from_date),"d-m-Y"));
        //$objPHPExcel->getActiveSheet()->SetCellValue('G3', date_format(date_create($to_date),"d-m-Y"));
        
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
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Lead Id');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Mobile No');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'policy type');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Bussiness type');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'area');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'policy_ex_date');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Policy Start Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Policy Issue Date');
        $row_count = 5;
        $a = 0;
            
        $res = $this->lm->fetch_renewallead();
           
                                
            $a = 0;
            
          
            
            foreach($res as $da)
            {
                $a++;
                
               
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->client_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->lead_id);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->mobile_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , $da->policy_type);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $da->bussiness_type);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->area);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $da->policy_ex_date);
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , $da->policy_s_date);
                $objPHPExcel->getActiveSheet()->SetCellValue('J'.$row_count , $da->policy_issue_date);
       
                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
            }
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                $objWriter->save('./datas/reports/Renewalleadexcel.xlsx');
                echo base_url()."/datas/reports/Renewalleadexcel.xlsx";
       
    } 
	public function fetch_export_excel()

    {
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
            
            $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Failure Lead Report');
            
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
            	
        //$objPHPExcel->getActiveSheet()->SetCellValue('F3', date_format(date_create($from_date),"d-m-Y"));
        //$objPHPExcel->getActiveSheet()->SetCellValue('G3', date_format(date_create($to_date),"d-m-Y"));
        
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
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Mobile No');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Bussiness type');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'class');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'policy type');
        $objPHPExcel->getActiveSheet()->SetCellValue('g4', 'Due_date');
        $row_count = 5;
        $a = 0;
            
        $res = $this->lm->fetch_failurelead();
           
                                
            $a = 0;
            
          
            
            foreach($res as $da)
            {
                $a++;
                
               
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->client_name);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count , $da->mobile_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->bussiness_type);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , $da->class);
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , $da->policy_type);
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->due_date);
       
                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
            }
            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                $objWriter->save('./datas/reports/exportexcel.xlsx');
                echo base_url()."/datas/reports/exportexcel.xlsx";
       
    }   
    
        public function getVechicleCategory($vechile_type_id) {      
            
             
        $category = "";
        $categories = [
            'CAR'       => ['1', '3', '68'],
            'BIKE'      => ['2'],
            'EBIKE'     => ['4'],
            'PC'        => ['7', '12', '13', '14', '59', '60', '65', '66', '69', '70'],
            'GC'        => ['8', '9', '10', '15', '16', '61'],
            'MISC'      => ['20'],
            'SCOOTER'   => ['55'],
            'AMBULANCE' => ['18'],
        ];

        if(isset($categories) && !empty($categories)) {
            foreach( $categories as $key => $category_row ){
                if(in_array($vechile_type_id, $category_row)){
                    $category = $key;
                    continue;
                }
            }
        }
        
        return $category;
        

        //$result = $this->lm->getVechicleCategory($vechile_type);
        //return ( isset( $result ) && !empty( $result ) ) ? $result->category : ""; 
    }

    public function renewalpolicy() {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        $lead_id = $this->input->get('lid');
        $result = $this->lmd->getRenewalLeadDetails($lead_id);
        
        if(empty($lead_id) || empty($result) || empty($result->policy_ex_date)) {
            redirect('renewallead', 'refresh');
        }

        $renew = $this->lmd->IsRenewaledLead($lead_id);
        if(isset($renew) && !empty($renew)) {
            redirect('renewallead', 'refresh');
        }
        
        $startdate = $duedate = "";
        if( isset( $lead_id ) && !empty( $lead_id ) ){
            $today  = new DateTime();
            $leadinfo = $this->lmd->get_policy_details($lead_id);                           
            $exdate = (isset($leadinfo->policy_ex_date)) ? $leadinfo->policy_ex_date : "";
            $edate  = new DateTime($exdate);
            
            
            $startdate = $today->format('Y-m-d');
            if( $edate->format('Y-m-d') > $today->format('Y-m-d')){
                $edate->add(new DateInterval('P1D'));
                $startdate = $edate->format('Y-m-d');
            }                        

            $date = new DateTime($startdate);
            $date->add(new DateInterval('P1Y'));
            $date->sub(new DateInterval('P1D'));
            $duedate = $date->format('Y-m-d');
        }

	   // if(!$this->auth->can_access('Create Leads')){
	   //     redirect('access_denied', 'refresh');
	   // }
	    
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{    		
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["users"] = $this->lmd->fetch_users();
		   	$data["ai"] = $this->lmd->fetch_ai();
		   	$data["agents_pos"] = $this->lmd->fetch_agents_pos();
		   	$data["policy_type"] = $this->lmd->fetch_list_of_policy_type_motor();
		   	$data["client_type"] = $this->lmd->fetch_client_type();
		   	$data["business"] = $this->lmd->fetch_business_type();
		   	$data["class"] = $this->lmd->fetch_list_of_class();
		   	$data["fuel_type"] = $this->lmd->fetch_fuel_type();
		   	$data["rto"] = $this->lmd->fetch_rto();
		   	$data["state"] = $this->lmd->fetch_state();
		   	$data["region"] = $this->lmd->fetch_region();
            $data['startdate'] = $startdate;
            $data['duedate'] = $duedate;
    		
	    }
	    else if($this->session->has_userdata('logged_in') && ($this->session->userdata('session_role') == "user" || $this->session->userdata('session_role') == "AI"))
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
	        
	        if($this->session->userdata("session_role") == "user")
	        {
	           $data["agents_pos"] = $this->lmd->fetch_agents_pos();
	           
	           $data["region"] = $this->lmd->fetch_region();
	        }
	        else if($this->session->userdata("session_role") == "AI")
	        {
	            $data["agents_pos"] = $this->lmd->fetch_agents_pos_by_area_incharge($this->session->userdata("session_id"));
	            $data["region"] = $this->lmd->fetch_region_by_area_incharge($this->session->userdata("session_id"));
	        }
	        
	        $data["users"] = $this->lmd->fetch_users();
	        $data["ai"] = $this->lmd->fetch_ai();
	        $data["client_type"] = $this->lmd->fetch_client_type();
	        $data["business"] = $this->lmd->fetch_business_type();
	        $data["class"] = $this->lmd->fetch_list_of_class();
	        $data["policy_type"] = $this->lmd->fetch_list_of_policy_type_motor();
	        $data["fuel_type"] = $this->lmd->fetch_fuel_type();
	        $data["rto"] = $this->lmd->fetch_rto();
	        $data["state"] = $this->lmd->fetch_state();
            $data['startdate'] = $startdate;
            $data['duedate'] = $duedate;
           
	    }
	    else
	    {
	    	redirect("login");
	    }

        
        
        
        
        
        $policy_class = $result->class;
        
        $policytypelist = $this->lmd->fetch_policy_type_using_class($policy_class);
        $data["policytypelist"] = $policytypelist;

        $agent_pos = $result->agency_and_pos;
        $areainchargelist = $this->lmd->fetch_area_incharge_by_agent($agent_pos);        
        if($areainchargelist) {
            $areainchargelist = [$areainchargelist];  
        }
        $data["areainchargelist"] = $areainchargelist;        
        $data['result'] = $result;

        $hresult = [];

        if($result->class == "2") {
            $hresult = $this->lmd->get_health_details($lead_id);
        }
        
        $data['hresult'] = $hresult;

        $horesult = [];
        if($result->policy_type == "22"){
            $horesult = $this->lmd->get_home_details_by_lead_id($lead_id);
        }
    	
        $data['horesult'] = $horesult;

        $bresult = $this->lmd->get_business_details_by_lead_id($lead_id);

        $data['bresult'] = $bresult;

        $get_maraine_details = $this->lmd->get_maraine_details_by_lead_id($lead_id);

        $commodity = (isset($get_maraine_details->commodity) && !empty($get_maraine_details->commodity)) ? $get_maraine_details->commodity : null;
        $sub_commodity = $this->lmd->commodity_change_load_sub_commodity($commodity);
        
        $options = [];
        
        foreach($sub_commodity as $r)
        {
            $options[$r->id] = $r->name;
        }
        

        $data['mresult'] = $get_maraine_details;
        $data['options'] = $options;

        $pet_details = $this->lmd->get_pet_details_by_lead_id($lead_id);

        $data['presult'] = $pet_details;

        $nominee_details = $this->lmd->get_nominee_details($lead_id);
        $data['nresult'] = $nominee_details;

        $vehi_type = $this->lmd->get_vechile_type($lead_id);
            
        $vechile_details = array();

        if( isset($vehi_type->policy_type) && !empty($vehi_type->policy_type) ) {

            $category = $this->getVechicleCategory($vehi_type->policy_type);
        
            if($category) {
                switch($category) {
                    case "CAR":
                        $vechile_details = $this->lmd->get_car_details($lead_id); 
                        break;
                    case "BIKE":
                    case "EBIKE":
                        $vechile_details = $this->lmd->get_bike_details($lead_id);
                        break;                        
                    case "PC":
                        $vechile_details = $this->lmd->get_pc_details($lead_id,$vehi_type->policy_type);
                        break;
                    case "GC":
                        $vechile_details = $this->lmd->get_gc_details($lead_id,$vehi_type->policy_type);
                        break;
                    case "MISC":
                        $vechile_details = $this->lmd->fetch_make_misc($lead_id);
                        break;
                    case "SCOOTER":
                        $vechile_details = $this->lmd->fetch_make_scooter($lead_id);
                        break;
                    case "AMBULANCE":
                        $vechile_details = $this->lmd->fetch_make_ambulance($lead_id);
                        break;
                }                        
            }
        }

        $data['vresult'] = $vechile_details;

        $data['lead_id'] = $lead_id;

        $this->load->view('header',$pro_data);
        $this->load->view('renewalpolicy',$data);
        $this->load->view('footer',$pro_data);
    }

    public function save()
	{
	    if($this->session->has_userdata('logged_in'))
	    {
            $request = $this->input->post();
            
            extract($request);            

	        $pin = $this->input->post("pin_code");//
	        $class = $this->input->post("policy_class");//            
	        
	        $region = $this->lmd->fetch_agent_region($agent_pos);
	        
	        $region_id = "";
	        
	        if($region != null)
	        {
	            $region_id = $region->region;
	        }
	        
	        //$remarks = $this->input->post("remarks");
	        $lead_created_by = $this->session->userdata('session_name');//
	        
	        $file = $this->input->post("files");
	        
	        $created_date = date("Y-m-d H:i:sa");
	        $updated_date = date("Y-m-d H:i:sa");
	        
	        //$res_1 = $this->lm->fetch_vechi_regn_no_already_exits($v_regn_no);
	        
	        if(isset($ref_lead_id) && !empty($ref_lead_id))
	        {
	            

	            $data = array( 
                    "client_type_id"               => $client_type,
                    "client_name"                  => $client_name,
                    "mobile_no"                    => $mobile_no,
                    "other_contact_details"        => $other_contact_details,
                    "landline_no"                  => $landline_no,
                    "address"                      => $address,
                    "email"                        => $email_id,
                    "contact_person_name"          => $contact_person_name,
                    "contact_person_designation"   => $contact_person_des,
                    "gst_number"                   => $gst_number,
                    "date_of_birth"                => $dob,
                    "age"                          => $age,
                    "area"                         => $area,
                    "pin_code"                     => $pin,
                );
	             
                if(isset($client_id) && !empty($client_id)){
                    $clientinfo = $this->lmd->get_receiver_email_by_id($client_id);                
                    if( $this->lmd->update_client_details($client_id,$data) ) {
                        $this->audit->log('list_of_clients', 'UPDATE', null, $clientinfo, $data);
                    }

                    $res = $client_id;

                } else {
                    $res = $this->lmd->add_client_details($data);
                    if( $res ) {
                        $this->audit->log('list_of_clients', 'INSERT', null, null, $data);
                    }
                }
                
	             
                if(isset($_FILES))
                {
                    $config['upload_path'] = './datas/old_policy_document/';
                    $config['allowed_types'] = '*';
                    
                    $this->load->library('upload',$config);
                    $this->upload->initialize($config);
                    if(!$this->upload->do_upload('file'))
                    {
                        $file = '';
                    }
                    else
                    {
                        $file = $this->upload->data('file_name');
                    }
                }
            
                if($res != "")
                {
                    $arr = array( 
                        "client_id"             => $res,
                        "business_type"         => $bussiness_type,
                        "class"                 => $class,
                        "policy_type"           => $policy_type,
                        "lead_generated_date"   => $lead_generated_date,
                        "due_date"              => $due_date,
                        "broken_policy"         => $broken_policy,
                        "location"              => $location,
                        "classfication"         => $classification,
                        "source"                => $source,
                        "lead_status"           => $lead_status, //"open",
                        "agency_and_pos"        => $agent_pos,
                        "assigned_user"         => $assign_to_user,
                        "area_incharge"         => $area_incharge,
                        "region_id"             => $region_id,
                        "remarks"               => $remarks,
                        "lead_created_by"       => $lead_created_by,
                        "old_policy_document"   => $file,
                        "lead_created_id"       => $this->session->userdata('session_id'),
                        "created_date"          => $created_date,
                        "updated_date"          =>$updated_date
                    );

                    if(isset($ref_lead_id) && !empty($ref_lead_id)) {
                        $arr['parent_lead_id'] = $ref_lead_id;
                    }
                    
                    $data_1 = $this->lmd->add_lead_details($arr);
                    if( $data_1 ) {
                        $this->audit->log('list_of_leads', 'INSERT', null, null, $arr);
                        if($lead_status == "follow_up") {
                            $follow_up = $this->add_follow_up_details($data_1);
                        }
                    }
                }
    
                if($class == "1")
                {
                    if(isset($ref_lead_id) && !empty($ref_lead_id)) {
                        $v_info = $this->lmd->getVechicleInfo($ref_lead_id);
                        if($v_info) {
                            $today = new DateTime();
                            unset($v_info['id']);
                            unset($v_info['created_at']);
                            unset($v_info['updated_at']);
                            $v_info['lead_id'] = $data_1;
                            $v_info['created_at'] = $today->format('Y-m-d');
                        }
                    } else {
                        $v_info = array("lead_id"=>$data_1,"vechi_register_no" =>$v_regn_no);
                    }
                   

                    $add_v_info = $this->lmd->add_vechicle_regn_no($v_info);   
                    if( $add_v_info ) {
                        $this->audit->log('vechile_details', 'INSERT', null, null, $v_info);
                    }
                }

                $activity_log = array("lead_id"=>$data_1,"action"=>"Created <b>New Lead</b>","action_type"=>"new_lead_creation","created_by"=>$lead_created_by,"time"=>$created_date);
                $add_activity = $this->lmd->add_activity_log($activity_log);
                if( $add_activity ) {
                    $this->audit->log('notification_log', 'INSERT', null, null, $activity_log);
                }

                echo json_encode(['status' => 'true', 'lead_id' => $data_1, 'lead_status' => $lead_status]);
                die();
            }
	    }
	}
	
	public function add_follow_up_details($id)
    {
        if($this->session->has_userdata('logged_in'))
        {
            //$id = $this->input->post("id");
            $follow_up_status = $this->input->post("follow_up_status");
            $follow_up_reason = $this->input->post("follow_up_reason");
            $next_follow_date = $this->input->post("enter_next_follow_date");
            $enter_next_follow_time = $this->input->post("enter_next_follow_time");
            $follow_comment =$this->input->post("follow_comment");
            $follow_up_created_date = date("Y-m-d");
                
            $check = $this->lmd->check_follow_up_already_exits($id);
            
            if($check !="" && $check != NULL)
            {
                foreach($check as $da)
                {
                    
                    $data_lead = array("next_follow_up_date"=>$next_follow_date,"last_follow_up_date" =>$da->next_follow_up_date,"follow_up_reason"=>$follow_up_reason,"follow_up_created_date"=>$follow_up_created_date,"next_follow_up_time" => $enter_next_follow_time,"lead_status" =>"followup");
                    $old_data = $this->lmd->get_lead_details($id);
                    $res = $this->lmd->update_follow_up_details($data_lead,$id);
                    if( $res ) {
                        $this->audit->log('list_of_leads', 'UPDATE', null, $old_data, $data_lead);
                    }
                }
            }
            else
            {
                    $data_lead = array("next_follow_up_date"=>$next_follow_date,"follow_up_reason"=>$follow_up_reason,"follow_up_created_date"=>$follow_up_created_date,"next_follow_up_time" => $enter_next_follow_time,"lead_status" =>"followup");
                    $old_data = $this->lmd->get_lead_details($id);
                    $res = $this->lmd->update_follow_up_details($data_lead,$id);
                    if( $res ) {
                    $this->audit->log('list_of_leads', 'UPDATE', null, $old_data, $data_lead);
                }
            }
            
            $data = array("lead_id"=>$id,"follow_up_status"=>$follow_up_status,"next_follow_up_date"=>$next_follow_date,"next_follow_up_time" =>$enter_next_follow_time,"reason"=>$follow_up_reason,"comment" =>$follow_comment,"follow_up_created_date"=>$follow_up_created_date, "created_by" => $this->session->userdata('session_id'), "updated_by" => $this->session->userdata('session_id'));
            $res = $this->lmd->add_follow_up_details($data);
            if( $res ) {
                $this->audit->log('follow_up_details', 'INSERT', null, null, $data);
            }
            if($check !="" && $check != NULL)
            {
                foreach($check as $da)
                {
                    $update_data = array("last_follow_up_date" =>$da->next_follow_up_date,"last_status_update" =>$da->follow_up_created_date);
                    //echo json_encode($update_data);
                }
            }
            else
            {
                $update_data = array("last_follow_up_date" =>"","last_status_update" =>date("Y-m-d"));
                //echo json_encode($update_data);
            }
            
            $activity_log = array(
                            "lead_id"=>$id,
                            "action"=>"created followup with reason  : <b><i>".$follow_up_reason."</i></b>. New Followup Set to <b>".date_format(date_create($next_follow_date),"d-m-Y")." ".date("h:i:s a",strtotime($enter_next_follow_time))."</b>",
                            "action_type"=>"Follow_up",
                            "created_by"=>$this->session->userdata('session_name'),
                            "time"=>date("Y-m-d H:i:sa"));
            $add_activity = $this->lmd->add_activity_log($activity_log);
            if( $add_activity ) {
                $this->audit->log('notification_log', 'INSERT', null, null, $activity_log);
            }
        }
    }
}