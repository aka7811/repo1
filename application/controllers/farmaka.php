<?php
require 'validator.php';
class Farmaka extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('farmaka_model');
		$this->load->model('navmodel');
		$this->load->library('ion_auth');
		 
		$this->load->library('form_validation');
		$this->load->model('auth_model_mine');
		 

		

		$this->form_validation->set_error_delimiters('<div class="control-label">', '</div>');

		 
		 
		$this->load->helper('url');
		$this->load->helper('language');
		$this->load->helper('http_error');

		$this->lang->load('auth');
		$this->load->library('pagination');
		
		$this->request_json_data= json_decode(trim(file_get_contents('php://input')), true);
		 
		$this->request_json_data_obj= json_decode(trim(file_get_contents('php://input')));
		
 
		
		
	 
		
		 
	}
	public function _remap($method,$params=[])
	{
		if(!($this->ion_auth->logged_in() ))	
		{ show_error("Δεν επιτρέπεται η πρόσβαση",401); return;}

		$allowed=false;
		if($this->ion_auth->in_group(5)) $allowed=true;
		if($method=="index_j"||$method=="index_available_j") $allowed=true;
		
		if(!($allowed ))	
		{ show_error("Δεν επιτρέπεται η πρόσβαση",401); return;}

	    else
	    {
	        return call_user_func_array(array($this, $method), $params);
	    }
	}


	 
	public function index(){
	 
	 
	/*if(!($this->ion_auth->logged_in() && $this->ion_auth->in_group(5)))	
	{ show_error("Δεν επιτρέπεται η πρόσβαση",401); return;}*/

	
	$data['title'] = "Farmakakia" ;// Capitalize the first letter

		 
	
	$this->load->view('templates/header', $data);
	$this->load->view('templates/nav');
	$this->load->view('templates/redirect_message');

	$this->load->view('farmaka/index', $data);
	
	$this->load->view('templates/footer', $data);


	}

	public function edit( $id=0)
		{
		
	/*if(!($this->ion_auth->logged_in() && $this->ion_auth->in_group(5)))	
	{ show_error("Δεν επιτρέπεται η πρόσβαση",401); return;} */
		 	 
			$data['title'] = "Επεξεργασία Φαρμάκου" ; 
			
			$this->load->view('templates/header', $data);	
			$this->load->view('templates/nav' );
			$this->load->view('templates/redirect_message');
			
			 
				//$result=$this-> farmaka_model->Get_Item($id);
			 
				$data['id']=$id;
				 
			
				$this->load->view('farmaka/edit', $data);
				$this->load->view('templates/footer', $data);

				 
			
			
		 

		}


	function create()
		{

			/*if(!($this->ion_auth->logged_in() && $this->ion_auth->in_group(5)))	
			{show_error("Δεν επιτρέπεται η πρόσβαση",401); return;}*/

				$data['title'] = "Create farmakeio";
				 
				
				$this->load->view('templates/header', $data);
				$this->load->view('templates/nav');
				$this->load->view('templates/redirect_message');
				$this->load->view('farmaka/create', $data);
				$this->load->view('templates/footer', $data);
	    }







    public function index_j() {

		 
    	 		try{ 
			    $validator = new Json\Validator('json_schemata/farmaka/index_j.json');

				$validator->validate($this->request_json_data_obj);
			 	}
		 		catch (Exception $e) {
		    		show_error("Request didn't validate: ".$e->getMessage(),400);return;
				}


		$input_data = json_decode(trim(file_get_contents('php://input')), true);

	    	header('Content-Type: application/json');
			$this->output->set_status_header('200');
			/*if ($this->input->server('REQUEST_METHOD') !== 'POST')
			{
	    		echo json_encode( ["status"=>"error"] );
	    	}*/

		$offset=$input_data["offset"]; $pattern=$input_data["pattern"];
		 sleep(1);

		 
		
	 

		$result=$this-> farmaka_model->Get($offset,$pattern);
		$count=$this-> farmaka_model->Get_Count( $pattern);
		
		echo json_encode( ["result"=>$result, "result_count"=>$count, "status"=>"ok", "offset"=>$offset] );


	}
	
	 public function index_available_j() {

		 
    	 		try{ 
			    $validator = new Json\Validator('json_schemata/farmaka/index_j.json');

				$validator->validate($this->request_json_data_obj);
			 	}
		 		catch (Exception $e) {
		    		show_error("Request didn't validate: ".$e->getMessage(),400);return;
				}


		$input_data = json_decode(trim(file_get_contents('php://input')), true);

	    	
		 

		$offset=$input_data["offset"]; $pattern=$input_data["pattern"];
		  

		 
		
	 

		$result=$this-> farmaka_model->Get_Available($offset,$pattern);
		$count=$this-> farmaka_model->Get_Available_Count( $pattern);
		
		
		header('Content-Type: application/json');
		$this->output->set_status_header('200');
		echo json_encode( ["result"=>$result, "result_count"=>$count, "status"=>"ok", "offset"=>$offset] );


	}

	

	public function edit_j( )
		{

				try{ 
			    $validator = new Json\Validator('json_schemata/farmaka/edit_j.json');

				$validator->validate($this->request_json_data_obj);
			 	}
		 		catch (Exception $e) {
		    		show_error("Request didn't validate: ".$e->getMessage(),400);return;
				}

		 
		 	 
			$input_data = json_decode(trim(file_get_contents('php://input')), true);
			$id=$input_data['id'];
			$item=$input_data['item'];
			unset( $item['id'] );
		    	header('Content-Type: application/json');
				$this->output->set_status_header('200');
				//print_r( $id);
				//print_r($input_data);	 
		 	    $this-> farmaka_model->Put_Item($id, $item);
			 
				 
				 
				echo json_encode( ["status"=>"ok"] );

				 
			
			 

		}
		
	public function item_j( )
		{

				try{ 
			    $validator = new Json\Validator('json_schemata/farmaka/item_j.json');

				$validator->validate($this->request_json_data_obj);
			 	}
		 		catch (Exception $e) {
		    		show_error("Request didn't validate: ".$e->getMessage(),400);return;
				}
			
			$input_data = json_decode(trim(file_get_contents('php://input')), true);
			$id=$input_data['id'];

			unset( $input_data['id'] );
		    	header('Content-Type: application/json');
				 
				$result=$this-> farmaka_model->Get_Item($id);
				 
				echo json_encode( ["result"=>$result ]);

				 
			
			 

		}



	 


	

    function  create_j()
	{


		try{ 
		    $validator = new Json\Validator('json_schemata/farmaka/create_j.json');

			$validator->validate($this->request_json_data_obj);
		 	}
	 		catch (Exception $e) {
	    		show_error("Request didn't validate: ".$e->getMessage(),400);return;
			}
		
		$input_data = json_decode(trim(file_get_contents('php://input')), true);

		header('Content-Type: application/json');
		$this->output->set_status_header('200');
				 

			
		    
		$this->farmaka_model->Post_Item($input_data["item"]);
		    
           
			 
			
		echo json_encode( [ "status"=>"ok"] );

				 
	}


	public function delete( $id=0)
	{

	/*if(!($this->ion_auth->logged_in() && $this->ion_auth->in_group(5)))	
	{ 
	 show_error("Δεν επιτρέπεται η πρόσβαση",401); return;}*/
	 

	$data['title'] = "Farmakakia" ; 
	
	$this-> farmaka_model->Delete($id);
	//$this->session->set_flashdata('message_var', "");
	$this->session->set_flashdata('redirect_coded', "del");
	 
	 redirect('/farmaka' ); 
	/*$data['farmaka'] = $this-> farmaka_model->Get();
	$this->load->view('templates/header', $data);
	$this->load->view('templates/nav', array_merge($this->navdata,$this->message_array ));
	

	$this->load->view('farmaka/index', $data);
	$this->load->view('templates/footer', $data);*/


	}

	public function delete_j( )
	{

	 
	 
	/*try{ 
		    $validator = new Json\Validator('json_schemata/farmaka/create_j.json');

			$validator->validate($this->request_json_data_obj);
		 	}
	 		catch (Exception $e) {
	    		show_error("Request didn't validate: ".$e->getMessage(),400);return;
			}*/
		
		 

	 
	
	$this-> farmaka_model->Delete($this->request_json_data["id"]);
	header('Content-Type: application/json');
	$this->output->set_status_header('200');
	echo json_encode( [ "status"=>"ok"] );
	


	}
	
	 
	
	
	
}











