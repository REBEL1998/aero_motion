<?php 

class Model_attched extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function insertAttchedFile($data = []) 
	{	
		$flagInsert = $this->db->insert('imgvideodocs', $data);
		if( $flagInsert ) {
			$insertId = $this->db->insert_id();
			return $insertId;
		}
		else {
			return false;
		}
	}
	
	public function getAttchedList($arrParams = []) 
	{
		$this->db->select([
			'i.id as recId',
			'i.relatedid as imgId',
			'i.typex as typex',
			'i.parentcode as parentCode',
			'i.code as code',
			'i.filename as fileName'
		]);
		$this->db->from('imgvideodocs as i');
		$this->db->where('i.flagdelete = ', 'N');
		$this->db->order_by('i.id', 'DESC');
		
		if(!empty($arrParams)){
			foreach ( $arrParams as $key => $value ) {
				switch( strtoupper($key) ){
					case "PRODID" :
						if ( !empty($value) ) {
							$this->db->where('i.relatedid = ', $value);
						}	
					break;
					case "TYPEX" :
						if ( !empty($value) ) {
							$this->db->where('i.typex = ', $value);
						}	
					break;
				}
			}
		}	
		
		$query=$this->db->get()->result_array(); 
		
		return $query;
	}
	
	//deleteImage
	
	public function deleteAttchedImage($recId = null) {
		
		/*first get file name based on categoryid*/
		$arrParams = [
			'RECID' => $recId,
		];
		$arrRslt = $this->getAttchedList($arrParams);
		$prodImageName = $arrRslt[0]['fileName'];
		
		if(is_file(FCPATH.'assets\admin\uploads\product\\'.$prodImageName) == true){
			
			unlink(FCPATH.'assets\admin\uploads\product\\'.$prodImageName);
		}
		
		$this->db->set('filename', '');
		$this->db->set('flagdelete','Y');
		$this->db->where('id', $recId);
		$update = $this->db->update('imgvideodocs');
		return ($update == true) ? $arrRslt[0]['imgId'] : false;
	}
}