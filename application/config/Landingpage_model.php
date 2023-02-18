<?php 

class Landingpage_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getLandingPageInfo($params = array()) 
	{
		
		$this->db->select('c.*, u.name userName, t.name catName ');
		$this->db->from('landingpage c');
		$this->db->join('customer u', 'u.id = c.userid');
		$this->db->join('category t' , 't.id = c.categoryid');
		$this->db->where('c.flagdelete !=', 'D');
		$this->db->where('u.flagdelete !=', 'D');
		$this->db->where('t.flagdelete !=', 'D');
		
		foreach( $params as $key => $val ) {
			switch(strtoupper($key)){
				case "USERID":
					$this->db->where('c.userid', $val);
					break;
				case "ID":
					$this->db->where('c.id', $val);
					break;
				case "NOTID":
					$this->db->where('c.id !=', $val);
					break;
				case "URL":
					$this->db->where('c.url_key', $val);
					break;
				case "STATUS":
					$this->db->where('c.status', $val);
                    break;
                case "SEARCHKEYWORD":
					if ( !empty($val) ) {
						$this->db->like('c.companyname',$val);
						$this->db->or_like('c.companyaddress',$val);
						$this->db->or_like('c.listofmachinery',$val);
					}
                    break;
			}
		}
		
		/* if ( isset($params['pageIndex']) ) {
			$this->db->limit(MAXRECORD, $params['pageIndex']);
		} */
		
		$result = $this->db->get();
		
		if( !empty($params['flagCount']) ) {
			return $result->num_rows();
		}
		
		return $result->result_array();
	}
	
	/*
	* custom function for getting landing details for searching page 
	*/
	 public function customGetLandingPageInfo($params = array())
	 {

		$strSelect 	= " SELECT c.*, u.name userName, t.name catName ";
		$strFrom 	= " FROM landingpage c 
						INNER JOIN customer u ON (u.id = c.userid)
						INNER JOIN category t ON (t.id = c.categoryid) ";
		$strWhere 	= " WHERE u.flagdelete != 'D' AND c.flagdelete != 'D' AND t.flagdelete != 'D' ";
		
		$sortBy  = ' c.id ';
		$orderBy = ' DESC ';

        foreach ($params as $key => $val) {
            switch (strtoupper($key)) {
                case "USERID":						
					$strWhere .= " AND c.userid = '" . $val . "' ";
                    break;
                case "ID":
					$strWhere .= " AND c.id = '" . $val . "' ";
                    break;
				case "NOTID":
					$strWhere .= " AND c.id != '" . $val . "' ";
					break;
                case "URL_KEY":
					$strWhere .= " AND c.url_key = '" . $val . "' ";
                    break;
                case "STATUS":
					$strWhere .= " AND c.status = '" . $val . "' ";
                    break;
                case "SEARCHKEYWORD":
					if ( !empty($val) ) {
						$arrKeywords = explode(' ', $val);
						
						$strTempKeyword = "";
						foreach( $arrKeywords as $keywordIndex => $keyword ) {
							$keyword = trim($keyword);
							$strTempKeyword .= " c.companyname LIKE '%".$keyword."%' OR c.companyaddress LIKE '%".$keyword."%' OR c.listofmachinery LIKE '%".$keyword."%' OR";
						}
						
						if ( !empty($strTempKeyword) ) {
							$strTempKeyword = substr($strTempKeyword, 0, -2);
							$strWhere .= " AND ( ". $strTempKeyword ." ) ";
						}
						
					}
                    break;
            }
        }
		
		$query = $strSelect . $strFrom . $strWhere . " ORDER BY " .$sortBy . " " .$orderBy;
		
		if ( !empty($params['LIMIT']) && isset($params['pageIndex']) ) {
			$query .= " LIMIT  " .$params['LIMIT']. ", ".$params['pageIndex'];
		}
		else if ( isset($params['pageIndex']) ) {
			$query .= " LIMIT  ".$params['pageIndex'].", ".MAXRECORD;
		}
		
		// print($query);
		
		$objResult = $this->db->query($query);
		
		if (!empty($params['flagCount'])) {
            return $objResult->num_rows();
        }

        return $objResult->result_array();
    }
	
	public function insertUpdateLandingPage($params = array(), $userId = '') 
	{
	
		$this->db->select('c.id, c.images');
		$this->db->from('landingpage c');
		$this->db->where('c.userid', $userId);
		$this->db->where('c.flagdelete !=', 'D');
		
		$results = $this->db->get()->result_array();
		
		if( count($results) > 0 ){
			
			if( !empty($params['images']) && !empty($results[0]['images']) ) {
				$params['images'] = array_merge(explode(',', $params['images']), explode(',', $results[0]['images']));
				$params['images'] = array_filter($params['images']);
				$params['images'] = implode(',',$params['images']);
			}
			
			$this->db->where('userid', $userId);
			$params['dateupdated '] = UTCDATETIME;
			$this->db->update('landingpage', $params);
			// $result = $results->result_array();
			$recid = $results[0]['id'];
		}
		else {
			$params['userid'] = $userId;
			$params['dateadded'] = UTCDATETIME;
			$this->db->insert('landingpage', $params);
			$recid = $this->db->insert_id();
		}
		
		$url_key = strtolower(preg_replace('/[^A-Za-z0-9]/', '', $params['companyname']));
		
		$arrLandingInfo = $this->getLandingPageInfo(array("URL" => $url_key, "NOTID" => $recid));
		if( !empty($arrLandingInfo) ) {
			$url_key .= '-' . $recid;
		}
		
		$this->updateLandingPage(array('url_key' => $url_key), $recid);
		
		return true;
	}
	
	
	public function updateLandingPage($params = array(), $id = '') 
	{
		if( empty($params) ) {
			return  false;
		}	
		$params['dateupdated '] = UTCDATETIME;
		$this->db->where('id', $id);
		$this->db->update('landingpage', $params);		
	
		return true;
	}
	
}