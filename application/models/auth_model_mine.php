<?php
class Auth_model_mine extends CI_Model {

	public function __construct()
	{
		$this->load->database();
		$this->load->library('ion_auth');
	}
	
	function Is_User($email)
	{
		return $this->ion_auth->email_check($email); 


	}
	function Is_In_Other_Than($email, $group)
	{
		 
		if ($this->ion_auth->in_group('admin',$email)) return true;
		else return false;
	}

	function Already_Farmakeio($email)
	{
		 
		$this->db->from('farmakeia');
		$this->db->join('users', 'farmakeia.user_id = users.id');
		$this->db->where('users.email',$email);
		$count= $this->db->count_all_results();
		//echo "das".$count;
		return $count!=0;
	}

	function Already_Giatros($email)
	{
		 
		$this->db->from('giatroi');
		$this->db->join('users', 'giatroi.user_id = users.id');
		$this->db->where('users.email',$email);
		$count= $this->db->count_all_results();
		//echo "das".$count;
		return $count!=0;
	}


    function Id_of_user($email)
	{
		 
		$this->db->from('users');		 
		$this->db->where('email',$email);
		$this->db->select('id');
		$id= $this->db->get()->row()->id;
		return $id;
	}

 

	function Table_Id_of_user($table,$id)
	{
	 

		$this->db->from($table);		 
		$this->db->where('user_id',$id);
		$this->db->select('id');
		$id= $this->db->get()->row()->id;
		return $id;
	}

	function Can_Be_Farmakeio($email)
	{
		if(!$this->ion_auth->email_check($email)) return false;
		
		//else return true;
		


	}
	 
   //	$this->ion_auth->logged_in() 
   //$this->ion_auth->in_group(4)
	 
	
	
}
?>