<?php

class Model_user extends CI_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    public function getUserList($userId = null)
    {

        $this->db->select('u.*');
        $this->db->from('users as u');
		$this->db->where('flagdelete != ', 'D');
        $this->db->order_by('id', 'DESC');

        if (isset($userId) && $userId != '') {
            $this->db->where('id = ', $userId);
        }

        $query = $this->db->get()->result_array();

        return $query;
    }

    public function create($data)
    {
        $flagInsert = $this->db->insert('users', $data);
        if ($flagInsert) {
            $insertId = $this->db->insert_id();

            return $insertId;
        } else {
            return false;
        }
    }

    public function edit($data = array(), $id = null)
    {

        $this->db->where('id', $id);
        $update = $this->db->update('users', $data);

        return $update;
    }

    public function delete($id){
        $this->db->where('id', $id);
        $delete = $this->db->update('users', array('rmdate' => UTCDATE, 'flagdelete' => 'D'));
        return ($delete == true) ? true : false;
    }

	public function changeStatus($id)
	{
		$this->db->set('status', 'IF(status = "Y", "N", "Y")', FALSE);
		$this->db->where('id', $id);
		$status = $this->db->update('users');
		return ($status == true) ? true : false;
	}

}
