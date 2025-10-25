<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ChequeCtrl extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('AdvanceMod','am');
		$this->load->model('MasterMod','mm');
		$this->load->model('ChequeMod','cm');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('cookie'); 
		$this->load->library('upload');
	}
	

    public function cheque_details()
      {
          
           if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin")
	    {
	        $pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('cheque_details');
    		$this->load->view('footer',$pro_data);
	    }
	    else {
	        
	        redirect('home','refresh');
	    }
     
      }
      
      
      public function fetch_chequedetails()
      {
            $draw = intval($this->input->post("draw"));
            
            $cheque_status = $this->input->post("cheque_status");
            $cheque_number = $this->input->post("cheque_number");
            
    		if($cheque_status == "2")
    		{
    		   $res = $this->cm->fetch_cheque_details_gr($cheque_number);
    		}
    		else if($cheque_status == "1")
    		{
    		     $res1 = $this->cm->fetch_cheque_details_mvc($cheque_number);
                 
    		}
    		
    
    		
    	//	echo $this->db->last_query();
    	
    		$arr = []; 
            $a = 0 ;
            $cnd = 0;
            
            if($cheque_status == "2")
             {
            foreach($res as $da)
            {
                $a++;
                
            $action = "  <button class='btn btn-success btn-xs' onclick=view_data(".$da->id.")><i class='fa fa-eye'></i> view</button>";
                
                $arr[] =  
                        array(
                            $a,
                            $da->cheque_no,
                            $da->accname.'('.$da->particulars.')',
                            $da->amount,
                            $action
                        );
            }
            $cnd = count($res);
            
            }
          else if($cheque_status == "1")
            {
               foreach($res1 as $da1)
                {
                    $a++;
                
                 $action = "  <button class='btn btn-success btn-xs' onclick=view_data(".$da1->cheque_no.")><i class='fa fa-eye'></i> view</button>";
                
                   $arr[] =  
                          array(
                            $a,
                            $da1->vchcheque_character_no,
                            $da1->accname.'('.$da1->sub_name.')',
                            $da1->debit,
                      $action
                         );
              }
              
              $cnd = count($res1);
           }
            
      	   $result = array(
            			"draw"=> $draw,
    				    "recordsTotal"=>$cnd,
    				    "recordsFiltered"=> $cnd,
    				    "data"=>$arr,
    				);
            echo json_encode($result);
       }
       
       
       
       public function view_cheque_deatils()
       {
           
           $id = $this->input->post("id");
           $cheque_status = $this->input->post("cheque_status");
           

         //$res   = $this->cm->view_cheque_deatils($id);
           
           	if($cheque_status == "2")
    		{
    		   $res = $this->cm->view_cheque_deatils_gr($id);
    		}
    		else if($cheque_status == "1")
    		{
    		     $res1 = $this->cm->view_cheque_deatils_mvc($id);
                //echo $this->db->last_query();
    		}

            $content_1 = "";
            
            
   if($cheque_status == "2")   
       {
             foreach($res as $da1)
        	        {
             $content_1 .= " <div class='modal-body'>
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <div class='row'>   
                                       <div class='col-md-4'>
                                            <label>Voucher Number</label><span></span>
                                       </div>
                                       <div class='col-md-8'>
                                            <p>".$da1->receipt_no."</p>
                                       </div>
                                     </div>
                                </div>
                                
                                <div class='form-group'>
                                    <div class='row'>   
                                       <div class='col-md-4'>
                                            <label>Voucher Date</label><span></span>
                                       </div>
                                       <div class='col-md-8'>
                                            <p>".$da1->transaction_date."</p>
                                       </div>
                                     </div>
                                </div>
                           
                            <div class='form-group'>
                                <div class='row'>   
                                   <div class='col-md-4'>
                                        <label>Cheque Amount</label>
                                   </div>
                                   <div class='col-md-8'>
                                       <p  name='cheque_amount' id='cheque_amount'>".$da1->amount."</p>
                                   </div>
                                 </div>
                            </div>
                                
                                 <div class='form-group'>
                                        <div class='row'>   
                                           <div class='col-md-4'>
                                                 <label>cheque Bank</label>
                                           </div>
                                           <div class='col-md-8'>
                                               <p>".$da1->bank."</p>
                                           </div>
                                         </div>
                                 </div>
                            </div>
                            
                            <div class='col-md-6'>
                                
                                 <div class='form-group'>
                                      <div class='row'>   
                                           <div class='col-md-4'>
                                                <label>Paid To</label>
                                           </div>
                                           <div class='col-md-8'>
                                               <p>".$da1->bank."</p>
                                           </div>
                                    </div>
                                </div>
                                
                                <div class='form-group'>
                                  <div class='row'>   
                                       <div class='col-md-4'>
                                           <label>Cheque Status</label>
                                       </div>
                                        <div class='col-md-8'>
                                            <p>".$da1->cheque_status."</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class='form-group'>
                                    <div class='row'>   
                                       <div class='col-md-4'>
                                           <label>Cleared Date</label>
                                       </div>
                                        <div class='col-md-8'>
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class='form-group'>
                                     <div class='row'>   
                                       <div class='col-md-4'>
                                            <label>Deposited In</label>
                                       </div>
                                        <div class='col-md-8'>
                                            <p> </p>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                            
                        </div>
      </div>";
      
        	        }
              }
              
     else if($cheque_status == "1")
        	{
        	            
           foreach($res1 as $da)
           {
               
            
             $content_1 .= " <div class='modal-body'>
                        <div class='row'>
                            <div class='col-md-6'>
                                <div class='form-group'>
                                    <div class='row'>   
                                       <div class='col-md-4'>
                                            <label>Voucher Number</label><span></span>
                                       </div>
                                       <div class='col-md-8'>
                                            <p>".$da->receipt_no."</p>
                                       </div>
                                     </div>
                                </div>
                                
                                <div class='form-group'>
                                    <div class='row'>   
                                       <div class='col-md-4'>
                                            <label>Voucher Date</label><span></span>
                                       </div>
                                       <div class='col-md-8'>
                                            <p>".$da->transaction_date."</p>
                                       </div>
                                     </div>
                                </div>
                           
                            <div class='form-group'>
                                <div class='row'>   
                                   <div class='col-md-4'>
                                        <label>Cheque Amount</label>
                                   </div>
                                   <div class='col-md-8'>
                                       <p>".$da->debit."</p>
                                   </div>
                                 </div>
                            </div>
                                
                                 <div class='form-group'>
                                        <div class='row'>   
                                           <div class='col-md-4'>
                                                 <label>cheque Bank</label>
                                           </div>
                                           <div class='col-md-8'>
                                               <p>".$da->bank_name."</p>
                                           </div>
                                         </div>
                                 </div>
                            </div>
                            
                            <div class='col-md-6'>
                                
                                 <div class='form-group'>
                                      <div class='row'>   
                                           <div class='col-md-4'>
                                                <label>Paid To</label>
                                           </div>
                                           <div class='col-md-8'>
                                               <p>".$da->accname."(".$da->sub_name.")</p>
                                           </div>
                                    </div>
                                </div>
                                
                                <div class='form-group'>
                                  <div class='row'>   
                                       <div class='col-md-4'>
                                           <label>Cheque Status</label>
                                       </div>
                                        <div class='col-md-8'>
                                            <p>".$da->cheque_status."</p>
                                        </div>
                                    </div>
                                </div>
                                
                                <div class='form-group'>
                                    <div class='row'>   
                                       <div class='col-md-4'>
                                           <label>Cleared Date</label>
                                       </div>
                                        <div class='col-md-8'>
                                            <p>".($da->cheque_status ? $da->cheque_date : "")."</p>
                                        </div>
                                    </div>
                                </div>
                                
                                 <div class='form-group'>
                                     <div class='row'>   
                                       <div class='col-md-4'>
                                            <label>Deposited In</label>
                                       </div>
                                        <div class='col-md-8'>
                                            <p> </p>
                                        </div>
                                    </div>
                                </div>
                              
                            </div>
                            
                        </div>
      </div>";
      
        	        } 
        	        }
        	        

           echo $content_1;
           
       }
          
          
      

	
	
}