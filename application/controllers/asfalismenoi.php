<?php

class Asfalismenoi extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('asfalismenoi_model');
		 

		$this->load->model('navmodel');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->model('auth_model_mine');
			
		 
		$this->load->helper('url');
		$this->load->helper('language');
		$this->lang->load('auth');
		 
	 
	 
		 
		 
		
		
	 
		 
	}

	 
	 public function _remap($method,$params=[])
	{
	     
		if(!($this->ion_auth->logged_in()))	
		{ show_error("Δεν επιτρέπεται η πρόσβαση",401); return;}

	    else
	    {
	        return call_user_func_array(array($this, $method), $params);
	    }
	}


    public function index_j() {

		$input_data = json_decode(trim(file_get_contents('php://input')), true);

	    

		$offset=$input_data["offset"];
		$pattern=$input_data["pattern"];
		 

		$result= $this-> asfalismenoi_model ->Get($offset,$pattern);
		$count= $this-> asfalismenoi_model ->Get_Count( $pattern);
		
		header('Content-Type: application/json');
		$this->output->set_status_header('200');
		echo json_encode( ["result"=>$result, "result_count"=>$count, "status"=>"ok", "offset"=>$offset] );


	}


	 

 
	
	
	
}











