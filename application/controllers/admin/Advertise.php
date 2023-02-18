<?php 

class Advertise extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Advertise';
		

		$this->load->model('admin/model_advertise');
		$this->load->library('commonvar');
		
		
		$this->data['arrStatus'] = $this->commonvar->getCategoryStatus();
		$this->data['arrAdvertiseType'] = $this->commonvar->getAdvertiseType();
	
	}
	
	public function index($cat_id = NULL){
		
		$arrParams = array();
		$list_data = $this->model_advertise->getAdvertiseList($arrParams);

		$this->data['list_data'] = $list_data;

		$this->render_template('admin/advertise/index', $this->data);
	}
	
	public function create()
	{
		$this->form_validation->set_rules('txtTitle', 'Title', 'trim|required');
		$this->form_validation->set_rules('txtUrl', 'Url', 'trim|required');

		if (empty($_FILES['categoryImage']['name'])){
			$this->form_validation->set_rules('categoryImage', 'Image', 'required');
		}
		
        if ($this->form_validation->run() == TRUE) {
           
			$data = array(
        		'title' => $this->input->post('txtTitle'),
        		'url' => $this->input->post('txtUrl'),
        		'status' => 'Y',
        		'type' => $this->input->post('drpPosition'),
        		'dateadded' => UTCDATETIME
        	);

        	$create_id = $this->model_advertise->create($data);
 
			if($create_id == true) {
	   			    
				$new_name = 'advertise_img_'.$create_id . '_' .$_FILES["categoryImage"]['name'];
	
				$config['upload_path']          = './assets/sysimagedocs/advertise/';
                $config['allowed_types']        = 'gif|jpg|png';
                $config['max_size']             = 10000;
				$config['file_name']            = $new_name;
                /* $config['max_width']            = 1024;
                $config['max_height']           = 768; */

                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('categoryImage'))
                {
                        $error = array('error' => $this->upload->display_errors());
		
                        redirect('admin/advertise/addedit', 'refresh');
                }
                else {
					$data = array('upload_data' => $this->upload->data());

					/* Now update image name in advertise table */
					$result = $this->model_advertise->updateImageName($create_id,$data["upload_data"]["file_name"]);

					//redirect('admin/advertise', $data);
                }				
				
				$url = '';
				if($this->uri->segment('4') !== null && $this->uri->segment('5') == null){
					$url = $this->uri->segment('4') ;
				}
				
        		$this->session->set_flashdata('success', 'Record created successfully.');
        		redirect('admin/advertise/index/'.$url, 'refresh');
        	}
        	else {
        		$this->session->set_flashdata('errors', 'Error occurred!!');
        		redirect('admin/advertise/addedit', 'refresh');
        	}
        }
        else {
            // false case
			if($_SERVER['REQUEST_METHOD']=='POST'){
			  $this->session->set_flashdata('errors', 'Error occurred!!');
			}
            $this->data['doAction'] = 'Add';
            $this->data['txtTitle'] = isset($_REQUEST['txtTitle']) ? $_REQUEST['txtTitle'] : '';
            $this->data['drpPosition'] = isset($_REQUEST['drpPosition']) ? $_REQUEST['drpPosition'] : '';
            $this->data['txtUrl'] = isset($_REQUEST['txtUrl']) ? $_REQUEST['txtUrl'] : '';
            $this->render_template('admin/advertise/addedit', $this->data);
        }
	}


	public function edit($id = null)
	{
		if($id) {
			$id = $this->atri->de($id);
			$this->form_validation->set_rules('txtTitle', 'Title', 'trim|required');
			$this->form_validation->set_rules('txtUrl', 'Url', 'trim|required');

			if (empty($_FILES['categoryImage']['name']) && $this->input->post('hdnparentcatid') == NULL){
				$this->form_validation->set_rules('categoryImage', 'Image', 'required');
			}

			
			$arrParams['ID'] = $id;
			$list_data = $this->model_advertise->getAdvertiseList($arrParams);
			
			if ($this->form_validation->run() == TRUE) {
	            
				$urlKey = preg_replace('/[^a-zA-Z0-9_.]/', '_', $this->input->post('txtName')) . '_' . $id;
				
				$data = array(
					'title' => $this->input->post('txtTitle'),
					'url' => $this->input->post('txtUrl'),
					'status' => 'Y',
					'type' => $this->input->post('drpPosition')
				);

				/* 
				Now we are setting categoryid in url to get sub category view if it is present
				*/
				$url = '';
				
				$update = $this->model_advertise->edit($data, $id);
				
				if (!empty($_FILES['categoryImage']['name'])){
					$new_name = 'advertise_img_'.$id . '_' .$_FILES["categoryImage"]['name'];
		
					$config['upload_path']          = './assets/sysimagedocs/advertise/';
					$config['allowed_types']        = 'gif|jpg|png';
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
							$data = array('upload_data' => $this->upload->data());

							/* Now update image name in category table */
							$result = $this->model_advertise->updateImageName($id,$data["upload_data"]["file_name"]);

							//redirect('admin/category', $data);
					}		
					
				}

				
				if($update == true) {
					$this->session->set_flashdata('success', 'Record updated successfully.');
					redirect('admin/advertise/'.$url, 'refresh');
				}
				else {
					$this->session->set_flashdata('errors', 'Error occurred!!');
					redirect('admin/advertise/edit/'.$id, 'refresh');
				}
			
	        }
	        else {
				$this->data['doAction'] = 'Edit';
	            
				if($_SERVER['REQUEST_METHOD']=='POST'){
				  $this->session->set_flashdata('errors', 'Error occurred!!');
				}

				$arrParams['ID'] = $id;
				$result = $this->model_advertise->getAdvertiseList($arrParams);
				
	        	$this->data['txtTitle'] = $result[0]['title'];
	        	$this->data['drpPosition'] = $result[0]['type'];
	        	$this->data['txtUrl'] = $result[0]['url'];
	        	$this->data['images'] = $result[0]['images'];
	        	
				$this->render_template('admin/advertise/addedit', $this->data);	
	        }	
		}	
	}

	public function delete($id)
	{
		if($id) {

			$catid = $id;
			/* First check for subcategory is present or not */
			
			if(1){
				
				$delete = $this->model_advertise->delete($this->atri->de($catid));
			
				if($delete == true) {
					$this->session->set_flashdata('success', 'Record removed successfully.');
				}
				else {
					$this->session->set_flashdata('error', 'Error occurred!!');
				}
			}
			
			
			$url = '';
			if($this->uri->segment('5') !== null){
				$url = '/index/'. $this->uri->segment('5');
			}
			
			redirect('admin/advertise/'.$url, 'refresh');
		}
	}
	
	
	public function status($id)
	{
		if($id) {
			$delete = $this->model_advertise->changeStatus($this->atri->de($id));
			if($delete == true) {
				$this->session->set_flashdata('success', 'Status updated successfully.');
			}
			else {
				$this->session->set_flashdata('error', 'Error occurred!!');
			}
			redirect('admin/advertise/', 'refresh');

		}
	}
	
	public function deleteimage($id)
	{
		if($id) {
			$delete = $this->model_advertise->deleteCategoryImage($this->atri->de($id));
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
			redirect('admin/advertise/edit/'.$id, 'refresh');

		}
	}
};