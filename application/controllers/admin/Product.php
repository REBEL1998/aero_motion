<?php 

class Product extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Product';
		

		$this->load->model('admin/model_product');
		$this->load->model('admin/model_category');
		$this->load->library('commonvar');
		
		
		$this->data['arrStatus'] = $this->commonvar->getCategoryStatus();
	
	}
	
	public function index($prod_id = NULL){
		$parent_prod_id = $this->atri->de($prod_id);
		$list_data = $this->model_product->getProductList($parent_prod_id);
       
		$this->data['list_data'] = $list_data;

		$this->render_template('admin/product/index', $this->data);
	}
	
	public function create()
	{
		$cat_data = $this->model_category->getCategoryList();
	
		$this->form_validation->set_rules('catId', 'Name', 'trim|required');
	
        if ($this->form_validation->run() == TRUE) {
            // true case
			
			if($this->atri->de($this->input->post('hdnparentcatid')) == null){
				$level = 1;
			}
			else {
				$level = 2;
			}
			
			$data = array(
        		'catid' => $this->input->post('catId'),
        		'name' => $this->input->post('txtName'),
        		'title' => $this->input->post('txtTitle'),
        		'desc' => $this->input->post('txtShortDesc'),
        		'flagstatus' => 'Y',
				'dateadded' => UTCDATETIME,
        	);
        	$create_id = $this->model_product->create($data);
 
			if($create_id == true) {
	   			    
				$url = '';
				if($this->uri->segment('4') !== null && $this->uri->segment('5') == null){
					$url = $this->uri->segment('4') ;
				}
				
        		$this->session->set_flashdata('success', 'Product created successfully.');
        		redirect('admin/product/index/'.$url, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('admin/product/addedit', 'refresh');
        	}
        }
        else {
            // false case
			if($_SERVER['REQUEST_METHOD']=='POST'){
			  $this->session->set_flashdata('errors', 'Error occurred!!');
			}
			// var_dump($cat_data);
			// die();
            $this->data['doAction'] = 'Add';
            $this->data['txtTitle'] = '';
            $this->data['arrCategory'] = $cat_data;
            $this->data['txtName'] = isset($_REQUEST['txtName']) ? $_REQUEST['txtName'] : '';
            $this->data['txtTitle'] = isset($_REQUEST['txtTitle']) ? $_REQUEST['txtTitle'] : '';
            $this->data['txtShortDesc'] = isset($_REQUEST['txtShortDesc']) ? $_REQUEST['txtShortDesc'] : '';
            $this->render_template('admin/product/addedit', $this->data);
        }
	}


	public function edit($id = null)
	{
		if($id) {
			$id = $this->atri->de($id);
			$this->form_validation->set_rules('catId', 'Name', 'trim|required');
			
			if ($this->form_validation->run() == TRUE) {
	            
				$urlKey = preg_replace('/[^a-zA-Z0-9_.]/', '_', $this->input->post('txtName')) . '_' . $id;
				
				$data = array(
					'catid' => $this->input->post('catId'),
					'name' => $this->input->post('txtName'),
					'title' => $this->input->post('txtTitle'),
					'desc' => $this->input->post('txtShortDesc'),
					'flagstatus' => 'Y',
					'dateupdate' => UTCDATETIME,
				);

				/* 
				Now we are setting categoryid in url to get sub product view if it is present
				*/
				$url = '';
				
				if($this->uri->segment('4') !== null && $this->uri->segment('5') !== null){
					$url = 'index/'.$this->uri->segment('5');
				}

				$update = $this->model_product->edit($data, $id);
				
				if($update == true) {
					$this->session->set_flashdata('success', 'Record updated successfully.');
					redirect('admin/product/'.$url, 'refresh');
				}
				else {
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('admin/product/edit/'.$id, 'refresh');
				}
			
	        }
	        else {
				$this->data['doAction'] = 'Edit';
				$cat_data = $this->model_category->getCategoryList();
				$list_data = $this->model_product->getProductList($id);
	        	$this->data['txtName'] = $list_data[0]['prodName'];
	        	$this->data['txtTitle'] = $list_data[0]['prodTitle'];
	        	$this->data['txtShortDesc'] = $list_data[0]['prodDesc'];
	        	$this->data['selectedCatId'] = $list_data[0]['catId'];
	        	$this->data['arrCategory'] = $cat_data;

				$this->render_template('admin/product/addedit', $this->data);	
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
			$delete = $this->model_product->changeStatus($this->atri->de($id));
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
			
			redirect('admin/product/'.$url, 'refresh');

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