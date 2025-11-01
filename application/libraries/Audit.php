<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * @property CI_Controller|object $CI
 *   @property CI_Session $session
 *   @property CI_Input $input
 *   @property Audit_model $audit_model
 */

class Audit {

    private $CI;

    public function __construct() {
        $this->CI =& get_instance();
        $this->CI->load->model('audit_model');
        $this->CI->load->library('session');
    }

    public function log($table_name, $action, $message, $old_data, $new_data) {
        $user_id = $this->CI->session->userdata('session_id');
        $ip_address = $this->CI->input->ip_address();
        $date = new DateTime();

        $data = [
            'table_name'    => $table_name,
            'action'        => $action,
            'message'       => $message,
            'old_data'      => json_encode($old_data),
            'new_data'      => json_encode($new_data),
            'created_by'    => $user_id,
            'created_date'  => $date->format('Y-m-d H:i:s'),
            'ip_address'    => $ip_address
        ];

        $this->CI->audit_model->addAudit($data);
    }
}
