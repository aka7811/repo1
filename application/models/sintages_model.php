<?php
class Sintages_model extends CI_Model {

	public function __construct()
	{
		$this->load->database();
	}
	
	 
 

	 
	function  Check_Same_Farmakeio($id,$farmakeio_id)
	{
		$this->db->from('sintages');
		 

		$this->db->where("sintages.id", $id);
		$this->db->where("sintages.farmakeio_id", $farmakeio_id);
		return $this->db->count_all_results() > 0;

 	}
 	
 	function  Check_Same_Giatros($id,$giatros_id)
	{
		$this->db->from('sintages');
		 

		$this->db->where("sintages.id", $id);
		$this->db->where("sintages.giatros_id", $giatros_id);
		return $this->db->count_all_results() > 0;

 	}


	
	
	function Create($giatros_id,$asfalismenos_id,$diagnoseis_ids,$slines)
	{
			echo "lolwut";
		$this->db->trans_start();
		 	$this->db->insert('sintages',["giatros_id"=>$giatros_id,"asfalismenos_id"=>$asfalismenos_id,"imerominia"=>date("Y-m-d H:i:s"),"katastasi"=>0]);
		 	$sintagi_id = $this->db->insert_id();

		 	foreach($diagnoseis_ids as $did)
		 	{
		 		$this->db->insert('sintages_diagnoseis',["sintagi_id"=>$sintagi_id,"diagnosi_id"=>$did]);
		 	}

		 	foreach($slines as $sline)
		 	{
		 		$this->db->insert('slines',["farmako_id"=>$sline["id"],"sintagi_id"=>$sintagi_id, "amount"=>$sline["amount"],"dosologia"=>$sline["dosologia"]]);
		 	}


			 
		$this->db->trans_complete();
	 
	}

	function Get_Sintages_Of_Giatros($giatros_id,$offset,$pattern)
	{
		$this->db->from('sintages')->join('asfalismenoi',"sintages.asfalismenos_id=asfalismenoi.id")->order_by("sintages.imerominia", "desc"); 
		$this->db->where("sintages.giatros_id", $giatros_id); 
		if(!empty($pattern["asfalismenos_id"]) )
		{
			 
			$this->db->where('sintages.asfalismenos_id', $pattern["asfalismenos_id"]); 
		}
		if(!empty($pattern["date_start"]) )
		{
			 
			$this->db->where('sintages.imerominia >', date($pattern["date_start"])); 
		}
		if(!empty($pattern["date_end"]) )
		{
			 
			$this->db->where('sintages.imerominia <', date($pattern["date_end"])); 
		}


		$this->db->select('sintages.id, sintages.katastasi, sintages.imerominia, asfalismenoi.name');

	
		 


		$query = $this->db->get(null,4,$offset);
		
		return $query->result();

	}

	function Get_Sintages_Of_Giatros_Count($giatros_id,$pattern)
	{
		$this->db->from('sintages')->join('asfalismenoi',"sintages.asfalismenos_id=asfalismenoi.id")->order_by("sintages.imerominia", "desc"); 
		$this->db->where("sintages.giatros_id", $giatros_id); 
		if(!empty($pattern["asfalismenos_id"]) )
		{
			 
			$this->db->where('sintages.asfalismenos_id', $pattern["asfalismenos_id"]); 
		}
		if(!empty($pattern["date_start"]) )
		{
			 
			$this->db->where('sintages.imerominia >', date($pattern["date_start"])); 
		}
		if(!empty($pattern["date_end"]) )
		{
			 
			$this->db->where('sintages.imerominia <', date($pattern["date_end"])); 
		}


		$this->db->select('*');

	
		 $count= $this->db->count_all_results();
		return $count;


		 
		
		 

	}

	function Get_Sintages_Of_Farmakeio($farmakeio_id,$offset,$pattern)
	{
		$this->db->from('sintages')->join('asfalismenoi',"sintages.asfalismenos_id=asfalismenoi.id")->order_by("sintages.imerominia", "desc"); 
		$this->db->where("sintages.farmakeio_id", $farmakeio_id); 
			if(!empty($pattern["asfalismenos_id"]) )
		{
			 
			$this->db->where('sintages.asfalismenos_id', $pattern["asfalismenos_id"]); 
		}

	    if(!empty($pattern["date_start"]) )
		{
			 
			$this->db->where('sintages.imerominia >', date($pattern["date_start"])); 
		}
		if(!empty($pattern["date_end"]) )
		{
			 
			$this->db->where('sintages.imerominia <', date($pattern["date_end"])); 
		}
		$this->db->select('sintages.id, sintages.katastasi, sintages.imerominia, asfalismenoi.name');

	
		 


		$query = $this->db->get(null,4,$offset);
		
		return $query->result();

	}

	function Get_Sintages_Of_Farmakeio_Count($farmakeio_id,$offset,$pattern)
	{
		$this->db->from('sintages')->join('asfalismenoi',"sintages.asfalismenos_id=asfalismenoi.id")->order_by("sintages.imerominia", "desc"); 
		$this->db->where("sintages.farmakeio_id", $farmakeio_id); 
			if(!empty($pattern["asfalismenos_id"]) )
		{
			 
			$this->db->where('sintages.asfalismenos_id', $pattern["asfalismenos_id"]); 
		}

    	if(!empty($pattern["date_start"]) )
		{
			 
			$this->db->where('sintages.imerominia >', date($pattern["date_start"])); 
		}
		if(!empty($pattern["date_end"]) )
		{
			 
			$this->db->where('sintages.imerominia <', date($pattern["date_end"])); 
		}
		$this->db->select('*');

	
		 $count= $this->db->count_all_results();
		return $count;


		 
		
		 

	}

	
	
 //elegxoi an ine diko tou? se xehoristo?
    function Get_Item_Giatrou($id)
	{
		 
		$this->db->from('sintages')
		->join('asfalismenoi',"sintages.asfalismenos_id=asfalismenoi.id");

		$this->db->where("sintages.id", $id); 
		

		$this->db->select('sintages.id, sintages.katastasi, sintages.imerominia, asfalismenoi.name');

		$query = $this->db->get( );
		
		$ret["sintagi"]=$query-> row();

		$this->db->from('sintages_diagnoseis')
	 
		->join('diagnoseis',"diagnoseis.id=sintages_diagnoseis.diagnosi_id");
		$this->db->where("sintages_diagnoseis.sintagi_id", $id); 
		$this->db->select('diagnoseis.name ');
		$query = $this->db->get( );

		$ret["diagnoseis"]=$query->result();

		$this->db->from('slines')
		->join('sintages',"sintages.id=slines.sintagi_id")
		->join('farmaka',"farmaka.id=slines.farmako_id");
		$this->db->where("sintages.id", $id); 
		$this->db->select('farmaka.name, slines.amount,  slines.dosologia');
		$query = $this->db->get( );

		$ret["slines"]=$query->result();
		
		return $ret ;
	}

	
//elegxoi an ine diko tou, h uncommited? se xehoristo?
	   function Get_Item_Farmakeiou($id)
	{
		//pare sintagi 
		$this->db->from('sintages')
		->join('asfalismenoi',"sintages.asfalismenos_id=asfalismenoi.id");

		$this->db->where("sintages.id", $id); 
		

		$this->db->select('sintages.id, sintages.katastasi, sintages.imerominia, asfalismenoi.name');

		$query = $this->db->get( );
		
		$ret["sintagi"]=$query-> row();


		//pare diagnoseis
		$this->db->from('sintages_diagnoseis')
	 
		->join('diagnoseis',"diagnoseis.id=sintages_diagnoseis.diagnosi_id");
		$this->db->where("sintages_diagnoseis.sintagi_id", $id); 
		$this->db->select('diagnoseis.name ');
		$query = $this->db->get( );

		$ret["diagnoseis"]=$query->result();

		//pare grammes
		$this->db->from('slines')
		->join('sintages',"sintages.id=slines.sintagi_id")
		->join('farmaka',"farmaka.id=slines.farmako_id");
		$this->db->where("sintages.id", $id); 
		$this->db->select('farmaka.name, slines.amount,  slines.dosologia');
		$query = $this->db->get( );

		$ret["slines"]=$query->result();
		
		return $ret ;
	}

	function  Get_Uncommited_Item($id)
	{
		$this->db->from('sintages');
		$this->db->where("sintages.id", $id);
		$this->db->where("sintages.katastasi", 0);
		$res_count=$this->db->count_all_results();
		if($res_count<1)return false;
		
		else
		{
		
				//pare sintagi 
		$this->db->from('sintages')
		->join('asfalismenoi',"sintages.asfalismenos_id=asfalismenoi.id");

		$this->db->where("sintages.id", $id); 
		$this->db->where("sintages.katastasi", 0);

		$this->db->select('sintages.id, sintages.katastasi, sintages.imerominia, asfalismenoi.name');

		$query = $this->db->get( );
		
		$ret["sintagi"]=$query-> row();


		//pare diagnoseis
		$this->db->from('sintages_diagnoseis')
	 
		->join('diagnoseis',"diagnoseis.id=sintages_diagnoseis.diagnosi_id");
		$this->db->where("sintages_diagnoseis.sintagi_id", $id); 
		$this->db->select('diagnoseis.name ');
		$query = $this->db->get( );

		$ret["diagnoseis"]=$query->result();

		//pare grammes
		$this->db->from('slines')
		->join('sintages',"sintages.id=slines.sintagi_id")
		->join('farmaka',"farmaka.id=slines.farmako_id");
		$this->db->where("sintages.id", $id); 
		$this->db->select('farmaka.name, slines.amount,  slines.dosologia');
		$query = $this->db->get( );

		$ret["slines"]=$query->result();
		
		return $ret ;
		
			 
		}


	}
	


	function Akyrose($id)
	{
		 
		
		 
		$this->db->where("sintages.id", $id); 
		$this->db->where("sintages.katastasi", 0); 
		$this->db->update('sintages',["katastasi"=>1]);

		 
		
		return $this->db->affected_rows() > 0;
	} 

	function Epikyrose($id, $farmakeio_id)
	{
		 
		
		 
		$this->db->where("sintages.id", $id); 
		$this->db->where("sintages.katastasi", 0); 
		$this->db->update('sintages',["katastasi"=>2,"farmakeio_id"=>$farmakeio_id]);

		 
		
		return $this->db->affected_rows() > 0;
	} 

	
	
	
}
?>