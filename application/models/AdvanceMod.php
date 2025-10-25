<?php  
class AdvanceMod extends CI_Model  
{  
  	function __construct()  
  	{ 
    	parent::__construct();  
    	$this->load->dbforge();
  	}
  	
  	public function fetch_load_agents()
  	{
  	    return $this->db->get("list_of_pos_and_agents")->result();
  	}
  	
  	public function add_advance_amount($data)
  	{
  	    $this->db->insert("agent_pos_advance",$data);
  	}
  	
  	public function agent_balance_log($ablog)
  	{
  	    $this->db->insert("agent_balance_log",$ablog);
  	}
  	
  	public function fetch_agent_advance($date,$agent)
  	{
  	    $this->db->select("agent_pos_advance.*,list_of_pos_and_agents.name as agent_pos_name,list_of_pos_and_agents.agent_pos_code");
  	    $this->db->from("agent_pos_advance");
  	    $this->db->join("list_of_pos_and_agents","agent_pos_advance.agent_id =list_of_pos_and_agents.id");
  	    $this->db->where("agent_pos_advance.date >=",$date);
  	    $this->db->where("agent_pos_advance.date <=",date("Y-m-t", strtotime($date)));
  	    
  	    if($agent != "All")
  	    {
  	        $this->db->where("agent_pos_advance.agent_id",$agent);
  	    }
  	    
  	    return $this->db->get()->result();
  	}
  	
  	 public function add_acc_agent_advance_orc($data1)
    {
        $this->db->insert("acc_commission_ledger_orc",$data1);
    }
    public function fetch_bank_detalis()
    {
      return $this->db->get("bank_details")->result();  
    }
    
    public function fetch_bank_details($select_bank)
    {
      $this->db->where("id",$select_bank);   
      return $this->db->get("bank_details")->result();
    }
    
    public function add_cheque_book_details($data)
    {
       $this->db->insert("cheque_book_details",$data);  
    }
  	
  	public function fetch_cheque_details()
  	{
  	 return $this->db->get("cheque_book_details")->result();     
  	}
  	public function fetch_edit_cheque_details($id)
    {
        $this->db->where("id",$id);
        return $this->db->get("cheque_book_details")->row();
    }
    
    public function edit_cheque_book_details($id,$data)
   {
        $this->db->where("id",$id);
        $this->db->update("cheque_book_details",$data);
    }
    public function delete_cheque_details($id)
    {
        $this->db->where("id",$id);
        $this->db->delete("cheque_book_details");
    }
    public function get_cheque_details($id)
    {
        $this->db->where("id",$id);
       return $this->db->get("cheque_book_details")->row();
    }
    
    public function generate_cheque_book($data)
    {
      $this->db->insert("cheque_book_entry",$data);  
    }
    
    public function fetch_book_entry_details()
    {
        //  $this->db->join("account_tree","cheque_book_entry.vchaccid =account_tree.accid",'left');
        // return $this->db->get("cheque_book_entry")->result();    
        
        $this->db->select("cheque_book_entry.*,bank_details.bank_name,bank_details.account_number,account_tree.vchaccname as usingacc");
        $this->db->from("cheque_book_entry");
        $this->db->join("bank_details","substr(cheque_book_entry.vchbank_id,5) =bank_details.id",'left');
        $this->db->join("account_tree","cheque_book_entry.vchaccid =account_tree.vchaccid",'left');
        return $this->db->get()->result(); 
    }
    
    // 2023-09-07
    public function fetch_cheque_info_data($id)
    {
         $this->db->select("cheque_book_entry.*,bank_details.bank_name,bank_details.account_number,account_tree.vchaccname as usingacc");
         $this->db->from("cheque_book_entry");
         $this->db->join("bank_details","substr(cheque_book_entry.vchbank_id,5) =bank_details.id",'left');
         $this->db->join("account_tree","cheque_book_entry.vchaccid =account_tree.vchaccid",'left');
         $this->db->where("cheque_book_entry.id",$id);
        return $this->db->get()->row();  
    }   
    
    public function fetch_using_cheque_details()
    {
        $this->db->join("account_tree","cheque_book_entry.vchaccid =account_tree.accid");
        return $this->db->get("cheque_book_entry")->result(); 
    }
    
    public function add_cheque_status($id,$data)
    {
        $this->db->where("id",$id);
        $this->db->update("cheque_book_entry",$data);
    }
    
    public function fetch_cheque_book($select_bank)
    {
      $this->db->where("status","N");
      $this->db->where("vchbank_id","acc/".$select_bank);    
      return $this->db->get("cheque_book_entry")->result();   
    }
    
    public function add_cheque_entry($data)
    {
        $this->db->insert("list_of_cheque_entry",$data);
    }

    public function update_cheque_entry($data, $chequeNo)
    {
        $this->db->where("cheque_number",$chequeNo);
        $this->db->update("list_of_cheque_entry",$data);
    }
    
    public function fetch_general_receipt($options = []) {
        if($options) {
            $this->db->where($options);
        }
        return $this->db->get("general_receipt")->result();   
    }

    public function fetch_cheque_entry($options = []) {
        $this->db->select("*,date_format(date, '%Y-%m-%d') as transdate,date_format(depostite_date, '%Y-%m-%d') as depostdate,date_format(clear_date, '%Y-%m-%d') as clrdate");
        if($options) {
            $this->db->where($options);
        }
        return $this->db->get("list_of_cheque_entry")->result();   
    }
    
 	
  	
}