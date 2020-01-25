<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Purchase_model extends CI_Model {

	// get customer
	public function get_purchase() {
		$query = $this->db->select('purchase.*, supplierName')
						  ->from('purchase')
						  ->join('suppliers', 'suppliers.supplierID = purchase.supplier', 'left')
						  ->order_by('purchaseID', 'desc')
						  ->get()
						  ->result_array();
		return $query;
	}

	// get challan
	public function get_challan($id) {
		$query = $this->db->select('challanNo')
						  ->from('purchase')
						  ->where('purchaseID', $id)
						  ->get()
						  ->row();
		return $query->challanNo;
	}

	// get note text
	public function get_note($id) {
		$query = $this->db->select('note')
						  ->from('purchase')
						  ->where('purchaseID', $id)
						  ->get()
						  ->row();
		return $query->note;
	}

	// get all company
	public function get_companys() {
		$query = $this->db->select('*')
						  ->from('com_profile')
						  ->get()
						  ->result_array();
		return $query;
	}
}