<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Front_Controller {

	public function __construct()
	{
		parent::__construct();
	}

	public function index()
	{
		$dataSet = $this->data;
		
		
		$this->display_template('home', $dataSet);
	}
}
