<?php
defined('BASEPATH') or exit('No direct script access allowed');

class InvoiceController extends CI_Controller {
        public $rolepermissionModel;
    public $auth;
    public $audit_model;
    public $audit;
    public $session;
    public $upload;
    public $org_id;
    public $masterModel;
    public $rm;
    public $invoiceModel;
    public $invoicerevModel;
    public $invoicerecpModel;
     public $am; // Add this
    public $lm;

    function __construct() {
        parent::__construct();
        $this->load->library('session');
        $this->load->library('audit');
        $this->load->helper('form');
        $this->load->helper('url');

        $this->org_id = "1";
        if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
            $this->org_id = "2";

        $this->load->database();
        $this->load->model('MasterMod','masterModel');
        $this->load->model('ReportMod','rm');

        if($this->org_id == "1") {
            $this->load->model('invoice_model', 'invoiceModel');
            $this->load->model('invoice_revision_model', 'invoicerevModel');
            $this->load->model('invoice_receipts_model', 'invoicerecpModel');
        } else {
            $this->load->model('invoice_orc_model', 'invoiceModel');
            $this->load->model('invoice_orc_revision_model', 'invoicerevModel');
            $this->load->model('invoice_receipts_orc_model', 'invoicerecpModel');
        }
    }
    
    function index() {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        $data = $projectData = [];
        
        $projectinfo = $this->masterModel->fetch_project_info();
        $projectData['project_info'] = $projectinfo;
        
        $result = $this->rm->fetch_all_insurances_list();
        $companylist = [];
        if( isset( $result ) && !empty( $result ) ){
            foreach( $result as $row ) {
                $companylist[$row->id] = $row->company_name;
            }
        }
        
        $data['companylist'] = $companylist;
        
        $this->load->view('header',$projectData);
		$this->load->view('invoice/index',$data);
		$this->load->view('footer',$projectData);
    }
    
    function create() {
        if( !( $this->session->has_userdata('logged_in') ) ){
    		return false;
    	}
    	if($this->auth->can_access("Create Permission")){
    	    $data = [];
        	$grouplist = $this->privilegeModel->getAllPrivilege();
        	$data['grouplist'] = $grouplist;
        	$this->load->view('privilege/permission/model', $data);
    	} else {
    	    show_error("No permission defined for %s/%s",
            "Permission","Add");
    	}
    	
    }
    
    function getInvoiceDetails(){
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        $invoice_rev_id = $this->input->get('invoice_rev_id');
        $data = [];
        if($invoice_rev_id) {
            $result = $this->invoicerevModel->getInvoiceDetails($invoice_rev_id);  
            //echo $this->db->last_query();
            $policyTypes = $invoicelist = []; $company_name = "";
            $total_count = $total_amount = 0;
            if( isset( $result ) && !empty( $result ) ){
                foreach( $result as $row ) {
                    $policy_type = trim($row->policy_type);
                    if(!in_array($policy_type, $policyTypes))
                        array_push($policyTypes, $policy_type); 
                        
                    $invoicelist[$policy_type][] = $row->credit;
                    
                    $total_amount += $row->credit;
                    $total_count++;
                    $company_name = $row->company_name;
                    $invoices[] = $row;
                }
            }
            
            
            
            
            $data['invoices']     = $invoices;
            $data['invoicelist']  = $invoicelist;
            $data['total_count']  = $total_count;
            $data['policyTypes']  = $policyTypes;
            $data['total_amount'] = $total_amount;
            $data['company_name'] = $company_name;
            $this->load->view('invoice/ajax',$data);
        } else {
            redirect('InvoiceController/index', 'refresh');    
        }
        
        
    }
    
    function getinvoicebycompany() {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        $invoicelist = [];
        $company_id = $this->input->get('company_id');
        
        if($company_id) {
            $invoicelist = $this->invoiceModel->getInvoiceByCompany($company_id);
        }
        
        echo json_encode($invoicelist);
        
    }
    
    function getRevisionbyinv() {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        $revisionlist = [];
        $invoice_id = $this->input->get('invoice_id');
        if($invoice_id) {
            $revisionlist = $this->invoicerevModel->getRevisionByInvoice($invoice_id);
        }
        
        echo json_encode($revisionlist);
        
    }
    
    function invoiceRevisied() {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        $response = [
            'status'    => false,
            'callback' => 'true',
            'msg'       => 'unable to Invoice Revisied'
        ];
        $invoice_rev_id = $this->input->get('invoice_rev_id');
        
        
        $result         = $this->invoicerevModel->getInvoiceDetails($invoice_rev_id); 
        // echo $this->db->last_query();
        $data           = [];
        if( isset( $result ) && !empty( $result ) ) {
            $i = 0;
            foreach( $result as $row ) {
                $old_data[$i] = [
                    'company_vocher_status'     => $row->company_vocher_status,
                    'insur_commission_status'   => $row->insur_commission_status,
                    'invoice_prepared'          => 'Y',
                    'id'                        => $row->policy_id
                ];
                $data[$i] = [
                    'company_vocher_status'     => '0',
                    'insur_commission_status'   => '0',
                    'invoice_prepared'          => 'N',
                    'id'                        => $row->policy_id
                ];
                $i++;
            }
            // echo '<pre>';print_r($data);print'</pre>';
            if( $data ) {
                $status = $this->invoicerevModel->updateInvoiceDetails($data);
                //$status = true;
                if( $status ) {
                    
                    $invlicerevision = $this->invoicerevModel->getInvoiceRev($invoice_rev_id);
                    // echo $this->db->last_query();
                    if( isset( $invlicerevision ) && !empty( $invlicerevision ) ){
                        $_data = ['status' => 'D'];
                        // var_dump($invlicerevision);
                        // var_dump($_data);
                        $this->invoiceModel->updateInvoice($invlicerevision['invoice_id'], $_data);  
                        // echo $this->db->last_query();
                    }
                    
                    
                    $this->audit->log('policy_info', 'UPDATE', null, $old_data, $data);
                    $response = [
                        'status'    => true,
                        'method'    => 'update',
                        'msg'       => 'Successfully Invoice Revisied'
                    ];
                }
            } 
            
            echo json_encode($response);
        }
    }
    
    public function PaymentReceivable() {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        $data = $projectData = [];
        
        $projectinfo = $this->masterModel->fetch_project_info();
        $projectData['project_info'] = $projectinfo;
        
        $result = $this->invoiceModel->InvoiceRaisedCompanies();
        $companylist = [];
        if( isset( $result ) && !empty( $result ) ){
            foreach( $result as $row ) {
                $companylist[$row['id']] = $row['company_name'];
            }
        }
        
        $data['companylist'] = $companylist;
        
        $today = new DateTime();
        $data['receipt_date'] = $today->format('Y-m-d');
        $data['org_id'] = $this->org_id;
        $this->load->view('header',$projectData);
		$this->load->view('invoice/receivable',$data);
		$this->load->view('footer',$projectData);
    }
    
    function getInvoiceByCompanies() {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        $revisionlist = [];
        $company_id = $this->input->get('company_id');
        if($company_id) {
            $revisionlist = $this->invoiceModel->getInvoiceByCompanies($company_id);
        }
        
        echo json_encode($revisionlist);
        
    }
    
    function getInvDateByInvoice() {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        $invoices = [];
        $invoice_rev_id = $this->input->get('invoice_rev_id');
        if($invoice_rev_id) {
            $invoices       = $this->invoicerevModel->getInvoiceRev($invoice_rev_id);
            $invoiceslist   = $this->invoicerevModel->getInvoiceDetails($invoice_rev_id);
            $total = 0;$debit = 0;
            if( $invoiceslist ) {
                foreach( $invoiceslist as $row) {
                    $total += $row->credit;
                    $debit = $row->debit;
                }
            }
            $day = new DateTime($invoices['revdate']);
            $invoices['revdate']        = $day->format('d-m-Y');
            $invoices['total_amount']   = $total;
        }
        
        echo json_encode($invoices);
        
    }
    
    function store() {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        $response = [
            'status'    => false,
            'callback' => 'true',
            'msg'       => 'Successfully Permission added'
        ];
        $request = $this->input->post();
        if( isset( $request ) && !empty( $request ) ) {
            $this->load->model('invoice_receipts_model', 'invoicerecpModel');
            $id = ( isset( $request['id'] ) && !empty( $request['id'] ) ) ? $request['id'] : '';
            $today = new DateTime();
            $data = [
                //'invoice_revision_id'   => $request['invoice_rev_id'],
                'mode_of_payment'       => $request['trans_mode'],
                'receipt_date'          => $today->format('Y-m-d'),//$request['receipt_date'],
                'bank_name'             => $request['bank_name'],
                'account_no'            => $request['account_no'],
                'ifsc_code'             => $request['ifsc_code'],
                'bank_branch'           => $request['bank_branch'],
                'transaction_no'        => $request['transaction_no'],
                'transaction_date'      => $request['trans_date'],
                'cheque_no'             => $request['cheque_no'],
                'cheque_date'           => $request['cheque_date'],
                'clearance_date'        => $request['clearance_date'],
                'receipt_amount'        => $request['receipt_amount'],
                'remarks'               => $request['remarks'],
            ];
            if($this->org_id == "1") {
                $data['invoice_revision_id']    = $request['invoice_rev_id'];
                $data['tds_percentage']         = $request['tds_per'];
                $data['tds_amount']             = $request['tds_amt'];
            }

            if($this->org_id == "2") {
                $data['invoice_orc_revision_id'] = $request['invoice_rev_id'];
                $data['cgst_percentage']         = $request['cgst_per'];
                $data['cgst_amount']             = $request['cgst_amt'];
                $data['sgst_percentage']         = $request['sgst_per'];
                $data['sgst_amount']             = $request['sgst_amt'];
                $data['igst_percentage']         = $request['igst_per'];
                $data['igst_amount']             = $request['igst_amt'];
            }
            if( $id ) {
                $old_data = $this->invoicerecpModel->getInvoiceReceipt($id);
                if( $this->invoicerecpModel->updateInvoiceReceipt($id, $data) ) {
                    if($this->org_id == "1")
                        $this->audit->log('invoice_receipts', 'UPDATE', null, $old_data, $data);
                    else 
                        $this->audit->log('invoice_receipts_orc', 'UPDATE', null, $old_data, $data);
                        
                    $response = [
                        'status'    => true,
                        'method'    => 'update',
                        'msg'       => 'Successfully updated'
                    ];
                }
            } else {
                if( $this->invoicerecpModel->addInvoiceReceipt($data) ) {
                    $id = $this->db->insert_id();//$this->invoicerecpModel->getID($data);
                    if($this->org_id == "1")
                        $this->audit->log('invoice_receipts', 'INSERT', null, null, $data);
                    else
                        $this->audit->log('invoice_receipts_orc', 'INSERT', null, null, $data);
                        
                    $response = [
                        'status'    => true,
                        'method'    => 'create',
                        'msg'       => 'Successfully added'
                    ];
                }
            }
            
            if($this->org_id == "1") {
                $this->acc_own_commission_ledg($request['company_id'], $id);
            } else {
                $this->acc_own_commission_ledg($request['company_id'], $id);                
            }
            
            echo json_encode($response);
        }
    }
    
    public function acc_own_commission_ledg($company_id, $receipt_id)
    {
        if($this->session->has_userdata('logged_in')) 
        {
            $options = ['insurer_id' => $company_id];

            $this->load->model('AccountsMod', 'am');
            $this->load->model('LeadMod', 'lm');
            
            $cr_parent_id = $this->am->getID($options, "account_tree");
            $dr_parent_id = "acc21";
            
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
                                
            $sr_no = $this->lm->getMaxSRNo('IV');
            $new_sr_no =  "IV/{$sr_no}/".$year;
                

            $org_id = "1";
            if($this->session->has_userdata('session_company_type') && $this->session->userdata('session_company_type') == "unicorn")
                $org_id = "2";
            
            

            $receipts = $this->invoicerecpModel->getInvoiceReceiptDetails($receipt_id);
           
            

            if($receipts != "" || $receipts != null)
            {
                $check = 0;//$this->lm->check_ac_policy_no_already_exits($res->policy_no);
                $check0 = 0;//$this->lm->check_ac_policy_no_already_exits_orc($res->policy_no);
                
                //$ins_ledger = $this->lm->fetch_insurance_company_ledger_main($res->company);
                //$ins_ledger_orc = $this->lm->fetch_insurance_company_ledger_orc($res->company);
            
                if($this->org_id == "1") {
                    if($check < 1)
                    {
                        $data_irda = array(
                            "sr_no" =>$new_sr_no,
                            "debit" =>floor($receipts['receipt_amount']),
                            "cr_parent_id" =>$cr_parent_id,
                            "dr_parent_id" =>$dr_parent_id,
                            "tds" => floor($receipts['tds_amount']),
                            "lead_id"=>$receipts['voucher_no'],
                            "sub_id" =>$receipts['invoice_no'],
                            "insurer_id" =>$company_id,
                            "note" =>"Company commission Debit",
                            "datetime" =>date("Y-m-d H:i:s")
                        );
                        $res0 = $this->lm->add_acc_own_commission($data_irda);
                        if( $res0 ){
                            $this->audit->log('acc_commission_ledger', 'INSERT', null, null, $data_irda);
                        }
                    }  
                }
                
                if($this->org_id == "2") {
                    if($check0 < 1)
                    {
                        $data_orc = array(
                            "sr_no" =>$new_sr_no,
                            "debit" =>floor($receipts['receipt_amount']),
                            "cr_parent_id" =>$cr_parent_id,
                            "dr_parent_id" =>$dr_parent_id,
                            "tds" =>0,
                            "lead_id"=>$receipts['voucher_no'],
                            "sub_id" =>$receipts['invoice_no'],
                            "insurer_id" =>$company_id,
                            "note" =>"Company commission Debit",
                            "datetime" =>date("Y-m-d H:i:s")
                        );
                        $res1 = $this->lm->add_acc_own_commission_orc($data_orc);
                        if( $res1 ){
                            $this->audit->log('acc_commission_ledger_orc', 'INSERT', null, null, $data_orc);
                        }

                        // GST Post
                        
                        $cr_parent_id = "acc1604";
                        $dr_parent_id = $this->am->getID($options, "account_tree");
                        $gst_amount = $receipts['cgst_amount'] + $receipts['sgst_amount'] + $receipts['igst_amount'];

                        $data_orc = array(
                            "sr_no" =>$new_sr_no,
                            "debit" =>floor($gst_amount),
                            "cr_parent_id" =>$cr_parent_id,
                            "dr_parent_id" =>$dr_parent_id,
                            "tds" =>0,
                            "lead_id"=>$receipts['voucher_no'],
                            "sub_id" =>$receipts['invoice_no'],
                            "insurer_id" =>$company_id,
                            "note" =>"GST Receibable Debit",
                            "datetime" =>date("Y-m-d H:i:s")
                        );
                        $res1 = $this->lm->add_acc_own_commission_orc($data_orc);
                        if( $res1 ){
                            $this->audit->log('acc_commission_ledger_orc', 'INSERT', null, null, $data_orc);
                        }
                    }
                }                                    
            }
        }
    }
    
}