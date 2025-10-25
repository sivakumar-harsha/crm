<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PermissionController extends CI_Controller {
    public $masterModel;
    public $privilegeModel;
    public $permissionModel;
    public $form;
    public $cookie;
    public $audit;
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
        $this->load->library('session');
        $this->load->library('audit');
        $this->load->helper('form');
        $this->load->helper('url');
    }
    
    function index() {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        $data = $projectData = [];
        
        $projectinfo = $this->masterModel->fetch_project_info();
        $projectData['project_info'] = $projectinfo;
        
        $result = $this->privilegeModel->getAllPrivilege();
        
        $data['privilegelist'] = $result;
        
        $this->load->view('header',$projectData);
		$this->load->view('privilege/permission/index',$data);
		$this->load->view('footer',$projectData);
    }
    
    function create() {
        if( !( $this->session->has_userdata('logged_in') ) ){
    		return false;
    	}
    	if($this->auth->can_access("Create Permission")){
    	    $data = [];
        	$grouplist = $this->privilegeModel->getAllPrivilege();
        	$data['grouplist'] = $grouplist;
        	$this->load->view('privilege/permission/model', $data);
    	} else {
    	    show_error("No permission defined for %s/%s",
            "Permission","Add");
    	}
    	
    }
    
    function getLists(){
        $data = $row = array();
        
        
        $result = $this->permissionModel->getRows($_POST);
        
        $i = $_POST['start'];
        foreach($result as $row){
            $i++;
            
            $actions = '';
            
            $msg = "'Permission Denied. Sorry, you do not have permission to access this page'";
            
            if($this->auth->can_access('Edit Permission')){
                $actions .= '<a href="javascript:edit_permission('.$row->id.')" class="btn btn-primary" title="Edit Permission">Edit</a>&nbsp;';
            } else {
                $actions .= '<a href="javascript:swal('.$msg.')" class="btn btn-primary" title="Edit Permission">Edit</a>&nbsp;';
            }
            
            if($this->auth->can_access('Delete Permission')){
                $actions .= '<button class="btn btn-danger confirm-del-btn" title="Delete Permission" value="'.$row->id.'">Delete</button>';
            } else {
                $actions .= '<button onclick="swal('.$msg.')" class="btn btn-danger" title="Delete Permission" value="'.$row->id.'">Delete</button>';
            }
            
            // $actions = '<a href="javascript:edit_permission('.$row->id.')" class="btn btn-primary" title="Edit Permission">Edit</a>&nbsp;';
            //     $actions .= '<button value="'.$row->id.'" class="btn btn-danger confirm-del-btn" title="Delete Permission">Delete</button>';
                
                
            $data[] = array($i, $row->group, $row->name, $actions);
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->permissionModel->countAll(),
            "recordsFiltered" => $this->permissionModel->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }
    
    public function ajaxDataTable() {
        $data = [];
        $result_total = $total_filter = 0;
        $result = $this->permissionModel->getAllPermission();
        
        if( isset( $result ) && !empty( $result ) ){
            $result_total = $total_filter = count($result);
            $i = 1;
            foreach( $result as $row ) {
                $actions = '<a href="javascript:edit_permission('.$row['id'].')" class="btn btn-primary" title="Edit Permision">Edit</a>&nbsp;';
                $actions .= '<a href="javascript:delete_permission('.$row['id'].')" class="btn btn-danger" title="Delete Permision">Delete</a>';
                
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
    
    function store() {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        $response = [
            'status'    => false,
            'callback' => 'true',
            'msg'       => 'Successfully Permission added'
        ];
        $request = $this->input->post();
        if( isset( $request ) && !empty( $request ) ) {
            $id = ( isset( $request['id'] ) && !empty( $request['id'] ) ) ? $request['id'] : '';
            
            $data = [
                'permission_group_id'   => $request['group_id'],
                'name'                  => $request['permission_name'],
            ];
            if( $id ) {
                $old_data = $this->permissionModel->getPermission($id);
                if( $this->permissionModel->updatePermission($id, $data) ) {
                    $this->audit->log('permission', 'UPDATE', null, $old_data, $data);
                    $response = [
                        'status'    => true,
                        'method'    => 'update',
                        'msg'       => 'Successfully Permission updated'
                    ];
                }
            } else {
                if( $this->permissionModel->addPermission($data) ) {
                    $this->audit->log('permission', 'INSERT', null, null, $data);
                    $response = [
                        'status'    => true,
                        'method'    => 'create',
                        'msg'       => 'Successfully Permission added'
                    ];
                }
            }
            
            echo json_encode($response);
        }
    }
    
    function update($id) {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        if( $id ) {
            $data               = [];
            $result             = $this->permissionModel->getPermission($id);
    	    $grouplist          = $this->privilegeModel->getAllPrivilege();
    	    $data['result']     = $result;
    	    $data['grouplist']  = $grouplist;
    	    
    	    $this->load->view('privilege/permission/model', $data);
        } else {
            redirect('PermissionController/index', 'refresh');
        }
    }
    
    function delete($id) {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        $response = [
            'status'    => false,
            'msg'       => 'unable to delete this permission'
        ];
        if( $id ) {
            $data   = [];
            $old_data = $this->permissionModel->getPermission($id);
            if($this->permissionModel->deletePermission($id)){
                $this->audit->log('permission', 'DELETE', null, $old_data, null);
                $response = [
                    'status'    => true,
                    'msg'       => 'Successfully Permission deleted',
                    'status_text' => 'Successfully Permission deleted',
                    'status_icon'   => 'success'
                ];
            }
        }
        echo json_encode($response);
        exit;
    }
}