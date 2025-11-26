<?php

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Font;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

require_once APPPATH . '../vendor/autoload.php';

class TestCtrl extends CI_Controller {

    public $rolepermissionModel;
    public $auth;
    public $rm;
    public $mm;
    public $session;
    public $upload;
    public $audit_model;
    public $audit;
    public $invoicerevModel;
    public $invoiceorcModel;
    public $invoiceorcrevModel;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('ReportMod','rm');
		$this->load->model('MasterMod','mm');
		$this->load->library('session');
		$this->load->library('audit');
		//$this->load->library('auth');
		$this->load->helper('url');
		$this->load->helper('cookie');
		
        $this->load->library('upload');
	}

     

}