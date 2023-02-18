<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends Front_Controller {

	public function __construct()
	{
		parent::__construct();
		// $this->load->library('Mailhandler');die;
		$this->load->model('post_ad_model', 'ads_model');
		$this->load->model('admin/Model_advertise', 'ads_advertise');
		
	}

	public function index()
	{
		$dataSet = $this->data;
		
		
		##### GET RECENT ADS DETAILS  - START #####
		$sortBy = $this->input->get('sortBy', TRUE);
		$arrData =  array('SORTBY' => "IDD", 'STATUS' => 'A', "LIMIT" => 8);
		$arrData['pageIndex'] = $this->uri->segment(2) ?? 0;
		
        $arrAdsDetails = $this->ads_model->getAdsListInfo($arrData);

		$dataSet['arrListData'] = $arrAdsDetails;
        ##### GET RECENT ADS DETAILS  - END #####

		##### GET ADVERTISE DETAILS  - START #####
		$sortBy = $this->input->get('sortBy', TRUE);
		$arrData =  array('SORTBY' => "RANDOM", 'STATUS' => 'Y', "LIMIT" => 8);
		$arrData['pageIndex'] = $this->uri->segment(2) ?? 0;


        $arrAdvertiseDetails = $this->ads_advertise->getAdvertiseList($arrData);

		$dataSet['arrListData'] = $arrAdsDetails;
		$dataSet['arrAdvertise'] = $arrAdvertiseDetails;
        ##### GET ADVERTISE DETAILS  - END #####
		
		$this->display_template('home', $dataSet);
	}
}
