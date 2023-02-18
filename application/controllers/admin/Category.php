<?php 

class Category extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Category';
		

		$this->load->model('admin/model_category');
		$this->load->library('commonvar');
		
		
		$this->data['arrStatus'] = $this->commonvar->getCategoryStatus();
	
	}
	
	public function index($cat_id = NULL){
		$parent_cat_id = $this->atri->de($cat_id);
		$list_data = $this->model_category->getCategoryList($parent_cat_id,true);

		$this->data['list_data'] = $list_data;

		$this->render_template('admin/category/index', $this->data);
	}
	
	public function create()
	{

		$this->form_validation->set_rules('txtName', 'Name', 'trim|required');
		
        if ($this->form_validation->run() == TRUE) {
            // true case
			
			if($this->atri->de($this->input->post('hdnparentcatid')) == null){
				$level = 1;
			}
			else {
				$level = 2;
			}
			
			$data = array(
        		'name' => $this->input->post('txtName'),
        		'desc' => $this->input->post('txtShortDesc'),
        		'status' => 'Y',
        		'url_key' => '',
        	);

			
        	$create_id = $this->model_category->create($data);
 
			if($create_id == true) {
	   			    
				$url = '';
				if($this->uri->segment('4') !== null && $this->uri->segment('5') == null){
					$url = $this->uri->segment('4') ;
				}
				
        		$this->session->set_flashdata('success', 'Record created successfully.');
        		redirect('admin/category/index/'.$url, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('admin/category/addedit', 'refresh');
        	}
        }
        else {
            // false case
			if($_SERVER['REQUEST_METHOD']=='POST'){
			  $this->session->set_flashdata('errors', 'Error occurred!!');
			}
            $this->data['doAction'] = 'Add';
            $this->data['txtName'] = isset($_REQUEST['txtName']) ? $_REQUEST['txtName'] : '';
            $this->data['txtShortDesc'] = isset($_REQUEST['txtShortDesc']) ? $_REQUEST['txtShortDesc'] : '';
            $this->render_template('admin/category/addedit', $this->data);
        }
	}


	public function edit($id = null)
	{
		if($id) {
			$id = $this->atri->de($id);
			$this->form_validation->set_rules('txtName', 'Name', 'trim|required');
			
			$list_data = $this->model_category->getCategoryList($id);
			
			if ($this->form_validation->run() == TRUE) {
	            
				$urlKey = preg_replace('/[^a-zA-Z0-9_.]/', '_', $this->input->post('txtName')) . '_' . $id;
				
				$data = array(
					'name' => $this->input->post('txtName'),
					'desc' => $this->input->post('txtShortDesc'),
					'url_key' => strtolower($urlKey)
				);

				/* 
				Now we are setting categoryid in url to get sub category view if it is present
				*/
				$url = '';
				
				if($this->uri->segment('4') !== null && $this->uri->segment('5') !== null){
					$url = 'index/'.$this->uri->segment('5');
				}

				$update = $this->model_category->edit($data, $id);
				
				if($update == true) {
					$this->session->set_flashdata('success', 'Record updated successfully.');
					redirect('admin/category/'.$url, 'refresh');
				}
				else {
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('admin/category/edit/'.$id, 'refresh');
				}
			
	        }
	        else {
				$this->data['doAction'] = 'Edit';
	            
				$result = $this->model_category->getCategoryList($id);
				
	        	$this->data['txtName'] = $result[0]['name'];
	        	$this->data['txtShortDesc'] = $result[0]['desc'];

				$this->render_template('admin/category/addedit', $this->data);	
	        }	
		}	
	}

	public function delete($id)
	{
		if($id) {

			$catid = $id;
			/* First check for subcategory is present or not */
			$cat_cnt = $this->model_category->getSubCategoryCount($this->atri->de($id));
			
			if($cat_cnt == 0){
				
				$delete = $this->model_category->delete($this->atri->de($catid));
			
				if($delete == true) {
					$this->session->set_flashdata('success', 'Record removed successfully.');
				}
				else {
					$this->session->set_flashdata('error', 'Error occurred!!');
				}
			}
			else {
				$this->session->set_flashdata('error', 'Sub category is present. Please delete all subcategory first.');
			}
			
			$url = '';
			if($this->uri->segment('5') !== null){
				$url = '/index/'. $this->uri->segment('5');
			}
			
			redirect('admin/category/'.$url, 'refresh');
		}
	}
	
	
	public function status($id)
	{
		if($id) {
			$delete = $this->model_category->changeStatus($this->atri->de($id));
			if($delete == true) {
				$this->session->set_flashdata('success', 'Status updated successfully.');
			}
			else {
				$this->session->set_flashdata('error', 'Error occurred!!');
			}
			
			$url = '';
			if($this->uri->segment('5') !== null){
				$url = '/index/'. $this->uri->segment('5');
			}
			
			redirect('admin/category/'.$url, 'refresh');

		}
	}
	
	public function deleteimage($id)
	{
		if($id) {
			$delete = $this->model_category->deleteCategoryImage($this->atri->de($id));
			if($delete == true) {
				$this->session->set_flashdata('success', 'Status updated successfully.');
			}
			else {
				$this->session->set_flashdata('error', 'Error occurred!!');
			}
			
			$url = '';
			if($this->uri->segment('5') !== null){
				$url = '/index/'. $this->uri->segment('4');
			}
			redirect('admin/category/edit/'.$id, 'refresh');

		}
	}
};