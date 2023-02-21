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
		$this->load->model('admin/model_attched');
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
			
			$getSpecificationName = $this->input->post('txtSpecificationName');
			$getSpecificationValue = $this->input->post('txtSpecificationValue');
			$arrSpecification = [];
			
			foreach($getSpecificationName as $key => $value){
				if(!empty($getSpecificationName[$key])){
					$arrSpecification[$getSpecificationName[$key]] = $getSpecificationValue[$key];
				}
			}
			
			
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
				'specification' => json_encode($arrSpecification,true),
        		'flagstatus' => 'Y',
				'dateadded' => UTCDATETIME,
        	);
        	$create_id = $this->model_product->create($data);
 
			if($create_id == true) {
				
				if ( !empty($_FILES["productImage"]['name']) ) {

					$new_name = 'product_img_'.$create_id . '_' .$_FILES["productImage"]['name'];
					
					$config['upload_path']          = './assets/admin/uploads/product';
					$config['allowed_types']        = 'jpg|png|jpeg|';
					$config['max_size']             = 10000;
					$config['file_name']            = $new_name;
					/* $config['max_width']            = 1024;
					$config['max_height']           = 768; */
					
					$this->load->library('upload', $config);
					
					if (!$this->upload->do_upload('productImage'))
					{
						$error = array('error' => $this->upload->display_errors());
						
						redirect('admin/product/addedit', 'refresh');
					}
					else
					{
							
						$data = array('productImage' => $this->upload->data());

						/* Now update image name in category table */
						$result = $this->model_product->updateProductImageName($create_id,$data["productImage"]["file_name"]);
						
						//redirect('admin/category', $data);
					}
				}
	   			    
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
				
				
				$getSpecificationName = $this->input->post('txtSpecificationName');
				$getSpecificationValue = $this->input->post('txtSpecificationValue');
				$arrSpecification = [];
				
				foreach($getSpecificationName as $key => $value){
					if(!empty($getSpecificationName[$key])){
						$arrSpecification[$getSpecificationName[$key]] = $getSpecificationValue[$key];
					}
				}
				
				$data = array(
					'catid' => $this->input->post('catId'),
					'name' => $this->input->post('txtName'),
					'title' => $this->input->post('txtTitle'),
					'desc' => $this->input->post('txtShortDesc'),
					'specification' => json_encode($arrSpecification,true),
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
				
				if (!empty($_FILES['productImage']['name'])){
					$new_name = 'product_img_'.$id . '_' .$_FILES["productImage"]['name'];
		
					$config['upload_path']          = './assets/admin/uploads/product/';
					$config['allowed_types']        = 'jpeg|jpg|png';
					$config['max_size']             = 10000;
					$config['file_name']            = $new_name;
					/* $config['max_width']            = 1024;
					$config['max_height']           = 768; */

					$this->load->library('upload', $config);

					if (!$this->upload->do_upload('productImage'))
					{
							$error = array('error' => $this->upload->display_errors());
							redirect('admin/product/addedit', 'refresh');
					}
					else
					{
							$data = array('productImage' => $this->upload->data());

							/* Now update image name in category table */
							$result = $this->model_product->updateProductImageName($id,$data["productImage"]["file_name"]);

							//redirect('admin/category', $data);
					}		
					
				}
				
				
				
				if($update == true) {
					$this->session->set_flashdata('success', 'Record updated successfully.');
					redirect('admin/product/'.$url, 'refresh');
				}
				else {
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('admin/product/addedit/'.$id, 'refresh');
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
	        	$this->data['prodId'] = $list_data[0]['prodId'];
	        	$this->data['jsonSpecification'] = $list_data[0]['specification'];
	        	$this->data['productImage'] = $list_data[0]['productImage'];
	        	$this->data['arrCategory'] = $cat_data;
				$this->render_template('admin/product/addedit', $this->data);	
	        }	
		}	
	}

	public function delete($id)
	{
		if($id) {				
			$delete = $this->model_product->delete($this->atri->de($id));
		
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
			
			redirect('admin/product/'.$url, 'refresh');
		}
	}
	
	
	public function attched($id = '')
	{
		$id = !empty($this->input->get('propertyId')) ? $this->atri->de($this->input->get('propertyId')) : $this->atri->de($id);
	
		if (!empty($this->input->get('propertyId'))) {
			
			if (!empty($_FILES['file'])){
				// for($i = 0; $i<$count ; $i++){
					if (!empty($_FILES['file']['name'])){
						$new_name = 'product_img_'.$id. '_' .$_FILES["file"]['name'];
			
						$config['upload_path']          = './assets/admin/uploads/product/';
						$config['allowed_types']        = 'jpeg|jpg|png|pdf|doc';
						$config['max_size']             = 10000;
						$config['file_name']            = $new_name;
						/* $config['max_width']            = 1024;
						$config['max_height']           = 768; */
						$isImage = str_contains( $_FILES['file']['type'], 'image') ? true : false;
						
						$this->load->library('upload', $config);
						if (!$this->upload->do_upload('file'))
						{
								$error = array('error' => $this->upload->display_errors());
								echo $error;
								// redirect('admin/product/addedit', 'refresh');
						}
						else
						{
								$data = array(
									'relatedid' => $id,
									'typex' =>$isImage ? 'IMG' : 'DOC',
									'parentcode' => 'PR',
									'code' => 'PR',
									'filename' => $new_name,
									'categoryid' => 0,
									'shortdesc' => $isImage ? 'Image Upload'.$new_name : "This is doc",
									'desc' =>$isImage ? 'Image Upload'.$new_name : "This is doc",
									'addedby' => 1,
									'dateadded' => UTCDATETIME
								);

								/* Now update image name in category table */
								$result = $this->model_attched->insertAttchedFile($data);
								$flagAttched[] = true;

								//redirect('admin/category', $data);
						}
					}				
				
			}
			// if($count == count($flagAttched)) {
				$this->session->set_flashdata('success', 'Record updated successfully.');
				echo "done";
				// redirect('admin/fileUpload/'.$this->atri->en($id), 'refresh');
			// }
			// else {
				// $this->session->set_flashdata('errors', 'Error occurred!!');
				// redirect('admin/fileUpload/'.$this->atri->en($id), 'refresh');
			// }
		
		}
		else {
			$this->data['doAction'] = 'Edit';
			$list_data = $this->model_attched->getAttchedList($id);
	
			$this->data['prodId'] = $id;
			$this->data['list_data'] = $list_data;
			$this->render_template('admin/fileUpload/index', $this->data);	
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
			$delete = $this->model_product->deleteProductImage($this->atri->de($id));
		
			if($delete == true) {
				$this->session->set_flashdata('success', 'Status updated successfully.');
			}
			else {
				$this->session->set_flashdata('error', 'Error occurred!!');
			}
			redirect('admin/product/edit/'.$id, 'refresh');

		}
	}
	
	
	public function deleteAttchedImage($id)
	{
		if($id) {
			$delete = $this->model_attched->deleteAttchedImage($this->atri->de($id));
		
			if($delete == true) {
				$this->session->set_flashdata('success', 'Status updated successfully.');
			}
			else {
				$this->session->set_flashdata('error', 'Error occurred!!');
			}
			redirect('admin/product/attched/'.$this->atri->en($delete), 'refresh');

		}
	}
};