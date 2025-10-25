<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LogCtrl extends CI_Controller {
    public $lgm;
    public $mm;
    public $cookie;
    public $url;
    public $db;
    public $database;
    public $session;
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('LogMod','lgm');
        $this->load->model('MasterMod','mm');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('cookie');
    }
    
//audit log start
    public function audit_log()
    {
        if(!($this->session->has_userdata('logged_in'))){
            redirect('login','refresh');
        }
        
        if(!$this->auth->can_access('view audit log')){
            redirect('access_denied','refresh');
        }
        
        if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin")
        {
            $pro_data["project_info"] = $this->mm->fetch_project_info();
            $data["tablename"] = $this->lgm->fetch_list_of_table_name();
            $data["actions"] = $this->lgm->fetch_list_of_action();
            $this->load->view('header',$pro_data);
            $this->load->view('audit_log',$data);
            $this->load->view('footer',$pro_data);
        }
    }
    
    public function filter_audit_log_list()
    {
        error_reporting(0);
        if($this->session->has_userdata('logged_in')) 
    	{
                $table_name = $this->input->post("table_name");
                $from_date = $this->input->post("from_date");
                $to_date = $this->input->post("to_date");
                $table_action = $this->input->post("table_action");
                
                $res = $this->lgm->filter_audit_log_list($table_name,$from_date,$to_date,$table_action);
                /*echo $this->db->last_query();
                print_r($res);die();*/
                $content = "";
                
                $content .="
                <style>
                    tfoot {
                        font-weight: bold;
                    }
                </style>";
                
                
                $content .="<div class='table-responsive'>
                <table class='table' id='policy_list'>
                <thead>
                    <th>S.No</th>
                    <th>Table Name</th>
                    <th>Action</th>
                    <th>Message</th>
                    <th>Old Data</th>
                    <th>New Data</th>
                    <th>Created By</th>
                    <th>Created Date</th>
                    <th>IP Address</th>
                </thead>
                <tbody>
                ";
                $a = 0;
                
                if( isset( $res ) && !empty( $res ) ) {
                    foreach ($res as $da) {
                        $convert_old = $convert_new = [];
                        $a++;
                        $content .= "<tr>";
                        $content .= "<td>".$a."</td>";
                        $content .= "<td>".$da->table_name."</td>";
                        $content .= "<td>".$da->action."</td>";
                        $content .= "<td>".$da->message."</td>";
                        
                        // Convert old_data and new_data JSON to PHP arrays
                        if( isset($da->old_data) && !empty($da->old_data))
                            $convert_old = json_decode($da->old_data, true);
                        
                        if( isset($da->new_data) && !empty($da->new_data) )
                            $convert_new = json_decode($da->new_data, true);
                        
                        // Find the differences between the two arrays
                        
                        
                        
                        if($da->action == "UPDATE"){
                            
                        if( isset($convert_new) && !empty($convert_new) && isset($convert_old) && !empty($convert_old)) {
                            if( is_array($convert_new) && is_array($convert_old) ) {
                                $differences = array_diff_assoc($convert_new, $convert_old);
                            }
                        }
                        // Generate HTML table for old_data with highlighted differences
                        $result1 = '';
                        if( isset($convert_old) && !empty($convert_old) ) {
                            foreach ($convert_old as $key => $value) {
                                $highlight = '';
                                if (isset($differences[$key])) {
                                    $highlight = 'style="background-color: yellow"';
                                    
                                    $result1 .= "<tr>";
                                    $result1 .= "<td><strong>".$key.'</strong> => <span '.$highlight.'>'.$value."</span></td>";
                                    $result1 .= "</tr>";
                                }
                                
                            }
                        }
                        $content .= "<td>";
                        $content .= "<table>".$result1."</table>";
                        $content .= "</td>";
                        
                        // Generate HTML table for new_data with highlighted differences
                        $result2 = '';
                        if( isset($convert_new) && !empty($convert_new) ) {
                            foreach ($convert_new as $key => $value) {
                                $highlight = '';
                                if (isset($differences[$key])) {
                                    $highlight = 'style="background-color: yellow"';
                                    
                                    $result2 .= "<tr>";
                                    $result2 .= "<td><strong>".$key.'</strong> => <span '.$highlight.'>'.$value."</span></td>";
                                    $result2 .= "</tr>";
                                }
                                
                            }
                        }
                        $content .= "<td>";
                        $content .= "<table>".$result2."</table>";
                        $content .= "</td>";
                        // Generate HTML table for new_data with highlighted differences
                        }
                        else{
                            $result1 = '';
                            if( isset( $convert_old ) && !empty( $convert_old ) ){
                                foreach ($convert_old as $key => $value) {
                                    $result1 .= "<tr>";
                                    $result1 .= "<td><strong>".$key.'</strong> => '.$value."</td>";
                                    $result1 .= "</tr>";
                                }
                            }
                        
                        
                        $content .= "<td>";
                        $content .= "<table>".$result1."</table>";
                        $content .= "</td>";
                        
                        
                        $result2 = '';
                        if( isset( $convert_new ) && !empty( $convert_new ) ){
                            foreach ($convert_new as $key => $value) {
                                $result2 .= "<tr>";
                                $result2 .= "<td><strong>".$key.'</strong>:  '.$value."</td>";
                                $result2 .= "</tr>";
                            }
                        }
                        $content .= "<td>";
                        $content .= "<table>".$result2."</table>";
                        $content .= "</td>";
                            
                        }
                       
                    
                        $content .= "<td>".$da->username."</td>";
                        $content .= "<td>".$da->created_date."</td>";
                        $content .= "<td>".$da->ip_address."</td>";
                        $content .= "</tr>";
                    }
                    $content .='</tbody>';
                    $content.= '<tfoot>';
                    $content .='</tfoot>';
                    $content .= '</table></div>';
                    echo $content;
                }
                
                    
                else{
                    $msg = "No records found";
                    echo "<h3 align='center' style='color:red'>".$msg."</h3>";
                }
    	}
        else
        {
            echo "<script>alert('Permission Dinied');window.location.href='home';</script>";
        }
    }
//audit log end


    
}