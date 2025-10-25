<?php

class AccountsMod extends CI_Model  
{  
  	function __construct()  
  	{ 
    	parent::__construct();  
    	$this->load->dbforge();
  	}
    
    public function getAll() {
		$query = $this->db->get('account_tree');
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
	public function getAccountTree() {
	    $this->db->select('accid, vchaccid, vchaccname, parentid, vchparentid, agent_id, list_of_pos_and_agents.name,list_of_pos_and_agents.id');
	    $this->db->join("list_of_pos_and_agents", "(account_tree.agent_id = list_of_pos_and_agents.id )", 'left');
	    $query = $this->db->get('account_tree');
		if ($query->num_rows() > 0) {
			return $query->result();
		} else {
			return false;
		}
	}
	
    public function accounts_hierarchy($table, $options)
    {
    
        $sql = "Select * from(
                WITH RECURSIVE accounts_hierarchy AS (
                    SELECT accid, vchaccid, vchaccname, parentid, vchparentid, agent_id,  1 AS level
                    FROM {$table}";

        if(isset($options) && !empty( $options)) {                        
            if(isset($options['accid']) && $options['accid'] != '')
                $sql .= " where vchaccid in ('acc1', 'acc2', 'acc3', 'acc4') ";//$options['accid'];            
        }

        $sql .= " UNION ALL
                    SELECT e.accid, e.vchaccid, e.vchaccname, e.parentid, e.vchparentid, e.agent_id, eh.level + 1
                    FROM {$table} AS e
                    INNER JOIN accounts_hierarchy AS eh ON e.vchparentid = eh.vchaccid
                )
                SELECT accid, vchaccid, vchaccname, level, parentid, vchparentid, agent_id FROM accounts_hierarchy where 1 = 1 ";

        if(isset($options) && !empty( $options)) {
            
            if(isset($options['level']) && $options['level'] != '')
                $sql .= " and level <= ".$options['level'];
            if(isset($options1['accid']) && $options1['accid'] != '')
                $sql .= " and accid = ".$options['accid'];
            if(isset($options['parentid']) && $options['parentid'] != '')
                $sql .= " and parentid = ".$options['parentid'];

        }
        
        $sql .= ")A left join (select name ,id from list_of_pos_and_agents)B on (A.agent_id = B.id)";
        
        $Q = $this->db->query($sql);

        return $Q->result();
    }
    
    public function fetch_main_ledgers()
  	{
        $this->db->where("parentid","0");
        return $this->db->get("account_tree")->result();
    }
    
    public function fetch_main_sub_ledgers($options = [])
  	{
        // $this->db->where("parentid !=","0");
        // $this->db->where("chracctype","1");
        // return $this->db->get("account_tree")->result();
        
        if(isset($options) && !empty($options)) {
            $this->db->where($options);
            $this->db->order_by('vchaccname', 'ASC');
        }
        return $this->db->get("account_tree")->result();
    }
    
    public function fetch_all_sub_ledgers($main_ledger)
  	{
        $this->db->where("vchparentid",$main_ledger);
        return $this->db->get("account_tree")->result();
    }

    public function add_sub_ledger($data)
    {
          $this->db->insert("account_tree",$data);        
    }
    
    public function add_sub_ledger_orc($data)
    {
          $this->db->insert("account_tree_orc",$data);        
    }
    
    public function get_last_acc_id()
    {
        $this->db->select_max('accid');
        return $this->db->get("account_tree")->row();
    }
    
    public function get_sub_ledger_details($sub_ledger_id)
    {
        $this->db->where("accid",$sub_ledger_id);
        return $this->db->get("account_tree")->row();
    }
  
  	public function fetch_account_tree()
  	{
  	     $this->db->where("vchparentid","acc0");
        return $this->db->get("account_tree")->result();
  	}
  	
  	public function get_child_account_tree($accid)
  	{
  	    $this->db->where("vchparentid",$accid);
        return $this->db->get("account_tree")->result();
  	}
  	
  	public function get_account_details($accid)
  	{
  	     $this->db->where("vchaccid",$accid);
        return $this->db->get("account_tree")->row();
  	}
  	
  	public function get_account_head_for_general_receipt($options = [])
  	{
  	    if(isset($options) && !empty($options)) {
  	        $this->db->select('vchaccid,vchaccname');
            $this->db->where($options);
            $this->db->order_by('vchaccname', 'ASC');
        }
  	    return $this->db->get("account_tree")->result();
  	}
  	
   public function check_receipt_no_already_exits($gr_no)
   {
        $this->db->where("gr_no",$gr_no);
  		$num = $this->db->get("gr_series")->num_rows();
  		
  		if($num > 0)
  		{
  		    return true;
  		}
  		else
  		{
  		    $data = array(
  		        "gr_no" => $gr_no,
  		        );
  		    $this->db->insert("gr_series",$data);
  		    return false;
        }
   }
   
   public function check_mv_receipt_no_already_exits($mv_no)
   {
        $this->db->where("mv_no",$mv_no);
  		$num = $this->db->get("mv_series")->num_rows();
  		
  		if($num > 0)
  		{
  		    return true;
  		}
  		else
  		{
  		    $data = array(
  		        "mv_no" => $mv_no,
  		        );
  		    $this->db->insert("mv_series",$data);
  		    return false;
        }
   }
   
   
   
   public function check_pc_receipt_no_already_exits($pc_no)
   {
        $this->db->where("pc_no",$pc_no);
  		$num = $this->db->get("pc_series")->num_rows();
  		
  		if($num > 0)
  		{
  		    return true;
  		}
  		else
  		{
  		    $data = array(
  		        "pc_no" => $pc_no,
  		        "date" =>date("Y-m-d"),
  		        );
  		    $this->db->insert("pc_series",$data);
  		    return false;
        }
   }
   
   public function add_general_receipt($data)
   {
       if($this->db->insert("general_receipt",$data)){
            return true;
       }

       return false;
   }
   
    public function add_mv_receipt($data)
   {
       return $this->db->insert("mv_receipt",$data);
   }
   
   public function get_particulars_by_account_head($account_head, $options = [])
   {
        $this->db->where("vchparentid",$account_head);
        if(isset($options) && !empty($options)) {
            $this->db->where($options);            
        }
       return $this->db->get("account_tree")->result();
   }
   
   public function print_general_receipt($gr_no)
   {
       $this->db->where("receipt_no",$gr_no);
       return $this->db->get("general_receipt")->row();
   }
   
   public function get_account_name($acc_id)
   {
       $this->db->where("accid",$acc_id);
       return $this->db->get("account_tree")->row();
       
   }
   
   public function get_cash_entry($particulars)
   {
        $this->db->where("account_id",$particulars);
       return $this->db->get("account_tree")->row();
   }
   
   public function add_credit_cash_entry($data,$particulars)
   {
        $this->db->where("account_id",$particulars);
        $this->db->update("account_tree",$data);
   }
   
   public function fetch_cash_balance()
   {
        $this->db->where("account_id","acc8");
        return $this->db->get("account_tree")->row();
   }
   
   public function get_petty_cash_amount()
   {
       $this->db->where("account_id","acc10");
        return $this->db->get("account_tree")->row();
   }
   
   public function update_pettycash_balance($array)
   {
        $this->db->where("account_id","acc10");
        $this->db->update("account_tree",$array);
   }
   
   public function fetch_view_accounts_ledger($acc_head,$acc_sub,$from_date,$to_date,$lead_id, $agent_id = '', $notes = '', $methods = '')
   {
       if($acc_head != "")
       {
           if($acc_head != "" && $acc_sub == "")
           {
               $this->db->where("acc_commission_ledger.cr_parent_id",$acc_head);
           }
         else if($acc_sub != "")
           {
                $this->db->where("acc_commission_ledger.dr_parent_id",$acc_sub);
           }
        }
       else if($acc_head != "")
       {
           if($acc_head != "" && $acc_sub == "")
           {
               $this->db->where("acc_commission_ledger.cr_parent_id",$acc_head);
           }
         else if($acc_sub != "")
           {
                $this->db->where("acc_commission_ledger.dr_parent_id",$acc_sub);
           }
        }
        
        if($agent_id) {
            $this->db->where("acc_commission_ledger.sub_id",$agent_id);
        }
        
       if($from_date != "" && $to_date != "")
       {
            // $this->db->where("Date(acc_commission_ledger.datetime) >=",$from_date);
            // $this->db->where("Date(acc_commission_ledger.datetime) <=",$to_date);
            if($methods) {
                if( $methods == "account_post_data") {
                    $this->db->where("Date(acc_commission_ledger.datetime) >=",$from_date);
                    $this->db->where("Date(acc_commission_ledger.datetime) <=",$to_date);
                } else {
                    $this->db->where("lead_id in (select lead_id from policy_info where date(policy_issue_date) between '".$from_date."' and '".$to_date."')", NULL);
                }
            }
       }
       if($lead_id != "")
       {
           $this->db->where("acc_commission_ledger.lead_id",$lead_id);
       }
       
       if($notes)
            $this->db->where("acc_commission_ledger.note !=","Agent commission Credit");
            
       return $this->db->get("acc_commission_ledger")->result();
   }
   
   public function fetch_view_accounts_ledger_orc($acc_head,$acc_sub,$from_date,$to_date,$lead_id, $agent_id = '', $notes = '', $methods = '')
    {
       if($acc_head != "")
       {
           if($acc_head != "" && $acc_sub == "")
           {
               $this->db->where("acc_commission_ledger_orc.cr_parent_id",$acc_head);
           }
         else if($acc_sub != "")
           {
                $this->db->where("acc_commission_ledger_orc.dr_parent_id",$acc_sub);
           }
        }
       else if($acc_head != "")
       {
           if($acc_head != "" && $acc_sub == "")
           {
               $this->db->where("acc_commission_ledger_orc.cr_parent_id",$acc_head);
           }
         else if($acc_sub != "")
           {
                $this->db->where("acc_commission_ledger_orc.sub_id",$acc_sub);
           }
        }
       if($from_date != "" && $to_date != "")
       {
            // $this->db->where("Date(acc_commission_ledger_orc.datetime) >=",$from_date);
            // $this->db->where("Date(acc_commission_ledger_orc.datetime) <=",$to_date);
            if($methods) {
                if( $methods == "account_post_data") {
                    $this->db->where("Date(acc_commission_ledger_orc.datetime) >=",$from_date);
                    $this->db->where("Date(acc_commission_ledger_orc.datetime) <=",$to_date);
                } else {
                    $this->db->where("lead_id in (select lead_id from policy_info where date(policy_issue_date) between '".$from_date."' and '".$to_date."')", NULL);
                }
            }  
       }
       if($lead_id != "")
       {
           $this->db->where("acc_commission_ledger_orc.lead_id",$lead_id);
       }
       
       //$this->db->where("acc_commission_ledger_orc.note !=","Agent commission Credit");
       return $this->db->get("acc_commission_ledger_orc")->result();
   }

   public function fetch_all_agents_pos()
   {
        return $this->db->get("list_of_pos_and_agents")->result();
   }
   
   public function fetch_acc_name_by_accid($acc_id)
   {
       $this->db->where("vchaccid",$acc_id);
       return $this->db->get("account_tree")->row();
   }
   
   public function fetch_acc_name_by_agn_id($acc_id)
   {
       $this->db->where("agent_id",$acc_id);
       return $this->db->get("account_tree")->row();
   }
   
   // Accounts
   
   public function get_sub_ledgers()
   {
        $this->db->where("parentid !=","1");
       return $this->db->get("account_tree")->result();
   }
   
   public function get_sub_ledgers_by_accid($account_head)
   {
        $this->db->where("vchparentid",$account_head);
       return $this->db->get("account_tree")->result();
   }
   
   public function fetch_agent_id($acc_sub)
   {
       $this->db->where("vchaccid",$acc_sub);
       return $this->db->get("account_tree")->row();
   }
   
    public function get_all_policy_details()
    {
        $this->db->limit("50");
        $this->db->where("commission_id !=","");
        $this->db->where("own_commission_amt !=","");
  		return $this->db->get("policy_info")->result();
    }
    public function get_policy_details($lead_id)
	{
	    $this->db->where("lead_id",$lead_id);
	    return $this->db->get("policy_info")->row();
	    
	}
	 public function check_sr_no_already_exits($new_sr_no)
    {
        $this->db->where("sr_no",$new_sr_no);
  		$num = $this->db->get("acc_commission_ledger")->num_rows();
  		if($num > 0)
  		{
  		    return true;
  		}
  		else
  		{
  		    return false;
  		}
    }
    
    public function get_commission_details($id)
	{
	    $this->db->where("id",$id);
	    return $this->db->get("company_payout_commission")->row();
	}
	  public function check_ac_policy_no_already_exits($policy_no)
    {
        $this->db->where("sub_id",$policy_no);
        return $this->db->get("acc_commission_ledger")->num_rows();
    }
    
    public function check_ac_policy_no_already_exits_orc($policy_no)
    {
        $this->db->where("sub_id",$policy_no);
        return $this->db->get("acc_commission_ledger_orc")->num_rows();
    }
    
    public function fetch_insurance_company_ledger_main($id)
    {
        $this->db->where("insurer_id",$id);
  		return $this->db->get("account_tree")->row();
    }
    
    public function fetch_insurance_company_ledger_orc($id)
    {
        $this->db->where("insurer_id",$id);
  		return $this->db->get("account_tree_orc")->row();
    }
    public function fetch_agent_category($id)
  	{
  	    $this->db->where("id",$id);
  	    return $this->db->get("list_of_pos_and_agents")->row();
  	}
  	public function add_acc_own_commission($data)
    {
        $this->db->insert("acc_commission_ledger",$data);
    }
    
    public function add_acc_own_commission_orc($data)
    {
        $this->db->insert("acc_commission_ledger_orc",$data);
    }
    
    public function fetch_sub_category()
    {
	$this->db->where("chracctype","2");
  	return $this->db->get("account_tree")->result();
    }
    
    public function get_agent_commission_credit()
    {
      return  $this->db->where("note","Agent commission Credit")->get("acc_commission_ledger")->result();
        
    }
    public function add_bank_details($data)
    {
         $this->db->insert("bank_details",$data);        
    }
    public function fetch_bank()
    {
        return $this->db->get("bank_details")->result();
    }
    public function fetch_edit_bank_dateils($id)
    {
        $this->db->where("id",$id);
        return $this->db->get("bank_details")->row();
    }
     public function edit_Bank_details($id,$data)
    {
        $this->db->where("id",$id);
        $this->db->update("bank_details",$data);
    }
    public function delete_bank_details($id)
    {
         $this->db->where("id",$id);
        $this->db->delete("bank_details");
    }
    
    public function get_account_number( $account_id = null )
    {
        if( isset( $account_id ) && !empty( $account_id ) )
            $this->db->where("sr_no", $account_id);
            
        $this->db->select('(sum(credit) - sum(debit)) as bal,list_of_pos_and_agents.bank_acc_no,bank_name');       
        $this->db->where_in('note',['Advance Agent commission Debit', 'Agent commission Credit']);
        $this->db->join("list_of_pos_and_agents","acc_commission_ledger_orc.sub_id =list_of_pos_and_agents.id");
        
        return $this->db->get("acc_commission_ledger_orc")->row(); 
    }
    
    public function get_account_agent()
    {
       return $this->db->get("list_of_pos_and_agents")->result(); 
    }
    
    public function get_agentpayment_id()
    {
       $this->db->select("list_of_pos_and_agents.name,acc_commission_ledger.sr_no");   
       $this->db->join("list_of_pos_and_agents","acc_commission_ledger.sub_id = list_of_pos_and_agents.id");   
       $this->db->where("acc_commission_ledger.note =","Agent commission Credit");
       return $this->db->get("acc_commission_ledger")->result(); 
    }
    
     public function get_bank_details()
    {
        return $this->db->get("bank_details")->result(); 
    }
    
    public function add_agent_receipt($data)
    {
        $this->db->insert("list_of_agent_payment",$data);  
    }
    
    public function get_agent_account_details($account_id)
    {
        $this->db->where("id",$account_id);
        return $this->db->get("list_of_pos_and_agents")->row();
    }
    
    public function fetch_cheque_number()
    {
        $this->db->select('id,vchcheque_character_no');
        $this->db->where("status","N");
      return $this->db->get("cheque_book_entry")->result();  
    }
    
    public function update_cheque_book($data1,$cheque_no)
    {
        $this->db->where("id",$cheque_no);
        $this->db->update("cheque_book_entry",$data1); 
    }
    
    public function fetch_bank_detalis()
    {
      return $this->db->get("bank_details")->result();  
    }
    
    public function add_acc_commission_ledger($data2)
    {
        $this->db->insert("acc_commission_ledger",$data2);
    }
    
    public function get_paymode_chracctype($sub_category)
    {
        $this->db->where("vchaccid",$sub_category);
        return $this->db->get("account_tree")->row();
    }
    
    public function get_insurance_company()
    {
  	    return $this->db->get("list_of_insurance_company")->result();
  	}
  	
  	public function add_insur_company_ledger($data)
  	{
  	    $this->db->insert("creat_insurance_company_ledger",$data);
  	}
    
    public function fetch_all_agents() 
    {
        return $this->db->get("list_of_pos_and_agents")->result();
    }
    
    public function add_agent_ledger($data)
    {
        $this->db->insert("creat_agent_account_ledger",$data);
    }
    
    public function get_agent_list()
    {
        return $this->db->get("list_of_pos_and_agents")->result();
    }
    
    public function add_agent_sub_ledger($data_acc)
    {
        $this->db->insert("account_tree",$data_acc);
    }
    
    public function add_insur_company_sub_ledger($data_acc)
    {
        $this->db->insert("account_tree",$data_acc);
    }
    
    
    public function getID($options, $table)
    {
        $data = [];
        $this->db->select('vchaccid');
        $this->db->where($options);
        $Q = $this->db->get($table);
        
        if( $Q->num_rows() > 0 ){
            $data = $Q->row_array();
        }
        $Q->free_result();
        return (isset($data['vchaccid']) && !empty($data['vchaccid'])) ? $data['vchaccid'] : '';
    }
    
    
    public function bank_agent_commission_entry($data)
    {
         $this->db->insert("agent_commission_transaction",$data);
    }
    
    public function bank_agent_commission_entry_orc($data)
    {
         $this->db->insert("agent_commission_transaction_orc",$data);
    }
    
    public function fetch_bank_agent_commission_statement($options = [])
    {
        if($options) {
            $this->db->where($options);
        }
         return $this->db->get("agent_commission_transaction")->result();
    }
    
    public function fetch_bank_agent_commission_statement_orc($options = [])
    {
        if($options) {
            $this->db->where($options);
        }
         return $this->db->get("agent_commission_transaction_orc")->result();
    }
    
    // accounts by 2023-09-13
    public function update_agent_commission_transaction($table,$data, $voucher)
    {
        $this->db->where_in("voucher_no",$voucher);
        $this->db->where_in("accounts_entry_status","0");        
        $this->db->update($table,$data);
    }

    // accounts by 2023-09-13
    public function getACTransaction($voucher_no, $table)
    {
        if($voucher_no != null || $voucher_no != "")
        {
            $this->db->select("tds_amount as tds, list_of_pos_and_agents.id as agent_id");
            $this->db->from($table);
            $this->db->join('list_of_pos_and_agents', 'list_of_pos_and_agents.agent_pos_code = '.$table.'.pos_code');
            $this->db->where_in("voucher_no",$voucher_no);            
            return $this->db->get()->row();
        }
    }
    
    public function get_voucher_total_1($voucher_no)
    {
       if($voucher_no != null || $voucher_no != "")
       {
          $this->db->select("commission_amount as ac");
           $this->db->from("agent_commission_transaction");
           $this->db->where_in("voucher_no",$voucher_no);
           return $this->db->get()->result();
       }
       else
       {
           return array();
       }
       
   }
   
   
   public function check_agent_voucher_no($voucher_no, $table = 'agent_commission_transaction')
   {
       $this->db->where("voucher_no",trim($voucher_no));
       return $this->db->get("{$table}")->row();
   }

   public function getAgentCommissionLedger($agent_id, $fromdate, $todate, $lead_id, $cr_table, $dr_table) {

        $sql = "Select 
                A.voucher_no,date(A.created_at) as credit_dt, date(B.creat_datetime) as debit_dt,B.voucher_no as tvoucher_no,floor(A.total_commission) as credit,commission_amount,tds_amount, net_op, 
                A.name,A.agent_pos_code,A.agent_id,tds_amt
                from
                (
                    select 
                        ac.*, a.name, a.agent_pos_code
                    from 
                        {$cr_table} ac, list_of_pos_and_agents a
                    where 
                        ac.agent_id = a.id and ac.netpay > 0 and
                        date(created_at) between '".$fromdate."' and '".$todate."' ";

        if($agent_id)
            $sql .= " and agent_id = ".$agent_id;

        $sql .= ")A 
                left join (
                    select 
                        ac.* , a.id as agent_ids
                    from 
                        {$dr_table} ac, list_of_pos_and_agents a
                    where 
                        ac.pos_code = a.agent_pos_code and
                        date(ac.creat_datetime) between '".$fromdate."' and '".$todate."' ";

        if($agent_id)
            $sql .= " and a.id = ".$agent_id;

        $sql .= ")B on (A.voucher_no = B.voucher_no) ";

        $Q = $this->db->query($sql);

        return $Q->result();
    }

    //view company commission ledger start
    public function get_account_company()
    {
        $this->db->select("*");
        $this->db->from("list_of_insurance_company");
        $this->db->order_by("company_name", "ASC");
        
        return $this->db->get()->result();
    }
    
    public function getCompanyCommissionLedger($company_id, $fromdate, $todate, $tableName, $methods)
    {
        
        $this->db->select("$tableName.*, c.company_name as companyName, (select vchaccname from account_tree where vchaccid = cr_parent_id) as name,
        date(policy_issue_date) as policy_date");
        $this->db->from($tableName);
        $this->db->join("list_of_insurance_company c", "c.id = $tableName.insurer_id");
        $this->db->join("policy_info p", "(p.lead_id = $tableName.lead_id and p.company = $tableName.insurer_id)", 'left');
        
        if ($company_id != "") {
            $this->db->where("$tableName.insurer_id", $company_id);
        }
       
        if($fromdate != "" && $todate != "")
        {
            if($methods) {
                if( $methods == "account_post_data") {
                    $this->db->where("Date($tableName.datetime) >=",$fromdate);
                    $this->db->where("Date($tableName.datetime) <=",$todate);
                } else {
                    $this->db->where("$tableName.lead_id in (select lead_id from policy_info where date(policy_issue_date) between '".$fromdate."' and '".$todate."')", NULL);
                }
            }
            
        }
        
        
        $this->db->order_by('datetime', 'asc');
        return $this->db->get()->result();
    }


//view company commission ledger end

    public function AccBalance($company_id, $fromdate, $todate, $methods) {
        $sql = "Select 
                    insurer_id,cr,dr,coalesce(cr,0)-coalesce(dr,0) as balance,company_name  
                from
                    (
                        select 
                            insurer_id, sum(credit) as cr ,c.company_name
                        from 
                            acc_commission_ledger a, list_of_insurance_company c 
                        where 
                            a.insurer_id = c.id ";
                        if($company_id)
                            $sql .= " and insurer_id = {$company_id} ";

                        
                        if($methods) {
                            if( $methods == "policy_issue_data") {                                                            
                                $sql .= " and lead_id in (select lead_id from policy_info where date(policy_issue_date) < '".$fromdate."')";
                            } else {
                                $sql .= " and date(a.datetime) < '".$fromdate."' ";
                            }
                        }
                        $sql .= "group by 
                                    insurer_id,c.company_name
                    )A 
                    left join (
                        select 
                            insurance_company_id, sum(receipt_amount) as dr, max(ir.id) 
                        from  
                            invoice i, invoice_revision ir, invoice_receipts r 
                        where 
                            i.id = ir.invoice_id and ir.id = r.invoice_revision_id ";
                        if($company_id)
                            $sql .= " and i.insurance_company_id = {$company_id} ";

                        $sql .= " and date(r.receipt_date) < '".$fromdate."' 
                        group by 
                            insurance_company_id
                    )B on (A.insurer_id = B.insurance_company_id)";

        $Q = $this->db->query($sql);

        return $Q->result();
    }

    public function AccBalance_orc($company_id, $fromdate, $todate, $methods) {
        $sql = "Select 
                    insurer_id,cr,dr,coalesce(cr,0)-coalesce(dr,0) as balance,company_name  
                from
                    (
                        select 
                            insurer_id, sum(credit) as cr ,c.company_name
                        from 
                            acc_commission_ledger_orc a, list_of_insurance_company c 
                        where 
                            a.insurer_id = c.id ";
                        if($company_id)
                            $sql .= " and insurer_id = {$company_id} ";

                        
                        if($methods) {
                            if( $methods == "policy_issue_data") {                                                            
                                $sql .= " and lead_id in (select lead_id from policy_info where date(policy_issue_date) < '".$fromdate."')";
                            } else {
                                $sql .= " and date(a.datetime) < '".$fromdate."' ";
                            }
                        }
                        $sql .= "group by 
                                    insurer_id,c.company_name
                    )A 
                    left join (
                        select 
                            insurance_company_id, sum(receipt_amount) as dr, max(ir.id) 
                        from  
                            invoice_orc i, invoice_orc_revision ir, invoice_orc_receipts r 
                        where 
                            i.id = ir.invoice_orc_id and ir.id = r.invoice_orc_revision_id ";
                        if($company_id)
                            $sql .= " and i.insurance_company_id = {$company_id} ";

                        $sql .= " and date(r.receipt_date) < '".$fromdate."' 
                        group by 
                            insurance_company_id
                    )B on (A.insurer_id = B.insurance_company_id)";

        $Q = $this->db->query($sql);

        return $Q->result();
    }

    public function AgnBalance($agent_id, $fromdate, $todate, $methods) {
        $sql = "Select 
                    sub_id as agent_id,cr,dr,coalesce(cr,0)-coalesce(dr,0) as balance 
                from 
                    (
                        select 
                            sub_id, sum(credit) as cr ,c.name 
                        from 
                            acc_commission_ledger a, list_of_pos_and_agents c 
                        where 
                            a.sub_id = c.id";
                            if($agent_id)
                                $sql .= " and a.sub_id = {$agent_id} ";

                            $sql .= " and lead_id in (select lead_id from policy_info where date(policy_issue_date) < '".$fromdate."')";
                            // if($methods) {
                            //     if( $methods == "policy_issue_data") {                                                            
                            //         $sql .= " and lead_id in (select lead_id from policy_info where date(policy_issue_date) < '".$fromdate."')";
                            //     } else {
                            //         $sql .= " and date(a.datetime) < '".$fromdate."' ";
                            //     }
                            // }
                            $sql .= " group by 
                                        sub_id,c.name
                        )A 
                        left join (
                            select 
                                a.id, sum(floor(net_op)) as dr 
                            from 
                                agent_commission_transaction ac, list_of_pos_and_agents a 
                            where 
                                ac.pos_code = a.agent_pos_code ";
                                if($agent_id)
                                    $sql .= " and a.id = {$agent_id} ";

                                $sql .= " and date(ac.creat_datetime) < '".$fromdate."'  
                            group by 
                                    a.id
                        )B on (A.sub_id = B.id)";
                                
        $Q = $this->db->query($sql);

        return $Q->result();
    }

    public function AgnBalance_orc($agent_id, $fromdate, $todate, $methods) {
        $sql = "Select 
                    sub_id as agent_id,cr,dr,coalesce(cr,0)-coalesce(dr,0) as balance 
                from 
                    (
                        select 
                            sub_id, sum(credit) as cr ,c.name 
                        from 
                            acc_commission_ledger_orc a, list_of_pos_and_agents c 
                        where 
                            a.sub_id = c.id";
                            if($agent_id)
                                $sql .= " and a.sub_id = {$agent_id} ";

                            $sql .= " and lead_id in (select lead_id from policy_info where date(policy_issue_date) < '".$fromdate."')";
                            // if($methods) {
                            //     if( $methods == "policy_issue_data") {                                                            
                            //         $sql .= " and lead_id in (select lead_id from policy_info where date(policy_issue_date) < '".$fromdate."')";
                            //     } else {
                            //         $sql .= " and date(a.datetime) < '".$fromdate."' ";
                            //     }
                            // }
                            $sql .= " group by 
                                        sub_id,c.name
                        )A 
                        left join (
                            select 
                                a.id, sum(floor(net_op)) as dr 
                            from 
                                agent_commission_transaction_orc ac, list_of_pos_and_agents a 
                            where 
                                ac.pos_code = a.agent_pos_code ";
                                if($agent_id)
                                    $sql .= " and a.id = {$agent_id} ";

                                $sql .= " and date(ac.creat_datetime) < '".$fromdate."'  
                            group by 
                                    a.id
                        )B on (A.sub_id = B.id)";
                                
        $Q = $this->db->query($sql);

        return $Q->result();
    }

    // 2023-08-12
    public function getMaxSRNo($type, $table, $year)
    {        	        
        $data = [];
        $sql = "select 
					COALESCE(max(cast(replace(SUBSTRING_INDEX(receipt_no, '/', 2), '".$type."', '') as unsigned)),0)+1 as new_receipt_no
				from 
					{$table}
				where 
					right(receipt_no,2) = '".$year."'";
       
        $Q = $this->db->query($sql);
        
        if( $Q->num_rows() > 0 ){
            $data = $Q->row_array();
        }
        $Q->free_result();
        return (isset($data['new_receipt_no']) && !empty($data['new_receipt_no'])) ? $type.$data['new_receipt_no']."/{$year}" : null;
    }

    //2023-08-12
    public function fetch_bank_account_id($name)
  	{        
        $this->db->like('vchaccname', $name);
        $data = $this->db->get("account_tree")->get();
        return (isset($data->vchaccid) && !empty($data->vchaccid)) ? $data->vchaccid : null;
    }

    public function add_direct_bank_drcr($data, $table) {
        return $this->db->insert($table,$data);
    }
    
    // public function TrialBalance($fromdate, $todate, $methods) {
    //     $sql = "Select 
    //                 cr_parent_id,coalesce(cr,0) as credit, coalesce(dr,0) as debit,vchaccname,vchaccid
    //             from
    //                 (
    //                     select 
    //                     cr_parent_id, sum(credit) as cr, sum(debit) as dr,note
    //                     from 
    //                         acc_commission_ledger
    //                     where 
    //                         is_invoice_generated = 0 ";
                                                                            
    //                     if($methods) {
    //                         if( $methods == "policy_issue_data") {
    //                             $sql .= " and lead_id in (select lead_id from policy_info where date(policy_issue_date) between '".$fromdate."' and '".$todate."')";
    //                         } else {
    //                             $sql .= " and date(datetime) between '".$fromdate."' and '".$todate."' ";
    //                         }
    //                     }
    //         $sql .= "   group by cr_parent_id
    //                 )A left join (select * from account_tree)B on (A.cr_parent_id = B.vchaccid)";

    //   / $Q = $this->db->query($sql);
       

    //   return $Q->result();
    // }
    
    public function TrialBalance($fromdate, $todate, $methods) {
    $sql = "SELECT 
                cr_parent_id, COALESCE(cr, 0) AS credit, COALESCE(dr, 0) AS debit, vchaccname, vchaccid
            FROM (
                SELECT 
                    cr_parent_id, SUM(credit) AS cr, SUM(debit) AS dr
                FROM 
                    acc_commission_ledger
                WHERE 
                    is_invoice_generated = 0 ";

    if ($methods) {
        if ($methods == "policy_issue_data") {
            $sql .= " AND lead_id IN (SELECT lead_id FROM policy_info WHERE DATE(policy_issue_date) BETWEEN '".$fromdate."' AND '".$todate."')";
        } else {
            $sql .= " AND DATE(datetime) BETWEEN '".$fromdate."' AND '".$todate."'";
        }
    }

    $sql .= "   GROUP BY cr_parent_id
            ) A
            LEFT JOIN (SELECT * FROM account_tree) B ON A.cr_parent_id = B.vchaccid";

    $Q = $this->db->query($sql);
    
    return $Q->result();
}

    
    // 2023-08-12
    public function fetch_jvlist($fromdate, $todate)
    {        
        $this->db->select("j.*,date_format(transaction_date, '%d-%m-%Y') as trans_date, a.vchaccname as account_name, a1.vchaccname as sub_category_name");
        $this->db->from("journalvoucher j");
        $this->db->join('account_tree a', 'a.vchaccid = j.account_id');
        $this->db->join('account_tree a1', 'a1.vchaccid = j.sub_category');
	    $this->db->where("transaction_date >=", $fromdate);        

	    $this->db->where("transaction_date <=", $todate);
        $this->db->order_by('transaction_date', 'ASC');
	    return $this->db->get()->result_array();	    
    }

    // 2023-08-12
    public function update_apply_forms($data,$vchaccid, $table)
    {
        $this->db->where("vchaccid",$vchaccid);
        if($this->db->update($table,$data)){
            return true;
        }

        return false;
    }
    
    public function add_cheque_entry($data)
    {
        $this->db->insert("list_of_cheque_entry",$data);
    }
}
  	?>