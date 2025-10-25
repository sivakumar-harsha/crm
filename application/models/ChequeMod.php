<?php  
class ChequeMod extends CI_Model  
{  
  	function __construct()  
  	{ 
    	parent::__construct();  
    	$this->load->dbforge();
  	}
  	
  	public function fetch_cheque_details_gr($cheque_number)
  	{
  	    
  	     $this->db->select("general_receipt.*,a1.vchaccname as accname,a2.vchaccname as particulars, '' as cheque_status");
  	     $this->db->from("general_receipt");
  	     $this->db->join("account_tree a1","general_receipt.account_id = a1.vchaccid");
  	     $this->db->join("account_tree a2","general_receipt.particulars = a2.vchaccid");
  	    if($cheque_number)
  	    {
  	        $this->db->where("cheque_no",$cheque_number);
  	        
  	    }
  	     return $this->db->get()->result();
  	}
  	
  	public function fetch_cheque_details_mvc($cheque_number)
  	{
  	     $this->db->select("mv_receipt.*,cheque_book_entry.vchcheque_character_no,a1.vchaccname as accname,a2.vchaccname as sub_name");
  	     $this->db->from("mv_receipt");
  	     $this->db->join("cheque_book_entry","mv_receipt.cheque_no = cheque_book_entry.id");
  	     $this->db->join("account_tree a1","mv_receipt.account_id = a1.vchaccid");
  	     $this->db->join("account_tree a2","mv_receipt.sub_category = a2.vchaccid");
  	    if($cheque_number)
  	    {
  	        $this->db->where("cheque_book_entry.cheque_no",$cheque_number);
  	        
  	    }
  	     return $this->db->get()->result();
  	}
  	
  	
  	public function view_cheque_deatils_mvc($id)
  	{
  	    
  	    $this->db->select("mv_receipt.*,cheque_book_entry.vchcheque_character_no,a1.vchaccname as accname,a2.vchaccname as sub_name, cheque_status,Returned_reason, cheque_date,accout_name, 
		  bank_name ");
  	    $this->db->from("mv_receipt");
  	    $this->db->join("cheque_book_entry","mv_receipt.cheque_no =cheque_book_entry.id");
  	    $this->db->join("account_tree a1","mv_receipt.account_id = a1.vchaccid");
  	    $this->db->join("account_tree a2","mv_receipt.sub_category = a2.vchaccid");
		$this->db->join("bank_details","bank_details.id = SUBSTR(cheque_book_entry.vchbank_id, 5)");
  	    $this->db->where("cheque_book_entry.id",$id);
  	        
  	    return $this->db->get()->result();
  	    
  	}
  	
  	
  	public function view_cheque_deatils_gr($id)
  	{
  	    
  	   $this->db->select("general_receipt.*,a1.vchaccname as accname,a2.vchaccname as particulars, '' as cheque_status");
  	     $this->db->from("general_receipt");
  	     $this->db->join("account_tree a1","general_receipt.account_id = a1.vchaccid");
  	     $this->db->join("account_tree a2","general_receipt.particulars = a2.vchaccid");
  	     $this->db->where("general_receipt.id",$id);
  	     return $this->db->get()->result();  
  	    
  	}
  	
  	
}