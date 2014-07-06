<?php
class Diagnoseis_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function Get_Diagnoseis($offset,$pattern)
	{
		$this->db->from('diagnoseis')->order_by("name", "desc"); 
		$this->db->select('*');

	 
		if(!empty($pattern["name"]) )
		{
			 
			$this->db->like('name', $pattern["name"]); 
		}
		if(!empty($pattern["icd"]) )
		{
			 
			$this->db->like('icd', $pattern["icd"]); 
		}
		 


		$query = $this->db->get(null,4,$offset);
		
		return $query->result();
	}
	function Get_Diagnoseis_Count($pattern)
	{
		$this->db->from('diagnoseis')->order_by("name", "desc"); 
		$this->db->select('*');

	 
		if(!empty($pattern["name"]) )
		{
			 
			$this->db->like('name', $pattern["name"]); 
		}
		if(!empty($pattern["icd"]) )
		{
			 
			$this->db->like('icd', $pattern["icd"]); 
		}
		 
		$count= $this->db->count_all_results();
		return $count;
	}

 

	 

 

	 
	
	
	
}
?>