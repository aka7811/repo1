<?php
require 'validator.php';
class Farmakeia extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('farmakeia_model');
		$this->load->model('navmodel');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->model('auth_model_mine');
		 
		//$this->form_validation->set_error_delimiters('<div class="control-label">', '</div>');

		$this->load->helper('url');
		$this->load->helper('language');
		$this->lang->load('auth');
		 
		// find nav data 
		
		/*$this->navdata['categories'] = $this-> navmodel->Get_Categories();
		if ($this->ion_auth->logged_in())
		{
			$this->navdata['user_options']=$this-> navmodel->Get_User_Options($this->ion_auth->user()->row()->id);
			if($this->ion_auth->is_admin())
			{
				$this->navdata['admin_options']=$this-> navmodel->Get_Admin_Options();
			}
			 
		} */
		 
		 
		$this->request_json_data= json_decode(trim(file_get_contents('php://input')), true);
		  
		$this->request_json_data_obj= json_decode(trim(file_get_contents('php://input')));
		
		
	 
		 
	}

	public function _remap($method,$params=[])
	{
		if(!($this->ion_auth->logged_in() ))	
		{ show_error("Δεν επιτρέπεται η πρόσβαση",401); return;}
		
		$allow=true;
		$same_id_passed=false;
		$admin2=false;
		$farmakeio=false;
		
		if($this->ion_auth->in_group(5)) $admin2=true;
		$can_edit_as_admin2=($admin2&&($this->config->item('admin2_can_edit_user_data')));

		if(!($admin2))
		{
			if($this->ion_auth->in_group(3)) $farmakeio=true;
		}
		if($farmakeio)
		{
			if($method=='edit')
			$same_id_passed=$this->auth_model_mine->Table_Id_of_user('farmakeia',$this->ion_auth->user()->row()->id)==$params[0];
			else if($method=='edit_j')
			$same_id_passed=$this->auth_model_mine->Table_Id_of_user('farmakeia',$this->ion_auth->user()->row()->id)==$this->request_json_data["id"];
		}
	 

		if($method=='edit'||$method=='edit_j')    		{$allow=$can_edit_as_admin2||$same_id_passed; }
		else if ($method=='item'||$method=='item_j')    {$allow=$admin2||$farmakeio;}//pos diavazeis to post edo?
		else 											{$allow= $admin2 ;}
	    
	        
       

		if(!$allow ) { show_error("Απαγορεύεται η πρόσβαση",401); return;}
		return call_user_func_array(array($this, $method), $params);
	}
	 
	public function index() 
	{
		 

	 

		$data['title'] = "Φαρμακεία" ;// Capitalize the first letter

		 
		 
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav'  );
		$this->load->view('templates/redirect_message');

		$this->load->view('farmakeia/index', $data);
		
		$this->load->view('templates/footer', $data);


	}



    public function index_j() {

    	 try{ 
			    $validator = new Json\Validator('json_schemata/farmakeia/index_j.json');

				$validator->validate($this->request_json_data_obj);
			 	}
		 		catch (Exception $e) {
		    		show_error("Request didn't validate: ".$e->getMessage(),400);return;
				}


		$input_data = json_decode(trim(file_get_contents('php://input')), true);

	    

		$offset=$input_data["offset"];
		$pattern=$input_data["pattern"];
		//		$pattern["name_pattern"]=$input_data["name_pattern"];
		//$pattern["address_pattern"]=$input_data["address_pattern"];
		//$pattern["email_pattern"]=$input_data["email_pattern"];
		// sleep(1);
		//print_r($pattern);

		$result= $this-> farmakeia_model ->Get($offset,$pattern);
		$count= $this-> farmakeia_model ->Get_Count( $pattern);
		
		header('Content-Type: application/json');
		$this->output->set_status_header('200');
		echo json_encode( ["result"=>$result, "result_count"=>$count, "status"=>"ok", "offset"=>$offset] );


	}


	public function edit( $id=0)
	{
	 
	 	 
		$data['title'] = "Επεξεργασία Στοιχείων Φαρμακείου" ;// Capitalize the first letter
		
		$this->load->view('templates/header', $data);	
		$this->load->view('templates/nav' );
		$this->load->view('templates/redirect_message');
		
		 
			//$result=$this-> farmakeia_model->Get_Item($id);
		 
			$data['id']=$id;
			 
		  if($this->ion_auth->in_group(5))
				$this->load->view('farmakeia/edit_a', $data);
				else
				$this->load->view('farmakeia/edit_u', $data);
			 
			$this->load->view('templates/footer', $data);

			 
		
		
	 

	}

	public function item_j( )
		{

			//check incoming data
			//should you return errors for them
			//and handle them back at the browser????
			//how about the xsrf
		  try{ 
			    $validator = new Json\Validator('json_schemata/farmakeia/item_j.json');

				$validator->validate($this->request_json_data_obj);
			 	}
		 		catch (Exception $e) {
		    		show_error("Request didn't validate: ".$e->getMessage(),400);return;
				}
		 	

			$input_data = json_decode(trim(file_get_contents('php://input')), true);
			$id=$input_data['id'];

			 
		    	header('Content-Type: application/json');
				 
				$result=$this-> farmakeia_model->Get_Item($id);
				 
				echo json_encode( ["result"=>$result ]);

				 
			
			 

		}


	public function edit_j( )
	{

		//check incoming data
		//should you return errors for them
		//and handle them back at the browser????
		//how about the xsrf
	 
	 	  try{ 
			    $validator = new Json\Validator('json_schemata/farmakeia/edit_j.json');

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
				 
	 	     $this-> farmakeia_model->Put_Item($id, $item);
		 
			$result=$this-> farmakeia_model->Get_Item($id);
			 
			echo json_encode( $result );

			 
		
		 

	}

	 

	public function delete( $id=0)
	{
	 
	 
	
	$this-> farmakeia_model->Delete($id);
	 
	$this->session->set_flashdata('redirect_coded', "del");
	 
	redirect('/farmaka' ); 
	 


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
		
		 

	 
	
	$this-> farmakeia_model->Delete($this->request_json_data["id"]);
	header('Content-Type: application/json');
	$this->output->set_status_header('200');
	echo json_encode( [ "status"=>"ok"] );
	


	}

	function create()
	{
			$data['title'] = "Create farmakeio";
			 
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/nav' );
			$this->load->view('templates/redirect_message');
			$this->load->view('farmakeia/create', $data);
			$this->load->view('templates/footer', $data);
    }

    function  create_j()
	{


		 try{ 
			    $validator = new Json\Validator('json_schemata/farmakeia/create_j.json');

				$validator->validate($this->request_json_data_obj);
			 	}
		 		catch (Exception $e) {
		    		show_error("Request didn't validate: ".$e->getMessage(),400);return;
				}
		
		$input_data = json_decode(trim(file_get_contents('php://input')), true);

		    	header('Content-Type: application/json');
				$this->output->set_status_header('200');
				 

			$user_email=$input_data["user_email"]; 
			

			//$can_be = $this->auth_model_mine->Can_Be_Farmakeio($user_email);

			$is_user= $this->auth_model_mine->Is_User($user_email);
			$is_other_role= $this->auth_model_mine-> Is_In_Other_Than($user_email, "freipoe");
			$is_already=  $this->auth_model_mine-> Already_Farmakeio($user_email); 
			
		    $can_be = $is_user && !$is_other_role && !$is_already;
		    $id= -43;
		    if($can_be==true)
		    {
		    	$id= $this->auth_model_mine->Id_of_user($user_email);
		    	$this->ion_auth->remove_from_group(NULL,$id);
		    	$this->ion_auth->add_to_group(3, $id);
		    	$this->farmakeia_model->Create($id);
		    }
           
			 
			
			echo json_encode( ["can_be"=>$can_be, "is_user"=>$is_user, "is_other_role"=>$is_other_role, "is_already"=>$is_already, "status"=>"ok", "id"=> $id] );

				 
	}
	
	

	 
	
	
	
}











