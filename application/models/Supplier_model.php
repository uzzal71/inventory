<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Supplier_model extends CI_Model {

	// get employee
	public function get_supplier() {
		$query = $this->db->select('*')
						  ->from('suppliers')
						  ->order_by('supplierID', 'desc')
						  ->get()
						  ->result_array();
		return $query;
	}
}