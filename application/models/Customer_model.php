<?php 

class Customer_model extends CI_Model
{
	public function __construct()
	{
		parent::__construct();
	}

	public function get_users($params = array()) 
	{
		
		$this->db->select('c.*');
		$this->db->from('customer c');
		$this->db->where('c.flagdelete !=', 'D');
		
		foreach( $params as $key => $val ) {
			switch(strtoupper($key)){
				case "USERID":
					$this->db->where('c.id', $val);
					break;
					
				case "EMAIL":
					$this->db->where('c.email', $val);
					break;
					
			}
		}
		
		$result = $this->db->get();
		
		if( !empty($params['flagCount']) ) {
			return $result->num_rows();
		}
		
		return $result->result_array();
	}

	public function validate_otp($params = array()) 
	{
	
		$this->db->select('c.id');
		$this->db->from('email_otp c');
		$this->db->where('c.email', $params['email']);
		$this->db->where('c.otp', $params['otp']);
		$this->db->where('c.flagdelete !=', 'D');
		
		$result = $this->db->get();
		
		if( $result->num_rows() > 0 ){
			
			$this->remove_otp($params);
			return true;
			
		}
		else {
			return false;
		}
	}

	public function create($data)
	{

		$flagInsert = $this->db->insert('customer', $data);
		if( $flagInsert ) {
			$userId = $this->db->insert_id();
			
			$user = $this->get_users(array("USERID" => $userId));
			$this->session->set_userdata('login_id', $user[0]);
			
			return $userId;
		}
		else {
			return false;
		}
	}
	
	public function insert_otp($data)
	{
		$this->remove_otp($data);
		
		$data['dateadded'] = UTCDATETIME;
		$flagInsert = $this->db->insert('email_otp', $data);
		if( $flagInsert ) {
			return $this->db->insert_id();
		}
		else {
			return false;
		}
	}
	
	public function remove_otp($data)
	{
		
		// remove previous otp before insert new one
		$this->db->where('email', $data['email']);
		$this->db->update('email_otp', array('rmdate' => UTCDATE, 'flagdelete' => 'D'  ));
		
		return true;
	}
	
	public function update_cutomer($data, $id)
	{
		
		// remove previous otp before insert new one
		$this->db->where('id', $id);
		$this->db->update('customer', $data);
		
		return true;
	}
	
	public function login($data)
	{
		
		$user = $this->get_users(array("EMAIL" => $data['email']));
		
		if( !empty($user) && !empty($user[0]) ) {
			if (password_verify($data['password'], $user[0]['password'])) {
				$this->session->set_userdata('login_id', $user[0]);
				return true;
			} 
		}
		
		return false;
	}
	
	

}