<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Front_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('admin/model_product');
	}

	public function index()
	{
		

		$arrParams = [];
		$arrProductData = $this->model_product->getProductList('', $arrParams);

        $this->data['arrProductData'] = $arrProductData;

		$dataSet = $this->data;
		
		$this->display_template('home', $dataSet);
	}

}
