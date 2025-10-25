<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class CompanyfixCtrl extends CI_Controller {
    
    public function __construct(){
        parent::__construct();
        $this->load->database();
        $this->load->model('CompanyfixMod','cfm');
        $this->load->model('MasterMod','mm');
        $this->load->model('ReportMod','rm');
        $this->load->library('session');
        $this->load->helper('url');
        $this->load->helper('cookie');
    }
    
    public function companyfix(){
        if($this->session->has_userdata('logged_in'))
        {
    		$pro_data["project_info"] = $this->mm->fetch_project_info();
    		$this->load->view('header',$pro_data);
    		$this->load->view('company_fix');
    		$this->load->view('footer',$pro_data);
        }
        else
        {
            redirect("login");
        }
    }
    
    public function fetch_companyfix_policy()
    {
        if($this->session->has_userdata('logged_in')) 
    	{
            $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
            
            if($check_user_i->policy_view == "1")
            { 
                $from_date = $this->input->post("from_date");
                $to_date = $this->input->post("to_date");
                $select_insurance = $this->input->post("select_insurance");
                
                $res = $this->cfm->fetch_generate_companyfix_policy($from_date,$to_date,$select_insurance);
                // echo $this->db->last_query();
                $fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
               
                $content = "";
                
                $content .="
                <style>
                    tfoot {
                        font-weight: bold;
                    }
                </style>";
                if($res){
                    $content .= '<div class="row">
                         <div class="col-md-12 ">
                             <button class="btn btn-primary pull-right" id="fix_btn">Fix To Bill</button>
                         </div>
                     </div>';
                }
                
                $content .="<div class='table-responsive'>
                <table class='table' id='policy_list'>
                <thead>
                    <th>S.No</th>
                    <th>Customer</th>
                    <th>Agent id</th>
                    <th>Policy No</th>
                    <th>Insurer</th>
                    <th>User</th>
                    <th>OD</th>
                    <th>TP</th>
                    <th>Net Premium</th>
                    <th>Jan Own Com</th>
                    <th>Uni Own Com</th>
                    <th style='color:red'>Add Com</th>
                    <th>Total Com</th>
                    <th>Jan Agent Com</th>
                    <th>Uni Agent Com</th>
                    <th style='color:red'>Agn Add Com</th>
                    <th>Total Agn Com</th>
                    <th>Total Com + Agn </th>
                    <th>Bussiness Type</th>
                    <th>Class</th>
                    <th>Pol Type</th>
                    <th>Action</th>
                </thead>
                <tbody>
                ";
                $a = 0;
                
                
                if( isset( $res ) && !empty( $res ) ) {
                    foreach($res as $da)
                    {
                         	$a++;
                         	$additional_com = 0;
                            $agn_add_com = 0;
                            $agent_commission = 0;
                            $company_com = 0;
                            $agent_commission = 0;
                         	    
                            if($da->class == "1")
                            {
                                if($da->commission_type == "3")
                                {
                                    $total_premium = 0;
                                    
                                    $get_net_id = $this->rm->get_net_premium_id($da->net_premium_id);
                                    
                                    
                                    
                                    //comment
                                    foreach($get_net_id as $re)
                                    {
                                        $get_total_premium = $this->rm->get_total_premium($da->net_premium_id);
                                        
                                        foreach($get_total_premium as $am)
                                        {
                                          $total_premium = $total_premium + $am->total_premium;
                                        }
                                    }
                                    
                                    foreach($get_net_id as $das)
                                    {
                                        $temp_min = $das->min_val;
                                    	$temp_max = $das->max_val;
                                    	
                                    	if($temp_min <= $total_premium && $temp_max >= $total_premium)
                                    	{
                                    		    if($das->on_net != "0")
                                                {
                                                    $company_com = $da->total_premium * ($das->on_net)/100;
                                                }
                                                else if($das->own_od != "0" && $das->own_tp != "0")
                                                {
                                                    $own_od = $da->total_own_damage * ($das->own_od)/100;
                                                    $own_tp = $da->tot_liability_premium * ($das->own_tp)/100;
                                                    $company_com = $own_od+$own_tp;
                                                }
                                                else if($das->own_od != "0")
                                                {
                                                    $company_com = $da->total_own_damage * ($das->own_od)/100;
                                                }
                                                else if($das->own_tp != "0")
                                                {
                                                    $company_com = $da->tot_liability_premium * ($das->own_tp)/100;
                                                }
                                                
                                                $additional_com = $company_com - $da->own_commission_amt - $da->own_commission;
                                                
                                                $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);
                                             
                                                  if($das->agn_com_type == "OD")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->a_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->b_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->c_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->d_od)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->a_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->b_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->c_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->d_tp)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "ON-NET")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->a_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->b_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->c_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->d_net)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "OD_AND_TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->a_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->a_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->b_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->b_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->c_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->c_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->d_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->d_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                 }
                                                 $agn_add_com = $agent_commission - $da->agent_commission_amt - $da->agent_commission;
                                    		}
                                    	}
                                    //comment
                                }
                                else if($da->commission_type == "1")
                                {
                                    $tot_policy = 0;
                                    $get_nop_id = $this->rm->get_no_of_policy_id($da->no_of_policy_id);
                                    
                                    foreach($get_nop_id as $re)
                                    {
                                        $get_total_policy = $this->rm->get_total_policy($re->id);
                                        $tot_policy = $tot_policy + count($get_total_policy) ;
                                    }
                                    
                                    foreach($get_nop_id as $das)
                                    {
                                        $temp_min = $das->no_policy_min;
                                    	$temp_max = $das->no_policy_max;
                                    	
                                    	if($temp_min <= $tot_policy && $temp_max >= $tot_policy)
                                    	{
                                    
                                    		    if($das->on_net != "0")
                                                {
                                                    $company_com = $da->total_premium * ($das->on_net)/100;
                                                }
                                                else if($das->own_od != "0" && $das->own_tp != "0")
                                                {
                                                    $own_od = $da->total_own_damage * ($das->own_od)/100;
                                                    $own_tp = $da->tot_liability_premium * ($das->own_tp)/100;
                                                    $company_com = $own_od+$own_tp;
                                                }
                                                else if($das->own_od != "0")
                                                {
                                                    $company_com = $da->total_own_damage * ($das->own_od)/100;
                                                    $own_od = $company_com;
                                                }
                                                else if($das->own_tp != "0")
                                                {
                                                    $company_com = $da->tot_liability_premium * ($das->own_tp)/100;
                                                    $own_tp = $company_com;
                                                }
                                                
                                                $additional_com = $company_com - $da->own_commission_amt - $da->own_commission;
                                                $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);
                                             
                                                  if($das->agn_com_type == "OD")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->a_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->b_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->c_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->d_od)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->a_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->b_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->c_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->d_tp)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "ON-NET")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->a_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->b_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->c_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->d_net)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "OD_AND_TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->a_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->a_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->b_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->b_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->c_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->c_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->d_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->d_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                 }
                                                 $agn_add_com = $agent_commission - $da->agent_commission_amt - $da->agent_commission;
                                    	}
                                    }	
                                }
                                else
                                {
                                      $da->agent_commission_amt;
                                      $da->own_commission_amt;
                                }
                            }
                            else
                            {
                                 $total_premium = 0;
                                 
                                $get_net_id = $this->rm->get_net_premium_id($da->net_premium_id);
                                
                                foreach($get_net_id as $re)
                                {
                                    $get_total_premium = $this->rm->get_total_premium($re->id);
                                    
                                    foreach($get_total_premium as $am)
                                    {
                                       $total_premium = $total_premium + $am->total_premium;
                                    }
                                }
                                
                                foreach($get_net_id as $das)
                                {
                                    $temp_min = $das->min_val;
                                	$temp_max = $das->max_val;
                                	
                                	if($temp_min <= $total_premium && $temp_max >= $total_premium)
                                	{
                                		    if($das->on_net != "0")
                                            {
                                                $own_od = "";
                                                $own_tp = "";
                                                $company_com = $da->total_premium * ($das->on_net)/100;
                                                $on_net = $company_com;
                                            }
                                         
                                            $additional_com = $company_com - $da->own_commission_amt - $da->own_commission;
                                            $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);
                                            
                                        
                                                  if($agent_status->commission_category == "A")
                                                  {
                                                      $agent_commission = ($da->total_premium * $das->a_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "B")
                                                  {
                                                      $agent_commission = ($da->total_premium * $das->b_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "C")
                                                  {
                                                      $agent_commission = ($da->total_premium * $das->c_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "D")
                                                  {
                                                      $agent_commission = ($da->total_premium * $das->d_net)/100;
                                                  }
                                                  
                                                  //$agn_add_com = $agent_commission - $da->agent_commission_amt - $da->agent_commission;
                                                  $agn_add_com = $agent_commission;
                                		}
                                	}
                            }
                            
                            
                            $jan_com = $jan_agn_com = $uni_com = $uni_agn_com = 0;
                            $jan_com = $da->own_commission_amt;
                            $jan_agn_com = $da->agent_commission_amt;
                            $uni_com = $da->own_commission;
                            $uni_agn_com = $da->agent_commission;
                        
                            $content .="<tr>";
                            $content .="<td>".$a."</td>";
                            $content .="<td>".$da->client_name."</td>";
                            $content .="<td>".$da->agent_pos_code."</td>";
                            $content .="<td>".$da->policy_no."</td>";
                            $content .="<td>".$da->company_name."</td>";
                            $content .="<td>".$da->user."</td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->total_own_damage,"INR")."</td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->tot_liability_premium,"INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->total_premium,"INR")."</span></td>";
                            
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($jan_com,"INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($uni_com,"INR")."</span></td>";
                            $content .="<td style='color:red'><span class='pull-right'>".$fmt->formatCurrency($additional_com,"INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency(($jan_com + $uni_com + $additional_com),"INR")."</span></td>";
                            
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($jan_agn_com,"INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($uni_agn_com,"INR")."</span></td>";
                            $content .="<td style='color:red'><span class='pull-right'>".$fmt->formatCurrency($agn_add_com,"INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency(($jan_agn_com + $uni_agn_com + $agn_add_com),"INR")."</span></td>";
                            
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency(($jan_com + $jan_agn_com + $uni_com + $uni_agn_com + $additional_com + $agn_add_com),"INR")."</span></td>";
                            
                            $content .="<td>".$da->business_name."</td>";
                            $content .="<td>".$da->class_name."</td>";
                            $content .="<td>".$da->policy_type."</td>";
                            $content .=" <td><button type='button' class='btn btn-danger pull-right' id='cancel_data_btn' onclick=cancel_data(".$da->id.")> Cancel</button>&nbsp;
                            <button type='button' class='btn btn-primary pull-right' id='hold_data_btn' onclick=hold_data(".$da->id.")> Hold</button></td>";
                            $content .="</tr>";
                            
                            $od_total[] = $da->total_own_damage;
                            $lia_total[] = $da->tot_liability_premium;
                            $premium_total[] = $da->total_premium;
                            $owncom_total[] = $jan_com;//$da->own_commission_amt;
                            $agcom_total[] = $jan_agn_com;//$da->agent_commission_amt;
                            
                            $uowncom_total[] = $uni_com;//$da->own_commission_amt;
                            $uagcom_total[] = $uni_agn_com;//$da->agent_commission_amt;
                            $addcom_total[] = $additional_com;
                            $addagcom_total[] = $agn_add_com;
                    }
                } else {
                    //$content .= '<tr><td colspan="16" style="font-weight: bold;text-align: center">Not Found(s)</td></th>';
                }
                $content .='</tbody>';
                if($res){
                    $content.= '<tfoot>';
                        $content .= '<tr>';
                            $content .= '<td colspan="6"><span  class="pull-right">Grand Total</span></td>';
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency(array_sum($od_total),"INR").'</span></td>';
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency(array_sum($lia_total),"INR").'</span></td>';
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency(array_sum($premium_total),"INR").'</span></td>';
                            
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency(array_sum($owncom_total),"INR").'</span></td>';
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency(array_sum($uowncom_total),"INR").'</span></td>';
                            $content .= '<td><span class="pull-right" style="color:red">'.$fmt->formatCurrency(array_sum($addcom_total),"INR").'</span></td>';
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency((array_sum($owncom_total) + array_sum($uowncom_total) + array_sum($addcom_total)),"INR").'</span></td>';
                            
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency(array_sum($agcom_total),"INR").'</span></td>';
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency(array_sum($uagcom_total),"INR").'</span></td>';
                            $content .= '<td><span class="pull-right" style="color:red">'.$fmt->formatCurrency(array_sum($addagcom_total),"INR").'</span></td>';
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency((array_sum($agcom_total) + array_sum($uagcom_total) + array_sum($addagcom_total)),"INR").'</span></td>';
                            
                            $_total_comm = array_sum($owncom_total) + array_sum($agcom_total) + array_sum($uowncom_total) + array_sum($uagcom_total) + array_sum($addcom_total) + array_sum($addagcom_total);
                            
                            $content .= '<td><span class="pull-right">'.$fmt->formatCurrency($_total_comm,"INR").'</span></td>';
                            
                            $content .= '<td colspan="4"></td>';
                        $content .= '</tr>';
                    $content .='</tfoot>';
                }
                $content .= '</table></div>';
                echo $content;
            }
            else
            {
                echo "<script>alert('Permission Dinied');window.location.href='home';</script>";
            }
    	}
    }
    
    public function fetch_companyfix_poilicy_list()
     {
        if($this->session->has_userdata('logged_in')) 
        {
        $from_date  = $this->input->post("from_date");
        $to_date = $this->input->post("to_date");
    
        $res = $this->cfm->fetch_companyfix_poilicy_list($from_date,$to_date);
        //echo $this->db->last_query();
        $content = "<option value = ''>--Select--</option>";
              
              foreach($res as $da)
              {
                  $content .="<option value=".$da->id.">".$da->name .' - '.$da->agent_pos_code."</option>";
              }
              echo $content;
       }
       
     }
     
    public function fetch_companyfix_policy_insurance_company()
     {
        if($this->session->has_userdata('logged_in')) 
        {
        $from_date  = $this->input->post("from_date");
        $to_date = $this->input->post("to_date");
    
        $res = $this->cfm->fetch_companyfix_policy_insurance_company($from_date,$to_date);
        //echo $this->db->last_query();
        $content = "<option value = ''>--Select--</option>";
              
          foreach($res as $da)
          {
              $content .="<option value=".$da->id.">".$da->company_name ."</option>";
          }
          echo $content;
       }
     }
    
    public function get_companyfix_policy_data()
     {
         if($this->session->has_userdata('logged_in'))
         {
             $cancel_id = $this->input->post("id");
             $cancel_policy_status = "3";
             
             $date = array("cancel_policy_status" =>$cancel_policy_status);
             
             $this->cfm->update_cancel_companyfix_policy_status($date,$cancel_id);
  
         }
     }
     
    public function update_companyfix_policy_hold_list()
     {
        if($this->session->has_userdata('logged_in'))
         {
             $hold_id = $this->input->post("id");
             $cancel_policy_status ="4";
             
             $data = array("cancel_policy_status" =>$cancel_policy_status);
             
             $this->cfm->update_companyfix_policy_hold_list($data,$hold_id);
             
         }
     }
     
    public function fix_companyfix_commission()
    {
        if($this->session->has_userdata('logged_in')) 
    	{
    	   $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
                
            if($check_user_i->policy_view == "1")
            { 
                $from_date = $this->input->post("from_date");
                $to_date = $this->input->post("to_date");
                $company = $this->input->post("company");
                
                $res = $this->cfm->fetch_generate_companyfix_policy($from_date,$to_date, $company);
                
                $lead_id = "";
                $additional_com = 0;
                $agn_add_com = 0;
               
                foreach($res as $da)
                {
                    $data = array("invoice_prepared" => "Y");
                    $result = $this->cfm->companyfix_invoice_report($data,$da->id);
                }
            }
    	}
    }
    
    
    public function holdrelease() {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        $data = $projectData = [];
        
        $projectinfo = $this->mm->fetch_project_info();
        $projectData['project_info'] = $projectinfo;
        
        $companylist                 = $this->cfm->companylist();
        $data['companylist']         = $companylist;
        $data['monthlist']           = $this->getMonthList();
        
        $this->load->view('header',$projectData);
		$this->load->view('policy_hold_release',$data);
		$this->load->view('footer',$projectData);
    }
    
    function getMonthList()
    {
        $monthlist  = [];
        //return $monthlist;
        $startdate  = date("Y")."-01-01";
        $enddate    = date("Y")."-12-31";
        $interval   = "P1M";
        $calendar   = new DatePeriod(
            new DateTime( $startdate ),
            new DateInterval( $interval ),
            new DateTime( $enddate )
        );
        if( $calendar ) {
            foreach( $calendar as $p ) {
                $monthlist["'".$p->format('Y-m-01')."' and '". $p->format('Y-m-t')."'"] = $p->format('F - Y');
            }
            
            unset($calendar);
        }
        
        return $monthlist;
    }
    
    public function getHoldorCancelPolicyList()
    {
        if($this->session->has_userdata('logged_in')) 
        {
            $check_user_i = $this->mm->fetch_user_permissions($this->session->userdata('session_id'));
            
            $month      = $this->input->post('month');            
            $company_id = $this->input->post('company_id');
            
            if($check_user_i->policy_view == "1")
            { 
            
            $res = $this->cfm->get_hold_or_cancel_policy($month, $company_id);
            
             $fmt = new NumberFormatter('en_IN', NumberFormatter::CURRENCY);
            
            
        $content = "";
                
                $content .="<div class='table-responsive'>
                <table class='table table-hover table-bordered'>
                <thead>
                    <th>S.No</th>
                    <th>Customer</th>
                    <th>Agent id</th>
                    <th>Policy No</th>
                    <th>Insurer</th>
                    <th>OD</th>
                    <th>TP</th>
                    <th>Net Premium</th>
                    <th>Own Com</th>
                    <th>Agent Com</th>
                    <th style='color:red'>Add Com</th>
                    <th style='color:red'>Agn Add Com</th>
                    <th>Bussiness Type</th>
                    <th>Class</th>
                    <th>Pol Type</th>
                    <th>Status</th>
                    <th>Action</th>
                </thead>
                <tbody>
                </tbody>";
                $a = 0;
                
                
                if( isset( $res ) && !empty( $res ) ){
                    foreach($res as $da)
                    {
                         	$a++;
                         	$additional_com = 0;
                            $agn_add_com = 0;
                            $agent_commission = 0;
                            $company_com = 0;
                            $agent_commission = 0;
                         	    
                            if($da->class == "1")
                            {
                                if($da->commission_type == "3")
                                {
                                    $total_premium = 0;
                                    
                                    $get_net_id = $this->rm->get_net_premium_id($da->net_premium_id);
                                    
                                    foreach($get_net_id as $re)
                                    {
                                        $get_total_premium = $this->rm->get_total_premium($da->net_premium_id);
                                        
                                        foreach($get_total_premium as $am)
                                        {
                                          $total_premium = $total_premium + $am->total_premium;
                                        }
                                    }
                                    
                                    foreach($get_net_id as $das)
                                    {
                                        $temp_min = $das->min_val;
                                    	$temp_max = $das->max_val;
                                    	
                                    	if($temp_min <= $total_premium && $temp_max >= $total_premium)
                                    	{
                                    		    if($das->on_net != "0")
                                                {
                                                    $company_com = $da->total_premium * ($das->on_net)/100;
                                                }
                                                else if($das->own_od != "0" && $das->own_tp != "0")
                                                {
                                                    $own_od = $da->total_own_damage * ($das->own_od)/100;
                                                    $own_tp = $da->tot_liability_premium * ($das->own_tp)/100;
                                                    $company_com = $own_od+$own_tp;
                                                }
                                                else if($das->own_od != "0")
                                                {
                                                    $company_com = $da->total_own_damage * ($das->own_od)/100;
                                                }
                                                else if($das->own_tp != "0")
                                                {
                                                    $company_com = $da->tot_liability_premium * ($das->own_tp)/100;
                                                }
                                                
                                                $additional_com = $company_com - $da->own_commission_amt - $da->own_commission;
                                                
                                                $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);
                                             
                                                  if($das->agn_com_type == "OD")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->a_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->b_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->c_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->d_od)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->a_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->b_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->c_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->d_tp)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "ON-NET")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->a_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->b_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->c_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->d_net)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "OD_AND_TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->a_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->a_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->b_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->b_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->c_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->c_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->d_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->d_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                 }
                                                 $agn_add_com = $agent_commission - $da->agent_commission_amt - $da->agent_commission;
                                    		}
                                    	}
                                    //comment
                                }
                                else if($da->commission_type == "1")
                                {
                                    $tot_policy = 0;
                                    $get_nop_id = $this->rm->get_no_of_policy_id($da->no_of_policy_id);
                                    
                                    foreach($get_nop_id as $re)
                                    {
                                        $get_total_policy = $this->rm->get_total_policy($re->id);
                                        $tot_policy = $tot_policy + count($get_total_policy) ;
                                    }
                                    
                                    foreach($get_nop_id as $das)
                                    {
                                        $temp_min = $das->no_policy_min;
                                    	$temp_max = $das->no_policy_max;
                                    	
                                    	if($temp_min <= $tot_policy && $temp_max >= $tot_policy)
                                    	{
                                    
                                    		    if($das->on_net != "0")
                                                {
                                                    $company_com = $da->total_premium * ($das->on_net)/100;
                                                }
                                                else if($das->own_od != "0" && $das->own_tp != "0")
                                                {
                                                    $own_od = $da->total_own_damage * ($das->own_od)/100;
                                                    $own_tp = $da->tot_liability_premium * ($das->own_tp)/100;
                                                    $company_com = $own_od+$own_tp;
                                                }
                                                else if($das->own_od != "0")
                                                {
                                                    $company_com = $da->total_own_damage * ($das->own_od)/100;
                                                    $own_od = $company_com;
                                                }
                                                else if($das->own_tp != "0")
                                                {
                                                    $company_com = $da->tot_liability_premium * ($das->own_tp)/100;
                                                    $own_tp = $company_com;
                                                }
                                                
                                                $additional_com = $company_com - $da->own_commission_amt - $da->own_commission;
                                                $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);
                                             
                                                  if($das->agn_com_type == "OD")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->a_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->b_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->c_od)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_own_damage * $das->d_od)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->a_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->b_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->c_tp)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->tot_liability_premium * $das->d_tp)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "ON-NET")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->a_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->b_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->c_net)/100;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_commission = ($da->total_premium * $das->d_net)/100;
                                                      }
                                                  }
                                                  else if($das->agn_com_type == "OD_AND_TP")
                                                  {
                                                      if($agent_status->commission_category == "A")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->a_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->a_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "B")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->b_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->b_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "C")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->c_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->c_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                      else if($agent_status->commission_category == "D")
                                                      {
                                                          $agent_od = ($da->total_own_damage * $das->d_od)/100;
                                                          $agent_tp = ($da->tot_liability_premium * $das->d_tp)/100;
                                                          $agent_commission = $agent_od+$agent_tp;
                                                      }
                                                 }
                                                 $agn_add_com = $agent_commission - $da->agent_commission_amt - $da->agent_commission;
                                    	}
                                    }	
                                }
                                else
                                {
                                      $da->agent_commission_amt;
                                      $da->own_commission_amt;
                                }
                            }
                            else
                            {
                                 $total_premium = 0;
                                 
                                $get_net_id = $this->rm->get_net_premium_id($da->net_premium_id);
                                
                                foreach($get_net_id as $re)
                                {
                                    $get_total_premium = $this->rm->get_total_premium($re->id);
                                    
                                    foreach($get_total_premium as $am)
                                    {
                                       $total_premium = $total_premium + $am->total_premium;
                                    }
                                }
                                
                                foreach($get_net_id as $das)
                                {
                                    $temp_min = $das->min_val;
                                	$temp_max = $das->max_val;
                                	
                                	if($temp_min <= $total_premium && $temp_max >= $total_premium)
                                	{
                                		    if($das->on_net != "0")
                                            {
                                                $own_od = "";
                                                $own_tp = "";
                                                $company_com = $da->total_premium * ($das->on_net)/100;
                                                $on_net = $company_com;
                                            }
                                         
                                            $additional_com = $company_com - $da->own_commission_amt - $da->own_commission;
                                            $agent_status = $this->rm->fetch_agent_category($da->policy_agency_pos);
                                            
                                        
                                                  if($agent_status->commission_category == "A")
                                                  {
                                                      $agent_commission = ($da->total_premium * $das->a_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "B")
                                                  {
                                                      $agent_commission = ($da->total_premium * $das->b_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "C")
                                                  {
                                                      $agent_commission = ($da->total_premium * $das->c_net)/100;
                                                  }
                                                  else if($agent_status->commission_category == "D")
                                                  {
                                                      $agent_commission = ($da->total_premium * $das->d_net)/100;
                                                  }
                                                  
                                                  //$agn_add_com = $agent_commission - $da->agent_commission_amt - $da->agent_commission;
                                                  $agn_add_com = $agent_commission;
                                		}
                                	}
                            }
                        
                            $status = "";
                            if($da->cancel_policy_status == "3")
                                $status = "Cancel";
                            elseif($da->cancel_policy_status == "4")
                                $status = "Hold";
                                
                            $content .="<tr>";
                            $content .="<td>".$a."</td>";
                            $content .="<td>".$da->client_name."</td>";
                            $content .="<td>".$da->agent_pos_code."</td>";
                            $content .="<td>".$da->policy_no."</td>";
                            $content .="<td>".$da->company_name."</td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->total_own_damage,"INR")."</td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->tot_liability_premium,"INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->total_premium,"INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->own_commission_amt,"INR")."</span></td>";
                            $content .="<td><span class='pull-right'>".$fmt->formatCurrency($da->agent_commission_amt,"INR")."</span></td>";
                            $content .="<td style='color:red'><span class='pull-right'>".$fmt->formatCurrency($additional_com,"INR")."</span></td>";
                            $content .="<td style='color:red'><span class='pull-right'>".$fmt->formatCurrency($agn_add_com,"INR")."</span></td>";
                            $content .="<td>".$da->business_name."</td>";
                            $content .="<td>".$da->class_name."</td>";
                            $content .="<td>".$da->policy_type."</td>";
                            $content .="<td>".($status)."</td>";
                            $content .=" <td><button type='button' class='btn btn-info pull-right' id='recover_data_btn' onclick=recover_data(".$da->id.")> Recover</button>";
                            $content .="</tr>";
                    }
                } else {
                    $content .= "<tr><td colspan='17' style='text-align:center;'>No Records(s)</td></tr>";
                }
                
                $content .= "</tbody></table></div>";
                echo $content;
            }
            else
            {
                echo "<script>alert('Permission Dinied');window.location.href='home';</script>";
            }
        }
    }
    
    function change_policy_status() {
        if( !( $this->session->has_userdata('logged_in') ) ){
            redirect('login', 'refresh');
        }
        
        if($this->session->has_userdata('logged_in'))
        {
            $id = $this->input->post("id");
            $cancel_policy_status ="0";
            
            $data = array("cancel_policy_status" =>$cancel_policy_status);
            
            $this->rm->updata_policy_recover($data,$id);  
         
        }
    }
}



