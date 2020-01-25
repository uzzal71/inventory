<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Voucher extends CI_Controller {

public function __construct()
    {
    parent::__construct();
    $this->load->model("prime_model","pm");
    $this->checkPermission();
}

public function index()
    {
    $data['title'] = 'Voucher';

    $other = array(
        'order_by' => 'vuid'
            );

    $data['vaucher'] = $this->pm->get_data('vaucher',false,false,false,$other);
//var_dump($data); exit();
    $data['content'] = $this->load->view('vouchers/voucher',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function new_voucher()
    {
    $data['title'] = 'Voucher';
    
    $data['customer'] = $this->pm->get_data('customers',false);
    $data['emp'] = $this->pm->get_data('employees',false);
    $data['costType'] = $this->pm->get_data('cost_type',false);
    $data['supplier'] = $this->pm->get_data('suppliers',false);
    $data['company'] = $this->pm->get_data('companys',false);

//var_dump($data['emp']); exit();
    $data['content'] = $this->load->view('vouchers/addvoucher',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function save_voucher()
    {
    $info = $this->input->post();
    //echo '<pre>';print_r($info);exit();
    $data = array(
        'voucherdate' => date('Y-m-d',strtotime($info['date'])),
        'company'     => $_SESSION['company'],
        'customerID'  => $info['customerID'],
        'invoice'     => $info['invoice'],
        'employee'    => $info['employee'],
        'costType'    => $info['costType'],
        'supplier'    => $info['supplier'],
        'vauchertype' => $info['vaucher'],
        'accountType' => $info['accountType'],
        'accountNo'   => $info['accountNo'],
        'totalamount' => array_sum($info['amount']),
        'regby'       => $this->session->userdata('admin_id')
    );

    if($data['vauchertype'] == 'Customer Pay' OR $data['vauchertype'] == 'Credit Voucher') {
        $payment_balance = $data['totalamount'];
    $current_due = $this->pm->get_exist_balance($data['customerID']);
    $balance = $current_due-$payment_balance;

    $data_array = array('balance' => $balance);
    $this->db->where('customerID', $data['customerID']);
    $this->db->update('customers', $data_array);
    }
    
    $result = $this->pm->insert_data('vaucher',$data);
//var_dump($vid); exit();
    $length = count($this->input->post('amount'));
//var_dump($length); exit();
    for ($i = 0; $i < $length; $i++)
        {
        $partdata = array(
            'vuid'        => $result,
            'particulars' => $this->input->post('particular')[$i],
            'amount'      => $this->input->post('amount')[$i],
            'regby'       => $this->session->userdata('admin_id')
                );
    //var_dump($partdata);    
        $cPrimary = $this->pm->insert_data('vaucher_particular',$partdata); 
        }

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Voucher Sale Successfully !</h4>
            </div>'
                ];  
        }
    else
        {
        $sdata = [
          'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> Failed !</h4>
            </div>'
                ];
        }
    $this->session->set_userdata($sdata);
    redirect('Voucher');
}

public function voucher_details($id)
    {
    $data['title'] = 'Voucher';

    $data['voucher'] = $this->pm->get_voucher($id);
//var_dump($data['voucher']);
    $where = array(
        'vuid' => $id
            );

    $data['voucherp'] = $this->pm->get_data('vaucher_particular',$where);
    $data['company'] = $this->pm->company_details();
//var_dump($data['voucherp']); exit();
    $data['content'] = $this->load->view('vouchers/viewvoucher',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function voucher_edit($id)
    {
    $data['title'] = 'Voucher';

    $data['customers'] = $this->pm->get_data('customers',false);
    $data['emp'] = $this->pm->get_data('employees',false);
    $data['costType'] = $this->pm->get_data('cost_type',false);
    $data['supplier'] = $this->pm->get_data('suppliers',false);
    $data['company'] = $this->pm->get_data('companys',false);

    $data['voucher'] = $this->pm->get_voucher($id);

    $where = array(
        'vuid' => $id
            );

    $data['voucherp'] = $this->pm->get_data('vaucher_particular',$where);
//var_dump($data['emp']); exit();
    $data['content'] = $this->load->view('vouchers/editvoucher',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function update_voucher()
    {
    $info = $this->input->post();

    $where = array(
        'vuid' => $info['vuid']
            );
    
    if($info['vauchertype'] == 'Credit Voucher')
        {
        $cust = $info['customerID'];
        $invoice = $info['invoice'];
        $emp = 0;
        $ct = 0;
        $sup = 0;
        }
    else if($info['vauchertype'] == "Customer Pay")
        {
            $cust = $info['customerID'];
            $invoice = 0;
            $emp = 0;
            $ct = 0;
            $sup = 0;
        }
    else if($info['vauchertype'] == 'Debit Voucher')
        {
        $cust = 0;
        $invoice = 0;
        $emp = $info['employee'];
        $ct = $info['costType'];
        $sup = 0;
        }
    else if($info['vauchertype'] == 'Supplier Pay')
        {
        $cust = 0;
        $invoice = 0;
        $emp = 0;
        $ct = 0;
        $sup = $info['supplier'];
        }
    else
        {
        $cust = 0;
        $invoice = 0;
        $emp = 0;
        $ct = 0;
        $sup = 0;
        }
    
    $data = array(
        'voucherdate' => date('Y-m-d',strtotime($info['date'])),
        'company'     => $_SESSION['company'],
        'customerID'  => $cust,
        'invoice'     => $invoice,
        'employee'    => $emp,
        'costType'    => $ct,
        'supplier'    => $sup,
        'vauchertype' => $info['vauchertype'],
        'totalamount' => array_sum($info['amount']),
        'accountType' => $info['accountType'],
        'accountNo'   => $info['accountNo'],
        'upby'        => $this->session->userdata('admin_id')
    );

    $sdata = array(
        'exits_amount' => array_sum($info['exits_amount'])
    );

    $new_balance = $data['totalamount'];
    $old_balance = $sdata['exits_amount'];
    $current_due = $this->pm->get_exist_balance($data['customerID']);
    
    if($new_balance > $old_balance){
        $payment_balance = $new_balance - $old_balance;
        $balance = $current_due+$payment_balance;
    }else if($new_balance < $old_balance){
        $payment_balance = $old_balance - $new_balance;
        $balance = $current_due-$payment_balance;
    }else {
        $balance = $current_due;   
    }
    

    $data_array = array('balance' => $balance);
    $this->db->where('customerID', $data['customerID']);
    $this->db->update('customers', $data_array);
    
    $result = $this->pm->update_data('vaucher',$data,$where);
//var_dump($vid); exit();
    $this->pm->delete_data('vaucher_particular',$where);

    $length = count($this->input->post('amount'));
//var_dump($length); exit();
    for ($i = 0; $i < $length; $i++)
        {
        $partdata = array(
            'vuid'        => $info['vuid'],
            'particulars' => $this->input->post('particular')[$i],
            'amount'      => $this->input->post('amount')[$i],
            'upby'        => $this->session->userdata('admin_id')
                );
    //var_dump($partdata);    
        $cPrimary = $this->pm->insert_data('vaucher_particular',$partdata);
        }

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Voucher update Successfully !</h4>
            </div>'
                ];  
        }
    else
        {
        $sdata = [
          'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> Failed !</h4>
            </div>'
                ];
        }
    $this->session->set_userdata($sdata);
    redirect('Voucher');
}

public function voucher_delete($id)
    {
    $where = array(
        'vuid' => $id
            );

    $info = $this->pm->get_amount_and_employee_voucher($id);

    $return_balance = $info->totalamount;
    $current_due = $this->pm->get_exist_balance($info->customerID);
    $balance = $current_due+$return_balance;

    $data_array = array('balance' => $balance);
    $this->db->where('customerID', $info->customerID);
    $this->db->update('customers', $data_array);
    
    $result = $this->pm->delete_data('vaucher',$where);

    $this->pm->delete_data('vaucher_particular',$where);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Voucher delete Successfully !</h4>
            </div>'
                ];  
        }
    else
        {
        $sdata = [
          'exception' =>'<div class="alert alert-danger alert-dismissible">
            <h4><i class="icon fa fa-ban"></i> Failed !</h4>
            </div>'
                ];
        }
    $this->session->set_userdata($sdata);
    redirect('Voucher');
}

public function voucher_report()
    {
    $data = [
        'title' => 'Voucher Report'
            ];
    $data['company'] = $this->pm->company_details();

    if(isset($_GET['search']))
        {
        $report = $_GET['reports'];
        
        if($report == 'dailyReports')
            {
            $sdate = date("Y-m-d", strtotime($_GET['sdate']));
            $edate = date("Y-m-d", strtotime($_GET['edate']));
            $data['sdate'] = $sdate;
            $data['edate'] = $edate;
            $data['report'] = $report;

            $vtype = $_GET['dvtype'];

            $data['voucher'] = $this->pm->get_dall_voucher_data($sdate,$edate,$vtype);
            }
        else if ($report == 'monthlyReports')
            {
            $month = $_GET['month'];
            $data['month'] = $month;
            $year = $_GET['year'];
            $data['year'] = $year;
    //var_dump($data['month']); exit();
            if($month == 01)
                {
                $name = 'January';
                }
            elseif ($month == 02)
                {
                $name = 'February';
                }
            elseif ($month == 03)
                {
                $name = 'March';
                }
            elseif ($month == 04)
                {
                $name = 'April';
                }
            elseif ($month == 05)
                {
                $name = 'May';
                }
            elseif ($month == 06)
                {
                $name = 'June';
                }
            elseif ($month == 07)
                {
                $name = 'July';
                }
            elseif ($month == 8)
                {
                $name = 'August';
                }
            elseif ($month == 9)
                {
                $name = 'September';
                }
            elseif ($month == 10)
                {
                $name = 'October';
                }
            elseif ($month == 11)
                {
                $name = 'November';
                }
            else
                {
                $name = 'December';
                }
            $data['name'] = $name;
            $data['report'] = $report;

            $vtype = $_GET['mvtype'];

            $data['voucher'] = $this->pm->get_mall_voucher_data($month,$year,$vtype);
            }
        else if ($report == 'yearlyReports')
            {
            $year = $_GET['ryear'];
            $data['year'] = $year;
            $data['report'] = $report;

            $vtype = $_GET['yvtype'];

            $data['voucher'] = $this->pm->get_yall_voucher_data($year,$vtype);
            }
        }
    else
        {
        $data['voucher'] = $this->pm->get_voucher_data();
        }

    $data['content'] = $this->load->view('vouchers/voucher_reports',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function profit_loss()
    {
    $data['title'] = 'Profit Loss';

    if(isset($_GET['search']))
        {
        $report = $_GET['reports'];
        
        if($report == 'dailyReports')
            {
            $sdate = date("Y-m-d", strtotime($_GET['sdate']));
            $edate = date("Y-m-d", strtotime($_GET['edate']));
            $data['sdate'] = $sdate;
            $data['edate'] = $edate;
            $data['report'] = $report;

            $data['sale'] = $this->pm->total_dsales_amount($sdate,$edate);
            $data['purchase'] = $this->pm->total_dpurchases_amount($sdate,$edate);
            $data['empp'] = $this->pm->total_demp_payments_amount($sdate,$edate);
            $data['return'] = $this->pm->total_dreturns_amount($sdate,$edate);
            $data['cvoucher'] = $this->pm->total_dcvoucher_amount($sdate,$edate);
            $data['dvoucher'] = $this->pm->total_ddvoucher_amount($sdate,$edate);
            $data['cusvoucher'] = $this->pm->total_dcusvoucher_amount($sdate,$edate);
            $data['svoucher'] = $this->pm->total_dsvoucher_amount($sdate,$edate);
            }
        else if ($report == 'monthlyReports')
            {
            $month = $_GET['month'];
            $data['month'] = $month;
            $year = $_GET['year'];
            $data['year'] = $year;
    //var_dump($data['month']); exit();
            if($month == 01)
                {
                $name = 'January';
                }
            elseif ($month == 02)
                {
                $name = 'February';
                }
            elseif ($month == 03)
                {
                $name = 'March';
                }
            elseif ($month == 04)
                {
                $name = 'April';
                }
            elseif ($month == 05)
                {
                $name = 'May';
                }
            elseif ($month == 06)
                {
                $name = 'June';
                }
            elseif ($month == 07)
                {
                $name = 'July';
                }
            elseif ($month == 8)
                {
                $name = 'August';
                }
            elseif ($month == 9)
                {
                $name = 'September';
                }
            elseif ($month == 10)
                {
                $name = 'October';
                }
            elseif ($month == 11)
                {
                $name = 'November';
                }
            else
                {
                $name = 'December';
                }
            $data['name'] = $name;
            $data['report'] = $report;

            $data['sale'] = $this->pm->total_msales_amount($month,$year);
            $data['purchase'] = $this->pm->total_mpurchases_amount($month,$year);
            $data['empp'] = $this->pm->total_memp_payments_amount($month,$year);
            $data['return'] = $this->pm->total_mreturns_amount($month,$year);
            $data['cvoucher'] = $this->pm->total_mcvoucher_amount($month,$year);
            $data['dvoucher'] = $this->pm->total_mdvoucher_amount($month,$year);
            $data['cusvoucher'] = $this->pm->total_mcusvoucher_amount($month,$year);
            $data['svoucher'] = $this->pm->total_msvoucher_amount($month,$year);
            }
        else if ($report == 'yearlyReports')
            {
            $year = $_GET['ryear'];
            $data['year'] = $year;
            $data['report'] = $report;

            $data['sale'] = $this->pm->total_ysales_amount($year);
            $data['purchase'] = $this->pm->total_ypurchases_amount($year);
            $data['empp'] = $this->pm->total_yemp_payments_amount($year);
            $data['return'] = $this->pm->total_yreturns_amount($year);
            $data['cvoucher'] = $this->pm->total_ycvoucher_amount($year);
            $data['dvoucher'] = $this->pm->total_ydvoucher_amount($year);
            $data['cusvoucher'] = $this->pm->total_ycusvoucher_amount($year);
            $data['svoucher'] = $this->pm->total_ysvoucher_amount($year);
            }
        }
    else
        {
        $data['sale'] = $this->pm->total_salesamount();
        $data['purchase'] = $this->pm->total_purchasesamount();
        $data['empp'] = $this->pm->total_emp_payments_amount();
        $data['return'] = $this->pm->total_returns_amount();
        $data['cvoucher'] = $this->pm->total_cvoucher_amount();
        $data['dvoucher'] = $this->pm->total_dvoucher_amount();
        $data['cusvoucher'] = $this->pm->total_cusvoucher_amount();
        $data['svoucher'] = $this->pm->total_svoucher_amount();
    //var_dump($data['sale']); exit();
        }
    $data['company'] = $this->pm->company_details();

    $data['content'] = $this->load->view('vouchers/profit_loss',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}







}