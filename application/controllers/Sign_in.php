<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sign_in extends Front_Controller {

	
	public function __construct()
	{
		parent::__construct();

		$this->data['pageTitle'] = 'Sign In';
		

		$this->load->model('customer_model');
		$this->load->library('commonvar');
		
		$this->data['defCustType'] = 'SM';
		$this->data['defYesNo'] = 'N';
		$this->data['yesNo'] = $this->commonvar->yesno();
		$this->data['custType'] = $this->commonvar->getCustomerType();
	}
	
	public function index()
	{
	
		$dataSet = $this->data;
		$this->display_template('sign-in', $dataSet);
	}
	
	public function logout()
	{
		$this->session->unset_userdata('login_id');
		redirect('/sign-in', 'refresh');
	}
	
	function login(){
		
		$this->form_validation->set_rules('txtEmail', 'Email Address', 'trim|required');
		$this->form_validation->set_rules('txtPwd', 'Password', 'trim|required');
		
        if ($this->form_validation->run() == TRUE) {
			
			$data = array(
        		'email' => $this->input->post('txtEmail'),
        		'password' => $this->input->post('txtPwd')
			);

			if ($this->customer_model->login($data) ) {
				redirect('/myaccount', 'refresh');
			}
			else {
				$this->session->set_flashdata('error', 'Invalid Email Address or Password.');
				redirect('/' . $this->uri->segment(1), 'refresh');
			}
			
        }
        else {
			$this->session->set_flashdata('error', 'Something went wrong. Please try later.');
			redirect('/' . $this->uri->segment(1), 'refresh');
        }	
		
	}
}
