<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends Front_Controller {

	
	public function __construct()
	{
		parent::__construct();
		
		$this->data['pageTitle'] = 'Contact Us';
		
		$this->load->library('commonvar');
		$this->load->model('Contact_us_model', 'contact_us_model');
		
		$this->data['defCustType'] = 'SM';
		$this->data['defYesNo'] = 'N';
	}
	
	public function index()
	{
	
		$dataSet = $this->data;
		
		$action = $this->input->get('action', TRUE);
		
		##### ADD CONTACT INQUIRY DETAILS - START #####
		if ( $action == 'addInquiry') {
			
			$userName = $this->input->post('userName', TRUE);
			$phoneNumber = $this->input->post('phoneNumber', TRUE);
			$userEmail = $this->input->post('userEmail', TRUE);
			$subject = $this->input->post('subject', TRUE);
			$message = $this->input->post('message', TRUE);
			
			$arrParams = array(
				'contactname' => trim($userName),
				'email' => trim($userEmail),
				'phone' => trim($phoneNumber),
				'subject' => trim($subject),
				'message' => trim($message),
			);

			$flagSuccess = $this->contact_us_model->insertContactInquiry($arrParams);
			
			print($flagSuccess);
			exit;
		}
		##### ADD CONTACT INQUIRY DETAILS - START #####
		
		$this->display_template('contact-us', $dataSet);
	}
	
}
