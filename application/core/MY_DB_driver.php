<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class MY_DB_driver extends CI_DB_driver {
    
    public function __construct($params) {
        parent::__construct($params);
    }
    
    public function query($sql, $binds = FALSE, $return_object = TRUE)
    {
        $start_time = microtime(TRUE);
        $result = parent::query($sql, $binds, $return_object);

        $end_time = microtime(TRUE);
        $elapsed_time = $end_time - $start_time;

        if (stripos(trim($sql), 'SELECT') !== 0) {
            $table_name = $this->protect_identifiers($this->dbprefix($this->_table));
            $action = substr(trim($sql), 0, 6);
            $message = 'Query ' . strtoupper($action) . ' executed in ' . number_format($elapsed_time, 6) . ' seconds';
            $old_data = null;
            $new_data = null;

            if ($action === 'INSERT' && $this->affected_rows() == 1 && $this->insert_id()) {
                $new_data = $this->get_where($table_name, array('id' => $this->insert_id()))->row_array();
            } elseif ($action === 'UPDATE' && $this->affected_rows() == 1) {
                $old_data = $this->get_where($table_name, array('id' => $binds[0]))->row_array();
                $new_data = $this->get_where($table_name, array('id' => $binds[0]))->row_array();
            } elseif ($action === 'DELETE' && $this->affected_rows() == 1) {
                $old_data = $this->get_where($table_name, array('id' => $binds[0]))->row_array();
            }

            $CI =& get_instance();
            $CI->load->library('audit');
            $CI->audit->log($table_name, $action, $message, $old_data, $new_data);
        }

        return $result;
    }

}