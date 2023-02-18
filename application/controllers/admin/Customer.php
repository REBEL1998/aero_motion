<?php 

class Customer extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Customer';
		

		$this->load->model('admin/model_customer');
		$this->load->library('commonvar');
		
		
		$this->data['arrStatus'] = $this->commonvar->getCategoryStatus();
		$this->data['customerType'] = $this->commonvar->getCustomerType();
	
	}
	
	public function index($cust_id = NULL){
		$parent_cat_id = $this->atri->de($cust_id);
		$list_data = $this->model_customer->getCustomerList($parent_cat_id,true);

		$this->data['list_data'] = $list_data;

		$this->render_template('admin/customer/index', $this->data);
	}
	
	public function create()
	{

		$this->form_validation->set_rules('txtName', 'Name', 'trim|required');
		$this->form_validation->set_rules('txtEmail', 'Email', 'trim|required');
		$this->form_validation->set_rules('txtContactNo', 'Contact No', 'trim|required');
		$this->form_validation->set_rules('txtAddress', 'Address', 'trim|required');
		
		
	
        if ($this->form_validation->run() == TRUE) {
		
			$data = array(
        		'accounttype' => $this->input->post('txtaccounttype'),
        		'name' => $this->input->post('txtName'),
        		'email' => $this->input->post('txtEmail'),
        		'contactno' => $this->input->post('txtContactNo'),
        		'address' => $this->input->post('txtAddress'),
        		'status' => 'Y'
        	);

        	$create_id = $this->model_customer->create($data);

			if($create_id == true) {

        		$this->session->set_flashdata('success', 'Record created successfully.');
        		redirect('admin/customer/index/', 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('admin/customer/addedit', 'refresh');
        	}
        }
        else {
            // false case
			if($_SERVER['REQUEST_METHOD']=='POST'){
			  $this->session->set_flashdata('errors', 'Error occurred!!');
			}
            $this->data['doAction'] = 'Add';
            $this->data['txtName'] = isset($_REQUEST['txtName']) ? $_REQUEST['txtName'] : '';
            $this->data['txtEmail'] = isset($_REQUEST['txtEmail']) ? $_REQUEST['txtEmail'] : '';
            $this->data['txtAddress'] = isset($_REQUEST['txtAddress']) ? $_REQUEST['txtAddress'] : '';
            $this->data['txtContactNo'] = isset($_REQUEST['txtContactNo']) ? $_REQUEST['txtContactNo'] : '';
            $this->data['txtAccType'] = isset($_REQUEST['txtAccType']) ? $_REQUEST['txtAccType'] : '';
            $this->render_template('admin/customer/addedit', $this->data);
        }
	}


	public function edit($id = null)
	{
		if($id) {
			
			$id = $this->atri->de($id);
			$this->form_validation->set_rules('txtName', 'Name', 'trim|required');
			$this->form_validation->set_rules('txtEmail', 'Email', 'trim|required');
			$this->form_validation->set_rules('txtContactNo', 'Contact No', 'trim|required');
			$this->form_validation->set_rules('txtAddress', 'Address', 'trim|required');
			
			
			$list_data = $this->model_customer->getCustomerList($id);
			
		
			if ($this->form_validation->run() == TRUE) {
	            
				$data = array(
					'accounttype' => $this->input->post('txtaccounttype'),
					'name' => $this->input->post('txtName'),
					'email' => $this->input->post('txtEmail'),
					'contactno' => $this->input->post('txtContactNo'),
					'address' => $this->input->post('txtAddress'),
					'status' => 'Y'
				);

				$update = $this->model_customer->edit($data, $id);
				
				if($update == true) {
					$this->session->set_flashdata('success', 'Record updated successfully.');
					redirect('admin/customer/', 'refresh');
				}
				else {
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('admin/customer/edit/', 'refresh');
				}
			
	        }
	        else {
				$this->data['doAction'] = 'Edit';
	            
				$result = $this->model_customer->getCustomerList($id);

	        	$this->data['txtName'] = $result[0]['name'];
	        	$this->data['txtEmail'] = $result[0]['email'];
	        	$this->data['txtContactNo'] = $result[0]['contactno'];
	        	$this->data['txtAddress'] = $result[0]['address'];
	        	$this->data['txtAccType'] = $result[0]['accounttype'];
	        	

				$this->render_template('admin/customer/addedit', $this->data);	
	        }	
		}	
	}

	public function delete($id)
	{
		if($id) {

			$catid = $id;
		
			$delete = $this->model_customer->delete($this->atri->de($catid));
		
			if($delete == true) {
				$this->session->set_flashdata('success', 'Record removed successfully.');
			}
			else {
				$this->session->set_flashdata('error', 'Error occurred!!');
			}
		
			
			redirect('admin/customer/', 'refresh');
		}
	}
	
	
	public function status($id)
	{
		if($id) {
			$delete = $this->model_customer->changeStatus($this->atri->de($id));
			if($delete == true) {
				$this->session->set_flashdata('success', 'Status updated successfully.');
			}
			else {
				$this->session->set_flashdata('error', 'Error occurred!!');
			}
			
			redirect('admin/customer/', 'refresh');

		}
	}
	
	
};