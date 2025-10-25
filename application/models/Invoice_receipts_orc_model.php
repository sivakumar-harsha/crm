<?php
defined('BASEPATH') or exit('No direct script access allowed');

class invoice_receipts_orc_model extends CI_Model
{
    private $table = "invoice_receipts_orc";
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function addInvoiceReceipt($data)
    {
        if( $this->db->insert( $this->table, $data ) ) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updateInvoiceReceipt($id, $data)
    {
        $options = array('id' => $id);
        $this->db->where($options);
        
        if( $this->db->update( $this->table, $data ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function deleteInvoiceReceipt($id)
    {
        $options = array('id' => $id);
        $this->db->where($options);
        
        if( $this->db->delete( $this->table ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function deletebulikInvoiceReceipt($id)
    {
        $ids = explode(",", $id);
        $this->db->where_in('id', $ids);
        
        if( $this->db->delete( $this->table ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function getAllInvoiceReceipt( $options = [] ){
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
    
    public function getInvoiceReceipt($id) {
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

    public function getInvoiceReceiptDetails($id) {
        $data = [];
        $this->db->select('*, (select concat(i.invno, "/", (ir.revno + 1)) from invoice_orc i, invoice_orc_revision ir where i.id = ir.invoice_orc_id and ir.id = invoice_receipts_orc.invoice_orc_revision_id) as invoice_no,
        (select distinct voucher_no from insurance_voucher_datails_orc iv, invoice_orc_revision ir where ir.id = iv.invoice_orc_revision_id and ir.id = invoice_receipts_orc.invoice_orc_revision_id) as voucher_no');
        $this->db->where('id', $id);
        $Q = $this->db->get($this->table);
        if( $Q->num_rows() > 0 ){
            $data = $Q->row_array();
        }
        $Q->free_result();
        
        return $data;
    }
}