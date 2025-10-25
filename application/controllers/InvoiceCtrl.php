<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class InvoiceCtrl extends CI_Controller {
     public $im;
    public $mm;
    public $cookie;
    public $url;
    public $db;
    public $database;
    public $session;

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('MasterMod','mm');
		$this->load->model('InvoiceMod','im');
		$this->load->library('session');
		$this->load->helper('url');
		$this->load->helper('cookie');
	}
	
	public function invoice()
	{
		if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
    	{
		   	$pro_data["project_info"] = $this->mm->fetch_project_info();
		   	$data["ins_company"] = $this->im->get_insurance_company_list();
            $data["class"] = $this->im->get_class_list();
            $data["cover"] = $this->im->get_policy_cover_type();
    		$this->load->view('header',$pro_data);
    		$this->load->view('invoice',$data);
    		$this->load->view('footer',$pro_data);
	    }
	}
	
	public function get_all_policies()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        {
            $ins_company = $this->input->post("ins_company");
            $select_class = $this->input->post("select_class");
            $select_c_type = $this->input->post("select_c_type");
            $from_date = $this->input->post("from_date");
            $to_date = $this->input->post("to_date");
            
             $res = $this->im->fetch_active_policy_report($ins_company,$select_class,$select_c_type,$from_date,$to_date);
             
            $content = "<div class='table-responsive'><table class='table table-hover table-bordered'>
                            <thead>
                                    <th>S.No</th>
                                    <th>Customer</th>
                                    <th>Mobile No</th>
                                    <th>Agent id</th>
                                    <th>Policy No</th>
                                    <th>Insurer</th>
                                    <th>Bussiness Type</th>
                                    <th>Class</th>
                                    <th>Pol Type</th>
                                    <th>OD</th>
                                    <th>TP</th>
                                    <th>Net Premium</th>
                                    <th>GST</th>
                                    <th>Own Com</th>
                                    <th>Agent Commission</th>
                                    <th>Own Com Additional</th>
                                    <th>Agent Com Additional</th>
                                </thead>
                                <tbody>";
                                
            $a = 0;
            
            $gst = 0;
            $agn_com = 0;
            $own_com = 0;
            
            $add_own_com = 0;
            $add_agn_com = 0;
            
            foreach($res as $da)
            {
                $a++;
                
                $gst = $gst+$da->gst;
                $agn_com = $agn_com + $da->agent_commission_amt;
                $own_com = $own_com + $da->own_commission_amt;
                
                $add_own_com = $add_own_com + $da->com_add_com;
                $add_agn_com = $add_agn_com + $da->agn_add_com;
                
                $content .="<tr>";
                            $content .="<td>".$a."</td>";
                            $content .="<td>".$da->client_name."</td>";
                            $content .="<td>".$da->mobile_no."</td>";
                            $content .="<td>".$da->agent_pos_code."</td>";
                            $content .="<td>".$da->policy_no."</td>";
                            $content .="<td>".$da->company_name."</td>";
                            $content .="<td>".$da->business_name."</td>";
                            $content .="<td>".$da->class_name."</td>";
                            $content .="<td>".$da->policy_type."</td>";
                            $content .="<td><span class='pull-right'>".number_format($da->total_own_damage,2)."</td>";
                            $content .="<td><span class='pull-right'>".number_format($da->basic_tp,2)."</span></td>";
                            $content .="<td><span class='pull-right'>".number_format($da->total_premium,2)."</span></td>";
                            $content .="<td><span class='pull-right'>".number_format($da->gst,2)."</span></td>";
                            $content .="<td><span class='pull-right'>".number_format($da->own_commission_amt,2)."</span></td>";
                            $content .="<td><span class='pull-right'>".number_format($da->agent_commission_amt,2)."</span></td>";
                            $content .="<td><span class='pull-right'>".number_format($da->com_add_com,2)."</span></td>";
                            $content .="<td><span class='pull-right'>".number_format($da->agn_add_com,2)."</span></td>";
                            $content .="</tr>";
            }
            
            $content .="<tr>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td></td>
                            <td style='text-align:right'><b>Total</b></td>
                            <td style='text-align:right'><b>".number_format($gst,2)."</b></td>
                            <td style='text-align:right'><b>".number_format($own_com,2)."</b></td>
                            <td style='text-align:right'><b>".number_format($agn_com,2)."</b></td>
                            <td style='text-align:right'><b>".number_format($add_own_com,2)."</b></td>
                            <td style='text-align:right'><b>".number_format($add_agn_com,2)."</b></td>
                            
                        </tr>";
                 $content .="</tbody></table></div><br>";
                 echo $content;
        }
	}
	
	public function get_invoice()
	{
	    if($this->session->has_userdata('logged_in') && $this->session->userdata('session_role') == "admin") 
        {
            $ins_company = $this->input->get("ins_company");
            $select_class = $this->input->get("select_class");
            $select_c_type = $this->input->get("select_c_type");
            $from_date = $this->input->get("from_date");
            $to_date = $this->input->get("to_date");
            
            $company_id = "1";
            
            $id = "1";
            
            $company_info = $this->im->fetch_single_company_settings($company_id);
            
                $logo = $company_info->logo;
               
             $content = "<!DOCTYPE html>
                        <html>
                        <head>
                            <title>Invoice : INV0001 </title>
                            <style>
                                *{
                                    padding:1px;
                                    margin:0px;
                                    font-family: 'Courier';
                                    font-size:13px;
                                }
                                
                                @page {
                                    margin: 100px 25px;
                                }
                    			
                                header {
                                    position: fixed;
                                    top: 35px;
                                    left: 35px;
                                    right: 35px;
                                    height: 730px;
                                }
                    
                                footer {
                                    position: fixed; 
                                    bottom: 15px; 
                                    left: 65px; 
                                    right: 0px;
                                    height: 10px; 
                                }
                            </style>
                        </head>
                        <body style='border:1px solid #aaa;padding-left:10px;padding-top:130px;margin:30px;'>
                        
                        <center><p style='font-size:20px;padding-top:0px;margin-top:13px;'>INVOICE</p></center>
                        <hr style='padding:0px;margin:2px;border-color:#dff0d8'>
                        <header>
                            <table style='width:100%'>
                                <tr>
                                    <td>
                                        <img src='".$logo."' style='width:100px;padding:5px 20px;'>
                                    </td>
                                    <td style='text-align: right;padding-top:2px;'>
                                        <p style='margin-top:0px;font-size:18px;'>".$company_info->name."</p>
                                        <p style='margin-top:3px;'>".$company_info->city."</p>";
                                        
                            if($company_info->address != "")
                            {
                                $content .= "<p style='margin-top:3px;'>".$company_info->address."</p>";
                            }
                                        
                            $content .= "<p style='margin-top:3px;'><img src='./datas/images/temp/phone-icon.PNG' style='width:12px;'> +91 ".$company_info->phone." </p>
                                        <p style='margin-top:3px;'><img src='./datas/images/temp/email-icon.PNG' style='width:12px;'> ".$company_info->email." </p>
                                        <p style='margin-top:3px;'>GST Number : ".$company_info->gst_no." </p>
                                        
                                    </td>
                                </tr>
                            </table>
                            <hr style='padding:0px;margin:0px;border-color:#dff0d8'>
                        </header>";
                       
                       
                    $this->load->library('pdf');
                	$this->pdf->loadHtml($content);
                	$this->pdf->render();
                	$this->pdf->stream("Quotation".$id.".pdf", array("Attachment" => false));
        }
	}
}