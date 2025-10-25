<?php  
class Leadmodel extends CI_Model  
{  
  	function __construct()  
  	{ 
    	parent::__construct();  
    	$this->load->dbforge();
  	}
  	public function fetch_project_info()
  	{
  		return $this->db->get("project_info")->row();
  	}
    
    public function getLeads($leads) {
        $this->db->select('p.lead_id, p.policy_ex_date, l.id, l.assigned_user');
        $this->db->join('list_of_leads l', 'p.lead_id = l.id');        
  	    $this->db->where_in("l.id", $leads);  	    
        
        return $this->db->get('temp_policy_info p')->result();
    }

    public function update_leads_records($arr,$lead_id)
  	{
  	   $this->db->where("id",$lead_id);
  	   return $this->db->update("list_of_leads",$arr);
  	}
  public function fetch_renewallead($month = '')
    {
            $this->db->select('client_name,type_of_bussiness.bussiness_type,mobile_no,area,policy_ex_date,list_of_policy_type.policy_type,temp_policy_info.policy_s_date,temp_policy_info.policy_issue_date,temp_policy_info.lead_id,l.id as new_lead_id, l.lead_status, l.remarks, a.name as assigned_user, a1.name as nassigned_user');
            $this->db->from('list_of_leads');
            $this->db->join('temp_policy_info', 'temp_policy_info.lead_id = list_of_leads.id');
            $this->db->join('list_of_clients', 'list_of_clients.id= list_of_leads.client_id');
           $this->db->join('list_of_policy_type','list_of_policy_type.id=list_of_leads.policy_type');
            $this->db->join('type_of_bussiness','type_of_bussiness.id=list_of_leads.business_type');
            $this->db->join('list_of_leads l', 'l.parent_lead_id = list_of_leads.id', 'left');
            $this->db->join('admin_login a', 'a.id = list_of_leads.assigned_user', 'left');
            $this->db->join('admin_login a1', 'a1.id = l.assigned_user', 'left');
            // $this->db->where('policy_ex_date >=', date("Y-m-d"));
            // $this->db->where('policy_ex_date <=', date('Y-m-d', strtotime(date('Y-m-d').'+1 months')));
            
    //         $this->db->group_start();
		  //  $this->db->where('policy_ex_date >=', date("Y-m-d"));
		  //  $this->db->where('policy_ex_date <=', date('Y-m-d', strtotime(date('Y-m-d').'+1 months')));
		  //  $this->db->or_where('policy_ex_date <', date("Y-m-d"));
		  //  $this->db->group_end();
		  
	    if($month) {
            $this->db->where("date(policy_ex_date) between {$month}",null);
        } else {
            $this->db->group_start();
            $this->db->where('policy_ex_date >=', date("Y-m-d"));
            $this->db->where('policy_ex_date <=', date('Y-m-d', strtotime(date('Y-m-d').'+1 months')));
            $this->db->or_where('policy_ex_date <', date("Y-m-d"));
            $this->db->group_end();
        }
		    
		
		    
           return $this->db->get()->result();
    }
    public function fetch_failurelead()
    {
        $this->db->select('client_name,mobile_no,type_of_bussiness.bussiness_type,list_of_class.class,list_of_policy_type.policy_type,list_of_leads.due_date,');
        $this->db->from('list_of_leads');
        $this->db->join('list_of_class','list_of_class.id=list_of_leads.class');
        $this->db->join('list_of_policy_type','list_of_policy_type.id=list_of_leads.policy_type');
        $this->db->join('list_of_clients', 'list_of_clients.id= list_of_leads.client_id');
        $this->db->join('type_of_bussiness','type_of_bussiness.id=list_of_leads.business_type');
        $this->db->where('list_of_leads.lead_type !=',"2");
        $this->db->where('list_of_leads.policy_status !=',"1");
        $this->db->order_by("due_date", "asc");
        
        $this->db->where('due_date <', date("Y-m-d"));
        /*        
        $this->db->group_start();
        $this->db->where('due_date <', date("Y-m-d"));
        $this->db->or_where('lead_status ', 'lost');
		$this->db->group_end();
		*/
        return $this->db->get()->result();
        
        
    }
    
    
  
  	
}