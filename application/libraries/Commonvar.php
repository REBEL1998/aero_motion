<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}

class Commonvar
{

    public function getCategoryStatus()
    {
        return array(
            "Y" => "Active",
            "N" => "Inactive",
        );
    }
    public function yesno()
    {
        return array(
            "Y" => "Yes",
            "N" => "No",
        );
    }
    public function companyStatus()
    {
        return array(
            "PS" => "Partnership",
            "PR" => "Proprietor",
        );
    }

    public function getCustomerType()
    {
        return array(
            "SM" => "Sell Machine",
            "MT" => "Machine Technician",
            "SB" => "Showcase Business",
        );
    }

    public function hidePageAfterLoginFront()
    {
        return array(
            "sign_in",
            "sign_up",
            "sign-in",
            "sign-up",
        );
    }

    public function getLandingPageSection()
    {
        return array(
            '1' => array('value' => 'aboutcompany,descriptionofprod,listofmachinery,images', 'img' => 'assets/front-end/images/landing-preview1.png'),
            '2' => array('value' => 'aboutcompany,descriptionofprod,images,listofmachinery', 'img' => 'assets/front-end/images/landing-preview2.png'),
            '3' => array('value' => 'images,aboutcompany,descriptionofprod,listofmachinery', 'img' => 'assets/front-end/images/landing-preview3.png'),
            '4' => array('value' => 'images,descriptionofprod,listofmachinery,aboutcompany', 'img' => 'assets/front-end/images/landing-preview4.png'),
        );
        /* return array(
    'aboutcompany' => 'About Company',
    'descriptionofprod' => 'Description of Products',
    'listofmachinery' => 'List of Machinery Used In Present Company',
    'images' => 'Images'
    ); */
    }

    public function getEmailTemplate()
    {
        return array(
            "CMNTP" => "<div><center>Header</center></div>#MAILBODYCONTENT<div><center>Footer</center></div>",
            "EMOTP" => array(
                "subject" => "MachineAdda.com OTP",
                "content" => "Dear Customer,<br/><br/> Your OTP for MachineAdda.com is #OTP. Use this Passcode to complete your registration. <br/><br/>Thank you.",
            ),
        );
    }

    public function getTechnicianWorkingType()
    {
        return array(
            "FL" => "Freelancer",
            "AG" => "Agency",
            "PP" => "Proprietor",
        );
    }

    public function getAdStatus()
    {
        return array(
            "P" => "Pending",
            "A" => "Approved",
            "R" => "Rejected",
        );
    }

    /*
     * Ads listing sorting filter
     */
    public function getAdsListSortingFilter()
    {
        return array(
            "NMA" => "A to Z",
            "NMD" => "Z To A",
            "PRA" => "Price Low to High",
            "PRD" => "Price Low to High",
        );
    }

    /*
     * Advertise Type
     */
    public function getAdvertiseType()
    {
        return array(
            "HSL" => "Siderbar Left/Right",
            "OTH" => "Other",
        );
    }
	
	/*
	* This function use for get pages
	*/
	public function getAdminPages(){
		return array(
			"user" => "User",
			"usergroup" => "User Group",
			"category" => "Category",
			"customer" => "Customer",
			"landingpage" => "Landing Page",
			"technician" => "Technician",
			"ads" => "Ads",
			"contactus" => "Contact Inquiry",
			"advertise" => "Advertise",
		);
	}
	
}
