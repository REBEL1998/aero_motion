<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_category extends Front_Controller {

	public function __construct()
	{
		parent::__construct();

        $this->load->model('admin/model_product');

	}

	public function index( $catUrl = NULL ){
	
        $catKey = array_search($catUrl, array_column($this->data['arrCategoryData'], 'url_key'));
        $catId = !empty($this->data['arrCategoryData'][$catKey]['id']) ? $this->data['arrCategoryData'][$catKey]['id'] : 0;
        $arrMainCategory = !empty($this->data['arrCategoryData'][$catKey]) ? $this->data['arrCategoryData'][$catKey] : [];

        $arrParams = ['catId' => $catId];
        $arrProductData = $this->model_product->getProductList('', $arrParams);

        $this->data['arrMainCategory'] = $arrMainCategory;
        $this->data['arrProductData'] = $arrProductData;

		$this->display_template('product_category', $this->data);
	}
}
