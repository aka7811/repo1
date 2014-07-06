<?php
class Task_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function Get_Data()
	{
		$query = $this->db->get('task');
		return $query->result();
	}
	function Get_Data_Cat($cat)
	{
		$this->db->select('*');
		$this->db->from('task');
		$this->db->join('categories', 'task.katigoria = categories.id');
		if($cat!=null)
		{$this->db->where('name', $cat); }
		
		return $this->db->get()->result();
	}
	
	function Get_Cat()
	{
		 
		$query = $this->db->get('categories');
		return $query->result_array();
	
	}
	
	function New_Task($new_task)
	{
		 
		return $this->db->insert('task', $new_task); ;
		 
	
	}
	
	function Get_Task_By_Slag($slug)
	{
		 $this->db->select('*');
		$this->db->from('task');
		$this->db->where('slug', $slug);
		return $this->db->get()->row();
		 
	
	}
	
	function Delete_Task($id)
	{
		$this->db->where('id', $id);
		$this->db->delete('task'); 
		return ;//$this->db->get()->row();
		 
	
	}
	
	
}
?>