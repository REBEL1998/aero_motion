<?php

class Contact_us_model extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getContactInquiryDetails($params = array())
    {

        $this->db->select('c.*');
        $this->db->from('contactus c');
        $this->db->where('c.flagdelete !=', 'D');

        foreach ($params as $key => $val) {
            switch (strtoupper($key)) {
                case "CONTACTID":						
					$this->db->where('c.id', $val);
                    break;
				case "SORTBY":
					switch($val){
						case"DTD":
							$this->db->order_by('dateadded', 'DESC');
							break;
						default:
							$this->db->order_by('dateadded', 'DESC');
							break;
					}
            }
        }

        $result = $this->db->get();

        if (!empty($params['flagCount'])) {
            return $result->num_rows();
        }
		
		$arrTempData = $result->result_array();
		
		// contact id wise create array details 
		$arrResult = array();
		foreach($arrTempData as $key => $arrContactData){
			$arrResult[$arrContactData['id']] = $arrContactData;
		}

        return $arrResult;
    }

    public function insertContactInquiry($params = array())
    {
       if( empty($params) ) {
			return  false;
		}
		
		$params['dateadded'] = UTCDATETIME;
		
		$this->db->insert('contactus', $params);
		return true;
	}
	
	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->update('contactus', array('rmdate' => UTCDATE, 'flagdelete' => 'D'));
		return ($delete == true) ? true : false;
	}
	
}