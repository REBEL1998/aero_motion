<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Myaccount extends Front_Controller {

	
	public function __construct()
	{
		parent::__construct();

		$this->data['pageTitle'] = 'Dashboard';
		

		$this->load->model('customer_model');
		$this->load->library('commonvar');
		
		$this->data['defCustType'] = 'SM';
		$this->data['defYesNo'] = 'N';
		$this->data['yesNo'] = $this->commonvar->yesno();
		$this->data['custType'] = $this->commonvar->getCustomerType();
		
		$this->data = array_merge($this->data,$this->userdata);
		
		
	}
	
	public function index()
	{
	
		$dataSet = $this->data;
		
		
		
		$this->display_template('myaccount', $dataSet);
	}
	
	function update(){
		
		$this->form_validation->set_rules('txtName', 'Name', 'trim|required');
		$this->form_validation->set_rules('txtPhone', 'Contact No.', 'trim|required');
		$this->form_validation->set_rules('txtCity', 'City', 'trim|required');
		$this->form_validation->set_rules('txtState', 'State', 'trim|required');
		$this->form_validation->set_rules('taAddress', 'Address', 'trim|required');
		$this->form_validation->set_rules('txtEmail', 'Email Address', 'trim|required');
		
        if ($this->form_validation->run() == TRUE) {
			
			$data = array(
        		'name' => $this->input->post('txtName'),
        		'contactno' => $this->input->post('txtPhone'),
        		'address' => $this->input->post('taAddress'),
        		'state' => $this->input->post('txtState'),
        		'city' => $this->input->post('txtCity'),
        		'email' => $this->input->post('txtEmail'),
        	);	
			if( !empty($this->input->post('txtPwd')) ) {
				$data['password'] = password_hash($this->input->post('txtPwd'), PASSWORD_DEFAULT);
			}
        		
			if ($this->customer_model->update_cutomer($data, LOGINID) ) {
				$this->session->set_flashdata('success', 'Profile updated successfully.');
				redirect('/' . $this->uri->segment(1), 'refresh');
			}
			else {
				$this->session->set_flashdata('error', 'Profile not updated successfully.');
				redirect('/' . $this->uri->segment(1), 'refresh');
			}
			
        }
        else {
			$this->session->set_flashdata('error', 'Something went wrong. Please try later.');
			redirect('/' . $this->uri->segment(1), 'refresh');
        }	
		
	}
}
