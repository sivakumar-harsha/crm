<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class AdvanceCtrl extends CI_Controller {
     public $rolepermissionModel;
    public $auth;
    public $am;
    public $mm;
    public $session;
    public $upload;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('AdvanceMod','am');
		$this->load->model('MasterMod','mm');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('cookie');
		$this->load->library('upload');
	}
	
	public function agent_advance()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin")
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('agent_advance');
    		$this->load->view('footer',$pro_data);
	    }
	    else {
	        
	        redirect('home','refresh');
	    }
	}
	
	public function fetch_load_agents()
	{
	    if($this->session->has_userdata('logged_in'))
	    {
	        $res = $this->am->fetch_load_agents();
	        echo json_encode($res);
	    }
	}
	
	// advance 
	
	public function add_advance_amount()
	{
	    if($this->session->has_userdata('logged_in'))
	    {
	        $agent = $this->input->post("agents");
	        $amount = $this->input->post("amount");
	        $date = $this->input->post("date");
	        $payment_mode = $this->input->post("payment_mode");
	        $transaction_no = $this->input->post("transaction_no");
	        $reason = $this->input->post("reason");
	        
	        
	        $new_sr_no = "AC46/22";
            $total_irda ="00.0";
            $agn_com_id = "acc42";
            $own_com_id ="acc21";
            $tds ="00.0";
            
	        
	        
	        $data = array(
	                        "agent_id" =>$agent,
	                        "amount" =>$amount,
	                        "type" =>"debit",
	                        "date" =>$date,
	                        "payment_mode" =>$payment_mode,
	                        "transaction_no" =>$transaction_no,
	                        "reason" =>$reason,
	                        "created_by" =>$this->session->userdata("session_id"),
	                        "created_date" =>date("Y-m-d H:i:s"),
	                       );
	                       
	        $res = $this->am->add_advance_amount($data);
	        
	        $ablog = array(
                            "agent_id" =>$agent,
                            "tran_date" =>date('Y-m-d H:i:s'),
                            "vocher_no" =>$transaction_no,
                            "debit" =>$amount,
                            "reason" =>"Agent_advance",
                            "created_by" =>$this->session->userdata("session_id"),
                            "created_at" =>date("Y-m-d H:i:s"),
	                       );
	                                   
	        $result = $this->am->agent_balance_log($ablog);
	        
	           $data1 =   array( 
                                    "sr_no" =>$new_sr_no,
                                    "debit"=>$amount,
                                    "credit"=>$total_irda,
                                    "cr_parent_id" =>$agn_com_id,
                                    "dr_parent_id" =>$own_com_id,
                                    "tds" =>$tds,
                                    "sub_id" =>"24",
                                    "note" =>"Advance Agent commission Debit",
                                    "datetime" =>date("Y-m-d H:i:s")
                                );
                                    
             $res0 = $this->am->add_acc_agent_advance_orc($data1);
	        
	        
	        echo "success";
	    }
	}
	
	public function fetch_agent_advance()
	{
	    if($this->session->has_userdata('logged_in'))
	    {
            $draw = intval($this->input->post("draw"));
            
            $month = $this->input->post("month");
            $year = $this->input->post("year");
            $agent = $this->input->post("agent");
            
            $date = $year."-".$month."-01";
            
            $res = $this->am->fetch_agent_advance($date,$agent);
            $arr = [];
            $a = 0 ;
            
            foreach($res as $da)
            {
                $a++;
                    $arr[] = array(
                        $a,
                        date_format(date_create($da->date),"d-m-Y"),
                         $da->agent_pos_name,
                        $da->agent_pos_code,
                        $da->reason,
                        $da->amount,
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
	
  public function cheque_book()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin")
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
	        $data["bank_name"] = $this->am->fetch_bank_detalis();
    		$this->load->view('header',$pro_data);
    		$this->load->view('cheque_book',$data);
    		$this->load->view('footer',$pro_data);
	    }
	    else {
	        
	        redirect('home','refresh');
	    }
	}
	
	public function add_cheque_book_details()
	{
	    
	    if($this->session->has_userdata('logged_in'))
	    {
	        $select_bank = $this->input->post("select_bank");
	        $date = $this->input->post("date");
	        $book_id = $this->input->post("book_id");
	        $add_bank1 = $this->input->post("add_bank1");
	        $location = $this->input->post("location");
	        $account_number = $this->input->post("account_number");
	        $bank = $this->input->post("bank");
	        $no_of_cheque= $this->input->post("no_of_cheque");
	        $cheque_from_date = $this->input->post("cheque_from_date");
	        $cheque_to_date = $this->input->post("cheque_to_date");
	        
	        
	        $data= array(
	                      "bank_id" =>$select_bank,
	                      "date" =>$date,
	                      "book_id" =>$book_id,
	                      "location" =>$location,
	                      "bank" =>$bank,
	                      "account_number" =>$account_number,
	                      "no_of_cheque" =>$no_of_cheque,
	                      "cheque_from_date" => $cheque_from_date,
	                      "cheque_to_date" =>$cheque_to_date,
                          "created_by" =>$this->session->userdata("session_id"),
                          "created_at" =>date("Y-m-d H:i:s"),
	                     );
	        $res = $this->am->add_cheque_book_details($data);
	        
	        
	        echo "success";
	    }
	}
	        
	
	
   public function fetch_bank_details()
   {
       if($this->session->has_userdata('logged_in'))
	    {
	         $select_bank = $this->input->post("select_bank");
	         $res = $this->am->fetch_bank_details($select_bank);
	         $res1 = $this->am->fetch_cheque_book($select_bank);
	         
	         echo json_encode(['bankinfo' => $res, 'cheque' => $res1]);
	        

	    }
   }
   
   public function fetch_cheque_details()
   {
    if($this->session->has_userdata('logged_in'))
	    {
	     $draw = intval($this->input->post("draw"));
	     
          
            $res = $this->am->fetch_cheque_details();
            $arr = [];
            $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;


            $action = "<button class='btn btn-warning btn-xs' onclick=edit_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Edit</button> 
            		 <button class='btn btn-danger btn-xs' onclick=delete_data(".$da->id.")><i class='fa fa-trash-o'></i> Delete</button>
            		 <button class='btn btn-success btn-xs' onclick=generate_cheque_data(".$da->id.")><i class='fa-check-square-o'></i> Generate Cheques</button>";
                        
            
            $arr[] = array(
                $a,
                date("d-m-Y", strtotime($da->date)),
                $da->bank,
                $da->no_of_cheque,
                $da->cheque_from_date,
                $da->cheque_to_date,
                $action

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
	
 public function fetch_edit_cheque_details()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->am->fetch_edit_cheque_details($id);
			echo json_encode($res);
		}
	}
	
	public function edit_cheque_book_details()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $select_bank = $this->input->post("select_bank");
	        $date = $this->input->post("date");
	        $book_id = $this->input->post("book_id");
	        $add_bank1 = $this->input->post("add_bank1");
	        $location = $this->input->post("location");
	        $account_number = $this->input->post("account_number");
	        $bank = $this->input->post("bank");
	        $no_of_cheque= $this->input->post("no_of_cheque");
	        $cheque_from_date = $this->input->post("cheque_from_date");
	        $cheque_to_date = $this->input->post("cheque_to_date");
	        $id = $this->input->post("id");
	        
	        
	         $updated_date = date("Y-m-d H:i:sa");
	        
	        
	         $data= array(
	                      "bank_id" =>$select_bank,
	                      "data" =>$date,
	                      "book_id" =>$book_id,
	                      "location" =>$location,
	                      "bank" =>$bank,
	                      "account_number" =>$account_number,
	                      "no_of_cheque" =>$no_of_cheque,
	                      "cheque_from_date" => $cheque_from_date,
	                      "cheque_to_date" =>$cheque_to_date,
                          "updated_date" => $updated_date,
	                     );
	        $res = $this->am->edit_cheque_book_details($id,$data);
	        
	        
	        echo "success";
    	    
    	    
     	}
	    
	}
	
  public function delete_cheque_details()
  {
      if($this->session->has_userdata('logged_in')) 
    	{
			$id = $this->input->post("id");
			$this->am->delete_cheque_details($id);
    	}
  }
  
  public function generate_cheque_book()
  {
      if($this->session->has_userdata('logged_in')) 
    	{
    	    $id =$this->input->post("id");
    	   $res = $this->am->get_cheque_details($id);
    	    
         if( isset($res) && ! empty($res)){
             $start = $res->cheque_from_date;
             $end = $res->cheque_to_date;
             $bank_name = 'acc/'.$res->bank_id;

                for($x = $start; $x <= $end; $x++) {
                echo "The number is: $x <br>";
                
             
                
                $data= array(
                               "vchbank_id" =>$bank_name ,
                               "vchcheque_character_no" => $x ,
                               "status" => "N",
                               "vchaccid" => "",
                               );
                               
                  $res = $this->am->generate_cheque_book($data);            
                }       
               
                
             
         }
    	    
        }
      
  }
  
  
  public function fetch_book_entry_details()
     {
         /*
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->am->fetch_book_entry_details();
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<button class='btn btn-warning btn-xs' onclick=cheque_info_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Cheque Info</button>";
                
                  $status = "NOT Used";
                
                if($da->status == "U")
                {
                    $status = "Used";
                }
                
            
            $arr[] = array(
                $a,
                $da->vchbank_id,
                $da->vchcheque_character_no,
                $status,
                $da->vchaccname,
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
        */
        
        $draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->am->fetch_book_entry_details();
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<button class='btn btn-warning btn-xs' onclick=cheque_info_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Cheque Info</button>";
                
                  $status = "NOT Used";
                
                if($da->status == "U")
                {
                    $status = "Used";
                }
                

            
            $arr[] = array(
                $a,
                $da->bank_name.'('.$da->account_number.')',
                $da->vchcheque_character_no,
                $status,
                $da->usingacc,
                $da->cheque_status,
                $da->Returned_reason,
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
	
	// 2023-09-07
	public function fetch_cheque_info_data()
	{
	   $id = $this->input->post("id");
	   $res = $this->am->fetch_cheque_info_data($id);
	   echo json_encode($res);
	}
	
	
	public function fetch_using_cheque_details()
     {
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->am->fetch_using_cheque_details();
		}
		
		$arr = [];
        $a = 0 ;
        
        foreach($res as $da)
        {
        	$a++;

            $action = "<button class='btn btn-warning btn-xs' onclick=cheque_info_data(".$da->id.")><i class='fa fa-pencil-square-o'></i> Cheque Info</button>";
                        
                $status = "";        
                        
             if($da->cheque_status == "cheque_passed")
                {
                    $status = "Cheque Passed";
                }  
            else if ($da->cheque_status == "cheque_returned")
            {
                 $status = "Cheque Returned";
            }
            else if($da->cheque_status == "cheque_cancalled")
            {
                $status = "Cheque Cancalled";
            }
            
            $amount = 0.00;
            
            if($da->amount)
            {
                $amount = $da->amount;
            }
            
                        
            
            $arr[] = array(
                $a,
                $da->vchbank_id,
                $da->vchcheque_character_no,
                number_format($amount,2),
                $da->vchaccname,
                $status,


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
	
	
	public function add_cheque_status()
	{
	    $cheque_date = $this->input->post("cheque_date");
	    $cheque_status  = $this->input->post("cheque_status");
	    $Returned_reason = $this->input->post("Returned_reason");
	    $id = $this->input->post("id");
	    
	    
	    $data = array("cheque_date" =>$cheque_date,
	                   "cheque_status" =>$cheque_status,
	                   "Returned_reason" =>$Returned_reason
	               );
	   $res = $this->am->add_cheque_status($id,$data);
	        
	}
	
	public function cheque_entry()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin")
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
	        $options = ['pay_mode' => 'Cheque'];
			$data["receiptlist"] = $this->am->fetch_general_receipt($options);
    		$this->load->view('header',$pro_data);
    		$this->load->view('cheque_entry', $data);
    		$this->load->view('footer',$pro_data);
	    }
	    else {
	        
	        redirect('home','refresh');
	    }
	}
	
	public function received_cheque_Info() {
		$data = [];
		if($this->session->has_userdata('logged_in')) 
    	{
    	    $cheque_number = $this->input->get("cheque_number");    	       	        	   
			$options = ['cheque_number' => $cheque_number];
    	    $data = $this->am->fetch_cheque_entry($options);   			   
     	}

     	echo json_encode($data);
	}
	
	public function add_cheque_entry()
	{
	     if($this->session->has_userdata('logged_in')) 
    	{
    	    $cheque_number = $this->input->post("cheque_number");
    	    $bank_name = $this->input->post("bank_name");
    	    $date = $this->input->post("date");
    	    $add_amount = $this->input->post("add_amount");
    	    $balance_amount = $this->input->post("balance_amount");
    	    $depostite_date = $this->input->post("depostite_date");
    	    
    	    $data = array( "cheque_number" =>$cheque_number,
    	                    "bank_name" =>$bank_name,
    	                    "date" =>$date,
    	                    "amount"=>$add_amount,
    	                    "balance_amount" =>$balance_amount,
    	                    "depostite_date" =>$depostite_date,
    	                    "created_by" =>$this->session->userdata("session_id"),
                            "created_at" =>date("Y-m-d H:i:s"),
    	                    );
    	       $res = $this->am->add_cheque_entry($data);             
     	}
     	 echo "success";
	    
	}
	
	public function update_cheque_entry()
	{
	    if($this->session->has_userdata('logged_in')) 
    	{
    	    $cheque_number = $this->input->post("cheque_number");
    	    $depostite_date = $this->input->post("depostite_date");
    	    $status = $this->input->post("status");
    	    $clear_date = $this->input->post("clear_date");
    	    $remarks = $this->input->post("remarks");
    	    
    	    $data = [
				"depostite_date" =>$depostite_date,
				"clear_date" =>$clear_date,
				"cheque_status" =>$status,
				"remarks" =>$remarks,
				"updated_by" =>$this->session->userdata("session_id"),
				"updated_at" =>date("Y-m-d H:i:s"),
			];
    	               
			$res = $this->am->update_cheque_entry($data, $cheque_number);
     	}
     	 echo "success";
	    
	}
	
	
	    
	

}