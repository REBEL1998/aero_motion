<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends Admin_Controller
{

    public function __construct()
    {
        parent::__construct();

        $this->load->model('admin/model_auth');
        $this->load->model('admin/model_user');
    }

    /*
    Check if the login form is submitted, and validates the user credential
    If not submitted it redirects to the login page
     */
    public function login()
    {

        $this->form_validation->set_rules('email', 'Email', 'required');
        $this->form_validation->set_rules('password', 'Password', 'required');

        if ($this->form_validation->run() == true) {
            // true case
            $email_exists = $this->model_auth->check_email($this->input->post('email'));

            if ($email_exists == true) {
                $login = $this->model_auth->login($this->input->post('email'), $this->input->post('password'));
                
                if ($login) {
                    $logged_in_sess = array(
                        'id' => $login['id'],
                        'username' => $login['username'],
                        'email' => $login['email'],
                        'logged_in' => true,
                    );

                    $this->session->set_userdata($logged_in_sess);

                    redirect(base_url('admin/dashboard'), 'refresh');

                } else {

                    $this->data['errors'] = '<div class="alert alert-danger" role="alert">Incorrect username/password </div>';
                    $this->load->view('admin/login', $this->data);

                }
            } else {
                $this->data['errors'] = '<div class="alert alert-danger" role="alert">Email does not exists</div>';

                $this->load->view('admin/login', $this->data);

            }
        } else {
            // false case
            $this->load->view('admin/login');
        }
    }

    /*
    clears the session and redirects to login page
     */
    public function logout()
    {
        $this->session->sess_destroy();
        redirect(base_url('admin/auth/login'), 'refresh');
    }


     /*
    Check if the login form is submitted, and validates the user credential
    If not submitted it redirects to the login page
     */
    public function create_admin_user()
    {

        $this->form_validation->set_rules('txtUsername', 'Username', 'trim|required');
        $this->form_validation->set_rules('txtEmail', 'Email', 'trim|required');
        $this->form_validation->set_rules('txtPassword', 'Password', 'trim|required');
        // $this->form_validation->set_rules('txtFirstName', 'First Name', 'trim|required');
        // $this->form_validation->set_rules('txtLastName', 'Last Name', 'trim|required');

        if ($this->form_validation->run() == true) {

             // true case
             $email_exists = $this->model_auth->check_email($this->input->post('email'));

             if ($email_exists == true) { 
                $this->session->set_flashdata('errors', 'Emain already Exist.');
                $this->load->view('admin/create_admin_user');
             }
             else {

                 $data = array(
                     'username' => $this->input->post('txtUsername'),
                     'password' => password_hash($this->input->post('txtPassword'), PASSWORD_DEFAULT),
                     // 'usergroupid' => $this->input->post('selUserGroup'),
                     'email' => $this->input->post('txtEmail'),
                     'firstname' => $this->input->post('txtFirstName'),
                     'lastname' => $this->input->post('txtLastName'),
                 );
     
                 $create_id = $this->model_user->create($data);
     
                 if ($create_id == true) {
                     $this->load->view('admin/login');
                 } else {
                     $this->session->set_flashdata('errors', 'Error occurred!!');
                     $this->load->view('admin/create_admin_user');
                 }
             }


        } else {
            // false case
            $this->load->view('admin/create_admin_user');
        }
    }

}
