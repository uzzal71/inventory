<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Home extends CI_Controller {

public function __construct()
    {
    parent::__construct();
    $this->load->model("prime_model",'pm');       
    $this->checkPermission();
}

public function index()
    {
    $data['title'] = 'Dashboard';
    
    $data['tproduct'] = $this->pm->count_all('products');
    $data['tpurchase'] = $this->pm->total_purchase_amount();
    $data['tsales'] = $this->pm->total_sale_amount();
    $data['tuotation'] = $this->pm->count_all('quotation');
    $data['temployee'] = $this->pm->count_all('employees');
    $data['tcustomer'] = $this->pm->count_all('customers');

    $data['tba'] = $this->pm->total_bank_amount();
    $data['tpba'] = $this->pm->total_pbank_amount();
    $data['tsba'] = $this->pm->total_sbank_amount();
    $data['trba'] = $this->pm->total_rbank_amount();
    $data['tcvba'] = $this->pm->total_cvbank_amount();
    $data['tdvba'] = $this->pm->total_dvbank_amount();
    $data['tspvba'] = $this->pm->total_spvbank_amount();
    $data['tcpvba'] = $this->pm->total_cpvbank_amount();
    $data['tempba'] = $this->pm->total_empbank_amount();
    
    $data['tca'] = $this->pm->total_cash_amount();
    $data['tpca'] = $this->pm->total_pcash_amount();
    $data['tsca'] = $this->pm->total_scash_amount();
    $data['trca'] = $this->pm->total_rcash_amount();
    $data['tcvca'] = $this->pm->total_cvcash_amount();
    $data['tdvca'] = $this->pm->total_dvcash_amount();
    $data['tspvca'] = $this->pm->total_spvcash_amount();
    $data['tcpvca'] = $this->pm->total_cpvcash_amount();
    $data['tempca'] = $this->pm->total_empcash_amount();
    
// var_dump($data['tdca']); exit();

    $data['tma'] = $this->pm->total_mobile_amount();
    $data['tpma'] = $this->pm->total_pmobile_amount();
    $data['tsma'] = $this->pm->total_smobile_amount();
    $data['trma'] = $this->pm->total_rmobile_amount();
    $data['tcvma'] = $this->pm->total_cvmobile_amount();
    $data['tdvma'] = $this->pm->total_dvmobile_amount();
    $data['tspvma'] = $this->pm->total_spvmobile_amount();
    $data['tcpvma'] = $this->pm->total_cpvmobile_amount();
    $data['tempma'] = $this->pm->total_empmobile_amount();
    
    $data['content']=$this->load->view('home', $data,true);
    $this->load->view('themes/adminlte',$data);
}





}