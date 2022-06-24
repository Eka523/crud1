<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Query extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set('Asia/Jakarta');
	}

	public function getData($select = NULL, $from = NULL, $where = NULL , $join = NULL) 
	{
		if($select) { $this->db->select($select); }
		if($from) { $this->db->from($from); }
		if($where) { $this->db->where($where); }
		if($join) { $this->db->join($join['table'], $join['key'], $join['type']); }
		return $this->db->get();
	}

	public function dataComplete($select = NULL, $table = NULL, $limit = NULL, $like = NULL, $order = NULL, $join = NULL, $where = NULL, $where2 = NULL, $group_by = NULL, $order_by = NULL) 
	{
		$this->db->select($select);
		$this->db->from($table);
		
		if($join) {
			for($i = 0; $i < sizeof($join['data']); $i++) {
				$this->db->join($join['data'][$i]['table'], $join['data'][$i]['key'], $join['data'][$i]['type']);
			}
		}

		if($where) {
         for($i = 0; $i < sizeof($where['data']); $i++) { 
            $this->db->where($where['data'][$i]['column'], $where['data'][$i]['param']);
         }
     	}

     	if($where2) {
         $this->db->where($where2);
     	}

     	if($like) {
         for($i = 0; $i < sizeof($like['data']); $i++) { 
            $this->db->like('CONCAT_WS(" ", '.$like['data'][$i]['column'].')', $like['data'][$i]['param']);
         }
     	}

     	if($limit) {
         $this->db->limit($limit['finish'], $limit['start']);
     	}

     	if($order) {
         for($i = 0; $i < sizeof($order['data']); $i++) { 
            $this->db->order_by($order['data'][$i]['column'], $order['data'][$i]['type']);
         }
     	}

     	if($group_by) {
         $this->db->group_by($group_by);
     	}

     	if($order_by) {
     		$this->db->order_by($order_by);
     	}
	        
     	$query = $this->db->get();
     	if($query->num_rows() > 0) {
         return $query;
     	} else {
         return FALSE;
     	}
	}

	public function insertID($table, $where, $data) 
	{
     	if($where) {
         for($i = 0; $i < sizeof($where['data']); $i++) { 
            $this->db->where($where['data'][$i]['column'], $where['data'][$i]['param']);
         }
     	}

     	$this->db->insert($table, $data);
		$error  = $this->db->error();
		$result = new stdclass();

     	if($this->db->affected_rows() > 0 OR $error['code'] == 0) {
         $result->status = TRUE;
         $result->output = $this->db->insert_id();
     	} else {
         $result->status = FALSE;
         $result->output = $error['code'].': '.$error['message'];
     	}

     	return $result;
   }

	public function insert($table, $data) 
	{
		$this->db->insert($table, $data);
		if($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function update($table, $data) 
	{
		$this->db->where($table['column'], $table['param']);
		$this->db->update($table['table'], $data);
		if($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

	public function delete($table, $where) 
	{
		
		$this->db->delete($table, $where);
		if ($this->db->affected_rows() > 0) {
			return TRUE;
		} else {
			return FALSE;
		}
	}

}

/* End of file Query.php */
/* Location: ./application/models/Query.php */