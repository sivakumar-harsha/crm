<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Privilege_model extends CI_Model
{
    private $table = "privileges";
    
    public function __construct()
    {
        parent::__construct();
        // Set orderable column fields
        $this->column_order = array(null, 'name');
        // Set searchable column fields
        $this->column_search = array('name');
        // Set default order
        $this->order = array('name' => 'asc');
    }
    
    public function getRows($postData){
        $this->_get_datatables_query($postData);
        if($postData['length'] != -1){
            $this->db->limit($postData['length'], $postData['start']);
        }
        $query = $this->db->get();
        return $query->result();
    }
    
    public function countAll(){
        $this->db->from($this->table);
        return $this->db->count_all_results();
    }
    
    public function countFiltered($postData){
        $this->_get_datatables_query($postData);
        $query = $this->db->get();
        return $query->num_rows();
    }
    
    private function _get_datatables_query($postData){
         
        $this->db->from($this->table);
 
        $i = 0;
        // loop searchable columns 
        foreach($this->column_search as $item){
            // if datatable send POST for search
            if($postData['search']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like($item, $postData['search']);
                }else{
                    $this->db->or_like($item, $postData['search']);
                }
                
                // last loop
                if(count($this->column_search) - 1 == $i){
                    // close bracket
                    $this->db->group_end();
                }
            }
            $i++;
        }
         
        if(isset($postData['order'])){
            $this->db->order_by($this->column_order[$postData['order']['0']['column']], $postData['order']['0']['dir']);
        }else if(isset($this->order)){
            $order = $this->order;
            $this->db->order_by(key($order), $order[key($order)]);
        }
    }
    
    public function addPrivilege($data)
    {
        if( $this->db->insert( $this->table, $data ) ) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updatePrivilege($id, $data)
    {
        $options = array('id' => $id);
        $this->db->where($options);
        
        if( $this->db->update( $this->table, $data ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function deletePrivilege($id)
    {
        $options = array('id' => $id);
        $this->db->where($options);
        
        if( $this->db->delete( $this->table ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function deletebulikPrivilege($id)
    {
        $ids = explode(",", $id);
        $this->db->where_in('id', $ids);
        
        if( $this->db->delete( $this->table ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function getAllPrivilege( $options = [] ){
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
    
    public function getPrivilege($id) {
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