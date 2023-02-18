<?php 

class Landingpage extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();
		
		$this->data['page_title'] = 'Landing Page';
		

		$this->load->model('admin/Model_landingpage');
		$this->load->library('commonvar');
		$this->load->helper('file');
	
		$this->data['arrStatus'] = $this->commonvar->getCategoryStatus();
		$this->data['arrCompanyStatus'] = $this->commonvar->companyStatus();
	
	}
	
	public function index($cat_id = NULL){
		$parent_cat_id = $this->atri->de($cat_id);
		$list_data = $this->Model_landingpage->getLandingPageList($parent_cat_id,true);

		$this->data['list_data'] = $list_data;

		$this->render_template('admin/landingpage/index', $this->data);
	}
	
	public function create()
	{

		$this->form_validation->set_rules('txtName', 'Name', 'trim|required');
		$this->form_validation->set_rules('txtIndustryName', 'Name', 'trim|required');
		if (empty($_FILES['categoryImage']['name'])){
			$this->form_validation->set_rules('categoryImage', 'Image', 'required');
		}
		
		
	
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
        		'industry' => $this->input->post('txtIndustryName'),
        		'description' => $this->input->post('txtShortDesc'),
        		'parentid' => $this->atri->de($this->input->post('hdnparentcatid')),
        		'level' => $level,
        		'status' => 'Y',
        		'url_key' => '',
        		'flagdisplayinhomepage' => $this->input->post('flagdisplayinhome')
        	);

			
        	$create_id = $this->model_category->create($data);
 
			if($create_id == true) {
	   			    
				$new_name = 'category_img_'.$create_id . '_' .$_FILES["categoryImage"]['name'];
	
				$config['upload_path']          = './assets/sysimagedocs/';
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
						$result = $this->model_category->updateCategoryImageName($create_id,$data["upload_data"]["file_name"]);

                        //redirect('admin/category', $data);
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
            $this->data['txtIndustryName'] = isset($_REQUEST['txtIndustryName']) ? $_REQUEST['txtIndustryName'] : '';
            $this->data['txtShortDesc'] = isset($_REQUEST['txtShortDesc']) ? $_REQUEST['txtShortDesc'] : '';
            $this->data['flagdisplayinhome'] = isset($_REQUEST['flagdisplayinhome']) ? $_REQUEST['flagdisplayinhome'] : 'N';
            $this->render_template('admin/category/addedit', $this->data);
        }
	}


	public function edit($id = null)
	{
		if($id) {
			$id = $this->atri->de($id);
			$this->form_validation->set_rules('txtName', 'Name', 'trim|required');
			$this->form_validation->set_rules('txtIndustryName', 'Industry', 'trim|required');
			
			$list_data = $this->model_category->getCategoryList($id);
			
			
			if (empty($_FILES['categoryImage']['name']) && $list_data[0]['imagename'] == null){
				$this->form_validation->set_rules('categoryImage', 'Image', 'required');
			}

			if ($this->form_validation->run() == TRUE) {
	            
				$urlKey = preg_replace('/[^a-zA-Z0-9_.]/', '_', $this->input->post('txtName')) . '_' . $id;
				
				$data = array(
					'name' => $this->input->post('txtName'),
					'industry' => $this->input->post('txtIndustryName'),
					'description' => $this->input->post('txtShortDesc'),
					'flagdisplayinhomepage' => $this->input->post('flagdisplayinhome'),
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
				
				if (!empty($_FILES['categoryImage']['name'])){
					$new_name = 'category_img_'.$id . '_' .$_FILES["categoryImage"]['name'];
		
					$config['upload_path']          = './assets/sysimagedocs/';
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
							$result = $this->model_category->updateCategoryImageName($id,$data["upload_data"]["file_name"]);

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
				
				
	        	$this->data['txtName'] = $result[0]['name'];
	        	$this->data['txtIndustryName'] = $result[0]['industry'];
	        	$this->data['txtShortDesc'] = $result[0]['description'];
	        	$this->data['txtparentid'] = $result[0]['parentid'];
	        	$this->data['categoryImage'] = $result[0]['imagename'];
	        	$this->data['flagdisplayinhome'] = $result[0]['flagdisplayinhomepage'];

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
			$delete = $this->Model_landingpage->changeStatus($this->atri->de($id),$this->input->get('val'));
			if($delete == true) {
				$filename = 'assets/landing_pages/' . $this->atri->de($id) . '.php';
				if(file_exists($filename)){
					unlink($filename);
				}
				
				if( $this->input->get('val') == 'A' ) {
					$data['pageTitle'] = 'Business';
					$data['hideBanner'] = true;
					$this->load->model('Landingpage_model');
					$this->load->model('admin/Model_category', 'category');
					$data['arrDefSequence'] = $this->commonvar->getLandingPageSection();
					
					$arrLandingInfo = $this->Landingpage_model->getLandingPageInfo(array("ID" => $this->atri->de($id)));
					if( is_array($arrLandingInfo) && !empty($arrLandingInfo[0]) ) {
						$data = array_merge($data, $arrLandingInfo[0]);
						
						$arrCatId = explode(',', $data['categoryid']);
						
						$data['arrSelCategory'] = $this->category->getChildCategoryList($arrCatId);
						$data['flagWrite'] = true;
						$strHTML = $this->load->view('business',$data, true);
						
						write_file('assets/landing_pages/' . $arrLandingInfo[0]['id'] . '.php', $strHTML, 'w+');
					}
				}
				$this->session->set_flashdata('success', 'Status updated successfully.');
			}
			else {
				$this->session->set_flashdata('error', 'Error occurred!!');
			}
			
			redirect('admin/landingpage/', 'refresh');

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