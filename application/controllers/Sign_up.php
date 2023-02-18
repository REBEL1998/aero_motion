<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sign_up extends Front_Controller {

	
	public function __construct()
	{
		parent::__construct();

		$this->data['pageTitle'] = 'Sign Up';
		

		$this->load->model('customer_model');
		$this->load->library('commonvar');
		
		$this->data['defCustType'] = 'SM';
		$this->data['defYesNo'] = 'N';
		$this->data['yesNo'] = $this->commonvar->yesno();
		$this->data['custType'] = $this->commonvar->getCustomerType();
	}
	
	public function index()
	{
	
		$input_data = $this->session->flashdata('input_data');
		if( !is_array($input_data) ) {
			$input_data = array();
		}
		
		$dataSet = array_merge($input_data,$this->data);
		$dataSet['pageTitle'] = "Sign Up";
		
		
		$this->display_template('sign-up', $dataSet);
	}
	
	public function send_otp()
	{
		$this->load->library('mailhandler');
		$email = $this->input->get('txtEmail');
		
		$result = 0;
		$otp  = rand(1000,9999);
		
		if ( $this->customer_model->insert_otp(array('email' => $email, 'otp' => $otp)) ) {
			
			$params = array(
					'toEmail' => $email,
					'OTP' => $otp
			);
			$this->mailhandler->send($params,'EMOTP');
			$result = 1;
		}
		else {
			$result = 0;
		}
		print $result;
		exit;
	}
	
	function register(){
		
		$this->form_validation->set_rules('txtName', 'Name', 'trim|required');
		$this->form_validation->set_rules('txtPhone', 'Contact No.', 'trim|required');
		$this->form_validation->set_rules('txtCity', 'City', 'trim|required');
		$this->form_validation->set_rules('txtState', 'State', 'trim|required');
		$this->form_validation->set_rules('taAddress', 'Address', 'trim|required');
		// $this->form_validation->set_rules('txtCName', 'Company Name', 'trim|required');
		$this->form_validation->set_rules('txtEmail', 'Email Address', 'trim|required');
		$this->form_validation->set_rules('txtEmailOTP', 'OTP', 'trim|required');
		$this->form_validation->set_rules('txtPwd', 'Password', 'trim|required');
		$this->form_validation->set_rules('txtCPwd', 'Confirm Password', 'trim|required|matches[txtPwd]');
		

        if ($this->form_validation->run() == TRUE) {
			
			
			$validateOTP = $this->customer_model->validate_otp(array('email' => $this->input->post('txtEmail'), 'otp' => $this->input->post('txtEmailOTP')));
			if( !$validateOTP ) {
				$this->session->set_flashdata('error', 'Invalid OTP. Please try again.');
				$this->session->set_flashdata('input_data', $this->input->post());
        		redirect('/' . $this->uri->segment(1), 'refresh');
			}
			
			$cnt = $this->customer_model->get_users(array('EMAIL' => $this->input->post('txtEmail'), 'flagCount' => true));
			if( $cnt > 0 ) {
				$this->session->set_flashdata('error', 'This email address is already registered with us. Please try another.');
				$this->session->set_flashdata('input_data', $this->input->post());
        		redirect('/' . $this->uri->segment(1), 'refresh');
			}
            // true case
			$data = array(
        		'accounttype' => (array_key_exists($this->input->post('rdAccountType'),$this->data['custType']) ? $this->input->post('rdAccountType') : $this->data['defCustType']),
        		'name' => $this->input->post('txtName'),
        		'contactno' => $this->input->post('txtPhone'),
        		'address' => $this->input->post('taAddress'),
        		'state' => $this->input->post('txtState'),
        		'city' => $this->input->post('txtCity'),
        		// 'companyname' => $this->input->post('txtCName'),
        		'email' => $this->input->post('txtEmail'),
        		'password' => password_hash($this->input->post('txtPwd'), PASSWORD_DEFAULT),
        		// 'gstn' => $this->input->post('txtGSTN'),
        		// 'workingsince' => $this->input->post('txtWorkSince'),
        		// 'industrytype' => $this->input->post('txtIndType'),
        		// 'prodmanufactured' => $this->input->post('txtPdManf'),
        		// 'ouostateorder' => (array_key_exists($this->input->post('rdOutStateOrder'),$this->data['yesNo']) ? $this->input->post('rdOutStateOrder') : $this->data['defYesNo']),
        		// 'oldmachinads' => (array_key_exists($this->input->post('rdAds'),$this->data['yesNo']) ? $this->input->post('rdAds') : $this->data['defYesNo'])
        	);

        	$create = $this->customer_model->create($data);
        	if($create == true ) {
        		$this->session->set_flashdata('success', 'You are registered successfully.');
        		// redirect('/' . $this->uri->segment(1), 'refresh');
				redirect('/myaccount', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('error', 'Something went wrong. Please try later.');
				$this->session->set_flashdata('input_data', $this->input->post());
        		redirect('/' . $this->uri->segment(1), 'refresh');
        	}
        }
        else {
            // false case
			if($_SERVER['REQUEST_METHOD']=='POST'){
			  $this->session->set_flashdata('errors', 'Error occurred!!');
			}
			$this->session->set_flashdata('input_data', $this->input->post());
            redirect('/' . $this->uri->segment(1), 'refresh');
        }			
	}
}
