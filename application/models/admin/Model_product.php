<?php 

class Model_product extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function getProductList($prodId = null, $arrParams = []) 
	{
		
		$this->db->select([
			'c.name as catName',
			'p.catId as catId',
			'p.id as prodId',
			'p.name as prodName',
			'p.desc as prodDesc',
			'p.title as prodTitle',
			'p.flagstatus as prodStatus',
			'p.dateadded as prodDate',
			'p.specification',
			'p.productImage',
		]);
		$this->db->from('product as p');
		$this->db->join('category c', 'c.id = p.catid');
		$this->db->where('p.flagdeleted = ', Null);
		$this->db->order_by('p.id', 'DESC');

		if(isset($prodId) && $prodId != ''){
			$this->db->where('p.id = ', $prodId);	
		}

		foreach ( $arrParams as $key => $value ) {
			switch( strtoupper($key) ){
				case "CATID" :
					if ( !empty($value) ) {
						$this->db->where('p.catId = ', $value);
					}	
				break;
				case "PRODUCTID" :
					if ( !empty($value) ) {
						$this->db->where('p.id = ', $value);
					}	
				break;
			}
		}
		
		$query=$this->db->get()->result_array(); 
		
		return $query;
	}

	public function create($data)
	{
		$flagInsert = $this->db->insert('product', $data);
	
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
		$update = $this->db->update('product', $data);

		return $update;
	}

	public function delete($id)
	{
		$this->db->where('id', $id);
		$delete = $this->db->update('product', array('flagdeleted' => UTCDATETIME));
		return ($delete == true) ? true : false;
	}
	
	public function changeStatus($id)
	{
	
		$this->db->set('flagstatus ', 'IF(flagstatus  = "Y", "N", "Y")', FALSE);
		
		$this->db->where('id', $id);
		$delete = $this->db->update('product');
		return ($delete == true) ? true : false;
	}
	
	public function updateProductImageName($catid = null, $imgName = null) {
		
		$this->db->set('productImage', $imgName);
		
		$this->db->where('id', $catid);
		$update = $this->db->update('product');
		return ($update == true) ? true : false;
	}
	
	//deleteImage
	
	public function deleteproductImage($prodId = null) {
		
		/*first get file name based on categoryid*/
		
		$arrRslt = $this->getProductList($prodId);
		
		$prodImageName = $arrRslt[0]['productImage'];
		
		if(is_file(FCPATH.'assets\admin\uploads\product\\'.$prodImageName) == true){
			
			unlink(FCPATH.'assets\admin\uploads\product\\'.$prodImageName);
		}
		
		$this->db->set('productImage', '');
		
		$this->db->where('id', $prodId);
		$update = $this->db->update('product');
		return ($update == true) ? true : false;
	}
}