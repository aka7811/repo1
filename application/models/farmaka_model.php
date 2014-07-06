<?php
class Farmaka_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function Get_Count($pattern)
	{
		//echo "lalalala ".$pattern;
		$this->db-> from('farmaka');
		if(!empty($pattern["name"]) )
		{
			 
			$this->db->like('farmaka.name', $pattern["name"]); 
		}
		$count= $this->db->count_all_results();
		return $count;
	}

	function Get($offset,$pattern)
	{

		$this->db->order_by("id", "desc"); 
		 
		if(!empty($pattern["name"]) )
		{
			 
			$this->db->like('farmaka.name', $pattern["name"]); 
		}
		$query = $this->db->get('farmaka',4,$offset);
		
		return $query->result();
	}
	
	function Get_Available($offset,$pattern)
	{

		$this->db->order_by("id", "desc"); 
		$this->db-> where('available',1); 
		if(!empty($pattern["name"]) )
		{
			 
			$this->db->like('farmaka.name', $pattern["name"]); 
		}
		$query = $this->db->get('farmaka',4,$offset);
		
		return $query->result();
	}
	
	function Get_Available_Count($pattern)
	{
		//echo "lalalala ".$pattern;
		$this->db-> from('farmaka');
		$this->db-> where('available',1);
		if(!empty($pattern["name"]) )
		{
			 
			$this->db->like('farmaka.name', $pattern["name"]); 
		}
		$count= $this->db->count_all_results();
		return $count;
	}

	
	
	function Delete($id)
	{
	
	
		//$query = $this->db->get('farmaka');
		$this->db->delete('farmaka', array('id' => $id)); 
		return ;
	}

	function Get_Item($id)
	{
		//$query = $this->db->get('farmaka');
		  $this->db->select('*')->from('farmaka')->where('id',$id);
		 
        $result=$this->db->get()->row();
		 
		return  $result  ;
	}

	function Put_Item($id,$farmako)
	{
		 
		$this->db->where('id', $id);
		$this->db->update('farmaka', $farmako); 

		 
		 
		return    ;
	}

	function Post_Item($farmako)
	{
		 
		 $this->db->insert('farmaka', $farmako); 

		 

		 
		 
		return    ;
	}

	 
	
}
?>