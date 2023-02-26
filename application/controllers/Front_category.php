<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Front_category extends Front_Controller {

	public function __construct()
	{
		parent::__construct();

        $this->load->model('admin/model_product');
        $this->load->model('admin/model_attched');

	}

	public function index( $catUrl = NULL ){
	
        $catKey = array_search($catUrl, array_column($this->data['arrCategoryData'], 'url_key'));
        $catId = !empty($this->data['arrCategoryData'][$catKey]['id']) ? $this->data['arrCategoryData'][$catKey]['id'] : 0;
        $arrMainCategory = !empty($this->data['arrCategoryData'][$catKey]) ? $this->data['arrCategoryData'][$catKey] : [];

        $arrParams = ['catId' => $catId];
        $arrProductData = $this->model_product->getProductList('', $arrParams);
        
        
        // find all attachements
        $arrAttchements = $this->model_attched->getAttchedList(['code'=> 'PR', 'flagFormat'=> true]);


        foreach($arrProductData  as $key=>$arrTemp) {
            $arrProductData[$key]['arrAttchements'] = !empty($arrAttchements[$arrTemp['prodId']]) ? $arrAttchements[$arrTemp['prodId']] : [];
        }
       
        $this->data['arrMainCategory'] = $arrMainCategory;
        $this->data['arrProductData'] = $arrProductData;

        $this->data['arrCss'] = [
            base_url("assets/admin/fonts/fontawesome.css"),
            base_url("assets/admin/css/bootstrap-material.css"),
            base_url("assets/admin/css/shreerang-material.css"),
            base_url("assets/admin/css/uikit.css"),
        ];

        $this->data['arrJs'] = [];



		$this->display_template('product_category', $this->data);
	}
}
