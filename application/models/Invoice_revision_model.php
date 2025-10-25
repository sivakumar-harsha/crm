<?php
defined('BASEPATH') or exit('No direct script access allowed');

class invoice_revision_model extends CI_Model
{
    private $table = "invoice_revision";
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function addInvoiceRev($data)
    {
        if( $this->db->insert( $this->table, $data ) ) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updateInvoiceRev($id, $data)
    {
        $options = array('id' => $id);
        $this->db->where($options);
        
        if( $this->db->update( $this->table, $data ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function deleteInvoiceRev($id)
    {
        $options = array('id' => $id);
        $this->db->where($options);
        
        if( $this->db->delete( $this->table ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function deletebulikInvoiceRev($id)
    {
        $ids = explode(",", $id);
        $this->db->where_in('id', $ids);
        
        if( $this->db->delete( $this->table ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function updateInvoiceDetails($data)
    {
        if( $this->db->update_batch( 'policy_info', $data, 'id' ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function getAllInvoiceRev( $options = [] ){
        $data = [];
        if( $options )
            $this->db->where($options);
            
        $this->db->select("{$this->table}.*, privileges.name as group_name");
        $this->db->join('privileges', "{$this->table}.permission_group_id = privileges.id");
        $Q = $this->db->get($this->table);
        if( $Q->num_rows() > 0 ){
            foreach( $Q->result_array() as $row ) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    
    public function getInvoiceRev($id) {
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
    
    public function getMaxInvRevNo($invoice_id)
    {
        $data = [];
        $sql = "select 
                    COALESCE(max(revno), '0')+1 as revno 
                from 
                    invoice_revision
                where 
                    invoice_id = '".$invoice_id."'";
       
        $Q = $this->db->query($sql);
        
        if( $Q->num_rows() > 0 ){
            $data = $Q->row_array();
        }
        $Q->free_result();
        return (isset($data['revno']) && !empty($data['revno'])) ? $data['revno'] : 0;
    }
    
    
    
    
    public function getRevisionByInvoice($invoice_id){
        $data = [];
        
        $sql = "select 
                    *, (select distinct invno from invoice where invoice.id = invoice_revision.invoice_id) as invno
                from 
                    invoice_revision
                where 
                    id in (select id from invoice_revision where invoice_id = '".$invoice_id."') order by id";
       
        $Q = $this->db->query($sql);
        
        if( $Q->num_rows() > 0 ){
            foreach( $Q->result_array() as $row ) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    
    public function getMaxRevisionByInvoice($invoice_id){
        $data = [];
        
        $sql = "select 
                    *, (select distinct invno from invoice where invoice.id = invoice_revision.invoice_id) as invno
                from 
                    invoice_revision
                where 
                    id in (select max(id) from invoice_revision where invoice_id = '".$invoice_id."')";
       
        $Q = $this->db->query($sql);
        
        if( $Q->num_rows() > 0 ){
            $data = $Q->row_array();
        }
        
        $Q->free_result();
        return (isset($data['id']) && !empty($data['id'])) ? $data['id'] : '';
    }
    
    public function getInvoiceDetails($invoice_rev_id)
    {
        $this->db->select("al.id,pt.policy_type,al.credit,p.lead_id, c.company_name, p.id as policy_id, p.company_vocher_status, p.insur_commission_status,
        (select sum(debit)  from acc_commission_ledger where insurer_id = i.insurance_company_id and lead_id = ivd.voucher_no) as debit");   
        
        $this->db->join("invoice i","i.id = ir.invoice_id");
        $this->db->join("insurance_voucher_datails ivd","ivd.invoice_revision_id = ir.id");
        
        $this->db->join('account_tree ac', "ac.insurer_id = i.insurance_company_id");
        $this->db->join('acc_commission_ledger al', "al.dr_parent_id = ac.vchaccid and al.lead_id = ivd.lead_id");
        
        $this->db->join("list_of_leads l","al.lead_id = l.id");
        $this->db->join("list_of_policy_type pt","l.policy_type = pt.id");
        $this->db->join("policy_info p","al.lead_id = p.lead_id");
        
        $this->db->join("list_of_insurance_company c","i.insurance_company_id = c.id");
        
        //$this->db->where("p.company_vocher_status","1");
        $this->db->where("ir.id",$invoice_rev_id);
        return $this->db->get("invoice_revision ir")->result();
    }
}