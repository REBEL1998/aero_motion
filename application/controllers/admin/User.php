<?php

class User extends Admin_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->not_logged_in();

        $this->data['page_title'] = 'User';

        $this->load->model('admin/model_user');
        $this->load->model('admin/model_user_group');
        $this->load->library('commonvar');

        $this->data['arrStatus'] = $this->commonvar->getCategoryStatus();
        $this->data['customerType'] = $this->commonvar->getCustomerType();
        $this->data['arrUserGroup'] = $this->model_user_group->getUserGroupList();
		
    }

    public function index($user_id = null)
    {

        $list_data = $this->model_user->getUserList($user_id, true);

        $this->data['list_data'] = $list_data;

        $this->render_template('admin/user/index', $this->data);
    }

    public function create()
    {

        $this->form_validation->set_rules('txtUsername', 'Username', 'trim|required');
        $this->form_validation->set_rules('txtEmail', 'Email', 'trim|required');
        $this->form_validation->set_rules('txtPassword', 'Password', 'trim|required');
        $this->form_validation->set_rules('selUserGroup', 'User Group', 'trim|required');
        // $this->form_validation->set_rules('txtFirstName', 'First Name', 'trim|required');
        // $this->form_validation->set_rules('txtLastName', 'Last Name', 'trim|required');

        if ($this->form_validation->run() == true) {
			
			$access = $this->input->post('chkAccess');
 
            $data = array(
                'username' => $this->input->post('txtUsername'),
                'password' => password_hash($this->input->post('txtPassword'), PASSWORD_DEFAULT),
                'usergroupid' => $this->input->post('selUserGroup'),
                'email' => $this->input->post('txtEmail'),
                'firstname' => $this->input->post('txtFirstName'),
                'lastname' => $this->input->post('txtLastName'),
                'access' => !empty($access) ? json_encode($access) : '[]',
            );

            $create_id = $this->model_user->create($data);

            if ($create_id == true) {
                $this->session->set_flashdata('success', 'Record created successfully.');
                redirect('admin/user/index/', 'refresh');
            } else {
                $this->session->set_flashdata('errors', 'Error occurred!!');
                redirect('admin/user/addedit', 'refresh');
            }
			
        } else {
			
            // false case
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                $this->session->set_flashdata('errors', 'Error occurred!!');
            }
			
            $this->data['doAction'] 	= 'Add';
            $this->data['txtUsername'] 	= isset($_REQUEST['txtUsername']) ? $_REQUEST['txtUsername'] : '';
            $this->data['txtEmail'] 	= isset($_REQUEST['txtEmail']) ? $_REQUEST['txtEmail'] : '';
            $this->data['selUserGroup'] = isset($_REQUEST['selUserGroup']) ? $_REQUEST['selUserGroup'] : '';
            $this->data['txtPassword'] 	= isset($_REQUEST['txtPassword']) ? $_REQUEST['txtPassword'] : '';
            $this->data['txtFirstName'] = isset($_REQUEST['txtFirstName']) ? $_REQUEST['txtFirstName'] : '';
            $this->data['txtLastName'] 	= isset($_REQUEST['txtLastName']) ? $_REQUEST['txtLastName'] : '';
            $this->data['chkAccess'] 	= !empty($_REQUEST['chkAccess']) ? $_REQUEST['chkAccess'] : [];

            $this->render_template('admin/user/addedit', $this->data);
        }
    }

    public function edit($id = null)
    {
        if ($id) {

            $id = $this->atri->de($id);
            $this->form_validation->set_rules('txtUsername', 'Username', 'trim|required');
			$this->form_validation->set_rules('txtEmail', 'Email', 'trim|required');
            $this->form_validation->set_rules('selUserGroup', 'User Group', 'trim|required');

			// $this->form_validation->set_rules('txtPassword', 'Password', 'trim|required');
			// $this->form_validation->set_rules('txtFirstName', 'First Name', 'trim|required');
			// $this->form_validation->set_rules('txtLastName', 'Last Name', 'trim|required');

            $list_data = $this->model_user->getUserList($id);

            if ($this->form_validation->run() == true) {

				$access = $this->input->post('chkAccess');

                $data = array(
					'username' => $this->input->post('txtUsername'),
					'email' => $this->input->post('txtEmail'),
                    'usergroupid' => $this->input->post('selUserGroup'),
					'firstname' => $this->input->post('txtFirstName'),
					'lastname' => $this->input->post('txtLastName'),
					'access' => !empty($access) ? json_encode($access) : '[]',
				);
				
				$updatePassword = $this->input->post('txtPassword');
				if ( !empty($updatePassword) ) {
					$data['password'] = password_hash($updatePassword, PASSWORD_DEFAULT);
				}

                $update = $this->model_user->edit($data, $id);

                if ($update == true) {
                    $this->session->set_flashdata('success', 'Record updated successfully.');
                    redirect('admin/user/', 'refresh');
                } else {
                    $this->session->set_flashdata('errors', 'Error occurred!!');
                    redirect('admin/user/edit/', 'refresh');
                }

            } else {
                $this->data['doAction'] = 'Edit';

                $result = $this->model_user->getUserList($id);
	
				$this->data['txtUsername'] 	= isset($result[0]['username']) ? $result[0]['username'] : '';
				$this->data['txtPassword'] 	= '';
				$this->data['txtEmail'] 	= isset($result[0]['email']) ? $result[0]['email'] : '';
				$this->data['selUserGroup'] 	= isset($result[0]['usergroupid']) ? $result[0]['usergroupid'] : '';
				$this->data['txtFirstName'] = isset($result[0]['firstname']) ? $result[0]['firstname'] : '';
				$this->data['txtLastName'] 	= isset($result[0]['lastname']) ? $result[0]['lastname'] : '';
				$this->data['chkAccess'] 	= !empty($result[0]['access']) ? json_decode($result[0]['access'], true) : [];
	
                $this->render_template('admin/user/addedit', $this->data);
            }
        }
    }

    public function delete($id){
        if ($id) {

            $catid = $id;

            $delete = $this->model_user->delete($this->atri->de($catid));

            if ($delete == true) {
                $this->session->set_flashdata('success', 'Record removed successfully.');
            } else {
                $this->session->set_flashdata('error', 'Error occurred!!');
            }

            redirect('admin/user/', 'refresh');
        }
    }

    public function status($id)
	{
		if($id) {
			$status = $this->model_user->changeStatus($this->atri->de($id));
			if($status == true) {
				$this->session->set_flashdata('success', 'Status updated successfully.');
			}
			else {
				$this->session->set_flashdata('error', 'Error occurred!!');
			}
			
			redirect('admin/user/', 'refresh');
		}
	}

};
