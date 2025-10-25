<?php
defined('BASEPATH') or exit('No direct script access allowed');

class invoice_model extends CI_Model
{
    private $table = "invoice";
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function addInvoice($data)
    {
        if( $this->db->insert( $this->table, $data ) ) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updateInvoice($id, $data)
    {
        $options = array('id' => $id);
        $this->db->where($options);
        
        if( $this->db->update( $this->table, $data ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function deleteInvoice($id)
    {
        $options = array('id' => $id);
        $this->db->where($options);
        
        if( $this->db->delete( $this->table ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function deletebulikInvoice($id)
    {
        $ids = explode(",", $id);
        $this->db->where_in('id', $ids);
        
        if( $this->db->delete( $this->table ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function getAllInvoice( $options = [] ){
        $data = [];
        if( $options )
            $this->db->where($options);
            
        $Q = $this->db->get($this->table);
        if( $Q->num_rows() > 0 ){
            foreach( $Q->result_array() as $row ) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    
    public function getInvoice($id) {
        $data = [];
        $this->db->where('id', $id);
        $Q = $this->db->get($this->table);
        if( $Q->num_rows() > 0 ){
            $data = $Q->row_array();
        }
        $Q->free_result();
        
        return $data;
    }
    
    
    public function getID($options)
    {
        $data = [];
        $this->db->select('id');
        $this->db->where($options);
        $Q = $this->db->get($this->table);
        
        if( $Q->num_rows() > 0 ){
            $data = $Q->row_array();
        }
        $Q->free_result();
        return (isset($data['id']) && !empty($data['id'])) ? $data['id'] : '';
    }
    
    public function getMaxInvoiceNo($year)
    {
        $data = [];
        $sql = "select 
                    cast(COALESCE(max(substring(invno, 9)), '0') as unsigned) + 1 as invno 
                from 
                    invoice 
                where 
                    left(invno, 7) = '".$year."'";
       
        $Q = $this->db->query($sql);
        
        if( $Q->num_rows() > 0 ){
            $data = $Q->row_array();
        }
        $Q->free_result();
        return (isset($data['invno']) && !empty($data['invno'])) ? $data['invno'] : $year.'/1';
    }
    
    public function getInvoiceDetails($code,$from_date,$to_date,$policy_class, $policy_gen_from, $invoice_id)
    {
        $this->db->select("acc_commission_ledger.id,list_of_policy_type.policy_type,acc_commission_ledger.credit,policy_info.lead_id");   
        $this->db->where("dr_parent_id",$code); 
        // $this->db->where("is_invoice_generated",'0'); 
        $this->db->where("list_of_leads.class",$policy_class);
        
      	$this->db->where("policy_info.{$policy_gen_from} >=",$from_date);
        $this->db->where("policy_info.{$policy_gen_from} <=",$to_date);
        
        $this->db->join("list_of_leads","acc_commission_ledger.lead_id = list_of_leads.id");
        $this->db->join("list_of_policy_type","list_of_leads.policy_type = list_of_policy_type.id");
        $this->db->join("policy_info","acc_commission_ledger.lead_id = policy_info.lead_id");
        $this->db->join("account_tree","acc_commission_ledger.dr_parent_id = account_tree.vchaccid");
        
        $this->db->where("policy_info.company_vocher_status","1");
        return $this->db->get("acc_commission_ledger")->result();
    }
    
    public function getInvoiceByCompany($company_id){
        
        $data = [];
        
        $this->db->select("id, date_format(todate, '%M - %Y') as month");
        $this->db->where('insurance_company_id', $company_id);
        $Q = $this->db->get($this->table);
        
        if( $Q->num_rows() > 0 ){
            foreach( $Q->result_array() as $row ) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    
    public function InvoiceRaisedCompanies() {
        $data = [];
        
        $sql = "Select 
                    id, company_name 
                from 
                    list_of_insurance_company 
                where 
                    id in (select insurance_company_id from invoice)";
                    
        $Q = $this->db->query($sql);
        
        if( $Q->num_rows() > 0 ){
            foreach( $Q->result_array() as $row ) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    
    public function getInvoiceByCompanies($company_id) {
        $data = [];
        
        $sql = "Select 
                    *,
                    (select sum(own_commission) from insurance_voucher_datails where invoice_revision_id = A.invoice_id) as outstand_amt,
                    (select sum(receipt_amount) from invoice_receipts where invoice_revision_id = A.invoice_id) as received_amt 
                from
                    (Select 
                        i.invno, i.insurance_company_id, i.created_date,
                        (select max(revno) from invoice_revision ir where ir.invoice_id = i.id) as revno,
                        (select max(id) from invoice_revision ir where ir.invoice_id = i.id) as invoice_id  
                    from 
                        invoice i where insurance_company_id = ".$company_id."
                )A";
                    
        $Q = $this->db->query($sql);
        
        if( $Q->num_rows() > 0 ){
            foreach( $Q->result_array() as $row ) {
                if($row['outstand_amt'] != $row['received_amt']){
                    $data[] = $row;
                }
            }
        }
        $Q->free_result();
        return $data;
    }
    
    
    public function getInvoiceByVoucher($voucher_no) {
        $data = [];
        
        $sql = "Select 
                    revno, invno, revdate 
                from 
                    invoice i, invoice_revision ir 
                where 
                    i.id = ir.invoice_id and 
                    ir.id in (select distinct invoice_revision_id from insurance_voucher_datails where voucher_no = '".$voucher_no."')";
                    
        $Q = $this->db->query($sql);
        
        if( $Q->num_rows() > 0 ){
            $data = $Q->row_array();
        }
        $Q->free_result();
        
        return $data;
    }
    
}