<?php 

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();

		$this->load->model('Contact_us_model', 'contact_us_model');
		$this->data['page_title'] = 'Dashboard';
	}

	public function index()
	{

		// get contact us details  
		$arrData = array("SORTBY" => "DTD");
		$this->data['arrContactDetails'] = $this->contact_us_model->getContactInquiryDetails($arrData);

		$this->render_template('admin/dashboard/index', $this->data);
	}
	
}