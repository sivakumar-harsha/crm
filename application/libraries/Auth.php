<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth {
    private $CI;
    
    private $role_privileges = [];
    
    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->model('role_permission_model', 'rolepermissionModel');
    }
    
    public function get_role_privileges($role_id) {
        // $result   = $this->CI->rolepermissionModel->getAllRolePermission(['role_id' => $role_id]);
    	    
    	$result   = $this->CI->rolepermissionModel->getRolePermissionByRoles($role_id);
    	
	    if( isset( $result ) && !empty( $result ) ){
	        foreach( $result as $row ){
	            $this->role_privileges[] = $row['permission_name'];
	        }
	    }
	    
	    return $this->role_privileges;
    }
    
    public function can_access($privilege_id){
        
    	if( !( $this->CI->session->has_userdata('logged_in') ) ){
    		return false;
    	}
    	
    	if($this->CI->session->userdata('session_role') == "admin"){
    	    return true;
    	}
    	
    	$role = $this->getUserRoles(); //$_SESSION['user_roles'];
    	if(empty($role)){
    		return false;
    	}
    	
    	$role_privilages = $this->get_role_privileges($role);
    	
    	if(empty($role_privilages)){
    		return false;
    	}
    	
        return in_array($privilege_id, $role_privilages);
    	
    	/*
    	if ($this->CI->input->is_ajax_request()) {
    	    if( !in_array($privilege_id, $role_privilages) ) {
    	        echo'<script>swal("Permission Denied")</script>';
    	        die();
        	}
    	} else {
    	    
    	}
    	*/
    	
    }
    
    public function getUserRoles() {
        if( !( $this->CI->session->has_userdata('logged_in') ) ){
    		return false;
    	}
    	
        $this->CI->load->model('userrole_model', 'userroleModel');
        $opt = ['user_id' => $this->CI->session->userdata('session_id')];//, 'status' => '1'
        $userroles = $this->CI->userroleModel->getAllUserRole($opt);
        
        $roles = [];
        if( isset( $userroles ) && !empty( $userroles ) ){
    	    foreach($userroles as $row ){
    	        $roles[] = $row['role_id'];
    	    }
    	}
            	
        return $roles;
    }
    
    
}