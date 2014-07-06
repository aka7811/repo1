<?php

class Diagnoseis extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('diagnoseis_model');
		
		$this->load->model('navmodel');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->model('auth_model_mine');
			
		 
		$this->load->helper('url');
		$this->load->helper('language');
		$this->lang->load('auth');
		 
		 
		 
		 
		
		
	 
		 
	}

	 
	 
	 
	
	function  index_j()
	{


		$input_data = json_decode(trim(file_get_contents('php://input')), true);

    	header('Content-Type: application/json');
		$this->output->set_status_header('200');
		/*if ($this->input->server('REQUEST_METHOD') !== 'POST')
		{
    		echo json_encode( ["status"=>"error"] );
    	}*/

		$offset=$input_data["offset"]; $pattern=$input_data["pattern"];
		 

	 
	
 

		$result=$this->diagnoseis_model->Get_Diagnoseis($offset,$pattern);
		$count=$this->diagnoseis_model->Get_Diagnoseis_Count( $pattern);
	
		echo json_encode( ["result"=>$result, "result_count"=>$count, "status"=>"ok", "offset"=>$offset] );

				 
	}

	 
	
}











