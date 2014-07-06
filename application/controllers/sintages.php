<?php
require 'validator.php';
class Sintages extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('sintages_model');
		$this->load->model('asfalismenoi_model');
		$this->load->model('giatroi_model');
		$this->load->model('farmakeia_model');
		$this->load->model('farmaka_model');

		$this->load->model('navmodel');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->model('auth_model_mine');
			
		 
		$this->load->helper('url');
		$this->load->helper('language');
		$this->lang->load('auth');
		 
		$this->request_json_data= json_decode(trim(file_get_contents('php://input')), true);
		 
		$this->request_json_data_obj= json_decode(trim(file_get_contents('php://input')));
		
		 
		 
		
		
	 
		 
	}

	public function _remap($method,$params=[])
	{
		if(!($this->ion_auth->logged_in() ))	
		{ show_error("Δεν επιτρέπεται η πρόσβαση",401); return;}
		
		$allow=true;

		$giatros=$this->ion_auth->in_group(4);
		$giatros_same_id=$giatros_id=false;
		if($giatros)
		{
		$giatros_id =$this->auth_model_mine->Table_Id_of_user('giatroi',$this->ion_auth->user()->row()->id);
			if ($method=="item_giatrou_j"||$method=="akyrose_j")
			{
				$giatros_same_id=
				$this->sintages_model->
				Check_Same_Giatros($this->request_json_data["id"],$giatros_id);
			}
		}

		$farmakeio=$this->ion_auth->in_group(3);
		$farmakeio_same_id=$farmakeio_id=false;
		if($farmakeio)
		{
		$farmakeio_id =$this->auth_model_mine->Table_Id_of_user('farmakeia',$this->ion_auth->user()->row()->id);
			if ($method=="item_farmakeiou_j")
			{
				$farmakeio_same_id=
				$this->sintages_model->
				Check_Same_Farmakeio($this->request_json_data["id"],$farmakeio_id);
			}
		}
		
		
		
		 
		
		if ($method=="index"||$method==""||$method=="create") 				{$allow=$giatros;}
		if ($method=="create_j") 											{$allow=$giatros;}
		if ($method=="giatrou"||$method=="giatrou_j")						{$allow=$giatros;}	
		if ($method=="item_giatrou")										{$allow=$giatros;}	 
		if ($method=="item_giatrou_j")										{$allow=$giatros&&$giatros_same_id;}	 
		if ($method=="akyrose_j")                     						{$allow=$giatros&&$giatros_same_id;}
		 
 		 
		
		if ($method=="farmakeiou"||$method=="farmakeiou_j")					{$allow=$farmakeio;}	
		if ($method=="item_farmakeiou")										{$allow=$farmakeio;}	 
		if ($method=="item_farmakeiou_j")									{$allow=$farmakeio;}	 
		if ($method=="epikyrosi_chooser"||$method=="epikyrose_j")           {$allow=$farmakeio;}
		 

			 
		 
		
	 
        
		 
		$message=print_r(
			[
			"giatros"=>$giatros,
			"giatros_id"=>$giatros_id,
			"giatros_same_id"=>$giatros_same_id,
			"farmakeio"=>$farmakeio,
			"farmakeio_id"=>$farmakeio_id,
			"farmakeio_same_id"=>$farmakeio_same_id
			 
			
			]

			,true );

	 
	        
       

		if(!$allow ) { show_error($message."Απαγορεύεται η πρόσβαση",401); return;}
		return call_user_func_array(array($this, $method), $params);
	}

	 
	public function create() 
	{
		 

	 

		$data['title'] = "Συνταγές" ;// Capitalize the first letter

		 
		 
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav' );
		$this->load->view('templates/redirect_message');

		$this->load->view('sintages/create', $data);
		
		$this->load->view('templates/footer', $data);


	}

	public function epikyrosi_chooser() 
	{
		 

	 

		$data['title'] = "Επικύρωσεις" ;// Capitalize the first letter

		 
		 
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav');
		$this->load->view('templates/redirect_message');

		$this->load->view('sintages/epikyrosi_chooser', $data);
		
		$this->load->view('templates/footer', $data);


	}

	public function giatrou() 
	{
		 

	 

		$data['title'] = "Συνταγές Γιατρού" ;// Capitalize the first letter

		 
		 
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav');
		$this->load->view('templates/redirect_message');

		$this->load->view('sintages/giatrou', $data);
		
		$this->load->view('templates/footer', $data);


	}
	public function farmakeiou() 
	{
		 

	 

		$data['title'] = "Συνταγές Φαρμακείου" ;// Capitalize the first letter

		 
		 
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav');
		$this->load->view('templates/redirect_message');

		$this->load->view('sintages/farmakeiou', $data);
		
		$this->load->view('templates/footer', $data);


	}



	public function item_giatrou($id) 
	{
		 

	 
		 
		$data['title'] = "Προβολή Συνταγής" ;// Capitalize the first letter
		$data['id'] = $id;
		 
		 
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav' );
		$this->load->view('templates/redirect_message');

		$this->load->view('sintages/item_giatrou', $data);
		
		$this->load->view('templates/footer', $data);


	}

	public function item_farmakeiou($id) 
	{
		 

	 

		$data['title'] = "Προβολή Συνταγής" ;// Capitalize the first letter
		$data['id'] = $id;
		 
		 
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav' );
		$this->load->view('templates/redirect_message');

		$this->load->view('sintages/item_farmakeiou', $data);
		
		$this->load->view('templates/footer', $data);


	}

	
	
	
	public function item_giatrou_j() 
	{
		 

	 $this->load->model("sintages_model");
     $input_data = json_decode(trim(file_get_contents('php://input')), true);
     $id=$input_data["id"];
	 $res=  $this-> sintages_model-> Get_Item_Giatrou($id);
	 header('Content-Type: application/json');
     $this->output->set_status_header('200');
	 echo json_encode( ["status"=>"ok","result"=>$res] );

	}
	public function item_farmakeiou_j() 
	{
		 

	 $this->load->model("sintages_model");
     $input_data = json_decode(trim(file_get_contents('php://input')), true);
     $id=$input_data["id"];
	 $res=  $this-> sintages_model-> Get_Item_Farmakeiou($id);
	 
	 header('Content-Type: application/json');
     $this->output->set_status_header('200');
	 echo json_encode( ["status"=>"ok","result"=>$res] );

	}

	
	//status:"ok", result:sintagi  | status:"not_commitable"
	public function item_uncommited_j() 
	{
		 

	 $this->load->model("sintages_model");
     $input_data = json_decode(trim(file_get_contents('php://input')), true);
     $id=$input_data["id"];
	 $res=  $this-> sintages_model-> Get_Uncommited_Item($id);
	 if($res){
	 	header('Content-Type: application/json');
    	$this->output->set_status_header('200');
		 echo json_encode( ["status"=>"ok","result"=>$res] );
		}
		else
		{
			header('Content-Type: application/json');
    		$this->output->set_status_header('200');
    		echo json_encode( ["status"=>"not_commitable"] );
		}
	}



 

	 
	 

    function  create_j()
	{


	 
		
		  try{ 
			    $validator = new Json\Validator('json_schemata/sintages/create_j.json');

				$validator->validate($this->request_json_data_obj);
			 	}
		 		catch (Exception $e) {
		    		show_error("Request didn't validate: ".$e->getMessage(),400);return;
				}
			$input_data = $this->request_json_data;
		 
    	

    	 
				
				$giatros_id=$user = $this->auth_model_mine->Table_Id_of_user('giatroi',$this->ion_auth->user()->row()->id);

				$asfalismenos_id=$input_data["asfalismenos"]["id"];
				
				$diagnoseis_ids=[];$slines=[];
				
				foreach ($input_data["diagnoseis"] as $diagnosi)
				{
					$diagnoseis_ids[]=	$diagnosi["id"];
				}
				foreach ($input_data["slines"] as $sline)
				{
					$slines[]= ["id"=>$sline["farmako"]["id"], "amount"=>$sline["amount"], "dosologia"=>$sline["dosologia"]];
				}
				//$res= ["gid"=>$giatros_id, "diagnoseis_ids"=>$diagnoseis_ids, "slines"=>$slines];

				$this-> sintages_model-> Create($giatros_id,$asfalismenos_id,$diagnoseis_ids,$slines);
				  
				
				header('Content-Type: application/json');
				$this->output->set_status_header('200');
				echo json_encode( ["status"=>"ok" ] );
				 
          

				 
	}
	
	
	 
	
 

	function  akyrose_j()
	{


		$input_data = json_decode(trim(file_get_contents('php://input')), true);

    	
		/*if ($this->input->server('REQUEST_METHOD') !== 'POST')
		{
    		echo json_encode( ["status"=>"error"] );
    	}*/

		$id=$input_data["id"];  
		 

	 
	
 

		$result=$this-> sintages_model->Akyrose($id);
		 
	    header('Content-Type: application/json');
		$this->output->set_status_header('200');
		echo json_encode( [  "status"=>"ok" ] );

				 
	}

	


	function  epikyrose_j()
	{


		$input_data = json_decode(trim(file_get_contents('php://input')), true);

    	header('Content-Type: application/json');
		$this->output->set_status_header('200');
		/*if ($this->input->server('REQUEST_METHOD') !== 'POST')
		{
    		echo json_encode( ["status"=>"error"] );
    	}*/

		$id=$input_data["id"];  
		 
				
		$farmakeio_id=$user = $this->auth_model_mine->Table_Id_of_user('farmakeia',$this->ion_auth->user()->row()->id);
		$this-> sintages_model->Epikyrose($id,$farmakeio_id);	

	 	 
	
 

		 
		 
	
		echo json_encode( [  "status"=>"ok" ] );

				 
	}

	
	public function giatrou_j() 
	{
		 

	 

		$this->load->model("sintages_model");
		
		 
		$input_data = json_decode(trim(file_get_contents('php://input')), true);
		$offset=$input_data["offset"];
		$pattern=$input_data["pattern"];

				
		$giatros_id=  $this->auth_model_mine->Table_Id_of_user('giatroi',$this->ion_auth->user()->row()->id);

				 

		$result = $this-> sintages_model-> Get_Sintages_Of_Giatros($giatros_id,$offset,$pattern );
		$count=   $this-> sintages_model-> Get_Sintages_Of_Giatros_Count($giatros_id,$pattern );
				  
		header('Content-Type: application/json');
		$this->output->set_status_header('200');
		echo  json_encode( ["result"=>$result, "result_count"=>$count, "status"=>"ok", "offset"=>$offset] );
				  
        

	}

	
	public function farmakeiou_j() 
	{
		 

	 

		$this->load->model("sintages_model");
		
		 
		$input_data = json_decode(trim(file_get_contents('php://input')), true);
		$offset=$input_data["offset"];
		$pattern=$input_data["pattern"];


 
				
				$farmakeio_id=$user = $this->auth_model_mine->Table_Id_of_user('farmakeia',$this->ion_auth->user()->row()->id);

				 

				$result = $this-> sintages_model-> Get_Sintages_Of_Farmakeio($farmakeio_id,$offset,$pattern );
				$count=   $this-> sintages_model-> Get_Sintages_Of_Farmakeio_Count($farmakeio_id,$offset,$pattern );
				 //$slines=$input_data["slines"];
				//print_r($asfalismenos);print_r($diagnoseis);print_r($slines);
				
				header('Content-Type: application/json');
				$this->output->set_status_header('200');
				echo  json_encode( ["result"=>$result, "result_count"=>$count, "status"=>"ok", "offset"=>$offset] );
				  
           

	}
	
}











