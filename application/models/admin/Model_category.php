<?php 

class Model_category extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getCategoryList($catId = null,$flagList = false) 
	{
		
		$this->db->select('c.*');
		$this->db->from('category as c');
		$this->db->where('flagdelete != ', 'D');
		$this->db->order_by('id', 'DESC');
		
		if(isset($catId) && $catId != '' && $flagList == false){
			$this->db->where('id = ', $catId);
		}
		else if (isset($catId) && $catId != '' && $flagList == true){
			$this->db->where('parentid = ', $catId);
			$this->db->where('level = ', '2');
		}
		// else{
		// 	$this->db->where('level = ', '1');
		// }
		
		$query=$this->db->get()->result_array(); 
		
		
		return $query;
	}

	public function create($data)
	{
		$flagInsert = $this->db->insert('category', $data);
		if( $flagInsert ) {
			$insertId = $this->db->insert_id();
			$urlKey = strtolower(preg_replace('/[^a-zA-Z0-9_.]/', '_', $data['name']) . '_' . $insertId);
			
			$this->db->where('id', $insertId);
			$flagUpdate = $this->db->update('category', array('url_key' => $urlKey ));
			
			return $insertId;
		}
		else {
			return false;
		}
	}

	public function edit($data = array(), $id = null)
	{
		
		$this->db->where('id', $id);
		$update = $this->db->update('category', $data);

		return $update;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->update('category', array('rmdate' => UTCDATE, 'flagdelete' => 'D'));
		return ($delete == true) ? true : false;
	}
	
	public function changeStatus($id)
	{
	
		$this->db->set('status', 'IF(status = "Y", "N", "Y")', FALSE);
		
		$this->db->where('id', $id);
		$delete = $this->db->update('category');
		return ($delete == true) ? true : false;
	}
		
	public function updateCategoryImageName($catid = null, $imgName = null) {
		
		$this->db->set('imagename', $imgName);
		
		$this->db->where('id', $catid);
		$update = $this->db->update('category');
		return ($update == true) ? true : false;
	}
	
	//deleteImage
	
	public function deleteCategoryImage($catid = null) {
		
		/*first get file name based on categoryid*/
		
		$arrRslt = $this->getCategoryList($catid);
		
		$catImageName = $arrRslt[0]['imagename'];
		

		if(is_file(FCPATH.'assets\sysimagedocs\\'.$catImageName) == true){
			
			unlink(FCPATH.'assets\sysimagedocs\\'.$catImageName);
		}
		
		$this->db->set('imagename', '');
		
		$this->db->where('id', $catid);
		$update = $this->db->update('category');
		return ($update == true) ? true : false;
	}
	
	public function getChildCategoryList($catIds = array()) 
	{
		if( !is_array($catIds) ) {
			$catIds = array();
		}
		$this->db->select('c.*');
		$this->db->from('category as c');
		$this->db->where('flagdelete != ', 'D');
		$this->db->order_by('name', 'DESC');
		$this->db->where('level = ', '2');
		
		if( !empty($catIds) ){
			$this->db->where_in('c.id', $catIds);
		}
		
		return $this->db->get()->result_array(); 
	}
	
	public function getLevelWiseCategory() 
	{
		$arrReturn  = array();
		
		$this->db->select('c.*');
		$this->db->from('category as c');
		$this->db->where('flagdelete != ', 'D');
		$this->db->order_by('id', 'asc');
		
		$arrResult = $this->db->get()->result_array(); 
		if( !empty($arrResult) ) {
			foreach( $arrResult as $key => $val ){
				if( !empty($val['parentid']) && $val['parentid'] != '0' ){
					$arrReturn[$val['parentid']]['SUBCAT'][$val['id']] = $val;
				}
				else {
					$arrReturn[$val['id']] = $val;
					$arrReturn[$val['id']]['SUBCAT'] = array();
				}
			}
		}
		return $arrReturn;
	}
	
	
	public function get_cat_by_urlkey($urlKey) 
	{
		$arrReturn  = array();
		
		$this->db->select('c.*');
		$this->db->from('category as c');
		$this->db->where('flagdelete != ', 'D');
		$this->db->where('url_key = ', $urlKey);
		$this->db->order_by('id', 'asc');
		$result = $this->db->get();
		if( $result->num_rows() ) {
			return $result->result_array()[0];
		}
		
		return false;
	}
	
	
}