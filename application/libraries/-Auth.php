<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Auth {
    private $CI;
    
    private $role_privileges = [];
    
    public function __construct() {
        $this->$CI =& get_instance();
        $this->CI->load->model('role_permission_model', 'rolepermissionModel');
    }
    
    public function get_role_privileges($role_id) {
        $result   = $this->CI->rolepermissionModel->getAllRolePermission(['role_id' => $role_id]);
    	    
	    if( isset( $result ) && !empty( $result ) ){
	        foreach( $result as $row ){
	            $this->$role_privileges[] = $row['permission_id'];
	        }
	    }
	    
	    return $this->role_privileges;
    }
    
    function has_privilege($privilege_id){
    	if( !( $this->CI->session->has_userdata('logged_in') ) ){
    		return false;
    	}
    	
    	$role = $_SESSION['user_role'];
    	$role_privilages = $this->get_role_privileges($role);
    	if(!isset($role_privilages)){
    		return false;
    	}
    	
    	return in_array($privilege_id, $role_privilages);
    }
}