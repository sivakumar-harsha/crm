<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RoleController extends CI_Controller
{
     public $masterModel;
    public $privilegeModel;
    public $permissionModel;
    public $roleModel;
    public $rolepermissionModel;
    public $userroleModel;
    public $lm;
     public $auth;
    public $audit;
    public $cookie;
    public $url;
    public $db;
    public $database;
    public $session;
    function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('MasterMod','masterModel');
        $this->load->model('privilege_model', 'privilegeModel');
        $this->load->model('permission_model', 'permissionModel');
        $this->load->model('role_model', 'roleModel');
        $this->load->model('role_permission_model', 'rolepermissionModel');
        $this->load->model('userrole_model', 'userroleModel');
        $this->load->model('LeadMod','lm');
        $this->load->library('session');
        $this->load->library('audit');
        $this->load->helper('url');
    }
    
    public function index()
    {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        $data = $projectData = [];
        
        $projectinfo = $this->masterModel->fetch_project_info();
        $projectData['project_info'] = $projectinfo;
        
        $this->load->view('header',$projectData);
		$this->load->view('privilege/role/index',$data);
		$this->load->view('footer',$projectData);
    }
    
    function getLists(){
        $data = $row = array();
        
        
        $result = $this->rolepermissionModel->getRows($_POST);
        
        $i = $_POST['start'];
        foreach($result as $row){
            $i++;
            $actions = '<a href="'.base_url('update_role/'.$row->role_id).'" class="btn btn-primary" title="Edit Role">Edit</a>&nbsp;';
                $actions .= '<button value="'.$row->role_id.'" class="btn btn-danger confirm-del-btn" title="Delete Role">Delete</button>';
                $actions .= '<button class="btn btn-success" title="Assign Role to User" onclick="assign_role('.$row->role_id.')">Assign User</button>';
            $data[] = array($i, $row->name, $row->permission, $row->username, $actions);
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->rolepermissionModel->countAll(),
            "recordsFiltered" => $this->rolepermissionModel->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }
    
    public function ajaxDataTable() {
        $data = [];
        $result_total = $total_filter = 0;
        $result = $this->rolepermissionModel->getAllRolePermission();
        
        if( isset( $result ) && !empty( $result ) ){
            foreach( $result as $row ) {
                $roles[$row['role_id']][] = $row;
            }
            echo '<pre>';print_r($roles);print'</pre>';
            $result_total = $total_filter = count($result);
            $i = 1;
            foreach( $result as $row ) {
                $actions = '<a href="javascript:edit_permission('.$row['id'].')" class="btn btn-primary" title="Edit Permision">Edit</a>&nbsp;';
                $actions .= '<a href="javascript:delete_permission('.$row['id'].')" class="btn btn-danger" title="Delete Permision">Delete</a>';
                $actions .= '<a href="javascript:assign_role('.$row['id'].')" class="btn btn-success" title="Assign Role to User">Assign Role</a>';
                
                $data[] = array(
                    ($i++),
                    $row['group_name'],
                    $row['name'],
                    $actions
                );
            }
        }
        
        //echo '<pre>';print_r($data);print'</pre>';
        
    
        // Build response JSON
        $response = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $result_total,
            "recordsFiltered" => $total_filter,
            "data" => $data
        );
    
        // Output response as JSON
        echo json_encode($response);
        die();
    }
    
    function create() {
        if( !( $this->session->has_userdata('logged_in') ) ){
    		return false;
    	}
    	$data = [];
    	$projectinfo = $this->masterModel->fetch_project_info();
        $projectData['project_info'] = $projectinfo;
        
    	
    	$groups = $permissions = [];
    	$privilagelist = $this->privilegeModel->getAllPrivilege();
    	$result = $this->permissionModel->getAllPermission();
    	
    	
    	if( isset( $result ) && !empty( $result ) ) {
    	    foreach( $result as $row ) {
    	        $permissions[$row['group_name']][] = $row;
    	    }
    	    
    	    $groups = array_keys($permissions);
    	}
    	$data['groups']      = $privilagelist;
    	$data['permissions'] = $permissions;
    	
    	$this->load->view('header',$projectData);
    	$this->load->view('privilege/role/create', $data);
    	$this->load->view('footer',$projectData);
    }
    
    function store() {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        $response = [
            'status'    => false,
            'msg'       => 'unable to save'
        ];
        $request = $this->input->post();
        
        if( isset( $request ) && !empty( $request ) ) {
            
            $this->db->trans_begin();   # begin transaction  start 
            
            $id = ( isset( $request['role_id'] ) && !empty( $request['role_id'] ) ) ? $request['role_id'] : '';
            
            $data = [
                'name'  => $request['role_name'],
            ];
            if( $id ) {
                $old_data = $this->roleModel->getRole($id);
                if( $this->roleModel->updateRole($id, $data) ) {
                    $this->audit->log('role', 'UPDATE', null, $old_data, $data);
                    if( $this->SaveRolePermission($request) ) {
                        $response = [
                            'status'    => true,
                            'method'    => 'update',
                            'msg'       => 'Successfully Role Permission updated',
                            'redirect_url' => base_url('RoleController/index')
                        ];
                    }
                }
            } else {
                if( $this->roleModel->addRole($data) ) {
                    $this->audit->log('role', 'INSERT', null, null, $data);
                    $role_id = $this->roleModel->getID($data);
                    if( $role_id ) {
                        $request['role_id'] = $role_id;
                        if( $this->SaveRolePermission($request) ) {
                            $response = [
                                'status'    => true,
                                'msg'       => 'Successfully Role Permission Assigned',
                                'redirect_url' => base_url('RoleController/index')
                            ];
                        }
                    }
                }
            }
            
            
            if ($this->db->trans_status() === FALSE) {            
                $this->db->trans_rollback();            
            } else {
                $status = true;
                $this->db->trans_commit();               
            }   
            
            echo json_encode($response);
        }
    }
    
    function SaveRolePermission( $request ) {
        if( isset( $request['permission'] ) && 
            !empty( $request['permission'] ) ) 
        {
            $i = 0;  $status = $rolepermission = [];
            $count = $this->rolepermissionModel->getID(['role_id' => $request['role_id']]);
            if( $count ) {
                $rolepermission = $this->rolepermissionModel->getPermissionbyRole($request['role_id']);
                $this->rolepermissionModel->DeleteByRole($request['role_id']);
            }
            foreach( $request['permission'] as $permission ) {
                $role_permission_data[$i] = [
                    'role_id'       => $request['role_id'],
                    'permission_id' => $permission
                ];
                // if($this->rolepermissionModel->addRolePermission($role_permission_data[$i])){
                //     $status[] = 'true';
                // } else {
                //     $status[] = 'false';
                // }
                $i++;
            }
            
            if( $this->rolepermissionModel->addRolePermissionBatch($role_permission_data)) 
            {
                $this->audit->log('role_has_permission', 'UPDATE', null, $rolepermission, $role_permission_data);
                return true;
            }
            
            // if(!in_array('false', $status)){
            //     return true;
            // }
        }
        
        return false;
    }
    
    function update($id) {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        if( $id ) {
    	    $data = $groups = $permissions = [];
        	$privilagelist  = $this->privilegeModel->getAllPrivilege();
        	$result         = $this->permissionModel->getAllPermission();
    	    $roles          = $this->roleModel->getRole($id);
    	    $assignresult   = $this->rolepermissionModel->getAllRolePermission(['role_id' => $id]);
    	    
    	    if( isset( $assignresult ) && !empty( $assignresult ) ){
    	        foreach( $assignresult as $ap ){
    	            $assignpermission[] = $ap['permission_id'];
    	        }
    	    }
    	    
        	if( isset( $result ) && !empty( $result ) ) {
        	    foreach( $result as $row ) {
        	        $permissions[$row['group_name']][] = $row;
        	    }
        	    
        	    $groups = array_keys($permissions);
        	}
        	
        	
    	    $projectinfo = $this->masterModel->fetch_project_info();
            $projectData['project_info'] = $projectinfo;
        	
        	$data['groups']             = $privilagelist;
        	$data['permissions']        = $permissions;
    	    $data['roles']              = $roles;
    	    $data['assigndPermission']  = $assignpermission;
    	    
    	    $this->load->view('header',$projectData);
        	$this->load->view('privilege/role/update', $data);
        	$this->load->view('footer',$projectData);
        	
        } else {
            redirect('RoleController/index', 'refresh');
        }
    }
    
    function delete($id) {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        $response = [
            'status'    => false,
            'msg'       => 'unable to delete this role permission'
        ];
        if( $id ) {
            $data   = [];
            $old_rpdata = $this->rolepermissionModel->getPermissionbyRole($id);
            $old_rdata = $this->roleModel->getRole($id);
            $this->db->trans_begin();   # begin transaction  start 
            if( $this->rolepermissionModel->DeleteByRole($id) ) {
                $this->audit->log('role_has_permission', 'DELETE', null, $old_rpdata, null);
                if($this->roleModel->deleteRole($id)){
                    $this->audit->log('role', 'DELETE', null, $old_rdata, null);
                    $response = [
                        'status'        => true,
                        'msg'           => 'Successfully Role Permission deleted',
                        'status_text'   => 'Successfully Role Permission deleted',
                        'status_icon'   => 'success'
                    ];
                }
            }
            if ($this->db->trans_status() === FALSE) {            
                $this->db->trans_rollback();            
            } else {
                $status = true;
                $this->db->trans_commit();               
            }  
        }
        echo json_encode($response);
        exit;
    }
    
    public function assign_role($role_id) {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        if($role_id) {
            if($this->auth->can_access("Assign Role")){
        	    $data = [];
        	    
        	    $roles              = $this->roleModel->getRole($role_id);
            	$userslist          = $this->lm->getAllUsers();//fetch_users();
            	$options            = ['role_id' => $role_id];
            	$userrolelist       = $this->userroleModel->getAllUserRole($options);
            	if( isset( $userrolelist ) && !empty( $userrolelist ) ){
            	    foreach($userrolelist as $row ){
            	        $roleusers[] = $row['user_id'];
            	    }
            	}
            	
            	$data['userslist']  = $userslist;
            	$data['roles']      = $roles;
            	$data['roleusers']  = $roleusers;
            	
            	$this->load->view('privilege/role/model', $data);
        	} else {
        	    show_error("No permission defined for %s/%s",
                "Permission","Add");
        	}
    	
        } else {
            redirect('RoleController/index', 'refresh');
        }
    }
    
    function saveuserrole() {
        
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        $response = [
            'status'    => false,
            'msg'       => 'unable to save'
        ];
        
        $request = $this->input->post();
        
        if( isset( $request['user_id'] ) && 
            !empty( $request['user_id'] ) ) 
        {
            
            $this->db->trans_begin();   # begin transaction  start 
            
            $i = 0;  $status = $roleusers = [];
            $count = $this->userroleModel->getID(['role_id' => $request['role_id']]);
            if( $count ) {
                $roleusers = $this->userroleModel->getAllUserRole(['role_id' => $request['role_id']]);
                $this->userroleModel->DeleteByRole($request['role_id']);
            }
            foreach( $request['user_id'] as $user ) {
                $role_user_data[$i] = [
                    'role_id' => $request['role_id'],
                    'user_id' => $user
                ];
                
                $i++;
            }
            
            if( $this->userroleModel->addUserRoleBatch($role_user_data)) 
            {
                $this->audit->log('user_role', 'UPDATE', null, $roleusers, $role_user_data);
                
                $response = [
                            'status'    => true,
                            'msg'       => 'Successfully Role Assigned',
                            'redirect_url' => base_url('roles')
                        ];
                
            }
            
            
            if ($this->db->trans_status() === FALSE) {            
                $this->db->trans_rollback();            
            } else {
                $status = true;
                $this->db->trans_commit();               
            }
        }
        
        echo json_encode($response);
        
    }
    
}