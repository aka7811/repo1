<?php

class Pages extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model('task_model');
		$this->load->model('navmodel');
		$this->load->library('ion_auth');
		$this->load->library('form_validation');
		$this->load->helper('url');
		$this->load->helper('language');
		$this->lang->load('auth');
		
		$this->navdata['categories'] = $this-> navmodel->Get_Categories();
		if ($this->ion_auth->logged_in())
		{
			$this->navdata['user_options']=$this-> navmodel->Get_User_Options($this->ion_auth->user()->row()->id);
			if($this->ion_auth->is_admin())
			{
				$this->navdata['admin_options']=$this-> navmodel->Get_Admin_Options();
			}
			 
		} 
		 
		$this->message_array=[];
		if($this->session->flashdata('message_var'))
		$this->message_array=["message_var"=>$this->session->flashdata('message_var') ];
		
		 
	}

	 
	public function index( )
	{
	 
	$data['title'] = "PAOK EISAI" ;// Capitalize the first letter
	$data['tasks'] = $this-> task_model->Get_Data();
	//$navdata['categories'] = $this-> navmodel->Get_Categories();
	
	$this->load->view('templates/header', $data);
	$this->load->view('templates/nav', array_merge($this->navdata,$this->message_array ));
	$this->load->view('pages/deixe', $data);
	$this->load->view('templates/footer', $data);


	}
	
	public function bycat($category=null)
	{
	 
	$data['title'] = "PAOK EISAI" ;// Capitalize the first letter
	$data['tasks'] = $this-> task_model->Get_Data_Cat($category);
	//$navdata['categories'] = $this-> navmodel->Get_Categories();
	$this->load->view('templates/header', $data);
	$this->load->view('templates/nav', $this->navdata);
	$this->load->view('pages/deixe', $data);
	$this->load->view('templates/footer', $data);


	}
	
	
	public function create( )
	{
	 $this->load->helper('form');
	 $this->load->library('form_validation');
	 $this->load->helper('url');
	 $this->form_validation->set_error_delimiters('<div class="form-group has-error"><label class="control-label">', '</label></div>');
	 $this->form_validation->set_message('required', 'Απαιτείται το πεδίο: %s');
	 $this->form_validation->set_rules('title', 'guki', 'required');
	$this->form_validation->set_rules('text', 'gui', 'required');
	$this->form_validation->set_rules('category', 'fuy', 'required');
	
	$data['title'] = "Δημιουργία" ;// Capitalize the first letter
	$data['tasks'] = $this-> task_model->Get_Data();
	$data['categories'] = $this-> task_model-> Get_Cat();
	//$navdata['categories'] = $this-> navmodel->Get_Categories();
	$this->load->view('templates/header', $data);
	$this->load->view('templates/nav', $this->navdata);
	
	if ($this->form_validation->run() === FALSE)
	{
	$this->load->view('pages/input-task', $data);
	}
	else
	{
	$slug = url_title($this->input->post('title'), 'dash', TRUE);

	$new_task = array(
		'title' => $this->input->post('title'),
		'text' => $this->input->post('text'),
		'slug' => $slug,
		'katigoria' => $this->input->post('category')
	);
	$this-> task_model->New_Task($new_task);
	$this->load->view('pages/success');
	}
	
	$this->load->view('templates/footer', $data);


	}
	
	public function task($slug)
	{
	 
	$data['title'] = "PAOK EISAI" ;// Capitalize the first letter
	$data['task'] = $this-> task_model->Get_Task_By_Slag($slug);
	//$navdata['categories'] = $this-> navmodel->Get_Categories();
	$this->load->view('templates/header', $data);
	$this->load->view('templates/nav', $this->navdata);
	$this->load->view('pages/task/show-task', $data);
	$this->load->view('templates/footer', $data);


	}
	
	public function delete_task($id)
	{
	$data['title'] = "guifuy" ;// Capitalize the first letter
	 $this-> task_model->Delete_Task($id);
	//$navdata['categories'] = $this-> navmodel->Get_Categories();
	$this->load->view('templates/header', $data);
	$this->load->view('templates/nav', $this->navdata);
	$this->load->view('pages/success');
	$this->load->view('templates/footer', $data);

	}
	
	
	
}











