<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class AccountBalance extends CI_Controller {

public function __construct() {
    parent::__construct();
    $this->load->model("prime_model","pm");
    //$this->checkPermission();
}

public function transactions_list()
    {
    $data['title'] = 'Transactions List';
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

            $data['sale'] = $this->pm->get_dallsales_data($sdate,$edate);
            $data['purchase'] = $this->pm->get_dall_purchases_data($sdate,$edate);
            $data['empp'] = $this->pm->get_dall_emp_payments_data($sdate,$edate);
            $data['return'] = $this->pm->get_dall_returns_data($sdate,$edate);
            $data['voucher'] = $this->pm->get_dall_vouchers_data($sdate,$edate);
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

            $data['sale'] = $this->pm->get_mallsales_data($month,$year);
            $data['purchase'] = $this->pm->get_mall_purchases_data($month,$year);
            $data['empp'] = $this->pm->get_mall_emp_payments_data($month,$year);
            $data['return'] = $this->pm->get_mall_returns_data($month,$year);
            $data['voucher'] = $this->pm->get_mall_vouchers_data($month,$year);
            }
        else if ($report == 'yearlyReports')
            {
            $year = $_GET['ryear'];
            $data['year'] = $year;
            $data['report'] = $report;

            $data['sale'] = $this->pm->get_yallsales_data($year);
            $data['purchase'] = $this->pm->get_yall_purchases_data($year);
            $data['empp'] = $this->pm->get_yall_emp_payments_data($year);
            $data['return'] = $this->pm->get_yall_returns_data($year);
            $data['voucher'] = $this->pm->get_yall_vouchers_data($year);
            }
        }
    else
        {
        $data['sale'] = $this->pm->get_all_sales_data();
        $data['purchase'] = $this->pm->get_all_purchases_data();
        $data['empp'] = $this->pm->get_all_emp_payments_data();
        $data['return'] = $this->pm->get_all_returns_data();
        $data['voucher'] = $this->pm->get_all_vouchers_data();
    //var_dump($data['damage']); exit();
        }

    $data['content'] = $this->load->view('accountBalance/transactions_list',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}






}