<?php
defined('BASEPATH') or exit('No direct script access allowed');

class PrivilegeController extends CI_Controller {
    private $msg = 'Permission Denied. Sorry, you do not have permission to access this page';
      public $masterModel;
    public $privilegeModel;
    public $form;
    public $url;
    public $db;
    public $database;
    public $session;
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('MasterMod','masterModel');
        $this->load->model('privilege_model', 'privilegeModel');
        $this->load->library('session');
        $this->load->helper('form');
        $this->load->helper('url');
    }
    
    function index() {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        if($this->auth->can_access('List Privilege')){
            $data = $projectData = [];
        
            $projectinfo = $this->masterModel->fetch_project_info();
            $projectData['project_info'] = $projectinfo;
            
            $this->load->view('header',$projectData);
    		$this->load->view('privilege/group/index',$data);
    		$this->load->view('footer',$projectData);
        } else {
            redirect('access_denied', 'refresh');
        }
        
    }
    
    function create() {
        if( !( $this->session->has_userdata('logged_in') ) ){
    		return false;
    	}
    	if($this->auth->can_access('Create Privilege')){
        	$data = [];
        	$this->load->view('privilege/group/model', $data);
    	} else {
            redirect('access_denied', 'refresh');
        }
    }
    
    function getLists(){
        $data = $row = array();
        
        // Fetch member's records
        $result = $this->privilegeModel->getRows($_POST);
        
        $i = $_POST['start'];
        foreach($result as $row){
            $i++;
            $actions = '';
            
            $msg = "'Permission Denied. Sorry, you do not have permission to access this page'";
            
            if($this->auth->can_access('Edit Privilege')){
                $actions .= '<a href="javascript:edit_privilege('.$row->id.')" class="btn btn-primary" title="Edit Privilege">Edit</a>&nbsp;';
            } else {
                $actions .= '<a href="javascript:swal('.$msg.')" class="btn btn-primary" title="Edit Privilege">Edit</a>&nbsp;';
            }
            if($this->auth->can_access('Delete Privilege')){
                $actions .= '<button class="btn btn-danger confirm-del-btn" title="Delete Privilege" value="'.$row->id.'">Delete</button>';
            } else {
                $actions .= '<button onclick="swal('.$msg.')" class="btn btn-danger" title="Delete Privilege" value="'.$row->id.'">Delete</button>';
            }
            
            // $actions = '<a href="javascript:edit_privilege('.$row->id.')" class="btn btn-primary" title="Edit Privilege">Edit</a>&nbsp;';
            //     $actions .= '<button class="btn btn-danger confirm-del-btn" title="Delete Privilege" value="'.$row->id.'">Delete</button>';
            $data[] = array($i, $row->name, $actions);
        }
        
        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $this->privilegeModel->countAll(),
            "recordsFiltered" => $this->privilegeModel->countFiltered($_POST),
            "data" => $data,
        );
        
        // Output to JSON format
        echo json_encode($output);
    }
    
    public function ajaxDataTable() {
        $data = [];
        $result_total = $total_filter = 0;
        $result = $this->privilegeModel->getAllPrivilege();
        
        if( isset( $result ) && !empty( $result ) ){
            $result_total = $total_filter = count($result);
            $i = 1;
            foreach( $result as $row ) {
                $actions = '<a href="javascript:edit_privilege('.$row['id'].')" class="btn btn-primary" title="Edit Privilege">Edit</a>&nbsp;';
                $actions .= '<a href="javascript:delete_privilege('.$row['id'].')" class="btn btn-danger" title="Delete Privilege">Delete</a>';
                
                $data[] = array(
                    ($i++),
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
            'msg'       => 'Successfully Privileges added'
        ];
        $request = $this->input->post();
        if( isset( $request ) && !empty( $request ) ) {
            $id = ( isset( $request['id'] ) && !empty( $request['id'] ) ) ? $request['id'] : '';
            
            $data = [
                'name'  => $request['privilege_name'],
            ];
            if( $id ) {
                if( $this->privilegeModel->updatePrivilege($id, $data) ) {
                    $response = [
                        'status'    => true,
                        'method'    => 'update',
                        'msg'       => 'Successfully Privileges updated'
                    ];
                }
            } else {
                if( $this->privilegeModel->addPrivilege($data) ) {
                    $response = [
                        'status'    => true,
                        'method'    => 'create',
                        'msg'       => 'Successfully Privileges added'
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
        if($this->auth->can_access('Edit privilege')){
            if( $id ) {
                $data           = [];
                $result         = $this->privilegeModel->getPrivilege($id);
                
                $data['result'] = $result;
        	    $this->load->view('privilege/group/model', $data);
            } else {
                redirect('privileges', 'refresh');
            }
        } else {
            redirect('access_denied', 'refresh');
        }
    }
    
    function delete($id) {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        if($this->auth->can_access('Delete Privilege')){
            $response = [
                'status'    => false,
                'msg'       => 'unable to delete this privilege'
            ];
            if( $id ) {
                $data   = [];
                if($this->privilegeModel->deletePrivilege($id)){
                    $response = [
                        'status'    => true,
                        'msg'       => 'Successfully Privileges deleted',
                        'status_text' => 'Successfully Privileges deleted',
                        'status_icon'   => 'success'
                    ];
                }
            }
            echo json_encode($response);
            exit;
        } else {
            redirect('access_denied', 'refresh');
        }
    }
}