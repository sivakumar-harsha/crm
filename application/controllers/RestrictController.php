<?php
defined('BASEPATH') or exit('No direct script access allowed');

class RestrictController extends CI_Controller {
    private $msg = 'Permission Denied. Sorry, you do not have permission to access this page';
    public $cm;
    public $masterModel;
    public $form;
    public $url;
    public $db;
    public $database;
    public $session;
    function __construct() {
        parent::__construct();
        
        $this->load->database();
        $this->load->model('Mainmod','masterModel');
		$this->load->model('Configmod','cm');
        $this->load->library('session');
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
        $this->load->view('header',$projectData);
		$this->load->view('errors/info',$data);
		$this->load->view('footer',$projectData);
    }
}