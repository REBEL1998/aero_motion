<?php 

class Dashboard extends Admin_Controller 
{
	public function __construct()
	{
		parent::__construct();

		$this->not_logged_in();


		$this->data['page_title'] = 'Dashboard';
	}

	public function index()
	{
		$this->render_template('admin/dashboard/index', $this->data);
	}
	
}