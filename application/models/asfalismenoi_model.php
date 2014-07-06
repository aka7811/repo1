<?php
class Asfalismenoi_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function Get($offset,$pattern)
	{
		$this->db->from('asfalismenoi')->order_by("name", "desc"); 
		$this->db->select('*');

		if(!empty($pattern["id"]) )
		{
			 
			$this->db->where('id', $pattern["id"]); 
		}
		if(!empty($pattern["name"]) )
		{
			 
			$this->db->like('name', $pattern["name"]); 
		}
		 
		 


		$query = $this->db->get(null,4,$offset);
		
		return $query->result();
	}
	function Get_Count($pattern)
	{
			$this->db->from('asfalismenoi')->order_by("name", "desc"); 
		$this->db->select('*');

		if(!empty($pattern["id"]) )
		{
			 
			$this->db->where('id', $pattern["id"]); 
		}
		if(!empty($pattern["name"]) )
		{
			 
			$this->db->like('name', $pattern["name"]); 
		}
	 
		 
		$count= $this->db->count_all_results();
		return $count;
	}

 

	 

 

	 

	 
	
	
}
?>