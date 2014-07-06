 
<?php
require 'validator.php';
require 'array_to_stdclass.php';
 
class Giatroi extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		
		$this->load->model('giatroi_model');
		$this->load->model('navmodel');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->model('auth_model_mine');
			
		$this->form_validation->set_error_delimiters('<div class="control-label">', '</div>');

		$this->load->helper('url');
		$this->load->helper('http_error');
		$this->load->helper('language');
		$this->lang->load('auth');
		 
		// find nav data 
		
		$this->navdata['categories'] = $this-> navmodel->Get_Categories();
		if ($this->ion_auth->logged_in())
		{
			$this->navdata['user_options']=$this-> navmodel->Get_User_Options($this->ion_auth->user()->row()->id);
			if($this->ion_auth->is_admin())
			{
				$this->navdata['admin_options']=$this-> navmodel->Get_Admin_Options();
			}
			 
		} 

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
		$giatros=false;
		
		if($this->ion_auth->in_group(5)) $admin2=true;
		$can_edit_as_admin2=($admin2&&($this->config->item('admin2_can_edit_user_data')));

		if(!($admin2))
		{
			if($this->ion_auth->in_group(4)) $giatros=true;
		}
		if($giatros)
		{
			if($method=='edit')
			$same_id_passed=$this->auth_model_mine->Table_Id_of_user('giatroi',$this->ion_auth->user()->row()->id)==$params[0];
			else if($method=='edit_j')
			$same_id_passed=$this->auth_model_mine->Table_Id_of_user('giatroi',$this->ion_auth->user()->row()->id)==$this->request_json_data["id"];
		}
		$message=print_r(
			["admin2"=>$admin2,
			"giatros"=>$giatros,
			"can_edit_as_admin2"=>$can_edit_as_admin2,
			"same_id_passed"=>$same_id_passed,
			"wat"=>$this->config->item('admin2_can_edit_user_data'),
			"wat2"=> (true&&true)
			]

			,true );

		if($method=='edit'||$method=='edit_j')    		{$allow=$can_edit_as_admin2||$same_id_passed; }
		else if ($method=='item'||$method=='item_j')    {$allow=$admin2||$giatros;}//pos diavazeis to post edo?
		else 											{$allow= $admin2 ;}
	    
	        
       

		if(!$allow ) { show_error($message,401); return;}
		return call_user_func_array(array($this, $method), $params);
	}

	 
	public function index() 
	{
		 

	 

		$data['title'] = "Γιατροί" ;// Capitalize the first letter

		 
		 
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav', $this->navdata);
		$this->load->view('templates/redirect_message');

		$this->load->view('giatroi/index', $data);
		
		$this->load->view('templates/footer', $data);


	}
	function create()
	{
			$data['title'] = "Create farmakeio";
			 
			
			$this->load->view('templates/header', $data);
			$this->load->view('templates/nav', $this->navdata);
			$this->load->view('templates/redirect_message');
			$this->load->view('giatroi/create', $data);
			$this->load->view('templates/footer', $data);
    }

    public function edit( $id=0)
	{
	 
	 	 
		$data['title'] = "Επεξεργασία" ;// Capitalize the first letter
		
		$this->load->view('templates/header', $data);	
		$this->load->view('templates/nav',  $this->navdata);
		$this->load->view('templates/redirect_message');
		
		 
			 
		 
			$data['id']=$id;
			 
		
			 if($this->ion_auth->in_group(5))
				$this->load->view('giatroi/edit_a', $data);
				else
				$this->load->view('giatroi/edit_u', $data);
			$this->load->view('templates/footer', $data);

			 
		
		
	 

	}



    public function index_j() {
    	
    	 try{ 
			    $validator = new Json\Validator('json_schemata/giatroi/index_j.json');

				$validator->validate($this->request_json_data_obj);
			 	}
		 		catch (Exception $e) {
		    		show_error("Request didn't validate: ".$e->getMessage(),400);return;
				}

		$input_data = $this->request_json_data; 
	    

		$offset=$input_data["offset"];
		$pattern=$input_data["pattern"];
	 

		$result= $this-> giatroi_model ->Get($offset,$pattern);
		$count= $this-> giatroi_model ->Get_Count( $pattern);
		
		header('Content-Type: application/json');
		$this->output->set_status_header('200');
		echo json_encode( ["result"=>$result, "result_count"=>$count, "status"=>"ok", "offset"=>$offset] );


	}

	public function item_j( )
		{

			 
			//how about the xsrf
		 
		 	 try{ 
			    $validator = new Json\Validator('json_schemata/giatroi/item_j.json');

				$validator->validate($this->request_json_data_obj);
			 	}
		 		catch (Exception $e) {
		    		show_error("Request didn't validate: ".$e->getMessage(),400);return;
				}
			
			
			$input_data = $this->request_json_data;//json_decode(trim(file_get_contents('php://input')), true);
			$id=$input_data['id'];

		 
	    	header('Content-Type: application/json');
			 
			$result=$this-> giatroi_model->Get_Item($id);
			 
			echo json_encode( ["result"=>$result ]);

				 
			
			 

		}

	


	

	public function edit_j( )
	{

		//check incoming data
		//should you return errors for them
		//and handle them back at the browser????
		//how about the xsrf
	    //if(!class_exists("Validator")){show_error("den yparxei",500);}
	    
	    try{ 
	    $validator = new Json\Validator('json_schemata/giatroi/edit_j.json');

		$validator->validate($this->request_json_data_obj);
	 	}
 		catch (Exception $e) {
    		show_error("Request didn't validate: ".$e->getMessage(),400);return;
		}

		
		$input_data = $this->request_json_data;
		$id=$input_data['id'];
		$item=$input_data['item'];
		unset( $item['id'] );

		 

		
				 
	 	$this-> giatroi_model->Put_Item($id, $item);
		 
		$result=$this-> giatroi_model->Get_Item($id);
		header('Content-Type: application/json');

		$this->output->set_status_header('200');	 
		
		echo json_encode( $result );

			 
		
		 

	}

	 

	public function delete( $id=0)
	{
	 
	 
	
	$this-> giatroi_model->Delete($id);
	 
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
		
		 

	 
	
	$this-> giatroi_model->Delete($this->request_json_data["id"]);
	header('Content-Type: application/json');
	$this->output->set_status_header('200');
	echo json_encode( [ "status"=>"ok"] );
	


	}



    function  create_j()
	{


		 
		    $input_data = $this->request_json_data;



		     try{ 
			    $validator = new Json\Validator('json_schemata/giatroi/create_j.json');

				$validator->validate($this->request_json_data_obj);
			 	}
		 		catch (Exception $e) {
		    		show_error("Request didn't validate: ".$e->getMessage(),400);return;
				}

				//$other=Jsv4::validate($this->request_json_data_obj,
				// json_decode(file_get_contents('json_schemata/giatroi/create_j.json')));

			$user_email=$input_data["user_email"]; 
			

			 

			$is_user= $this->auth_model_mine->Is_User($user_email);
			$is_other_role= $this->auth_model_mine-> Is_In_Other_Than($user_email, "freipoe");
			$is_already=  $this->auth_model_mine-> Already_Giatros($user_email); 
			
		    $can_be = $is_user && !$is_other_role && !$is_already;
		    $id= -100000;
		    
		    if($can_be==true)
		    {
		    	$id= $this->auth_model_mine->Id_of_user($user_email);
		    	$this->ion_auth->remove_from_group(NULL,$id);
		    	$this->ion_auth->add_to_group(4, $id);
		    	$this->giatroi_model->Create($id);
		    }
           
			 $other=5;
			header('Content-Type: application/json');
			$this->output->set_status_header('200');
			echo json_encode( ["can_be"=>$can_be,
			 "is_user"=>$is_user, 
			 "is_other_role"=>$is_other_role, 
			 "is_already"=>$is_already, 
			 "status"=>"ok", 
			 "id"=> $id,
			 "other" =>$other] );

				 
	}
	
	 
	
	
	
}











