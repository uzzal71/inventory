<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer_model extends CI_Model {

	// get customer
	public function get_customer() {
		$query = $this->db->select('*')
						  ->from('customers')
						  ->order_by('customerID', 'desc')
						  ->get()
						  ->result_array();
		return $query;
	}
}