<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Employee_model extends CI_Model {

	// get employee
	public function get_employee() {
		$query = $this->db->select('*')
						  ->from('employees')
						  ->order_by('employeeID', 'desc')
						  ->get()
						  ->result_array();
		return $query;
	}
}