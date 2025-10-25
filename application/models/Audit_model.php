<?php
defined('BASEPATH') or exit('No direct script access allowed');

class audit_model extends CI_Model
{
    private $table = "audit_log";
    
    public function __construct()
    {
        parent::__construct();
    }
    
    public function addAudit($data)
    {
        if( $this->db->insert( $this->table, $data ) ) {
            return true;
        } else {
            return false;
        }
        
        // echo '<pre>';print_r($data);print'</pre>';
    }
}