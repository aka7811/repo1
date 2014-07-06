<?php
class Navmodel extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	function Get_Categories()
	{
		$query = $this->db->get('categories');
		return $query->result_array();
	}
	function Get_Links()
	{
		$ret=	[
			 
			["�������","/farmaka"],
			["���������","/farmakeia"],
			["�������","/giatroi"],
			 
			
			]
			;
			
		 
		return $ret;
	}
	
	function Get_Links2()
	{
		$ret=	[
			 
		 
			["���� �������","/auth/login_as_giatros"],
			["���� ���������","/auth/login_as_farmakeio"],
			["���� ������� 2","/auth/login_as_giatros2"],
			["���� ��������� 2","/auth/login_as_farmakeio2"],
			["���� admin2","/auth/login_as_admin2"],
			
			]
			;
			
		 
		return $ret;
	}
	
	
	function Get_User_Options($id)
	{
	
	  $ret=
			[
			 
			["������ �������","/auth/change_password"],
			["����������� ���������","/auth/edit_user/".$id],
			
			]
			;
			
		 
		return $ret;
	}
	function Get_Farmakeio_Options($farmakeio_id)
	{
	
	 	  $ret=
			[
			 
			["��������� ��������","/sintages/epikyrosi_chooser"],
			["����������� ��������� ����������","/farmakeia/edit/".$farmakeio_id],
			["������� ��������","/sintages/farmakeiou/".$farmakeio_id]
			]
			;
			
		 
		return $ret;
	}
	function Get_Giatros_Options($giatros_id)
	{
	
	  $ret=
			[
			 
			 
			["����������� ��������� �������","/giatroi/edit/".$giatros_id],
			["������� ��������","/sintages/giatrou/".$giatros_id]
			
			]
			;
			
		 
		return $ret;
	}
	function Get_Admin_Options()
	{
	 
        $ret=
			[
			 
			["Dashboard","/index.php/auth/"],
			
			]
			;
			
		 
		return $ret;
	}
	function Get_Admin2_Options()
	{
	 
        $ret=
			[
			 
			 
			["�������","/index.php/farmaka"],
			["���������","/index.php/farmakeia"],
			["�������","/index.php/giatroi"]
			
			]
			;
			
		 
		return $ret;
	}
}
?>