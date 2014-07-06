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
			 
			["Φάρμακα","/farmaka"],
			["Φαρμακεία","/farmakeia"],
			["Γιατροί","/giatroi"],
			 
			
			]
			;
			
		 
		return $ret;
	}
	
	function Get_Links2()
	{
		$ret=	[
			 
		 
			["Γίνε γιατρός","/auth/login_as_giatros"],
			["Γίνε φαρμακείο","/auth/login_as_farmakeio"],
			["Γίνε γιατρός 2","/auth/login_as_giatros2"],
			["Γίνε φαρμακείο 2","/auth/login_as_farmakeio2"],
			["Γίνε admin2","/auth/login_as_admin2"],
			
			]
			;
			
		 
		return $ret;
	}
	
	
	function Get_User_Options($id)
	{
	
	  $ret=
			[
			 
			["Αλλαγή Κωδικού","/auth/change_password"],
			["Επεξεργασία στοιχείων","/auth/edit_user/".$id],
			
			]
			;
			
		 
		return $ret;
	}
	function Get_Farmakeio_Options($farmakeio_id)
	{
	
	 	  $ret=
			[
			 
			["Επικύρωση Συνταγής","/sintages/epikyrosi_chooser"],
			["Επεξεργασία στοιχείων Φαρμακείου","/farmakeia/edit/".$farmakeio_id],
			["Προβολή Συνταγών","/sintages/farmakeiou/".$farmakeio_id]
			]
			;
			
		 
		return $ret;
	}
	function Get_Giatros_Options($giatros_id)
	{
	
	  $ret=
			[
			 
			 
			["Επεξεργασία στοιχείων Γιατρού","/giatroi/edit/".$giatros_id],
			["Προβολή Συνταγών","/sintages/giatrou/".$giatros_id]
			
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
			 
			 
			["Φάρμακα","/index.php/farmaka"],
			["Φαρμακεία","/index.php/farmakeia"],
			["Γιατροί","/index.php/giatroi"]
			
			]
			;
			
		 
		return $ret;
	}
}
?>