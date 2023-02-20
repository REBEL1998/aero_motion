<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Company_profile extends Front_Controller {

	public function __construct()
	{
		parent::__construct();
		
		$this->data['pageTitle'] = 'Company Profile';
		
		$this->load->library('commonvar');
	}
	
	public function index()
	{
	
		$dataSet = $this->data;
		
		$this->display_template('company-profile', $dataSet);
	}
	
}
