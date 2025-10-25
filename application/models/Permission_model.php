<?php
defined('BASEPATH') or exit('No direct script access allowed');

class permission_model extends CI_Model
{
    private $table = "permission";
    
    public function __construct()
    {
        parent::__construct();
        
        // Set orderable column fields
        $this->column_order = array(null, 'privileges.name', 'permission.name');
        // Set searchable column fields
        $this->column_search = array('privileges.name','permission.name');
        // Set default order
        $this->order = array('privileges.name' => 'asc', 'permission.name' => 'asc');
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
        
        $this->db->select('privileges.name as group, permission.*');
        $this->db->join('privileges', 'privileges.id = permission.permission_group_id');
        $this->db->from($this->table);
        
        $search = ( isset( $postData['privilege_name'] ) && !empty( $postData['privilege_name'] ) ) ? $postData['privilege_name'] : '';

        if( $search )
            $this->db->where('permission_group_id', $search);

        $i = 0;
        // loop searchable columns 
        foreach($this->column_search as $item){
            // if datatable send POST for search
            if(isset($postData['search']) && $postData['search']){
                // first loop
                if($i===0){
                    // open bracket
                    $this->db->group_start();
                    $this->db->like('lower('.$item.')', strtolower($postData['search']));
                }else{
                    $this->db->or_like('lower('.$item.')', strtolower($postData['search']));
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
    
    public function addPermission($data)
    {
        if( $this->db->insert( $this->table, $data ) ) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updatePermission($id, $data)
    {
        $options = array('id' => $id);
        $this->db->where($options);
        
        if( $this->db->update( $this->table, $data ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function deletePermission($id)
    {
        $options = array('id' => $id);
        $this->db->where($options);
        
        if( $this->db->delete( $this->table ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function deletebulikPermission($id)
    {
        $ids = explode(",", $id);
        $this->db->where_in('id', $ids);
        
        if( $this->db->delete( $this->table ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function getAllPermission( $options = [] ){
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
    
    public function getPermission($id) {
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