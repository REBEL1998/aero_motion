<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_product extends Front_Controller {

	public function __construct()
	{
		parent::__construct();

        $this->load->model('admin/model_product');
        $this->load->model('admin/Model_attched');

	}

	public function index( $prodUrl = NULL ){
	
         $arrProductData = $this->model_product->getProductList('',['FLAGSTATUS' => 'Y']);

        // $this->data['arrMainProduct'] = $arrMainProduct;
        $this->data['arrProductData'] = $arrProductData;
		// var_dump($this->data);
		// die();
		$this->display_template('product',  $this->data);
	}
	
	public function product_details( $prodId = NULL){
	
        $arrProductData = $this->model_product->getProductList('',['PRODUCTID' =>$prodId]);
		$arrParams = [
			'PRODID' => $prodId,
		];
        $arrAttchedDetails = $this->Model_attched->getAttchedList($arrParams);
		$this->display_template('product_details', ['arrProductDetails' => $arrProductData[0],'arrAttchedDetails' => $arrAttchedDetails]);
	}
}
