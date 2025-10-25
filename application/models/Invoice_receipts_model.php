<?php
defined('BASEPATH') or exit('No direct script access allowed');

class invoice_receipts_model extends CI_Model
{
    private $table = "invoice_receipts";
    
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
}