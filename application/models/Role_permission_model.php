<?php
defined('BASEPATH') or exit('No direct script access allowed');

class role_permission_model extends CI_Model
{
      public $column_order = [];
    public $column_search = [];
    public $order = [];
    private $table = "role_has_permission";
    
    public function __construct()
    {
        parent::__construct();
        
        // Set orderable column fields
        $this->column_order = array(null, 'role.name', 'permission.name');
        // Set searchable column fields
        $this->column_search = array('role.name','permission.name');
        // Set default order
        $this->order = array('role.name' => 'asc', 'permission.name' => 'asc');
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
        
        // $this->db->select('role.name, permission.name as permission,'.$this->table.'.*');
        // $this->db->join('role', 'role.id = '.$this->table.'.role_id');
        // $this->db->join('permission', 'permission.id = '.$this->table.'.permission_id');
        // $this->db->from($this->table);
        
        $this->db->select('role.name, GROUP_CONCAT(permission.name SEPARATOR ",") as permission,'.$this->table.'.*, GROUP_CONCAT(distinct admin_login.username SEPARATOR ",") as username');
        $this->db->join('role', 'role.id = '.$this->table.'.role_id');
        $this->db->join('permission', 'permission.id = '.$this->table.'.permission_id', 'LEFT OUTER');
        
        $this->db->join('user_role', 'user_role.role_id = role.id', 'LEFT');
        $this->db->join('admin_login', 'admin_login.id = user_role.user_id', 'LEFT OUTER');
        $this->db->group_by("role.name");
        $this->db->from($this->table);
        
        
        
        
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
    
    public function addRolePermission($data)
    {
        if( $this->db->insert( $this->table, $data ) ) {
            return true;
        } else {
            return false;
        }
    }
    
    public function addRolePermissionBatch($data)
    {
        if( $this->db->insert_batch( $this->table, $data ) ) {
            return true;
        } else {
            return false;
        }
    }
    
    public function updateRolePermission($id, $data)
    {
        $options = array('id' => $id);
        $this->db->where($options);
        
        if( $this->db->update( $this->table, $data ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function deleteRolePermission($id)
    {
        $options = array('id' => $id);
        $this->db->where($options);
        
        if( $this->db->delete( $this->table ) ){
            return true;
        } else {
            return false;
        }
    }
    public function DeleteByRole($role_id)
    {
        $options = array('role_id' => $role_id);
        $this->db->where($options);
        
        if( $this->db->delete( $this->table ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function deletebulikRolePermission($id)
    {
        $ids = explode(",", $id);
        $this->db->where_in('id', $ids);
        
        if( $this->db->delete( $this->table ) ){
            return true;
        } else {
            return false;
        }
    }
    
    public function getAllRolePermission( $options = [] ){
        $data = [];
        if( $options )
            $this->db->where($options);
            
        $this->db->select("{$this->table}.*, role.name as role_name");
        $this->db->join("role", "{$this->table}.role_id = role.id");
        $Q = $this->db->get($this->table);
        if( $Q->num_rows() > 0 ){
            foreach( $Q->result_array() as $row ) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
    
    public function getRolePermission($id) {
        $data = [];
        $this->db->where('id', $id);
        $Q = $this->db->get($this->table);
        if( $Q->num_rows() > 0 ){
            $data = $Q->row_array();
        }
        $Q->free_result();
        
        return $data;
    }
    
    public function getPermissionbyRole($role_id) {
        $data = [];
        $this->db->where('role_id', $role_id);
        $Q = $this->db->get($this->table);
        if( $Q->num_rows() > 0 ){
            if( $Q->num_rows() > 0 ){
            foreach( $Q->result_array() as $row ) {
                $data[] = $row;
            }
        }
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
    
    public function getRolePermissionByRoles( $roles ){
        $data = [];
        if( $roles )
            $this->db->where_in("role_id", $roles);
            
        $this->db->select("{$this->table}.*, role.name as role_name, permission.name as permission_name");
        $this->db->join("role", "{$this->table}.role_id = role.id");
        $this->db->join("permission", "{$this->table}.permission_id = permission.id");
        $Q = $this->db->get($this->table);
        if( $Q->num_rows() > 0 ){
            foreach( $Q->result_array() as $row ) {
                $data[] = $row;
            }
        }
        $Q->free_result();
        return $data;
    }
}