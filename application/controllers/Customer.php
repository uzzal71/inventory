<?php
if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customer extends CI_Controller {

public function __construct()
    {
    parent::__construct();
    $this->load->model("prime_model","pm");
    $this->load->model("customer_model","customer");
    //$this->checkPermission();
}

public function index()
    {
    $data['title'] = 'Customer';
    $data['customers'] = $this->customer->get_customer();
    $data['content'] = $this->load->view('customers/customers',$data,TRUE);
    $this->load->view('themes/adminlte', $data);
}

public function save_customer()
    {
    $info = $this->input->post();

    $data = array(
        'customerName' => $info['customerName'],
        'compname'     => $info['compname'],
        'company'      => $_SESSION['company'],
        'mobile'       => $info['mobile'],
        'email'        => $info['email'],
        'address'      => $info['address'],
        'balance'      => $info['balance'],
        'closing_balance'      => $info['balance'],
        'status'       => $info['status'],            
        'regby'        => $this->session->userdata('admin_id')
            );

    $result = $this->pm->insert_data('customers',$data);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Customer add Successfully !</h4>
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
    redirect('Customer');
}

public function get_customer_data()
    {
    $section = $this->pm->get_customer_data($_POST['id']);
//var_dump($section); exit();
    $someJSON = json_encode($section);
    echo $someJSON;
}

public function update_customer()
    {
    $info = $this->input->post();

    $data = array(
        'customerName' => $info['customerName'],
        'compname'     => $info['compname'],
        'company'      => $info['company'],
        'mobile'       => $info['mobile'],
        'email'        => $info['email'],
        'address'      => $info['address'],
        'balance'      => $info['balance'],
        'closing_balance'      => $info['balance'],
        'status'       => $info['status'],              
        'upby'         => $this->session->userdata('admin_id')
            );

    $where = array(
        'customerID' => $info['cus_id']
            );

    $result = $this->pm->update_data('customers',$data,$where);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Customer update Successfully !</h4>
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
    redirect('Customer');
}

public function delete_customer($id)
    {
    $where = array(
        'customerID' => $id
            );

    $result = $this->pm->delete_data('customers',$where);

    if($result)
        {
        $sdata = [
          'exception' =>'<div class="alert alert-success alert-dismissible">
            <h4><i class="icon fa fa-check"></i>Customer delete Successfully !</h4>
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
    redirect('Customer');
}

public function all_customer_reports()
    {
    $data = [
        'title' => 'Customers Report'
            ];

    $data['customer'] = $this->pm->get_data('customers',false);
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
            }
        else if ($report == 'yearlyReports')
            {
            $year = $_GET['ryear'];
            $data['year'] = $year;
            $data['report'] = $report;
            }
        }

    $data['content'] = $this->load->view('customers/customerReport',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function customer_ledger()
    {
    $data = [
        'title' => 'Customers Ledger',
        'cust' => $this->pm->get_data('customers',false)
            ];
    $data['company'] = $this->pm->company_details();

    if(isset($_GET['search']))
        {
        $report = $_GET['reports'];
        
        if($report == 'dailyReports')
            {
            $id = $_GET['dcustomer'];
            $sdate = date("Y-m-d", strtotime($_GET['sdate']));
            $edate = date("Y-m-d", strtotime($_GET['edate']));
            $data['sdate'] = $sdate;
            $data['edate'] = $edate;
            $data['report'] = $report;

            $where = array(
                'customerID' => $id
                    );
            $customer = $this->pm->get_data('customers',$where);
            $data['customer'] = $customer[0];

            $data['sale'] = $this->pm->get_dcustomer_sales_data($id,$sdate,$edate);
            $data['voucher'] = $this->pm->get_dcustomer_vouchers_data($id,$sdate,$edate);
            $data['return'] = $this->pm->get_dcustomer_returns_data($id,$sdate,$edate);
            }
        else if ($report == 'monthlyReports')
            {
            $id = $_GET['mcustomer'];
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

            $where = array(
                'customerID' => $id
                    );
            $customer = $this->pm->get_data('customers',$where);
            $data['customer'] = $customer[0];

            $data['sale'] = $this->pm->get_mcustomer_sales_data($id,$month,$year);
            $data['voucher'] = $this->pm->get_mcustomer_vouchers_data($id,$month,$year);
            $data['return'] = $this->pm->get_mcustomer_returns_data($id,$month,$year);
            }
        else if ($report == 'yearlyReports')
            {
            $id = $_GET['ycustomer'];
            $year = $_GET['ryear'];
            $data['year'] = $year;
            $data['report'] = $report;

            $where = array(
                'customerID' => $id
                    );
            $customer = $this->pm->get_data('customers',$where);
            $data['customer'] = $customer[0];

            $data['sale'] = $this->pm->get_ycustomer_sales_data($id,$year);
            $data['voucher'] = $this->pm->get_ycustomer_vouchers_data($id,$year);
            $data['return'] = $this->pm->get_ycustomer_returns_data($id,$year);
            }
         else
            {
            $id = $_GET['customer'];
            $data['report'] = $report;

            $where = array(
                'customerID' => $id
                    );
            $customer = $this->pm->get_data('customers',$where);
            $data['customer'] = $customer[0];

            $data['sale'] = $this->pm->get_customer_sales_data($id);
            $data['voucher'] = $this->pm->get_customer_vouchers_data($id);
            $data['return'] = $this->pm->get_customer_returns_data($id);
            }
        }

    $data['content'] = $this->load->view('customers/customerLedger',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}

public function customer_reports()
    {
    $data = [
        'title' => 'Customers Sale Report',
        'cust' => $this->pm->get_data('customers',false)
            ];
    $data['company'] = $this->pm->company_details();

    if(isset($_GET['search']))
        {
        $report = $_GET['reports'];
        
        if($report == 'dailyReports')
            {
            $id = $_GET['dcustomer'];
            $sdate = date("Y-m-d", strtotime($_GET['sdate']));
            $edate = date("Y-m-d", strtotime($_GET['edate']));
            $data['sdate'] = $sdate;
            $data['edate'] = $edate;
            $data['report'] = $report;

            $where = array(
                'customerID' => $id
                    );
            $customer = $this->pm->get_data('customers',$where);
            $data['customer'] = $customer[0];

            $data['sale'] = $this->pm->get_dcustomer_sales_data($id,$sdate,$edate);
            $data['cvoucher'] = $this->pm->get_scustomer_cvouchers_data($id,$sdate,$edate);
            $data['dvoucher'] = $this->pm->get_scustomer_dvouchers_data($id,$sdate,$edate);
            $data['return'] = $this->pm->get_scustomer_returns_data($id,$sdate,$edate);

            $data['psale'] = $this->pm->get_pdcustomer_sales_data($id,$sdate);
            $data['pcvoucher'] = $this->pm->get_psdcustomer_cvouchers_data($id,$sdate);
            $data['pdvoucher'] = $this->pm->get_psdcustomer_dvouchers_data($id,$sdate);
            $data['preturn'] = $this->pm->get_psdcustomer_returns_data($id,$sdate);
            }
        else if ($report == 'monthlyReports')
            {
            $id = $_GET['mcustomer'];
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

            $where = array(
                'customerID' => $id
                    );
            $customer = $this->pm->get_data('customers',$where);
            $data['customer'] = $customer[0];

            $data['sale'] = $this->pm->get_mcustomer_sales_data($id,$month,$year);
            $data['cvoucher'] = $this->pm->get_mscustomer_cvouchers_data($id,$month,$year);
            $data['dvoucher'] = $this->pm->get_mscustomer_dvouchers_data($id,$month,$year);
            $data['return'] = $this->pm->get_mscustomer_returns_data($id,$month,$year);

            $data['psale'] = $this->pm->get_pmcustomer_sales_data($id,$month,$year);
            $data['pcvoucher'] = $this->pm->get_pmscustomer_cvouchers_data($id,$month,$year);
            $data['pdvoucher'] = $this->pm->get_pmscustomer_dvouchers_data($id,$month,$year);
            $data['preturn'] = $this->pm->get_pmscustomer_returns_data($id,$month,$year);
            }
        else if ($report == 'yearlyReports')
            {
            $id = $_GET['ycustomer'];
            $year = $_GET['ryear'];
            $data['year'] = $year;
            $data['report'] = $report;

            $where = array(
                'customerID' => $id
                    );
            $customer = $this->pm->get_data('customers',$where);
            $data['customer'] = $customer[0];

            $data['sale'] = $this->pm->get_ycustomer_sales_data($id,$year);
            $data['cvoucher'] = $this->pm->get_yscustomer_cvouchers_data($id,$year);
            $data['dvoucher'] = $this->pm->get_yscustomer_dvouchers_data($id,$year);
            $data['return'] = $this->pm->get_yscustomer_returns_data($id,$year);

            $data['psale'] = $this->pm->get_pycustomer_sales_data($id,$year);
            $data['pcvoucher'] = $this->pm->get_pyscustomer_cvouchers_data($id,$year);
            $data['pdvoucher'] = $this->pm->get_pyscustomer_dvouchers_data($id,$year);
            $data['preturn'] = $this->pm->get_pyscustomer_returns_data($id,$year);
            }
        else
            {
            $id = $_GET['customer'];
            $data['report'] = $report;

            $where = array(
                'customerID' => $id
                    );
            $customer = $this->pm->get_data('customers',$where);
            $data['customer'] = $customer[0];

            $cusid = $id;

            $data['sale'] = $this->pm->get_customer_sales_data($id);
            $data['cvoucher'] = $this->pm->customer_vaucher_paid_details($cusid);
            $data['dvoucher'] = $this->pm->customer_vaucher_pay_details($cusid);
            $data['return'] = $this->pm->customer_returns_details($cusid);

            $data['psale'] = '';
            $data['pcvoucher'] = '';
            $data['pdvoucher'] = '';
            $data['preturn'] = '';
            }
        }

    $data['content'] = $this->load->view('customers/customersReport',$data,TRUE);
    $this->load->view('themes/adminlte',$data);
}



// customer_sale_summary
public function customer_sale_summary() {

    $data = [
        'title' => 'Customer Sale Summary'
    ];

    $sql = "SELECT DISTINCT(`customerID`) as customer_id FROM sales";
    $result = $this->db->query($sql);
    $customers = $result->result_array();
    $data['customers'] = $customers;
    $data['content'] = $this->load->view('customers/customer_sale_summary',$data,true);
    $this->load->view('themes/adminlte',$data);
}

// add_customer
public function add_customer() {
    $data = array();
    $data['customerName'] = $_POST['customerName'];
    $data['compname'] = $_POST['compname'];
    $data['mobile'] = $_POST['mobile'];
    $data['email'] = $_POST['email'];
    $data['address'] = $_POST['address'];
    $data['balance'] = $_POST['balance'];
    $data['regby'] = $this->session->userdata('admin_id');
    $result = $this->pm->customer_add($data);
    if($result) {
        //echo "Category Successfully!";
        $customers = $this->pm->get_data('customers', false);
        $append = '<div id="customer_hide"><label>Customer *</label>
                    <select class="form-control chosen" name="customerID" onchange="myFunction()" id="customerID" required>
                    <option value="">Select One</option>
                    ';
        foreach($customers as $value) {
            $append .= '<option value=" '.$value['customerID'] .' ">'.$value['customerName'].'('.$value['customerID'].')</option>';
        }
        $append .= '</select></div>';
        echo $append;
    }else{
        echo "Customer Added Failed!";
    }
}

// customer_info
public function customer_info() {
    $customer_id = $_POST['customerID'];
    $sql = "SELECT (select SUM(`totalAmount`) from sales where `customerID` = $customer_id) as total_amount, (select SUM(`paidAmount`) from sales where `customerID` = $customer_id) as total_paid, (select balance FROM `customers` WHERE `customerID` = $customer_id) as total_due, (select SUM(`totalamount`) FROM `vaucher` WHERE `customerID` = $customer_id) as total_payment_voucher FROM sales WHERE `customerID` = $customer_id";
    $result = $this->db->query($sql);
    echo json_encode($result->row());
}






}