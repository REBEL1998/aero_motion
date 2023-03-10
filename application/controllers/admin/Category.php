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

				if ( !empty($_FILES["categoryImage"]['name']) ) {

					$new_name = 'category_img_'.$create_id . '_' .$_FILES["categoryImage"]['name'];
					
					$config['upload_path']          = './assets/uploads/category';
					$config['allowed_types']        = 'jpg|png|jpeg|';
					$config['max_size']             = 10000;
					$config['file_name']            = $new_name;
					/* $config['max_width']            = 1024;
					$config['max_height']           = 768; */

					$this->load->library('upload', $config);

					if (!$this->upload->do_upload('categoryImage'))
					{
						$error = array('error' => $this->upload->display_errors());
						redirect('admin/category/addedit', 'refresh');
					}
					else
					{	
						$data = array('categoryImage' => $this->upload->data());
						/* Now update image name in category table */
						$result = $this->model_category->updateCategoryImageName( $create_id, $data["categoryImage"]["file_name"]);
					}
				}
					
	   			    
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


				if ( !empty($_FILES['categoryImage']['name']) ){
					$new_name = 'category_img_'.$id . '_' .$_FILES["categoryImage"]['name'];
		
					$config['upload_path']          = './assets/uploads/category/';
					$config['allowed_types']        = 'jpeg|jpg|png';
					$config['max_size']             = 10000;
					$config['file_name']            = $new_name;
					/* $config['max_width']            = 1024;
					$config['max_height']           = 768; */

					$this->load->library('upload', $config);

					if (!$this->upload->do_upload('categoryImage'))
					{
							$error = array('error' => $this->upload->display_errors());
							redirect('admin/category/edit/'.$id, 'refresh');
					}
					else
					{
							$data = array('categoryImage' => $this->upload->data());

							/* Now update image name in category table */
							$result = $this->model_category->updateCategoryImageName($id,$data["categoryImage"]["file_name"]);

							//redirect('admin/category', $data);
					}		
					
				}

				
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
		
	        	$this->data['catId'] = $id;
	        	$this->data['txtName'] = $result[0]['name'];
	        	$this->data['txtShortDesc'] = $result[0]['desc'];
				$this->data['categoryImage'] = $result[0]['imagename'];

				$this->render_template('admin/category/addedit', $this->data);	
	        }	
		}	
	}

	public function delete($id)
	{
		if($id) {

			/* First check for subcategory is present or not */
			$catid = $this->atri->de($id);
		
			$delete = $this->model_category->delete($catid);
	
			if($delete == true) {
				$this->session->set_flashdata('success', 'Record removed successfully.');
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