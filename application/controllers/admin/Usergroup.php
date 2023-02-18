<?php

class Usergroup extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'User Group';

        $this->load->model('admin/model_user_group');
        $this->load->library('commonvar');

        $this->data['arrStatus'] = $this->commonvar->getCategoryStatus();
        $this->data['customerType'] = $this->commonvar->getCustomerType();
		
    }

    public function index($user_id = null)
    {

        $list_data = $this->model_user_group->getUserGroupList($user_id, true);


        $this->data['list_data'] = $list_data;

        $this->render_template('admin/usergroup/index', $this->data);
    }

    public function create()
    {

        $this->form_validation->set_rules('txtGroup', 'Group', 'trim|required');

        if ($this->form_validation->run() == true) {

            $data = array(
                'group' => $this->input->post('txtGroup'),
            );
			
            $create_id = $this->model_user_group->create($data);

            if ($create_id == true) {
                $this->session->set_flashdata('success', 'Record created successfully.');
                redirect('admin/usergroup/index/', 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('admin/usergroup/addedit', 'refresh');
            }
			
        } else {
			
            // false case
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->session->set_flashdata('errors', 'Error occurred!!');
            }
			
            $this->data['doAction'] 	= 'Add';
            $this->data['txtGroup'] 	= isset($_REQUEST['txtGroup']) ? $_REQUEST['txtGroup'] : '';

            $this->render_template('admin/usergroup/addedit', $this->data);
        }
    }

    public function edit($id = null)
    {
        if ($id) {

            $id = $this->atri->de($id);
            $this->form_validation->set_rules('txtGroup', 'Username', 'trim|required');

            $list_data = $this->model_user_group->getUserGroupList($id);

            if ($this->form_validation->run() == true) {

				
                $data = array(
					'group' => $this->input->post('txtGroup'),
				);
				
                $update = $this->model_user_group->edit($data, $id);

                if ($update == true) {
                    $this->session->set_flashdata('success', 'Record updated successfully.');
                    redirect('admin/usergroup/', 'refresh');
                } else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect('admin/usergroup/edit/', 'refresh');
                }

            } else {
                $this->data['doAction'] = 'Edit';

                $result = $this->model_user_group->getUserGroupList($id);
	
				$this->data['txtGroup'] 	= isset($result[0]['group']) ? $result[0]['group'] : '';
	
                $this->render_template('admin/usergroup/addedit', $this->data);
            }
        }
    }

    public function delete($id){
        if ($id) {

            $catid = $id;

            $delete = $this->model_user_group->delete($this->atri->de($catid));

            if ($delete == true) {
                $this->session->set_flashdata('success', 'Record removed successfully.');
            } else {
                $this->session->set_flashdata('error', 'Error occurred!!');
            }

            redirect('admin/usergroup/', 'refresh');
        }
    }

    public function status($id)
	{
		if($id) {
			$status = $this->model_user_group->changeStatus($this->atri->de($id));
			if($status == true) {
				$this->session->set_flashdata('success', 'Status updated successfully.');
			}
			else {
				$this->session->set_flashdata('error', 'Error occurred!!');
			}
			
			redirect('admin/usergroup/', 'refresh');
		}
	}

};
