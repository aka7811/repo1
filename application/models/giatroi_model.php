<?php
class Giatroi_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function Get_Count($pattern)
	{
		//echo "lalalala ".$pattern;
		$this->db->from('giatroi')->join('users', 'giatroi.user_id = users.id') ;
		$this->db->select('giatroi.id,giatroi.address,giatroi.name,giatroi.phone,giatroi.eidikotita,users.email');

		if(!empty($pattern["name"]) )
		{
			 
			$this->db->like('giatroi.name', $pattern["name"]); 
		}
		if(!empty($pattern["address"]) )
		{
			 
			$this->db->like('giatroi.address', $pattern["address"]); 
		}
		if(!empty($pattern["email"]) )
		{
			 
			$this->db->like('users.email', $pattern["email"]); 
		}
		if(!empty($pattern["phone"]) )
		{
			 
			$this->db->like('giatroi.phone', $pattern["phone"]); 
		}
		if(!empty($pattern["eidikotita"]) )
		{
			 
			$this->db->like('giatroi.eidikotita', $pattern["eidikotita"]); 
		}
		$count= $this->db->count_all_results();
		return $count;
	}

	function Get($offset,$pattern)
	{

		$this->db->from('giatroi')->join('users', 'giatroi.user_id = users.id')->order_by("giatroi.id", "desc"); 
		$this->db->select('giatroi.id,giatroi.address,giatroi.name,giatroi.phone,giatroi.eidikotita,users.email');

	 
		if(!empty($pattern["name"]) )
		{
			 
			$this->db->like('giatroi.name', $pattern["name"]); 
		}
		if(!empty($pattern["address"]) )
		{
			 
			$this->db->like('giatroi.address', $pattern["address"]); 
		}
		if(!empty($pattern["email"]) )
		{
			 
			$this->db->like('users.email', $pattern["email"]); 
		}
		if(!empty($pattern["phone"]) )
		{
			 
			$this->db->like('giatroi.phone', $pattern["phone"]); 
		}
		if(!empty($pattern["eidikotita"]) )
		{
			 
			$this->db->like('giatroi.eidikotita', $pattern["eidikotita"]); 
		}


		$query = $this->db->get(null,4,$offset);
		
		return $query->result();
	}
	
	function Get_Item($id)
	{
		
		$this->db->select('*')->from('giatroi')->where('id',$id);
		 
        $result=$this->db->get()->row();
		 
		return  $result  ;
	}

	function Put_Item($id,$giatros)
	{
		 
		$this->db->where('id', $id);
		$this->db->update('giatroi', $giatros); 

		 
		 
		return ;
	}

 

	function Create($userid)
	{
		 
		$giatros=["user_id"=>$userid];
		 
		 $this->db->insert('giatroi', $giatros); 
	}

	function Delete($id)
	{
	
	
		//$query = $this->db->get('farmaka');
		$this->db->delete('giatroi', array('id' => $id)); 
		return ;
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