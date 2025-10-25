<?php
 
 defined('BASEPATH') OR exit('No direct script access allowed');

 class AccountsCtrl extends CI_Controller {
    public $rolepermissionModel;
    public $auth;
    public $am;
    public $rm;
    public $session;
    public $pdf;
    public $upload ;
    

	public function __construct()
	{
        parent::__construct();
        $this->load->database();
        $this->load->model("AccountsMod","am");
        $this->load->model('MasterMod','mm');
        $this->load->model('ReportMod','rm');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('cookie');
        $this->load->library('upload');
        $this->load->library('pdf');
        
    }
  
  
  // Function to generate the HTML tree structure recursively
    function generateTreeHTML($accounts, $parentId = 'acc0', $eleid = '')
    {
        $childAccounts = $this->getChildAccounts($accounts, $parentId);

        if (empty($childAccounts)) {
            return '';
        }

        if(isset($accounts) && !empty( $accounts )) {
            $html = ($eleid) ? '<ul id = "'.$eleid.'">' : '<ul>';

            foreach ($accounts as $account) {
                if ($account->vchparentid == $parentId) {

                    $html .= '<li>';
                    if( isset( $account->agent_id ) && !empty( $account->agent_id ) )
                        $html .= $account->name;

                    $html .= $account->vchaccname. ' ( <span class="node-value" style="cursor:pointer;color: green;
                    text-decoration: underline;" data-accid="'.$account->accid.'">'.strtoupper($account->vchaccid).'</span> )';

                    

                    $html .= $this->generateTreeHTML($accounts, $account->vchaccid);
                    $html .= '</li>';
                }
            }
    
            $html .= '</ul>';
        }

        return $html;
    }
    
    
    // Function to retrieve child employees for a given employee ID
    function getChildAccounts($accounts, $parentId)
    {
        $childAccounts = [];

        foreach ($accounts as $account) {
            if ($account->vchparentid == $parentId) {
                $childAccounts[] = $account;
            }
        }

        return $childAccounts;
    }
    
  public function getAllToShow() {
		
			$data = $this->am->getAll();
			//echo '<pre>';print_r($data);die;
			$itemsByReference = array();

			if ($data != null) {
				// Build array of item references:
				foreach($data as $key => &$item) {
					$item = get_object_vars($item);

					if ($item['vchaccid'] != "") {
						$item['text'] = $item['vchaccname'] . " - " . $item['vchaccid'];
					}

					$itemsByReference[$item['vchaccid']] = &$item;
					// Children array:
					$itemsByReference[$item['vchaccid']]['children'] = array();
					// Empty data class (so that json_encode adds "data: {}" )
					$itemsByReference[$item['vchaccid']]['data'] = new StdClass();
				}

				// Set items as children of the relevant parent item.
				foreach ($data as $key => &$item) {
					if ($item['vchparentid'] && isset($itemsByReference[$item['vchparentid']])) {
						$itemsByReference [$item['vchparentid']]['children'][] = &$item;
					}
				}

				// Remove items that were added to parents elsewhere:
				foreach($data as $key => &$item) {
					if ($item['vchparentid'] && isset($itemsByReference[$item['vchparentid']])) {
						unset($data[$key]);
					}
				}echo '<pre>';print_r($data);die;
				echo json_encode($data);
			}else{
				$data[]='No data available';
				echo json_encode($data);
			}
		
	}
  
  public function Accounttree()
  {
      if($this->session->userdata("session_role") == "admin")
        {
            $pro_data["project_info"] = $this->mm->fetch_project_info();

            $data = [];
            $table = "account_tree";
            $options = ['parentid' => 0];
            $options = ['accid' => 1];
           
            //$this->getAllToShow();
            //$account_tree = $this->am->accounts_hierarchy($table, $options);
            $account_tree = $this->am->getAccountTree();
            //echo '<pre>';print_r($account_tree);echo '</pre>';

            // Generate the HTML tree structure
            $treeHTML = $this->generateTreeHTML($account_tree, 'acc0', 'tree');


            $data['treeHTML'] = $treeHTML;

            $formlists = [
                'GR' => 'General Receipt', 
                'MV' => 'Main Cash Voucher', 
                'JV' => 'Journal Voucher', 
                'FV' => 'Fixed Deposit Voucher', 
                'BV' => 'Bank Deposit Voucher',
                'DV' => 'Direct Debit / Credit in Bank Statement',
                'TV' => 'T.D.S Entries'                
            ];

            $data['formlists'] = $formlists;

            $this->load->view("header",$pro_data);
            $this->load->view("accountree", $data);
            
            //$this->load->view("account/index", $data);
            $this->load->view("footer",$pro_data);
        }
        else
        {
            redirect("login");
        }
  }
  
  public function fetch_main_ledgers()
  {
        if($this->session->has_userdata('logged_in')) 
        {  
           $res = $this->am->fetch_main_ledgers();
           echo json_encode($res);
        }
  }
  
  public function fetch_main_sub_ledgers()
  {
        if($this->session->has_userdata('logged_in')) 
        {  
           $res = $this->am->fetch_main_sub_ledgers();
           echo json_encode($res);
        }
  }
  
  
  
  
  public function add_sub_ledger()
  {
       if($this->session->has_userdata('logged_in')) 
       { 
           $main_ledger_id = $this->input->post("main_ledger_id");
           $sub_ledger_name = $this->input->post("sub_ledger_name");
           $add_type = $this->input->post("add_type");

           $acc_id = $this->am->get_last_acc_id();
           $accid = $acc_id->accid+1;
           $vchaccid = "acc".$accid;
           $parent_id = substr($main_ledger_id,3);
           
           if($main_ledger_id == "acc1" || $main_ledger_id == "acc2" || $main_ledger_id == "acc3" || $acc_id  =="acc3" || $acc_id  =="acc4")
           {
               $charactertype = "1";
               
               $data = array(
                       "accid" =>$accid,
                       "vchaccid" =>$vchaccid,
                       "vch" =>"acc",
                       "vchaccname" =>$sub_ledger_name,
                       "vchparentid" =>$main_ledger_id,
                       "parentid" => $parent_id,
                       "chracctype" =>$charactertype,
                       "cr_dr_status" =>$add_type,
                   );
                 $res = $this->am->add_sub_ledger($data);
                 $res0 = $this->am->add_sub_ledger_orc($data);
                echo "success";
           } 

       }
  }
  
  public function fetch_all_sub_ledgers()
  {
       if($this->session->has_userdata('logged_in')) 
       {
           $main_ledger = $this->input->post("main_ledger");
           $res = $this->am->fetch_all_sub_ledgers($main_ledger);
           echo json_encode($res);
       }
  }
  
  public function add_multi_sub_ledger()
  {
      if($this->session->has_userdata('logged_in')) 
       {
           $main_ledger_id = $this->input->post("main_ledger_id");
           $sub_ledger_id = $this->input->post("add_sub_ledger_id");
           $acc_name = $this->input->post("add_acc_name");
           $add_type = $this->input->post("add_type");
           $tree_type = $this->input->post("tree_type");
           $lastid = $this->am->get_last_acc_id();
           
           
            $accid = $lastid->accid+1;
            $vchaccid =  "acc".$accid;
           
           if($main_ledger_id != "" && $sub_ledger_id != "")
           {
                $parent_id = substr($sub_ledger_id,3);
                $vchparentid = $sub_ledger_id;
           }
           else if($main_ledger_id != "" && $sub_ledger_id == "")
           {
                $parent_id = substr($main_ledger_id,3);
                $vchparentid = $main_ledger_id;
           }
          
           
            $data = array(
               "accid" =>$accid,
               "vch" =>"acc",
               "vchaccid" =>$vchaccid,
               "vchaccname" =>$acc_name,
               "vchparentid" =>$vchparentid,
               "parentid" =>$parent_id,
               "chracctype" =>$tree_type,
               "cr_dr_status" =>$add_type,
            );
            $res = $this->am->add_sub_ledger($data);
            $res0 = $this->am->add_sub_ledger_orc($data);
           echo "success";
       }
  }
  
  public function fetch_accounts_tree()
  {
      if($this->session->has_userdata('logged_in')) 
      {
            $draw = intval($this->input->post("draw"));
    		
    		$res = $this->am->fetch_account_tree();
    	
    		$arr = []; 
            $a = 0 ;
            
            foreach($res as $da)
            {
                $a++;
                
              $account_id = "<a href='#' onclick=view_data('".$da->vchaccid."')>".$da->vchaccname."</a>";
                
                $arr[] =  
                        array(
                            $a,
                            $account_id,
                            $da->vchaccid,
                            $da->numaccbalance,
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
  
  public function get_child_account_tree()
  {
      if($this->session->has_userdata('logged_in')) 
      {
          $accid = $this->input->post("accid");
          
          $data = $this->am->get_account_details($accid);
          $res = $this->am->get_child_account_tree($accid);
          
          $content = "";
          $content .= "<h4 style='font-size:14px;'>".$data->vchaccname."</h4>";
          $content .= "<table class='table table-bordered' width='100%'>";
                         
              $content .= "<thead>
                                    <tr>
                                        <th>S.no</th>
                                        <th>Account Id</th>
                                        <th>Account Name</th>
                                    </tr>
                           </thead>";    
                           
                           
                $a = 0;
                
                foreach($res as $da){
                    
                    $a++;
                    $content .= "<tr>
                                  <td>".$a."</td>
                                  <td><a href='#' onclick=view_data_1('".$da->vchaccid."')>".$da->vchaccname."</a></td>
                                  <td>".$da->vchaccname."</td>
                                  <div id='sub_data'></div>
                              </tr>";
                }
              $content .= "</table>";
              
             echo $content;
      }
  }
  
  
  public function general_receipt()
  {
      if($this->session->userdata("session_role") == "admin")
      {
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            
            //$data["agentpayment_no"] =$this->am->get_account_head_for_general_receipt();//$this->am->get_agentpayment_id();
            $options = ["forms like '%GR%'" => null, "parentid !=" => "0", "chracctype" => "2"];
		
            $data["agentpayment_no"] =$this->am->get_account_head_for_general_receipt($options);//$this->am->get_agentpayment_id();
            
            $data["account_number"] =$this->am->get_bank_details();
            $data["bank_acc_no"] = $this->am->get_account_agent();
            $data["bank_name"] = $this->am->fetch_bank_detalis();
            $this->load->view("header",$pro_data);
            $this->load->view("general_receipt",$data);
            $this->load->view("footer",$pro_data);
      }
      else
      {
          redirect("login");
      }
  }
  
  public function getAccountInfo()
  {
      $info = [];
      if($this->session->has_userdata('logged_in'))
      {
          $account_id = $this->input->get('account_id');
          if( isset( $account_id ) && !empty( $account_id ) ){
              $result = $this->am->get_account_number($account_id);
              if( isset ( $result ) && !empty( $result ) ) {
                  $info =  $result;
              }
          }
      }
      echo json_encode($info);
      die();
  }
  
  
  public function _add_general_receipt()
  {
      if($this->session->has_userdata('logged_in')) 
      {
        $account_head = $this->input->post("account_head");
        $date = $this->input->post("date");
        $particulars = $this->input->post("particulars");
        $amount = $this->input->post("amount");
        $narration = $this->input->post("narration");
        $paymode = $this->input->post("paymode");
        $bank  = $this->input->post("bank");
        $bank_branch = $this->input->post("bank_branch");
        $cheque_no = $this->input->post("cheque_no");
        $transaction_no  = $this->input->post("transaction_no");
        $trans_date = $this->input->post("trans_date");
        
        $date = date("Y-m-d H:i:s");
        $year = date('y');
        $month = date('m');
                
        if($month < 4)
        {
           $year = $year-1;
        }
        
        $x = 0;
        
        do 
        {
          $x++;
          $gr_no = "gr".$x."/".$year;
        } 
        while($this->am->check_receipt_no_already_exits($gr_no));
       
          $data = array(
              "receipt_no" =>$gr_no,
              "account_id" =>$account_head, 
              "particulars" =>$particulars,
              "amount" =>$amount,
              "pay_mode" =>$paymode,
              "transaction_date" =>$trans_date,
              "narration" =>$narration,
              "bank" =>$bank,
              "branch" =>$bank_branch,
              "cheque_no" =>$cheque_no,
              "transaction_no"  =>$transaction_no,
              "date_time" =>$date,
          );
          $res = $this->am->add_general_receipt($data);
          
          //$this->credit_cash_entry($particulars,$amount);
          
          echo $gr_no;
      }
  }
  
 
  public function add_general_receipt()
  {
      if($this->session->has_userdata('logged_in')) 
      {
        $response = [
            'status'    => false,				
            'msg'       => 'unable to add GR'
        ];

        
        $account_head = $this->input->post("account_head");
        $date = $this->input->post("date");
        $particulars = $this->input->post("sub_category");
        $amount = $this->input->post("amount");
        $narration = $this->input->post("narration");
        $paymode = $this->input->post("paymode");
        $bank  = $this->input->post("bank");
        $bank_branch = $this->input->post("bank_branch");
        $cheque_no = $this->input->post("cheque_no");
        $transaction_no  = $this->input->post("transaction_no");
        $trans_date = $this->input->post("trans_date");
        
        $date = date("Y-m-d H:i:s");
        $year = date('y');
        $month = date('m');
                
        if($month < 4)
        {
           $year = $year-1;
        }
        
        

        $gr_no = $this->am->getMaxSRNo("GR", "general_receipt", $year );

        $particulars = (empty($particulars)) ? "acc9" : $particulars;
       
          $data = array(
              "receipt_no" =>$gr_no,
              "account_id" =>$account_head, 
              "particulars" =>$particulars,
              "amount" =>$amount,
              "pay_mode" =>$paymode,
              "transaction_date" =>$trans_date,
              "narration" =>$narration,
              "bank" =>$bank,
              "branch" =>$bank_branch,
              "cheque_no" =>$cheque_no,
              "transaction_no"  =>$transaction_no,
              "date_time" =>$date,
          );

        $res = $this->am->add_general_receipt($data);
        
          if($res) {
                

            //$this->credit_cash_entry($particulars,$amount);

            $acctype = $this->mm->get_paymode_chracctype($particulars);
              

            if($acctype->chracctype == "1")
            {											
                $data2 = [
                    "sr_no" 		=> $gr_no,
                    "cr_parent_id" 	=> $account_head,
                    "credit" 		=> $amount,                    
                    "dr_parent_id" 	=> $particulars,
                    "note" 			=> $narration,
                    "datetime" 		=> $date
                ];									
            }
            else if($acctype->chracctype == "3")
            {
                $data2 = [
                    "sr_no" 		=> $gr_no,
                    "dr_parent_id" 	=> $account_head,
                    "debit" 		=> $amount,                   
                    "cr_parent_id" 	=> $particulars,
                    "note" 			=> $narration,
                    "datetime" 		=> $date
                ];
            }
            
            if(isset($data2) && !empty($data2)) {
                $res2 = $this->am->add_acc_commission_ledger($data2);  
                if($cheque_no != ""){
                    $chequeEntry = [
                        "cheque_number" =>$cheque_no,
                        "bank_name" =>$bank,
                        "date" =>$date,
                        "amount"=>$amount,                                    
                        //"depostite_date" =>$depostite_date,
                        "created_by" =>$this->session->userdata("session_id"),
                        "created_at" =>date("Y-m-d H:i:s"),
                    ];
                    $res = $this->am->add_cheque_entry($chequeEntry);
                }
            }

            $response = [
                'status'    => true,						
                'msg'       => 'Successfully added GR. No. '.$gr_no
            ];

          }
          
        
                  

        echo json_encode($response);
      }
  }
  
  public function print_general_receipt()
  {
       if($this->session->has_userdata('logged_in')) 
      {
          $gr_no = $this->input->get("gr_no");
          $company_details = $this->rm->get_company_details();
          $res = $this->am->print_general_receipt($gr_no);
          $acc_name = $this->am->get_account_name($res->account_id);
          $particulars = $this->am->get_account_name($res->particulars);
          
               $content = "<!DOCTYPE html>
                                    <html>
                                    <head>
                                        <title>Receipt Id : ".$gr_no." </title>
                                        <style>
                                            *{
                                                padding:1px;
                                                margin:0px;
                                                font-family: 'Courier';
                                                font-size:12px;
                                            }
                                        </style>
                                    </head>
                                    <body>
                                        <div style='border:1px solid #aaa;padding:10px;margin:30px;'>
                                        <center><p style='font-size:20px;padding-top:0px;'>General Receipt</p></center>
                                        <table style='width:100%'>
                                            <tr>
                                                <td style='padding:15px;'>
                                                    <p style='margin-top:5px;font-size:17px;'>".$company_details->name."</p>
                                                    <p style='margin-top:5px;'>".$company_details->city."</p>
                                                 </td>
                                                <td style='text-align: right;padding:15px;'>
                                                    <p style='margin-top:5px;'><img src='./datas/temp/phone-icon.PNG' style='width:12px;'> +91 ".$company_details->phone." </p>
                                                    <p style='margin-top:5px;'><img src='./datas/temp/email-icon.PNG' style='width:12px;'> ".$company_details->email." </p>
                                                    <br>
                                                </td>
                                            </tr>
                                        </table>";
                                        
                                        
                            $content .= "<table style='width:100%;>
                                            <tr>
                                                <td style='width:25%;padding:5px;text-align: left;'></td>
                                                <td style='width:25%;padding:5px;text-align: left;'></td>
                                                <td style='width:25%;padding:5px;text-align: right;'></td>
                                                <td style='width:25%;padding:5px;text-align: right;'>Date  : ".date_format(date_create($res->transaction_date),"d-m-Y")."</td>
                                            </tr>";
                                      
                            $content .= "</table>";
                            
                            
                            $content .= "<h4 align='center' style='background-color:#dff0d8;padding:5px;'>Payment Details</h4>";
                            
                            $content .= "<table style='width:100%;'>
                                          
                                           <tr>
                                                <td style='width:25%;padding:5px;text-align: left;'>Account Head</td>
                                                <td style='width:25%;padding:5px;text-align: center;'>:</td>
                                                <td style='width:25%;padding:5px;text-align: right;'>".$acc_name->account_name."</td>
                                           </tr>
                                           
                                            <tr>
                                                <td style='width:25%;padding:5px;text-align: left;'>Pariculars</td>
                                                <td style='width:25%;padding:5px;text-align: center;'>:</td>
                                                <td style='width:25%;padding:5px;text-align: right;'>".$particulars->account_name."</td>
                                           </tr>
                                           
                                          <tr>
                                                <td style='width:25%;padding:5px;text-align: left;'>Pay Mode</td>
                                                <td style='width:25%;padding:5px;text-align: center;'>:</td>
                                                <td style='width:25%;padding:5px;text-align: right;'>".$res->pay_mode."</td>
                                           </tr>";
                                           
                                        if($res->pay_mode != "Cash")
                                           {
                                            $content .= " <tr>
                                                            <td style='width:25%;padding:5px;text-align: left;'>Bank</td>
                                                            <td style='width:25%;padding:5px;text-align: center;'>:</td>
                                                            <td style='width:25%;padding:5px;text-align: right;'>".$res->bank."</td>
                                                          </tr>
                                                   
                                                        <tr>
                                                            <td style='width:25%;padding:5px;text-align: left;'>Branch</td>
                                                            <td style='width:25%;padding:5px;text-align: center;'>:</td>
                                                            <td style='width:25%;padding:5px;text-align: right;'>".$res->branch."</td>
                                                        </tr>";
                                                        
                                                if($res->pay_mode == "Cheque")
                                                {
                                                     $content .= " <tr>
                                                            <td style='width:25%;padding:5px;text-align: left;'>Cheque</td>
                                                            <td style='width:25%;padding:5px;text-align: center;'>:</td>
                                                            <td style='width:25%;padding:5px;text-align: right;'>".$res->cheque_no."</td>
                                                          </tr>";
                                                }
                                                else if($res->pay_mode == "Transfer")
                                                {
                                                    $content .= " <tr>
                                                            <td style='width:25%;padding:5px;text-align: left;'>Transaction no</td>
                                                            <td style='width:25%;padding:5px;text-align: center;'>:</td>
                                                            <td style='width:25%;padding:5px;text-align: right;'>".$res->transaction_no."</td>
                                                          </tr>";
                                                }
                                           }
                                           
                                           $content .= "<tr>
                                                <td style='width:25%;padding:5px;text-align: left;'>Amount</td>
                                                <td style='width:25%;padding:5px;text-align: center;'>:</td>
                                                <td style='width:25%;padding:5px;text-align: right;'>".$res->amount."</td>
                                           </tr>
                                           
                                            <tr>
                                                <td style='width:25%;padding:5px;text-align: left;'>Narrations</td>
                                                <td style='width:25%;padding:5px;text-align: center;'>:</td>
                                                <td style='width:25%;padding:5px;text-align: right;'>".$res->narration."</td>
                                           </tr>";
                                  
                      
                            $content .= "</table>";
                            $this->load->library('pdf');
                            $this->pdf->loadHtml($content);
                            $this->pdf->render();
                            $filename = "Gr_receipt('".$gr_no."')";
                            $this->pdf->stream("'$filename'".".pdf", array("Attachment" => false));
      }
  }
  
  
  public function main_cash_voucher()
  {
      if($this->session->userdata("session_role") == "admin")
      {
            // $pro_data["project_info"] = $this->mm->fetch_project_info();
            // $data["account_head"] =$this->am->get_account_head_for_general_receipt();
            // $data["sub_category"] = $this->am->fetch_sub_category();
            // $data["cheque_number"] = $this->am->fetch_cheque_number();
            // $this->load->view("header",$pro_data);
            // $this->load->view("main_cash_voucher",$data);
            // $this->load->view("footer",$pro_data);
            
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $options = ["forms like '%MV%'" => null, "parentid !=" => "0", "chracctype" => "2"];		
            $data["account_head"] =$this->am->get_account_head_for_general_receipt($options);  
            $data["sub_category"] = $this->am->fetch_sub_category();
            $data["cheque_number"] = $this->am->fetch_cheque_number();
            $data["account_number"] =$this->am->get_bank_details();
            $this->load->view("header",$pro_data);
            $this->load->view("main_cash_voucher",$data);
            $this->load->view("footer",$pro_data);
      }
      else
      {
          redirect("login");
      }
  }
 
 
     public function credit_cash_entry($particulars,$amount)
     {
          if($this->session->has_userdata('logged_in')) 
          {
              $check_amt = $this->am->get_cash_entry($particulars);
              $balance_amt = $check_amt->numaccbalance + $amount;
              $data = array("numaccbalance" =>$balance_amt);
              $res = $this->add_credit_cash_entry($data,$particulars);
              //echo "success";
          }
     }
     
     public function add_mv_receipt()
     {
          if($this->session->has_userdata('logged_in')) 
          {
                $account_head = $this->input->post("account_head");
                $date = $this->input->post("date");
                $sub_category = $this->input->post("sub_category");
                $amount = $this->input->post("amount");
                $narration = $this->input->post("narration");
                $paymode = $this->input->post("paymode");
                $cash_release = $this->input->post("cash_release");
                $bank  = $this->input->post("bank");
                $bank_branch = $this->input->post("bank_branch");
                $cheque_no = $this->input->post("cheque_no");
                $transaction_no  = $this->input->post("transaction_no");
                $trans_date = $this->input->post("trans_date");
                
                
                $date = date("Y-m-d H:i:s");
                $year = date('y');
                $month = date('m');
                
               

                if($month < 4)
                {
                   $year = $year-1;
                }
                
                $x = 0;
                
                $another_head ="";
                $bank_id ="";
                
                if($cash_release == "Petty_Cash")
                {
                    $another_head = "acc10";
                    do 
                    {
                      $x++;
                      $mv_no = "PC".$x."/".$year;
                    } 
                    while($this->am->check_pc_receipt_no_already_exits($mv_no));
                }
                else 
                {
                    $another_head = "acc9";
                    do 
                    {
                      $x++;
                      $mv_no = "MV".$x."/".$year;
                    } 
                    while($this->am->check_mv_receipt_no_already_exits($mv_no));
                }
                 
               if($paymode == "Cheque" || $paymode == "Transfer")
               {
                   $another_head = "acc11";
               }

                  $data = array(
                      "receipt_no" =>$mv_no,
                      "account_id" =>$account_head, 
                      "sub_category" =>$sub_category,
                      "debit" =>$amount,
                      "pay_mode" =>$paymode,
                      "transaction_date" =>$trans_date,
                      "narration" =>$narration,
                      "bank" =>$bank,
                      "branch" =>$bank_branch,
                      "cheque_no" =>$cheque_no,
                      "transaction_no"  =>$transaction_no,
                      "date_time" =>$date,
                  );
                  
                   $res = $this->am->add_mv_receipt($data);
                   
                    $acctype = $this->am->get_paymode_chracctype($sub_category);
                    
                if($acctype->chracctype == "1")
                {
                   
                    
                     $data2 = array(
                                   "sr_no" => $mv_no,
                                    "cr_parent_id" =>$account_head,
                                    "credit" =>$amount,
                                    "dr_parent_id" => $another_head,
                                    "note" =>$narration,
                                    "datetime" =>$date);
                }
                else if($acctype->chracctype == "2")
                {
                   $data2 = array(
                                   "sr_no" => $mv_no,
                                    "dr_parent_id" =>$account_head,
                                    "debit" =>$amount,
                                    "cr_parent_id" => $another_head,
                                    "note" =>$narration,
                                    "datetime" =>$date);
                }            
                                    
                   $res2 = $this->am->add_acc_commission_ledger($data2);                    
                  
                    if($res && $cheque_no != ""){


                        $data1 = array (
                                         "amount" =>$amount,
                                         "cheque_using_date" =>$trans_date,
                                         "status" =>"U",
                                         "vchaccid" =>$sub_category);
                                         
                                         
                       $res1 = $this->am->update_cheque_book($data1,$cheque_no);                     
                    }
                   
                 
                    if($paymode == "Cash")
                    { 
                      $this->calc_cash_balance($amount,$cash_release);
                    }
                    else 
                    {
                        $this->calc_cash_balance($amount,"");
                    }
                  
                  echo $mv_no;
          }
     }
     
     public function fetch_cash_balance()
     {
          if($this->session->has_userdata('logged_in')) 
          {
              $res = $this->am->fetch_cash_balance();
              echo json_encode($res);
          }
     }
     
     public function calc_cash_balance($amount,$cash_release)
     {
          if($this->session->has_userdata('logged_in')) 
          {
              if($cash_release == "Petty_cash")
              {
                  $petty_cash = $this->get_petty_cash_amount();
                  $balance = $petty_cash - $amount;
                  
                  $array = array("numaccbalance" =>$balance);
                  $res = $this->update_pettycash_balance($array);
              }
              else 
              {
                  
              }
          }
     }
     
      
	  public function view_accounts_ledger()
	  {
	      if($this->session->has_userdata('logged_in')) 
           {
                $pro_data["project_info"] = $this->mm->fetch_project_info();
                $data["data"] =$this->am->get_sub_ledgers();
        		$this->load->view('header',$pro_data);
        		$this->load->view('view_ledger_accounts',$data);
        		$this->load->view('footer',$pro_data);
           }
	  }
	  
        public function fetch_view_accounts_ledger()
        {
            if($this->session->has_userdata('logged_in')) 
            {
                $acc_head = $this->input->post("acc_head");
                $acc_sub = $this->input->post("acc_sub_category");
                $from_date = $this->input->post("f_date");
                $to_date = $this->input->post("to_date");
                $lead_id = $this->input->post("lead_id");
                $methods = $this->input->post("methods");
                $agent_id   = "";
                $notes = "1";
                
                $today = new DateTime();
                
                $from_date  = (!$from_date) ? $today->format('Y-m-01') : $from_date;
                $to_date    = (!$to_date) ? $today->format('Y-m-d') : $to_date;
                
               /*
               if($acc_head == "" && $acc_sub != "")
               {
                   $data = $this->am->fetch_agent_id($acc_sub);
                   $acc_sub = $data->agent_id;
               }*/
               
               if($acc_head != "")
               {
                   $data = $this->am->fetch_agent_id($acc_head);
                    if(isset($data->agent_id) && !empty($data->agent_id)) {
                        $agents = $this->am->fetch_agent_category($data->agent_id);
                        $notes = (isset($agents) && !empty($agents)) ? "" : $notes;
                       
                    }
               }

               if($acc_sub != "")
               {
                   $data = $this->am->fetch_agent_id($acc_sub);
                   $acc_sub = (isset($data->agent_id) && !empty($data->agent_id)) ? "" : $acc_sub;
                   $agent_id = $data->agent_id;
               }
               
               $res0 = $this->am->fetch_acc_name_by_accid($acc_head);
              
                if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") {  
                    $res = $this->am->fetch_view_accounts_ledger($acc_head,$acc_sub,$from_date,$to_date,$lead_id, $agent_id, $notes, $methods);
                } else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn") {
                    $res1 = $this->am->fetch_view_accounts_ledger_orc($acc_head,$acc_sub,$from_date,$to_date,$lead_id, $agent_id, $notes, $methods);
                }
               
               
              
              if($acc_head != "")
              {
                  $content = "<h4 align='center'>".$res0->vchaccname." A/C</h4>";
              }
              else 
              {
                  $content = "<h4 align='center'>Accounts Ledgers</h4>";
              }
               
               
               $content .="<table class = 'table table-bordered' style='width:100%'>
                            <thead>
                                 <tr>
                                      <th>S.no</th>
                                      <th>Acc Sr No</th>
                                      <th>Account Name</th>
                                      <th style='text-align:right'>Credit</th>
                                      <th style='text-align:right'>Debit</th>
                                      <th style='text-align:right'>Balance</th>
                                      <th>Lead ID</th>
                                      <th>Reason</th>
                                      <th>DATE</th>
                                 </tr>
                            </thead>
                          <tbody>";
                            
                
                 $a = 0;
                 $balance = 0;
                 
                 $tot_cr = 0;
                 $tot_dr = 0;
                 $tot_balance = 0;
                 
                 $date = "";     
                 
    if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") 
            {     
                  
                 foreach($res as $da)
                 {
                    if($da->note == "Own commission Credit")
                    {
                        $data = $this->am->fetch_acc_name_by_accid($da->cr_parent_id);
                        $acc_name = $data->vchaccname;
                        $acc_id = $da->cr_parent_id;
                    }
                    else if($da->note == "Own commission Debit")
                    {
                        $data = $this->am->fetch_acc_name_by_agn_id($da->sub_id);
                        $acc_name = ( isset($data->vchaccname) && !empty($data->vchaccname) ) ? $data->vchaccname : "";
                        $acc_id = ( isset($data->vchaccid) && !empty($data->vchaccid) ) ? $data->vchaccid : "";
                    }
                    
                    
                    if($da->note == "Agent commission Credit")
                    {
                        $data = $this->am->fetch_acc_name_by_agn_id($da->sub_id);
                        $acc_name = $data->vchaccname;
                        $acc_id = $data->vchaccid; 
                    }
                  else if($da->note == "Agent commission Debit")
                    {
                        $data = $this->am->fetch_acc_name_by_agn_id($da->sub_id);
                        $acc_name = $data->vchaccname;
                        $acc_id = $data->vchaccid;
                    }
                    
                    $tot_cr = $da->credit + $tot_cr;
                    $tot_dr  = $da->debit + $tot_dr;
                    $balance = $tot_cr - $tot_dr;
                    $tot_balance = $balance + $tot_balance;

                    $a++;
                    
                    
                    $content .="<tr>
                                      <td>".$a."</td>
                                      <td>".$da->sr_no."</td>
                                      <td>".$acc_name." (".$acc_id.")</td>
                                      <td style='text-align:right'>".( ($acc_id == "acc21") ? floor($da->debit) : floor($da->credit) ).".00</td>
                                      <td style='text-align:right'>".( ($acc_id == "acc21") ? floor($da->credit) : floor($da->debit) ).".00</td>
                                      <td style='text-align:right'>".floor($balance).".00</td>
                                      <td>".$da->lead_id."</td>
                                      <td>".$da->note."</td>
                                      <td>".date_format(date_create($da->datetime),"d-m-Y h:i:s a")."</td>
                                 </tr>";
                 }
                 
               }
            
              else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
              { 
                 
                foreach($res1 as $da1)
                 {
                    if($da1->note == "Own commission Credit")
                    {
                        $data = $this->am->fetch_acc_name_by_accid($da1->cr_parent_id);
                        $acc_name = $data->vchaccname;
                        $acc_id = $da1->cr_parent_id;
                    }
                    else if($da1->note == "Own commission Debit")
                    {
                        $data = $this->am->fetch_acc_name_by_agn_id($da1->sub_id);
                        $acc_name = $data->vchaccname;
                        $acc_id = $data->vchaccid;
                    }
                    
                    $tot_cr = $da1->credit + $tot_cr;
                    $tot_dr  = $da1->debit + $tot_dr;
                    $balance = $tot_cr - $tot_dr;
                    
                    $tot_balance = $balance + $tot_balance;
                  
                    $a++;
                    
                    
                    $content .="<tr>
                                      <td>".$a."</td>
                                      <td>".$da1->sr_no."</td>
                                      <td>".$acc_name."(".$acc_id.")</td>
                                      <td style='text-align:right'>".( ($acc_id == "acc21") ? floor($da->debit) : floor($da->credit) ).".00</td>
                                      <td style='text-align:right'>".( ($acc_id == "acc21") ? floor($da->credit) : floor($da->debit) ).".00</td>
                                      <td style='text-align:right'>".floor($balance).".00</td>
                                      <td>".$da1->lead_id."</td>
                                      <td>".$da1->note."</td>
                                      <td>".date_format(date_create($da1->datetime),"d-m-Y h:i:s a")."</td>
                                 </tr>";
                 }
              }
                 
                $content .="<tr>
                          <td></td>
                          <td></td>
                          <td><b>Total</b></td>
                          <td style='text-align:right'><b>".( ($acc_head == "acc21") ? floor($tot_dr) : floor($tot_cr) ).".00</b></td>
                          <td style='text-align:right'><b>".( ($acc_head == "acc21") ? floor($tot_cr) : floor($tot_dr) ).".00</b></td>
                          <td style='text-align:right'><b>".floor($balance).".00</b></td>
                          <td></td>
                          <td></td>
                          <td></td>
                </tr>";

               $content .="</table>";
               echo $content;
           }
	  }
	  
	    // view company commission ledger start
    public function view_company_ledger()
    {
        if($this->session->has_userdata('logged_in')) 
        {
            $pro_data["project_info"] = $this->mm->fetch_project_info();            
            $data["companyName"] =$this->am->get_account_company();
            $today = new DateTime();
            $data['startdate']  = $today->format('Y-m-01');
            $data['enddate']    = $today->format('Y-m-d');

            $this->load->view('header',$pro_data);
            $this->load->view('view_company_commission_ledger',$data);
            $this->load->view('footer',$pro_data);
        }
    }
    
    public function fetch_view_company_ledger()
    {
        if($this->session->has_userdata('logged_in')) 
        {
            $fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY); 
            $company_id = $this->input->post("company_id");              
            $fromdate = $this->input->post("fromdate");
            $todate = $this->input->post("todate");
            $methods = $this->input->post("methods");
                                         
            $org_id = "1";
            if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
                $org_id = "2";
           
            $result = $balresult = [];
            if($org_id == "1") {
                $result = $this->am->getCompanyCommissionLedger($company_id,$fromdate,$todate, "acc_commission_ledger", $methods);
                $balresult = $this->am->AccBalance($company_id,$fromdate, $todate, $methods);
            } elseif ($org_id == "2") {
                $result = $this->am->getCompanyCommissionLedger($company_id,$fromdate,$todate, "acc_commission_ledger_orc", $methods);
                $balresult = $this->am->AccBalance_orc($company_id,$fromdate, $todate, $methods);
            }
            //echo $this->db->last_query();
            //die();
            if($result) {
                foreach( $result as $row ) {
                    $company[$row->insurer_id]     = $row->companyName;
                    $results[$row->insurer_id][]  = $row;
                    $Compbal[$row->insurer_id]          = 0;
                }
            }  
            if($balresult) {
                foreach( $balresult as $_row ) {
                    $compbal[$_row->insurer_id] = $_row->balance;
                }
            }
           // print_r($result);die();
?>               

            <section class="content">
                <div class="box">
                    <div class="box-body">
                        <div class="col-md-12">                            
                            <table class="table table-bordered" width="100%">
                                <thead style="background-color: white;">
                                                                        
                                    <tr>
                                        <th style="width:15%;"><b> Date </b></th>
                                        <th style="width:25%;"><b> Particulars </b></th>
                                        <th style="width:5%;"><b> DR or CR </b></th>                                            
                                        <th style="width:10%;text-align:right"><b> Debit </b></th>
                                        <th style="width:10%;text-align:right"><b> Credit </b></th>                                            
                                        <th style="width:10%;text-align:right"><b> Balance </b></th>                                            
                                    </tr>
                                </thead>
                                <tbody style="background-color: white;">
                                <?php $gtot_cr = $gtot_dr = 0; ?>
                                <?php if(isset($company) && !empty( $company ) ):?>    
                                    <?php foreach( $company as $company_id => $companyName):?>
                                        <?php 
                                            $tot_cr = $tot_dr = 0; 
                                            if(!isset($compbal[$company_id])) {
                                                $compbal[$company_id] = 0;
                                            }
                                        ?>
                                        <tr>
                                            <th colspan="5">Company : <?=$companyName?></th>
                                            <th style="text-align:right">
                                                <?php                                                     
                                                    $bal = (isset($compbal[$company_id])) ? $compbal[$company_id] : 0;
                                                    echo $fmt->formatCurrency(is_numeric($bal) ? $bal : 0, "INR");
                                                ?>
                                            </th>
                                        </tr>                                    
                                        <?php if(isset($company) && !empty( $company ) ):?>    
                                            <?php $sl = 1;?>
                                            <?php if(isset($results[$company_id]) && !empty( $results[$company_id] ) ):?>   
                                                <?php foreach($results[$company_id] as $row):?>                                                
                                                    <?php $tot_cr +=$row->credit; $tot_dr += $row->debit + $row->tds; ?>
                                                    <?php $gtot_cr +=$row->credit; $gtot_dr += $row->debit + $row->tds; ?>

                                                    <!-- Company Commission (DR) ROW //--->
                                                    <?php if($row->credit > 0):?>
                                                        <tr>
                                                            <td>                                                            
                                                                <?php 
                                                                    $crdate = new DateTime((($methods == "account_post_data") ? $row->datetime : $row->policy_date));
                                                                ?>
                                                                <?=$crdate->format('d-m-Y')?>
                                                            </td>
                                                            <td><?=$row->name?> <?=(isset($row->sub_id)) ? $row->sub_id : ""?></td></td>
                                                            <td> DR </td>
                                                            
                                                            <td style="text-align:right">
                                                                <?=$fmt->formatCurrency($row->credit, "INR")?>
                                                                <?php $compbal[$company_id] += (isset($row->credit)) ? $row->credit : 0;?>
                                                            </td>
                                                            <td style="text-align:right"> <?=$fmt->formatCurrency(0, "INR")?> </td>
                                                            <td style="text-align:right"> 
                                                                <?php $bal = (isset($compbal[$company_id])) ? $compbal[$company_id] : 0?>
                                                                <?=$fmt->formatCurrency(is_numeric($bal) ? $bal : 0, "INR")?>
                                                            </td>                                                                                   
                                                        </tr>
                                                    <?php endif;?>

                                                    <!-- TDS ROW //--->
                                                    <?php if($row->tds > 0):?>
                                                        <tr>                                                        
                                                            <td>
                                                                <?php $dtdate = new DateTime($row->datetime);?>
                                                                <?=$dtdate->format('d-m-Y')?>
                                                            </td>
                                                            <td>TDS Payable <?=(isset($row->sub_id)) ? $row->sub_id : ""?></td>
                                                            <td> CR </td>             
                                                            <td style="text-align:right"><?=$fmt->formatCurrency(0, "INR")?></td>                                           
                                                            <td style="text-align:right">                                                        
                                                                <?=$fmt->formatCurrency($row->tds, "INR")?>                                                        
                                                                <?php $compbal[$company_id] -= (isset($row->tds)) ? $row->tds : 0;?>
                                                            </td>                                                        
                                                            <td style="text-align:right">
                                                                <?php $bal = (isset($compbal[$company_id])) ? $compbal[$company_id] : 0?>
                                                                <?=$fmt->formatCurrency(is_numeric($bal) ? $bal : 0, "INR")?>
                                                            </td>
                                                        </tr>
                                                    <?php endif;?>


                                                    <!-- Company Commission Payable (CR) ROW //--->
                                                    <?php if($row->debit > 0):?>
                                                        <tr>                                                        
                                                            <td>
                                                                <?php $dtdate = new DateTime($row->datetime);?>
                                                                <?=$dtdate->format('d-m-Y')?>
                                                            </td>
                                                            <td><?=$row->name?> <?=(isset($row->sub_id)) ? $row->sub_id : ""?></td>
                                                            <td> CR </td>                    
                                                            <td style="text-align:right"><?=$fmt->formatCurrency(0, "INR")?></td>

                                                            <td style="text-align:right">                                                        
                                                                <?=$fmt->formatCurrency($row->debit, "INR")?>                                                        
                                                                <?php $compbal[$company_id] -= (isset($row->debit)) ? $row->debit : 0;?>
                                                            </td>
                                                            
                                                            <td style="text-align:right">
                                                                <?php $bal = (isset($compbal[$company_id])) ? $compbal[$company_id] : 0?>
                                                                <?=$fmt->formatCurrency(is_numeric($bal) ? $bal : 0, "INR")?>
                                                            </td>
                                                        </tr>
                                                    <?php endif;?>

                                                <?php endforeach;?>
                                            <?php endif;?>
                                        <?php endif;?>
                                        <tr>
                                            <td colspan="3" align="right"><b> Total Amount </b></td>                                                
                                            <td align="right"><b><?=$fmt->formatCurrency(is_numeric($tot_cr) ? $tot_cr : 0, "INR")?> </b></td>
                                            <td align="right"><b><?=$fmt->formatCurrency(is_numeric($tot_dr) ? $tot_dr : 0, "INR")?> </b></td>                                            
                                            <td align="right">
                                                <b>
                                                    <?php $bal = (isset($compbal[$company_id])) ? $compbal[$company_id] : 0?>
                                                    <?=$fmt->formatCurrency(is_numeric($bal) ? $bal : 0, "INR")?>
                                                </b>
                                            </td>
                                        </tr> 
                                    <?php endforeach;?>
                                <?php endif;?>                                                                                                                        
                                </tbody>
                                
                                <tfoot style="background-color: white;">
                                    <tr>
                                        <td colspan="3" align="right"><b> Grand Total Amount </b></td>                                        
                                        <td align="right"><b><?=$fmt->formatCurrency(is_numeric($gtot_cr) ? $gtot_cr : 0, "INR")?> </b></td>
                                        <td align="right"><b><?=$fmt->formatCurrency(is_numeric($gtot_dr) ? $gtot_dr : 0, "INR")?> </b></td>
                                    </tr>
                                </tfoot>
                            </table>

                            
                        </div>
                    </div>
                </div>
            </section>
<?php                            
        }
    }
// view company commission ledger end
	  
	public function view_agent_ledger()
    {
        if($this->session->has_userdata('logged_in')) 
        {
            $pro_data["project_info"] = $this->mm->fetch_project_info();            
            $data["data"] =$this->am->get_account_agent();
            $today = new DateTime();
            $data['startdate']  = $today->format('Y-m-01');
            $data['enddate']    = $today->format('Y-m-d');
            $data['subtitle']   = 'Jayantha';
            $this->load->view('header',$pro_data);
            $this->load->view('view_agent_commission_ledger',$data);
            $this->load->view('footer',$pro_data);
        }
    }
	  
    public function _fetch_view_agent_ledger()
    {
	       if($this->session->has_userdata('logged_in')) 
           {
               $agent_id = $this->input->post("agent_id");              
               $fromdate = $this->input->post("fromdate");
               $todate = $this->input->post("todate");
               $lead_id = $this->input->post("lead_id");
               
               
            //    if($acc_head == "" && $acc_sub != "")
            //    {
            //        $data = $this->am->fetch_agent_id($acc_sub);
            //        $acc_sub = $data->agent_id;
            //    }
               
                // $res0 = $this->am->fetch_acc_name_by_accid($acc_head);

                $org_id = "1";
                if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
                    $org_id = "2";
              
                $result = [];
                if($org_id == "1")
                    $result = $this->am->getAgentCommissionLedger($agent_id,$fromdate,$todate,$lead_id, "agent_voucher_details", "agent_commission_transaction");
                elseif ($org_id == "2") 
                    $result = $this->am->getAgentCommissionLedger($agent_id,$fromdate,$todate,$lead_id, "agent_voucher_details_orc", "agent_commission_transaction_orc");

                //echo $this->db->last_query();

                if($result) {
                    foreach( $result as $row ) {
                        $agents[$row->agent_id] = $row->name. '('.$row->agent_pos_code.')';
                        $results[$row->agent_id][] = $row;
                    }
                }
                
?>               

                <section class="content">
                    <div class="box">
                        <div class="box-body">
                            <div class="col-md-12">                            
                                <table class="table table-bordered" width="100%">
                                    <thead style="background-color: white;">
                                                                          
                                        <tr>
                                            <th style="width:15%;"><b> Date </b></th>
                                            <th style="width:25%;"><b> Particulars </b></th>
                                            <th style="width:5%;"><b> DR or CR </b></th>                                            
                                            <th style="width:10%;text-align:right"><b> Debit </b></th>
                                            <th style="width:10%;text-align:right"><b> Credit </b></th>                                            
                                        </tr>
                                    </thead>
                                    <tbody style="background-color: white;">
                                    <?php $gtot_cr = $gtot_dr = 0; ?>
                                    <?php if(isset($agents) && !empty( $agents ) ):?>    
                                        <?php foreach( $agents as $agent_id => $agent_name):?>
                                            <?php $tot_cr = $tot_dr = 0; ?>
                                            <tr>
                                                <th colspan="5">AGent : <?=$agent_name?></th>
                                            </tr>                                    
                                            <?php if(isset($agents) && !empty( $agents ) ):?>    
                                                <?php foreach($results[$agent_id] as $row):?>
                                                    <?php $tot_cr +=$row->credit; $tot_dr += $row->net_op; ?>
                                                    <?php $gtot_cr +=$row->credit; $gtot_dr += $row->net_op; ?>
                                                    <tr>
                                                        <td>
                                                            <?php $crdate = new DateTime($row->credit_dt);?>
                                                            <?=$crdate->format('d-m-Y')?>
                                                        </td>
                                                        <td>Agent Commission Expense <?=$row->voucher_no?></td>
                                                        <td> DR </td>                                                                                                
                                                        <td style="text-align:right"><?=$row->credit?></td>          
                                                        <td style="text-align:right"> 0 </td>                                      
                                                    </tr>
                                                    <tr>                                                        
                                                        <td>
                                                            <?php $dtdate = new DateTime($row->debit_dt);?>
                                                            <?=$dtdate->format('d-m-Y')?>
                                                        </td>
                                                        <td>Accounts Payable <?=$row->voucher_no?></td>
                                                        <td> CR </td>                                                                                                                                             
                                                        <td style="text-align:right">0</td>                                                
                                                        <td style="text-align:right"> <?=$row->net_op?> </td>
                                                    </tr>
                                                <?php endforeach;?>
                                            <?php endif;?>
                                            <tr>
                                                <td colspan="3" align="right"><b> Total Amount </b></td>
                                                <td align="right"><b> <?=$tot_cr?> </b></td>
                                                <td align="right"><b> <?=$tot_dr?> </b></td>                                            
                                            </tr> 
                                        <?php endforeach;?>
                                    <?php endif;?>                                                                                                                        
                                    </tbody>
                                    
                                    <tfoot style="background-color: white;">
                                        <tr>
                                            <td colspan="3" align="right"><b> Grand Total Amount </b></td>
                                            <td align="right"><b> <?=$gtot_cr?> </b></td>
                                            <td align="right"><b> <?=$gtot_dr?> </b></td>                                            
                                        </tr>
                                    </tfoot>
                                </table>

                                
                            </div>
                        </div>
                    </div>
                </section>
<?php                            
        }
    }
    
    public function fetch_view_agent_ledger()
    {
        if($this->session->has_userdata('logged_in')) 
        {
            $fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY); 
            $agent_id = $this->input->post("agent_id");              
            $fromdate = $this->input->post("fromdate");
            $todate = $this->input->post("todate");
            $lead_id = $this->input->post("lead_id");
                                         
            $org_id = "1";
            if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
                $org_id = "2";
            
            $result = $balresult = []; $methods = "";
            if($org_id == "1") {
                $result = $this->am->getAgentCommissionLedger($agent_id,$fromdate,$todate,$lead_id, "agent_voucher_details", "agent_commission_transaction");
                $balresult = $this->am->AgnBalance($agent_id,$fromdate, $todate, $methods);
            } elseif ($org_id == "2") {
                $result = $this->am->getAgentCommissionLedger($agent_id,$fromdate,$todate,$lead_id, "agent_voucher_details_orc", "agent_commission_transaction_orc");
                $balresult = $this->am->AgnBalance_orc($agent_id,$fromdate, $todate, $methods);
            }
            //echo $this->db->last_query();

            if($result) {
                foreach( $result as $row ) {
                    $agents[$row->agent_id]     = $row->name. '('.$row->agent_pos_code.')';
                    $results[$row->agent_id][]  = $row;
                    $agnbal[$agent_id]          = 0;
                }
            }         
            
            if($balresult) {
                foreach( $balresult as $_row ) {                    
                    $agnbal[$_row->agent_id] = $_row->balance;
                }
            }
?>               

            <section class="content">
                <div class="box">
                    <div class="box-body">
                        <div class="col-md-12">                            
                            <table class="table table-bordered" width="100%">
                                <thead style="background-color: white;">
                                                                        
                                    <tr>
                                        <th style="width:15%;"><b> Date </b></th>
                                        <th style="width:25%;"><b> Particulars </b></th>
                                        <th style="width:5%;"><b> DR or CR </b></th>                                            
                                        <th style="width:10%;text-align:right"><b> Debit </b></th>
                                        <th style="width:10%;text-align:right"><b> Credit </b></th>                                            
                                        <th style="width:10%;text-align:right"><b> Balance </b></th>                                            
                                    </tr>
                                </thead>
                                <tbody style="background-color: white;">
                                <?php $gtot_cr = $gtot_dr = 0; ?>
                                <?php if(isset($agents) && !empty( $agents ) ):?>    
                                    <?php foreach( $agents as $agent_id => $agent_name):?>
                                        <?php 
                                            $tot_cr = $tot_dr = 0; 
                                            if(!isset($agnbal[$agent_id])) {
                                                $agnbal[$agent_id] = 0;
                                            }
                                        ?>
                                        <tr>
                                            <th colspan="5">AGent : <?=$agent_name?></th>
                                            <th style="text-align:right">
                                                <?php 
                                                    $bal = (isset($agnbal[$agent_id])) ? $agnbal[$agent_id] : 0;
                                                    echo $fmt->formatCurrency(is_numeric($bal) ? $bal : 0, "INR");
                                                ?>
                                            </th>
                                        </tr>                                    
                                        <?php if(isset($agents) && !empty( $agents ) ):?>    
                                            <?php foreach($results[$agent_id] as $row):?>
                                                <?php $tot_cr +=$row->credit; $tot_dr += $row->net_op + $row->tds_amt; ?>
                                                <?php $gtot_cr +=$row->credit; $gtot_dr += $row->net_op + $row->tds_amt; ?>

                                                 <!-- Agent Commission (CR) ROW //--->
                                                <tr>
                                                    <td>
                                                        <?php $crdate = new DateTime($row->credit_dt);?>
                                                        <?=$crdate->format('d-m-Y')?>
                                                    </td>
                                                    <td>Agent Commission <?=$row->voucher_no?></td>
                                                    <td> CR </td>
                                                    <td style="text-align:right"> <?=$fmt->formatCurrency(0, "INR")?> </td>
                                                    <td style="text-align:right">
                                                        <?=$fmt->formatCurrency($row->credit, "INR")?>
                                                        <?php $agnbal[$agent_id] += (isset($row->credit)) ? $row->credit : 0;?>
                                                    </td>
                                                    <td style="text-align:right"> 
                                                        <?php $bal = (isset($agnbal[$agent_id])) ? $agnbal[$agent_id] : 0?>
                                                        <?=$fmt->formatCurrency(is_numeric($bal) ? $bal : 0, "INR")?>
                                                    </td>   
                                                                            
                                                </tr>

                                                <!-- TDS ROW //--->
                                                <tr>                                                        
                                                    <td>
                                                        <?php 
                                                        // Safely handle null or empty date
                                                        $dtdate = new DateTime(!empty($row->debit_dt) ? $row->debit_dt : 'now');
                                                        ?>
                                                        <?=$dtdate->format('d-m-Y')?>
                                                    </td>
                                                    <td>TDS Payable <?=$row->voucher_no?></td>
                                                    <td> DR </td>                                                        
                                                    <td style="text-align:right">                                                        
                                                        <?=$fmt->formatCurrency(is_numeric($row->tds_amt) ? $row->tds_amt : 0, "INR")?>                                                        
                                                        <?php $agnbal[$agent_id] -= (isset($row->tds_amt) ? $row->tds_amt : 0);?>
                                                    </td>
                                                    <td style="text-align:right"><?=$fmt->formatCurrency(0, "INR")?></td>
                                                    <td style="text-align:right">
                                                        <?php $bal = (isset($agnbal[$agent_id])) ? $agnbal[$agent_id] : 0;?>
                                                        <?=$fmt->formatCurrency(is_numeric($bal) ? $bal : 0, "INR")?>
                                                    </td>
                                                </tr>

                                                <!-- Commission Payable (DR) ROW //--->
                                                <tr>                                                        
                                                    <td>
                                                        <?php 
                                                        // Safely handle null or empty date
                                                        $dtdate = new DateTime(!empty($row->debit_dt) ? $row->debit_dt : 'now');
                                                        ?>
                                                        <?=$dtdate->format('d-m-Y')?>
                                                    </td>
                                                    <td>Commission Payable <?=$row->voucher_no?></td>
                                                    <td> DR </td>                                                        
                                                    <td style="text-align:right">                                                        
                                                        <?=$fmt->formatCurrency(is_numeric($row->net_op) ? $row->net_op : 0, "INR")?>                                                        
                                                        <?php $agnbal[$agent_id] -= (isset($row->net_op) ? $row->net_op : 0);?>
                                                    </td>
                                                    <td style="text-align:right"><?=$fmt->formatCurrency(0, "INR")?></td>
                                                    <td style="text-align:right">
                                                        <?php $bal = (isset($agnbal[$agent_id])) ? $agnbal[$agent_id] : 0;?>
                                                        <?=$fmt->formatCurrency(is_numeric($bal) ? $bal : 0, "INR")?>
                                                    </td>
                                                </tr>

                                            <?php endforeach;?>
                                        <?php endif;?>
                                        <tr>
                                            <td colspan="3" align="right"><b> Total Amount </b></td>                                                
                                            <td align="right"><b><?=$fmt->formatCurrency(is_numeric($tot_dr) ? $tot_dr : 0, "INR")?> </b></td>
                                            <td align="right"><b><?=$fmt->formatCurrency(is_numeric($tot_cr) ? $tot_cr : 0, "INR")?> </b></td>
                                            <td align="right">
                                                <b>
                                                    <?php $bal = (isset($agnbal[$agent_id])) ? $agnbal[$agent_id] : 0?>
                                                    <?=$fmt->formatCurrency(is_numeric($bal) ? $bal : 0, "INR")?>
                                                </b>
                                            </td>
                                        </tr> 
                                    <?php endforeach;?>
                                <?php endif;?>                                                                                                                        
                                </tbody>
                                
                                <tfoot style="background-color: white;">
                                    <tr>
                                        <td colspan="3" align="right"><b> Grand Total Amount </b></td>
                                        <td align="right"><b><?=$fmt->formatCurrency(is_numeric($gtot_dr) ? $gtot_dr : 0, "INR")?> </b></td>
                                        <td align="right"><b><?=$fmt->formatCurrency(is_numeric($gtot_cr) ? $gtot_cr : 0, "INR")?> </b></td>
                                    </tr>
                                </tfoot>
                            </table>

                            
                        </div>
                    </div>
                </div>
            </section>
<?php                            
        }
    }
    
	  public function insurance_com_ledger()
      {
          	if($this->session->has_userdata('logged_in')) 
        	{
        	       $res = $this->mm->fetch_all_insurance_company();
        	       
        	       foreach($res as $da)
        	       {
            	       $acc_id = $this->am->get_last_acc_id();
                       $last_id = $acc_id->accid+1;
                       $vcharid = "acc".$last_id;
                       
                       //Own commission Ledger id acc21
                       
                       $data = array(
                               "accid" => $acc_id->accid+1,
                               "vchaccid" =>$vcharid,
                               "vch" =>"acc",
                               "vchaccname" =>$da->company_name,
                               "vchparentid" =>"acc21",
                               "parentid" => "21",
                               "chracctype" =>"1",
                               "cr_dr_status" =>"1",
                               "insurer_id" =>$da->id,
                           );
                        $res = $this->am->add_sub_ledger($data);
                        $res0 = $this->am->add_sub_ledger_orc($data);
        	       }
                   
                   
                   
        	}
      }
      
      public function agent_com_ledger()
      {
          	if($this->session->has_userdata('logged_in')) 
        	{
        	       $res = $this->am->fetch_all_agents_pos();
        	       
        	       foreach($res as $da)
        	       {
            	       $acc_id = $this->am->get_last_acc_id();
                       $last_id = $acc_id->accid+1;
                       $vcharid = "acc".$last_id;
                       
                       //Agent commission Ledger id acc42
                       
                       $data = array(
                               "accid" => $acc_id->accid+1,
                               "vchaccid" =>$vcharid,
                               "vch" =>"acc",
                               "vchaccname" =>$da->agent_pos_code,
                               "vchparentid" =>"acc42",
                               "parentid" => "21",
                               "chracctype" =>"1",
                               "cr_dr_status" =>"1",
                               "agent_id" =>$da->id,
                           );
                        $res = $this->am->add_sub_ledger($data);
                        $res0 = $this->am->add_sub_ledger_orc($data);
        	       }
                   
        	}
      }
      
      
      public function acc_own_commission()
	  {
           if($this->session->has_userdata('logged_in')) 
           {
                $data = $this->am->get_all_policy_details();
                
                foreach($data as $daa)
                {
                    $lead_id = $daa->lead_id;
                    $res = $this->am->get_policy_details($lead_id);
                    $own_com_id = "acc21";
                    $own_com = 0;
                    $total_irda = 0;
                    $total_orc = 0;
                           
                    $date = date("Y-m-d H:i:s");
                    $year = date('y');
                    $month = date('m');
                    
                    if($month < 4)
                    {
                        $year = $year-1;
                    }
                    
                    $x = 0;
                    
                    do 
                    {
                        $x++;
                        $new_sr_no = "OC".$x."/".$year;
                    } 
                    while($this->am->check_sr_no_already_exits($new_sr_no));
                       
                    $res0 = $this->am->get_commission_details($res->commission_id);
                    
                    if($res0 != "" || $res0 != null)
                    {
                       if($res0->own_od == "0.00" && $res0->own_tp == "0.00" && $res0->on_net != "0.00")
                       {
                           $irda_od_percentage = 15;
                           $irda_tp_percentage = 2.5;
                           $od = $res->total_own_damage;
                           $tp = $res->tot_liability_premium;
                           $irda_od = $res->total_own_damage * $irda_od_percentage/100;
                           $irda_tp = $res->tot_liability_premium * $irda_tp_percentage/100;
                           $total_irda = $irda_od + $irda_tp;
                           $total_orc = $res->own_commission_amt - $total_irda;
                       }
                       else if($res0->own_od != "0.00" && $res0->own_tp != "0.00" && $res0->on_net == "0.00")
                       {
                           $irda_od_percentage = 15;
                           $irda_tp_percentage = 2.5;
                           $od = $res->total_own_damage;
                           $tp = $res->tot_liability_premium;
                           $irda_od = $res->total_own_damage * $irda_od_percentage/100;
                           $irda_tp = $res->tot_liability_premium * $irda_tp_percentage/100;
                           $total_irda = $irda_od + $irda_tp;
                           $total_orc = $res->own_commission_amt - $total_irda;
                       }
                       else if($res0->own_od != "0.00" && $res0->own_tp == "0.00" && $res0->on_net == "0.00")
                       {
                           $irda_od_percentage = 15;
                           $od = $res->total_own_damage;
                           $irda_od = $res->total_own_damage * $irda_od_percentage/100;
                           $total_irda = $irda_od;
                           $total_orc = $res->own_commission_amt - $total_irda;
                       }
                       else if($res0->own_od == "0.00" && $res0->own_tp != "0.00" && $res0->on_net == "0.00")
                       {
                           $irda_tp_percentage = 2.5;
                           $tp = $res->tot_liability_premium;
                           $irda_tp = $res->tot_liability_premium * $irda_tp_percentage/100;
                           $total_irda = $irda_tp;
                           $total_orc = $res->own_commission_amt - $total_irda;
                       }
                     
                       if($res != "" || $res != null)
                       {
                           $check = $this->am->check_ac_policy_no_already_exits($res->policy_no);
                           $check0 = $this->am->check_ac_policy_no_already_exits_orc($res->policy_no);
                           
                           $ins_ledger = $this->am->fetch_insurance_company_ledger_main($res->company);
                           $ins_ledger_orc = $this->am->fetch_insurance_company_ledger_orc($res->company);
                        
                               if($check < 1)
                               {
                                    $data_irda = array(
                                        "sr_no" =>$new_sr_no,
                                        "credit"=>floor($total_irda),
                                        "cr_parent_id" =>$own_com_id,
                                        "dr_parent_id" =>$ins_ledger->vchaccid,
                                        "tds" =>0,
                                        "lead_id"=>$lead_id,
                                        "sub_id" =>$res->policy_no,
                                        "insurer_id" =>$res->company,
                                        "note" =>"Own commission Credit",
                                        "datetime" =>date("Y-m-d H:i:s")
                                        );
                                    $res0 = $this->am->add_acc_own_commission($data_irda);
                               }  
                               
                               if($check0 < 1)
                               {
                                    $data_orc = array(
                                            "sr_no" =>$new_sr_no,
                                            "credit"=>floor($total_orc),
                                            "cr_parent_id" =>$own_com_id,
                                            "dr_parent_id" =>$ins_ledger_orc->vchaccid,
                                            "tds" =>0,
                                            "lead_id"=>$lead_id,
                                            "sub_id" =>$res->policy_no,
                                            "insurer_id" =>$res->company,
                                            "note" =>"Own commission Credit",
                                            "datetime" =>date("Y-m-d H:i:s")
                                            );
                                    $res1 = $this->am->add_acc_own_commission_orc($data_orc);
                               }
                        }
                        
                       echo "success";
                    }
                }
           }
	  }
	  
	  public function acc_agn_commission()
	  {
	      if($this->session->has_userdata('logged_in')) 
          {    
                $data = $this->am->get_all_policy_details();
                
                foreach($data as $daa)
                {
                    $lead_id = $daa->lead_id;
                    $res = $this->am->get_policy_details($lead_id);
                    $own_com_id = "acc21";
                    $agn_com_id = "acc42";
                    $total_irda = 0;
                    $total_orc = 0;
                    $tds = 0;
                    
                    $date = date("Y-m-d H:i:s");
                    $year = date('y');
                    $month = date('m');
                    
                    if($month < 4)
                    {
                        $year = $year-1;
                    }
                    $x = 0;
                    do 
                    {
                        $x++;
                        $new_sr_no = "AC".$x."/".$year;
                    } 
                    while($this->am->check_sr_no_already_exits($new_sr_no));
                    
                    $res0 = $this->am->get_commission_details($res->commission_id);
                    $agn_category = $this->am->fetch_agent_category($res->policy_agency_pos);
                
                      if($res0 != "" || $res0 != null)
                      {
                            if($res0->agn_com_type == "ON-NET")
                            {
                               $irda_od_percentage = 15;
                               $od = $res->total_own_damage;
                               $tp = $res->tot_liability_premium;
                               $total_irda = $res->total_own_damage * $irda_od_percentage/100;
                               $total_orc = $res->agent_commission_amt - $total_irda;
                            }
                            else if($res0->agn_com_type == "OD_AND_TP")
                            {
                               $irda_od_percentage = 15;
                               $od = $res->total_own_damage;
                               $tp = $res->tot_liability_premium;
                               $total_irda = $res->total_own_damage * $irda_od_percentage/100;
                               $total_orc = $res->agent_commission_amt - $total_irda;
                            }
                            else if($res0->agn_com_type == "OD")
                            {
                               $irda_od_percentage = 12;
                               $od = $res->total_own_damage;
                               $irda_od = $res->total_own_damage * $irda_od_percentage/100;
                               $total_irda = $irda_od;
                               $total_orc = $res->agent_commission_amt - $total_irda;
                            }
                            else if($res0->agn_com_type == "TP")
                            {
                               $total_irda = 0;
                               $total_orc = 0;
                            }
                        
                           if($res != "" || $res != null)
                           {
                                   $data_irda1 =   array(
                                        "sr_no" =>$new_sr_no,
                                        "debit"=>$total_irda,
                                        "cr_parent_id" =>$agn_com_id,
                                        "dr_parent_id" =>$own_com_id,
                                        "tds" =>$tds,
                                        "sub_id" =>$res->policy_agency_pos,
                                        "lead_id"=>$lead_id,
                                        "note" =>"Own commission Debit",
                                        "datetime" =>date("Y-m-d H:i:s")
                                    );
                                    
                                    $res0 = $this->am->add_acc_own_commission($data_irda1);
                                    
                                    $data_irda2 =   array(
                                            "sr_no" =>$new_sr_no,
                                            "credit"=>$total_irda,
                                            "cr_parent_id" =>$agn_com_id,
                                            "dr_parent_id" =>$own_com_id,
                                            "tds" =>$tds,
                                            "sub_id" =>$res->policy_agency_pos,
                                            "lead_id"=>$lead_id,
                                            "note" =>"Agent commission Credit",
                                            "datetime" =>date("Y-m-d H:i:s")
                                            );
                                            
                                    $res1 = $this->am->add_acc_own_commission($data_irda2);
                              
                                    
                                     $data_orc1 =   array(
                                        "sr_no" =>$new_sr_no,
                                        "debit"=>$total_orc,
                                        "cr_parent_id" =>$agn_com_id,
                                        "dr_parent_id" =>$own_com_id,
                                        "tds" =>$tds,
                                        "sub_id" =>$res->policy_agency_pos,
                                        "lead_id"=>$lead_id,
                                        "note" =>"Own commission Debit",
                                        "datetime" =>date("Y-m-d H:i:s")
                                    );
                                    $res0 = $this->am->add_acc_own_commission_orc($data_orc1);
                                    $data_orc2 =   array(
                                            "sr_no" =>$new_sr_no,
                                            "credit"=>$total_orc,
                                            "cr_parent_id" =>$agn_com_id,
                                            "dr_parent_id" =>$own_com_id,
                                            "tds" =>$tds,
                                            "sub_id" =>$res->policy_agency_pos,
                                            "lead_id"=>$lead_id,
                                            "note" =>"Agent commission Credit",
                                            "datetime" =>date("Y-m-d H:i:s")
                                            );
                                    $res1 = $this->am->add_acc_own_commission_orc($data_orc2);
                                
                           }
                      }
                }
          }
	  }
	  
	  
      public function get_sub_ledgers_by_accid()
      {
          if($this->session->has_userdata('logged_in')) 
          {
              $account_head = $this->input->post("account_head");

              $res = $this->am->get_sub_ledgers_by_accid($account_head);
              
              $content = "<option value = ''>--Select--</option>";
              
              foreach($res as $da)
              {
                  $content .="<option value=".$da->vchaccid.">".$da->vchaccname."</option>";
              }
              echo $content;
          }
  }
  
 public function get_particulars_by_account_head()
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
 

  public function agent_payment_voucher()
  {
      if($this->session->userdata("session_role") == "admin")
      {
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $data["agent_id"] =$this->am->get_agent_commission_credit(); 
            $this->load->view("header",$pro_data);
            $this->load->view("agent_payment_voucher",$data);
            $this->load->view("footer",$pro_data);
      }
      else
      {
          redirect("login");
      }
  }
  
  public function bank()
    {
      if($this->session->userdata("session_role") == "admin")
      {
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $this->load->view("header",$pro_data);
            $this->load->view("bank");
            $this->load->view("footer",$pro_data);
      }
      else
      {
          redirect("login");
      }
  }
  
 public function add_bank_details()
    {
      if($this->session->userdata("session_role") == "admin")
      {
          $bank_branch = $this->input->post("bank_branch");
          $bank = $this->input->post("add_bank");
          $account_number = $this->input->post("account_number");
          $ifsc_code = $this->input->post("ifsc_code");
          $door_no = $this->input->post("door_no");
          $streat_village = $this->input->post("streat_village");
          $acc_open_date = $this->input->post("acc_open_date");
          $accout_name = $this->input->post("accout_name");
          $over_draft_limit = $this->input->post("over_draft_limit");
          
          $data = array("bank_branch" => $bank_branch,
                         "bank_name" => $bank, 
                         "account_number" => $account_number,
                         "ifsc_code" => $ifsc_code,
                         "door_no" =>$door_no,
                         "streat_village" =>$streat_village,
                         "acc_open_date" =>$acc_open_date,
                         "accout_name" => $accout_name,
                         "over_draft_limit" =>$over_draft_limit,
                           );
    		$res = $this->am->add_bank_details( $data);
          
      }
    }

   public function fetch_bank()
     {
		$draw = intval($this->input->post("draw"));
		
		$res = array();

		if($this->session->has_userdata('logged_in')) 
    	{
			$res = $this->am->fetch_bank();
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
                $da->bank_branch,
                $da->bank_name,
                $da->account_number,
                $da->ifsc_code,
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
	
	public function fetch_edit_bank_dateils()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
    		$id = $this->input->post("id");
			$res = $this->am->fetch_edit_bank_dateils($id);
			echo json_encode($res);
		}
	}
	
	
	public function edit_Bank_details()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
            $bank_branch = $this->input->post("bank_branch");
            $bank = $this->input->post("add_bank");
            $account_number = $this->input->post("account_number");
            $ifsc_code = $this->input->post("ifsc_code");
            $door_no = $this->input->post("door_no");
            $streat_village = $this->input->post("streat_village");
            $acc_open_date = $this->input->post("acc_open_date");
            $accout_name = $this->input->post("accout_name");
            $over_draft_limit = $this->input->post("over_draft_limit");
            $id = $this->input->post("id");
            
            $data = array("bank_branch" => $bank_branch,
                           "bank_name" => $bank,
                           "account_number" => $account_number,
                           "ifsc_code" => $ifsc_code,
                           "door_no" =>$door_no,
                           "streat_village" =>$streat_village,
                           "acc_open_date" =>$acc_open_date,
                           "accout_name" => $accout_name,
                           "over_draft_limit" =>$over_draft_limit,
                               );
    		$res = $this->am->edit_Bank_details($id, $data);
            
    	}
	    
	}
	
	public function delete_bank_details()
	{
		if($this->session->has_userdata('logged_in')) 
    	{
			$id = $this->input->post("id");
			$this->am->delete_bank_details($id);
    	}
	}
	
   public function add_agent_receipt()
   {
       	if($this->session->has_userdata('logged_in')) 
    	{
    	    $accnumber =$this->input->post("accnumber");
    	    $agent_account_number = $this->input->post("agent_account_number");
    	    $paymode = $this->input->post("paymode");
    	    $cash_bal = $this->input->post("cash_bal");
    	    $amount = $this->input->post("amount");
    	    $date = $this->input->post("date");
            $cash_release = $this->input->post("cash_release");
            $bank  = $this->input->post("bank");
            $bank_branch = $this->input->post("bank_branch");
            $cheque_no = $this->input->post("cheque_no");
            $transaction_no  = $this->input->post("transaction_no");
            $trans_date = $this->input->post("trans_date");
            $account_head = $this->input->post("account_head");
    	    
    	    
    	    $data = array("account_id" =>$account_head,
    	                  "accnumber_id"=>$accnumber,
    	                  "agent_account_number"=>$agent_account_number,
        	               "paymode" => $paymode,
        	               "cash_bal" =>$cash_bal,
        	               "amount" =>$amount,
        	               "date" =>$date,
        	               //"cash_release" =>$cash_release,
        	               "bank" =>$bank,
        	               "bank_branch" =>$bank_branch,
        	               "cheque_no"=>$cheque_no,
        	               "transaction_no"=>$transaction_no,
        	               "trans_date"=>$trans_date);
    	    $res = $this->am->add_agent_receipt($data);
	    	echo "success";

        }
       
   }
   
   public function get_agent_account_details()
   {
       	if($this->session->has_userdata('logged_in')) 
    	{
    		$account_id = $this->input->post("account_id");
			$res = $this->am->get_agent_account_details($account_id);
			echo json_encode($res);
		}
   }
   
   public function export_view_accounts_ledger_excel()
   {
        if($this->session->has_userdata('logged_in')) 
           {
               $acc_head = $this->input->post("acc_head");
               $acc_sub = $this->input->post("acc_sub_category");
               $from_date = $this->input->post("f_date");
               $to_date = $this->input->post("to_date");
               $lead_id = $this->input->post("lead_id");
               
               
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
            
            $objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Accounts Ledgers Report');
            
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
        $objPHPExcel->getActiveSheet()->SetCellValue('F3', date_format(date_create($from_date),"d-m-Y"));
        $objPHPExcel->getActiveSheet()->SetCellValue('G3', date_format(date_create($to_date),"d-m-Y"));
        
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
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Acc Sr No');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Account Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Credit');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Debit');
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Balance');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Lead ID');
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Reason');
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'DATE');
  
        
        $row_count = 5;
        $a = 0;
               
               
              
               if($acc_head == "" && $acc_sub != "")
               {
                   $data = $this->am->fetch_agent_id($acc_sub);
                   $acc_sub = $data->agent_id;
               }
               
               $res0 = $this->am->fetch_acc_name_by_accid($acc_head);
              
               $res = $this->am->fetch_view_accounts_ledger($acc_head,$acc_sub,$from_date,$to_date,$lead_id);
               
               
               $res1 = $this->am->fetch_view_accounts_ledger_orc($acc_head,$acc_sub,$from_date,$to_date,$lead_id);
               
               
                 $a = 0;
                 $balance = 0;
                 
                 $tot_cr = 0;
                 $tot_dr = 0;
                 $tot_balance = 0;
                 
                 $date = "";
                 
    if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") 
            {              
               
        foreach($res as $da)
            {
                 if($da->note == "Own commission Credit")
                    {
                        $data = $this->am->fetch_acc_name_by_accid($da->cr_parent_id);
                        $acc_name = $data->vchaccname;
                        $acc_id = $da->cr_parent_id;
                    }
                    else if($da->note == "Own commission Debit")
                    {
                        $data = $this->am->fetch_acc_name_by_agn_id($da->sub_id);
                        $acc_name = $data->vchaccname;
                        $acc_id = $data->vchaccid;
                    }
                    
                    $tot_cr = $da->credit + $tot_cr;
                    $tot_dr  = $da->debit + $tot_dr;
                    $balance = $tot_cr - $tot_dr;
                    $tot_balance = $balance + $tot_balance;
                
                $a++;
             
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da->sr_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count ,$acc_name."(".$acc_id.")");
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da->credit);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , ($da->debit));
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , ($balance));
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da->lead_id);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $da->note);
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , date_create($da->datetime),"d-m-Y");
                
                
                $objPHPExcel->getActiveSheet()->getStyle('D'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('E'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('F'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
              

                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
            }
            
            }
            
      
  else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
              {         
            
        foreach($res1 as $da1)
            {
                 if($da1->note == "Own commission Credit")
                    {
                        $data = $this->am->fetch_acc_name_by_accid($da1->cr_parent_id);
                        $acc_name = $data->vchaccname;
                        $acc_id = $da1->cr_parent_id;
                    }
                    else if($da1->note == "Own commission Debit")
                    {
                        $data = $this->am->fetch_acc_name_by_agn_id($da1->sub_id);
                        $acc_name = $data->vchaccname;
                        $acc_id = $data->vchaccid;
                    }
                    
                    $tot_cr = $da1->credit + $tot_cr;
                    $tot_dr  = $da1->debit + $tot_dr;
                    $balance = $tot_cr - $tot_dr;
                    $tot_balance = $balance + $tot_balance;
                
                $a++;
             
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$row_count , $a);
                $objPHPExcel->getActiveSheet()->SetCellValue('B'.$row_count , $da1->sr_no);
                $objPHPExcel->getActiveSheet()->SetCellValue('C'.$row_count ,$acc_name."(".$acc_id.")");
                $objPHPExcel->getActiveSheet()->SetCellValue('D'.$row_count , $da1->credit);
                $objPHPExcel->getActiveSheet()->SetCellValue('E'.$row_count , ($da1->debit));
                $objPHPExcel->getActiveSheet()->SetCellValue('F'.$row_count , ($balance));
                $objPHPExcel->getActiveSheet()->SetCellValue('G'.$row_count , $da1->lead_id);
                $objPHPExcel->getActiveSheet()->SetCellValue('H'.$row_count , $da1->note);
                $objPHPExcel->getActiveSheet()->SetCellValue('I'.$row_count , date_create($da1->datetime),"d-m-Y");
                
                
                $objPHPExcel->getActiveSheet()->getStyle('D'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('E'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
                $objPHPExcel->getActiveSheet()->getStyle('F'.$row_count)->getNumberFormat()->setFormatCode('#,##0.00');
              

                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
            }
         }
                
                $objPHPExcel->getActiveSheet()->getRowDimension($row_count)->setRowHeight(20);
                $row_count++;
            
                $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
                $objWriter->save('./datas/accounts_doc/accounts_ledgers_report.xlsx');
                echo base_url()."/datas/accounts_doc/accounts_ledgers_report.xlsx";
        }       
               
               
   
       
   }
   
   public function create_commission_ledger()
   {
       if($this->session->userdata("session_role") == "admin")
      {
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $data["account_head"] =$this->am->get_account_head_for_general_receipt();
            $data["insurance"] = $this->am->get_insurance_company();
            $this->load->view("header",$pro_data);
            $this->load->view("create_commission_ledger",$data);
            $this->load->view("footer",$pro_data);
      }
      else
      {
          redirect("login");
      }
   }
   
   public function add_insur_company_ledger()
   {
       if($this->session->has_userdata('logged_in')) 
    	{
    	    $main_ledger_id = $this->input->post("acc_head");
    	    $sub_leder = $this->input->post("sub_leder");
    	    $ledger_type = $this->input->post("ledger_type");
    	    $insur_company = $this->input->post("insur_company");
    	    $add_type = $this->input->post("s_type");
    	    
    	    
            $acc_id = $this->am->get_last_acc_id();
            $accid = $acc_id->accid+1;
            $vchaccid = "acc".$accid;
            $parent_id = substr($main_ledger_id,3);
           
           
                $date = date("Y-m-d H:i:s");
                $year = date('y');
                $month = date('m');
                    
                    if($month < 4)
                    {
                        $year = $year-1;
                    }
                    
                    $x = 0;
                    
                    do 
                    {
                        $x++;
                        $new_sr_no = "AG".$x."/".$year;
                    } 
                    while($this->am->check_sr_no_already_exits($new_sr_no));
    	    
    	    
    	    $data = array ("acc_head" =>$main_ledger_id,
    	                    "sub_ledger" =>$sub_leder,
    	                    "ledger_type" =>$ledger_type,
    	                    "insur_company" =>$insur_company,
    	                    "datetime" =>date("Y-m-d H:i:s"));
    	                    
    	   $res = $this->am->add_insur_company_ledger($data);
    	   
    	   
    	         $charactertype = "3";
               
               
                $data_acc = array(
                       "accid" =>$accid,
                       "vchaccid" =>$vchaccid,
                       "vch" =>"acc",
                       "vchaccname" =>$sub_leder,
                       "vchparentid" =>$main_ledger_id,
                       "insurer_id" =>$insur_company,
                       "parentid" => $parent_id,
                       "chracctype" =>$charactertype,
                       "cr_dr_status" =>$add_type,
                   );
                   
                 $res1 = $this->am->add_insur_company_sub_ledger($data_acc);
                 
                  echo "success";
   	    
    	}
   }
   
   public function agent_account_ledger()
   {
       if($this->session->userdata("session_role") == "admin")
      {
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $data["account_head"] =$this->am->get_account_head_for_general_receipt();
            $this->load->view("header",$pro_data);
            $this->load->view("agent_account_ledger",$data);
            $this->load->view("footer",$pro_data);
      }
      else
      {
          redirect("login");
      }
   } 
   
   
   public function fetch_all_agents()
   {
    if($this->session->has_userdata('logged_in')) 
    	{
    	    $res = $this->am->fetch_all_agents();
    	    echo json_encode($res);
    	}
   }
   
   public function add_agent_ledger()
   {
       if($this->session->has_userdata('logged_in'))
       {
           $main_ledger_id = $this->input->post("acc_head");
           $sub_leder = $this->input->post("sub_leder");
           $ledger_type = $this->input->post("ledger_type");
           $select_agents = $this->input->post("select_agents");
           $add_type = $this->input->post("s_type");
           
           
           $acc_id = $this->am->get_last_acc_id();
           $accid = $acc_id->accid+1;
           $vchaccid = "acc".$accid;
           $parent_id = substr($main_ledger_id,3);
           
           
                $date = date("Y-m-d H:i:s");
                $year = date('y');
                $month = date('m');
                    
                    if($month < 4)
                    {
                        $year = $year-1;
                    }
                    
                    $x = 0;
                    
                    do 
                    {
                        $x++;
                        $new_sr_no = "AG".$x."/".$year;
                    } 
                    while($this->am->check_sr_no_already_exits($new_sr_no));
           
          
             $data = array("acc_head" =>$main_ledger_id,
                           "sub_leder" =>$sub_leder,
                           "ledger_type" =>$ledger_type, 
                           "select_agents" =>$select_agents,
                           "datetime" =>date("Y-m-d H:i:s"));
                           
                $res = $this->am->add_agent_ledger($data);  
                
                
   
               $charactertype = "3";
               
               
                $data_acc = array(
                       "accid" =>$accid,
                       "vchaccid" =>$vchaccid,
                       "vch" =>"acc",
                       "vchaccname" =>$sub_leder,
                       "vchparentid" =>$main_ledger_id,
                       "agent_id" =>$select_agents,
                       "parentid" => $parent_id,
                       "chracctype" =>$charactertype,
                       "cr_dr_status" =>$add_type,
                   );
                   
                 $res1 = $this->am->add_agent_sub_ledger($data_acc);
                 
                 
                
                   echo "success";
       }
           
 }
 
 
    public function agent_bank_transact_entry()
   {
       if($this->session->userdata("session_role") == "admin")
      {
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $this->load->view("header",$pro_data);
            $this->load->view("agent_bank_transact_entry");
            $this->load->view("footer",$pro_data);
      }
      else
      {
          redirect("login");
      }
   } 
   
   public function _fetch_bank_agent_commission_statement()
   {
         if($this->session->has_userdata('logged_in')) 
         {
    
            if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") {
                $agent_code_1 = $this->am->fetch_bank_agent_commission_statement();
            } else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
              { 
                $agent_code_1 = $this->am->fetch_bank_agent_commission_statement_orc();
            }
                
            $content = "";
        
            
            $content .="<table class='table table-bordered'>
            <tr>
                  <td><input type='checkbox' class='form-check-input select_all' id='select_all' onclick=select_all()>&nbsp;Select All</td>
                  <td>#</td>
                   <td>Agent Name</td>
                  <td>Voucher no</td>
                  <td>Transaction No</td>
                  <td>Transaction Date</td>
                  <td>Comm. Amount</td>
                  <td>TDS Amount</td>
            </tr>
            ";
            
            
            $paid_amt = 0;
            $total_tds = 0;
            
            $tot_paid_amount = 0;
            
            if(isset($agent_code_1) && !empty($agent_code_1)) {
                $sl = 1;
                foreach($agent_code_1 as $da)
                {
                    
                    
                    $tot_paid_amount = $tot_paid_amount + $da->commission_amount;
                    
                    $total_tds = $total_tds + $da->tds_amount;
                    //date_format(date_create($da->transaction_date),"d-m-Y")
                  $content .="<tr>
                            <td onchange='calc()'><input type='checkbox' value=".$da->voucher_no." class='form-check-input check'></td>
                            <td>".($sl++)."</td>
                            <td>".$da->agent_name."</td>
                            <td>".$da->voucher_no."</td>
                            <td>".$da->transaction_account_no."</td>
                            <td>".$da->transaction_date."</td>
                            <td style='text-align:right'>".(floor($da->commission_amount)).".00</td>
                            <td style='text-align:right'>".(floor($da->tds_amount)).".00</td>
                            </tr>";
                        }
                
                
                 $content .="<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style='text-align:right'><b>Total</b></td>
                    <td style='text-align:right'>".(floor($tot_paid_amount)).".00</td>
                    <td style='text-align:right'>".(floor($total_tds)).".00</td>
                    
                    
                    </tr>";
               $content .="</table>";
               
              $content .="<div class='row'>
                              <div class='col-md-4'>
                                 <div class='row'>
                                      <div class='col-md-4'>
                                         <label><b>Selected Total</b></label>
                                      </div>
                                      <div class='col-md-1'>
                                         <label> : </label>
                                      </div>
                                     <div class='col-md-1'>
                                         <p id='selected_total'> </p>
                                      </div>
                              </div>
                              </div>
                               <div class='col-md-12'>
                                 <div class='row'>
                                      <div class='col-md-12'>
                                         <button class='btn btn-warning pull-right' onclick=sum_btn(".$da->voucher_no.")><i class='fa fa-pencil-square-o'></i>Submit</button>
                                      </div>
                                 </div>
                              </div>
                          </div>";
                          
               
               echo $content;                
            }
        

        }
    }
 
    // 2023-09-13
   public function fetch_bank_agent_commission_statement()
   {
         if($this->session->has_userdata('logged_in')) 
         {
    
            $options = ['accounts_entry_status' => 0];
            if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") {                
                $agent_code_1 = $this->am->fetch_bank_agent_commission_statement($options);
            } else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
              { 
                $agent_code_1 = $this->am->fetch_bank_agent_commission_statement_orc($options);
            }
                
            $content = "";
        
            
            $content .="<table class='table table-bordered'>
            <tr>
                  <td><input type='checkbox' class='form-check-input select_all' id='select_all' >&nbsp;Select All</td>
                  <td>#</td>
                   <td>Agent Name</td>
                  <td>Voucher no</td>
                  <td>Transaction No</td>
                  <td>Transaction Date</td>
                  <td>Comm. Amount</td>
                  <td>TDS Amount</td>
            </tr>
            ";
            
            
            $paid_amt = 0;
            $total_tds = 0;
            
            $tot_paid_amount = 0;
            
            if(isset($agent_code_1) && !empty($agent_code_1)) {
                $sl = 1;
                foreach($agent_code_1 as $da)
                {
                    
                    
                    $tot_paid_amount = $tot_paid_amount + $da->commission_amount;
                    //<input type='checkbox' value=".$da->voucher_no." class='form-check-input checks'>
                    $total_tds = $total_tds + $da->tds_amount;
                    $assign = '<span id="elead_'.$sl.'"></span><input type="checkbox" class="form-check-input check" data-amt = "'.(floor($da->commission_amount)).'" required id="lead_'.$sl.'" name="voucherno[]" data-parsley-mincheck="1" data-parsley-errors-container="#elead_'.$sl.'" value="'.$da->voucher_no.'">';
                    $content .="<tr>
                            <td onchange='calc()'>".$assign."</td>
                            <td>".($sl)."</td>
                            <td>".$da->agent_name."</td>
                            <td>".$da->voucher_no."</td>
                            <td>".$da->transaction_account_no."</td>
                            <td>".$da->transaction_date."</td>
                            <td style='text-align:right'>".(floor($da->commission_amount)).".00</td>
                            <td style='text-align:right'>".(floor($da->tds_amount)).".00</td>
                            </tr>";

                            $sl++;
                }
                
                
                 $content .="<tr>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td style='text-align:right'><b>Total</b></td>
                    <td style='text-align:right'>".(floor($tot_paid_amount)).".00</td>
                    <td style='text-align:right'>".(floor($total_tds)).".00</td>
                    
                    
                    </tr>";
               $content .="</table>";
               
              $content .="<div class='row'>
                              <div class='col-md-4'>
                                 <div class='row'>
                                      <div class='col-md-4'>
                                         <label><b>Selected Total</b></label>
                                      </div>
                                      <div class='col-md-1'>
                                         <label> : </label>
                                      </div>
                                     <div class='col-md-1'>
                                         <p id='selected_total'> </p>
                                      </div>
                              </div>
                              </div>
                               <div class='col-md-12'>
                                 <div class='row'>
                                      <div class='col-md-12'>
                                        <!--<button class='btn btn-warning pull-right' onclick=sum_btn(".$da->voucher_no.")><i class='fa fa-pencil-square-o'></i>Submit</button> //-->
                                         <button class='btn btn-warning pull-right'><i class='fa fa-pencil-square-o'></i>Post</button>
                                      </div>
                                 </div>
                              </div>
                          </div>";
                          
               
               echo $content;                
            }
        

        }
    }    
    
    // accounts by 2023-07-13
    public function store() {
        if($this->session->has_userdata('logged_in')) 
        {
            $response = [
                'status'    => false,
                'msg'       => 'unable to post'
            ];
            //echo '<pre>';print_r($this->input->post());print'</pre>';//die();
           
            $voucherno = $this->input->post('voucherno');
            
            $today = new DateTime();
            
            if(isset($voucherno) && !empty($voucherno)) {
                $table = "agent_commission_transaction";
                if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
                    $table = "agent_commission_transaction_orc";

                if( isset( $voucherno ) && !empty( $voucherno ) ) {
                    $update_transdata = ['accounts_entry_status' => '1', 'updated_by' => $this->session->userdata("session_id"), 'updated_date' => $today->format('Y-m-d H:is:s')];                                        
                    $updatedTrans = $this->am->update_agent_commission_transaction($table,$update_transdata, $voucherno);
                    $sql = $this->db->last_query();


                    $date = date("Y-m-d H:i:s");
                    $year = date('y');
                    $month = date('m');
                    
                    if($month < 4)
                    {
                        $year = $year-1;
                    }
                    $tds_accid = 'acc147';
                    $this->load->model('LeadMod','lm');
                    $this->load->library('audit');
                    foreach($voucherno as $vou) {
                        $transinfo = $this->am->getACTransaction($vou, $table);
                        $_tdsamt = (isset($transinfo->tds) && $transinfo->tds != "") ? $transinfo->tds : 0;
                        if( $_tdsamt > 0 ) {
                            $agentID = (isset($transinfo->agent_id) && $transinfo->agent_id != "") ? $transinfo->agent_id : 0;

                            $accres = $this->am->fetch_acc_name_by_agn_id($agentID);
                            
                            $sr_no = $this->lm->getMaxSRNo('AC');
                            $new_sr_no =  "AC/{$sr_no}/".$year;
                            
                            $data_irda2 =   array(
                                "sr_no"         => $new_sr_no,
                                "debit"         => $_tdsamt,
                                "cr_parent_id"  => $tds_accid,
                                "dr_parent_id"  => $accres->vchaccid,
                                "tds"           => $_tdsamt,
                                "sub_id"        => $agentID,
                                //"lead_id"       => $vou,
                                "note"          => "T.D.S on Agent Commission Debit {$vou}",
                                "datetime"      => date("Y-m-d H:i:s"),                            
                            );
                                    
                            $res1 = $this->lm->add_acc_own_commission($data_irda2);
                            if( $res1 ){
                                
                                $this->audit->log('acc_commission_ledger', 'INSERT', null, null, $data_irda2);
                            }
                        }
                    }
                    
                }
                /*
                $leadinfo1 = $this->am->getLeadsByvoucher($voucherno);                
                if(isset($leadinfo) && !empty($leadinfo)) {                    
                    $processed_leads = array_column($leadinfo, 'lead_id');                    
                    $update_data = ['is_invoice_generated' => '1'];
                    $updated = $this->rm->update_acc_ledger('acc_commission_ledger',$update_data, $processed_leads, ['Own commission Debit', 'T.D.S on Agent Commission Credit']);                                        
                    echo $this->db->last_query();
                }
                */
                $response = [
                    'status'        => true,
                    'msg'           => 'Successfully Posted',
                    'redirect_url'  => base_url('agent_bank_transact_entry'),
                    'sql'           => $sql
                ];
                
            }            
            echo json_encode($response);
            die();
        }

        redirect('login', 'refresh');

    }
 
 	public function excell_data_file_upload()
 	{
    if($this->session->has_userdata('logged_in')) 
    	{
		$this->load->library('excel');
		  
		$file = $this->input->post("excel_file");
	
		
	 
		$path = $_FILES["excel_file"]["tmp_name"];
		$object = PHPExcel_IOFactory::load($path);
	     
	     $dup=[];
	     
	    $org = 1;
	    
	    if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") {
            $org = 1;
        } else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
          { 
            $org = 2;
        }
	     
		foreach($object->getWorksheetIterator() as $worksheet)
		{
			$highestRow    = $worksheet->getHighestRow();
			$highestColumn = $worksheet->getHighestColumn();
			
			for($row=2; $row<= $highestRow ; $row++)
			{
			    
			    $voucher_no = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
			    $transaction_no = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
			    $transaction_date = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
			    $from_account_no = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
			    
			    if( $org == 1)
			        $check = $this->am->check_agent_voucher_no($voucher_no, 'agent_commission_transaction');
			    else 
			        $check = $this->am->check_agent_voucher_no($voucher_no, 'agent_commission_transaction_orc');

                if( empty($transaction_no) || empty($transaction_date) || empty($from_account_no)){
                    $dup[] = "Should not Empty for Transaction No & Date and Source Account No in Row #".$row;
                    
                    $check = "error";                         
                }
                
			    if(empty($check))
			    {
				    
				$agent_name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
				
			    $agnet_code = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
			    $account_no = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
			    $ifsc_code = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
			    $bank_name = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
			    $branch = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
			    $pan_name = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
			    $commission_amount = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
			    $tds_amount = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
			    $net_op = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
			    
			    
		
				 $data = array(
				             "agent_name" =>$agent_name,
				              "pos_code" =>$agnet_code,
				              "account_no" =>$account_no,
				              "ifsc_code"=>$ifsc_code,
				              "bank_name"=>$bank_name,
				              "branch"=>$branch,
				              "pan_name"=>$pan_name,
				              "commission_amount"=>$commission_amount,
				              "tds_amount"=>$tds_amount,
				              "net_op"=>$net_op,
				              "transaction_no"=>$transaction_no,
				              "transaction_date" =>$transaction_date,
				              "transaction_account_no" =>$from_account_no,
				              "voucher_no" =>$voucher_no,
				              "creat_datetime" =>date("Y-m-d H:i:s"));
				              
				              
				    if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "jayantha") {
                        $result = $this->am->bank_agent_commission_entry($data);
                    } else if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
                      { 
                        $result = $this->am->bank_agent_commission_entry_orc($data);
                    }
				    
				
				    //$result = $this->am->bank_agent_commission_entry($data);
				    
				    
				}
				
				else
				{
			        if($check != "error")
                        $dup[]= $voucher_no;
				}
				
			}
		}
		
		if($dup)
		{
		    echo implode(',', $dup);
		}
	}
 	}
 	
 	public function get_vocher_bank_commission_amount()
 	{
      if($this->session->has_userdata('logged_in'))
	    {
	        $voucher_arr = $this->input->post("vocher_arr");
	        $agent_commission_tot = 0;
	        $agent_tds = 0;
	        
	        $res = $this->am->get_voucher_total_1($voucher_arr);
	     
	       foreach($res as $da)
	       {
    	         $agent_commission_tot = $da->ac + $agent_commission_tot;
	       }
	       
	       $tds_data = 0;

        	//$tds_data = $this->rm->get_tds_percentage();
        	

	       //$agent_commission = $agent_commission+$res->ac;  
	       //$agent_tds = $agent_tds+$res->tc;  
	       
	        //$selected_tot = $agent_commission-$agent_tds;
	        echo floor($agent_commission_tot);
	    }
    }

    
    public function agent_ledger_view()
    {
        if($this->session->has_userdata('logged_in')) 
        {
            $pro_data["project_info"] = $this->mm->fetch_project_info();            
            $data["data"] =$this->am->get_account_agent();
            $today = new DateTime();
            $data['startdate']  = $today->format('Y-m-01');
            $data['enddate']    = $today->format('Y-m-d');
            $data['subtitle']   = 'Agent';
    
            $this->load->view('header',$pro_data);
            $this->load->view('view_agent_commission_ledger',$data);
            $this->load->view('footer',$pro_data);
        }
    }
      
    public function fetch_agent_ledger_view()
    {
        if($this->session->has_userdata('logged_in')) 
        {
            $fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY); 
            $agent_id = $this->input->post("agent_id");              
            $fromdate = $this->input->post("fromdate");
            $todate = $this->input->post("todate");
            $lead_id = $this->input->post("lead_id");
                                         
            $org_id = "1";
            if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
                $org_id = "2";
            
            $result = [];
            if($org_id == "1")
                $result = $this->am->getAgentCommissionLedger($agent_id,$fromdate,$todate,$lead_id, "agent_voucher_details", "agent_commission_transaction");
            elseif ($org_id == "2") 
                $result = $this->am->getAgentCommissionLedger($agent_id,$fromdate,$todate,$lead_id, "agent_voucher_details_orc", "agent_commission_transaction_orc");
    
            //echo $this->db->last_query();
    
            //$_result = $this->am->_getAgentCommissionLedger(15,$fromdate,$todate, "acc_commission_ledger", "policy_issue_data");
            //echo $this->db->last_query();
    
            if($result) {
                foreach( $result as $row ) {
                    $agents[$row->agent_id]     = $row->name. '('.$row->agent_pos_code.')';
                    $results[$row->agent_id][]  = $row;
                    $agnbal[$agent_id]          = 0;
                }
            }                
    ?>               
    
            <section class="content">
                <div class="box">
                    <div class="box-body">
                        <div class="col-md-12">                            
                            <table class="table table-bordered" width="100%">
                                <thead style="background-color: white;">
                                                                        
                                    <tr>
                                        <th style="width:15%;"><b> Date </b></th>
                                        <th style="width:25%;"><b> Particulars </b></th>
                                        <th style="width:5%;"><b> DR or CR </b></th>                                            
                                        <th style="width:10%;text-align:right"><b> Debit </b></th>
                                        <th style="width:10%;text-align:right"><b> Credit </b></th>                                            
                                        <th style="width:10%;text-align:right"><b> Balance </b></th>                                            
                                    </tr>
                                </thead>
                                <tbody style="background-color: white;">
                                <?php $gtot_cr = $gtot_dr = 0; ?>
                                <?php if(isset($agents) && !empty( $agents ) ):?>    
                                    <?php foreach( $agents as $agent_id => $agent_name):?>
                                        <?php 
                                            $tot_cr = $tot_dr = 0; 
                                            if(!isset($agnbal[$agent_id])) {
                                                $agnbal[$agent_id] = 0;
                                            }
                                        ?>
                                        <tr>
                                            <th colspan="5">AGent : <?=$agent_name?></th>
                                            <th style="text-align:right">
                                                <?php 
                                                    $bal = (isset($agnbal[$agent_id])) ? $agnbal[$agent_id] : 0;
                                                    echo $fmt->formatCurrency(is_numeric($bal) ? $bal : 0, "INR");
                                                ?>
                                            </th>
                                        </tr>                                    
                                        <?php if(isset($agents) && !empty( $agents ) ):?>    
                                            <?php foreach($results[$agent_id] as $row):?>                                            
                                                <?php 
                                                    $tot_cr +=$row->credit; 
                                                    //$tot_dr += $row->net_op + $row->tds_amt; 
                                                    $tot_dr += $row->net_op; 
                                                ?>
                                                <?php 
                                                    $gtot_cr +=$row->credit; 
                                                    //$gtot_dr += $row->net_op + $row->tds_amt; 
                                                    $gtot_dr += $row->net_op; 
                                                ?>
    
                                                 <!-- Agent Commission (CR) ROW //--->
                                                <tr>
                                                    <td>
                                                        <?php $crdate = new DateTime($row->credit_dt);?>
                                                        <?=$crdate->format('d-m-Y')?>
                                                    </td>
                                                    <td>Agent Commission <?=$row->voucher_no?></td>
                                                    <td> DR </td>
                                                    
                                                    <td style="text-align:right">
                                                        <?=$fmt->formatCurrency($row->credit, "INR")?>
                                                        <?php $agnbal[$agent_id] += (isset($row->credit)) ? $row->credit : 0;?>
                                                    </td>
    
                                                    <td style="text-align:right"> <?=$fmt->formatCurrency(0, "INR")?> </td>
    
                                                    <td style="text-align:right"> 
                                                        <?php $bal = (isset($agnbal[$agent_id])) ? $agnbal[$agent_id] : 0?>
                                                        <?=$fmt->formatCurrency(is_numeric($bal) ? $bal : 0, "INR")?>
                                                    </td>   
                                                                            
                                                </tr>
    
                                                <!-- TDS ROW //--->
                                                <?php /* ?>
                                                <tr>                                                        
                                                    <td>
                                                        <?php $dtdate = new DateTime($row->debit_dt);?>
                                                        <?=$dtdate->format('d-m-Y')?>
                                                    </td>
                                                    <td>TDS Payable <?=$row->voucher_no?></td>
                                                    <td> DR </td>                                                        
                                                    <td style="text-align:right">                                                        
                                                        <?=$fmt->formatCurrency($row->tds_amt, "INR")?>                                                        
                                                        <?php $agnbal[$agent_id] -= (isset($row->tds_amt)) ? $row->tds_amt : 0;?>
                                                    </td>
                                                    <td style="text-align:right"><?=$fmt->formatCurrency(0, "INR")?></td>
                                                    <td style="text-align:right">
                                                        <?php $bal = (isset($agnbal[$agent_id])) ? $agnbal[$agent_id] : 0?>
                                                        <?=$fmt->formatCurrency(is_numeric($bal) ? $bal : 0, "INR")?>
                                                    </td>
                                                </tr>
                                                <?php */ ?>
    
                                                <!-- Commission Payable (DR) ROW //--->
                                                <?php if($row->net_op > 0):?>
                                                    <tr>                                                        
                                                        <td>
                                                            <?php $dtdate = new DateTime($row->debit_dt);?>
                                                            <?=$dtdate->format('d-m-Y')?>
                                                        </td>
                                                        <td>Commission Payable <?=$row->voucher_no?></td>
                                                        <td> CR </td>                                                        
    
                                                        <td style="text-align:right"><?=$fmt->formatCurrency(0, "INR")?></td>
    
                                                        <td style="text-align:right">                                                        
                                                            <?=$fmt->formatCurrency($row->net_op, "INR")?>                                                        
                                                            <?php $agnbal[$agent_id] -= (isset($row->net_op)) ? $row->net_op : 0;?>
                                                        </td>
                                                        
                                                        <td style="text-align:right">
                                                            <?php $bal = (isset($agnbal[$agent_id])) ? $agnbal[$agent_id] : 0?>
                                                            <?=$fmt->formatCurrency(is_numeric($bal) ? $bal : 0, "INR")?>
                                                        </td>
                                                    </tr>
                                                <?php endif;?>
                                            <?php endforeach;?>
                                        <?php endif;?>
                                        <tr>
                                            <td colspan="3" align="right"><b> Total Amount </b></td>
                                            <td align="right"><b><?=$fmt->formatCurrency(is_numeric($tot_cr) ? $tot_cr : 0, "INR")?> </b></td>
                                            <td align="right"><b><?=$fmt->formatCurrency(is_numeric($tot_dr) ? $tot_dr : 0, "INR")?> </b></td>
                                            
                                            <td align="right">
                                                <b>
                                                    <?php $bal = (isset($agnbal[$agent_id])) ? $agnbal[$agent_id] : 0?>
                                                    <?=$fmt->formatCurrency(is_numeric($bal) ? $bal : 0, "INR")?>
                                                </b>
                                            </td>
                                        </tr> 
                                    <?php endforeach;?>
                                <?php endif;?>                                                                                                                        
                                </tbody>
                                
                                <tfoot style="background-color: white;">
                                    <tr>
                                        <td colspan="3" align="right"><b> Grand Total Amount </b></td>                                    
                                        <td align="right"><b><?=$fmt->formatCurrency(is_numeric($gtot_cr) ? $gtot_cr : 0, "INR")?> </b></td>
                                        <td align="right"><b><?=$fmt->formatCurrency(is_numeric($gtot_dr) ? $gtot_dr : 0, "INR")?> </b></td>
                                    </tr>
                                </tfoot>
                            </table>
    
                            
                        </div>
                    </div>
                </div>
            </section>
    <?php                            
        }
    }
    
  
     // 2023-08-12
     public function get_cheque_by_bank()
     {
         if($this->session->has_userdata('logged_in')) 
        {
         $bank_id = $this->input->post("bank_id");
    
         
         $res = $this->am->fetch_cheque_number($bank_id);
         
           $content = "<option value = ''>--Select--</option>";
                  
            foreach($res as $da)
            {
                $content .="<option value=".$da->id.">".$da->vchcheque_character_no."</option>";
            }
            
            echo $content;
        }
         
     }
      // 2023-08-12
    public function bank_entries()
    {
        if($this->session->userdata("session_role") == "admin")
        {
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $data["account_head"] =$this->am->get_account_head_for_general_receipt();
            $data["sub_category"] = $this->am->fetch_sub_category();
            $data["cheque_number"] = $this->am->fetch_cheque_number();
            $data["account_number"] =$this->am->get_bank_details();
            
            $this->load->view("header",$pro_data);
            $this->load->view("bank_entries",$data);
            $this->load->view("footer",$pro_data);
        }
        else
        {
            redirect("login");
        }
    }

    // 2023-08-12
    public function add_bank_entries() {
        if($this->session->has_userdata('logged_in')) 
        {
            $account_head = $this->input->post("account_head");
            $date = $this->input->post("date");
            $sub_category = $this->input->post("sub_category");
            $amount = $this->input->post("amount");
            $narration = $this->input->post("narration");
            $dr_cr = $this->input->post("dr_cr");            
            $bank  = $this->input->post("bank");            
            $voucher_no = $this->input->post("voucher_no");
            
            
            
            $date = date("Y-m-d H:i:s");
            $year = date('y');
            $month = date('m');
            
            $drcrlist = ['DR' => ['DV', 'directdebit'], 'CR' => ['DR', 'directcredit']];

            $type = (isset($drcrlist[$dr_cr]) && !empty($drcrlist[$dr_cr]) ) ? $drcrlist[$dr_cr] : null;

            
            $sr_no = $this->am->getMaxSRNo($type[0], $type[1], $year );
           
            //$bank_account_id = $this->am->fetch_bank_account_id($bank);
                                            
            $data = array(
                "receipt_no"    => $sr_no,
                "bank_id"       => $bank,
                "amount"        => $amount,
                "isdrcr"        => $dr_cr,
                "docdate"       => $date,
                "narration"     => $narration,                
            );

            if($dr_cr == "DR") {
                $data['debitaccid']     = $sub_category;
                $data['creditaccid']    = $account_head;//$bank_account_id;
            } else if($dr_cr == "CR") {
                $data['debitaccid']     = $account_head;//$bank_account_id;
                $data['creditaccid']    = $sub_category;
            }
            
            $res = $this->am->add_direct_bank_drcr($data, $type[1]);
            
            $acctype = $this->am->get_paymode_chracctype($sub_category);
            
            if($acctype->chracctype == "1")
            {                                
                $data2 = array(
                    "sr_no" => $sr_no,
                    "cr_parent_id" =>$account_head,
                    "credit" =>$amount,
                    "dr_parent_id" => $sub_category,
                    "note" =>$narration,
                    "datetime" =>$date,
                    "is_invoice_generated" => "1"
                );
            }
            else if($acctype->chracctype == "2")
            {
                $data2 = array(
                    "sr_no" => $sr_no,
                    "dr_parent_id" =>$account_head,
                    "debit" =>$amount,
                    "cr_parent_id" => $sub_category,
                    "note" =>$narration,
                    "datetime" =>$date,
                    "is_invoice_generated" => "1"
                );
            }            
                                
            $res2 = $this->am->add_acc_commission_ledger($data2);                   
            echo $sr_no;
            
        }
    }
    
        // 2023-08-12
    public function bank_deposit()
    {
        if($this->session->userdata("session_role") == "admin")
        {
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $data["account_head"] =$this->am->get_account_head_for_general_receipt();
            $data["sub_category"] = $this->am->fetch_sub_category();
            $data["cheque_number"] = $this->am->fetch_cheque_number();
            $data["account_number"] =$this->am->get_bank_details();
                        
            $this->load->view("header",$pro_data);
            $this->load->view("bank_deposit",$data);
            $this->load->view("footer",$pro_data);
        }
        else
        {
            redirect("login");
        }
    }

    // 2023-08-12
    public function add_bank_deposit() {
        if($this->session->has_userdata('logged_in')) 
          {
                $account_head = $this->input->post("account_head");
                $date = $this->input->post("date");
                $sub_category = $this->input->post("sub_category");
                $amount = $this->input->post("amount");
                $narration = $this->input->post("narration");
                $paymode = $this->input->post("paymode");
                $cash_release = $this->input->post("cash_release");
                $bank  = $this->input->post("bank");
                $bank_branch = $this->input->post("bank_branch");
                $cheque_no = $this->input->post("cheque_no");
                $transaction_no  = $this->input->post("transaction_no");
                $trans_date = $this->input->post("trans_date");
                
                
                $date = date("Y-m-d H:i:s");
                $year = date('y');
                $month = date('m');
                
               

                if($month < 4)
                {
                   $year = $year-1;
                }
                
                $x = 0;
                
                $another_head ="";
                $bank_id ="";
                
                if($cash_release == "Petty_Cash")
                {
                    $another_head = "acc10";
                    do 
                    {
                      $x++;
                      $mv_no = "PC".$x."/".$year;
                    } 
                    while($this->am->check_pc_receipt_no_already_exits($mv_no));
                }
                else 
                {
                    $another_head = "acc9";
                    do 
                    {
                      $x++;
                      $mv_no = "MV".$x."/".$year;
                    } 
                    while($this->am->check_mv_receipt_no_already_exits($mv_no));
                }
                 
               if($paymode == "Cheque" || $paymode == "Transfer")
               {
                   $another_head = "acc11";
               }

                  $data = array(
                      "receipt_no" =>$mv_no,
                      "account_id" =>$account_head, 
                      "sub_category" =>$sub_category,
                      "debit" =>$amount,
                      "pay_mode" =>$paymode,
                      "transaction_date" =>$trans_date,
                      "narration" =>$narration,
                      "bank" =>$bank,
                      "branch" =>$bank_branch,
                      "cheque_no" =>$cheque_no,
                      "transaction_no"  =>$transaction_no,
                      "date_time" =>$date,
                  );
                  
                   $res = $this->am->add_mv_receipt($data);
                   
                    $acctype = $this->am->get_paymode_chracctype($sub_category);
                    
                if($acctype->chracctype == "1")
                {
                   
                    
                     $data2 = array(
                                   "sr_no" => $mv_no,
                                    "cr_parent_id" =>$account_head,
                                    "credit" =>$amount,
                                    "dr_parent_id" => $another_head,
                                    "note" =>$narration,
                                    "datetime" =>$date);
                }
                else if($acctype->chracctype == "2")
                {
                   $data2 = array(
                                   "sr_no" => $mv_no,
                                    "dr_parent_id" =>$account_head,
                                    "debit" =>$amount,
                                    "cr_parent_id" => $another_head,
                                    "note" =>$narration,
                                    "datetime" =>$date);
                }            
                                    
                   $res2 = $this->am->add_acc_commission_ledger($data2);                    
                  
                    if($res && $cheque_no != ""){


                        $data1 = array (
                                         "amount" =>$amount,
                                         "cheque_using_date" =>$trans_date,
                                         "status" =>"U",
                                         "vchaccid" =>$sub_category);
                                         
                                         
                       $res1 = $this->am->update_cheque_book($data1,$cheque_no);                     
                    }
                   
                 
                    if($paymode == "Cash")
                    { 
                      $this->calc_cash_balance($amount,$cash_release);
                    }
                    else 
                    {
                        $this->calc_cash_balance($amount,"");
                    }
                  
                  echo $mv_no;
          }
    }

    // 2023-08-12
    public function fixed_deposit()
    {
        if($this->session->userdata("session_role") == "admin")
        {
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $data["account_head"] =$this->am->get_account_head_for_general_receipt();
            $data["sub_category"] = $this->am->fetch_sub_category();
            $data["cheque_number"] = $this->am->fetch_cheque_number();
            $data["account_number"] =$this->am->get_bank_details();
            
            $this->load->view("header",$pro_data);
            $this->load->view("fixed_deposit",$data);
            $this->load->view("footer",$pro_data);
        }
        else
        {
            redirect("login");
        }
    }

    // 2023-08-12
    public function add_fixed_deposit() {
        if($this->session->has_userdata('logged_in')) 
          {
                $account_head = $this->input->post("account_head");
                $date = $this->input->post("date");
                $sub_category = $this->input->post("sub_category");
                $amount = $this->input->post("amount");
                $narration = $this->input->post("narration");
                $paymode = $this->input->post("paymode");
                $cash_release = $this->input->post("cash_release");
                $bank  = $this->input->post("bank");
                $bank_branch = $this->input->post("bank_branch");
                $cheque_no = $this->input->post("cheque_no");
                $transaction_no  = $this->input->post("transaction_no");
                $trans_date = $this->input->post("trans_date");
                
                
                $date = date("Y-m-d H:i:s");
                $year = date('y');
                $month = date('m');
                
               

                if($month < 4)
                {
                   $year = $year-1;
                }
                
                $x = 0;
                
                $another_head ="";
                $bank_id ="";
                
                if($cash_release == "Petty_Cash")
                {
                    $another_head = "acc10";
                    do 
                    {
                      $x++;
                      $mv_no = "PC".$x."/".$year;
                    } 
                    while($this->am->check_pc_receipt_no_already_exits($mv_no));
                }
                else 
                {
                    $another_head = "acc9";
                    do 
                    {
                      $x++;
                      $mv_no = "MV".$x."/".$year;
                    } 
                    while($this->am->check_mv_receipt_no_already_exits($mv_no));
                }
                 
               if($paymode == "Cheque" || $paymode == "Transfer")
               {
                   $another_head = "acc11";
               }

                  $data = array(
                      "receipt_no" =>$mv_no,
                      "account_id" =>$account_head, 
                      "sub_category" =>$sub_category,
                      "debit" =>$amount,
                      "pay_mode" =>$paymode,
                      "transaction_date" =>$trans_date,
                      "narration" =>$narration,
                      "bank" =>$bank,
                      "branch" =>$bank_branch,
                      "cheque_no" =>$cheque_no,
                      "transaction_no"  =>$transaction_no,
                      "date_time" =>$date,
                  );
                  
                   $res = $this->am->add_mv_receipt($data);
                   
                    $acctype = $this->am->get_paymode_chracctype($sub_category);
                    
                if($acctype->chracctype == "1")
                {
                   
                    
                     $data2 = array(
                                   "sr_no" => $mv_no,
                                    "cr_parent_id" =>$account_head,
                                    "credit" =>$amount,
                                    "dr_parent_id" => $another_head,
                                    "note" =>$narration,
                                    "datetime" =>$date);
                }
                else if($acctype->chracctype == "2")
                {
                   $data2 = array(
                                   "sr_no" => $mv_no,
                                    "dr_parent_id" =>$account_head,
                                    "debit" =>$amount,
                                    "cr_parent_id" => $another_head,
                                    "note" =>$narration,
                                    "datetime" =>$date);
                }            
                                    
                   $res2 = $this->am->add_acc_commission_ledger($data2);                    
                  
                    if($res && $cheque_no != ""){


                        $data1 = array (
                                         "amount" =>$amount,
                                         "cheque_using_date" =>$trans_date,
                                         "status" =>"U",
                                         "vchaccid" =>$sub_category);
                                         
                                         
                       $res1 = $this->am->update_cheque_book($data1,$cheque_no);                     
                    }
                   
                 
                    if($paymode == "Cash")
                    { 
                      $this->calc_cash_balance($amount,$cash_release);
                    }
                    else 
                    {
                        $this->calc_cash_balance($amount,"");
                    }
                  
                  echo $mv_no;
          }
    }

    // 2023-08-12
    public function tds_entries()
    {
        if($this->session->userdata("session_role") == "admin")
        {
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $data["account_head"] =$this->am->get_account_head_for_general_receipt();
            $data["sub_category"] = $this->am->fetch_sub_category();
            $data["cheque_number"] = $this->am->fetch_cheque_number();
            $data["account_number"] =$this->am->get_bank_details();
                        
            $this->load->view("header",$pro_data);
            $this->load->view("tds_entries",$data);
            $this->load->view("footer",$pro_data);
        }
        else
        {
            redirect("login");
        }
    }

    // 2023-08-12
    public function add_tds_entries() {
        if($this->session->has_userdata('logged_in')) 
          {
                $account_head = $this->input->post("account_head");
                $date = $this->input->post("date");
                $sub_category = $this->input->post("sub_category");
                $amount = $this->input->post("amount");
                $narration = $this->input->post("narration");
                $paymode = $this->input->post("paymode");
                $cash_release = $this->input->post("cash_release");
                $bank  = $this->input->post("bank");
                $bank_branch = $this->input->post("bank_branch");
                $cheque_no = $this->input->post("cheque_no");
                $transaction_no  = $this->input->post("transaction_no");
                $trans_date = $this->input->post("trans_date");
                
                
                $date = date("Y-m-d H:i:s");
                $year = date('y');
                $month = date('m');
                
               

                if($month < 4)
                {
                   $year = $year-1;
                }
                
                $x = 0;
                
                $another_head ="";
                $bank_id ="";
                
                if($cash_release == "Petty_Cash")
                {
                    $another_head = "acc10";
                    do 
                    {
                      $x++;
                      $mv_no = "PC".$x."/".$year;
                    } 
                    while($this->am->check_pc_receipt_no_already_exits($mv_no));
                }
                else 
                {
                    $another_head = "acc9";
                    do 
                    {
                      $x++;
                      $mv_no = "MV".$x."/".$year;
                    } 
                    while($this->am->check_mv_receipt_no_already_exits($mv_no));
                }
                 
               if($paymode == "Cheque" || $paymode == "Transfer")
               {
                   $another_head = "acc11";
               }

                  $data = array(
                      "receipt_no" =>$mv_no,
                      "account_id" =>$account_head, 
                      "sub_category" =>$sub_category,
                      "debit" =>$amount,
                      "pay_mode" =>$paymode,
                      "transaction_date" =>$trans_date,
                      "narration" =>$narration,
                      "bank" =>$bank,
                      "branch" =>$bank_branch,
                      "cheque_no" =>$cheque_no,
                      "transaction_no"  =>$transaction_no,
                      "date_time" =>$date,
                  );
                  
                   $res = $this->am->add_mv_receipt($data);
                   
                    $acctype = $this->am->get_paymode_chracctype($sub_category);
                    
                if($acctype->chracctype == "1")
                {
                   
                    
                     $data2 = array(
                                   "sr_no" => $mv_no,
                                    "cr_parent_id" =>$account_head,
                                    "credit" =>$amount,
                                    "dr_parent_id" => $another_head,
                                    "note" =>$narration,
                                    "datetime" =>$date);
                }
                else if($acctype->chracctype == "2")
                {
                   $data2 = array(
                                   "sr_no" => $mv_no,
                                    "dr_parent_id" =>$account_head,
                                    "debit" =>$amount,
                                    "cr_parent_id" => $another_head,
                                    "note" =>$narration,
                                    "datetime" =>$date);
                }            
                                    
                   $res2 = $this->am->add_acc_commission_ledger($data2);                    
                  
                    if($res && $cheque_no != ""){


                        $data1 = array (
                                         "amount" =>$amount,
                                         "cheque_using_date" =>$trans_date,
                                         "status" =>"U",
                                         "vchaccid" =>$sub_category);
                                         
                                         
                       $res1 = $this->am->update_cheque_book($data1,$cheque_no);                     
                    }
                   
                 
                    if($paymode == "Cash")
                    { 
                      $this->calc_cash_balance($amount,$cash_release);
                    }
                    else 
                    {
                        $this->calc_cash_balance($amount,"");
                    }
                  
                  echo $mv_no;
          }
    }
    
    public function trialbalance()
    {
        if($this->session->userdata("session_role") == "admin")
        {
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $data = [];
            $this->load->view("header",$pro_data);
            $this->load->view("trialbalance",$data);
            $this->load->view("footer",$pro_data);
        }
        else
        {
            redirect("login");
        }
    }

    public function fetch_trialbalance()
    {
        if($this->session->has_userdata('logged_in')) 
        {                        
            $today = new DateTime();
            $fromdate = $this->input->post("fromdate");
            $fromdate = (empty($fromdate)) ? $today->format('Y-m-d') : $fromdate;
            $todate = $this->input->post("todate");
            $todate = (empty($todate)) ? $today->format('Y-m-d') : $todate;
            
            $dt = new DateTime(!empty($todate) ? $todate : 'now');

            $res = $this->am->trialbalance($fromdate,$todate,'account_post_data');
           // echo $this->db->last_query();

            

            $content = '<style>.vertical-text {
                            writing-mode: vertical-rl;
                            text-orientation: upright;
                        }</style>';            
            
            $content .="<table class = 'table table-bordered' style='width:100%'>
                       
                            <thead>
                                <tr>
                                    <th colspan='4' style='text-align:center'>Trial Balance</th>                                    
                                </tr>
                                <tr>
                                    <th>#</th>
                                    <th>Particulars</th>
                                    <th style='text-align:right'>Debit</th>
                                    <th style='text-align:right'>Credit</th>
                                </tr>
                            </thead>
                            <tbody>";
                            if(isset($res) && !empty($res)) {
                                $sl = 1;
                                foreach($res as $row) {
                                    $content .= "<tr>";
                                        $content .="<td>".($sl++)."</td>";
                                        $content .="<td>".$row->vchaccname."(".$row->vchaccid.")</td>";
                                            $content .="<td style='text-align:right'>".$row->debit."</td>";
                                        $content .="<td style='text-align:right'>".$row->credit."</td>";
                                    $content .= "</tr>";
                                }
                            }
                $content .= "</tbody>";
            $content .= "</table>";

            
            if($res) {
                $content .= '<script>$("#showbtn").removeClass("hide");</script>';
            } else {
                $content .= '<script>$("#showbtn").addClass("hide");</script>';
            }
            

            echo $content;
        } 
    }
    
    public function export_profitlose() {
        if($this->session->has_userdata('logged_in')) 
        {
            $today = new DateTime();
            $fromdate = $this->input->get("fromdate");
            $fromdate = (empty($fromdate)) ? $today->format('Y-m-d') : $fromdate;
            $todate = $this->input->get("todate");
            $todate = (empty($todate)) ? $today->format('Y-m-d') : $todate;
            
            $dt = new DateTime(!empty($todate) ? $todate : 'now');

            $res = $this->am->trialbalance($fromdate,$todate,'account_post_data');
                       
            $content = "<!DOCTYPE html>
                        <html>
                        <head>
                            <title>Profit and Lose between ".$fromdate." and ".$todate." </title>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    margin: 20px;
                                }
                                table {
                                    width: 100%;
                                    border-collapse: collapse;
                                }
                                th, td {
                                    padding: 8px;
                                    text-align: left;
                                    border-bottom: 1px solid #ddd;
                                }
                                th {
                                    background-color: #f2f2f2;
                                }
                            </style>
                        </head>
                        <body>                            
                         <!--   <center><p style='font-size:20px;padding-top:0px;'>Profit and Lose between ".$fromdate." and ".$todate." </p></center>  -->";            
            
            $content .="<table>
                         <tr>
                            <td colspan='4' style='text-align:center; font-size:20px; padding-top:0px;'>
                                Profit and Loss between " . $fromdate . " and " . $todate . "
                            </td>
                        </tr>
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Particulars</th>
                                    <th style='text-align:right'>INCOME</th>
                                    <th style='text-align:right'>EXPANSE</th>
                                </tr>
                            </thead>
                            <tbody>";
                            if(isset($res) && !empty($res)) {
                                $sl = 1;
                                foreach($res as $row) {
                                    $content .= "<tr>";
                                        $content .="<td>".($sl++)."</td>";
                                        $content .="<td>".$row->vchaccname."(".$row->vchaccid.")</td>";
                                            $content .="<td style='text-align:right'>".$row->debit."</td>";
                                        $content .="<td style='text-align:right'>".$row->credit."</td>";
                                    $content .= "</tr>";
                                }
                            }
                $content .= "</tbody>";
            $content .= "</table>";

            $content .= "</body></html>";

            $this->load->library('pdf');
            $this->pdf->loadHtml($content);
            $this->pdf->render();
            $filename = "Profit and Lose between ".$fromdate." and ".$todate."";
            $this->pdf->stream("'$filename'".".pdf", array("Attachment" => false));
            
           
        } 
    }

    public function export_balancesheet() {
        if($this->session->has_userdata('logged_in')) 
        {
            $today = new DateTime();
            $fromdate = $this->input->get("fromdate");
            $fromdate = (empty($fromdate)) ? $today->format('Y-m-d') : $fromdate;
            $todate = $this->input->get("todate");
            $todate = (empty($todate)) ? $today->format('Y-m-d') : $todate;
            
            $dt = new DateTime(!empty($todate) ? $todate : 'now');

            $res = $this->am->trialbalance($fromdate,$todate,'account_post_data');
            //echo $this->db->last_query();

            

            $content = "<!DOCTYPE html>
                        <html>
                        <head>
                            <title>Balance Sheet between ".$fromdate." and ".$todate." </title>
                            <style>
                                body {
                                    font-family: Arial, sans-serif;
                                    margin: 20px;
                                }
                                table {
                                    width: 100%;
                                    border-collapse: collapse;
                                }
                                th, td {
                                    padding: 8px;
                                    text-align: left;
                                    border-bottom: 1px solid #ddd;
                                }
                                th {
                                    background-color: #f2f2f2;
                                }
                            </style>
                        </head>
                        <body>                            
                           <!--  <center><p style='font-size:20px;padding-top:0px;'>Balance Sheet between ".$fromdate." and ".$todate." </p></center> -->";            
                        
            $content .="<table>
                             <tr>
                            <td colspan='4' style='text-align:center; font-size:20px; padding-top:0px;'>
                                Balance Sheet between " . $fromdate . " and " . $todate . "
                            </td>
                        </tr>
                            <thead>                                
                                <tr>
                                    <th>#</th>
                                    <th>Particulars</th>
                                    <th style='text-align:right'>ASSETS</th>
                                    <th style='text-align:right'>LIABILITIES</th>
                                </tr>
                            </thead>
                            <tbody>";
                            if(isset($res) && !empty($res)) {
                                $sl = 1;
                                foreach($res as $row) {
                                    $content .= "<tr>";
                                        $content .="<td>".($sl++)."</td>";
                                        $content .="<td>".$row->vchaccname."(".$row->vchaccid.")</td>";
                                            $content .="<td style='text-align:right'>".$row->debit."</td>";
                                        $content .="<td style='text-align:right'>".$row->credit."</td>";
                                    $content .= "</tr>";
                                }
                            }
                $content .= "</tbody>";
            $content .= "</table>";
            $content .= "</body></html>";

            

            $this->load->library('pdf');
            $this->pdf->loadHtml($content);
            $this->pdf->render();
            $filename = "Balance Sheet between ".$fromdate." and ".$todate."";
            $this->pdf->stream("'$filename'".".pdf", array("Attachment" => false));
                    
            
        }
    }
    
    // 2023-08-12
    public function jvlist() {

        if($this->session->has_userdata('logged_in')) 
        {
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $data["data"] =$this->am->get_sub_ledgers();
            $this->load->view('header',$pro_data);
            $this->load->view('jvlist',$data);
            $this->load->view('footer',$pro_data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function fetch_jvlist()
    {
        if($this->session->has_userdata('logged_in')) 
        {                        
            $today = new DateTime();
            $fromdate = $this->input->post("fromdate");
            $todate = $this->input->post("todate");
            $fromdate = (empty($fromdate)) ? $today->format('Y-m-d') : $fromdate;
            $todate = (empty($todate)) ? $today->format('Y-m-d') : $todate;
            
            //$dt = new DateTime(!empty($fromdate) ? $fromdate : 'now');

            $res = $this->am->fetch_jvlist($fromdate,$todate);
            $tot_dr = $tot_cr = 0;
            if(isset($res) && !empty($res)) {
                foreach($res as $row) {
                    $jv[$row['journal_no']] = ['journal_no' => $row['journal_no'],'transaction_date' => $row['trans_date'], 'narration' => $row['narration']];
                    $jvdetails[$row['journal_no']][] = $row;
                }
            }

            $content = '<style>.vertical-text {
                            writing-mode: vertical-rl;
                            text-orientation: upright;
                        }</style>';
            //$content .= "<h4 align='center' style='font-weight: bold'>Day Book as on ".$dt->format('d-M-Y')."</h4>";

            $receipt_tbl = "<div class='table-with-scrollbar'>";
            $receipt_tbl .="<table class = 'table table-bordered' style='width:100%'>
                            <thead>
                                
                                <tr>
                                    <th>Date</th>
                                    <th>JV No</th>
                                    <th>Particulars</th>
                                    <th style='text-align:right'>Debit</th>
                                    <th style='text-align:right'>Credit</th>
                                </tr>
                            </thead>
                            <tbody>";
                            if(isset($jv) && !empty($jv)) {
                                
                                foreach($jv as $jvno => $row) {
                                    $rowspan = (isset($jvdetails[$jvno]) && !empty($jvdetails[$jvno])) ? (count($jvdetails[$jvno])+1) : 1;                                    
                                    $receipt_tbl .= "<tr>";
                                        $receipt_tbl .="<td rowspan='".$rowspan."'>".$row['transaction_date']."</td>";
                                        $receipt_tbl .="<td rowspan='".$rowspan."'>".$row['journal_no']."</td>";
                                        if(isset($jvdetails[$jvno]) && !empty($jvdetails[$jvno])) {
                                            foreach($jvdetails[$jvno] as $key => $subrow) {
                                                $receipt_tbl .="<td>".$subrow['account_name']." ( ".$subrow['sub_category_name']." ) </td>";
                                                $receipt_tbl .="<td style='text-align:right'>".$subrow['debit']."</td>";                                            
                                                $receipt_tbl .="<td style='text-align:right'>".$subrow['credit']."</td>";                                               
                                                $receipt_tbl .="</tr><tr>";     
                                                $tot_dr += $subrow['debit'];                                           
                                                $tot_cr += $subrow['credit'];                                           
                                            }
                                        }
                                        $receipt_tbl .="<td>".$row['narration']."</td>";
                                        
                                    $receipt_tbl .= "</tr>";
                                    
                                }
                            }
                $receipt_tbl .= "</tbody>";
                $receipt_tbl .= "<tfoot>";
                    $receipt_tbl .= "<tr>";
                        $receipt_tbl .= "<td colspan='3' style='text-align: right'>Total</td>";
                        $receipt_tbl .= "<td style='text-align: right;'><h4><strong>".$tot_dr."</strong></h4></td>";
                        $receipt_tbl .= "<td style='text-align: right'><h4><strong>".$tot_cr."</strong></h4></td>";
                    $receipt_tbl .= "</tr>";
                $receipt_tbl .= "</tfoot>";
            $receipt_tbl .= "</table></div>";

           
            $content .= "<div class='row'>
                            <div class='col-md-12'>
                                ".$receipt_tbl."
                            </div>
                        </div>";

            echo $content;
        } 
    }

    public function fetch_apply_forms()
    {
        if($this->session->has_userdata('logged_in')) 
        {
            $accid = $this->input->post("accid");
            
            $data = $this->am->get_account_details($accid);
            $res = $this->am->get_child_account_tree($accid);

            // echo '<pre>';print_r($data);print'</pre>';

            $selforms = explode(",", $data->forms);
            array_walk($selforms, function(&$element) {
                $element = str_replace(' ', '', $element);
            });
            

            $formlists = [
                'GR' => 'General Receipt', 
                'MV' => 'Main Cash Voucher', 
                'JV' => 'Journal Voucher', 
                'FV' => 'Fixed Deposit Voucher', 
                'BV' => 'Bank Deposit Voucher',
                'DV' => 'Direct Debit / Credit in Bank Statement',
                'TV' => 'T.D.S Entries'                
            ];
?>
            
            <div class="form-group">                
                <label><strong><?=$data->vchaccname?> Ledger</strong></label>
                <input type="hidden" id="ledger_id" name="ledger_id" value="<?=$data->vchaccid?>"/>
            </div>
            
            <div class="form-group">
                <label>Apply Form</label>
                <select class="form-control select2 edit-forms" style='width:100%'  multiple name="txt_apply_form[]" id="txt_apply_form[]">
                    <?php if(isset($formlists) && !empty($formlists)):?>
                    <?php foreach($formlists as $fkey => $fname):?>
                        <option value="<?=trim($fkey)?>" <?=(in_array(trim($fkey), $selforms)) ? "selected" : ""?>><?=$fname?></option>
                    <?php endforeach;?>
                    <?php endif;?>
                </select>
            </div>
            
            <div class="pull-right">
            <button type="button" class="btn btn-sm btn-primary" id="edit_forms_btn">Update</button> &nbsp;
            <button type="button" class="btn btn-sm btn-secondary" id="clr_forms_btn" onclick="$('#edit_forms').html('')">Close</button>
            </div>
<?php            
           
                
               
        }
    }


    // 2023-08-12
    public function edit_ledger_forms()
    {
      if($this->session->has_userdata('logged_in')) 
       {
        
           $response = ['status' => false];              
           $main_ledger_id = $this->input->post("main_ledger_id");
           
           $forms = $this->input->post("forms");
           
           $forms = (isset($forms[0]) && !empty($forms[0])) ? implode(",", $forms[0]) : "";
                                         
            $data = array(
               "forms"       => $forms
            );
        
            if($res = $this->am->update_apply_forms($data, $main_ledger_id, "account_tree")) {                
               $res0 = $this->am->update_apply_forms($data, $main_ledger_id, "account_tree_orc");                
               $response = ['status' => true, 'vchaccid' => $main_ledger_id];              
            }
            
           echo json_encode($response);
       }
    }
    
    public function daybook() {

        if($this->session->has_userdata('logged_in')) 
        {
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $data["data"] =$this->am->get_sub_ledgers();
            $this->load->view('header',$pro_data);
            $this->load->view('daybook',$data);
            $this->load->view('footer',$pro_data);
        } else {
            redirect('login', 'refresh');
        }
    }

    public function fetch_daybook()
    {
        if($this->session->has_userdata('logged_in')) 
        {                        
            $today = new DateTime();
            $date = $this->input->post("date");
            $date = (empty($date)) ? $today->format('Y-m-d') : $date;
            
            $dt = new DateTime(!empty($date) ? $date : 'now');

            $res = $this->am->fetch_view_accounts_ledger(null,null,$date,$date,null, null, null, 'account_post_data');
            //echo $this->db->last_query();

            $content = '<style>.vertical-text {
                            writing-mode: vertical-rl;
                            text-orientation: upright;
                        }</style>';
            $content .= "<h4 align='center' style='font-weight: bold'>Day Book as on ".$dt->format('d-M-Y')."</h4>";

            $receipt_tbl = '';
            $receipt_tbl .="<table class = 'table table-bordered' style='width:100%'>
                            <thead>
                                <tr>
                                    <th colspan='4' style='text-align:center'>Receipts</th>                                    
                                </tr>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Particulars</th>
                                    <th style='text-align:right'>Amount</th>                                    
                                </tr>
                            </thead>
                            <tbody>";
                            if(isset($res) && !empty($res)) {
                                foreach($res as $row) {
                                    if($row->credit > 0){
                                        $receipt_tbl .= "<tr>";
                                            $receipt_tbl .="<td>".$row->lead_id."</td>";
                                                $receipt_tbl .="<td>".$row->note."(".$row->dr_parent_id.")</td>";
                                            $receipt_tbl .="<td style='text-align:right'>".$row->credit."</td>";
                                        $receipt_tbl .= "</tr>";
                                    }
                                    
                                }
                            }
                $receipt_tbl .= "</tbody>";
            $receipt_tbl .= "</table>";


            $payment_tbl = '';
            $payment_tbl .="<table class = 'table table-bordered' style='width:100%'>
                            <thead>
                                <tr>                                    
                                    <th colspan='4' style='text-align:center'>Payments</th>
                                </tr>
                                <tr>
                                    <th>Sr No</th>
                                    <th>Particulars</th>
                                    <th style='text-align:right'>Amount</th>                                    
                                </tr>
                            </thead>
                            <tbody>";
                            if(isset($res) && !empty($res)) {
                                foreach($res as $row) {
                                    if($row->debit > 0) {
                                        $payment_tbl .= "<tr>";
                                            $payment_tbl .="<td>".$row->sr_no."</td>";
                                                $payment_tbl .="<td>".$row->cr_parent_id."</td>";
                                            $payment_tbl .="<td style='text-align:right'>".$row->debit."</td>";
                                        $payment_tbl .= "</tr>";
                                    }                                    
                                }
                            }
                $payment_tbl .= "</tbody>";
            $payment_tbl .= "</table>";

            $content .= "<div class='row'>
                            <div class='col-md-12'>
                                <div class='col-md-5'>
                                ".$receipt_tbl."
                                </div>
                                <div class='col-md-2'>
                                </div>
                                <div class='col-md-5'>
                                ".$payment_tbl."
                                </div>
                            </div>
                        </div>";
                        

            $content .= "<br/>";

            $content .="<table class = 'table table-bordered' style='width:20%'>
                        <tbody>
                            <tr>
                                <th width='20%'>Opening Balance</th>
                                <td width='2%'>:</td>
                                <td width='5%' style='text-align:right'>0.00</td>
                            </tr>
                            <tr>
                                <th>Receipts Total</th>
                                <td>:</td>
                                <td style='text-align:right'>0.00</td>
                            </tr>
                            <tr>
                                <th>Chq. Rcpt. Total</th>
                                <td>:</td>
                                <td style='text-align:right'>0.00</td>
                            </tr>
                            <tr>
                                <th>Total</th>
                                <td>:</td>
                                <td style='text-align:right'>0.00</td>
                            </tr>
                            <tr>
                                <th>Cheques Deposits</th>
                                <td>:</td>
                                <td style='text-align:right'>0.00</td>
                            </tr>
                            <tr>
                                <th>Cash Deposits</th>
                                <td>:</td>
                                <td style='text-align:right'>0.00</td>
                            </tr>
                            <tr>
                                <th>Payments Total</th>
                                <td>:</td>
                                <td style='text-align:right'>0.00</td>
                            </tr>
                            <tr>
                                <th>Closing Balance</th>
                                <td>:</td>
                                <td style='text-align:right'>0.00</td>                                
                            </tr>
                        </tbody>
                    </table>";
                            
            $content .= '<br/>';

            $bankaccounts = [];

            $content .="<table class = 'table table-bordered' style='width:100%'>
                            <thead>                                
                                <tr>
                                    <th>Bank Name</th>
                                    <th style='text-align:right'>Opening Balance</th>                                                                        
                                    <th style='text-align:right'>Debit Amount No</th>
                                    <th style='text-align:right'>Credit Amount</th>
                                    <th style='text-align:right'>Closing Balance</th>
                                </tr>
                            </thead>
                            <tbody>";
                            if(isset($bankaccounts) && !empty($bankaccounts)) {
                                foreach($bankaccounts as $row) {
                                    $content .= "<tr>";
                                        $content .="<td>".$row->sr_no."</td>";
                                        $content .="<td>".$row->dr_parent_id."</td>";
                                        $content .="<td>".$row->credit."</td>";
                                    $content .="</tr>";
                                }
                            }
                $content .= "</tbody>";
            $content .= "</table>";

            echo $content;
        } 
    }
}

?>