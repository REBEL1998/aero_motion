<?php 

class Contactus extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Contact Us Page';
		
		$this->load->library('commonvar');
		$this->load->model('Contact_us_model', 'contact_us_model');
		
		$this->data['arrStatus'] = $this->commonvar->getCategoryStatus();
		$this->data['arrCompanyStatus'] = $this->commonvar->companyStatus();
		$this->data['arrTechWorkType'] = $this->commonvar->getTechnicianWorkingType();
	
	}
	
	public function index($cat_id = NULL){
		
		// get contact us details  
		$arrData = array("SORTBY" => "DTD");
		$arrContactDetails = $this->contact_us_model->getContactInquiryDetails($arrData);

		$this->data['list_data'] = $arrContactDetails;

		$this->render_template('admin/contactus/index', $this->data);
	}
	
	
	public function delete($id)
	{
		if($id) {
			
			$delete = $this->contact_us_model->delete($this->atri->de($id));
		
			if($delete == true) {
				$this->session->set_flashdata('success', 'Record removed successfully.');
			}
			else {
				$this->session->set_flashdata('error', 'Error occurred!!');
			}
	
			redirect('admin/contactus/', 'refresh');
		}
	}
	
	
};