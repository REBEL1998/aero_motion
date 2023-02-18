<?php 

class MY_Controller extends CI_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		
	}
}

class Front_Controller extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
		
		$this->load->library('commonvar');
		$this->load->model('customer_model','customer');
		$this->load->model('admin/Model_category','category');
		
		$arrPage = $this->commonvar->hidePageAfterLoginFront();
		if( in_array($this->uri->segment(1),$arrPage) && $this->session->userdata('login_id') ) {
			redirect(base_url('myaccount'), 'refresh');
		}
		
		$login = $this->session->userdata('login_id');
		if( !empty($login) && !empty($login['id']) && !defined('LOGINID') ) {
			define('LOGINID',$login['id']);
			
			$userData = $this->customer->get_users(array("USERID" => LOGINID));
			if( !empty($userData) && !empty($userData[0]) ) {
				$this->userdata = $userData[0];
			}
		}
		
		// default array set for frontend
		$this->data['yesNo'] = $this->commonvar->yesno();
        $this->data['custType'] = $this->commonvar->getCustomerType();
		$this->data['sidebarCate'] = $this->category->getLevelWiseCategory();
		
	}
	
	public function display_template($page = null, $data = array())
	{
		$this->load->view('templates/header',$data);
		$this->load->view($page, $data);
		$this->load->view('templates/footer',$data);
		
		define('CALLEDURI', base_url() . $this->uri->uri_string());
	}
	
	public function initPagination($arrParams = array()){
	
		$total_rows = !empty($arrParams['total_rows']) ? $arrParams['total_rows'] : 0;
		$base_url = !empty($arrParams['base_url']) ? $arrParams['base_url'] :  base_url();
		
		// init pagination 
		$this->load->library('pagination');
		
		$config = array(
			'base_url' => $base_url,
			'per_page' => 1,
			'total_rows' => $total_rows,
			'full_tag_open' => "<ul class='pagination justify-content-center'>",
			'full_tag_close' => "</ul>",
			'prev_tag_open' => "<li>",
			'prev_tag_close' => "</li>",
			'num_tag_open' => "<li>",
			'num_tag_close' => "</li>",
			'cur_tag_open' => "<li><a class='number active'>",
			'cur_tag_close' => "</li>",
			'next_tag_open' => "<li>",
			'next_tag_close' => "</li>",
		); 

		$this->pagination->initialize($config);
	}
	
}

class Admin_Controller extends MY_Controller 
{

	public function __construct() 
	{
		parent::__construct();

		$group_data = array();
		if(empty($this->session->userdata('logged_in'))) {
			$session_data = array('logged_in' => FALSE);
			$this->session->set_userdata($session_data);
		}
		else {
			$user_id = $this->session->userdata('id');
		}
		
		$this->load->library('commonvar');
		$this->load->model('admin/Model_user','model_user');
		
		$this->data['arrAdminPages'] = $this->commonvar->getAdminPages();

		#####  USER ACCESS CHECK - START #####
		$this->data['arrUserAccess'] = [];
		if ( !empty($user_id) ) {
			$arrUserData = $this->model_user->getUserList($user_id);
			$this->data['arrUserAccess'] = !empty($arrUserData[0]["access"]) ? json_decode($arrUserData[0]["access"], true) : [];
		}
		
		if( in_array($this->uri->segment(2), array_keys($this->data['arrAdminPages'])) && !in_array($this->uri->segment(2),$this->data['arrUserAccess']) ) {
			redirect(base_url('admin/auth/logout'), 'refresh');
		}
		#####  USER ACCESS CHECK - START #####

	}

	public function logged_in()
	{
		$session_data = $this->session->userdata();
		if($session_data['logged_in'] == TRUE) {
			redirect('admin/dashboard', 'refresh');
		}
	}

	public function not_logged_in()
	{
		$session_data = $this->session->userdata();
		if($session_data['logged_in'] == FALSE) {
			redirect('admin/auth/login', 'refresh');
		}
	}

	public function render_template($page = null, $data = array())
	{

		$this->load->view('admin/templates/header',$data);
		$this->load->view('admin/templates/main_header',$data);
		$this->load->view('admin/templates/pagepath',$data);
		$this->load->view('admin/templates/main_sidebar',$data);
		$this->load->view($page, $data);
		$this->load->view('admin/templates/footer',$data);
	}

	public function currency()
	{
		return $currency_symbols = array(
		  'AED' => '&#1583;.&#1573;', // ?
		  'AFN' => '&#65;&#102;',
		  'ALL' => '&#76;&#101;&#107;',
		  'ANG' => '&#402;',
		  'AOA' => '&#75;&#122;', // ?
		  'ARS' => '&#36;',
		  'AUD' => '&#36;',
		  'AWG' => '&#402;',
		  'AZN' => '&#1084;&#1072;&#1085;',
		  'BAM' => '&#75;&#77;',
		  'BBD' => '&#36;',
		  'BDT' => '&#2547;', // ?
		  'BGN' => '&#1083;&#1074;',
		  'BHD' => '.&#1583;.&#1576;', // ?
		  'BIF' => '&#70;&#66;&#117;', // ?
		  'BMD' => '&#36;',
		  'BND' => '&#36;',
		  'BOB' => '&#36;&#98;',
		  'BRL' => '&#82;&#36;',
		  'BSD' => '&#36;',
		  'BTN' => '&#78;&#117;&#46;', // ?
		  'BWP' => '&#80;',
		  'BYR' => '&#112;&#46;',
		  'BZD' => '&#66;&#90;&#36;',
		  'CAD' => '&#36;',
		  'CDF' => '&#70;&#67;',
		  'CHF' => '&#67;&#72;&#70;',
		  'CLP' => '&#36;',
		  'CNY' => '&#165;',
		  'COP' => '&#36;',
		  'CRC' => '&#8353;',
		  'CUP' => '&#8396;',
		  'CVE' => '&#36;', // ?
		  'CZK' => '&#75;&#269;',
		  'DJF' => '&#70;&#100;&#106;', // ?
		  'DKK' => '&#107;&#114;',
		  'DOP' => '&#82;&#68;&#36;',
		  'DZD' => '&#1583;&#1580;', // ?
		  'EGP' => '&#163;',
		  'ETB' => '&#66;&#114;',
		  'EUR' => '&#8364;',
		  'FJD' => '&#36;',
		  'FKP' => '&#163;',
		  'GBP' => '&#163;',
		  'GEL' => '&#4314;', // ?
		  'GHS' => '&#162;',
		  'GIP' => '&#163;',
		  'GMD' => '&#68;', // ?
		  'GNF' => '&#70;&#71;', // ?
		  'GTQ' => '&#81;',
		  'GYD' => '&#36;',
		  'HKD' => '&#36;',
		  'HNL' => '&#76;',
		  'HRK' => '&#107;&#110;',
		  'HTG' => '&#71;', // ?
		  'HUF' => '&#70;&#116;',
		  'IDR' => '&#82;&#112;',
		  'ILS' => '&#8362;',
		  'INR' => '<i class="fa fa-inr" aria-hidden="true"></i>
',
		  'IQD' => '&#1593;.&#1583;', // ?
		  'IRR' => '&#65020;',
		  'ISK' => '&#107;&#114;',
		  'JEP' => '&#163;',
		  'JMD' => '&#74;&#36;',
		  'JOD' => '&#74;&#68;', // ?
		  'JPY' => '&#165;',
		  'KES' => '&#75;&#83;&#104;', // ?
		  'KGS' => '&#1083;&#1074;',
		  'KHR' => '&#6107;',
		  'KMF' => '&#67;&#70;', // ?
		  'KPW' => '&#8361;',
		  'KRW' => '&#8361;',
		  'KWD' => '&#1583;.&#1603;', // ?
		  'KYD' => '&#36;',
		  'KZT' => '&#1083;&#1074;',
		  'LAK' => '&#8365;',
		  'LBP' => '&#163;',
		  'LKR' => '&#8360;',
		  'LRD' => '&#36;',
		  'LSL' => '&#76;', // ?
		  'LTL' => '&#76;&#116;',
		  'LVL' => '&#76;&#115;',
		  'LYD' => '&#1604;.&#1583;', // ?
		  'MAD' => '&#1583;.&#1605;.', //?
		  'MDL' => '&#76;',
		  'MGA' => '&#65;&#114;', // ?
		  'MKD' => '&#1076;&#1077;&#1085;',
		  'MMK' => '&#75;',
		  'MNT' => '&#8366;',
		  'MOP' => '&#77;&#79;&#80;&#36;', // ?
		  'MRO' => '&#85;&#77;', // ?
		  'MUR' => '&#8360;', // ?
		  'MVR' => '.&#1923;', // ?
		  'MWK' => '&#77;&#75;',
		  'MXN' => '&#36;',
		  'MYR' => '&#82;&#77;',
		  'MZN' => '&#77;&#84;',
		  'NAD' => '&#36;',
		  'NGN' => '&#8358;',
		  'NIO' => '&#67;&#36;',
		  'NOK' => '&#107;&#114;',
		  'NPR' => '&#8360;',
		  'NZD' => '&#36;',
		  'OMR' => '&#65020;',
		  'PAB' => '&#66;&#47;&#46;',
		  'PEN' => '&#83;&#47;&#46;',
		  'PGK' => '&#75;', // ?
		  'PHP' => '&#8369;',
		  'PKR' => '&#8360;',
		  'PLN' => '&#122;&#322;',
		  'PYG' => '&#71;&#115;',
		  'QAR' => '&#65020;',
		  'RON' => '&#108;&#101;&#105;',
		  'RSD' => '&#1044;&#1080;&#1085;&#46;',
		  'RUB' => '&#1088;&#1091;&#1073;',
		  'RWF' => '&#1585;.&#1587;',
		  'SAR' => '&#65020;',
		  'SBD' => '&#36;',
		  'SCR' => '&#8360;',
		  'SDG' => '&#163;', // ?
		  'SEK' => '&#107;&#114;',
		  'SGD' => '&#36;',
		  'SHP' => '&#163;',
		  'SLL' => '&#76;&#101;', // ?
		  'SOS' => '&#83;',
		  'SRD' => '&#36;',
		  'STD' => '&#68;&#98;', // ?
		  'SVC' => '&#36;',
		  'SYP' => '&#163;',
		  'SZL' => '&#76;', // ?
		  'THB' => '&#3647;',
		  'TJS' => '&#84;&#74;&#83;', // ? TJS (guess)
		  'TMT' => '&#109;',
		  'TND' => '&#1583;.&#1578;',
		  'TOP' => '&#84;&#36;',
		  'TRY' => '&#8356;', // New Turkey Lira (old symbol used)
		  'TTD' => '&#36;',
		  'TWD' => '&#78;&#84;&#36;',
		  'UAH' => '&#8372;',
		  'UGX' => '&#85;&#83;&#104;',
		  'USD' => '&#36;',
		  'UYU' => '&#36;&#85;',
		  'UZS' => '&#1083;&#1074;',
		  'VEF' => '&#66;&#115;',
		  'VND' => '&#8363;',
		  'VUV' => '&#86;&#84;',
		  'WST' => '&#87;&#83;&#36;',
		  'XAF' => '&#70;&#67;&#70;&#65;',
		  'XCD' => '&#36;',
		  'XPF' => '&#70;',
		  'YER' => '&#65020;',
		  'ZAR' => '&#82;',
		  'ZMK' => '&#90;&#75;', // ?
		  'ZWL' => '&#90;&#36;',
		);
	}
}