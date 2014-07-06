<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Welcome extends CI_Controller {



		
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
		
		 
 
		
		
	 
		
		 
	}







	/**
	 * Index Page for this controller.
	 *
	 * Maps to the following URL
	 * 		http://example.com/index.php/welcome
	 *	- or -  
	 * 		http://example.com/index.php/welcome/index
	 *	- or -
	 * Since this controller is set as the default controller in 
	 * config/routes.php, it's displayed at http://example.com/
	 *
	 * So any other public methods not prefixed with an underscore will
	 * map to /index.php/welcome/<method_name>
	 * @see http://codeigniter.com/user_guide/general/urls.html
	 */
	public function index()
	{

		$data['title'] = "Κεντρική" ;// Capitalize the first letter

		 
		 
		
		$this->load->view('templates/header', $data);
		$this->load->view('templates/nav' );
		$this->load->view('templates/redirect_message');

		$this->load->view('welcome_message');
		
		$this->load->view('templates/footer', $data);

		
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */