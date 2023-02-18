<?php 
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Mailhandler{
   private $CI;
   			
	public function __construct()
	{
		$this->CI =& get_instance();
		
		$config = Array(
			'protocol' => 'smtp',
			'smtp_host' => 'in-v3.mailjet.com',
			'smtp_port' => 587,
			'smtp_user' => '63d258ce02ccbbfecfa71fbd9cf3c676',
			'smtp_pass' => 'ae9302da80f1c67e9b8f4da287120f46',
			'mailtype'  => 'html',
		);
		
		$this->CI->load->library('email', $config);  

		$this->CI->load->library('commonvar');
	}
	
	public function send($params, $code){
		
		
		
		$arrTemplates = $this->CI->commonvar->getEmailTemplate();
		
		$strBody = $arrTemplates['CMNTP'];
		if( !isset($arrTemplates[$code]) ) {
			return false;
		}
		
		$strTemplate = $arrTemplates[$code]['content'];
		$strSubject = $arrTemplates[$code]['subject'];
		
		foreach( $params as $key => $val ) {
			$sKey = '#' . $key;
			$strTemplate = str_replace($sKey,$val,$strTemplate);
			$strSubject = str_replace($sKey,$val,$strSubject);
		}
	
		$strBody = str_replace('#MAILBODYCONTENT' ,$strTemplate, $strBody);

		$this->CI->email->from(FROMEMAIL, PROJECTNAME);
		$this->CI->email->to($params['toEmail']);
		 
		$this->CI->email->subject($strSubject);
		$this->CI->email->message($strBody);
		
		$flagResult = $this->CI->email->send();
		
		return $flagResult;
	}
	
}
