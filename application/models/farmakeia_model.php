<?php
class Farmakeia_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function Get_Count($pattern)
	{
		//echo "lalalala ".$pattern;
		$this->db->from('farmakeia')->join('users', 'farmakeia.user_id = users.id') ;
		$this->db->select('farmakeia.id,farmakeia.address,farmakeia.name,farmakeia.phone,users.email');

		if(!empty($pattern["name"]) )
		{
			 
			$this->db->like('farmakeia.name', $pattern["name"]); 
		}
		if(!empty($pattern["address"]) )
		{
			 
			$this->db->like('farmakeia.address', $pattern["address"]); 
		}
		if(!empty($pattern["email"]) )
		{
			 
			$this->db->like('users.email', $pattern["email"]); 
		}
		$count= $this->db->count_all_results();
		return $count;
	}

	function Get($offset,$pattern)
	{

		$this->db->from('farmakeia')->join('users', 'farmakeia.user_id = users.id')->order_by("farmakeia.id", "desc"); 
		$this->db->select('farmakeia.id,farmakeia.address,farmakeia.name,farmakeia.phone,users.email');

	 
		if(!empty($pattern["name"]) )
		{
			 
			$this->db->like('farmakeia.name', $pattern["name"]); 
		}
		if(!empty($pattern["address"]) )
		{
			 
			$this->db->like('farmakeia.address', $pattern["address"]); 
		}
		if(!empty($pattern["email"]) )
		{
			 
			$this->db->like('users.email', $pattern["email"]); 
		}


		$query = $this->db->get(null,4,$offset);
		
		return $query->result();
	}
	function Delete($id)
	{
	
	
		//$query = $this->db->get('farmaka');
		$this->db->delete('farmakeia', array('id' => $id)); 
		return ;
	}

	function Get_Item($id)
	{
		
		$this->db->select('*')->from('farmakeia')->where('id',$id);
		 
        $result=$this->db->get()->row();
		 
		return  $result  ;
	}

	function Put_Item($id,$farmako)
	{
		 
		$this->db->where('id', $id);
		$this->db->update('farmakeia', $farmako); 

		 
		 
		return ;
	}

 

	function Create($userid)
	{
		 
		$farmakeio=["user_id"=>$userid];
		 $this->db->insert('farmakeia', $farmakeio); 
	}

	/*function Get_Data_Cat($cat)
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
		 
	
	}*/
	
	
}
?>