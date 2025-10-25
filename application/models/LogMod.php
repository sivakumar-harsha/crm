<?php
class LogMod extends CI_Model {
    
    function __construct(){
        parent::__construct();
        $this->load->dbforge();
    }
    
    public function fetch_list_of_table_name(){
        $this->db->DISTINCT();
        $this->db->select('table_name');
        $this->db->order_by('table_name','ASC');
        return $this->db->get('audit_log')->result();
    }
    public function fetch_list_of_action(){
         $this->db->DISTINCT();
        $this->db->select('action');
        $this->db->order_by('action','ASC');
        return $this->db->get('audit_log')->result();
    }
    
    public function filter_audit_log_list($table_name, $from_date, $to_date, $table_action)
    {
        $this->db->select("a.*,admin_login.username");
        $this->db->from("audit_log a");
        $this->db->join("admin_login", "admin_login.id = a.created_by", "left");
        $this->db->where("date(a.created_date) >=", $from_date);
        $this->db->where("date(a.created_date) <=", $to_date);
        if ($table_name != "") {
            $this->db->where("a.table_name", $table_name);
        }
        if ($table_action != "") {
            $this->db->where("a.action", $table_action);
        }
        return $this->db->get()->result();
    }

}