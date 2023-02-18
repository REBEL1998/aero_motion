<?php 

class Model_customer extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getCustomerList($custId = null) 
	{
		
		$this->db->select('c.*');
		$this->db->from('customer as c');
		$this->db->where('flagdelete != ', 'D');
		$this->db->order_by('id', 'DESC');
		
		if(isset($custId) && $custId != ''){
			$this->db->where('id = ', $custId);
		}
		
		$query=$this->db->get()->result_array(); 
		
		return $query;
	}

	public function create($data)
	{ 
		$flagInsert = $this->db->insert('customer', $data);
		if( $flagInsert ) {
			$insertId = $this->db->insert_id();
			
			return $insertId;
		}
		else {
			return false;
		}
	}

	public function edit($data = array(), $id = null)
	{
		
		$this->db->where('id', $id);
		$update = $this->db->update('customer', $data);

		return $update;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->update('customer', array('rmdate' => UTCDATE, 'flagdelete' => 'D'));
		return ($delete == true) ? true : false;
	}
	
	public function changeStatus($id)
	{
	
		$this->db->set('status', 'IF(status = "Y", "N", "Y")', FALSE);
		
		$this->db->where('id', $id);
		$delete = $this->db->update('customer');
		return ($delete == true) ? true : false;
	}
	
	public function getSubCategoryCount($catid)
	{
	
		/*NOW CHECK IF ANY SUB LEVEL PRESENT THAN DO NOT DELETE */
		
		$this->db->select('COUNT(*)');
		$this->db->from('category as c');
		$this->db->where('flagdelete != ', 'D');
		$this->db->where('parentid = ', $catid);
		$this->db->where('level = ', '2');
		
		$query=$this->db->get()->row_array(); 
		$rec_cnt = $query['COUNT(*)'];
		
		return $rec_cnt;
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
	
}